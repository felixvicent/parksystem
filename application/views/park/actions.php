<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">
  <?php $this->load->view('layout/sidebar'); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="fas fa-parking bg-blue"></i>
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

      <div class="row">
        <div class="col-xl-4 col-md-12">
          <div class="card comp-card">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="mb-25">Imprimir</h6>
                  <a class="btn bg-blue text-white" href="<?php echo base_url('park/pdf/' . $park->id) ?>">Imprimir</a>
                </div>
                <div class="col-auto">
                  <i class="fas fa-print bg-blue"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card comp-card">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="mb-25">Listar tickets</h6>
                  <a class="btn bg-green text-white" href="<?php echo base_url('park/') ?>">Listar</a>
                </div>
                <div class="col-auto">
                  <i class="fas fa-list-ol bg-green"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card comp-card">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="mb-25">Novo ticket</h6>
                  <a class="btn bg-yellow text-white" href="<?php echo base_url('park/form') ?>">Novo</a>
                </div>
                <div class="col-auto">
                  <i class="fas fa-plus bg-yellow"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>