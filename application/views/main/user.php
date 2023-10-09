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
</style>
<div class="row mb-2">
  <div class="col-sm-6">
  </div><!-- /.col -->
</div><!-- /.row -->
<div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
  <div class="card-header">
    <a href="<?php echo site_url('main/add_user'); ?>" class="btn btn-primary btn-sm "><i class="fas fa-user-plus"></i>
      Add User </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-stripped table-sm" id="user-datatables">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($result) && !empty($result)) {
            $count = 1;
            foreach ($result as $key => $row) {
              $user_id = $row->user_id;
              ?>
              <tr class="text-center">
                <td>
                  <?php echo $count++; ?>
                </td>
                <td>
                  <?php echo $row->username; ?>
                </td>
                <td>
                  <?php echo $row->first_name; ?>
                </td>
                <td>
                  <?php echo $row->last_name; ?>
                </td>
                <td>
                  <?php echo ucfirst($row->role); ?>
                </td>
                <td>
                  <a href="<?php echo site_url('main/edit_user/' . $user_id); ?>" style="color:gold; padding-left:6px;"
                    title="Click here to edit user details"><i class="fas fa-edit"></i></a>
                  <a href="<?php echo site_url('main/delete_user/' . $user_id); ?>"
                    onclick="return confirm('Are you sure you want to delete this user?')"
                    style="color:red; padding-left:6px;" title="Click here to delete user"><i class="fas fa-trash"></i></a>
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
</div>
<script>
  $(document).ready(function () {
    <?php if ($this->session->flashdata('success')) { ?>
      toastr.success('<?php echo $this->session->flashdata('success'); ?>');
    <?php } elseif ($this->session->flashdata('error')) { ?>
      toastr.error('<?php echo $this->session->flashdata('error'); ?>');
    <?php } ?>
  });
</script>