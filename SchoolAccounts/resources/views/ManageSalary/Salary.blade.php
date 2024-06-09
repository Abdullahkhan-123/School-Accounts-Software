@extends('master')
@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row">

            <!-- First Row -->
            <div class="col-xl-12 col-xxl-12">

                <!-- Academic Information -->
                <div class="card col-6 d-flex m-auto justify-content-center">

                    @if(Session::has('status'))
                    <div class="alert alert-danger mb-0 text-center" role="alert">
                        {{ Session::get('status') }}
                    </div>
                    @elseif(Session::has('Success_status'))
                    <div class="alert alert-success mb-0 text-center" role="alert">
                        {{ Session::get('Success_status') }}
                    </div>
                    @endif

                    <div class="card-header">
                        <h4 class="card-title">Manage Employee Salary</h4>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">

                            <form method="post" action="{{ route('SaveEmployeeSalary') }}">
                                @csrf
                                
                                <div class="row">
                                    <div class="col">
                                        <label>Employee:</label>
                                        <select class="form-control" name="EmployeeID" id="EmployeeID" required>
                                            <option value="" selected disabled>Select</option>
                                            @foreach($StaffAccount as $StaffAccount)
                                                <option value="{{ $StaffAccount->id }}">{{ $StaffAccount->Name. ' - ' .$StaffAccount->AccountType}}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label class="">Date</label>
                                        <input type="date" class="form-control mb-2 admitClass" name="Date" required>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col">
                                        <label>Expense Category:</label>
                                        <select class="form-control" name="ExpenseCategory" id="sel1" required>
                                            <option value="" selected disabled>Select</option>
                                            @foreach($UtlityExpenseCategory as $ExpenceCategory)
                                                <option value="{{ $ExpenceCategory->id }}">{{ $ExpenceCategory->CategoryName}}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label>Debit Account:</label>
                                        <select class="form-control" name="DebitAccount" id="sel1" required>
                                            <option value="" selected disabled>Select</option>

                                            @foreach($BankAccount as $BankAccount)
                                                <option value="{{ $BankAccount->id }}">{{ $BankAccount->BankName . ' - ' . $BankAccount->Title }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Salary</label>
                                        <input type="text" class="form-control mb-2" placeholder="Debit Amount '0'" name="Amount" id="Amount" readonly>
                                    </div>

                                    <div class="col">
                                        <label>Allowances</label>
                                        <input type="text" class="form-control mb-2" placeholder="Allowances '0'" name="Allowances" id="Allowances" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Net Salary</label>
                                        <input type="text" class="form-control mb-2" placeholder="Net Salary '0'" name="NetSalary" id="NetSalary" readonly>
                                    </div>

                                    <div class="col">
                                        <label>Deductions</label>
                                        <input type="text" class="form-control mb-2" placeholder="Deductions '0'" name="Deductions" id="Deductions" value="0">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Total Salary</label>
                                        <input type="text" class="form-control mb-2" placeholder="Total Salary '0'" name="TotalSalary" id="TotalSalary" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Description</label>
                                        <textarea class="form-control mb-2" name="Description"></textarea>                                        
                                    </div>
                                </div>

                                <div class="row">                                
                                    <div class="col-12 mt-2 d-flex justify-content-end align-items-end">                                        
                                        <button type="submit" class="btn btn-primary mb-2 ml-2">Save</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('EmployeeID').addEventListener('change', function() {
        var employeeId = this.value;
        if (employeeId) {
            fetch(`/get_employee_salary/${employeeId}`)
                .then(response => response.json())
                .then(data => {
                    var salary = parseFloat(data.salary) || 0;
                    var allowances = parseFloat(data.allowances) || 0;

                    document.getElementById('Amount').value = salary;
                    document.getElementById('Allowances').value = allowances;
                    var netSalary = salary + allowances;
                    document.getElementById('NetSalary').value = netSalary;

                    var deductions = parseFloat(document.getElementById('Deductions').value) || 0;
                    document.getElementById('TotalSalary').value = netSalary - deductions;
                })
                .catch(error => console.error('Error fetching employee salary and allowances:', error));
        } else {
            document.getElementById('Amount').value = 0;
            document.getElementById('Allowances').value = 0;
            document.getElementById('NetSalary').value = 0;
            document.getElementById('TotalSalary').value = 0;
        }
    });

    document.getElementById('Deductions').addEventListener('input', function() {
        var netSalary = parseFloat(document.getElementById('NetSalary').value) || 0;
        var deductions = parseFloat(this.value) || 0;
        document.getElementById('TotalSalary').value = netSalary - deductions;
    });
</script>

@endsection
