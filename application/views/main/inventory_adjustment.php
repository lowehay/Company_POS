<style>
    .card {
        width: 95%;
        /* Adjust the width as needed */
        margin: 20px auto;
        /* Center the card on the page horizontally */
    }

    .row {
        margin-top: 10px;
    }

    h1 {
        margin-left: 50px;
    }
</style>

<h1>Inventory Adjustment</h1>
<div class="card card-outline card-success">
    <div class="card-header  ">
        <div class="float-right">
            <a href="<?php echo site_url('visitor_portal/printphysicalcountsheet'); ?>" class="btn btn-info btn-sm"><i class="fas fa-print"></i> Print Physical Count Sheet</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Qty/Unit</th>
                        <th>Selling Price</th>
                        <th>Critical Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;

                    foreach ($product as $pro) : ?>
                        <tr class="text-center">
                            <td><?php echo $pro->product_code; ?></td>
                            <td><?php echo $pro->product_name; ?></td>
                            <td><?php echo $pro->product_category; ?></td>
                            <td><?php echo $pro->product_quantity; ?></td>
                            <td>₱<?php echo $pro->product_price; ?></td>
                            <td>
                                <div class="progress">
                                    <?php if ($pro->product_quantity <= 20) : ?>
                                        <div class="progress-bar progress-bar-striped bg-danger" style="width: <?php echo $pro->product_quantity; ?>%"></div>
                                    <?php elseif ($pro->product_quantity <= $pro->product_minimum_quantity) : ?>
                                        <div class="progress-bar progress-bar-striped bg-warning" style="width: <?php echo $pro->product_quantity; ?>%"></div>
                                    <?php else : ?>
                                        <div class="progress-bar progress-bar-striped" style="width: <?php echo $pro->product_quantity; ?>%"></div>
                                    <?php endif; ?>
                                </div>

                            </td>
                            <td>
                                <a href="<?php echo site_url('main/add_stock/' . $pro->product_id); ?>"><button type="button" class="btn btn-sm btn-info" id="btn_po">Adjust</button></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
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