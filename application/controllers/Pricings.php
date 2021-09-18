<?php
defined('BASEPATH') or exit('Ação não permitida');

class Pricings extends CI_Controller
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
      "title" => "Precificações",
      "pricings" => $this->general->get_all('pricings'),
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
    $this->load->view('pricings/index', $data);
    $this->load->view('layout/footer');
  }

  public function form($id = null)
  {
    if (!$id) {
    } else {
      if (!$this->general->get_by_id('pricings', array('id' => $id))) {
        $this->session->set_flashdata('error', 'Precificação não encontrada');
        redirect('/pricings');
      } else {

        $this->form_validation->set_rules('category', 'Categoria', 'trim|required|min_length[5]|max_length[50]|callback_category_check');
        $this->form_validation->set_rules('value_hour', 'Valor hora', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('value_month', 'Valor mensalidade', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('number_vacancies', 'Número de vagas', 'trim|required|integer|greater_than[0]');

        if ($this->form_validation->run()) {
        } else {
          $data = array(
            "title" => "Editar Precificação",
            "pricing" => $this->general->get_by_id('pricings', array('id' => $id)),
            "scripts" => array(
              "plugins/mask/jquery.mask.min.js",
              "plugins/mask/custom.js",
            )
          );

          $this->load->view('layout/header', $data);
          $this->load->view('pricings/form', $data);
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

  public function category_check($category)
  {
    $id = $this->input->post('pricing_id');

    if ($this->general->get_by_id('pricings', array('category' => $category, 'id !=' => $id))) {
      $this->form_validation->set_message('category_check', 'Essa categoria já existe');
      return false;
    } else {
      return true;
    }
  }
}
