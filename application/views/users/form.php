<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-user bg-blue"></i>
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
                  <a data-toggle="tooltip" data-placement="bottom" title="Usuários cadastrados" href="<?php echo base_url('users') ?>">Usuários Cadastrados</a>
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
              <?php echo isset($user) ? '<i class="ik ik-calendar ik-2x"></i>&nbsp; Última atualização: ' . formata_data_banco_com_hora($user->updated_on) : '' ?>
            </div>
            <div class="card-body">
              <form class="forms-sample" name="form_user" method="POST">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" name="first_name" value="<?php echo (isset($user) ? $user->first_name : set_value('first_name')) ?>">
                    <?php echo form_error('first_name', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4">
                    <label>Sobrenome</label>
                    <input type="text" class="form-control" placeholder="Sobrenome" name="last_name" value="<?php echo (isset($user) ? $user->last_name : set_value('last_name')) ?>">
                    <?php echo form_error('last_name', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Usuário</label>
                    <input type="text" class="form-control" placeholder="Usuário" name="username" value="<?php echo (isset($user) ? $user->username : set_value('username')) ?>">
                    <?php echo form_error('username', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4">
                    <label>Email (Login)</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo (isset($user) ? $user->email : set_value('email')) ?>">
                    <?php echo form_error('email', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Senha</label>
                    <input type="password" class="form-control" placeholder="Senha" name="password" value="">
                    <?php echo form_error('password', '<div class="text-danger">', '</div>') ?>
                  </div>
                  <div class="col-md-4">
                    <label>Confirma senha</label>
                    <input type="password" class="form-control" placeholder="Confirma senha" name="confirm_password" value="">
                    <?php echo form_error('confirm_password', '<div class="text-danger">', '</div>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Perfil de acesso</label>
                    <select name="profile" class="form-control">
                      <option <?php echo isset($user_profile) && $user_profile->id == 2 ? 'selected' : ''; ?> value="2">Atendente</option>
                      <option <?php echo isset($user_profile) && $user_profile->id == 1 ? 'selected' : ''; ?> value="1">Administrador</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Ativo</label>
                    <select name="active" class="form-control">
                      <option <?php echo isset($user->active) && $user->active == 1 ? 'selected' : '' ?> value="1">Sim</option>
                      <option <?php echo isset($user->active) && $user->active == 0 ? 'selected' : '' ?> value="0">Não</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <input type="hidden" name="user_id" value="<?php echo isset($user) ? $user->id : 0 ?>">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                <a href="<?php echo base_url('users'); ?>" class="btn btn-secondary">Cancelar</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>