<style>
	.bold-label {
		font-weight: bold;
	}

	h1 {
		text-align: center;
	}

	@media (max-width: 767px) {
		h1 {
			margin-left: 0;
		}
	}
</style>



<div class="container mt-2">
	<h1>Add User</h1>


	<div class="row justify-content-center">
		<div class="col-md-8">
			<?php if ($this->session->flashdata('add_user_submit')) : ?>
				<div class="alert alert-success" role="alert">
					<?= $this->session->flashdata('add_user_submit'); ?>
				</div>
			<?php endif; ?>
			<?php if ($this->session->flashdata('add_user_error')) : ?>
				<div class="alert alert-danger" role="alert">
					<?= $this->session->flashdata('add_user_error'); ?>
				</div>
			<?php endif; ?>

			<div class="card shadow">
				<div class="card-body">
					<?php echo form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to add this user?\')')); ?>

					<div class="form-group">
						<label for="username" class="bold-label">Username</label>
						<input type="text" id="username" name="username" placeholder="Username" class="form-control <?php echo form_error('username') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('username'); ?>">
						<span class="text-danger"><?php echo form_error('username'); ?></span>
					</div>

					<div class="form-group">
						<label for="first_name" class="bold-label">First Name</label>
						<input type="text" id="first_name" name="first_name" placeholder="First Name" class="form-control <?php echo form_error('first_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('first_name'); ?>">
						<span class="text-danger"><?php echo form_error('first_name'); ?></span>
					</div>

					<div class="form-group">
						<label for="last_name" class="bold-label">Last Name</label>

						<input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control <?php echo form_error('last_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('last_name'); ?>">

						<span class="text-danger"><?php echo form_error('last_name'); ?></span>
					</div>

					<div class="form-group">
						<label for="password" class="bold-label">Password</label>
						<input type="password" id="password" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>">
					</div>

					<div class="form-group">
						<label for="password1" class="bold-label">Confirm Password</label>
						<input type="password" id="password1" placeholder="Confirm Password" name="password1" class="form-control <?php echo form_error('password1') ? 'is-invalid' : ''; ?>">
						<span style="color: red;"><?php echo form_error('password1'); ?></span>
					</div>

					<div class="form-group">
						<label for="branch" class="bold-label">Branch</label><br>
						<select name="role" id="branch-select" data-live-search="true" data-style="btn-sm btn-outline-secondary" class="selectpicker <?php echo form_error('role') ? 'is-invalid' : ''; ?>">
							<option selected hidden>Select Branch</option>
							<option value="main branch">Main Branch</option>
							<option value="branch 1">Branch 1</option>
							<option value="branch 2">Branch 2</option>
						</select>
						<span class="text-danger"><?php echo form_error('branch'); ?></span>
					</div>

					<div class="form-group">
						<label for="role" class="bold-label">Roles</label><br>
						<select name="role" id="role-select" data-live-search="true" data-style="btn-sm btn-outline-secondary" class="selectpicker <?php echo form_error('role') ? 'is-invalid' : ''; ?>">
							<option selected hidden>Select Role</option>
							<option value="super-admin">Admin</option>
							<option value="branch admin">Branch Admin</option>
							<option value="inventory clerk">Inventory Clerk</option>
							<option value="cashier">Cashier</option>
							<option value="branch supervisor">Branch Supervisor</option>
							<option value="finance">Fianance</option>
							<option value="accounting">Accounting</option>
							<option value="branch clerk">Branch clerk</option>
							<option value="warehouse clerk">Warehouse Clerk</option>
							<option value="warehouse supervisor">Warehouse Supervisor</option>
						</select>
						<span class="text-danger"><?php echo form_error('role'); ?></span>
					</div>

					<!-- Add the other form fields in a similar manner -->

					<div class="mt-4">
						<button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
						<button type="reset" class="btn btn-danger"><i class="fas fa-trash"></i> Clear</button>
						<a class="btn btn-secondary" href="<?= base_url('main/user') ?>"><i class="fas fa-reply"></i> Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>