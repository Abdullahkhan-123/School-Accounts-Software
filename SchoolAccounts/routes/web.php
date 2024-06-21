<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

// Route::get('/', function () {
//     return view('welcome');
// });




Route::view('/', 'page-login')->name('SignIn');

Route::post('SignIn', [adminController::class, 'SignInAdmin'])->name('SignInAdmin');

Route::get('Logout', [adminController::class, 'Logout'])->name('Logout');

Route::view('login', 'Super_Admin_login');

Route::post('Super_Admin_login', [adminController::class, 'SuperAdminlogin'])->name('SuperAdminlogin');

Route::get('Super_Dashboard', [adminController::class, 'SuperDashboard'])->name('SuperDashboard');

Route::get('Visit_Panel/{id}', [adminController::class, 'AdminVisitPanel'])->name('AdminVisitPanel');

// Start Manage Classes
Route::view('AddClasses', 'ManageClasses.AddClasses')->name('AddClasses');

Route::post('SaveClasses', [adminController::class, 'SaveClasses'])->name('SaveClasses');

Route::get('ViewAllClasses', [adminController::class, 'ViewAllClasses'] )->name('ViewAllClasses');

Route::get('EditClass/{id}', [adminController::class, 'EditClass'] )->name('EditClass');

Route::get('DropClass/{id}', [adminController::class, 'DropClass'] )->name('DropClass');

Route::post('UpdateClass/{id}', [adminController::class, 'UpdateClass'] )->name('UpdateClass');
// End Manage Classes

// Start Admit Student
Route::get('AdmitStudent', [adminController::class,'AdmitStudent'])->name('AdmitStudent');

Route::post('SaveAdmitStudent', [adminController::class,'SaveAdmitStudent'])->name('SaveAdmitStudent');

Route::get('ViewAllStudent', [adminController::class,'ViewAllStudent'])->name('ViewAllStudent');

Route::get('DropStudent/{id}', [adminController::class,'DropStudent'])->name('DropStudent');

Route::get('EditStudent/{id}', [adminController::class,'EditStudent'])->name('EditStudent');

Route::post('UpdateStudent/{id}', [adminController::class,'UpdateStudent'])->name('UpdateStudent');

Route::get('StudentDetails/{id}', [adminController::class,'StudentDetails'])->name('StudentDetails');
// End Admit Student


// Start Expense Category
Route::view('Expense-Category', 'ManageExpenseCategory.ExpenseCategory')->name('ExpenseCategory');

Route::post('Save-Expense-Category', [adminController::class, 'SaveExpenseCategory'])->name('SaveExpenseCategory');

Route::get('All-Expense-Category', [adminController::class, 'AllExpenseCategory'])->name('AllExpenseCategory');

Route::get('Drop-Expense-Category/{id}', [adminController::class, 'DropExpenseCategory'])->name('DropExpenseCategory');

Route::get('Edit-Expense-Category/{id}', [adminController::class, 'EditExpenseCategory'])->name('EditExpenseCategory');

Route::post('Update-Expense-Category/{id}', [adminController::class, 'UpdateExpenseCategory'])->name('UpdateExpenseCategory');
// End Expense Category

// Start Manage Expense Category
Route::get('Manage-Expense-Category', [adminController::class, 'ManageExpenseCategory'])->name('ManageExpenseCategory');

Route::post('Save-Manage-Expense', [adminController::class, 'SaveManageExpense'])->name('SaveManageExpense');

Route::get('All-Manage-Expense', [adminController::class, 'AllManageExpense'])->name('AllManageExpense');

Route::get('Drop-Manage-Expense/{id}', [adminController::class, 'DropManageExpense'])->name('DropManageExpense');

Route::get('Edit-Manage-Expense/{id}', [adminController::class, 'EditManageExpense'])->name('EditManageExpense');

Route::post('Update-Manage-Expense/{id}', [adminController::class, 'UpdateManageExpense'])->name('UpdateManageExpense');

Route::view('Expense_Report', 'ManageExpenseReport.ExpenseReport')->name('Expense_Report');

Route::get('Search_Expense_Report', [adminController::class, 'SearchExpenseReport'])->name('SearchExpenseReport');

