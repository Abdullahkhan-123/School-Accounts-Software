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
            flex-direction: column;
        }

        .header h2 {
            margin-bottom: 10px;
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
            word-wrap: break-word;
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
    <h2>General Journal</h2>
</div>

<table>
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
        <!-- PHP loop to populate data -->
        <?php
        $index = 1;
        $currentBalance = $response['BankAccountData']->Balance; // Initialize with opening balance

        // Render Bank Account opening balance row
        echo '<tr>';
        echo '<td></td>';
        echo '<td colspan="4" style="text:right; font-weight:bold;">Account Of | ' . $response['BankAccountData']->BankName . '</td>';        
        echo '<td>' . number_format($currentBalance, 2) . '</td>';
        echo '</tr>';

        // Render ManageUtlityExpense (Expenses)
        foreach ($response['ManageUtlityExpense'] as $expense) {
            echo '<tr>';
            echo '<td>' . $index++ . '</td>';
            echo '<td>' . $expense->Date . '</td>';
            echo '<td>' . $expense->ExpenseName . '</td>';
            echo '<td>' . number_format($expense->Amount, 2) . '</td>';
            echo '<td></td>';
            $currentBalance -= $expense->Amount; // Deduct expense from balance
            echo '<td>' . number_format($currentBalance, 2) . '</td>';
            echo '</tr>';
        }

        // Render ManageExpense (Expenses)
        foreach ($response['ManageExpense'] as $expense) {
            echo '<tr>';
            echo '<td>' . $index++ . '</td>';
            echo '<td>' . $expense->Date . '</td>';
            echo '<td>' . $expense->ExpenseName . '</td>';
            echo '<td>' . number_format($expense->Amount, 2) . '</td>';
            echo '<td></td>';
            $currentBalance -= $expense->Amount; // Deduct expense from balance
            echo '<td>' . number_format($currentBalance, 2) . '</td>';
            echo '</tr>';
        }

        // Render ManageAssets (Income)
        foreach ($response['ManageAssets'] as $income) {
            echo '<tr>';
            echo '<td>' . $index++ . '</td>';
            echo '<td>' . $income->Date . '</td>';
            echo '<td>' . $income->ExpenseName . '</td>';
            echo '<td></td>';
            echo '<td>' . number_format($income->Paid, 2) . '</td>';
            $currentBalance += $income->Paid; // Add income to balance
            echo '<td>' . number_format($currentBalance, 2) . '</td>';
            echo '</tr>';
        }

        // Render PaymentRecords (Income)
        foreach ($response['PaymentRecords'] as $income) {
            echo '<tr>';
            echo '<td>' . $index++ . '</td>';
            echo '<td>' . $income->FeeExpDate . '</td>';
            echo '<td>' . $income->FeesName . '</td>';
            echo '<td></td>'; // No debit for income
            echo '<td>' . number_format($income->Paid, 2) . '</td>'; // Display income amount
            $currentBalance += $income->Paid; // Add income to balance
            echo '<td>' . number_format($currentBalance, 2) . '</td>';
            echo '</tr>';
        }

        // Render closing balance row
        echo '<tr>';
        echo '<td></td>';
        echo '<td colspan="4" style="text:right; font-weight:bold;">Closing Balance</td>';        
        echo '<td>' . number_format($currentBalance, 2) . '</td>';
        echo '</tr>';
        ?>
    </tbody>
</table>

</body>
</html>