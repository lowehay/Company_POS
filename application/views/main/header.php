<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/toastr.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/toastr.css">
  <title>FISH PORT</title>
</head>
<style>
  @import url('https://fonts.googleapis.com/css?family=Palanquin Dark:700|Palanquin Dark:400');

  body {
    font-family: 'Palanquin Dark';
    font-weight: 400;
  }

  h1,
  h2,
  h3,
  h4,
  h5 {
    font-family: 'Palanquin Dark';
    font-weight: 700;
  }

  html {
    font-size: 100%;
  }

  /* 16px */

  h1 {
    font-size: 4.210rem;
    /* 67.36px */
  }

  h2 {
    font-size: 3.158rem;
    /* 50.56px */
  }

  h3 {
    font-size: 2.369rem;
    /* 37.92px */
  }

  h4 {
    font-size: 1.777rem;
    /* 28.48px */
  }

  h5 {
    font-size: 1.333rem;
    /* 21.28px */
  }

  small {
    font-size: 0.750rem;
    /* 12px */
  }

  body {
    background-color: #FFFBE9;
  }

  /* For Webkit-based browsers (Chrome, Safari) */
  ::-webkit-scrollbar {
    width: 12px;
    /* Width of the scrollbar */
  }

  ::-webkit-scrollbar-track {
    background: #fff;
    /* Color of the track */
  }

  ::-webkit-scrollbar-thumb {
    background: #ccc;
    /* Color of the thumb */
    border-radius: 6px;
    /* Rounded corners */
  }
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #AD8B73">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url('main') ?>">
        <i class="fas fa-envelope"></i> COMPANY
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('main/user') ?>">User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('main/supplier') ?>">Supplier</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('main/product') ?>">Product</a>
          </li>
          <!-- Add more navigation items here -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <span style="color: white;">Purchase</span>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= base_url('main/purchase_order') ?>">Purchase Order</a></li>
              <li><a class="dropdown-item" href="<?= base_url('main/goods_received') ?>">Goods Received</a></li>
              <li><a class="dropdown-item" href="<?= base_url('main/back_order') ?>">Back Order</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <span style="color: white;">Inventory</span>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= base_url('main/inventory_adjustment') ?>">Inventory Adjustment</a></li>
              <li><a class="dropdown-item" href="<?= base_url('main/inventory_ledger') ?>">Inventory Ledger</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('main/stock_requisition') ?>">Stock Requisition</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('main/pos') ?>">POS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('main/reports') ?>">Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('main/backup') ?>">Backup & Restore</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">User Profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="<?= base_url('port') ?>">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>

</html>