Route::get('Print_All_Liability_Manage_Expense', [adminController::class, 'PrintAllLiabilityManageExpense'])->name('PrintAllLiabilityManageExpense');

Route::post('Print_Liability_Expense_Report', [adminController::class, 'PrintLiabilityExpenseReport'])->name('PrintLiabilityExpenseReport');

Route::get('Print_Liability_Expense_Invoice/{id}', [adminController::class, 'PrintLiabilityExpenseInvoice'])->name('PrintLiabilityExpenseInvoice');
// End Manage Expense Category

// Start Assets Category
Route::view('Assets-Category', 'AssetsCategory.Assets')->name('AssetsCategory');

Route::post('Save-Assets-Category', [adminController::class, 'SaveAssetsCategory'])->name('SaveAssetsCategory');

Route::get('All-Assets-Categories', [adminController::class, 'AllAssetsCategories'])->name('AllAssetsCategories');

Route::get('Drop-Assets-Category/{id}', [adminController::class, 'DropAssetsCategories'])->name('DropAssetsCategories');

Route::get('Edit-Assets-Category/{id}', [adminController::class, 'EditAssetsCategories'])->name('EditAssetsCategories');

Route::post('Update-Assets-Category/{id}', [adminController::class, 'UpdateAssetsCategories'])->name('UpdateAssetsCategories');
// End Assets Category

// Start Assets Manage
Route::get('Manage-Assets-Category', [adminController::class, 'ManageAssetsCategory'])->name('ManageAssetsCategory');

Route::post('Save-Assets-Manage', [adminController::class, 'SaveAssetsManage'])->name('SaveAssetsManage');

Route::get('All-Assets-Manage', [adminController::class, 'AllAssetsManage'])->name('AllAssetsManage');

Route::get('Drop-Assets-Manage/{id}', [adminController::class, 'DropAssetsManage'])->name('DropAssetsManage');

Route::get('Edit-Assets-Manage/{id}', [adminController::class, 'EditAssetsManage'])->name('EditAssetsManage');

Route::post('Update-Assets-Manage/{id}', [adminController::class, 'UpdateAssetsManage'])->name('UpdateAssetsManage');

Route::view('Assets_Report', 'ManageAssets.AllAssetsReport')->name('AssetsReport');

Route::get('Search_Asset_Report', [adminController::class, 'SearchAssetReport'])->name('SearchAssetReport');

Route::get('Print_All_Assets_Manage', [adminController::class, 'PrintAllAssetsManage'])->name('PrintAllAssetsManage');

Route::post('Print_Assets_Report', [adminController::class, 'PrintAssetsReport'])->name('PrintAssetsReport');

Route::get('Print_Assets_Invoice/{id}', [adminController::class, 'PrintAssetsInvoice'])->name('PrintAssetsInvoice');
// End Assets Manage


// Start Bank Account Manage
Route::view('Manage-Bank-Accounts', 'ManageBankAccounts.BankAccount')->name('BankAccounts');

Route::post('Save-Bank-Accounts', [adminController::class, 'SaveBankAccounts'])->name('SaveBankAccounts');

Route::get('All-Bank-Accounts', [adminController::class, 'AllBankAccounts'])->name('AllBankAccounts');

Route::get('Drop-Bank-Accounts/{id}', [adminController::class, 'DropBankAccounts'])->name('DropBankAccounts');

Route::get('Edit-Bank-Accounts/{id}', [adminController::class, 'EditBankAccounts'])->name('EditBankAccounts');

Route::post('Update-Bank-Accounts/{id}', [adminController::class, 'UpdateBankAccounts'])->name('UpdateBankAccounts');
// End Bank Account Manage

// Start Fees Manage
Route::get('Manage-Fees', [adminController::class, 'ManageFees'])->name('ManageFees');

Route::post('Save-Fees-Category', [adminController::class, 'SaveFeesCategory'])->name('SaveFeesCategory');

Route::get('All-Fees-Category', [adminController::class, 'AllFeesCategory'])->name('AllFeesCategory');

Route::get('Drop-Fees-Category/{id}', [adminController::class, 'DropFeesCategory'])->name('DropFeesCategory');

