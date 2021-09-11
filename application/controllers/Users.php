<?php
defined('BASEPATH') OR exit ('Ação não permitida');

class Users extends CI_Controller {
  public function index(){
    $data = array(
      "title" => "Usuários Cadastrados",
      "subtitle" => "Listando todos os usuários cadastrados",
      "users" => $this->ion_auth->users()->result(),
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
    $this->load->view('users/index');
    $this->load->view('layout/footer');
  }
}