<div class="container mt-5">
    <h2>Stock Requisition</h2>
</div><?= $this->session->flashdata('exceeds'); ?>

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

<h1>Stock Requisition</h1>
<div class="card card-outline card-success" style="max-width:100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="card-header  ">
        <a href="<?php echo site_url('visitor_portal/add_stock_requisition'); ?>" class="btn btn-primary btn-sm "><i class="fas fa-plus"></i> Create Stock Request</a>
        <div class="float-right">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                <thead>
                    <tr class="text-center">
                        <th>Stock Requisition No.</th>
                        <th>Branch</th>
                        <th>Prepared By</th>
                        <th>Date Created</th>
                        <th>total Cost</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#sr-datatables").DataTable({
            "order": [
                [0, "desc"]
            ],
            "lengthMenu": [5, 10, 25, 50, 100]
        });
    });
</script>
<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success')) { ?>
            toastr.success('<?php echo $this->session->flashdata('success'); ?>');
        <?php } elseif ($this->session->flashdata('error')) { ?>
            toastr.error('<?php echo $this->session->flashdata('error'); ?>');
        <?php } ?>
    });
</script>