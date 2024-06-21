<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

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
        max-width: 100%;
        margin: 0 auto;
        padding: 1.5rem 1.25rem 1.5rem;
        border-bottom: 20px solid black;
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

<script>
    window.onbeforeprint = function() {
        console.log("Before print event triggered.");
    };

    window.onafterprint = function() {
        window.history.back();
    };

    window.onload = function() {
        window.print();
    };
</script>
<body>
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="card">
                    
                        <div class="card-body">
                            <main>
                                <section>
                                    <h1>
                                        <span class="flex">
                                            <span>Cash Flow Statement</span>
                                        </span>
                                    </h1>                                    
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
                                            <tbody>
                                                @foreach($data['ManageCashInflows'] as $item)
                                                <tr class="data">
                                                    <th class="name">{{ $item->FeesTitle }}</th>
                                                    <td>{{ number_format($item->TotalAmount) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="total">
                                                    <th>Total Cash Inflows</th>
                                                    <td>{{ number_format($data['totalCashInflows']) }}</td>
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
                                            <tbody>
                                                @foreach($data['ManageCashOutflows'] as $item)
                                                <tr class="data">
                                                    <th class="name">{{ $item->Category }}</th>
                                                    <td>{{ number_format($item->TotalAmount) }}</td>
                                                </tr>
                                                @endforeach

                                                @foreach($data['ManageSalaries'] as $item)
                                                <tr class="data">
                                                    <th class="name">{{ $item->Category }}</th>
                                                    <td>{{ number_format($item->TotalAmount) }}</td>
                                                </tr>
                                                @endforeach

                                                @foreach($data['expenseQuery'] as $item)
                                                <tr class="data">
                                                    <th class="name">{{ $item->Category }}</th>
                                                    <td>{{ number_format($item->TotalAmount) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="total">
                                                    <th>Total Cash Outflows</th>
                                                    <td>{{ number_format($data['totalCashOutflows']) }}</td>
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
                                            <tbody>
                                                <tr class="data">
                                                    <th class="name">Net Cash Flow</th>
                                                    <td>{{ number_format($data['netCashFlow']) }}</td>
                                                </tr>
                                            </tbody>
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
</body>
</html>