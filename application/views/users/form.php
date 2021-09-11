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
              <?php echo isset($user) ? '<i class="ik ik-calendar ik-2x"></i>&nbsp; Última atualização: '. formata_data_banco_com_hora($user->updated_on) : '' ?>
            </div>
            <div class="card-body">
              <form class="forms-sample" name="form_user" method="POST">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" name="first_name" value="<?php echo (isset($user) ? $user->first_name : set_value('first_name')) ?>">
                  </div>
                  <div class="col-md-4">
                    <label>Sobrenome</label>
                    <input type="text" class="form-control" placeholder="Sobrenome" name="last_name" value="<?php echo (isset($user) ? $user->last_name : set_value('last_name')) ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Usuário</label>
                    <input type="text" class="form-control" placeholder="Usuário" name="username" value="<?php echo (isset($user) ? $user->username : set_value('username')) ?>">
                  </div>
                  <div class="col-md-4">
                    <label>Email (Login)</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo (isset($user) ? $user->email : set_value('email')) ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Senha</label>
                    <input type="password" class="form-control" placeholder="Senha" name="password" value="">
                  </div>
                  <div class="col-md-4">
                    <label>Confirma senha</label>
                    <input type="password" class="form-control" placeholder="Confirma senha" name="confirm_password" value="">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Perfil de acesso</label>
                    <select name="profile" class="form-control">
                      <option value="2">Atendente</option>
                      <option value="1">Administrador</option>
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
                <div class="form-group">
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input">
                    <span class="custom-control-label">&nbsp;Remember me</span>
                  </label>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>