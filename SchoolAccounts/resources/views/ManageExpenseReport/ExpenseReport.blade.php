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
                            <h4 class="card-title">Liability Expense Report</h4>
                            <h4 class="card-title">

                                <div class="row d-flex">
                                

                                    <!-- export as print -->
                                    <form method="post" action="">
                                        @csrf
                                        <input type="hidden" name="Classprint" id="Classprint">
                                        <input type="hidden" name="Sectionprint" id="Sectionprint">
                                        <input type="hidden" name="Typeprint" id="Typeprint">
                                        <input type="hidden" name="Campusprint" id="Campusprint">
                                        <button class="btn btn-primary mb-2 mr-1" type="submit">Print</button>
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
                                            <th scope="col">Expense Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Debit By</th>
                                            <th scope="col">Acount Title</th>
                                            <th scope="col">Acount Type</th>
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
                const classId = $('#sel1').val(); // Class select field se value obtain karna
                const sectionId = $('#sel2').val(); // Section select field se value obtain karna
                const type = $('#sel3').val(); // Type select field se value obtain karna
                const campus = $('#sel4').val(); // Campus select field se value obtain karna

                const DateRange = $('#date_range').val();
                // date-range

                // Set hidden input values to export csv
                $('#Class').val(classId);
                $('#Section').val(sectionId);
                $('#Type').val(type);
                $('#Campus').val(campus);

                // Set hidden input values to export pdf 
                $('#Classpdf').val(classId);
                $('#Sectionpdf').val(sectionId);
                $('#Typepdf').val(type);
                $('#Campuspdf').val(campus);

                // Set hidden input values to export print 
                $('#Classprint').val(classId);
                $('#Sectionprint').val(sectionId);
                $('#Typeprint').val(type);
                $('#Campusprint').val(campus);

                // AJAX request
                $.ajax({
                    url: '/Search_Expense_Report', // Server-side route URL
                    method: 'GET',
                    data: {
                        DateRange
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
                                    <td>${item.BankName}</td>
                                    <td>${item.BankTitle}</td>
                                    <td>${item.BankAccountType}</td>
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
