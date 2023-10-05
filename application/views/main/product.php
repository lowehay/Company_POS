  <style>
    .card {
      width: 95%;
      /* Adjust the width as needed */
      margin: 0 auto;
      /* Center the card on the page horizontally */
    }

    .row {
      margin-top: 10px;
    }
  button {
  position: relative;
  border: none;
  background: transparent;
  padding: 0;
  cursor: pointer;
  outline-offset: 4px;
  transition: filter 250ms;
  user-select: none;
  touch-action: manipulation;
}

.shadow {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 12px;
  background: hsl(0deg 0% 0% / 0.25);
  will-change: transform;
  transform: translateY(2px);
  transition: transform 600ms cubic-bezier(.3, .7, .4, 1);
}

.edge {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 12px;
  background: linear-gradient(
    to left,
    #2B24D0, /* Change this to your desired blue color */
    #2B24D0 /* Change this to your desired blue color */
  );
}

.front {
  display: block;
  position: relative;
  padding: 12px 27px;
  border-radius: 12px;
  font-size: 1.1rem;
  color: white;
  background: #1F70E2; /* Change this to your desired blue color */
  will-change: transform;
  transform: translateY(-4px);
  transition: transform 600ms cubic-bezier(.3, .7, .4, 1);
}

button:hover {
  filter: brightness(110%);
}

button:hover .front {
  transform: translateY(-6px);
  transition: transform 250ms cubic-bezier(.3, .7, .4, 1.5);
}

button:active .front {
  transform: translateY(-2px);
  transition: transform 34ms;
} 

button:hover .shadow {
  transform: translateY(4px);
  transition: transform 250ms cubic-bezier(.3, .7, .4, 1.5);
}

button:active .shadow {
  transform: translateY(1px);
  transition: transform 34ms;
}

button:focus:not(:focus-visible) {
  outline: none;
}
.link{
  text-decoration: none !important;
}

  </style>
  <div class="row mb-2">
    <div class="col-sm-6">
    </div><!-- /.row -->
  </div>
  <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="card-header  ">
      <button>
        <span class="shadow"></span>
        <span class="edge"></span>
        <a href="<?php echo site_url('main/add_product'); ?>" class="link"> <span class="front text"> Add Product </span> </a>
      </button>
      
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-stripped table-sm" id="user-datatables">
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Product Image</th>
              <th>Product Code</th>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Add your table rows here -->
            <?php
            if (isset($result) && !empty($result)) {
              $count = 1;
              foreach ($result as $key => $row) {
                $product_id = $row->product_id;
                $product_image = $row->product_image; // Assuming 'product_image' is the column name for the image filename
            ?>
                <tr class="text-center">
                  <td><?php echo $count++; ?></td>
                  <td><img src="<?php echo base_url('assets/images/' . $product_image); ?>" alt="Product Image" style="max-width: 100px;"></td>
                  <td><?php echo $row->product_code; ?></td>
                  <td><?php echo ucfirst($row->product_name); ?></td>
                  <td>₱<?php echo $row->product_price; ?></td>
                  <td>
                    <a href="<?php echo site_url('main/edit_product/' . $product_id); ?>" style="color:gold; padding-left:6px;" title="Click here to edit product details"><i class="fas fa-edit"></i></a>
                    <a href="<?php echo site_url('main/delete_product/' . $product_id); ?>" onclick="return confirm('Are you sure you want to delete this product?')" style="color:red; padding-left:6px;" title="Click here to delete product"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
            <?php
              }
            }
            ?>

            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      <?php if ($this->session->flashdata('success')) { ?>
        toastr.success('<?php echo $this->session->flashdata('success'); ?>');
      <?php } elseif ($this->session->flashdata('error')) { ?>
        toastr.error('<?php echo $this->session->flashdata('error'); ?>');
      <?php } ?>
    });
  </script>