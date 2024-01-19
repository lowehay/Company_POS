<style>
    .card {
        width: 95%;
        margin: 20px auto;
    }

    h4 {
        margin-left: 40px;
    }
</style>
<h4>Supplier Management</h4>
<div class="card card-outline card-success" style="max-width:100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

    <div class="card-header  ">

        <a href="<?php echo site_url('main/add_supplier'); ?>" class="btn btn-dark btn-sm "><i class="fas fa-truck"></i> Add Supplier </a>


    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Supplier Name</th>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($supplier as $supp) : ?>
                        <tr class="text-center"> <!-- Add the "text-center" class here -->
                            <td><?= $no++ ?></td>
                            <td><?= $supp->supplier_name ?></td>
                            <td><?= $supp->company_name ?></td>
                            <td><?= $supp->supplier_contact ?></td>
                            <td><?= $supp->supplier_email ?></td>
                            <td>
                                <a href="<?php echo site_url('main/view_supplier/' . $supp->supplier_id); ?>" style="color: darkcyan; padding-left:6px;" title="Click here to view supplier details"><i class="fas fa-eye"></i></a>
                                <a href="<?php echo site_url('main/editsupplier/' . $supp->supplier_id); ?>" style="color:gold; padding-left:6px;" title="Click here to edit supplier details"> <i class="fas fa-edit"></i></a>
                                <a href="<?php echo site_url('main/delete_supplier/' . $supp->supplier_id); ?>" onclick="return confirm('Are you sure you want to delete supplier?')" style="color:red; padding-left:6px;" title="Click here to delete this supplier"> <i class="fas fa-trash"></i></a>
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

        $(this).parents(".text-center").animate({
                backgroundColor: "#fbc7ca7"
            }, "fast")
            .animate({
                opacity: "hide"
            }, "slow");
    });

    $(function() {


        $(".delbutton").click(function() {

            //Save the link in a variable called element
            var element = $(this);

            //Find the id of the link that was clicked
            var del_id = element.attr("id");

            //Built a url to send
            var info = 'id=' + del_id;
            if (confirm("Are you sure want to delete? There is NO undo!")) {

                $.ajax({
                    type: "GET",
                    url: "deletesupplier.php",
                    data: info,
                    success: function() {

                    }
                });
                $(this).parents(".text-center").animate({
                        backgroundColor: "#fbc7ca7"
                    }, "fast")
                    .animate({
                        opacity: "hide"
                    }, "slow");

            }

            return false;

        });

    });


    $(function() {
        $("#button").click(function() {
            $("#button").addClass("onclic", 250, validate);
        });

        function validate() {
            setTimeout(function() {
                $("#button").removeClass("onclic");
                $("#button").addClass("validate", 450, callback);
            }, 2250);
        }

        function callback() {
            setTimeout(function() {
                $("#button").removeClass("validate");
            }, 1250);
        }
    });
</script>