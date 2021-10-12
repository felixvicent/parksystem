<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-file-text bg-blue"></i>
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
              <a data-toggle="tooltip" data-placement="bottom" title="Cadastrar ticket" href="<?php echo base_url('park/form') ?>" class="btn bg-blue float-right text-white">Novo</a>
            </div>
            <div class="card-body">
              <table class="table data_table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Categoria</th>
                    <th>Valor hora</th>
                    <th>Placa</th>
                    <th>Forma de pagamento</th>
                    <th>Status</th>
                    <th class="nosort text-right pr-25">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($parks as $park) : ?>
                    <tr>
                      <td><?php echo $park->park_id; ?></td>
                      <td><i class="ik ik-eye">&nbsp;</i><a href="<?php echo base_url('pricings/form/' . $park->pricing_id) ?>"><?php echo $park->category; ?></a></td>
                      <td><?php echo $park->value_hour; ?></td>
                      <td><?php echo $park->vehicle_plate; ?></td>
                      <td><i class="ik ik-eye">&nbsp;</i><a href="<?php echo base_url('payments/form/' . $park->payment_method_id) ?>"><?php echo $park->status == 1 ? $park->name : 'Em aberto'; ?></td>
                      <td><?php echo ($park->status == 1 ? '<span class="badge badge-pill badge-success">Paga</span>' : '<span class="badge badge-pill badge-warning">Aberta</span>'); ?></td>
                      <td class="text-right">
                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo $park->status == 1 ? 'Ver ticket' : 'Encerrar ticket' ?>" href=" <?php echo base_url('park/form/' . $park->park_id) ?>" class="btn btn-icon btn-primary"><?php echo $park->status == 1 ? '<i class="ik ik-eye">' : '<i class="ik ik-check">' ?></i></a>
                        <button type="button" data-toggle="modal" data-target="#park-<?php echo $park->park_id; ?>" class="btn btn-icon btn-danger"><i class="ik ik-trash-2"></i></a>
                      </td>
                    </tr>
                    <div class="modal fade" id="park-<?php echo $park->park_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterLabel"><i class="ik ik-alert-circle"></i>&nbsp; Tem certeza da exclusão do registro?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <p>Deseja realmente excluir o estacionamento de <?php echo $park->vehicle_plate ?></p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não, voltar</button>
                            <a href="<?php echo base_url('park_payments/delete/' . $park->park_id); ?>" class="btn btn-danger">Sim, excluir</a>
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