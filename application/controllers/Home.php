<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Home extends CI_Controller{
  public function index(){
    $this->load->view('home/index');
  }
}