<?php
defined('BASEPATH') or exit('Ação não permitida');

class Payments extends CI_Controller
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
      "title" => "Formas de pagamento",
      "payments" => $this->general->get_all('payment_methods'),
    );

    $this->load->view('layout/header', $data);
    $this->load->view('payments/index', $data);
    $this->load->view('layout/footer');
  }
  public function form($id = null)
  {
    if (!$id) {
      $this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[3]|max_length[30]|is_unique[payment_methods.name]');

      if ($this->form_validation->run()) {
        $data = elements(array(
          'name',
          'active',
        ), $this->input->post());

        $data = html_escape($data);

        if ($this->general->insert('payment_methods', $data)) {
          redirect('payments');
        } else {
          redirect('payments');
        }
      } else {
        $data = array(
          "title" => "Editar Precificação",
          "payment" => $this->general->get_by_id('payment_methods', array('id' => $id)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('payments/form', $data);
        $this->load->view('layout/footer');
      }
    } else {
      if (!$this->general->get_by_id('payment_methods', array('id' => $id))) {
        $this->session->set_flashdata('error', 'Forma de pagamento não encontrada');
        redirect('payments');
      } else {
        $this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[3]|max_length[30]|callback_name_check');
        if ($this->form_validation->run()) {

          $data = elements(array(
            'name',
            'active'
          ), $this->input->post());

          $data = html_escape($data);

          if ($this->general->update('payment_methods', array('id' => $id), $data)) {
            redirect('payments');
          } else {
            redirect('payments');
          }
        } else {
          $data = array(
            "title" => "Editar forma de pagamento",
            "payment" => $this->general->get_by_id('payment_methods', array('id' => $id)),
          );

          $this->load->view('layout/header', $data);
          $this->load->view('payments/form', $data);
          $this->load->view('layout/footer');
        }
      }
    }
  }

  public function name_check($name)
  {
    $id = $this->input->post('payment_id');

    if ($this->general->get_by_id('payment_methods', array('name' => $name, 'id !=' => $id))) {
      $this->form_validation->set_message('name_check', 'Esse nome já existe');
      return false;
    } else {
      return true;
    }
  }

  public function delete($id = null)
  {
    if (!$id || !$this->general->get_by_id('payment_methods', array('id' => $id))) {
      $this->session->set_flashdata('error', 'Forma de pagamento não encontrado');
      redirect('payments');
    }

    $this->general->delete('payment_methods', array('id' => $id));

    redirect('payments');
  }
}
