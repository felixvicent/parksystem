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
                  <a data-toggle="tooltip" data-placement="bottom" title="Mensalistas cadastrados" href="<?php echo base_url('monthly') ?>">Mensalistas</a>
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
              <?php echo isset($monthly) ? '<i class="ik ik-calendar ik-2x"></i>&nbsp; Última atualização: ' . formata_data_banco_com_hora($monthly->updated_on) : '' ?>
            </div>
            <div class="card-body">
              <form class="forms-sample" name="form_monthly" method="POST">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" name="first_name" value="<?php echo (isset($monthly) ? $monthly->first_name : set_value('first_name')) ?>">
                    <?php echo form_error('first_name', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-8">
                    <label>Sobrenome</label>
                    <input type="text" class="form-control" placeholder="Sobrenome" name="last_name" value="<?php echo (isset($monthly) ? $monthly->last_name : set_value('last_name')) ?>">
                    <?php echo form_error('last_name', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-2">
                    <label>Data de nascimento</label>
                    <input type="date" class="form-control" placeholder="Data de nascimento" name="birth_date" value="<?php echo (isset($monthly) ? $monthly->birth_date : set_value('birth_date')) ?>">
                    <?php echo form_error('birth_date', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>CPF</label>
                    <input type="text" class="form-control cpf" placeholder="CPF" name="cpf" value="<?php echo (isset($monthly) ? $monthly->cpf : set_value('cpf')) ?>">
                    <?php echo form_error('cpf', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>RG</label>
                    <input type="text" class="form-control" placeholder="RG" name="rg" value="<?php echo (isset($monthly) ? $monthly->rg : set_value('rg')) ?>">
                    <?php echo form_error('rg', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-6">
                    <label>E-mail</label>
                    <input type="email" class="form-control" placeholder="E-mail" name="email" value="<?php echo (isset($monthly) ? $monthly->email : set_value('email')) ?>">
                    <?php echo form_error('email', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-2">
                    <label>Telefone</label>
                    <input type="text" class="form-control phone_with_ddd" placeholder="Telefone" name="telephone" value="<?php echo (isset($monthly) ? $monthly->telephone : set_value('telephone')) ?>">
                    <?php echo form_error('telephone', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>Celular</label>
                    <input type="text" class="form-control sp_celphones" placeholder="Celular" name="cellphone" value="<?php echo (isset($monthly) ? $monthly->cellphone : set_value('cellphone')) ?>">
                    <?php echo form_error('cellphone', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>CEP</label>
                    <input type="text" class="form-control cep" placeholder="CEP" name="zip_code" value="<?php echo (isset($monthly) ? $monthly->zip_code : set_value('zip_code')) ?>">
                    <?php echo form_error('zip_code', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4">
                    <label>Endereço</label>
                    <input type="text" class="form-control" placeholder="Endereço" name="address" value="<?php echo (isset($monthly) ? $monthly->address : set_value('address')) ?>">
                    <?php echo form_error('address', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>Número</label>
                    <input type="number" class="form-control" placeholder="Número" name="number" value="<?php echo (isset($monthly) ? $monthly->number : set_value('number')) ?>">
                    <?php echo form_error('number', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-2">
                    <label>Bairro</label>
                    <input type="text" class="form-control" placeholder="Bairro" name="district" value="<?php echo (isset($monthly) ? $monthly->district : set_value('district')) ?>">
                    <?php echo form_error('district', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>Cidade</label>
                    <input type="text" class="form-control" placeholder="Cidade" name="city" value="<?php echo (isset($monthly) ? $monthly->city : set_value('city')) ?>">
                    <?php echo form_error('city', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-2">
                    <label>UF</label>
                    <input type="text" class="form-control uf" placeholder="UF" name="state" value="<?php echo (isset($monthly) ? $monthly->state : set_value('state')) ?>">
                    <?php echo form_error('state', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-6">
                    <label>Complemento</label>
                    <input type="text" class="form-control" placeholder="Complemento" name="complement" value="<?php echo (isset($monthly) ? $monthly->complement : set_value('complement')) ?>">
                    <?php echo form_error('complement', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-2">
                    <label>Ativo</label>
                    <select name="active" class="form-control">
                      <option <?php echo isset($monthly->active) && $monthly->active == 1 ? 'selected' : '' ?> value="1">Sim</option>
                      <option <?php echo isset($monthly->active) && $monthly->active == 0 ? 'selected' : '' ?> value="0">Não</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label>Dia vencimento mensalidade</label>
                    <input type="number" class="form-control" placeholder="Dia vencimento mensalidade" name="expiration" value="<?php echo (isset($monthly) ? $monthly->expiration : set_value('expiration')) ?>">
                    <?php echo form_error('expiration', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-8">
                    <label>Observações</label>
                    <textarea class="form-control" placeholder="Observações" name="obs"><?php echo (isset($monthly) ? $monthly->obs : set_value('obs')) ?></textarea>
                    <?php echo form_error('obs', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <input type="hidden" name="monthly_id" value="<?php echo isset($monthly) ? $monthly->id : 0 ?>">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                <a href="<?php echo base_url('monthly'); ?>" class="btn btn-secondary">Cancelar</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>