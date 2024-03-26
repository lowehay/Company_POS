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
<h4>Unit Management </h4>
<h1 class="m-0 text-dark">
    <a href="<?php echo site_url('main/product'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-boxes"></i> Products</a>
    <a href="<?php echo site_url('main/product_category'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-list"></i> Product Category</a>
    <a href="<?php echo site_url('main/unit'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-barcode"></i> Unit Management</a>
</h1>
<div class="card card-outline card-success" style="max-width:100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="card-header  ">

        <a href="<?php echo site_url('main/add_unit'); ?>" class="btn btn-primary btn-sm "><i class="fas fa-plus"></i> Add New Unit</a>

        <div class="float-right">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;

                    foreach ($unit as $pc) : ?>
                        <tr class="text-center">

                            <td><?= $no++ ?></td>
                            <td><?php echo $pc->unit; ?></td>
                            <td>

                                <a href="<?php echo site_url('main/edit_unit/' . $pc->unit_id); ?>" style="color:gold; padding-left:6px;" title="Click here to edit product category"><i class="fas fa-edit"></i></a>
                                <a href="<?php echo site_url('main/delete_unit/' . $pc->unit_id); ?>" onclick="return confirm('Are you sure you want to delete product category?')" style="color:red; padding-left:6px;" title="Click here to delete product category"><i class="fas fa-trash"></i></a>

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