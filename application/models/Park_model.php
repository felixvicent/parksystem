<?php
defined('BASEPATH') or exit('Ação não permitida');

class Park_model extends CI_Model
{
  public function get_all()
  {
    $this->db->select([
      'park.*',
      'park.id as park_id',
      'pricings.id as pricing_id',
      'pricings.category',
      'pricings.value_hour',
      'payment_methods.id as payment_method_id',
      'payment_methods.name',
    ]);

    $this->db->join('pricings', 'pricings.id = pricing_id', 'LEFT');
    $this->db->join('payment_methods', 'payment_methods.id = payment_method_id', 'LEFT');

    return $this->db->get('park')->result();
  }
}
