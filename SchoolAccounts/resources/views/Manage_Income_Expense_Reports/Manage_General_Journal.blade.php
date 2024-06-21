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
                                <label>Bank Account</label>
                                <select class="form-control" name="BankAccount" id="BankAccount" required>
                                    <option value="" selected disabled>Select Bank Account</option>                                        
                                    @foreach($BankAccount as $account)
                                        <option value="{{ $account->id }}">{{ $account->BankName . ' - ' . $account->Title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="date-range-picker">
                                <label>Filter Date</label>
                                <select class="form-control" name="FilterDate" id="FilterDate" required>
                                    <option value="" selected disabled>Select Filter</option>                                            
                                    <option value="Last1Year">Last 1 Year</option>
                                    <option value="Last3Years">Last 3 Years</option>
                                    <option value="Last5Years">Last 5 Years</option>                                    
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
                        <h4 class="card-title">General Journal</h4>
                        <div class="row d-flex">
                            <form method="post" action="{{ route('PrintGeneralJournal') }}">
                                @csrf
                                <input type="hidden" name="PrintBankAccount" id="PrintBankAccount">
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
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody id="journalTableBody">
                                    <!-- Data will be populated here by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Button click event listener
        $('#fetchData').click(function() {
            // Obtain values from form fields
            const BankAccount = $('#BankAccount').val();
            const FilterDate = $('#FilterDate').val();

            const PrintBankAccount = $('#PrintBankAccount').val();
            const PrintFilterDate = $('#PrintFilterDate').val();

            $('#PrintBankAccount').val(BankAccount);
            $('#PrintFilterDate').val(FilterDate);
            
            // AJAX request
            $.ajax({
                url: '/Search_General_Journal', // Server-side route URL
                method: 'GET',
                data: {
                    BankAccount,
                    FilterDate,

                    PrintBankAccount,
                    PrintFilterDate
                },
                success: function(response) {
                    const BankAccountData = response.BankAccountData;
                    const ManageUtlityExpense = response.ManageUtlityExpense;
                    const ManageExpense = response.ManageExpense;
                    const ManageAssets = response.ManageAssets;
                    const PaymentRecords = response.PaymentRecords;
                    
                    $('#journalTableBody').empty();
                    
                    // Display opening balance
                    $('#journalTableBody').append(`
                        <tr>
                            <td></td>
                            <td colspan="4">Account Of | ${BankAccountData.BankName}</td>                            
                            <td>${parseFloat(BankAccountData.Balance).toFixed(2)}</td>
                        </tr>
                    `);

                    let currentBalance = parseFloat(BankAccountData.Balance);

                    // Function to render transactions
                    function renderTransactions(transactions, type) {
                        transactions.forEach(function(transaction, index) {
                            let debit = '', credit = '';
                            if (type === 'Expense') {
                                debit = transaction.Amount;
                                currentBalance -= parseFloat(transaction.Amount);
                            } else if (type === 'Income') {
                                credit = transaction.Paid;
                                currentBalance += parseFloat(transaction.Paid);
                            }
                            $('#journalTableBody').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${transaction.Date || transaction.FeeExpDate}</td>
                                    <td>${transaction.ExpenseName || transaction.FeesName}</td>
                                    <td>${debit}</td>
                                    <td>${credit}</td>
                                    <td>${currentBalance.toFixed(2)}</td>
                                </tr>
                            `);
                        });
                    }

                    // Render all transactions
                    renderTransactions(ManageUtlityExpense, 'Expense');
                    renderTransactions(ManageExpense, 'Expense');
                    renderTransactions(ManageAssets, 'Income');
                    renderTransactions(PaymentRecords, 'Income');

                    // Display closing balance
                    $('#journalTableBody').append(`
                        <tr>
                            <td></td>
                            <td colspan="4">Closing Balance</td>                            
                            <td>${currentBalance.toFixed(2)}</td>
                        </tr>
                    `);
                }
            });
        });
    });
</script>

@endsection
