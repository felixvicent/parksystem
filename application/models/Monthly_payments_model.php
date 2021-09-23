<?php
defined('BASEPATH') or exit('Ação não permitida');

class Monthly_payments_model extends CI_Model
{
  public function get_all()
  {
    $this->db->select([
      'monthly_payments.*',
      'pricings.id',
      'pricings.category',
      'pricings.value_month',
      'monthly.id',
      'monthly.first_name',
      'monthly.cpf',
      'monthly.expiration',
    ]);

    $this->db->join('pricings', 'pricings.id = monthly_payments.pricing_id', 'LEFT');
    $this->db->join('monthly', 'monthly.id = monthly_payments.monthly_id', 'LEFT');

    return $this->db->get('monthly_payments')->result();
  }
}
