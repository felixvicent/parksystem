<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-dollar-sign bg-blue"></i>
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
                  <a data-toggle="tooltip" data-placement="bottom" title="Precificações" href="<?php echo base_url('pricings') ?>">Precificações</a>
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
              <?php echo isset($pricing) ? '<i class="ik ik-calendar ik-2x"></i>&nbsp; Última atualização: ' . formata_data_banco_com_hora($pricing->updated_on) : '' ?>
            </div>
            <div class="card-body">
              <form class="forms-sample" name="form_pricing" method="POST">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Categoria</label>
                    <input type="text" class="form-control" placeholder="Categoria" name="category" value="<?php echo (isset($pricing) ? $pricing->category : set_value('category')) ?>">
                    <?php echo form_error('category', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>Valor hora</label>
                    <input type="text" class="form-control money" placeholder="Valor hora" name="value_hour" value="<?php echo (isset($pricing) ? $pricing->value_hour : set_value('value_hour')) ?>">
                    <?php echo form_error('value_hour', '<div class="text-danger">', '</div>') ?>
                  </div>

                  <div class="col-md-2">
                    <label>Valor mensalidade</label>
                    <input type="text" class="form-control money" placeholder="Valor mensalidade" name="value_month" value="<?php echo (isset($pricing) ? $pricing->value_month : set_value('value_month')) ?>">
                    <?php echo form_error('value_month', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>Número de vagas</label>
                    <input type="number" class="form-control" placeholder="Número de vagas" name="number_vacancies" value="<?php echo (isset($pricing) ? $pricing->number_vacancies : set_value('number_vacancies')) ?>">
                    <?php echo form_error('number_vacancies', '<div class="text-danger">', '</div>') ?>
                  </div>

                  <div class="col-md-2">
                    <label>Ativo</label>
                    <select name="active" class="form-control">
                      <option <?php echo isset($pricing->active) && $pricing->active == 0 ? 'selected' : '' ?> value="0">Não</option>
                      <option <?php echo isset($pricing->active) && $pricing->active == 1 ? 'selected' : '' ?> value="1">Sim</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <input type="hidden" name="pricing_id" value="<?php echo isset($pricing) ? $pricing->id : 0 ?>">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                <a href="<?php echo base_url('pricings'); ?>" class="btn btn-secondary">Cancelar</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>