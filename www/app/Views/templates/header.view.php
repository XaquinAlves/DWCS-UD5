<!DOCTYPE html>
<html lang="en">
<head>
  <base href="<?php echo $_ENV['host.folder'] ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Select 2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed
    <?php echo (isset($_COOKIE['tema']) && $_COOKIE['tema'] == 'dark-mode') ? 'dark-mode' : '' ?>" >
<div class="wrapper"> 
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand
  <?php echo (isset($_COOKIE['tema']) && $_COOKIE['tema'] == 'dark-mode') ?
          'navbar-dark' : 'navbar-white navbar-light' ?> ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
        <li class="nav-item">
            <!-- Button trigger modal -->
            <button type="button" class="nav-link bg-transparent border-0" data-toggle="modal" data-target="#temaModal">
                <i class="fas fa-palette"></i>
            </button>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout" role="button">
          <i class="text-danger fas fa-sign-out-alt"></i>
        </a>        
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">DWES App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/panel/usuario" class="d-block"><?php echo $_SESSION['usuario']['nombre'] ?? 'Sin usuario' ?></a>
        </div>
      </div>
     <?php
        include $_ENV['folder.views'] . '/templates/left-menu.view.php';
        ?>      
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php
            echo $titulo ?? '' ?></h1>
          </div><!-- /.col -->
          <?php

            if (isset($breadcrumb) && is_array($breadcrumb)) {
                ?>          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <?php

                foreach ($breadcrumb as $b) {
                    ?>
              <li class="breadcrumb-item"><?php echo $b; ?></li>             
                    <?php
                }?>
            </ol>
          </div><!-- /.col -->
                <?php
            }
            ?>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
          <?php
            include $_ENV['folder.views'] . '/templates/flash-messages.php';
            ?>
          <!-- Modal -->
          <form method="post" action="/temas<?php echo $seccion ?? '' ?>">
              <div class="modal fade" id="temaModal" tabindex="-1" role="dialog" aria-labelledby="temaModalLabel"
                   aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="temaModalLabel">Escoja el tema</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <select name="tema" id="tema" class="form-control">
                                  <option value="default">Perdeterminado</option>
                                  <option value="dark-mode">Oscuro</option>
                              </select>
                          </div>
                          <div class="modal-footer">
                              <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-primary">Guardar</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
