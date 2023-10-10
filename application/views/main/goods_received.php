    <?= $this->session->flashdata('success'); ?>
    <?= $this->session->flashdata('error'); ?>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Goods Received List</h1></br>
            <h1 class="text-dark">
                <a class="btn btn-primary btn-sm btn-dark"><i class="fas fa-boxes"></i> To Be Received</a>
                <a class="btn btn-primary btn-sm btn-dark"><i class="fas fa-list"></i> Goods Received List</a>
                <a class="btn btn-primary btn-sm btn-dark"><i class="fas fa-reply"></i> Back Order</a>
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('main/index') ?>">Home</a></li>
                <li class="breadcrumb-item active">Goods Received</li>
            </ol>
        </div><!-- /.col -->

    </div><!-- /.row -->

    <div class="card card-outline card-success" style="max-width:100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="card-header  ">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                        <thead>
                            <tr class="text-center">
                                <th>Goods Received No.</th>
                                <th>Supplier</th>
                                <th>Date Received</th>
                                <th>Total Cost</th>
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
    </div>