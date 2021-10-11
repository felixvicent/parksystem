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
}
