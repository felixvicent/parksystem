<?php
defined('BASEPATH') or exit('Ação não permitida');

class Park extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    if (!$this->ion_auth->logged_in()) {
      redirect('login');
    }

    $this->load->model('Park_model', 'park');
  }

  public function index()
  {
    $data = array(
      "title" => "Tickets de estacionamentos",
      "parks" => $this->park->get_all(),
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
    $this->load->view('park/index', $data);
    $this->load->view('layout/footer');
  }

  public function form($id = null)
  {
    if (!$id) {
      $this->form_validation->set_rules('pricing_id', 'Categoria', 'required');
      $this->form_validation->set_rules('vacancie_number', 'Número vaga', 'required|integer|greater_than[0]|callback_check_free_vacancie|callback_check_range_category_vacancie');
      $this->form_validation->set_rules('vehicle_plate', 'Placa veículo', 'required|min_length[5]|callback_check_plate_status_open');
      $this->form_validation->set_rules('vehicle_brand', 'Marca veículo', 'required|min_length[2]|max_length[30]');
      $this->form_validation->set_rules('vehicle_model', 'Modelo veículo', 'required|min_length[2]|max_length[20]');

      if ($this->form_validation->run()) {
        $data = elements(array(
          'value_hour',
          'vacancie_number',
          'vehicle_plate',
          'vehicle_brand',
          'vehicle_model',
        ), $this->input->post());

        $data['pricing_id'] = intval(substr($this->input->post('pricing_id'), 0, 1));
        $data['status'] = 0;

        $data = html_escape($data);

        $this->general->insert('park', $data);
        redirect('park');
      } else {
        $data = array(
          "title" => "Cadastrar ticket",
          "modal_text" => "Tem certeza que deseja salvar esse ticket? Não será possivel altera-lo",
          "pricings" => $this->general->get_all('pricings', array('active' => 1)),
          "scripts" => array(
            "plugins/mask/jquery.mask.min.js",
            "plugins/mask/custom.js",
            "js/park/custom.js"
          ),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('park/form', $data);
        $this->load->view('layout/footer');
      }
    } else {
      if (!$this->general->get_by_id('park', array('id' => $id))) {
        $this->session->set_flashdata('error', 'Ticket não encontrado');
        redirect('park');
      } else {

        $elapsed_time = str_replace('.', '', $this->input->post('elapsed_time'));

        if ($elapsed_time > '015') {
          $this->form_validation->set_rules('payment_method_id', 'Forma de pagamento', 'required');
        }

        if ($this->form_validation->run()) {
          $data = elements(array(
            'elapsed_time',
            'payment_method_id',
            'value_owed'
          ), $this->input->post());

          if ($elapsed_time <= '015') {
            $data['payment_method_id'] = 6;
          }

          $data['exit_date'] = date('Y-m-d H:i:s');
          $data['status'] = 1;

          $data = html_escape($data);

          $this->general->update('park', array('id' => $id), $data);
          redirect('park');
        } else {
          $data = array(
            "title" => "Encerramento de ticket",
            "modal_text" => "Tem certeza que deseja encerrar esse ticket?",
            "park" => $this->general->get_by_id('park', array('id' => $id)),
            "pricings" => $this->general->get_all('pricings', array('active' => 1)),
            "payment_methods" => $this->general->get_all('payment_methods', array('active' => 1)),
            "scripts" => array(
              "plugins/mask/jquery.mask.min.js",
              "plugins/mask/custom.js",
              "js/park/custom.js"
            ),
          );

          $this->load->view('layout/header', $data);
          $this->load->view('park/form', $data);
          $this->load->view('layout/footer');
        }
      }
    }
  }

  public function check_free_vacancie($vacancie_number)
  {
    $pricing_id = intval(substr($this->input->post('pricing_id'), 0, 1));

    if ($this->general->get_by_id('park', array('vacancie_number' => $vacancie_number, 'status' => 0, 'pricing_id' => $pricing_id))) {
      $this->form_validation->set_message('check_free_vacancie', 'Essa vaga já está ocupada para essa categoria');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function check_range_category_vacancie($vacancie_number)
  {
    $pricing_id = intval(substr($this->input->post('pricing_id'), 0, 1));

    if ($pricing_id) {
      $pricing = $this->general->get_by_id('pricings', array('id' => $pricing_id));

      if ($pricing->number_vacancies < $vacancie_number) {
        $this->form_validation->set_message('check_range_category_vacancie', 'A vaga deve estar entre 1 e ' . $pricing->number_vacancies);
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      $this->form_validation->set_message('check_range_category_vacancie', 'Escolha uma categoria');
      return FALSE;
    }
  }

  public function check_plate_status_open($vehicle_plate)
  {
    $vehicle_plate = strtoupper($vehicle_plate);

    if ($this->general->get_by_id('park', array('vehicle_plate' => $vehicle_plate, 'status' => 0))) {
      $this->form_validation->set_message('check_plate_status_open', 'Existe uma ordem aberta para essa placa');
      return FALSE;
    } else {
      return TRUE;
    }
  }
}
