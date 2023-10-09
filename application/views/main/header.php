<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
  <!-- Include DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/toastr.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/toastr.css">
  <title>FISH PORT</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2a3b57;">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url('main/landingpage') ?>">
        <i class="fas fa-fish"></i> FISH PORT
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li>
          <span id="datetime" class="navbar-text"></span> 
        </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('main/user') ?>">User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url('main/product') ?>">Product</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-user"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">User Profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li><a class="dropdown-item" href="<?= base_url('port') ?>">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <script>
  function updateDateTime() {
    const datetimeElement = document.getElementById("datetime");
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    const currentDateTime = new Date().toLocaleDateString(undefined, options);
    datetimeElement.textContent = currentDateTime;
  }

  // Update the date and time immediately and then every second
  updateDateTime();
  setInterval(updateDateTime, 1000);
</script>