Route::get('Edit-Fees-Category/{id}', [adminController::class, 'EditFeesCategory'])->name('EditFeesCategory');

Route::post('Update-Fees-Category/{id}', [adminController::class, 'UpdateFeesCategory'])->name('UpdateFeesCategory');
// End Fees Manage

// Start Staff Accounts Manage
Route::get('Staff_Account', [adminController::class, 'StaffAccount'])->name('StaffAccount');

Route::post('Staff_Account', [adminController::class, 'SaveStaffAccount'])->name('SaveStaffAccount');

Route::get('View_Staff_Account', [adminController::class, 'ViewStaffAccount'])->name('ViewStaffAccount');

Route::get('Edit_Staff_Account/{id}', [adminController::class, 'EditStaffAccount'])->name('EditStaffAccount');

Route::post('Update_Staff_Account/{id}', [adminController::class, 'UpdateStaffAccount'])->name('UpdateStaffAccount');

Route::get('Drop_Staff_Account/{id}', [adminController::class, 'DropStaffAccount'])->name('DropStaffAccount');

Route::get('Staff_Create_Password/{id}', [adminController::class, 'StaffCreatePassword'])->name('StaffCreatePassword');

Route::post('Staff_Create_Password/{id}', [adminController::class, 'SaveStaffCreatePassword'])->name('SaveStaffCreatePassword');

Route::get('Active_Staff_Account/{id}', [adminController::class, 'ActiveStaffAccount'])->name('ActiveStaffAccount');

Route::get('Deactivate_Staff_Account/{id}', [adminController::class, 'DeactivateStaffAccount'])->name('DeactivateStaffAccount');


Route::get('Staff_Profile_Detail/{id}', [adminController::class,'StaffProfileDetail'])->name('StaffProfileDetail');
// End Staff Accounts Manage

// Start Student Fees Manage
Route::get('Student_Fees', [adminController::class, 'StudentFees'])->name('StudentFees');

Route::get('SearchStudentInformation', [adminController::class, 'SearchStudentInformation'])->name('SearchStudentInformation');

Route::get('Student_All_Payments/{id}', [adminController::class, 'StudentAllPayments'])->name('StudentAllPayments');

Route::get('Make_Students_Payment/', [adminController::class, 'MakeStudentsPayment'])->name('MakeStudentsPayment');

Route::post('MakePayment', [adminController::class, 'MakePayment'])->name('MakePayment');

Route::post('All_Payment_Records', [adminController::class, 'AllPaymentRecords'])->name('AllPaymentRecords');

Route::post('Student_Quick_Payment/{id}', [adminController::class, 'StudentQuickPayment'])->name('StudentQuickPayment');

Route::post('Student_Partial_Payment/{id}', [adminController::class, 'StudentPartialPayment'])->name('StudentPartialPayment');
// End Student Fees Manage

// Start Manage Salary
Route::get('Manage_Employee_Salary', [adminController::class, 'ManageEmployeeSalary'])->name('ManageEmployeeSalary'); 

Route::get('get_employee_salary/{id}', [adminController::class, 'getEmployeeSalary'])->name('getEmployeeSalary');

Route::post('Save_Employee_Salary', [adminController::class, 'SaveEmployeeSalary'])->name('SaveEmployeeSalary');

Route::get('All_Employee_Salaries', [adminController::class, 'AllEmployeeSalaries'])->name('AllEmployeeSalaries');

Route::get('Drop_Employee_Salaries/{id}', [adminController::class, 'DropEmployeeSalaries'])->name('DropEmployeeSalaries');
// End Manage Salary 

// Start Income & Expense Reports
Route::get('Income_Loss_Statements', [adminController::class, 'ProfitLossStatements'])->name('ProfitLossStatements');

Route::post('Print_Income_Loss_Statements', [adminController::class, 'PrintIncomeLossStatements'])->name('PrintIncomeLossStatements');

Route::get('Search_Profit_Loss_Statements', [adminController::class, 'SearchProfitLossStatements'])->name('SearchProfitLossStatements');

Route::get('Balance_Sheet', [adminController::class, 'BalanceSheet'])->name('BalanceSheet');

Route::post('Print_Balance_Sheet', [adminController::class, 'PrintBalanceSheet'])->name('PrintBalanceSheet');

