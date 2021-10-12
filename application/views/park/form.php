<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="fas fa-parking bg-blue"></i>
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
                  <a data-toggle="tooltip" data-placement="bottom" title="tickets cadastrados" href="<?php echo base_url('monthly_payment') ?>">Tickets</a>
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
              <?php echo isset($park) ? '<i class="ik ik-calendar ik-2x"></i>&nbsp; Última atualização: ' . formata_data_banco_com_hora($park->updated_on) : '' ?>
            </div>
            <div class="card-body">
              <form class="forms-sample" name="form_core" method="post">
                <div class="row mb-3">
                  <div class="col-md-4 mb-3">
                    <label for="">Categoria</label>
                    <select class="form-control pricing" name="pricing_id" <?php echo (isset($park) ? 'disabled' : '') ?>>
                      <option value="">Escolha...</option>
                      <?php foreach ($pricings as $pricing) : ?>
                        <?php if (isset($park)) : ?>
                          <option value="<?php echo $pricing->id ?>" <?php echo ($pricing->id == $park->pricing_id ? 'selected' : '') ?>><?php echo $pricing->category ?></option>
                        <?php else : ?>
                          <option value="<?php echo $pricing->id ?><?php echo $pricing->value_hour ?>"><?php echo $pricing->category ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('pricing_id', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="">Valor hora</label>
                    <input type="text" class="form-control value_hour" name="value_hour" value="<?php echo (isset($park->value_hour) ? $park->value_hour : '0,00') ?>" readonly="">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="">Número vaga</label>
                    <input type="number" class="form-control" name="vacancie_number" value="<?php echo (isset($park) ? $park->vacancie_number : set_value('vacancie_number')) ?>" <?php echo (isset($park) ? 'readonly' : '') ?>>
                    <?php echo form_error('vacancie_number', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-4 mb-3">
                    <label for="">Placa veículo</label>
                    <input type="text" class="form-control vehicle_plate" name="vehicle_plate" value="<?php echo (isset($park) ? $park->vehicle_plate : set_value('vehicle_plate')) ?>" <?php echo (isset($park) ? 'readonly' : '') ?>>
                    <?php echo form_error('vehicle_plate', '<div class="text-danger">', '</div>') ?>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="">Marca veículo</label>
                    <input type="text" class="form-control" name="vehicle_brand" value="<?php echo (isset($park) ? $park->vehicle_brand : set_value('vehicle_brand')) ?>" <?php echo (isset($park) ? 'readonly' : '') ?>>
                    <?php echo form_error('vehicle_brand', '<div class="text-danger">', '</div>') ?>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="">Modelo veículo</label>
                    <input type="text" class="form-control" name="vehicle_model" value="<?php echo (isset($park) ? $park->vehicle_model : set_value('vehicle_model')) ?>" <?php echo (isset($park) ? 'readonly' : '') ?>>
                    <?php echo form_error('vehicle_model', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col mb-3">
                    <label for="">Data entrada</label>
                    <input type="text" class="form-control" name="entry_date" value="<?php echo (isset($park) ? formata_data_banco_com_hora($park->entry_date) : formata_data_banco_com_hora(date('y-m-d H:i:s'))) ?>" readonly="">
                  </div>

                  <div class="col mb-3">
                    <label for="">Data saída</label>
                    <?php if (isset($park) && $park->status == 1) : ?>
                      <input type="text" class="form-control" name="exit_date" value="<?php echo (isset($park) ? formata_data_banco_com_hora($park->exit_date) : formata_data_banco_com_hora(date('y-m-d H:i:s'))) ?>" readonly="">
                    <?php else : ?>
                      <input type="text" class="form-control" name="exit_date" value="<?php echo formata_data_banco_com_hora(date('y-m-d H:i:s')) . '&nbsp;|&nbsp;Em aberto' ?>" readonly="">
                    <?php endif; ?>

                    <?php echo form_error('entry_date', '<div class="text-danger">', '</div>') ?>
                  </div>

                  <div class="col mb-3">
                    <label for="">Tempo decorrido (horas e minutos)</label>

                    <?php
                    $entry_date = new DateTime(isset($park) ? $park->entry_date : date('Y-m-d H:i:s'));
                    $exit_date = new DateTime(date('Y-m-d H:i:s'));

                    $diff = $exit_date->diff($entry_date);

                    $hours = $diff->h;
                    $hours += ($diff->days * 24);

                    $elapsed_time = $hours . '.' . $diff->i; //Concatena as horas com os minutos

                    if (isset($park)) {
                      $value_owed = intval($park->value_hour) * $elapsed_time;
                    } else {
                      $value_owed = '0,00';
                    }
                    if (str_replace('.', '', $elapsed_time) <= '015') {

                      $value_owed = '0,00';
                    }
                    ?>
                    <input type="text" class="form-control" name="elapsed_time" value="<?php echo (isset($park) && $park->status == 1 ? ($park->elapsed_time) : $elapsed_time) ?>" readonly="">
                  </div>
                </div>
                <?php if (isset($park)) : ?>
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label for="">Valor devido</label>
                      <input type="text" class="form-control" name="value_owed" value="<?php echo (isset($park) && $park->status == 1 ? $park->value_owed : $value_owed) ?>" readonly="">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="">Forma de pagamento</label>
                      <select class="form-control select2" name="payment_method_id" <?php echo (isset($park) && $park->status == 1 ? 'disabled' : '') ?>>
                        <option value="">Escolha...</option>
                        <?php foreach ($payment_methods as $payment_method) : ?>
                          <?php if ($park) : ?>
                            <option value="<?php echo $payment_method->id; ?>" <?php echo ($payment_method->id == $park->payment_method_id ? 'selected' : "") ?>><?php echo $payment_method->name; ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('payment_method_id', '<div class="text-danger">', '</div>'); ?>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="">
                  <?php if (isset($park)) : ?>
                    <input type="hidden" name="id" value="<?php echo $park->id ?>" />
                  <?php endif; ?>
                  <?php if (isset($park) && $park->status == 1) : ?>
                    <button type="submit" class="btn btn-success mr-2 disabled" value="" disabled>Encerrada</button>
                  <?php else : ?>
                    <a title="Cadastrar ordem de estacionamento" href="javascript:void(0)" class="btn btn btn-primary mr-2" data-toggle="modal" data-target="#cadastrar">Encerrar</i></a>
                  <?php endif; ?>
                  <a href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-light">Voltar</a>
                </div>
                <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="demoModalLabel"><i class="ik ik-alert-octagon text-danger"></i>&nbsp;&nbsp;Confirmação de dados!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <span class="text-dark font-weight-bold"><?php echo $modal_text; ?></span></br>
                        <p></p>
                        Clique em <span class="text-primary font-weight-bold">"Sim"</span> para prosseguir.
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-primary mr-2" value="">Sim</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>