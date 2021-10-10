<div class="app-sidebar colored">
  <div class="sidebar-header">
    <a class="header-brand" href="index.html">
      <div class="logo-img">
        <!-- <img src="src/img/brand-white.svg" class="header-brand-img" alt="lavalite"> -->
      </div>
      <span class="text">Park Now</span>
    </a>
    <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
    <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
  </div>

  <div class="sidebar-content">
    <div class="nav-container">
      <nav id="main-menu-navigation" class="navigation-main">
        <div class="nav-lavel">Park Now</div>
        <div class="nav-item <?php echo ($this->router->fetch_class() == 'home' ? 'active' : '') ?>">
          <a href="<?php echo base_url('home') ?>"><i class="ik ik-home"></i><span>Home</span></a>
        </div>
        <div class="nav-item <?php echo ($this->router->fetch_class() == 'monthly' ? 'active' : '') ?>">
          <a href="<?php echo base_url('monthly') ?>"><i class="ik ik-clipboard"></i><span>Mensalistas</span></a>
        </div>
        <div class="nav-item <?php echo ($this->router->fetch_class() == 'monthly_payments' ? 'active' : '') ?>">
          <a href="<?php echo base_url('monthly_payments') ?>"><i class="ik ik-file-text"></i><span>Mensalidades</span></a>
        </div>


        <div class="nav-lavel">Administração</div>
        <div class="nav-item <?php echo ($this->router->fetch_class() == 'pricings' ? 'active' : '') ?>">
          <a href="<?php echo base_url('pricings') ?>"><i class="ik ik-dollar-sign"></i><span>Precificações</span></a>
        </div>
        <div class="nav-item <?php echo ($this->router->fetch_class() == 'payments' ? 'active' : '') ?>">
          <a href="<?php echo base_url('payments') ?>"><i class="ik ik-credit-card"></i><span>Formas de pagamentos</span></a>
        </div>

        <div class="nav-item <?php echo ($this->router->fetch_class() == 'users' ? 'active' : '') ?>">
          <a href="<?php echo base_url('users') ?>"><i class="ik ik-users"></i><span>Usuários</span></a>
        </div>
        <div class="nav-item <?php echo ($this->router->fetch_class() == 'systema' ? 'active' : '') ?>">
          <a href="<?php echo base_url('systema') ?>"><i class="ik ik-settings"></i><span>Sistema</span></a>
        </div>
      </nav>
    </div>
  </div>
</div>