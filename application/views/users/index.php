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
                <span><?php echo $subtitle ?></span>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a title="Home" href="<?php echo base_url('/') ?>"><i class="ik ik-home"></i></a>
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
            <div class="card-body">
              <table id="data_table" class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Usuário</th>
                    <th>E-mail</th>
                    <th>Nome</th>
                    <th>Ativo</th>
                    <th class="nosort">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($users as $user): ?>
                    <tr>
                      <td><?php echo $user->id; ?></td>
                      <td><?php echo $user->username; ?></td>
                      <td><?php echo $user->email; ?></td>
                      <td><?php echo $user->first_name; ?></td>
                      <td><?php echo $user->active; ?></td>
                      <td>
                        <a href="" class="btn btn-primary">Editar</a>
                        <a href="" class="btn btn-danger">Excluir</a>
                      </td>
                    </tr>
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