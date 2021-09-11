<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Home extends CI_Controller{
  public function index(){

    $data = array(
      "title" => 'Home'
    );

    $this->load->view('layout/header', $data);
    $this->load->view('home/index');
    $this->load->view('layout/footer');
  }
}