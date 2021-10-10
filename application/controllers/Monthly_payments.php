<?php
defined('BASEPATH') or exit('Ação não permitida');

class Monthly_payments extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    if (!$this->ion_auth->logged_in()) {
      redirect('login');
    }

    $this->load->model('Monthly_payments_model', 'monthly_payments');
  }

  public function index()
  {
    $data = array(
      "title" => "Mensalidades",
      "monthly_payments" => $this->monthly_payments->get_all('monthly_payments'),
      "styles" => array(
        "plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
      ),
      "scripts" => array(
        'plugins/datatables.net/js/jquery.dataTables.min.js',
        'plugins/datatables.net-bs4/js/jquery.bootstrap4.min.js',
        'plugins/datatables.net/js/parksystem.js',
      )
    );

    $this->load->view('layout/header', $data);
    $this->load->view('monthly_payments/index', $data);
    $this->load->view('layout/footer');
  }

  public function form($id = null)
  {
    if (!$id) {
      $this->form_validation->set_rules('pricing_id', 'Categoria', 'required');
      $this->form_validation->set_rules('monthly_id', 'Mensalista', 'required');
      $this->form_validation->set_rules('due_date', 'Data vencimento', 'required|callback_check_exist_monthly|callback_check_valid_date|callback_check_expiration_date');

      if ($this->form_validation->run()) {
        $data = elements(array(
          "pricing_id",
          "monthly_value",
          "monthly_expiration",
        ), $this->input->post());

        $data['status'] = $this->input->post('monthly_payment_status');
        $data['monthly_id'] = $this->input->post('monthly_hidden_id');
        $data['pricing_id'] = $this->input->post('pricing_hidden_id');
        $data['due_date'] = $this->input->post('due_date');

        if ($data['status'] == 1) {
          $data['payment_date'] = date('Y-m-d H:i:s');
        }

        $data = html_escape($data);

        $this->general->insert('monthly_payments', $data);
        redirect('monthly_payments');
      } else {
        $data = array(
          "title" => "Cadastrar mensalidade",
          "pricings" => $this->general->get_all('pricings', array('active' => 1)),
          "monthly" => $this->general->get_all('monthly', array('active' => 1)),
          'modal_text' => 'Os dados estão corretos? </br></br>Depois de salva só será possivel alterar a categoria e a situação',
          "styles" => array(
            "plugins/select2/dist/css/select2.min.css"
          ),
          "scripts" => array(
            "plugins/mask/jquery.mask.min.js",
            "plugins/mask/custom.js",
            "plugins/select2/dist/js/select2.min.js",
            "js/monthly_payments/custom.js"
          ),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('monthly_payments/form', $data);
        $this->load->view('layout/footer');
      }
    } else {
      if (!$this->general->get_by_id('monthly_payments', array('id' => $id))) {
        $this->session->set_flashdata('error', 'Mensalidade não encontrada');
        redirect('monthly_payments');
      } else {
        $this->form_validation->set_rules('pricing_id', 'Categoria', 'required');

        if ($this->form_validation->run()) {
          $data = elements(array(
            "pricing_id",
            "monthly_value",
            "monthly_expiration",
          ), $this->input->post());

          $data['status'] = $this->input->post('monthly_payment_status');
          $data['monthly_id'] = $this->input->post('monthly_hidden_id');
          $data['pricing_id'] = $this->input->post('pricing_hidden_id');

          if ($data['status'] == 1) {
            $data['payment_date'] = date('Y-m-d H:i:s');
          }

          $data = html_escape($data);

          $this->general->update('monthly_payments', array('id' => $id), $data);
          redirect('monthly_payments');
        } else {
          $data = array(
            "title" => "Editar mensalidade",
            "pricings" => $this->general->get_all('pricings', array('active' => 1)),
            "monthly" => $this->general->get_all('monthly', array('active' => 1)),
            "monthly_payment" => $this->general->get_by_id('monthly_payments', array('id' => $id)),
            'modal_text' => 'Os dados estão corretos? </br></br>Depois de salva só será possivel alterar a categoria e a situação',
            "styles" => array(
              "plugins/select2/dist/css/select2.min.css"
            ),
            "scripts" => array(
              "plugins/mask/jquery.mask.min.js",
              "plugins/mask/custom.js",
              "plugins/select2/dist/js/select2.min.js",
              "js/monthly_payments/custom.js"
            ),
          );

          $this->load->view('layout/header', $data);
          $this->load->view('monthly_payments/form', $data);
          $this->load->view('layout/footer');
        }
      }
    }
  }

  public function delete($id = null)
  {
    if (!$id || !$this->general->get_by_id('monthly_payments', array('id' => $id))) {
      $this->session->set_flashdata('error', 'Mensalidade não encontrada');
      redirect('monthly_payments');
    }

    if ($this->general->get_by_id('monthly_payments', array('id' => $id, 'status' => 0))) {
      $this->session->set_flashdata('error', 'Mensalidade em aberta não pode ser excluida');
      redirect('monthly_payments');
    }

    $this->general->delete('monthly_payments', array('id' => $id));
    redirect('monthly_payments');
  }

  public function check_expiration_date($due_date)
  {
    if ($due_date) {
      $due_date = explode('-', $due_date);
      $monthly_expiration = $this->input->post('monthly_expiration');

      if ($due_date[2] != $monthly_expiration) {
        $this->form_validation->set_message('check_expiration_date', 'Esse campo deve conter o mesmo dia que o "Melhor dia de vencimento"');
        return FALSE;
      } else {
        return true;
      }
    } else {
      $this->form_validation->set_message('check_expiration_date', 'Campo obrigatório');
      return FALSE;
    }
  }

  public function check_exist_monthly($due_date)
  {
    $monthly_id = $this->input->post('monthly_hidden_id');
    $monthly = $this->general->get_by_id('monthly_payments', array('monthly_id' => $monthly_id, 'due_date' => $due_date));
    if ($monthly) {
      $post_due_date = explode('-', $due_date);
      $monthly_due_date = explode('-', $monthly->due_date);

      if ($post_due_date[0] == $monthly_due_date[0] && $post_due_date[1] == $monthly_due_date[1]) {
        $this->form_validation->set_message('check_exist_monthly', 'Para o mensalista informado, já existe uma mensalidade para essa data');
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  }

  public function check_valid_date($due_date)
  {
    $atual_date = strtotime(date('Y-m-d'));
    $due_date = strtotime($due_date);

    if ($atual_date > $due_date) {
      $this->form_validation->set_message('check_valid_date', 'A data de vencimento deve ser corrente ou futura');
      return FALSE;
    } else {
      return TRUE;
    }
  }
}
