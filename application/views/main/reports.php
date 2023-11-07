<div class="container">
    <h1>Report Dashboard</h1>

    <!-- Navigation for Modules -->
    <ul class="nav nav-tabs" id="moduleTabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#module1">Module 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#module2">Module 2</a>
        </li>
        <!-- Add more modules as needed -->
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="moduleTabContent">
        <!-- Module 1 Content -->
        <div class="tab-pane fade show active" id="module1">
            <div class="card-header">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Report Name</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Replace the following rows with dynamic data from your backend -->
                            <tr>
                                <td>Report 1</td>
                                <td>2023-10-12</td>
                                <td><a href="#">View</a></td>
                            </tr>
                            <tr>
                                <td>Report 2</td>
                                <td>2023-10-11</td>
                                <td><a href="#">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Module 2 Content -->
        <div class="tab-pane fade" id="module2">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Report Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Replace the following rows with dynamic data from your backend -->
                        <tr>
                            <td>Report A</td>
                            <td>2023-10-12</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>Report B</td>
                            <td>2023-10-11</td>
                            <td><a href="#">View</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add more modules as needed -->
    </div>
</div>