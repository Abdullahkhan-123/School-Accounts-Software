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
        z-index: 999;
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
        top: -2.25rem;
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
                        <h4 class="card-title">Balance Sheet</h4>
                        <h4 class="card-title">
                            <div class="row d-flex">
                                <!-- export as print -->
                                <form method="post" action="{{ route('PrintBalanceSheet') }}">
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
                                    <span>Balance Sheet</span>
                                </span>
                            </h1>
                            <div id="years" aria-hidden="true"></div>
                            <div class="table-wrap">
                                <table>
                                    <caption>Assets</caption>
                                    <thead id="assets-thead"></thead>
                                    <tbody id="assets-tbody"></tbody>
                                    <tfoot>
                                        <tr class="total" id="assets-total">
                                            <!-- Out Show here -->
                                        </tr>
                                    </tfoot>
                                </table>

                                <table>
                                    <caption>Liabilities</caption>
                                    <thead id="liabilities-thead"></thead>
                                    <tbody id="liabilities-tbody"></tbody>
                                    <tfoot>
                                        <tr class="total" id="liabilities-total">
                                            <!-- Out Show here -->
                                        </tr>
                                    </tfoot>
                                </table>

                                <table>
                                    <caption>Net Capital</caption>
                                    <thead id="networth-thead"></thead>
                                    <tbody id="networth-tbody"></tbody>
                                    <tfoot>
                                        <tr class="total" id="networth-total">
                                            <!-- Out Show here -->
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                        </section>
                    </main>
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
            url: '/Search_Balance_Sheet',
            method: 'GET',
            data: { 
                FilterData: FilterData,
                PrintFilterDate: PrintFilterDate
            },
            success: function(data) {
                const assetsTbody = $('#assets-tbody');
                const liabilitiesTbody = $('#liabilities-tbody');
                const networthTbody = $('#networth-tbody');
                const assetsThead = $('#assets-thead');
                const liabilitiesThead = $('#liabilities-thead');
                const networthThead = $('#networth-thead');
                const yearsDiv = $('#years');
                const assetsTotalRow = $('#assets-total');
                const liabilitiesTotalRow = $('#liabilities-total');
                const networthTotalRow = $('#networth-total');

                assetsTbody.empty();
                liabilitiesTbody.empty();
                networthTbody.empty();
                assetsThead.empty();
                liabilitiesThead.empty();
                networthThead.empty();
                yearsDiv.empty();
                assetsTotalRow.empty();
                liabilitiesTotalRow.empty();
                networthTotalRow.empty();

                let totalAssets = {};
                let totalLiabilities = {};
                let totalNetWorth = {};

                // Populate years header
                data.Years.forEach(year => {
                    yearsDiv.append(`<span class="">${year}</span>`);
                    totalAssets[year] = 0;
                    totalLiabilities[year] = 0;
                    totalNetWorth[year] = 0;
                });

                // Create table headers dynamically
                let theadContent = '<tr><td></td>';
                data.Years.forEach(year => {
                    theadContent += `<th><span class="sr-only">${year}</span></th>`;
                });
                theadContent += '</tr>';
                assetsThead.append(theadContent);
                liabilitiesThead.append(theadContent);
                networthThead.append(theadContent);

                // Populate assets table
                data.ManageAssets.forEach(item => {
                    data.Years.forEach(year => {
                        totalAssets[year] += parseFloat(item.TotalAmount);
                    });

                    assetsTbody.append(`
                        <tr class="data">
                            <th class="name">${item.Category}</th>
                            ${data.Years.map(year => `<td>${parseFloat(item.TotalAmount).toFixed(2)}</td>`).join('')}
                        </tr>
                    `);
                });

                // Populate liabilities table
                data.ExpenseReport.forEach(item => {
                    data.Years.forEach(year => {
                        totalLiabilities[year] += parseFloat(item.TotalAmount);
                    });

                    liabilitiesTbody.append(`
                        <tr class="data">
                            <th class="name">${item.Category}</th>
                            ${data.Years.map(year => `<td>${parseFloat(item.TotalAmount).toFixed(2)}</td>`).join('')}
                        </tr>
                    `);
                });

                // Calculate net worth and update tables
                let assetsTotalAppended = false;
                let liabilitiesTotalAppended = false;
                let networthTotalAppended = false;

                // Calculate net worth and update tables                
                data.Years.forEach(year => {
                    totalNetWorth[year] = totalAssets[year] - totalLiabilities[year];

                    // Append total rows only if not already appended
                    if (!assetsTotalAppended) {
                        // Append an empty <td> for the first column
                        assetsTotalRow.append(`<td></td>`);
                        // Append total assets for each year
                        data.Years.forEach(year => {
                            assetsTotalRow.append(`<td>${totalAssets[year].toFixed(2)}</td>`);
                        });
                        // Set the flag to true
                        assetsTotalAppended = true;
                    }

                    if (!liabilitiesTotalAppended) {
                        // Append total liabilities for each year
                        liabilitiesTotalRow.append(`<td></td>`);
                        data.Years.forEach(year => {
                            liabilitiesTotalRow.append(`<td>${totalLiabilities[year].toFixed(2)}</td>`);
                        });
                        // Set the flag to true
                        liabilitiesTotalAppended = true;
                    }

                    if (!networthTotalAppended) {
                        // Append total net worth for each year
                        networthTotalRow.append(`<td></td>`);
                    }

                    // Append total net worth for the current year
                    networthTotalRow.append(`<td style="float: right;">${totalNetWorth[year].toFixed(2)}</td>`);
                    // Set the flag to true
                    networthTotalAppended = true;
                });
            }
        });
    });
});
</script>

@endsection