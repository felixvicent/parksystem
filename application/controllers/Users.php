<?php
defined('BASEPATH') OR exit ('Ação não permitida');

class Users extends CI_Controller {
  public function index(){
    $data = array(
      "title" => "Usuários Cadastrados",
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

  public function form($id = null){
    if(!$id){
      $data = array(
        "title" => "Cadastrar Usuário",
      );

      $this->load->view('layout/header', $data);
      $this->load->view('users/form');
      $this->load->view('layout/footer');
    } else {
      if(!$this->ion_auth->user($id)->row()){
        exit('User not exists');
      } else {
        $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Senha', 'trim|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirma senha', 'trim|matches[password]');

        if($this->form_validation->run()){
          echo '<pre>';
          print_r($this->input->post());
          exit();
        } else {
          $data = array(
            "title" => "Editar Usuário",
            "user" => $this->ion_auth->user($id)->row(),
            "user_profile" => $this->ion_auth->get_users_groups($id)->row()
          );
      
          $this->load->view('layout/header', $data);
          $this->load->view('users/form');
          $this->load->view('layout/footer');
        }

        $data = array(
          "title" => "Editar Usuário",
          "user" => $this->ion_auth->user($id)->row(),
          "user_profile" => $this->ion_auth->get_users_groups($id)->row()
        );
    
        $this->load->view('layout/header', $data);
        $this->load->view('users/form');
        $this->load->view('layout/footer');
      }
    }
  }
}