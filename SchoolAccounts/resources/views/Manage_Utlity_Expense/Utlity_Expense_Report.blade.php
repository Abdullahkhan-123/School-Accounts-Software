@extends('master')
@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row">

                <!-- First Row -->
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
                                    <label></label>
                                    <input type="text" class="form-control"  id="date_range" placeholder="Select Date Range">
                                </div>
                            </div>


                            <div class="col-lg-1 mt-4">
                                <button class="btn btn-primary mb-3" id="fetchData"> Search </button>
                            </div>

                        </div>                            
                        
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Expense Report</h4>
                            <h4 class="card-title">

                                <div class="row d-flex">
                                

                                    <!-- export as print -->
                                    <form method="post" action="{{ route('PrintExpenseReport') }}">
                                        @csrf
                                        <input type="hidden" name="datefilter" id="datefilter">                                    
                                        <button class="btn btn-primary mb-2 mr-1" type="submit"> <i class="fa fa-print color-danger"></i> </button>
                                    </form>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                        
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Head Of Expense</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Debit By</th>
                                            <th scope="col">Amount</th>
                                            <th class="col-4" scope="col">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
                const datefilter = $('#datefilter').val();

                const DateRange = $('#date_range').val();
                // date-range

                // Set hidden input values to export print 
                $('#datefilter').val(DateRange);

                // AJAX request
                $.ajax({
                    url: '/Search_Utlity_Expense_Report', // Server-side route URL
                    method: 'GET',
                    data: {
                        DateRange,
                        datefilter
                    },
                    success: function(data) {
                        // Clear the existing table body
                        $('table tbody').empty();

                        // Populate the table with new data
                        data.forEach(function(item, index) {
                            $('table tbody').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td> <span class="badge badge-success"> ${item.ExpenseName} </span> </td>
                                    <td>${item.Date}</td>
                                    <td>${item.BankName} - ${item.BankTitle} - ${item.BankAccountType}</td>
                                    <td>${item.Amount}</td>
                                    <td>${item.Description}</td>
                                </tr>
                            `);
                        });
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const dateRangeInput = document.getElementById('date_range');

            // Initialize Flatpickr date range picker
            const datePicker = flatpickr(dateRangeInput, {
                mode: 'range', // Allows selecting a date range
                dateFormat: 'Y-m-d', // Format for selected dates
                onClose: function (selectedDates) {
                    // Handle date selection
                    if (selectedDates.length === 2) {
                        const fromDate = selectedDates[0].toLocaleDateString();
                        const toDate = selectedDates[1].toLocaleDateString();
                        dateRangeInput.value = `${fromDate} - ${toDate}`;
                    } else {
                        dateRangeInput.value = '';
                    }
                }
            });
        });

    </script>

@endsection
