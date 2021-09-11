<?php
defined('BASEPATH') OR exit ('Ação não permitida');

class Users extends CI_Controller {
  public function index(){
    $data = array(
      "title" => "Usuários Cadastrados",
      "subtitle" => "Listando todos os usuários cadastrados",
      "users" => $this->ion_auth->users()->result()
    );

    $this->load->view('layout/header', $data);
    $this->load->view('users/index');
    $this->load->view('layout/footer');
  }
}