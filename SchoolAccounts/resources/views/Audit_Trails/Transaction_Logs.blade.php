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
                            <label>Filter Data</label>
                            <select class="form-control" name="FilterData" id="FilterData" required>
                                <option value="" selected disabled>Select Filter</option>                                            
                                <option value="Last1Year">Last 1 Year</option>
                                <option value="Last3Years">Last 3 Years</option>
                                <option value="Last5Years">Last 5 Years</option>                                    
                            </select>
                        </div>
                        <div class="col-lg-1 mt-4">
                            <button class="btn btn-primary mb-3" type="submit" id="fetchData"> Search </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Audit Trails</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Detail</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Debit</th>
                                        <th scope="col">Credit</th>
                                    </tr>
                                </thead>
                                <tbody id="transactionLogs">
                                    <!-- Dynamic content will be loaded here -->
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
        $('#fetchData').click(function() {
            const FilterData = $('#FilterData').val();
            
            // AJAX request
            $.ajax({
                url: '/Search_Transaction_Logs',
                method: 'GET',
                data: { FilterData: FilterData },
                success: function(data) {
                    // Clear the existing table body
                    $('#transactionLogs').empty();

                    // Populate the table with new data
                    data.forEach(function(item, index) {
                        $('#transactionLogs').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.employee_name}</td>
                                <td>${item.AccountType}</td>
                                <td>${item.month}</td>
                                <td>${item.debit}</td>
                                <td>${item.credit}</td>
                            </tr>
                        `);
                    });
                }
            });
        });
    });
</script>

@endsection
