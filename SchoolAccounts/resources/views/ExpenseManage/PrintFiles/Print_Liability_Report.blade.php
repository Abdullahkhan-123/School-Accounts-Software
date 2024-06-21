<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #593bdb;
            color: white;
            padding: 20px 0;
            margin-bottom: 20px;
            flex-direction: column; /* Flex direction changed to column */
        }

        .header h2 {
            margin-bottom: 10px; /* Added margin bottom for spacing */
        }

        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            table-layout: auto;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
            word-wrap: break-word; /* Allow text to wrap within the cell */
        }

        th {
            background-color: #593bdb;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        /* Print styles */
        @media print {
            body {
                background-color: white;
            }

            .header {
                background-color: #593bdb !important;
                -webkit-print-color-adjust: exact; /* Ensure the color prints correctly */
            }

            th {
                background-color: #593bdb !important;
                color: white !important;
                -webkit-print-color-adjust: exact; /* Ensure the color prints correctly */
            }

            table {
                width: 100%; /* Use full width for the table in print */
                margin: 0;
            }

            th, td {
                word-wrap: break-word; /* Allow text to wrap within the cell */
            }
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
</head>
<body>

<div class="header">
    <h2>Liability Expense Report</h2>
    
    <!-- Move datefilter div into a new row -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="datefilter">
                <h2>From {{ $filterDate[0] }} To {{ $filterDate[1] }}</h2>
            </div>
        </div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>HEAD OF EXPENSE</th>
            <th>DATE</th>
            <th>DEBIT BY</th>
            <th>AMOUNT</th>
            <th>SHORT DETAIL</th>
        </tr>
    </thead>
    <tbody>

        @php $No = 1; @endphp
        @foreach($ExpenseReport as $Expense)

        <tr>
            <td>{{ $No++ }}</td>
            <td>{{ $Expense->ExpenseName }}</td>
            <td>{{ $Expense->Date }}</td>
            <td>{{ $Expense->BankName . ' - ' . $Expense->BankTitle . ' - ' . $Expense->BankAccountType}}</td>
            <td>{{ $Expense->Amount }}</td>
            <td>{{ Str::words($Expense->Description, 5, '') }}</td>
        </tr>    

        @endforeach
    </tbody>
</table>

</body>
</html>