Route::get('Search_Balance_Sheet', [adminController::class, 'SearchBalanceSheet'])->name('SearchBalanceSheet');

Route::view('Cash_Flow_Statement',  'Manage_Income_Expense_Reports.Cash_Flow_Statement')->name('CashFlowStatement');

Route::post('Print_Cash_Flow_Statement',  [adminController::class, 'PrintCashFlowStatement'])->name('PrintCashFlowStatement');

Route::get('Search_Cash_Flow_Statement',  [adminController::class, 'SearchCashFlowStatement'])->name('SearchCashFlowStatement');

Route::get('General_Journal', [adminController::class, 'GeneralJournal'])->name('GeneralJournal');

Route::get('Search_General_Journal', [adminController::class, 'SearchGeneralJournal'])->name('SearchGeneralJournal');

Route::post('Print_General_Journal', [adminController::class, 'PrintGeneralJournal'])->name('PrintGeneralJournal');
// End Income & Expense Reports

// Start Audit Trails
Route::view('Transaction_Logs',  'Audit_Trails.Transaction_Logs')->name('TransactionLogs');

Route::get('Search_Transaction_Logs', [adminController::class, 'SearchTransactionLogs'])->name('SearchTransactionLogs');

Route::post('Print_Transaction_Logs', [adminController::class, 'PrintTransactionLogs'])->name('PrintTransactionLogs');
// End Audit Trails

// Start Reporting and Analytics
Route::get('charts', [adminController::class, 'GarphicalCharts'])->name('dashboard');
// End Reporting and Analytics


// Start Utlity Expense
Route::get('Expense_Category', [adminController::class, 'UtlityExpenseCategory'])->name('UtlityExpenseCategory');

Route::post('Save_Expense_Category', [adminController::class, 'SaveUtlityExpenseCategory'])->name('SaveUtlityExpenseCategory');

Route::get('All_Expense_Category', [adminController::class, 'AllUtlityExpenseCategory'])->name('AllUtlityExpenseCategory');

Route::get('Drop_Expense_Category/{id}', [adminController::class, 'DropUtlityExpenseCategory'])->name('DropUtlityExpenseCategory');

Route::get('Edit_Expense_Category/{id}', [adminController::class, 'EditUtlityExpenseCategory'])->name('EditUtlityExpenseCategory');

Route::post('Update_Expense_Category/{id}', [adminController::class, 'UpdateUtlityExpenseCategory'])->name('UpdateUtlityExpenseCategory');
// End Utlity Expense

// Start Manage Utlity Expense
Route::get('Manage_Expense', [adminController::class, 'ManageUtlityExpense'])->name('ManageUtlityExpense');

Route::post('Save_Manage_Expense', [adminController::class, 'SaveManageUtlityExpense'])->name('SaveManageUtlityExpense');

Route::get('All_Manage_Expense', [adminController::class, 'AllManageUtlityExpense'])->name('AllManageUtlityExpense');

Route::get('Drop_Manage_Expense/{id}', [adminController::class, 'DropManageUtlityExpense'])->name('DropManageUtlityExpense');

Route::get('Edit_Manage_Expense/{id}', [adminController::class, 'EditManageUtlityExpense'])->name('EditManageUtlityExpense');

Route::post('Update_Manage_Expense/{id}', [adminController::class, 'UpdateManageUtlityExpense'])->name('UpdateManageUtlityExpense');

Route::view('Utlity_Expense_Report', 'Manage_Utlity_Expense.Utlity_Expense_Report')->name('UtlityExpenseReport');

Route::get('Search_Utlity_Expense_Report', [adminController::class, 'SearchUtlityExpenseReport'])->name('SearchUtlityExpenseReport');

Route::get('Print_All_Manage_Expense', [adminController::class, 'PrintAllManageExpense'])->name('PrintAllManageExpense');

Route::post('Print_Expense_Report', [adminController::class, 'PrintExpenseReport'])->name('PrintExpenseReport');

Route::get('Print_Expense_Invoice/{id}', [adminController::class, 'PrintExpenseInvoice'])->name('PrintExpenseInvoice');
// End Manage Utlity Expense