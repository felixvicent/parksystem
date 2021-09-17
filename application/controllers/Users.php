<?php
defined('BASEPATH') or exit('Ação não permitida');

class Users extends CI_Controller
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

  public function form($id = null)
  {
    if (!$id) {
      $data = array(
        "title" => "Cadastrar Usuário",
      );

      $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[5]|max_length[20]');
      $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[5]|max_length[20]');
      $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[3]|max_length[20]|is_unique[users.username]');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
      $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[8]');
      $this->form_validation->set_rules('confirm_password', 'Confirma senha', 'trim|required|matches[password]');

      if ($this->form_validation->run()) {

        $username = html_escape($this->input->post('username'));
        $password = html_escape($this->input->post('password'));
        $email = html_escape($this->input->post('email'));
        $data_additional = array(
          'first_name' => $this->input->post('first_name'),
          'last_name' => $this->input->post('last_name'),
          'active' => $this->input->post('active'),
        );
        $group = array($this->input->post('profile'));

        $data_additional = html_escape($data_additional);

        if ($this->ion_auth->register($username, $password, $email, $data_additional, $group)) {
          $this->session->set_flashdata('sucesso', 'Usuário cadastrado com sucesso');
        } else {
          $this->session->set_flashdata('error', 'Não foi possivel cadastrar usuário');
        }

        redirect('users');
      } else {
        $this->load->view('layout/header', $data);
        $this->load->view('users/form');
        $this->load->view('layout/footer');
      }

      $this->load->view('layout/header', $data);
      $this->load->view('users/form');
      $this->load->view('layout/footer');
    } else {
      if (!$this->ion_auth->user($id)->row()) {
        exit('User not exists');
      } else {
        $atual_profile = $this->ion_auth->get_users_groups($id)->result();

        $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[3]|max_length[20]|callback_username_check');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
        $this->form_validation->set_rules('password', 'Senha', 'trim|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirma senha', 'trim|matches[password]');

        if ($this->form_validation->run()) {
          $data = elements(array(
            'first_name',
            'last_name',
            'username',
            'email',
            'password',
            'active'
          ), $this->input->post());

          $password = $this->input->post('password');

          if (!$password) {
            unset($data['password']);
          }

          $data = html_escape($data);

          if ($this->ion_auth->update($id, $data)) {
            $profile = $this->input->post('profile');

            if ($atual_profile->id != $profile) {
              $this->ion_auth->remove_from_group($atual_profile->id, $id);
              $this->ion_auth->add_to_group($profile, $id);
            }

            $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso');
          } else {
            $this->session->set_flashdata('error', 'Não foi possivel atualizar os dados');
          }

          redirect('users');
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
      }
    }
  }

  public function delete($id = null)
  {
    if (!$id || !$this->general->get_by_id('users', array('id' => $id))) {
      $this->session->set_flashdata('error', 'Usuário não encontrado');
      redirect('users');
    } else {
      if ($this->ion_auth->is_admin($id)) {
        $this->session->set_flashdata('error', 'Administrador não pode ser excluido');
        redirect('users');
      }

      if ($this->ion_auth->delete_user($id)) {
        $this->session->set_flashdata('sucesso', 'Usuário excluido com sucesso');
      } else {
        $this->session->set_flashdata('error', 'usuário não pode ser excluido');
      }

      redirect('users');
    }
  }

  public function username_check($username)
  {
    $id = $this->input->post('user_id');

    if ($this->general->get_by_id('users', array('username' => $username, 'id !=' => $id))) {
      $this->form_validation->set_message('username_check', 'Esse usuário já existe');
      return false;
    } else {
      return true;
    }
  }

  public function email_check($email)
  {
    $id = $this->input->post('user_id');

    if ($this->general->get_by_id('users', array('email' => $email, 'id !=' => $id))) {
      $this->form_validation->set_message('email_check', 'Esse email já existe');
      return false;
    } else {
      return true;
    }
  }
}
