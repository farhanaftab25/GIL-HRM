<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- Button trigger modal -->
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="total-Salary">
            Total Salary
        </button>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Designations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Designation::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-industry fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Employees</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Employee::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content Row -->

    <div class="row">

        <!-- Pie Chart -->
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Designation Wise Employee</h6>
                </div>
                    <div id="chartPie" style="height: 350px;"></div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- salary Modal -->
    <div class="modal fade" id="totalSalary" tabindex="-1" role="dialog" aria-labelledby="totalSalary" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Summary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Salary</th>
                        </tr>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>
                <h5 class="modal-title" id="exampleModalLongTitle">Total Salary: 
                    <span id="total-salary"></span>
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->