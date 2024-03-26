<style>
  .card {
    width: 95%;
    margin: 10px auto;
  }

  h4 {
    margin-left: 40px;
  }

  .row {
    margin-top: 10px;
    display: flex;
    flex-wrap: wrap;
  }

  .col-md-4 {
    display: flex;
    align-items: stretch;
  }

  .col-custom {
    flex: 0 0 20%;
    /* Set the width to 20% to display 5 cards per line */
    max-width: 20%;
  }

  .card-link {
    text-decoration: none;
    /* Remove default underline */
    color: inherit;
    /* Use the default text color */
  }

  .card-link:hover {
    text-decoration: none;
    /* Remove underline on hover */
    color: inherit;
    /* Use the default text color on hover */
  }

  .cardni {
    border: 5px solid #ccc;
    border-radius: 15px;
    flex: 1;
    display: flex;
    flex-direction: column;
    height: 100%;
    /* Set a fixed height for the product card content */
  }

  .cardni img {
    height: 300px;
    /* Set a default height for all product images */
    object-fit: cover;
    /* Crop or fit the image within the specified dimensions */
  }

  /* Media query for mobile screens */
  @media (max-width: 768px) {
    .cardni img {
      height: auto;
      /* Allow the image's natural height on smaller screens */
      max-height: 200px;
      /* Set a maximum height for mobile screens */

    }
  }

  .card-body {
    flex: 1;
    overflow: hidden;
    height: 100%;
    /* Set a fixed height for the card body */
  }

  .card-body-content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    align-items: center;
    /* Center the content horizontally */
  }

  .card-body-content h5,
  .card-body-content p {
    text-align: center;
    /* Center the text horizontally */
  }

  .card-body-content .btn {
    margin-top: 5px;
    /* Adjust the top margin to bring buttons closer */
  }

  .card-body-content .btn-group {
    display: flex;
    flex-direction: row;
    justify-content: center;
    width: 100%;
  }

  .card-body-content .btn-group .btn:not(:last-child) {
    margin-right: 10px;
    /* Add right margin to separate buttons */
  }


  .btn:link,
  .btn:visited {
    text-transform: uppercase;
    text-decoration: none;
    padding: 15px 40px;
    display: inline-block;
    transition: all .2s;
  }

  .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  }

  .btn:active {
    transform: translateY(-1px);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  }

  .btn-white {
    background-color: #fff;
    color: #777;
  }

  .btn::after {
    content: "";
    display: inline-block;
    height: 100%;
    width: 100%;
    border-radius: 100px;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    transition: all .4s;
  }

  .btn-white::after {
    background-color: #fff;
  }

  .btn:hover::after {
    transform: scaleX(1.4) scaleY(1.6);
    opacity: 0;
  }

  .btn-animated {
    animation: moveInBottom 5s ease-out;
    animation-fill-mode: backwards;
  }

  @keyframes moveInBottom {
    0% {
      opacity: 0;
      transform: translateY(30px);
    }

    100% {
      opacity: 1;
      transform: translateY(0px);
    }

  }

  .cardni:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    border: 1px solid #ccc;
    transition: transform 0.3s, box-shadow 0.3s, border 0.3s;
  }

  /* Add styles for the scroll to top button */
  #scrollToTopButton {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    cursor: pointer;
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 50%;
    padding: 10px;
    font-size: 16px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }

  #scrollToTopButton:hover {
    background-color: #0056b3;
  }

  #editbtn {
    background-color: #0000;
  }

  .test {
    background-color: DodgerBlue;
    width: 100%;

  }
</style>
<h4>Product Management</h4>
<div class="row mb-2">
  <div class="col-sm-6">
  </div>
  <h1 class="m-0 text-dark">
    <a href="<?php echo site_url('main/product'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-boxes"></i> Products</a>
    <a href="<?php echo site_url('main/product_category'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-list"></i> Product Category</a>
    <a href="<?php echo site_url('main/unit'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-barcode"></i> Unit Management</a>
  </h1>

