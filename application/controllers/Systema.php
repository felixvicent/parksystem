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

    $this->form_validation->set_rules('razao_social', 'Razão social', 'trim|required|min_length[5]|max_length[145]');
    $this->form_validation->set_rules('nome_fantasia', 'Nome fantasia', 'trim|required|min_length[5]|max_length[145]');
    $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|required|exact_length[18]');
    $this->form_validation->set_rules('ie', 'Inscrição estadual', 'trim|required|max_length[25]');
    $this->form_validation->set_rules('telefone_fixo', 'Telefone fixo', 'trim|required|exact_length[14]');
    $this->form_validation->set_rules('telefone_movel', 'Telefone movel', 'trim|required|min_length[14]|max_length[15]');
    $this->form_validation->set_rules('cep', 'CEP', 'trim|required|exact_length[9]');
    $this->form_validation->set_rules('endereco', 'Endereço', 'trim|required|min_length[5]|max_length[145]');
    $this->form_validation->set_rules('numero', 'Número', 'trim|required|min_length[1]|max_length[25]');
    $this->form_validation->set_rules('cidade', 'Cidade', 'trim|required|min_length[3]|max_length[45]');
    $this->form_validation->set_rules('estado', 'UF', 'trim|required|exact_length[2]');
    $this->form_validation->set_rules('site_url', 'URL do site', 'trim|required|valid_url|max_length[100]');
    $this->form_validation->set_rules('email', 'Email de contato', 'trim|required|valid_email|max_length[100]');
    $this->form_validation->set_rules('txt_ticket', 'Texto do ticket', 'trim|max_length[500]');

    if ($this->form_validation->run()) {
      $data = elements(
        array(
          'razao_social',
          'nome_fantasia',
          'cnpj',
          'ie',
          'telefone_fixo',
          'telefone_movel',
          'cep',
          'endereco',
          'numero',
          'cidade',
          'estado',
          'site_url',
          'email',
          'txt_ticket',
        ),
        $this->input->post()
      );

      $data = html_escape($data);

      $this->general->update('system', array('id' => 1), $data);

      $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso');
      redirect($this->router->fetch_class());
    } else {
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
}
