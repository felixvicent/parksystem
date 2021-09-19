<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-credit-card bg-blue"></i>
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
              <a data-toggle="tooltip" data-placement="bottom" title="Cadastrar forma de pagamento" href="<?php echo base_url('payments/form') ?>" class="btn bg-blue float-right text-white">Novo</a>
            </div>
            <div class="card-body">
              <table class="table data_table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ativo</th>
                    <th class="nosort text-right pr-25">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($payments as $payment) : ?>
                    <tr>
                      <td><?php echo $payment->id; ?></td>
                      <td><?php echo $payment->name; ?></td>
                      <td><?php echo ($payment->active == 1 ? '<span class="badge badge-pill badge-success"><i class="ik ik-unlock"></i>&nbsp;Sim</span>' : '<span class="badge badge-pill badge-warning"><i class="ik ik-lock"></i>&nbsp;Não</span>'); ?></td>
                      <td class="text-right">
                        <a data-toggle="tooltip" data-placement="bottom" title="Editar forma de pagamento" href="<?php echo base_url('payments/form/' . $payment->id) ?>" class="btn btn-icon btn-primary"><i class="ik ik-edit-2"></i></a>
                        <button type="button" data-toggle="modal" data-target="#payment-<?php echo $payment->id; ?>" class="btn btn-icon btn-danger"><i class="ik ik-trash-2"></i></a>
                      </td>
                    </tr>
                    <div class="modal fade" id="payment-<?php echo $payment->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterLabel"><i class="ik ik-alert-circle"></i>&nbsp; Tem certeza da exclusão do registro?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <p>Deseja realmente excluir a forma de pagamento <?php echo $payment->name ?></p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não, voltar</button>
                            <a href="<?php echo base_url('payments/delete/' . $payment->id); ?>" class="btn btn-danger">Sim, excluir</a>
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