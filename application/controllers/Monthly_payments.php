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
      $data = array(
        "title" => "Cadastrar mensalidade",
        "pricings" => $this->general->get_all('pricings', array('active' => 1)),
        "monthly" => $this->general->get_all('monthly', array('active' => 1)),
        // 'modal_text' => 'Os dados estão corretos? </br></br>Depois de salva só será possivel alterar a categoria do veiculo',
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
    } else {
      if (!$this->general->get_by_id('monthly_payments', array('id' => $id))) {
        $this->session->set_flashdata('error', 'Mensalidade não encontrada');
        redirect('monthly_payments');
      } else {
        $data = array(
          "title" => "Editar mensalidade",
          "pricings" => $this->general->get_all('pricings', array('active' => 1)),
          "monthly" => $this->general->get_all('monthly', array('active' => 1)),
          "monthly_payment" => $this->general->get_by_id('monthly_payments', array('id' => $id)),
          'modal_text' => 'Os dados estão corretos? </br></br>Depois de salva só será possivel alterar a categoria do veiculo',
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
