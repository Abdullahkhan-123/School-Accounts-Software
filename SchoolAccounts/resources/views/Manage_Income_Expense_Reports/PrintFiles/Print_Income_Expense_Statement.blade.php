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
</head>
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

<div class="header">
    <h2>Income And Expense Statements</h2>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>HEAD OF EXPENSE</th>            
            <th>DEBIT BY</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    
    <tbody>
        <!-- Income Records -->
        <tr>
            <td></td>
            <td colspan="4" class="IncomeDiv" style="font-weight: bold; font-size: 20px;">Income Records</td>
        </tr>
            @php
                $totalIncome = 0;
            @endphp
            @foreach($response['payments'] as $index => $payment)        
                @php
                    $totalIncome += $payment->Paid;
                @endphp
            @endforeach

            <tr>
                <td></td>
                <td colspan="2" class="text-center font-weight-bold">Fees Collection Income</td>
                <td>{{ $totalIncome }}</td>
            </tr>

        <!-- Expenses Records -->
        <tr>
            <td></td>
            <td colspan="4" class="text-center font-weight-bold" style="font-weight: bold; font-size: 20px;">Expenses Records</td>
        </tr>
        @php
            $totalExpense = 0;
        @endphp
        @foreach($response['expenses'] as $index => $expense)
            <tr>
                <td></td>
                <td>{{ $expense->ExpenseName }}</td>
                <td>{{ $expense->BankName }} - {{ $expense->BankTitle }} - {{ $expense->BankAccountType }}</td>
                <td>{{ number_format($expense->Amount, 2) }}</td>
            </tr>
            @php
                $totalExpense += $expense->Amount;
            @endphp
        @endforeach

        <!-- Total rows -->

        <tr>
            <td></td>
            <td colspan="4" class="IncomeDiv" style="font-weight: bold; font-size: 20px;">Report Calculation</td>
        </tr>

        <tr>
            <td></td>
            <td colspan="2" class="text-right font-weight-bold">Total Expense:</td>
            <td>{{ number_format($totalExpense, 2) }}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="text-right font-weight-bold">Total Income:</td>
            <td>{{ number_format($totalIncome, 2) }}</td>
        </tr>
        <tr>
            <td></td>            
            <td colspan="2" class="text-right font-weight-bold">Total Profit:</td>
            <td>{{ number_format($totalIncome - $totalExpense, 2) }}</td>
        </tr>
    </tbody>

</table>

</body>
</html>
