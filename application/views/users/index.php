<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-users bg-blue"></i>
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
              <i class="ik ik-check-circle"></i>&nbsp;
              <strong><?php echo $message ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ik ik-x"></i>
              </button>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($message = $this->session->flashdata('error')) : ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger bg-danger alert-dismissible text-white fade show" role="alert">
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
            <div class="card-header d-block">
              <a data-toggle="tooltip" data-placement="bottom" title="Cadastrar usu??rio" href="<?php echo base_url('users/form') ?>" class="btn bg-blue float-right text-white">Novo</a>
            </div>
            <div class="card-body">
              <table class="table data_table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Usu??rio</th>
                    <th>E-mail</th>
                    <th>Nome</th>
                    <th>Perfil de acesso</th>
                    <th>Ativo</th>
                    <th class="nosort text-right pr-25">A????es</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $user) : ?>
                    <tr>
                      <td><?php echo $user->id; ?></td>
                      <td><?php echo $user->username; ?></td>
                      <td><?php echo $user->email; ?></td>
                      <td><?php echo $user->first_name; ?></td>
                      <td><?php echo ($this->ion_auth->is_admin($user->id) ? 'Administrador' : 'Atendente'); ?></td>
                      <td><?php echo ($user->active == 1 ? '<span class="badge badge-pill badge-success"><i class="ik ik-unlock"></i>&nbsp;Sim</span>' : '<span class="badge badge-pill badge-warning"><i class="ik ik-lock"></i>&nbsp;N??o</span>'); ?></td>
                      <td class="text-right">
                        <a data-toggle="tooltip" data-placement="bottom" title="Editar usu??rios" href="<?php echo base_url('users/form/' . $user->id) ?>" class="btn btn-icon btn-primary"><i class="ik ik-edit-2"></i></a>
                        <button type="button" data-toggle="modal" data-target="#user-<?php echo $user->id; ?>" class="btn btn-icon btn-danger"><i class="ik ik-trash-2"></i></a>
                      </td>
                    </tr>
                    <div class="modal fade" id="user-<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterLabel"><i class="ik ik-alert-circle"></i>&nbsp; Tem certeza da exclus??o do registro?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <p>Deseja realmente excluir o usu??rio <?php echo $user->username ?></p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">N??o, voltar</button>
                            <a href="<?php echo base_url('users/delete/' . $user->id); ?>" class="btn btn-danger">Sim, excluir</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>