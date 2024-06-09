@extends('master')
@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
    
            <div class="row">
        
                <div class="col-lg-12">
        
                @if(Session::has('status'))
                    <div class="alert alert-danger mb-0 text-center" role="alert">
                        {{ Session::get('status') }}
                    </div>
                @elseif(Session::has('Success_status'))
                    <div class="alert alert-success mb-0 text-center" role="alert">
                        {{ Session::get('Success_status') }}
                    </div>
                @endif
                
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Employee Salaries Details</h4>
                            <h4 class="card-title">

                                <button class="btn btn-primary mb-2"> <a href="{{ route('ManageEmployeeSalary') }}" class="text-decoration-none text-white">Add More</a> </button>

                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Employee ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Expense Name</th>
                                            <th scope="col">Employee Name</th>                                        
                                            <th scope="col">Salary Paid</th>
                                            <th scope="col">Account Details</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php $LoopID = 1; @endphp

                                        @foreach($ManageSalary as $SalaryDetail)

                                        <tr>
                                            <td>{{ $LoopID++ }}</td>                                        
                                            <td> <span class="badge badge-success"> {{ $SalaryDetail->EmployeeUniqueCode }} </span> </td>
                                            <td>{{ $SalaryDetail->Date }}</td>
                                            <td>{{ $SalaryDetail->ExpenseName }}</td>
                                            <td>{{ $SalaryDetail->EmployeeName. ' - ' .$SalaryDetail->EmployeeType }}</td>
                                            <td>{{ $SalaryDetail->TotalSalary }}</td>
                                            <td>{{ $SalaryDetail->BankName. ' - ' .$SalaryDetail->BankTitle. ' - ' .$SalaryDetail->BankAccountType }}</td>                                            
                                            <td>
                                                <span>
                                                    <a href="{{ route('StaffProfileDetail', $SalaryDetail->EmployeeUniqueCode) }}" data-toggle="tooltip" data-placement="top" title="Profile" class="mr-2">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>
                                                    <a href="{{ route('DropEmployeeSalaries', $SalaryDetail->UniqueCode) }}" data-toggle="tooltip" data-placement="top" title="Close">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </a>
                                                </span>
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

@endsection