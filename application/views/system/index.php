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
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <?php echo isset($system) ? '<i class="ik ik-calendar ik-2x"></i>&nbsp; Última atualização: ' . formata_data_banco_com_hora($system->data_alteracao) : '' ?>
            </div>
            <div class="card-body">
              <form class="forms-sample" name="form_system" method="POST">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label>Razão social</label>
                    <input type="text" class="form-control" placeholder="Razão social" name="razao_social" value="<?php echo (isset($system) ? $system->razao_social : set_value('razao_social')) ?>">
                    <?php echo form_error('razao_social', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-6">
                    <label>Nome fantasia</label>
                    <input type="text" class="form-control" placeholder="Nome fantasia" name="nome_fantasia" value="<?php echo (isset($system) ? $system->nome_fantasia : set_value('nome_fantasia')) ?>">
                    <?php echo form_error('nome_fantasia', '<div class="text-danger">', '</div>') ?>
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
                    <input type="text" class="form-control phone_with_ddd" placeholder="Telefone fixo" name="telefone_fixo" value="<?php echo (isset($system) ? $system->telefone_fixo : set_value('telefone_fixo')) ?>">
                    <?php echo form_error('telefone_fixo', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-3">
                    <label>Telefone movel</label>
                    <input type="text" class="form-control sp_celphones" placeholder="Telefone movel" name="telefone_movel" value="<?php echo (isset($system) ? $system->telefone_movel : set_value('telefone_movel')) ?>">
                    <?php echo form_error('telefone_movel', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-2">
                    <label>CEP</label>
                    <input type="text" class="form-control cep" placeholder="CEP" name="cep" value="<?php echo (isset($system) ? $system->cep : set_value('cep')) ?>">
                    <?php echo form_error('cep', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4">
                    <label>Endereço</label>
                    <input type="text" class="form-control" placeholder="Endereço" name="endereco" value="<?php echo (isset($system) ? $system->endereco : set_value('endereco')) ?>">
                    <?php echo form_error('endereco', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>Número</label>
                    <input type="text" class="form-control" placeholder="Número" name="numero" value="<?php echo (isset($system) ? $system->numero : set_value('numero')) ?>">
                    <?php echo form_error('numero', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-3">
                    <label>Cidade</label>
                    <input type="text" class="form-control" placeholder="Cidade" name="cidade" value="<?php echo (isset($system) ? $system->cidade : set_value('cidade')) ?>">
                    <?php echo form_error('cidade', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-1">
                    <label>UF</label>
                    <input type="text" class="form-control uf" placeholder="UF" name="estado" value="<?php echo (isset($system) ? $system->estado : set_value('estado')) ?>">
                    <?php echo form_error('estado', '<div class="text-danger">', '</div>') ?>
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