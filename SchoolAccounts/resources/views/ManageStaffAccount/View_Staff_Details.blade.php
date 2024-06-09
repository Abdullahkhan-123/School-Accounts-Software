@extends('master')
@section('content')

  <!--**********************************
            Content body start
        ***********************************-->        
        <div class="container-fluid">
            <div class="content-body">
        
                <!-- Profile Image section -->
                <div class="col-lg-12">
                    <div class="profile">
                        <div class="profile-head">
                            <div class="photo-content">
                                <div class="cover-photo"></div>
                                <div class="profile-photo">
                                    <img src="{{ asset('uploads/staff_images/' . $StaffData->Image) }}" class="img-fluid rounded-circle" alt="">
                                </div>
                            </div>
                            <div class="profile-info">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8">
                                        <div class="row">
                                            <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                                <div class="profile-name">
                                                    <h4 class="text-primary">{{ $StaffData->Name }}</h4>
                                                    <p>Name</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-4 prf-col">
                                                <div class="profile-call">
                                                    <h4 class="text-muted">{{ $StaffData->Phone }}</h4>
                                                    <p>Phone No.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- student details section -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">                                
                                        <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active">Staff Member Details</a></li>
                                        <li class="nav-item"><a href="#SalaryHistory" data-toggle="tab" class="nav-link">Salary History</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="about-me" class="tab-pane fade active show">                                    
                                                                            
                                            <div class="row">

                                                <div class="col">
                                                    <div class="profile-personal-info pt-5">
                                                        <h4 class="text-primary mb-4">Staff Account Information</h4>
                                                        
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Teacher Code <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StaffData->UniqueCode }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                                <div class="col-9"><span>{{ $StaffData->Email }}</span></div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Can Add <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StaffData->CanAdd }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Can Edit <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StaffData->CanEdit }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Can Drop <span class="pull-right">:</span></h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StaffData->CanDrop }}</span>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>    
                                                </div>

                                                <div class="col">
                                                    <div class="profile-personal-info pt-5">
                                                        <h4 class="text-primary mb-4">Account Information</h4>
                                                        
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Salary <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                                <div class="col-9"><span>{{ $StaffData->Salary }}</span></div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Allowances <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                                <div class="col-9"><span>{{ $StaffData->Allowances }}</span></div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Deductions <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                                <div class="col-9"><span>{{ $StaffData->Deductions }}</span></div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Account Type <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span class="badge badge-success">{{ $StaffData->AccountType }}</span>
                                                            </div>
                                                        </div>  
                                                        
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Account Status <span class="pull-right">:</span></h5>
                                                            </div>
                                                            <div class="col-9">
                                                                <span>
                                                                    @if($StaffData->Status == '1')
                                                                        <span class="badge badge-success">Active</span>
                                                                    @elseif($StaffData->Status == '0')
                                                                        <span class="badge badge-warning">Not Active</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Deactivated</span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>  

                                                    </div>    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>

                                        <div id="SalaryHistory" class="tab-pane fade">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Employee ID</th>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">Expense Name</th>
                                                                <th scope="col">Employee Name</th>
                                                                <th scope="col">Salary Paid</th>
                                                                <th scope="col">Account Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $No = 1; @endphp
                                                            @foreach($PaymentRecords as $index => $SalaryDetail)
                                                            @php
                                                                $collapseId = 'details' . $index;
                                                            @endphp
                                                            <tr data-toggle="collapse" data-target="#{{ $collapseId }}" aria-expanded="false" aria-controls="{{ $collapseId }}">
                                                                <td>{{ $No++ }}</td>
                                                                <td><span class="badge badge-success">{{ $SalaryDetail->EmployeeUniqueCode }}</span></td>
                                                                <td>{{ $SalaryDetail->Date }}</td>
                                                                <td>{{ $SalaryDetail->ExpenseName }}</td>
                                                                <td>{{ $SalaryDetail->EmployeeName . ' - ' . $SalaryDetail->EmployeeType }}</td>
                                                                <td>{{ $SalaryDetail->TotalSalary }}</td>
                                                                <td>{{ $SalaryDetail->BankName . ' - ' . $SalaryDetail->BankTitle . ' - ' . $SalaryDetail->BankAccountType }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="11" class="p-0">
                                                                    <div id="{{ $collapseId }}" class="collapse p-3 bg-light">
                                                                        <div class="accordion-body">
                                                                            <div class="container">
                                                                                <div class="row">
                                                                                    <div class="col-3">
                                                                                        <p><span style="font-size: 15px; color: black; font-weight: bold;">Basic Salary:</span> {{ $SalaryDetail->Salary }}</p>
                                                                                        <p><span style="font-size: 15px; color: black; font-weight: bold;">Allowances:</span> {{ $SalaryDetail->Allowances }}</p>
                                                                                        <p><span style="font-size: 15px; color: black; font-weight: bold;">Net Salary:</span> {{ $SalaryDetail->NetSalary }}</p>
                                                                                        <p><span style="font-size: 15px; color: black; font-weight: bold;">Deductions:</span> {{ $SalaryDetail->Deductions }}</p>
                                                                                    </div>
                                                                                    <div class="col-9">
                                                                                        <label><span style="font-size: 15px; color: black; font-weight: bold;">Description:</span></label>
                                                                                        <p>{{ $SalaryDetail->Description }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
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


@endsection