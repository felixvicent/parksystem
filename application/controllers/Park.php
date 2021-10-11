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
      exit('CADASTRANDO');
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
}
