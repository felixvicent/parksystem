<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-credit-card bg-blue"></i>
              <div class="d-inline">
                <h5><?php echo $title ?></h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a data-toggle="tooltip" data-placement="bottom" title="Home" href="<?php echo base_url('/') ?>"><i class="ik ik-home"></i></a>
                </li>
                <li class="breadcrumb-item">
                  <a data-toggle="tooltip" data-placement="bottom" title="Formas de pagamento" href="<?php echo base_url('payments') ?>">Formas de pagamento</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <?php echo isset($payment) ? '<i class="ik ik-calendar ik-2x"></i>&nbsp; Última atualização: ' . formata_data_banco_com_hora($payment->updated_on) : '' ?>
            </div>
            <div class="card-body">
              <form class="forms-sample" name="form_payment" method="POST">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" name="name" value="<?php echo (isset($payment) ? $payment->name : set_value('name')) ?>">
                    <?php echo form_error('name', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>Ativo</label>
                    <select name="active" class="form-control">
                      <option <?php echo isset($payment->active) && $payment->active == 0 ? 'selected' : '' ?> value="0">Não</option>
                      <option <?php echo isset($payment->active) && $payment->active == 1 ? 'selected' : '' ?> value="1">Sim</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <input type="hidden" name="payment_id" value="<?php echo isset($payment) ? $payment->id : 0 ?>">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                <a href="<?php echo base_url('payments'); ?>" class="btn btn-secondary">Cancelar</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>