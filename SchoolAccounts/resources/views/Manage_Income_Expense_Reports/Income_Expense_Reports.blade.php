@extends('master')
@section('content')

<div class="content-body">
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

                <div class="card p-2">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-3">
                            <div class="date-range-picker">
                                <label>Expense Category</label>
                                <select class="form-control" name="ExpenseCategory" id="ExpenseCategory" required>
                                    <option value="" selected disabled>Select Category</option>                                        
                                    @foreach($ExpenceCategory as $ExpenceCategory)
                                        <option value="{{ $ExpenceCategory->id }}">{{ $ExpenceCategory->CategoryName}}</option>
                                    @endforeach
                                    <option value="AllCategories">All Categories</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="date-range-picker">
                                <label>Filter Data</label>
                                <select class="form-control" name="FilterDate" id="FilterDate" required>
                                    <option value="" selected disabled>Select Filter</option>                                            
                                    <option value="Last1Year">Last 1 Year</option>                                            
                                    <option value="Last2Years">Last 2 Years</option>                                            
                                    <option value="Last4Years">Last 4 Years</option>                                            
                                    <option value="AllYears">All Years</option>                                            
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-1 mt-4">
                            <button class="btn btn-primary mb-3" id="fetchData">Search</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Income And Expense Statements</h4>
                        <div class="row d-flex">                           
                            <form method="post" action="{{ route('PrintIncomeLossStatements') }}">
                                @csrf
                                <input type="hidden" name="PrintExpensecategory" id="PrintExpensecategory">
                                <input type="hidden" name="PrintFilterDate" id="PrintFilterDate">
                                <button class="btn btn-primary mb-2 mr-1" type="submit"> <i class="fa fa-print color-danger"></i> </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Head Of Expense</th>
                                        <th scope="col">Debit By</th>                                        
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated here by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                        <!-- <div>
                            <h4>Total Amount: <span id="totalAmount">0</span></h4>
                        </div>
                        <div>
                            <h4>Total Profit: <span id="totalProfit">0</span></h4>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#fetchData').click(function() {
            const ExpenseCategory = $('#ExpenseCategory').val();
            const FilterData = $('#FilterDate').val();

            const PrintExpensecategory = $('#PrintExpensecategory').val();
            const PrintFilterDate = $('#PrintFilterDate').val();

            $('#PrintExpensecategory').val(ExpenseCategory);
            $('#PrintFilterDate').val(FilterData);

            $.ajax({
                url: '/Search_Profit_Loss_Statements',
                method: 'GET',
                data: {
                    PrintExpensecategory,
                    PrintFilterDate,
                    ExpenseCategory,
                    FilterData
                },
                success: function(response) {
                    const data = response.expenses;
                    const payments = response.payments;

                    $('table tbody').empty();

                    const aggregatedData = {};
                    data.forEach(function(item) {
                        const key = item.ExpenseName + '-' + item.BankName; // Combine category and bank name as the key
                        if (!aggregatedData[key]) {
                            aggregatedData[key] = {
                                ...item,
                                totalAmount: 0
                            };
                        }
                        aggregatedData[key].totalAmount += parseFloat(item.Amount != null ? item.Amount : item.Salary);
                    });

                    
                    // Add a new section for profit
                    $('table tbody').append(`
                        <tr>
                            <td colspan="8" class="text-center font-weight-bold">Income Records</td>
                        </tr>
                    `);

                    const profitData = {
                        totalAmount: 0,
                        BankName: "",
                        BankTitle: "",
                        BankAccountType: "",
                        Description: "",
                        FeeExpDate: ""
                    };

                    payments.forEach(function(payment) {
                        profitData.totalAmount += parseFloat(payment.Paid);
                        profitData.PaymentMethod = payment.PaymentMethod;
                        profitData.BankTitle = payment.BankTitle;
                        profitData.BankAccountType = payment.BankAccountType;
                        profitData.Description = payment.Description;
                        profitData.FeeExpDate = payment.FeeExpDate;
                    });

                    $('table tbody').append(`
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Fees Collection Income</td>                            
                            <td>${profitData.totalAmount.toFixed(2)}</td>
                        </tr>
                    `);
                    
                    $('#totalProfit').text(profitData.totalAmount.toFixed(2));


                    // Start Expenses

                    // Add a new section for profit
                    $('table tbody').append(`
                        <tr>
                            <td colspan="8" class="text-center font-weight-bold">Expenses Records</td>
                        </tr>
                    `);
                    let totalAmount = 0;
                    Object.values(aggregatedData).forEach(function(item, index) {                        
                        $('table tbody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.ExpenseName}</td>
                                <td>${item.BankName} - ${item.BankTitle} - ${item.BankAccountType}</td>                                
                                <td>${item.totalAmount.toFixed(2)}</td>
                            </tr>
                        `);
                        totalAmount += item.totalAmount;
                    });

                    $('#totalAmount').text(totalAmount.toFixed(2));

                    

                    // Calculate total profit and total amount separately
                    let totalProfit = 0;
                    payments.forEach(function(payment) {
                        totalProfit += parseFloat(payment.Paid);
                    });

                    // Append total amount and total profit in separate rows
                    $('table tbody').append(`
                        <tr>
                            <td colspan="3" class="text-right font-weight-bold">Total Expense:</td>
                            <td>${totalAmount.toFixed(2)}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right font-weight-bold">Total Profit:</td>
                            <td>${totalProfit.toFixed(2)}</td>
                        </tr>

                        <tr>
                            <td colspan="3" class="text-right font-weight-bold">Total Balance:</td>
                            <td>${totalProfit.toFixed(2) - totalAmount.toFixed(2)}</td>
                        </tr>
                    `);
                }
            });
        });
    });
</script>

@endsection
