<?php
defined('BASEPATH') or exit('Ação não permitida');

class Systema extends CI_Controller
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
      "system" => $this->general->get_by_id('system', array('id' => 1)),
      "scripts" => array(
        "plugins/mask/jquery.mask.min.js",
        "plugins/mask/custom.js",
      ),
    );

    $this->load->view('layout/header', $data);
    $this->load->view('system/index', $data);
    $this->load->view('layout/footer');
  }
}
