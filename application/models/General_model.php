<?php
defined('BASEPATH') OR exit('Ação não permitida');

class General_model extends CI_Model{
  public function get_all($table = null, $cond = null){
    if($table && $this->db->table_exists($table)){
      if(is_array($cond)){
        $this->db->where($cond);
      }

      return $this->db->get($table)->result();
    } else {
      return FALSE;
    }
  }

  public function get_by_id($table = null, $cond = null){
    if($table && $this->db->table_exists($table) && is_array($cond)){
      $this->db->where($cond);
      $this->db->limit(1);

      return $this->db->get($table)->row();
    } else {
      return false;
    }
  }

  public function insert($table = null, $data = null){
    if($table && $this->db->table_exists($table) && is_array($data)){
      $this->db->insert($table, $data);

      if($this->db->affected_rows() > 0){
        $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso!');
      } else {
        $this->session->set_flashdata('error', 'Não foi possivel salvar os dados');
      }
    } else {
      return false;
    }
  }

  public function update($table = null, $cond = null, $data = null){
    if($table && $this->db->table_exists($table) && is_array($data) && is_array($cond)){
      if($this->db->update($table, $data, $cond)){
        $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso!');
      } else {
        $this->session->set_flashdata('error', 'Não foi possivel salvar os dados');
      }
    } else {
      return false;
    }
  }

  public function delete($table = null, $cond = null){
    if($table && $this->db->table_exists($table) && is_array($cond)){
      if($this->db->delete($table, $cond)){
        $this->session->set_flashdata('sucesso', 'Registro excluido com sucesso');
      } else {
        $this->session->set_flashdata('error', 'Não foi possivel excluir o registro');
      }
    } else {
      return false;
    }
  }
}