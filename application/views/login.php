<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <title>COMPANY</title>
  <style>
    body {
      background-image: url(<?php echo base_url('assets/images/bg.jpg'); ?>);
      background-position: center;
      /* Center the image */
      background-repeat: no-repeat;
      /* Do not repeat the image */
      background-size: cover;
      height: 100vh;
      /* Set the height to viewport height */
    }

    .card {
      border: none;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      background-color: rgba(255, 255, 255, 0.9);
      /* Light background color with transparency */
    }

    .card-header {
      background-color: #AD8B73;
      /* Remove Bootstrap's default background-color */
      color: white;
      font-weight: bold;
      text-align: center;
      padding: 15px;
      /* Increased padding for header */
      font-size: 30px;
    }

    .card-body {
      padding: 15px;
      display: flex;
      /* Use flexbox to align items horizontally */
      align-items: center;
      /* Center items vertically */
    }

    .form-label {
      font-weight: bold;
    }

    /* Increase the input field width */
    .form-control {
      width: 100%;
    }

    .btn-primary {
      background-color: #AD8B73;
      /* Button background color */
      border: none;
      width: 100%;
    }

    .btn-primary:hover {
      background-color: #836855;
      /* Hover color */
    }

    /* Style for the logo div */
    .logo {
      flex: 1;
      /* Take up remaining space */
      text-align: center;
      margin-right: 17px;
      max-width: 100%;
    }

    .logo img {
      max-width: 250px;
      /* Adjust the logo size as needed */
      height: auto;
    }
  </style>
</head>

<body>
  <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="col-md-6">
      <!-- Increase the card size -->
      <div class="card">
        <div class="card-header">
          WELCOME
        </div>
        <div class="card-body">
          <!-- Logo div -->
          <div class="logo">
            <img src="<?php echo base_url('assets/images/company.png'); ?>" alt="Company Logo">
          </div>
          <form method="post" autocomplete="off" action="<?= base_url('port/loginNow') ?>" style="flex: 2;">
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">LOGIN</button>
            </div>
            <?php
            if ($this->session->flashdata('error')) { ?>
              <p class="text-danger text-center" style="margin-top: 10px;">
                <?= $this->session->flashdata('error') ?>
              </p>
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>