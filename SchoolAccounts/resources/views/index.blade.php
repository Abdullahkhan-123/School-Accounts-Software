@extends('master')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">This Month Expenses</div>
                                    <div class="stat-digit"> <span>Rs:</span> {{ $ManageExpense }}</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">This Month Income</div>
                                    <div class="stat-digit"> <span>Rs:</span> {{ $PaymentRecords }}</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Total Students</div>
                                    <div class="stat-digit"> {{ $admitStudent }}</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Total Employees</div>
                                    <div class="stat-digit"> {{ $StaffAccount }}</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>

                    <!-- /# column -->
                </div>


                <!-- charts start -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Reporting and Analytics</h4>
                                </div>
                                <div class="card-body">
                                    <div class="current-progress">
                                        <canvas id="myChart" style="width:100%;"></canvas>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container-fluid">
                    <!-- project start -->
                    <!-- <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Income & Expense Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="current-progress">

                                            <div class="progress-content py-2">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="progress-text">Profit and Loss Amount</div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="current-progressbar">
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-primary w-40" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                    40%
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="progress-content py-2">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="progress-text">Balance Sheet Amount</div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="current-progressbar">
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-primary w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                                    60%
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="progress-content py-2">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="progress-text">Cash Flow Amount</div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="current-progressbar">
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                                                    70%
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="progress-content py-2">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="progress-text">Transaction Logs Amount</div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="current-progressbar">
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-primary w-90" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                                                    90%
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

            </div>
        <!--**********************************
            Content body end
        ***********************************-->

<script>
    const xValues = ["Assets Expense This Year", "laiblities Expense This Year", "Income This Year", "Salaries Paid This Year", "Students Enroll This Year"];
    const yValues = [{{ $YearManageAssets }}, {{ $YearManageExpense }}, {{ $YearPaymentRecords }}, {{ $YearManageSalary }}, {{ $YearadmitStudent }}];
    const barColors = ["red", "green","blue","orange","brown"];

    new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "This Year Records"
        }
    }
    });
</script>

@endsection