<h4>Product Management</h4>
<div class="col-sm-6">
</div>
<h1 class="m-0 text-dark">
  <a href="<?php echo site_url('main/product'); ?>" class="btn btn-primary btn-sm btn-success"><i class="fas fa-boxes"></i> Products</a>
  <a href="<?php echo site_url('main/unit'); ?>" class="btn btn-primary btn-sm btn-success"><i class="fas fa-barcode"></i> Unit Management</a>
</h1>
<div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
  <div class="card-header">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <a href="<?php echo site_url('main/add_product'); ?>" class="btn btn-success btn-sm"><i class="fas fa-box"></i> Add Product</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <table id="productTable" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Product Code</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($result) && !empty($result)) {
          foreach ($result as $key => $row) {
            $product_id = $row->product_id;
            $product_name = ucfirst($row->product_name);
            $product_code = $row->product_code;
            $product_price = $row->product_price;
        ?>
            <tr class="text-center">
              <td><?php echo $product_name; ?></td>
              <td><?php echo $product_code; ?></td>
              <td><?php echo $product_price; ?></td>
              <td>
                <a href="<?php echo site_url('main/view_product/') . $product_id; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> </a>
                <a href="<?php echo site_url('main/edit_product/') . $product_id; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> </a>
                <a href="<?php echo site_url('main/delete_product/') . $product_id; ?>" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a>
              </td>
            </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const productTable = $('#productTable').DataTable();

    // Event listener for delete button
    $('.delete-product-btn').on('click', function() {
      const productId = $(this).data('product-id');
      const confirmation = confirm('Are you sure you want to delete this product?');
      if (confirmation) {
        window.location.href = "<?php echo site_url('main/delete_product/'); ?>" + productId;
      }
    });

    const searchInput = document.getElementById("searchInput");

    searchInput.addEventListener("input", function() {
      const searchTerm = searchInput.value.trim().toLowerCase();

      productTable.search(searchTerm).draw();
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