</div>
<div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
  <div class="card-header" style="padding-top: 0;">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <a href="<?php echo site_url('main/add_product'); ?>" class="btn btn-dark btn-sm"><i class="fas fa-box"></i> Add Product 1</a>
      </div>
      <div class="col-sm-6 d-flex justify-content-end align-items-center">
        <a id="switchLayoutButton" class="btn btn-secondary btn-sm text-white"><i class="fas fa-list"></i></a>
        <form class="form-inline ml-3">
          <div class="input-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Search Product">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row" id="productContainer">
      <?php
      if (isset($result) && !empty($result)) {
        foreach ($result as $key => $row) {
          $product_id = $row->product_id;
          $product_image = $row->product_image; // Assuming 'product_image' is the column name for the image filename
      ?>

          <div class="col-custom mb-3 product-card">
            <a href="<?php echo site_url('main/view_product/' . $product_id); ?>" class="card-link">
              <div class="cardni">
                <img src="<?php echo base_url('assets/images/' . $product_image); ?>" class="card-img-top" alt="Product Image" style="max-height: 300px;">
                <div class="card-body">
                  <div class="card-body-content">
                    <div class="container" id="test">
                      <h5 id="change" class="card-title"><?php echo ucfirst($row->product_name); ?></h5>
                    </div>

                    <p class="card-text">Product Code: <?php echo $row->product_code; ?></p>
                    <p class="card-text">Price: ₱<?php echo $row->product_price; ?></p>
                    <div class="btn-group">
                      <a href="<?php echo site_url('main/edit_product/' . $product_id); ?>" class="btn btn-dark btn-sm"><i class="fas fa-edit"></i> Edit</a>
                      <a href="<?php echo site_url('main/delete_product/' . $product_id); ?>" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                    </div>
                  </div>
                </div>

              </div>
            </a>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
</div>
<button id="scrollToTopButton">
  <i class="fas fa-arrow-up"></i>
</button>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const productContainer = document.getElementById("productContainer");
    const productCards = Array.from(document.querySelectorAll(".product-card"));

    // Initialize DataTable when the button is clicked
    document.getElementById("switchLayoutButton").addEventListener("click", function() {
      if ($.fn.dataTable.isDataTable("#productTable")) {
        // DataTable is already initialized, destroy it
        $("#productTable").DataTable().destroy();
        productContainer.innerHTML = ""; // Clear the product container
        // Rebuild the card layout (you may need to modify this part based on your actual data)
        productCards.forEach(function(productCard) {
          productContainer.appendChild(productCard);
        });
      } else {
        // Initialize DataTable with Bootstrap styling
        $("#productContainer").html('<table id="productTable" class="table table-striped table-bordered" style="width:100%"></table>');
        const dataTable = $("#productTable").DataTable({
          // DataTable configuration options go here
          // You may need to customize this based on your actual data
          columns: [{
              title: "Product Code"
            },
            {
              title: "Product Name"
            },
            {
              title: "Price"
            },
            {
              title: "Actions",
              render: function(data, type, row, meta) {
                const productId = productCards[meta.row].querySelector(".card-link").getAttribute("href").split('/').pop();
                return `
                <div class="btn-group">
                  <a href="<?php echo site_url('main/edit_product/'); ?>${productId}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                  <a href="<?php echo site_url('main/delete_product/'); ?>${productId}" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                </div>
              `;
              },
            },
          ],
        });

        // Populate DataTable with existing data
        productCards.forEach(function(productCard) {
          const productCode = productCard.querySelector(".card-text:nth-child(2)").textContent;
          const productName = productCard.querySelector(".card-title").textContent;
          const productPrice = productCard.querySelector(".card-text:nth-child(3)").textContent;

          dataTable.row.add([productCode, productName, productPrice, "..."]).draw();
        });
      }
    });

    searchInput.addEventListener("input", function() {
      const searchTerm = searchInput.value.trim().toLowerCase();

      productCards.forEach(function(productCard) {
        const productName = productCard.querySelector(".card-title").textContent.toLowerCase();
        if (productName.includes(searchTerm) || productName === searchTerm) {
          productCard.style.display = "block"; // Show matching products
        } else {
          productCard.style.display = "none"; // Hide non-matching products
        }
      });
    });
  });
  $(document).ready(function() {
    <?php if ($this->session->flashdata('success')) { ?>
      toastr.success('<?php echo $this->session->flashdata('success'); ?>');
    <?php } elseif ($this->session->flashdata('error')) { ?>
      toastr.error('<?php echo $this->session->flashdata('error'); ?>');
    <?php } ?>
  });
</script>