<h4>Inventory Ledger</h4>

<div class="container">
    <form method="POST" action="" class="form-row">
        <div class="form-group col-md-4">
            <label for="date_from" class="text-white">Date From:</label>
            <input type="date" id="date_from" name="date_from" class="form-control form-control-sm" required>
        </div>
        <div class="form-group col-md-4">
            <label for="date_to" class="text-white">Date To:</label>
            <input type="date" id="date_to" name="date_to" class="form-control form-control-sm" required>
        </div>
        <div class="form-group col-md-4">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-success btn-block btn-sm">Search</button>
        </div>
    </form>

    <?php if (isset($_POST['date_from']) && isset($_POST['date_to'])) : ?>
        <?php
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
        $ledger = $this->inventory_ledger_model->get_ledger_by_date_range($date_from, $date_to);
        ?>

        <?php if (!empty($ledger)) : ?>
            <hr>
            <div class="card">
                <div class="card-body">
                    <table id="ledger-table" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="text-center">
                                <th>Date Posted</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ledger as $row) : ?>
                                <tr class="text-center">
                                    <td><?= $row->date_posted ?></td>
                                    <td><?= $row->product_name ?></td>
                                    <td><?= $row->quantity ?></td>
                                    <td><?= $row->unit ?></td>
                                    <td><?= $row->price ?></td>
                                    <td>
                                        <?php
                                        $activityBadgeClass = '';
                                        switch ($row->activity) {
                                            case 'Purchase':
                                                $activityBadgeClass = 'badge bg-primary';
                                                break;
                                            case 'Received':
                                                $activityBadgeClass = 'badge bg-success';
                                                break;
                                            case 'Returned':
                                                $activityBadgeClass = 'badge bg-danger';
                                                break;
                                            case 'Sold':
                                                $activityBadgeClass = 'badge bg-info';
                                                break;
                                            case 'Sales Returned':
                                                $activityBadgeClass = 'badge bg-danger';
                                                break;
                                            default:
                                                $activityBadgeClass = 'badge bg-secondary';
                                                break;
                                        }
                                        ?>
                                        <span class="<?= $activityBadgeClass ?>"><?= ucfirst($row->activity) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php else : ?>
            <p>No data found for the selected date range.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>