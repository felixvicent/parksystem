<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-clipboard bg-blue"></i>
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
                  <a data-toggle="tooltip" data-placement="bottom" title="monthly cadastrados" href="<?php echo base_url('monthly_payment') ?>">Mensalistas</a>
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
              <?php echo isset($monthly_payment) ? '<i class="ik ik-calendar ik-2x"></i>&nbsp; Última atualização: ' . formata_data_banco_com_hora($monthly_payment->updated_on) : '' ?>
            </div>
            <div class="card-body">
              <form class="forms-sample" name="form_core" method="post">
                <div class="row mb-3">
                  <div class="col-md-8 mb-3">
                    <label for="">Mensalista</label>
                    <select class="form-control monthly select2" name="monthly_id" <?php echo (isset($monthly_payment) ? 'disabled' : ''); ?>>
                      <option value="">Escolha...</option>
                      <?php foreach ($monthly as $month) : ?>
                        <?php if (isset($monthly_payment)) : ?>
                          <option value="<?php echo $month->id . ' ' . $month->expiration ?>" <?php echo ($month->id == $monthly_payment->monthly_id ? 'selected' : '') ?>><?php echo $month->first_name . '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;CPF&nbsp&nbsp;' . $month->cpf; ?></option>
                        <?php else : ?>
                          <option value="<?php echo $month->id . ' ' . $month->expiration ?>"><?php echo $month->first_name . '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;CPF&nbsp&nbsp;' . $month->cpf; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('monthly_id', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="">Melhor dia de vencimento</label>
                    <input type="text" class="form-control expiration" name="monthy_expiration" value="<?php echo (isset($monthly_payment) ? $monthly_payment->monthly_expiration : set_value('monthly_expiration')) ?>" readonly="">
                    <?php echo form_error('monthly_expiration', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-8 mb-3">
                    <label for="">Categoria</label>
                    <select class="form-control pricing select2" name="pricing_id" <?php echo (isset($monthly_payment) && $monthly_payment->status == 1 ? 'disabled' : ''); ?>>
                      <option value="">Escolha...</option>
                      <?php foreach ($pricings as $pricing) : ?>
                        <?php if (isset($monthly_payment)) : ?>
                          <option value="<?php echo $pricing->id . ' ' . $pricing->value_month ?>" <?php echo ($pricing->id == $monthly_payment->pricing_id ? 'selected' : '') ?>><?php echo $pricing->category ?></option>
                        <?php else : ?>
                          <option value="<?php echo $pricing->id . ' ' . $pricing->value_month ?>"><?php echo $pricing->category ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('pricing_id', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="">Valor Mensalidade</label>
                    <input type="text" class="form-control monthly_value" name="monthly_value" value="<?php echo (isset($monthly_payment->monthly_value) ? $monthly_payment->monthly_value : '0,00') ?>" readonly="">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-4 mb-3">
                    <label for="">Data vencimento</label>
                    <input type="date" class="form-control" name="due_date" value="<?php echo (isset($monthly_payment) ? $monthly_payment->due_date : set_value('due_date')) ?>" <?php echo (isset($monthly_payment) ? 'disabled' : ''); ?>>
                    <?php echo form_error('due_date', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="">Situação</label>
                    <select class="form-control" name="mon$monthly_payment_status" <?php echo (isset($monthly_payment) && $monthly_payment->status == 1 ? 'disabled' : ''); ?>>
                      <?php if (isset($monthly_payment)) : ?>
                        <option value="0" <?php echo ($monthly_payment->status == 0 ? 'selected' : '') ?>>Pendente</option>
                        <option value="1" <?php echo ($monthly_payment->status == 1 ? 'selected' : '') ?>>Paga</option>
                      <?php else : ?>
                        <option value="0">Pendente</option>
                        <option value="1">Paga</option>
                      <?php endif; ?>
                    </select>
                  </div>
                  <?php if (isset($monthly_payment) && $monthly_payment->status == 1) : ?>
                    <div class="col-md-4 mb-3">
                      <label for="">Data do pagamento</label>
                      <input type="text" class="form-control" value="<?php echo formata_data_banco_com_hora($monthly_payment->payment_date); ?>" readonly="">
                    </div>
                  <?php endif; ?>
                </div>

                <?php if (isset($monthly_payment)) : ?>
                  <input type="hidden" name="monthly_payment_id" value="<?php echo $monthly_payment->id ?>" />
                <?php endif; ?>
                <input type="hidden" class="monthly_id" name="monthly_hidden_id" value="" />
                <input type="hidden" class="pricing_id" name="pricing_hidden_id" value="" />
                <?php if (isset($monthly_payment) && $monthly_payment->status == 1) : ?>
                  <button type="submit" class="btn btn-success mr-2" disabled="">Encerrada</button>
                <?php else : ?>
                  <a title="Cadastrar mensalidade" href="javascript:void(0)" class="btn btn btn-primary mr-2" data-toggle="modal" data-target="#monthly">Salvar</i></a>
                <?php endif; ?>
                <a href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-light">Voltar</a>
                <div class="modal fade" id="monthly" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="demoModalLabel"><i class="ik ik-alert-octagon text-danger"></i>&nbsp;&nbsp;Confirmação de dados!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <span class="text-dark font-weight-bold"><?php echo $modal_text; ?></span></br>
                        <p></p>
                        Clique em <span class="text-primary font-weight-bold">"Sim"</span> para salvar.
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