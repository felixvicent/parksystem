<?php
defined('BASEPATH') or exit('Ação não permitida');

class Sistema extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    if (!$this->ion_auth->logged_in()) {
      redirect('login');
    }
  }

  public function index()
  {
    $data = array(
      "title" => "Sistema",
      "sistema" => $this->general->get_by_id('sistema', array('id' => 1))
    );

    $this->load->view('layout/header', $data);
    $this->load->view('sistema/index');
    $this->load->view('layout/footer');
  }
}
