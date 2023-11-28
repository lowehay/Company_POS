<style>
  .card {
    width: 95%;
    margin: 10px auto;
  }

  h1 {
    margin-left: 50px;
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
    /* Fill the entire card body */
  }

  .card-body-content h5 {
    margin-bottom: 10px;
  }

  .card-body-content p {
    margin: 0;
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
</style>
<h1>Product Management</h1>
<div class="row mb-2">
  <div class="col-sm-6">
  </div>

</div>
<div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
  <div class="card-header" style="padding-top: 0;">
    <div class="row align-items-center">
      <div class="col-sm-6">

        <a href="<?php echo site_url('main/add_product'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-box"></i> Add Product</a>

      </div>
      <div class="col-sm-6">
        <form class="form-inline float-right">
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
          <div class="col-md-4 mb-3 product-card">
            <div class="cardni">
              <img src="<?php echo base_url('assets/images/' . $product_image); ?>" class="card-img-top" alt="Product Image" style="max-height: 300px;">
              <div class="card-body">
                <h5 class="card-title"><?php echo ucfirst($row->product_name); ?></h5>
                <p class="card-text">Product Code: <?php echo $row->product_code; ?></p>
                <p class="card-text">Price: ₱<?php echo $row->product_price; ?></p>

                <a href="<?php echo site_url('main/edit_product/' . $product_id); ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>

                <a href="<?php echo site_url('main/delete_product/' . $product_id); ?>" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
              </div>
            </div>
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
    const productCards = Array.from(document.querySelectorAll(".product-card"));

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
<script>
  const scrollToTopButton = document.createElement("button");
  scrollToTopButton.id = "scrollToTopButton";
  scrollToTopButton.innerText = "Scroll to Top";
  document.body.appendChild(scrollToTopButton);

  // Function to check if the user is at the very bottom of the page
  function isAtPageBottom() {
    return window.innerHeight + window.scrollY >= document.body.offsetHeight;
  }

  // Show or hide the button based on scroll position
  function toggleScrollToTopButton() {
    if (isAtPageBottom() || window.scrollY > 100) {
      scrollToTopButton.style.display = "block";
    } else {
      scrollToTopButton.style.display = "none";
    }
  }

  // Show or hide the button initially
  toggleScrollToTopButton();

  // Listen for scroll events to toggle the button
  window.addEventListener("scroll", toggleScrollToTopButton);

  // Scroll to the top when the button is clicked
  scrollToTopButton.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
</script>