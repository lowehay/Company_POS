<style>
    .card {
        width: 95%;
        /* Adjust the width as needed */
        margin: 0 auto;
        /* Center the card on the page horizontally */
    }

    h1 {
        margin-left: 30px;
    }
</style>
<div class="container">
    <h1>Back-up & Restore</h1>

    <!-- Backup Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Backup Database</h3>
        </div>
        <div class="card-body">
            <a href="<?= site_url('main/export'); ?>" onclick="return confirm('Are you sure you want to backup your database?')" class="btn btn-primary">
                Backup</a>
        </div>
    </div>

    <!-- Restore Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Restore Database</h3>
        </div>
        <div class="card-body">
            <form action="<?= site_url('main/import'); ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate onsubmit="return confirm('Are you sure you want to restore your database?')">
                <div class="form-group">
                    <label for="restore_file">Select Backup File</label>
                    <input type="file" name="restore_file" class="form-control-file" id="restore_file">
                </div>
                <button type="submit" class="btn btn-primary">Restore</button>
            </form>
        </div>
    </div>
</div>