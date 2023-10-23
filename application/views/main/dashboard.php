<style>
    body {
        margin-bottom: 20px;
    }
</style>
</div>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="card-header bg-primary text-white">
                    Sales Summary
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text">$10,000</p>
                    <h5 class="card-title">Today's Sales</h5>
                    <p class="card-text">$1,000</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="card-header bg-success text-white">
                    Products
                </div>
                <div class="card-body">
                    <h5 class="card-title">Available Products</h5>
                    <p class="card-text">200</p>
                    <h5 class="card-title">Out of Stock</h5>
                    <p class="card-text">10</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="card-header bg-warning text-white">
                    Orders
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pending Orders</h5>
                    <p class="card-text">5</p>
                    <h5 class="card-title">Completed Orders</h5>
                    <p class="card-text">20</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="card-header bg-info text-white">
                    Inventory
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Inventory</h5>
                    <p class="card-text">500</p>
                    <h5 class="card-title">Low Stock Items</h5>
                    <p class="card-text">30</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Graph -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Sales Chart
                </div>
                <div class="card-body">
                    <canvas id="salesChart" style=" height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    Sales Distribution
                </div>
                <div class="card-body">
                    <canvas id="salesDistributionChart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Bar Chart Data
        var ctx = document.getElementById("salesChart").getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May"],
                datasets: [{
                    label: 'Monthly Sales',
                    data: [1200, 1500, 1100, 1800, 1400],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                maintainAspectRatio: false, // Add this line
                responsive: true, // Add this line
            }
        });

        // Pie Chart Data
        var ctx2 = document.getElementById("salesDistributionChart").getContext('2d');
        var salesDistributionChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ["Product A", "Product B", "Product C", "Product D", "Product E"],
                datasets: [{
                    data: [15, 25, 20, 10, 30],
                    backgroundColor: ["#FF5733", "#FFC300", "#FF5733", "#FFC300", "#FF5733"]
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        });
    </script>