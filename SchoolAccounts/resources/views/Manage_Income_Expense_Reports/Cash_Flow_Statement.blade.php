@extends('master')
@section('content')

<style>
    .sr-only {
        border: 0 !important;
        clip: rect(1px, 1px, 1px, 1px) !important;
        -webkit-clip-path: inset(50%) !important;
        clip-path: inset(50%) !important;
        height: 1px !important;
        overflow: hidden !important;
        margin: -1px !important;
        padding: 0 !important;
        position: absolute !important;
        width: 1px !important;
        white-space: nowrap !important;
    }

    html {
        box-sizing: border-box;
    }

    body {
        font-family: sans-serif;
        color: #0a0a23;
    }

    h1 {
        max-width: 37.25rem;
        margin: 0 auto;
        padding: 1.5rem 1.25rem 1.5rem;
    }

    h1 .flex {
        display: flex;
        flex-direction: column-reverse;
        gap: 1rem;
        justify-content: center;
        align-items: center;
    }

    h1 .flex span:first-of-type {
        font-size: 0.7em;
    }

    h1 .flex span:last-of-type {
        font-size: 1.2em;
    }

    section {
        max-width: 100%;
        margin: 0 auto;
        border: 2px solid #d0d0d5;
    }

    #years {
        display: flex;
        justify-content: flex-end;
        position: sticky;
        top: 0;
        background: #0a0a23;
        color: #fff;
        z-index: 1;
        padding: 0.5rem calc(1.25rem + 2px) 0.5rem 0;
        margin: 0 -2px;
    }

    #years span {
        font-weight: bold;
        width: 4.5rem;
        text-align: right;
    }

    .table-wrap {
        padding: 0 0.75rem 1.5rem 0.75rem;
    }

    table {
        border-collapse: collapse;
        border: 0;
        width: 100%;
        position: relative;
        margin-top: 3rem;
    }

    table caption {
        color: #356eaf;
        font-size: 1.3em;
        font-weight: normal;
        position: absolute;
        top: -3rem;
        left: 0.5rem;
    }

    tbody td {
        width: 100vw;
        min-width: 4rem;
        max-width: 4rem;
    }

    tbody th {
        width: calc(100% - 12rem);
    }

    tr.total {
        border-bottom: 4px double #0a0a23;
        font-weight: bold;
    }

    tr.total th {
        text-align: left;
        padding: 0.5rem 0 0.25rem 0.5rem;
    }

    tr.total td {
        text-align: right;
        padding: 0 0.25rem;
    }

    tr.total td:last-of-type {
        padding-right: 0.5rem;
    }

    tr.total:hover {
        background-color: #99c9ff;
    }

    td.current {
        font-style: italic;
    }

    tr.th.name {
        color: #000 !important;
        font-size: 1em !important;
        font-weight: bold !important;
    }

    tr.data {
        background-image: linear-gradient(to bottom, #dfdfe2 1.845rem, white 1.845rem);
    }

    tr.data th {
        text-align: left;
        padding-top: 0.3rem;
        padding-left: 0.5rem;
    }

    tr.data th .description {
        display: block;
        font-weight: normal;
        font-style: italic;
        padding: 1rem 0 0.75rem;
        margin-right: -13.5rem;
    }

    tr.data td {
        vertical-align: top;
        padding: 0.3rem 0.25rem 0;
        text-align: right;
    }

    tr.data td:last-of-type {
        padding-right: 0.5rem;
    }
</style>

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
                            <button class="btn btn-primary mb-3" id="fetchData"> Search </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cash Flow Statement</h4>
                        <h4 class="card-title">
                            <div class="row d-flex">                            
                                <!-- export as print -->
                                <form method="post" action="{{ route('PrintCashFlowStatement') }}">
                                    @csrf
                                    <input type="hidden" name="PrintFilterDate" id="PrintFilterDate">
                                    <button class="btn btn-primary mb-2 mr-1" type="submit"> <i class="fa fa-print color-danger"></i> </button>                    
                                </form>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <main>
                            <section>
                                <h1>
                                    <span class="flex">
                                        <span>Cash Flow Statement</span>
                                    </span>
                                </h1>
                                <div id="years" aria-hidden="true"></div>
                                <div class="table-wrap">

                                    <h4 class="mt-3 mb-1">Operating Activities</h4>

                                    <table>
                                        <caption>Cash Inflows</caption>
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <th><span class="sr-only">Year</span></th>
                                            </tr>
                                        </thead>
                                        <tbody id="cash-inflows-tbody"></tbody>
                                        <tfoot>
                                            <tr class="total">
                                                <th>Total Cash Inflows</th>
                                                <td id="total-cash-inflows"></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <table>
                                        <caption>Cash Outflows</caption>
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <th><span class="sr-only">Year</span></th>
                                            </tr>
                                        </thead>
                                        <tbody id="cash-outflows-tbody"></tbody>
                                        <tfoot>
                                            <tr class="total">
                                                <th>Total Cash Outflows</th>
                                                <td id="total-cash-outflows"></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <table>
                                        <caption>Net Cash Flow</caption>
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <th><span class="sr-only">Year</span></th>
                                            </tr>
                                        </thead>
                                        <tbody id="net-cash-flow-tbody"></tbody>
                                        <tfoot>
                                            <tr class="total">
                                                <th>Total Net Cash Flow</th>
                                                <td id="total-net-cash-flow"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </section>
                        </main>
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

        const PrintFilterDate = $('#PrintFilterDate').val();

        $('#PrintFilterDate').val(FilterData);        

        $.ajax({
            url: '/Search_Cash_Flow_Statement',
            method: 'GET',
            data: { 
                FilterData: FilterData,
                PrintFilterDate: PrintFilterDate
             },
            success: function(data) {
                const cashInflowsTbody = $('#cash-inflows-tbody');
                const cashOutflowsTbody = $('#cash-outflows-tbody');
                const netCashFlowTbody = $('#net-cash-flow-tbody');

                cashInflowsTbody.empty();
                cashOutflowsTbody.empty();
                netCashFlowTbody.empty();

                let totalCashInflows = 0;
                let totalCashOutflows = 0;

                // Append data to respective tables
                data.ManageCashInflows.forEach(function(item) {
                    totalCashInflows += parseFloat(item.TotalAmount);
                    cashInflowsTbody.append(`
                        <tr class="data">
                            <th class="name">${item.FeesTitle}</th>
                            <td>${parseFloat(item.TotalAmount).toFixed(2)}</td>
                        </tr>
                    `);
                });

                data.ManageCashOutflows.forEach(function(item) {
                    totalCashOutflows += parseFloat(item.TotalAmount);
                    cashOutflowsTbody.append(`
                        <tr class="data">
                            <th class="name">${item.Category}</th>
                            <td>${parseFloat(item.TotalAmount).toFixed(2)}</td>
                        </tr>
                    `);
                });

                // Append salaries data to cash outflows table
                data.ManageSalaries.forEach(function(item) {
                    totalCashOutflows += parseFloat(item.TotalAmount);
                    cashOutflowsTbody.append(`
                        <tr class="data">
                            <th class="name">${item.Category}</th>
                            <td>${parseFloat(item.TotalAmount).toFixed(2)}</td>
                        </tr>
                    `);
                });

                // Append utility expenses to cash outflows table
                data.expenseQuery.forEach(function(item) {
                    totalCashOutflows += parseFloat(item.TotalAmount);
                    cashOutflowsTbody.append(`
                        <tr class="data">
                            <th class="name">${item.Category}</th>
                            <td>${parseFloat(item.TotalAmount).toFixed(2)}</td>
                        </tr>
                    `);
                });

                // Calculate and display totals
                $('#total-cash-inflows').text(totalCashInflows.toFixed(2));
                $('#total-cash-outflows').text(totalCashOutflows.toFixed(2));
                $('#total-net-cash-flow').text((totalCashInflows - totalCashOutflows).toFixed(2));
            }
        });
    });
});
</script>

@endsection
