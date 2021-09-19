<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-settings bg-blue"></i>
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
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <?php if ($message = $this->session->flashdata('sucesso')) : ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-success bg-success alert-dismissible text-white fade show" role="alert">
              <i class="ik ik-alert-circle"></i>&nbsp;
              <strong><?php echo $message ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ik ik-x"></i>
              </button>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <?php echo isset($system) ? '<i class="ik ik-calendar ik-2x"></i>&nbsp; Última atualização: ' . formata_data_banco_com_hora($system->updated_on) : '' ?>
            </div>
            <div class="card-body">
              <form class="forms-sample" name="form_system" method="POST">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label>Razão social</label>
                    <input type="text" class="form-control" placeholder="Razão social" name="name_social" value="<?php echo (isset($system) ? $system->name_social : set_value('name_social')) ?>">
                    <?php echo form_error('name_social', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-6">
                    <label>Nome fantasia</label>
                    <input type="text" class="form-control" placeholder="Nome fantasia" name="name_fantasy" value="<?php echo (isset($system) ? $system->name_fantasy : set_value('name_fantasy')) ?>">
                    <?php echo form_error('name_fantasy', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3">
                    <label>CNPJ</label>
                    <input type="text" class="form-control cnpj" placeholder="CNPJ" name="cnpj" value="<?php echo (isset($system) ? $system->cnpj : set_value('cnpj')) ?>">
                    <?php echo form_error('cnpj', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-3">
                    <label>Inscrição estadual</label>
                    <input type="text" class="form-control" placeholder="Inscrição Estadual" name="ie" value="<?php echo (isset($system) ? $system->ie : set_value('ie')) ?>">
                    <?php echo form_error('ie', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-3">
                    <label>Telefone fixo</label>
                    <input type="text" class="form-control phone_with_ddd" placeholder="Telefone fixo" name="telephone" value="<?php echo (isset($system) ? $system->telephone : set_value('telephone')) ?>">
                    <?php echo form_error('telephone', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-3">
                    <label>Telefone movel</label>
                    <input type="text" class="form-control sp_celphones" placeholder="Telefone movel" name="cellphone" value="<?php echo (isset($system) ? $system->cellphone : set_value('cellphone')) ?>">
                    <?php echo form_error('cellphone', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-2">
                    <label>CEP</label>
                    <input type="text" class="form-control cep" placeholder="CEP" name="zip_code" value="<?php echo (isset($system) ? $system->zip_code : set_value('zip_code')) ?>">
                    <?php echo form_error('zip_code', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4">
                    <label>Endereço</label>
                    <input type="text" class="form-control" placeholder="Endereço" name="address" value="<?php echo (isset($system) ? $system->address : set_value('address')) ?>">
                    <?php echo form_error('address', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>Número</label>
                    <input type="text" class="form-control" placeholder="Número" name="number" value="<?php echo (isset($system) ? $system->number : set_value('number')) ?>">
                    <?php echo form_error('number', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-3">
                    <label>Cidade</label>
                    <input type="text" class="form-control" placeholder="Cidade" name="city" value="<?php echo (isset($system) ? $system->city : set_value('city')) ?>">
                    <?php echo form_error('city', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-1">
                    <label>UF</label>
                    <input type="text" class="form-control uf" placeholder="UF" name="state" value="<?php echo (isset($system) ? $system->state : set_value('state')) ?>">
                    <?php echo form_error('state', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label>URL do site</label>
                    <input type="text" class="form-control" placeholder="URL do site" name="site_url" value="<?php echo (isset($system) ? $system->site_url : set_value('site_url')) ?>">
                    <?php echo form_error('site_url', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-6">
                    <label>E-mail de contato</label>
                    <input type="text" class="form-control" placeholder="E-mail de contato" name="email" value="<?php echo (isset($system) ? $system->email : set_value('email')) ?>">
                    <?php echo form_error('email', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label>URL do site</label>
                    <textarea class="form-control" placeholder="URL do site" name="txt_ticket"><?php echo (isset($system) ? $system->txt_ticket : set_value('txt_ticket')); ?></textarea>
                    <?php echo form_error('txt_ticket', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                <a href="<?php echo base_url('home'); ?>" class="btn btn-secondary">Cancelar</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>