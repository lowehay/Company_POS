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

<h1>Purchase Orders</h1>
<div class="card card-outline card-success" style="max-width:100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="card-header  ">
        <a href="<?php echo site_url('main/add_purchase_order'); ?>" class="btn btn-primary btn-sm "><i class="fas fa-plus"></i> Create Purchase Order</a>
        <div class="float-right">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="user-datatables" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Purchase Order No.</th>
                        <th>Supplier</th>
                        <th>Date Created</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($po as $pur) { ?>
                        <tr class="text-center">

                            <td><?= $pur->purchase_order_no ?></td>
                            <td><?= $pur->supplier_name ?></td>
                            <td><?= $pur->date_created ?></td>
                            <td>₱<?= $pur->total_cost ?></td>
                            <td>
                                <?php if ($pur->status == "Received") { ?>
                                    <span class="badge bg-success"><?= ucfirst($pur->status) ?></span>
                                <?php } else if ($pur->status == "cancelled") { ?>
                                    <span class="badge bg-danger"><?= ucfirst($pur->status) ?></span>
                                <?php } else if ($pur->status == "Pending") { ?>
                                    <span class="badge bg-info"><?= ucfirst($pur->status) ?></span>
                                <?php } else if ($pur->status == "Back Order") { ?>
                                    <span class="badge bg-secondary"><?= ucfirst($pur->status) ?></span>
                                <?php } else { ?>
                                    <span class="badge bg-warning"><?= ucfirst($pur->status) ?></span>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="<?php echo site_url('visitor_portal/view_purchase_order/' . $pur->purchase_order_no_id); ?>" style="color: darkcyan; padding-left:6px;" title="Click here to view purchase order"><i class="fas fa-eye"></i></a>

                                <?php if ($pur->status == "Received") { ?>

                                <?php } elseif ($pur->status == "cancelled") { ?>

                                <?php } elseif ($pur->status == "To Be Received") { ?>

                                <?php } elseif ($pur->status == "Back Order") { ?>

                                <?php } else { ?>
                                    <a href="<?= site_url('visitor_portal/edit_purchase_order/' . $pur->purchase_order_no_id); ?>" style="color:gold; padding-left:6px;" title="Click here to edit purchase order"><i class="fas fa-edit"></i></a>

                                    <a href="<?= site_url('visitor_portal/delete_po/' . $pur->purchase_order_no_id); ?>" onclick="return confirm('Are you sure you want to delete this purchase order?')" style="color:red; padding-left:6px;" title="Click here to delete purchase order"><i class="fas fa-trash"></i></a>
                            </td>
                        <?php } ?>

                        </tr>
                    <?php } ?>
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