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
}
