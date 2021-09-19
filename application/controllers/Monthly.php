<?php
defined('BASEPATH') or exit('Ação não permitida');

class Monthly extends CI_Controller
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
      "title" => "Mensalistas Cadastrados",
      "monthlys" => $this->general->get_all('monthly'),
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
    $this->load->view('monthly/index');
    $this->load->view('layout/footer');
  }

  public function form($id = null)
  {
    if (!$id) {
      $data = array(
        "title" => "Cadastrar mensalista",
        "scripts" => array(
          "plugins/mask/jquery.mask.min.js",
          "plugins/mask/custom.js",
        )
      );

      $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[4]|max_length[45]');
      $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[4]|max_length[150]');
      $this->form_validation->set_rules('birth_date', 'Data de nascimento', 'required');
      $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|exact_length[14]|callback_cpf_check');
      $this->form_validation->set_rules('rg', 'RG', 'trim|required|min_length[7]|max_length[14]|is_unique[monthly.rg]');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[50]|is_unique[monthly.email]');
      if (!empty($this->input->post('telphone'))) {
        $this->form_validation->set_rules('telephone', 'Telefone', 'trim|exact_length[14]|is_unique[monthly.telephone]');
      }
      $this->form_validation->set_rules('cellphone', 'Celular', 'trim|required|min_length[14]|max_length[15]|is_unique[monthly.cellphone]');
      $this->form_validation->set_rules('zip_code', 'CEP', 'trim|required|exact_length[9]');
      $this->form_validation->set_rules('address', 'Endereço', 'trim|required|min_length[4]|max_length[155]');
      $this->form_validation->set_rules('number', 'Número', 'trim|required|max_length[20]');
      $this->form_validation->set_rules('district', 'Bairro', 'trim|required|min_length[4]|max_length[45]');
      $this->form_validation->set_rules('city', 'Cidade', 'trim|required|min_length[4]|max_length[80]');
      $this->form_validation->set_rules('state', 'UF', 'trim|required|exact_length[2]');
      $this->form_validation->set_rules('complement', 'Complemento', 'trim|max_length[145]');
      $this->form_validation->set_rules('expiration', 'Dia vencimento mensalidade', 'trim|required|integer|greater_than[0]|less_than[32]');
      $this->form_validation->set_rules('obs', 'Observações', 'trim|max_length[500]');

      if ($this->form_validation->run()) {

        $data = elements(array(
          'first_name',
          'last_name',
          'birth_date',
          'cpf',
          'rg',
          'email',
          'telephone',
          'cellphone',
          'zip_code',
          'address',
          'number',
          'district',
          'city',
          'state',
          'complement',
          'active',
          'expiration',
          'obs',
        ), $this->input->post());

        $data['state'] = strtoupper($data['state']);

        $data = html_escape($data);

        $this->general->insert('monthly', $data);

        redirect('monthly');
      } else {
        $this->load->view('layout/header', $data);
        $this->load->view('monthly/form');
        $this->load->view('layout/footer');
      }
    } else {
      if (!$this->general->get_by_id('monthly', array('id' => $id))) {
        $this->session->set_flashdata('error', 'Mensalista não encontrado');
        redirect('monthly');
      } else {
        $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[4]|max_length[45]');
        $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[4]|max_length[150]');
        $this->form_validation->set_rules('birth_date', 'Data de nascimento', 'required');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|exact_length[14]|callback_cpf_check');
        $this->form_validation->set_rules('rg', 'RG', 'trim|required|min_length[7]|max_length[14]|callback_rg_check');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[50]|callback_email_check');
        if (!empty($this->input->post('telphone'))) {
          $this->form_validation->set_rules('telephone', 'Telefone', 'trim|exact_length[14]|callback_telephone_check');
        }
        $this->form_validation->set_rules('cellphone', 'Celular', 'trim|required|min_length[14]|max_length[15]|callback_cellphone_check');
        $this->form_validation->set_rules('zip_code', 'CEP', 'trim|required|exact_length[9]');
        $this->form_validation->set_rules('address', 'Endereço', 'trim|required|min_length[4]|max_length[155]');
        $this->form_validation->set_rules('number', 'Número', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('district', 'Bairro', 'trim|required|min_length[4]|max_length[45]');
        $this->form_validation->set_rules('city', 'Cidade', 'trim|required|min_length[4]|max_length[80]');
        $this->form_validation->set_rules('state', 'UF', 'trim|required|exact_length[2]');
        $this->form_validation->set_rules('complement', 'Complemento', 'trim|max_length[145]');
        $this->form_validation->set_rules('expiration', 'Dia vencimento mensalidade', 'trim|required|integer|greater_than[0]|less_than[32]');
        $this->form_validation->set_rules('obs', 'Observações', 'trim|max_length[500]');

        if ($this->form_validation->run()) {

          $active = $this->input->post('active');

          if ($active == 0) {
            if ($this->db->table_exists('monthly_payments')) {
              if ($this->general->get_by_id('monthly_payments', array('monthly_id' => $id, 'status' => 0))) {
                $this->session->set_flashdata('error', 'Esse mensalista está com mensalidade em aberto');
                redirect('monthly');
              }
            }
          }

          $data = elements(array(
            'first_name',
            'last_name',
            'birth_date',
            'cpf',
            'rg',
            'email',
            'telephone',
            'cellphone',
            'zip_code',
            'address',
            'number',
            'district',
            'city',
            'state',
            'complement',
            'active',
            'expiration',
            'obs',
          ), $this->input->post());

          $data['state'] = strtoupper($data['state']);

          $data = html_escape($data);

          $this->general->update('monthly', array('id' => $id), $data);
          redirect('monthly');
        } else {
          $data = array(
            "title" => "Editar mensalista",
            "monthly" => $this->general->get_by_id('monthly', array('id' => $id)),
            "scripts" => array(
              "plugins/mask/jquery.mask.min.js",
              "plugins/mask/custom.js",
            )
          );

          $this->load->view('layout/header', $data);
          $this->load->view('monthly/form');
          $this->load->view('layout/footer');
        }
      }
    }
  }

  public function delete($id = null)
  {
    if (!$id || !$this->general->get_by_id('monthly', array('id' => $id))) {
      $this->session->set_flashdata('error', 'Mensalista não encontrado');
      redirect('monthly');
    }

    if ($this->general->get_by_id('monthly', array('id' => $id, 'active' => 1))) {
      $this->session->set_flashdata('error', 'Mensalista ativo não pode ser excluido');
      redirect('monthly');
    }

    $this->general->delete('monthly', array('id' => $id));

    redirect('monthly');
  }

  public function email_check($email)
  {
    $id = $this->input->post('monthly_id');

    if ($this->general->get_by_id('monthly', array('email' => $email, 'id !=' => $id))) {
      $this->form_validation->set_message('email_check', 'Esse email já existe');
      return false;
    } else {
      return true;
    }
  }

  public function cellphone_check($cellphone)
  {
    $id = $this->input->post('monthly_id');

    if ($this->general->get_by_id('monthly', array('cellphone' => $cellphone, 'id !=' => $id))) {
      $this->form_validation->set_message('cellphone_check', 'Esse celular já existe');
      return false;
    } else {
      return true;
    }
  }

  public function rg_check($rg)
  {
    $id = $this->input->post('monthly_id');

    if ($this->general->get_by_id('monthly', array('rg' => $rg, 'id !=' => $id))) {
      $this->form_validation->set_message('rg_check', 'Esse RG já existe');
      return false;
    } else {
      return true;
    }
  }

  public function telephone_check($telephone)
  {
    $id = $this->input->post('monthly_id');

    if ($this->general->get_by_id('monthly', array('telephone' => $telephone, 'id !=' => $id))) {
      $this->form_validation->set_message('telephone_check', 'Esse telefone já existe');
      return false;
    } else {
      return true;
    }
  }

  public function cpf_check($cpf)
  {
    if ($this->input->post('monthly_id')) {

      $id = $this->input->post('monthly_id');

      if ($this->general->get_by_id('monthly', array('id !=' => $id, 'cpf' => $cpf))) {
        $this->form_validation->set_message('cpf_check', 'O campo CPF já existe, ele deve ser único');
        return FALSE;
      }
    }

    $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
    // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

      $this->form_validation->set_message('cpf_check', 'Por favor digite um CPF válido');
      return FALSE;
    } else {
      // Calcula os números para verificar se o CPF é verdadeiro
      for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
          $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
          $this->form_validation->set_message('cpf_check', 'Por favor digite um CPF válido');
          return FALSE;
        }
      }
      return TRUE;
    }
  }
}
