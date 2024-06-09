<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\admins;
use App\Models\SuperAdmin;
use App\Models\SClass;
use App\Models\admitStudent;
use App\Models\ExpenceCategory;
use App\Models\AssetsCategory;
use App\Models\ManageAssets;
use App\Models\BankAccount;
use App\Models\ManageExpense;
use App\Models\FeesCategory;
use App\Models\StaffAccount;
use App\Models\PaymentRecords;
use App\Models\ManageSalary;
use App\Models\UtlityExpenseCategory;
use App\Models\ManageUtlityExpense;

use Session;
use Carbon\Carbon;
use Crypt;
use Auth;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\StaffCreatePassword;
use Illuminate\Support\Facades\Mail;

class adminController extends Controller
{

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function SignInAdmin(Request $req){

        $admin = admins::where('Email', $req->input('Email'))->first();

        if ($admin) {
            if ($admin->Password == $req->input('Password')) {
                $req->session()->put('AcademyCode', $admin->AcademyCode);
                return redirect()->route('dashboard');
            } else {
                Session::flash('status', 'User Email or Password is In-correct!!');
                return redirect()->back();
            }
        } else {
            // Check in staff_accounts table
            $staff = DB::table('staff_accounts')->where('Email', $req->input('Email'))->first();

            if ($staff) {
                if ($staff->AccountType == 'Accountant') {
                    if ($staff->Password == $req->input('Password')) {
                        $req->session()->put('AcademyCode', $staff->AcademyCode);
                        $req->session()->put('AccountType', $staff->AccountType);
                        return redirect()->route('AllManageExpense');
                    } else {
                        Session::flash('status', 'User Email or Password is In-correct!!');
                        return redirect()->back();
                    }
                } else {
                    Session::flash('status', 'This user not have access to login.');
                    return redirect()->back();
                }
            } else {
                Session::flash('status', 'User Email or Password is In-correct!!');
                return redirect()->back();
            }
        }
    }

    public function SuperAdminlogin(Request $req){
        $admin = SuperAdmin::where('Email', $req->input('Email'))->get();

        if ($admin->isEmpty()) {
            Session::flash('status', 'User Email or Password is In-correct!!');
            return redirect()->back();
        }
            
        if(($admin[0]->Password) == $req->input('Password'))
        {
            $req->session()->put('SuperAdmin', $admin[0]->AccountCode);
            return redirect()->route('SuperDashboard');
        } else {
            $req->session()->flash('status', 'User Email or Password is In-correct!!');
            return redirect()->back();
        }
    }

    public function SuperDashboard(){
        $admin = admins::all();
        return view('SuperAdmin.Dashboard', ['admin' => $admin]);
    }

    public function AdminVisitPanel($id){

        // Check if 'AcademyCode' session exists and remove it
        if (Session::has('AcademyCode')) {
            Session::forget('AcademyCode');
        }
        // Set new 'AcademyCode' session
        Session::put('AcademyCode', $id);
        return redirect()->route('dashboard');
    }

    // Start Manage Classes
    public function SaveClasses(Request $req){
        try {
    
            // Create an array to store all the new class entries
            $newClasses = [];
    
            // Loop through each class entry submitted in the form
            foreach ($req->AdmitClass as $class) {
                // Create a new AdminAddClass object
                $SClass = new SClass;
    
                // Generate a unique code for the class
                do {
                    $uniqueID = Str::random(50);
                } while (SClass::where('UniqueCode', $uniqueID)->exists());
    
                // Get the admin session
                $admin = session()->get('AcademyCode', []);
    
                // Check if the class already exists within the specified AcademyCode
                $existingClass = SClass::where('Class', $class)
                                              ->where('AcademyCode', $admin)
                                              ->first();
    
                // If the class already exists in the academy, skip adding it and return an error message
                if ($existingClass) {
                    $req->session()->flash('status', 'One or more classes already exist in the specified academy.');
                    return redirect()->route('AddClasses');
                }
    
                $admin = session()->get('AcademyCode', '');

                // Otherwise, add the class entry to the array                
                $newClasses[] = [
                    'Class' => $class,
                    'AcademyCode' => $admin, // Use $admin here
                    'UniqueCode' => $uniqueID
                ];
            }
    
            // Bulk insert all the new class entries
            SClass::insert($newClasses);
    
            // Flash success message
            $req->session()->flash('Success_status', 'Classes Added Successfully!');
            return redirect()->route('ViewAllClasses');
    
        } catch (\Exception $e) {
            // Log the error message for debugging
            \Log::error('Error adding classes: ' . $e->getMessage());
    
            // Flash error message
            $req->session()->flash('status', 'Failed to add classes. Please try again later.');
            return redirect()->route('ViewAllClasses');
        }
    }

    public function ViewAllClasses(){
        $admin = session()->get('AcademyCode', []);
        $GetAdminClass = SClass::where('AcademyCode', '=', $admin)->get();
        return view('ManageClasses.ViewAllClasses', ['GetAdminClass' => $GetAdminClass]);
    }

    public function EditClass($id){
        $EditClass = SClass::where('UniqueCode', '=', $id)->first();
        return view('ManageClasses.EditClass', ['EditClass' => $EditClass]);
    }

    public function UpdateClass(Request $req, $id){

        // Get the admin session
        $admin = session()->get('AcademyCode', []);

        $EditClass = SClass::where('UniqueCode', '=', $id)->first();

        // Check if the class already exists within the specified AcademyCode
        $existingClass = SClass::where('Class', $req->AdmitClass)
                ->where('AcademyCode', $admin)
                ->first();

        // If the class already exists in the academy, return an error message
        if ($existingClass) {
        $req->session()->flash('status', 'This class already exists in the specified academy.');
        return redirect()->route('EditClass', $id);
        }

        $EditClass->Class = $req->AdmitClass;
        $EditClass->save();

        Session::flash('Success_status', 'Class updated Succesfully!');
        return redirect()->route('ViewAllClasses');
    }

    public function DropClass($id){
        $AdminAddClass = SClass::where('id', $id)->delete();    
        Session::flash('Success_status', 'Class deleted Succesfully!');
        return redirect()->back();
    }
    // End Manage Classes

    // Start Admit Student
    public function AdmitStudent(){
        
        $admin = session()->get('AcademyCode', []);
        $AllClasses = SClass::where('AcademyCode', '=', $admin)->get();

        $FeesCategory = FeesCategory::join('s_classes', 'fees_categories.ClassID', '=', 's_classes.id')            
            ->select('fees_categories.*', 's_classes.Class as ClassName')            
            ->where('fees_categories.AcademyCode', $admin)
            ->get();

        return view('AdmitStudentManage.AdmitStudent', [
            'AllClasses' => $AllClasses,             
            'FeesCategory' => $FeesCategory
        ]);
    }

    public function SaveAdmitStudent(Request $req){

        $admin = session()->get('AcademyCode', []);

        $AdmitStudent = new AdmitStudent;
        
        // Generate a unique code for the class
        do {
            $UniqueID = Str::random(6);
        } while (AdmitStudent::where('AcademyCode', $UniqueID)->exists());

        $AdmitStudent->SName = $req->SName;
        $AdmitStudent->SGender = $req->SGender;
        $AdmitStudent->SDOB = $req->SDOB;
        // $AdmitStudent->SImage = $req->SImage;

        $AdmitStudent->FName = $req->FName;
        $AdmitStudent->FCard = $req->FCard;
        $AdmitStudent->FEmail = $req->FEmail;
        $AdmitStudent->FPhone = $req->FPhone;
        $AdmitStudent->MPhone = $req->MPhone;
        $AdmitStudent->Religion = $req->Religion;
        $AdmitStudent->HomeAddress = $req->HomeAddress;

        $AdmitStudent->MonthlyFee = $req->MonthlyFee;
        $AdmitStudent->IsDiscountedStudent = $req->IsDiscountedStudent;
        $AdmitStudent->WelcomeSmsAlert = $req->WelcomeSmsAlert;
        $AdmitStudent->GererateAdmissionFee = $req->GererateAdmissionFee;

        $AdmitStudent->ClassID = $req->Class;
        $AdmitStudent->AdmissionDate = $req->AdmissionDate;

        $AdmitStudent->AcademyCode = $admin;
        $AdmitStudent->UniqueCode = $UniqueID;

        if($req->WelcomeSmsAlert == 'Yes'){
            $sid = getenv("TWILIO_SID");
            $token = getenv("TWILIO_Token");
            $senderNo = getenv("TWILIO_Phone");

            $twilio = new Client($sid, $token);

            $academy = admin::where('AcademyCode', '=', $admin)->first();
            $academyname = $academy->AcademyName;

            $message = $twilio->messages
                ->create($req->FPhone, [
                    "body" => 'Thank you for admit your child at our academy. signature from '.$academyname, 
                    "from" => $senderNo
                ]
            );
        }

        // Handle file upload
        if ($req->hasFile('SImage')) {

            $file = $req->file('SImage');
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Define allowed extensions for both images and videos
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
        
            // Check if the extension is allowed
            if (in_array(strtolower($extension), $allowedExtensions)) {
                // Generate a unique filename
                $filename = time() . '.' . $extension;
                
                // Move the file to the appropriate directory
                $file->move('uploads/student_images', $filename);
                
                // Set the filename in the model
                $AdmitStudent->SImage = $filename;
            } else {
                // Handle invalid file type (neither image nor video)
                return response()->json(['error' => 'Invalid file type. Allowed types: jpg, jpeg, png, gif, mp4, mov, avi, mkv'], 400);
            }

        }
        
        $AdmitStudent->save();

        $req->session()->flash('Success_status', 'Student Admit Succesfully!');
        return redirect()->route('ViewAllStudent');
    }

    public function ViewAllStudent(){

        $admin = session()->get('AcademyCode', []);

        $AllStudent = AdmitStudent::join('s_classes', 'admit_students.ClassID', '=', 's_classes.id')            
            ->select('admit_students.*', 's_classes.Class as ClassName')
            ->orderBy('admit_students.id', 'desc')
            ->where('admit_students.AcademyCode', $admin)
            ->get();

            return view('AdmitStudentManage.ViewAllStudent', ['AllStudent' => $AllStudent]);
            // return $AllSections;
    }
    
    public function DropStudent($id){
        $AdmitStudent = AdmitStudent::where('UniqueCode', '=', $id)->delete();
        Session::flash('Success_status', 'Student deleted Succesfully!');
        return redirect()->route('ViewAllStudent');
    }

    public function EditStudent($id){

        $admin = session()->get('AcademyCode', []);
        $AllClasses = SClass::where('AcademyCode', '=', $admin)->get();        

        $StudentData = AdmitStudent::join('s_classes', 'admit_students.ClassID', '=', 's_classes.id')
        ->select('admit_students.*', 's_classes.Class as ClassName', 
        'fees_categories.Title as FeeCategory_Title',
        'fees_categories.ClassID as FeeCategory_Class',
        'fees_categories.Amount as FeeCategory_Amount',
        )        
        ->join('fees_categories', 'admit_students.MonthlyFee', '=', 'fees_categories.id')
        ->orderBy('admit_students.id', 'desc')
        ->where('admit_students.AcademyCode', $admin)
        ->where('admit_students.UniqueCode', '=', $id)
        ->first();

        $FeesCategory = FeesCategory::join('s_classes', 'fees_categories.ClassID', '=', 's_classes.id')            
        ->select('fees_categories.*', 's_classes.Class as ClassName')            
        ->where('fees_categories.AcademyCode', $admin)
        ->get();

        return View('AdmitStudentManage.EditStudent', [
            'AllClasses' => $AllClasses,            
            'StudentData' => $StudentData,
            'FeesCategory' => $FeesCategory
        ]);
    }

    public function UpdateStudent(Request $req, $id){
        $AdmitStudent = AdmitStudent::where('UniqueCode', '=', $id)->first();

        $admin = session()->get('AcademyCode', []);
        
        $AdmitStudent->SName = $req->SName;
        $AdmitStudent->SGender = $req->SGender;
        $AdmitStudent->SDOB = $req->SDOB;
        // $AdmitStudent->SImage = $req->SImage;

        $AdmitStudent->FName = $req->FName;
        $AdmitStudent->FCard = $req->FCard;
        $AdmitStudent->FEmail = $req->FEmail;
        $AdmitStudent->FPhone = $req->FPhone;
        $AdmitStudent->MPhone = $req->MPhone;
        $AdmitStudent->Religion = $req->Religion;
        $AdmitStudent->HomeAddress = $req->HomeAddress;

        $AdmitStudent->MonthlyFee = $req->MonthlyFee;
        $AdmitStudent->IsDiscountedStudent = $req->IsDiscountedStudent;
        $AdmitStudent->WelcomeSmsAlert = $req->WelcomeSmsAlert;
        $AdmitStudent->GererateAdmissionFee = $req->GererateAdmissionFee;

        $AdmitStudent->ClassID = $req->Class;
        $AdmitStudent->AdmissionDate = $req->AdmissionDate;

        // Handle file upload
        if ($req->hasFile('SImage')) {

            $file = $req->file('SImage');
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Define allowed extensions for both images and videos
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
        
            // Check if the extension is allowed
            if (in_array(strtolower($extension), $allowedExtensions)) {
                // Generate a unique filename
                $filename = time() . '.' . $extension;
                
                // Move the file to the appropriate directory
                $file->move('uploads/student_images', $filename);
                
                // Set the filename in the model
                $AdmitStudent->SImage = $filename;
            } else {
                // Handle invalid file type (neither image nor video)
                return response()->json(['error' => 'Invalid file type. Allowed types: jpg, jpeg, png, gif, mp4, mov, avi, mkv'], 400);
            }

        }
        
        $AdmitStudent->save();

        $req->session()->flash('Success_status', 'Student Admit Succesfully!');
        return redirect()->route('ViewAllStudent');
    }

    public function StudentDetails($id){

        $admin = session()->get('AcademyCode', []);

        $StudentData = AdmitStudent::join('s_classes', 'admit_students.ClassID', '=', 's_classes.id')            
            ->select('admit_students.*', 's_classes.Class as ClassName',
                'fees_categories.Title as FeeCategory_Title',
                'fees_categories.ClassID as FeeCategory_Class',
                'fees_categories.Amount as FeeCategory_Amount',
                )
            ->join('fees_categories', 'admit_students.MonthlyFee', '=', 'fees_categories.id')            
            ->orderBy('admit_students.id', 'desc')
            ->where('admit_students.AcademyCode', $admin)
            ->where('admit_students.UniqueCode', '=', $id)
            ->first();

            // student fees completed history           
            $studentsID = $StudentData->id;
            $PaymentRecords = PaymentRecords::join('fees_categories', 'payment_records.PaymentID', '=', 'fees_categories.id')
                ->select('payment_records.*', 'fees_categories.Title as FeesTitle')
                ->where('payment_records.StudentID', '=', $studentsID)
                ->where('payment_records.AcademyCode', '=', $admin)                
                ->get();

        return view('AdmitStudentManage.ViewStudentDetails', [
            'StudentData' => $StudentData,
            'PaymentRecords' => $PaymentRecords
        ]);
    }
    // End Admit Student

    // Start Expense Category
    public function SaveExpenseCategory(Request $req){
        try {
            // Create an array to store all the new class entries
            $newClasses = [];
            $currentTime = \Carbon\Carbon::now()->format('Y-m-d');
    
            // Get the admin session
            $admin = session()->get('AcademyCode', '');
    
            // Loop through each class entry submitted in the form
            foreach ($req->Expensecategory as $category_name) {
                // Create a new ExpenceCategory object
                $SClass = new ExpenceCategory;
    
                // Generate a unique code for the class
                do {
                    $uniqueID = \Str::random(50);
                } while (ExpenceCategory::where('UniqueCode', $uniqueID)->exists());
    
                // Check if the class already exists within the specified AcademyCode
                $existingClass = ExpenceCategory::where('CategoryName', $category_name)
                                                ->where('AcademyCode', $admin)
                                                ->first();
    
                // If the class already exists in the academy, skip adding it and return an error message
                if ($existingClass) {
                    $req->session()->flash('status', 'One or more Expense Category already exist in the specified academy.');
                    return redirect()->back();
                }
    
                // Otherwise, add the class entry to the array                
                $newClasses[] = [
                    'CategoryName' => $category_name,
                    'AcademyCode' => $admin, // Use $admin here
                    'UniqueCode' => $uniqueID,
                    'CreateDate' => $currentTime
                ];
            }
    
            // Bulk insert all the new class entries
            ExpenceCategory::insert($newClasses);
    
            // Flash success message
            $req->session()->flash('Success_status', 'Expense Category Added Successfully!');
            return redirect()->route('AllExpenseCategory');
    
        } catch (\Exception $e) {
            // Log the error message for debugging
            \Log::error('Error adding classes: ' . $e->getMessage());
    
            // Flash error message
            $req->session()->flash('status', 'Failed to add classes. Please try again later.');
            return redirect()->back();
        }
    }

    public function AllExpenseCategory(){
        $admin = session()->get('AcademyCode', []);
        $ExpenceCategory = ExpenceCategory::where('AcademyCode', $admin)->get();
        return view('ManageExpenseCategory.AllExpenseCategory', ['ExpenceCategory' => $ExpenceCategory]);
    }

    public function DropExpenseCategory($id){
        $ExpenceCategory = ExpenceCategory::where('id', $id)->delete();
        Session::flash('Success_status', 'Expense Category Deleted Successfully!');
        return redirect()->route('AllExpenseCategory');
    }

    public function EditExpenseCategory($id){
        $admin = session()->get('AcademyCode', []);
        $ExpenceCategory = ExpenceCategory::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->first();
        return view('ManageExpenseCategory.EditExpenseCategory', ['ExpenceCategory' => $ExpenceCategory]);
    }

    public function UpdateExpenseCategory(Request $req, $id){
        $admin = session()->get('AcademyCode', []);
        $ExpenceCategory = ExpenceCategory::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->first();

        $ExpenceCategory->CategoryName = $req->Expensecategory;
        $ExpenceCategory->save();

        Session::flash('Success_status', 'Expense Category Updated Successfully!');
        return redirect()->route('AllExpenseCategory');
    }
    // End Expense Category

    // Start Manage Expense Category
    Public function ManageExpenseCategory(){
        $admin = session()->get('AcademyCode', '');
        $ExpenceCategory = ExpenceCategory::where('AcademyCode', $admin)->get();
        $BankAccount = BankAccount::where('AcademyCode', $admin)->get();
        return view('ExpenseManage.ExpenseManageCategory', [
            'BankAccount' => $BankAccount,
            'ExpenceCategory' => $ExpenceCategory
        ]);
    }

    public function SaveManageExpense(Request $req){
        
        $admin = session()->get('AcademyCode', '');
        $ManageExpense = new ManageExpense;
        // Generate a unique code for the class
        do {
            $uniqueID = \Str::random(50);
        } while (ManageExpense::where('UniqueCode', $uniqueID)->exists());

        $ManageExpense->Date = $req->Date;
        $ManageExpense->Amount = $req->Amount;
        $ManageExpense->Description = $req->Description;
        $ManageExpense->ExpenseID = $req->ExpenseCategory;
        $ManageExpense->BankID = $req->DebitAccount;
        $ManageExpense->AcademyCode = $admin;
        $ManageExpense->UniqueCode = $uniqueID;

        $ManageExpense->save();

        $req->session()->flash('Success_status', 'Manage Expense added Successfully!');
        return redirect()->route('AllManageExpense');
    }

    public function AllManageExpense(){
        $admin = session()->get('AcademyCode', '');    

        $ManageExpense = ManageExpense::where('manage_expenses.AcademyCode', $admin)
            ->select('manage_expenses.*', 
                'expence_categories.CategoryName as CategoryName',
                'bank_accounts.BankName as BankName'
            )
            ->join('expence_categories', 'manage_expenses.ExpenseID', '=', 'expence_categories.id')
            ->join('bank_accounts', 'manage_expenses.BankID', '=', 'bank_accounts.id')
            ->orderBy('manage_expenses.id', 'desc')
            ->get();

        return view('ExpenseManage.AllExpenseManage', ['ManageExpense' => $ManageExpense]);
    }

    public function DropManageExpense($id){
        $admin = session()->get('AcademyCode', '');    
        $ManageExpense = ManageExpense::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->delete();

        Session::flash('Success_status', 'Manage Expense deleted Successfully!');
        return redirect()->route('AllManageExpense');
    }

    public function EditManageExpense($id){
        $admin = session()->get('AcademyCode', '');
        $ExpenceCategory = ExpenceCategory::where('AcademyCode', $admin)->get();
        $BankAccount = BankAccount::where('AcademyCode', $admin)->get();
        
        $ManageExpense = ManageExpense::where('manage_expenses.UniqueCode', $id)
            ->select('manage_expenses.*', 
                'expence_categories.CategoryName as CategoryName',
                'bank_accounts.BankName as BankName',
                'bank_accounts.Title as BankTitle'
            )
            ->join('expence_categories', 'manage_expenses.ExpenseID', '=', 'expence_categories.id')
            ->join('bank_accounts', 'manage_expenses.BankID', '=', 'bank_accounts.id')
            ->where('manage_expenses.AcademyCode', $admin)        
            ->first();

        // return $ManageExpense;

        return view('ExpenseManage.EditExpense', [
            'ManageExpense' => $ManageExpense,
            'BankAccount' => $BankAccount,
            'ExpenceCategory' => $ExpenceCategory
        ]);
    }

    public function UpdateManageExpense(Request $req, $id){
        $admin = session()->get('AcademyCode', '');
        $ManageExpense = ManageExpense::where('UniqueCode', '=', $id)
            ->where('AcademyCode', '=', $admin)
            ->first();
        
        $ManageExpense->Date = $req->Date;
        $ManageExpense->Amount = $req->Amount;
        $ManageExpense->Description = $req->Description;
        $ManageExpense->ExpenseID = $req->ExpenseCategory;
        $ManageExpense->BankID = $req->DebitAccount;        

        $ManageExpense->save();

        $req->session()->flash('Success_status', 'Manage Expense updated Successfully!');
        return redirect()->route('AllManageExpense');
    }

    public function SearchExpenseReport(Request $request) {
        $admin = session()->get('AcademyCode', []);
        $DateRange = $request->input('DateRange');
        // DateRange ko split karo start aur end dates mein
        list($startDate, $endDate) = explode(' - ', $DateRange);
        // DateTime object mein convert karo
        $startDateTime = \DateTime::createFromFormat('m/d/Y', $startDate);
        $endDateTime = \DateTime::createFromFormat('m/d/Y', $endDate);
        // MySQL ke date format mein convert karo
        $formattedStartDate = $startDateTime->format('Y-m-d');
        $formattedEndDate = $endDateTime->format('Y-m-d');

        try {
            // Fetch data from the database using the provided parameters
            $ExpenseReport = ManageExpense::join('expence_categories', 'manage_expenses.ExpenseID', '=', 'expence_categories.id')
                ->select('manage_expenses.*', 'expence_categories.CategoryName as ExpenseName', 
                'bank_accounts.BankName as BankName',
                'bank_accounts.Title as BankTitle',
                'bank_accounts.AccountType as BankAccountType',
                )
                ->join('bank_accounts', 'manage_expenses.BankID', '=', 'bank_accounts.id')
                ->where('manage_expenses.AcademyCode', '=', $admin)
                ->whereBetween('manage_expenses.Date', [$formattedStartDate, $formattedEndDate])
                ->get();

            // Data ko JSON format mein return karna
            return response()->json($ExpenseReport);
        } catch (\Exception $e) {
            \Log::error("Database query error: " . $e->getMessage());
            return response()->json(['error' => 'Server error occurred.'], 500);
        }
    
    }
    // End Manage Expense Category

    // Start Assets Category
    public function SaveAssetsCategory(Request $req){
        try {
            // Create an array to store all the new class entries
            $newClasses = [];
            $currentTime = \Carbon\Carbon::now()->format('Y-m-d');
    
            // Get the admin session
            $admin = session()->get('AcademyCode', '');
    
            // Loop through each class entry submitted in the form
            foreach ($req->Expensecategory as $category_name) {
                // Create a new ExpenceCategory object
                $SClass = new AssetsCategory;
    
                // Generate a unique code for the class
                do {
                    $uniqueID = \Str::random(50);
                } while (AssetsCategory::where('UniqueCode', $uniqueID)->exists());
    
                // Check if the class already exists within the specified AcademyCode
                $existingClass = AssetsCategory::where('CategoryName', $category_name)
                                                ->where('AcademyCode', $admin)
                                                ->first();
    
                // If the class already exists in the academy, skip adding it and return an error message
                if ($existingClass) {
                    $req->session()->flash('status', 'One or more Assets Category already exist in the specified academy.');
                    return redirect()->back();
                }
    
                // Otherwise, add the class entry to the array                
                $newClasses[] = [
                    'CategoryName' => $category_name,
                    'AcademyCode' => $admin, // Use $admin here
                    'UniqueCode' => $uniqueID,
                    'CreateDate' => $currentTime
                ];
            }
    
            // Bulk insert all the new class entries
            AssetsCategory::insert($newClasses);
    
            // Flash success message
            $req->session()->flash('Success_status', 'Assets Added Successfully!');
            return redirect()->route('AllAssetsCategories');
    
        } catch (\Exception $e) {
            // Log the error message for debugging
            \Log::error('Error adding classes: ' . $e->getMessage());
    
            // Flash error message
            $req->session()->flash('status', 'Failed to add classes. Please try again later.');
            return redirect()->back();
        }
    }

    public function AllAssetsCategories(){
        $admin = session()->get('AcademyCode', []);
        $AssetsCategory = AssetsCategory::where('AcademyCode', $admin)->get();
        return view('AssetsCategory.AllAssets', ['AssetsCategory' => $AssetsCategory]);
    }

    public function DropAssetsCategories($id){
        $AssetsCategory = AssetsCategory::where('id', $id)->delete();
        Session::flash('Success_status', 'Assets Deleted Successfully!');
        return redirect()->route('AllAssetsCategories');
    }

    public function EditAssetsCategories($id){
        $admin = session()->get('AcademyCode', []);
        $AssetsCategory = AssetsCategory::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->first();
        return view('AssetsCategory.EditAssets', ['AssetsCategory' => $AssetsCategory]);
    }

    public function UpdateAssetsCategories(Request $req, $id){
        $admin = session()->get('AcademyCode', []);
        $AssetsCategory = AssetsCategory::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->first();

        $AssetsCategory->CategoryName = $req->Expensecategory;
        $AssetsCategory->save();

        Session::flash('Success_status', 'Expense Category Updated Successfully!');
        return redirect()->route('AllAssetsCategories');
    }
    // Start Assets Category

    // Start Assets Manage Category
    public function ManageAssetsCategory(){
        $admin = session()->get('AcademyCode', '');
        $AssetsCategory = AssetsCategory::where('AcademyCode', $admin)->get();
        $BankAccount = BankAccount::where('AcademyCode', $admin)->get();
        return view('ManageAssets.ManageAsssts', [
            'BankAccount' => $BankAccount,
            'AssetsCategory' => $AssetsCategory
        ]);
    }

    public function SaveAssetsManage(Request $req){
        $admin = session()->get('AcademyCode', '');
        $ManageAssets = new ManageAssets;
        // Generate a unique code for the class
        do {
            $uniqueID = \Str::random(50);
        } while (ManageExpense::where('UniqueCode', $uniqueID)->exists());

        $ManageAssets->Date = $req->Date;
        $ManageAssets->Amount = $req->Amount;
        $ManageAssets->Description = $req->Description;
        $ManageAssets->AssetID = $req->ExpenseCategory;
        $ManageAssets->BankID = $req->DebitAccount;
        $ManageAssets->AcademyCode = $admin;
        $ManageAssets->UniqueCode = $uniqueID;

        $ManageAssets->save();

        $req->session()->flash('Success_status', 'Assets Manage added Successfully!');
        return redirect()->route('AllAssetsManage');
    }

    public function AllAssetsManage(){
        $admin = session()->get('AcademyCode', '');    

        $ManageAssets = ManageAssets::where('manage_assets.AcademyCode', $admin)
            ->select('manage_assets.*', 
                'assets_categories.CategoryName as CategoryName',
                'bank_accounts.BankName as BankName'
            )
            ->join('assets_categories', 'manage_assets.AssetID', '=', 'assets_categories.id')
            ->join('bank_accounts', 'manage_assets.BankID', '=', 'bank_accounts.id')
            ->orderBy('manage_assets.id', 'desc')
            ->get(); 

        return view('ManageAssets.AllAssetsManage', ['ManageAssets' => $ManageAssets]);
    }

    public function DropAssetsManage($id){
        $admin = session()->get('AcademyCode', '');    
        $ManageAssets = ManageAssets::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->delete();

        Session::flash('Success_status', 'Manage Assets deleted Successfully!');
        return redirect()->route('AllAssetsManage');
    }

    public function EditAssetsManage($id){
        $admin = session()->get('AcademyCode', '');
        $AssetsCategory = AssetsCategory::where('AcademyCode', $admin)->get();
        $BankAccount = BankAccount::where('AcademyCode', $admin)->get();
        
        $ManageAssets = ManageAssets::where('manage_assets.UniqueCode', $id)
            ->select('manage_assets.*', 
                'assets_categories.CategoryName as CategoryName',
                'bank_accounts.BankName as BankName'
            )
            ->join('assets_categories', 'manage_assets.AssetID', '=', 'assets_categories.id')
            ->join('bank_accounts', 'manage_assets.BankID', '=', 'bank_accounts.id')
            ->where('manage_assets.AcademyCode', $admin)        
            ->first();

            // return $ManageAssets;

        return view('ManageAssets.EditAssetsManage', [
            'ManageAssets' => $ManageAssets,
            'BankAccount' => $BankAccount,
            'AssetsCategory' => $AssetsCategory
        ]);
    }

    public function UpdateAssetsManage(Request $req, $id){
        $admin = session()->get('AcademyCode', '');
        $ManageAssets = ManageAssets::where('UniqueCode', '=', $id)
            ->where('AcademyCode', '=', $admin)
            ->first();
        
        $ManageAssets->Date = $req->Date;
        $ManageAssets->Amount = $req->Amount;
        $ManageAssets->Description = $req->Description;
        $ManageAssets->AssetID = $req->ExpenseCategory;
        $ManageAssets->BankID = $req->DebitAccount;        

        $ManageAssets->save();

        $req->session()->flash('Success_status', 'Manage Asset updated Successfully!');
        return redirect()->route('AllAssetsManage');
    }

    public function SearchAssetReport(Request $request) {
        $admin = session()->get('AcademyCode', []);
        $DateRange = $request->input('DateRange');
        // DateRange ko split karo start aur end dates mein
        list($startDate, $endDate) = explode(' - ', $DateRange);
        // DateTime object mein convert karo
        $startDateTime = \DateTime::createFromFormat('m/d/Y', $startDate);
        $endDateTime = \DateTime::createFromFormat('m/d/Y', $endDate);
        // MySQL ke date format mein convert karo
        $formattedStartDate = $startDateTime->format('Y-m-d');
        $formattedEndDate = $endDateTime->format('Y-m-d');

        try {
            // Fetch data from the database using the provided parameters
            $ManageAssets = ManageAssets::join('assets_categories', 'manage_assets.AssetID', '=', 'assets_categories.id')
                ->select('manage_assets.*', 'assets_categories.CategoryName as ExpenseName', 
                'bank_accounts.BankName as BankName',
                'bank_accounts.Title as BankTitle',
                'bank_accounts.AccountType as BankAccountType',
                )
                ->join('bank_accounts', 'manage_assets.BankID', '=', 'bank_accounts.id')
                ->where('manage_assets.AcademyCode', '=', $admin)
                ->whereBetween('manage_assets.Date', [$formattedStartDate, $formattedEndDate])
                ->get();

            // Data ko JSON format mein return karna
            return response()->json($ManageAssets);
        } catch (\Exception $e) {
            \Log::error("Database query error: " . $e->getMessage());
            return response()->json(['error' => 'Server error occurred.'], 500);
        }
    
    }
    // End Assets Manage Category

    // Start Bank Account
    public function SaveBankAccounts(Request $req){

        $currentTime = \Carbon\Carbon::now()->format('Y-m-d');
        $admin = session()->get('AcademyCode', '');
        
        $BankAccount = new BankAccount;
        
        // Generate a unique code for the class
        do {
            $uniqueID = \Str::random(50);
        } while (BankAccount::where('UniqueCode', $uniqueID)->exists());
        
        $BankAccount->BankName = $req->BankName;
        $BankAccount->Title = $req->Title;
        $BankAccount->BranchCode = $req->BranchCode;
        $BankAccount->AccountNumber = $req->AccountNumber;

        if($req->IBANNumber == ''){
            $BankAccount->IBANNumber = '0';
        }else{            
            $BankAccount->IBANNumber = $req->IBANNumber;
        }
        $BankAccount->AccountType = $req->AccountType;
        $BankAccount->Balance = $req->Balance;
        $BankAccount->Description = $req->Description;
        $BankAccount->Date = $currentTime;
        $BankAccount->AcademyCode = $admin;
        $BankAccount->UniqueCode = $uniqueID;
        $BankAccount->save();

        $req->session()->flash('Success_status', 'Bank account added Successfully!');
        return redirect()->route('AllBankAccounts');
    }

    public function AllBankAccounts(){
        $admin = session()->get('AcademyCode', '');
        $BankAccount = BankAccount::where('AcademyCode', $admin)->get();
        return view('ManageBankAccounts.AllBankAccounts', ['BankAccount' => $BankAccount]);
    }

    public function DropBankAccounts($id){
        $admin = session()->get('AcademyCode', '');
        $BankAccount = BankAccount::where('AcademyCode', $admin)
        ->where('id', $id)
        ->delete();

        Session::flash('Success_status', 'Bank account deleted Successfully!');
        return redirect()->route('AllBankAccounts');
    }

    public function EditBankAccounts($id){
        $admin = session()->get('AcademyCode', '');
        $BankAccount = BankAccount::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->first();

        return view('ManageBankAccounts.EditBankAccount', ['BankAccount' => $BankAccount]);
    }

    public function UpdateBankAccounts(Request $req, $id){
        $admin = session()->get('AcademyCode', '');
        $BankAccount = BankAccount::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->first();

        $BankAccount->BankName = $req->BankName;
        $BankAccount->Title = $req->Title;
        $BankAccount->BranchCode = $req->BranchCode;
        $BankAccount->AccountNumber = $req->AccountNumber;

        if($req->IBANNumber == ''){
            $BankAccount->IBANNumber = '0';
        }else{            
            $BankAccount->IBANNumber = $req->IBANNumber;
        }

        $BankAccount->AccountType = $req->AccountType;
        $BankAccount->Balance = $req->Balance;
        $BankAccount->Description = $req->Description;
        $BankAccount->save();

        $req->session()->flash('Success_status', 'Bank account added Successfully!');
        return redirect()->route('AllBankAccounts');
    }
    // End Bank Account

    // Start Fees Manage
    public function ManageFees(){
        $admin = session()->get('AcademyCode', '');
        $SClass = SClass::where('AcademyCode', '=', $admin)->get();
        return view('ManageFees.FeesManage', ['SClass' => $SClass]);
    }

    public function SaveFeesCategory(Request $req){
        $admin = session()->get('AcademyCode', '');
        $currentTime = \Carbon\Carbon::now()->format('Y-m-d');
        $FeesCategory = new FeesCategory;
        // Generate a unique code for the class
        do {
            $uniqueID = \Str::random(50);
        } while (FeesCategory::where('UniqueCode', $uniqueID)->exists());
        $FeesCategory->Title = $req->Title;
        $FeesCategory->PaymentType = $req->PaymentType;
        $FeesCategory->Amount = $req->Amount;
        $FeesCategory->Description = $req->Description;
        $FeesCategory->Date = $currentTime;
        $FeesCategory->ClassID = $req->Class;
        $FeesCategory->AcademyCode = $admin;
        $FeesCategory->UniqueCode = $uniqueID;
        $FeesCategory->save();

        $req->session()->flash('Success_status', 'Fees Category added Successfully!');
        return redirect()->route('AllFeesCategory');
    }

    public function AllFeesCategory(){
        $admin = session()->get('AcademyCode', '');
        $FeesCategory = FeesCategory::where('fees_categories.AcademyCode', '=', $admin)
        ->select('fees_categories.*', 's_classes.Class as ClassName')
        ->join('s_classes', 'fees_categories.ClassID', '=', 's_classes.id')    
        ->get();
        return view('ManageFees.AllFeesManage', ['FeesCategory' => $FeesCategory]);
    }

    public function DropFeesCategory($id){
        $FeesCategory = FeesCategory::where('UniqueCode', '=', $id)->delete();
        Session::flash('Success_status', 'Fees Category deleted Successfully!');
        return redirect()->route('AllFeesCategory');
    }

    public function EditFeesCategory($id){
        $admin = session()->get('AcademyCode', '');
        $SClass = SClass::where('AcademyCode', '=', $admin)->get();
        
        $FeesCategory = FeesCategory::where('fees_categories.AcademyCode', '=', $admin)
            ->select('fees_categories.*', 's_classes.Class as ClassName')
            ->join('s_classes', 'fees_categories.ClassID', '=', 's_classes.id')    
            ->where('fees_categories.UniqueCode', '=', $id)
            ->first();
    
        return view('ManageFees.EditFeesManage', [
            'SClass' => $SClass,
            'FeesCategory' => $FeesCategory
        ]);
    }

    public function UpdateFeesCategory(Request $req, $id){
        $admin = session()->get('AcademyCode', '');
        $FeesCategory = FeesCategory::where('UniqueCode', '=', $id)
        ->where('AcademyCode', '=', $admin)
        ->first();
        $FeesCategory->Title = $req->Title;
        $FeesCategory->PaymentType = $req->PaymentType;
        $FeesCategory->Amount = $req->Amount;
        $FeesCategory->Description = $req->Description;        
        $FeesCategory->ClassID = $req->Class;
        $FeesCategory->save();

        $req->session()->flash('Success_status', 'Fees Category update Successfully!');
        return redirect()->route('AllFeesCategory');
    }
    // End Fees Manage

    // Start Staff Account Manages
    public function StaffAccount(){
        return view('ManageStaffAccount.StaffAccount');
    }

    public function SaveStaffAccount(Request $req){
        $admin = session()->get('AcademyCode', []);
        $StaffAccount = new StaffAccount;

        // Generate a unique code for the class
        do {
            $UniqueID = Str::random(6);
        } while (StaffAccount::where('UniqueCode', $UniqueID)->exists());

        $StaffAccount->Name = $req->Name;
        $StaffAccount->Email = $req->Email;
        $StaffAccount->Phone = $req->Phone;
        $StaffAccount->AccountType = $req->Account_Type;
        $StaffAccount->Salary = $req->Salary;
        $StaffAccount->Allowances = $req->Allowances;
        $StaffAccount->Deductions = $req->Deductions;
        $StaffAccount->CanAdd = $req->CanAdd;
        $StaffAccount->CanEdit = $req->CanEdit;
        $StaffAccount->CanDrop = $req->CanDrop;
        $StaffAccount->AcademyCode = $admin;
        $StaffAccount->UniqueCode = $UniqueID;

        // Handle file upload
        if ($req->hasFile('Image')) {

            $file = $req->file('Image');
            
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            
            // Define allowed extensions for both images and videos
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
        
            // Check if the extension is allowed
            if (in_array(strtolower($extension), $allowedExtensions)) {
                // Generate a unique filename
                $filename = time() . '.' . $extension;
                
                // Move the file to the appropriate directory
                $file->move('uploads/staff_images', $filename);
                
                // Set the filename in the model
                $StaffAccount->Image = $filename;
            } else {
                // Handle invalid file type (neither image nor video)
                return response()->json(['error' => 'Invalid file type. Allowed types: jpg, jpeg, png, gif, mp4, mov, avi, mkv'], 400);
            }
        }

        $StaffAccount->save();

        $retriveAdminData = admins::select('Name')
            ->where('AcademyCode', '=', $admin)->first();

        $Staff_AcademyName = $retriveAdminData->AcademyName;

        if($req->Account_Type != 'Teacher'){
            $mailData=[
                'AcademyName' => $Staff_AcademyName,
                'VerifyCode' => $StaffAccount->UniqueCode,
            ];                
    
            Mail::to($req->Email)->send(new StaffCreatePassword($mailData));
        }

        $req->session()->flash('Success_status', 'Staff Accounts added Successfully!');
        return redirect()->route('ViewStaffAccount');
    }

    public function ViewStaffAccount(){
        $admin = session()->get('AcademyCode', []);
    
        $StaffAccount = StaffAccount::where('AcademyCode', '=', $admin)->get();
            
        return view('ManageStaffAccount.ViewStaffAccounts', ['StaffAccount' => $StaffAccount]);
    }

    public function DropStaffAccount($id){
        $StaffAccount = StaffAccount::where('id', '=', $id)->delete();
        Session::flash('Success_status', 'Staff Accounts deleted Successfully!');
        return redirect()->route('ViewStaffAccount');
    }

    public function EditStaffAccount($id){

        $admin = session()->get('AcademyCode', []);

        $StaffAccount = StaffAccount::where('staff_accounts.AcademyCode', '=', $admin)
            ->where('staff_accounts.UniqueCode', '=', $id)
            ->first();
        
        return view('ManageStaffAccount.EditStaffAccount', [
            'StaffAccount' => $StaffAccount
        ]);
    }

    public function UpdateStaffAccount(Request $req, $id){
        $StaffAccount = StaffAccount::where('UniqueCode', '=', $id)->first();
    
        $StaffAccount->Name = $req->Name;
        $StaffAccount->Email = $req->Email;
        $StaffAccount->Phone = $req->Phone;
        $StaffAccount->AccountType = $req->Account_Type;
        $StaffAccount->Salary = $req->Salary;
        $StaffAccount->Allowances = $req->Allowances;
        $StaffAccount->Deductions = $req->Deductions;
        $StaffAccount->CanAdd = $req->CanAdd;
        $StaffAccount->CanEdit = $req->CanEdit;
        $StaffAccount->CanDrop = $req->CanDrop;
    
        // Handle file upload
        if ($req->hasFile('Image')) {
            $file = $req->file('Image');
            $extension = $file->getClientOriginalExtension();
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
    
            if (in_array(strtolower($extension), $allowedExtensions)) {
                // Generate a unique filename
                $filename = time() . '.' . $extension;
                
                // Move the file to the appropriate directory
                $file->move('uploads/staff_images', $filename);
                
                // Delete the previous image if exists
                if ($StaffAccount->Image) {
                    $imagePath = public_path('uploads/staff_images/' . $StaffAccount->Image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
    
                // Set the new filename in the model
                $StaffAccount->Image = $filename;
            } else {
                return response()->json(['error' => 'Invalid file type. Allowed types: jpg, jpeg, png'], 400);
            }
        }
    
        $StaffAccount->save();
    
        $req->session()->flash('Success_status', 'Staff Accounts Updated Successfully!');
        return redirect()->route('ViewStaffAccount');
    }
    
    public function StaffCreatePassword($id){
        $StaffAccount = StaffAccount::where('UniqueCode', '=', $id)->first();
        return view('StaffCreatePassword', ['StaffAccount' => $StaffAccount]);
    }

    public function SaveStaffCreatePassword(Request $req, $id){

        $StaffAccount = StaffAccount::where('UniqueCode', '=', $id)->first();

        if($req->CreatePassword == $req->ConfirmPassword){

            $StaffAccount->Password = $req->ConfirmPassword;
            $StaffAccount->Status = '1';
            $StaffAccount->save();

            $req->session()->flash('Success_status', 'Your password change successfully!');
            return redirect()->route('SignIn');
        }
        else{
            $req->session()->flash('status', 'Please make sure password and confirm password are same!');
            return redirect()->back();
        }
    }

    public function ActiveStaffAccount($id){
        $StaffAccount = StaffAccount::where('UniqueCode', '=', $id)->first();
        $StaffAccount->Status = '1';
        $StaffAccount->save();

        Session::flash('Success_status', 'Staff account activated successfully!');
        return redirect()->route('ViewStaffAccount');
    }

    public function DeactivateStaffAccount($id){
        $StaffAccount = StaffAccount::where('UniqueCode', '=', $id)->first();
        $StaffAccount->Status = '2';
        $StaffAccount->save();

        Session::flash('Success_status', 'Staff account deactivated successfully!');
        return redirect()->route('ViewStaffAccount');
    }

    public function StaffProfileDetail($id){
        $admin = session()->get('AcademyCode', []);

        $StaffData = StaffAccount::where('staff_accounts.AcademyCode', $admin)
            ->orderBy('staff_accounts.id', 'desc')
            ->where('staff_accounts.UniqueCode', '=', $id)
            ->first();

        $EmployeeID = $StaffData->id;

        $ManageSalary = ManageSalary::where('manage_salaries.AcademyCode', '=', $admin)
            ->select('manage_salaries.*', 'expence_categories.CategoryName as ExpenseName',
                    'bank_accounts.BankName as BankName',
                    'bank_accounts.Title as BankTitle',
                    'bank_accounts.AccountType as BankAccountType',
                    'staff_accounts.Name as EmployeeName',
                    'staff_accounts.AccountType as EmployeeType',
                    'staff_accounts.UniqueCode as EmployeeUniqueCode',
            )
            ->join('expence_categories', 'manage_salaries.ExpenseID', '=', 'expence_categories.id')
            ->join('bank_accounts', 'manage_salaries.BankID', '=', 'bank_accounts.id')
            ->join('staff_accounts', 'manage_salaries.EmployeeID', '=', 'staff_accounts.id')
            ->where('manage_salaries.EmployeeID', '=', $EmployeeID)        
            ->get();
            
        // return $ManageSalary;

        return view('ManageStaffAccount.View_Staff_Details', [
            'StaffData' => $StaffData,
            'PaymentRecords' => $ManageSalary
        ]);
    }
    // End Staff Account Manage

    // Start Student Fees Manage
    public function StudentFees(){
        $admin = session()->get('AcademyCode', []);
        $AllClasses = SClass::where('AcademyCode', '=', $admin)->get();

        return view('ManageStudentFees.StudentFees', [
            'AllClasses' => $AllClasses
        ]);
    }

    public function SearchStudentInformation(Request $request){

        $admin = session()->get('AcademyCode', []);

        try {
            // Request object se parameters obtain karna
            $classId = $request->input('classId');

            // Fetch data from the database using the provided parameters
            $students = AdmitStudent::join('s_classes', 'admit_students.ClassID', '=', 's_classes.id')
                ->select('admit_students.*', 's_classes.Class as ClassName')                
                ->where('admit_students.ClassID', $classId)
                ->where('admit_students.AcademyCode', '=', $admin)
                ->get();

            // Data ko JSON format mein return karna
            return response()->json($students);
        } catch (\Exception $e) {
            \Log::error("Database query error: " . $e->getMessage());
            return response()->json(['error' => 'Server error occurred.'], 500);
        }
    }

    public function StudentAllPayments($id){
        $admin = session()->get('AcademyCode', []);
        $students = AdmitStudent::where('UniqueCode', $id)
            ->where('AcademyCode', '=', $admin)
            ->first();
        $studentsID = $students->id;
        $PaymentRecords = PaymentRecords::join('fees_categories', 'payment_records.PaymentID', '=', 'fees_categories.id')
            ->select('payment_records.*', 'fees_categories.Title as FeesTitle')
            ->where('payment_records.StudentID', '=', $studentsID)
            ->where('payment_records.AcademyCode', '=', $admin)
            ->get();
        $BankAccount = BankAccount::where('AcademyCode', '=', $admin)->get();
        return view('ManageStudentFees.StudentAllPayments', [
            'students' => $students,
            'PaymentRecords' => $PaymentRecords,
            'BankAccount' => $BankAccount
        ]);
    }

    public function StudentQuickPayment(Request $req, $id){

        $currentTime = \Carbon\Carbon::now()->format('Y-m-d');
        
        $admin = session()->get('AcademyCode', []);
        $PaymentRecords = PaymentRecords::where('UniqueCode', '=', $id)
            ->where('AcademyCode', '=', $admin)
            ->first();
    
        // Check if PaymentRecords exists to avoid potential errors
        if ($PaymentRecords) {
            $FeeExpDate = $PaymentRecords->FeeExpDate;
            
            // Ensure the format of FeeExpDate is consistent for comparison
            $FeeExpDateFormatted = \Carbon\Carbon::parse($FeeExpDate)->format('Y-m-d');
            
            $PaymentRecords->Paid = $PaymentRecords->AmtPaid;
            $PaymentRecords->PaymentMethod = $req->FeeMethod;
            $PaymentRecords->BankID = $req->BankAccount;
            if ($currentTime >= $FeeExpDateFormatted) {
                $PaymentRecords->IsLate = 1;
            } else {
                $PaymentRecords->IsLate = 0;
            }
            $PaymentRecords->PaidStatus = 1;
    
            $PaymentRecords->save();
    
            Session::flash('Success_status', 'Student Fee Clear Successfully!');
        } else {
            Session::flash('Error_status', 'Payment record not found!');
        }
        
        return redirect()->back();
    }

    // public function StudentPartialPayment(Request $req, $id){

    //     $currentTime = \Carbon\Carbon::now()->format('Y-m-d');
        
    //     $admin = session()->get('AcademyCode', []);
    //     $PaymentRecords = PaymentRecords::where('UniqueCode', '=', $id)
    //         ->where('AcademyCode', '=', $admin)
    //         ->first();
    
    //     // Check if PaymentRecords exists to avoid potential errors
    //     if ($PaymentRecords) {
    //         $FeeExpDate = $PaymentRecords->FeeExpDate;
            
    //         // Ensure the format of FeeExpDate is consistent for comparison
    //         $FeeExpDateFormatted = \Carbon\Carbon::parse($FeeExpDate)->format('Y-m-d');
                        
    //         $blnsAmount = $PaymentRecords->Paid;
            
    //         $PaymentRecords->Paid = $req->PartialAmount + $blnsAmount;

    //         $DuePayment = $PaymentRecords->AmtPaid - $req->PartialAmount;                    
            
    //         $PaymentRecords->PaymentMethod = $req->FeeMethod;
            
    //         $PaymentRecords->BankID = $req->BankAccount;            
            
    //         if ($currentTime >= $FeeExpDateFormatted) {
    //             $PaymentRecords->IsLate = 1;
    //         } else {
    //             $PaymentRecords->IsLate = 0;
    //         }

    //         if($PaymentRecords->Paid == $PaymentRecords->AmtPaid){

    //             $PaymentRecords->PaidStatus = 1;
    //             $PaymentRecords->Balance = 0;

    //         }else{
    //             $PaymentRecords->PaidStatus = 2;
    //             $PaymentRecords->Balance = $DuePayment;
    //         }

    //         $PaymentRecords->save();
    
    //         Session::flash('Success_status', 'Student Fee Clear Successfully!');
    //     } else {
    //         Session::flash('Error_status', 'Payment record not found!');
    //     }
        
    //     return redirect()->back();
    // }

    public function StudentPartialPayment(Request $req, $id){

        $currentTime = \Carbon\Carbon::now()->format('Y-m-d');
        
        $admin = session()->get('AcademyCode', []);
        $PaymentRecords = PaymentRecords::where('UniqueCode', '=', $id)
            ->where('AcademyCode', '=', $admin)
            ->first();
    
        // Check if PaymentRecords exists to avoid potential errors
        if ($PaymentRecords) {
            $FeeExpDate = $PaymentRecords->FeeExpDate;
            
            // Ensure the format of FeeExpDate is consistent for comparison
            $FeeExpDateFormatted = \Carbon\Carbon::parse($FeeExpDate)->format('Y-m-d');
                        
            $blnsAmount = $PaymentRecords->Paid;
            
            $PaymentRecords->Paid = $req->PartialAmount + $blnsAmount;
    
            // Calculate the due payment based on the total amount paid so far
            $DuePayment = $PaymentRecords->AmtPaid - $PaymentRecords->Paid;                    
    
            $PaymentRecords->PaymentMethod = $req->FeeMethod;
            
            $PaymentRecords->BankID = $req->BankAccount;            
            
            if ($currentTime >= $FeeExpDateFormatted) {
                $PaymentRecords->IsLate = 1;
            } else {
                $PaymentRecords->IsLate = 0;
            }
    
            if($PaymentRecords->Paid == $PaymentRecords->AmtPaid){
                $PaymentRecords->PaidStatus = 1;
                $PaymentRecords->Balance = 0;
            } else {
                $PaymentRecords->PaidStatus = 2;
                $PaymentRecords->Balance = $DuePayment;
            }
    
            $PaymentRecords->save();
    
            Session::flash('Success_status', 'Student Fee Clear Successfully!');
        } else {
            Session::flash('Error_status', 'Payment record not found!');
        }
        
        return redirect()->back();
    }

    public function MakeStudentsPayment(){
        $admin = session()->get('AcademyCode', []);
        $SClass = SClass::where('AcademyCode', '=', $admin)->get();
        $FeesCategory = FeesCategory::where('AcademyCode', '=', $admin)->get();

        return view('ManageGenerateFees.GenerateFees', [
            'SClass' => $SClass,
            'FeesCategory' => $FeesCategory
        ]);
    }

    public function MakePayment(Request $req) {
        $class = $req->Class;
        $PaymentID = $req->FeesCategory;
        
        // Get the current date and time
        $currentDate = Carbon::now();
        // Get the current year
        $currentYear = $currentDate->year;
        // Get the current month
        $currentMonth = $currentDate->month;
        // Get the full month name
        $currentMonthName = $currentDate->format('F');
        // Get the current day
        $currentDay = $currentDate->day;
        // Calculate the date after 10 days
        $dateAfter10Days = $currentDate->addDays(10);
        // Format the date after 10 days
        $dateAfter10DaysFormatted = $dateAfter10Days->format('Y-m-d');
        
        $admin = session()->get('AcademyCode', []);
        
        if ($req->Class == 'AllClasses') {
            $students = AdmitStudent::join('s_classes', 'admit_students.ClassID', '=', 's_classes.id')
                ->select('admit_students.*', 's_classes.Class as ClassName')
                ->where('admit_students.AcademyCode', '=', $admin)
                ->get();
        } else {
            $students = AdmitStudent::join('s_classes', 'admit_students.ClassID', '=', 's_classes.id')
                ->select('admit_students.*', 's_classes.Class as ClassName')
                ->where('admit_students.AcademyCode', '=', $admin)
                ->where('admit_students.ClassID', '=', $class)
                ->get();
        }
        
        $FeesCategory = FeesCategory::where('AcademyCode', '=', $admin)
            ->where('id', '=', $PaymentID)
            ->first();
        $FeesCategory_Amount = $FeesCategory->Amount;
        $FeesCategory_PaymentType = $FeesCategory->PaymentType;
        
        $existingStudents = [];
        $createdRecordsCount = 0;
        
        foreach ($students as $student) {
            // Check if a payment record for the same month, payment ID, and student already exists
            $existingPaymentRecord = PaymentRecords::where('PaymentID', $PaymentID)
                ->where('StudentID', $student->id)
                ->where('Year', $currentYear)
                ->where('FeeMonth', $currentMonth)
                ->where('AcademyCode', $admin)
                ->exists();
    
            if ($existingPaymentRecord) {
                $existingStudents[] = $student->id;
                $req->session()->flash('Error_status', 'Payment records already exist for some students.');
            } else {
                // Generate a unique code for the class
                do {
                    $UniqueID = Str::random(6);
                } while (PaymentRecords::where('UniqueCode', $UniqueID)->exists());
    
                $PaymentRecords = new PaymentRecords;
                $PaymentRecords->PaymentID = $PaymentID;
                $PaymentRecords->StudentID = $student->id;
                $PaymentRecords->PaymentMethod = $FeesCategory_PaymentType;            
                $PaymentRecords->AmtPaid = $FeesCategory_Amount;
                $PaymentRecords->Balance = '0';
                $PaymentRecords->Year = $currentYear;
                $PaymentRecords->FeeMonth = $currentMonth;
                $PaymentRecords->FeeMonthName = $currentMonthName;
                $PaymentRecords->FeeAssignDate = $currentDay;
                $PaymentRecords->FeeExpDate = $dateAfter10DaysFormatted;
                $PaymentRecords->AcademyCode = $admin;
                $PaymentRecords->UniqueCode = $UniqueID;
    
                $PaymentRecords->save();
                $createdRecordsCount++;
            }
        }
        
        if (count($existingStudents) > 0) {
            $req->session()->flash('status', 'Payment records already exist for some students.');
        } else if ($createdRecordsCount > 0) {
            $req->session()->flash('Success_status', 'Student Payment Created Successfully!');
        } else {
            $req->session()->flash('status', 'No new payment records were created.');
        }
    
        return redirect()->back();
    }
    // End Student Fees Manage

    // Start Manage Salary
    public function ManageEmployeeSalary(){
        $admin = session()->get('AcademyCode', []);

        $UtlityExpenseCategory = UtlityExpenseCategory::where('AcademyCode', '=', $admin)->get();
        $BankAccount = BankAccount::where('AcademyCode', '=', $admin)->get();
        $StaffAccount = StaffAccount::where('AcademyCode', '=', $admin)->get();
        
        return view('ManageSalary.Salary', [
            'UtlityExpenseCategory' => $UtlityExpenseCategory,
            'BankAccount' => $BankAccount,
            'StaffAccount' => $StaffAccount
        ]);
    }

    public function getEmployeeSalary($id){

        $employee = StaffAccount::find($id);
        if ($employee) {
            return response()->json([
                'salary' => $employee->Salary,
                'allowances' => $employee->Allowances,
            ]);
        } else {
            return response()->json([
                'salary' => 0,
                'allowances' => 0,
            ], 404);
        }
    }

    public function SaveEmployeeSalary(Request $req) {
        $admin = session()->get('AcademyCode', '');
        $ManageSalary = new ManageSalary;
    
        // Extract the month and year from the Date input
        $date = \Carbon\Carbon::parse($req->Date);
        $month = $date->month;
        $year = $date->year;
    
        // Check if an entry already exists for the same AcademyCode, EmployeeID, and month/year
        $existingEntry = ManageSalary::where('AcademyCode', $admin)
                                     ->where('EmployeeID', $req->EmployeeID)
                                     ->whereMonth('Date', $month)
                                     ->whereYear('Date', $year)
                                     ->exists();
    
        if ($existingEntry) {
            // If an entry exists, flash a message and redirect
            $req->session()->flash('status', 'Salary entry for this employee in the same month already exists!');
            return redirect()->back();
        }
    
        // Generate a unique code for the entry
        do {
            $uniqueID = \Str::random(50);
        } while (ManageSalary::where('UniqueCode', $uniqueID)->exists());
    
        // Save the new entry
        $ManageSalary->Date = $req->Date;
        $ManageSalary->Salary = $req->Amount;
        $ManageSalary->Allowances = $req->Allowances;
        $ManageSalary->NetSalary = $req->NetSalary;
        $ManageSalary->Deductions = $req->Deductions;
        $ManageSalary->TotalSalary = $req->TotalSalary;

        if($req->Description == null){
            $ManageSalary->Description = 'Net Describe';    
        }else{
            $ManageSalary->Description = $req->Description;
        }
        
        $ManageSalary->EmployeeID = $req->EmployeeID;
        $ManageSalary->ExpenseID = $req->ExpenseCategory;
        $ManageSalary->BankID = $req->DebitAccount;
        $ManageSalary->AcademyCode = $admin;
        $ManageSalary->UniqueCode = $uniqueID;
    
        $ManageSalary->save();
    
        $req->session()->flash('Success_status', 'Employee Salary added Successfully!');
        return redirect()->route('AllEmployeeSalaries');
    }    

    public function AllEmployeeSalaries(){

        $admin = session()->get('AcademyCode', '');
        $ManageSalary = ManageSalary::where('manage_salaries.AcademyCode', '=', $admin)
        ->select('manage_salaries.*', 'utlity_expense_categories.CategoryName as ExpenseName',
                 'bank_accounts.BankName as BankName',
                 'bank_accounts.Title as BankTitle',
                 'bank_accounts.AccountType as BankAccountType',
                 'staff_accounts.Name as EmployeeName',
                 'staff_accounts.AccountType as EmployeeType',
                 'staff_accounts.UniqueCode as EmployeeUniqueCode',
        )
        ->join('utlity_expense_categories', 'manage_salaries.ExpenseID', '=', 'utlity_expense_categories.id')
        ->join('bank_accounts', 'manage_salaries.BankID', '=', 'bank_accounts.id')
        ->join('staff_accounts', 'manage_salaries.EmployeeID', '=', 'staff_accounts.id')
        ->get();

        return view('ManageSalary.AllSalaries', ['ManageSalary' => $ManageSalary]);

    }

    public function DropEmployeeSalaries($id){
        $admin = session()->get('AcademyCode', '');
        $ManageSalary = ManageSalary::where('UniqueCode', '=', $id)->delete();
        
        Session::flash('Success_status', 'Employee Salary Deleted Successfully!');
        return redirect()->route('AllEmployeeSalaries');

    }
    // End Manage Salary 

    // Start Income & Expense Reports
    public function ProfitLossStatements(){
        $admin = session()->get('AcademyCode', '');
        $UtlityExpenseCategory = UtlityExpenseCategory::where('AcademyCode', '=', $admin)->get();
        
        return view('Manage_Income_Expense_Reports.Income_Expense_Reports', ['ExpenceCategory' => $UtlityExpenseCategory]);
    }
    
    public function SearchProfitLossStatements(Request $request) {
        $admin = session()->get('AcademyCode', []);
        $ExpenseCategory = $request->input('ExpenseCategory');
        $FilterData = $request->input('FilterData');
        $currentTime = Carbon::now()->format('Y-m-d');
    
        switch ($FilterData) {
            case 'Last1Year':
                $startDate = Carbon::now()->subYear(1)->format('Y-m-d');
                break;
            case 'Last2Years':
                $startDate = Carbon::now()->subYears(2)->format('Y-m-d');
                break;
            case 'Last4Years':
                $startDate = Carbon::now()->subYears(4)->format('Y-m-d');
                break;
            case 'AllYears':
            default:
                $startDate = null;
                break;
        }
    
        try {
            $salaryQuery = ManageSalary::join('expence_categories', 'manage_salaries.ExpenseID', '=', 'expence_categories.id')
                ->join('bank_accounts', 'manage_salaries.BankID', '=', 'bank_accounts.id')
                ->join('staff_accounts', 'manage_salaries.EmployeeID', '=', 'staff_accounts.id')
                ->select(
                    'manage_salaries.*', 
                    'expence_categories.CategoryName as ExpenseName',
                    'bank_accounts.BankName as BankName',
                    'bank_accounts.Title as BankTitle',
                    'bank_accounts.AccountType as BankAccountType'
                )
                ->where('manage_salaries.AcademyCode', '=', $admin);
    
            if ($startDate) {
                $salaryQuery->where('manage_salaries.Date', '>=', $startDate);
            }
    
            if ($ExpenseCategory != 'AllCategories') {
                $salaryQuery->where('manage_salaries.ExpenseID', '=', $ExpenseCategory);
            }
    
            $fetch_salary = $salaryQuery->get();
    
            $expenseQuery = ManageUtlityExpense::join('utlity_expense_categories', 
                    'manage_utlity_expenses.ExpenseID', '=', 'utlity_expense_categories.id'
                )
                ->join('bank_accounts', 'manage_utlity_expenses.BankID', '=', 'bank_accounts.id')
                ->select(
                    'manage_utlity_expenses.*',
                    'manage_utlity_expenses.Amount as ExpenseAmount',
                    'utlity_expense_categories.CategoryName as ExpenseName',
                    'bank_accounts.BankName as BankName',
                    'bank_accounts.Title as BankTitle',
                    'bank_accounts.AccountType as BankAccountType'
                )
                ->where('manage_utlity_expenses.AcademyCode', '=', $admin);
    
            if ($startDate) {
                $expenseQuery->where('manage_utlity_expenses.Date', '>=', $startDate);
            }
    
            if ($ExpenseCategory != 'AllCategories') {
                $expenseQuery->where('manage_utlity_expenses.ExpenseID', '=', $ExpenseCategory);
            }
    
            $ExpenseData = $expenseQuery->get();
    
            $paymentQuery = PaymentRecords::where('AcademyCode', '=', $admin);
            
            if ($startDate) {
                $paymentQuery->where('FeeExpDate', '>=', $startDate);
            }
    
            $PaymentRecords = $paymentQuery->get();
    
            $combinedData = $fetch_salary->merge($ExpenseData);
    

            \Log::error("Database query error: " . $PaymentRecords);

            $response = [
                'expenses' => $combinedData,
                'payments' => $PaymentRecords
            ];
    
            return response()->json($response);
    
        } catch (\Exception $e) {
            \Log::error("Database query error: " . $e->getMessage());
            return response()->json(['error' => 'Server error occurred.'], 500);
        }
    }

    public function BalanceSheet(){
        return view('Manage_Income_Expense_Reports.Balance_Sheet');
    }

    public function SearchBalanceSheet(Request $request) {
        $admin = session()->get('AcademyCode', []);
        $FilterData = $request->input('FilterData');
        $today = now();
    
        if ($FilterData === 'Last1Year') {
            $startDate = $today->copy()->subYear();
        } elseif ($FilterData === 'Last3Years') {
            $startDate = $today->copy()->subYears(3);
        } elseif ($FilterData === 'Last5Years') {
            $startDate = $today->copy()->subYears(5);
        } else {
            return response()->json(['error' => 'Invalid filter selected'], 400);
        }
    
        $formattedStartDate = $startDate->format('Y-m-d');
        $formattedEndDate = $today->format('Y-m-d');
    
        // Fetch and group ManageAssets data by category
        $ManageAssets = ManageAssets::join('assets_categories', 'manage_assets.AssetID', '=', 'assets_categories.id')
            ->select('assets_categories.CategoryName as Category', DB::raw('SUM(manage_assets.Amount) as TotalAmount'))
            ->where('manage_assets.AcademyCode', '=', $admin)
            ->whereBetween('manage_assets.Date', [$formattedStartDate, $formattedEndDate])
            ->groupBy('assets_categories.CategoryName')
            ->get();
    
        // Fetch and group ExpenseReport data by category
        $ExpenseReport = ManageExpense::join('expence_categories', 'manage_expenses.ExpenseID', '=', 'expence_categories.id')
            ->select('expence_categories.CategoryName as Category', DB::raw('SUM(manage_expenses.Amount) as TotalAmount'))
            ->where('manage_expenses.AcademyCode', '=', $admin)
            ->whereBetween('manage_expenses.Date', [$formattedStartDate, $formattedEndDate])
            ->groupBy('expence_categories.CategoryName')
            ->get();
    
        // Get distinct years from ManageAssets and ManageExpense within the date range
        $years = ManageAssets::select(DB::raw('YEAR(Date) as Year'))
            ->where('AcademyCode', '=', $admin)
            ->whereBetween('Date', [$formattedStartDate, $formattedEndDate])
            ->distinct()
            ->pluck('Year');
    
        // If no years found in ManageAssets, check ManageExpense
        if ($years->isEmpty()) {
            $years = ManageExpense::select(DB::raw('YEAR(Date) as Year'))
                ->where('AcademyCode', '=', $admin)
                ->whereBetween('Date', [$formattedStartDate, $formattedEndDate])
                ->distinct()
                ->pluck('Year');
        }
    
        // Sort years in ascending order
        $years = $years->sort()->values();
    
        return response()->json([
            'ManageAssets' => $ManageAssets,
            'ExpenseReport' => $ExpenseReport,
            'Years' => $years,
        ]);
    }
    
    public function SearchCashFlowStatement(Request $request) {
        $admin = session()->get('AcademyCode', []);
        $FilterData = $request->input('FilterData');
        $today = now();
        
        if ($FilterData === 'Last1Year') {
            $startDate = $today->copy()->subYear();
        } elseif ($FilterData === 'Last3Years') {
            $startDate = $today->copy()->subYears(3);
        } elseif ($FilterData === 'Last5Years') {
            $startDate = $today->copy()->subYears(5);
        } else {
            return response()->json(['error' => 'Invalid filter selected'], 400);
        }
        
        $formattedStartDate = $startDate->format('Y-m-d');
        $formattedEndDate = $today->format('Y-m-d');
    
        $ManageCashInflows = PaymentRecords::join('fees_categories', 'payment_records.PaymentID', '=', 'fees_categories.id')
            ->select('payment_records.PaymentID', 'fees_categories.Title as FeesTitle', DB::raw('SUM(payment_records.Paid) as TotalAmount'))
            ->where('payment_records.AcademyCode', '=', $admin)
            ->whereBetween('payment_records.FeeExpDate', [$formattedStartDate, $formattedEndDate]) // Add this line
            ->groupBy('payment_records.PaymentID', 'fees_categories.Title')
            ->get();
    
        $ManageSalaries = ManageSalary::select(
                'utlity_expense_categories.CategoryName as Category',
                DB::raw('SUM(manage_salaries.TotalSalary) as TotalAmount')
            )
            ->join('utlity_expense_categories', 'manage_salaries.ExpenseID', '=', 'utlity_expense_categories.id')
            ->where('manage_salaries.AcademyCode', '=', $admin)
            ->whereBetween('manage_salaries.Date', [$formattedStartDate, $formattedEndDate])
            ->groupBy('utlity_expense_categories.CategoryName')
            ->get();
    
        $formattedSalaries = $ManageSalaries->map(function ($item) {
            return [
                'Category' => $item->Category,
                'TotalAmount' => $item->TotalAmount,
            ];
        });
    
        $ManageCashOutflows = ManageExpense::join('expence_categories', 'manage_expenses.ExpenseID', '=', 'expence_categories.id')
            ->select('expence_categories.CategoryName as Category', DB::raw('SUM(manage_expenses.Amount) as TotalAmount'))
            ->where('manage_expenses.AcademyCode', '=', $admin)
            ->whereBetween('manage_expenses.Date', [$formattedStartDate, $formattedEndDate])
            ->groupBy('expence_categories.CategoryName')
            ->get();
            
        $expenseQuery = ManageUtlityExpense::join('utlity_expense_categories', 'manage_utlity_expenses.ExpenseID', '=', 'utlity_expense_categories.id')
        ->select('utlity_expense_categories.CategoryName as Category', DB::raw('SUM(manage_utlity_expenses.Amount) as TotalAmount'))
        ->where('manage_utlity_expenses.AcademyCode', '=', $admin)
        ->whereBetween('manage_utlity_expenses.Date', [$formattedStartDate, $formattedEndDate])
        ->groupBy('utlity_expense_categories.CategoryName')
        ->get();
        
        \Log::info("ManageSalaries query results: " . $expenseQuery);
        
        return response()->json([
            'ManageCashInflows' => $ManageCashInflows,
            'ManageCashOutflows' => $ManageCashOutflows,
            'ManageSalaries' => $formattedSalaries,
            'expenseQuery' => $expenseQuery
        ]);
    }
    
    // End Income & Expense Reports

    // Start Audit Trails
    // This is before update code 
    // public function SearchTransactionLogs(Request $request) {
    //     $admin = session()->get('AcademyCode', []);
    //     $FilterData = $request->input('FilterData');
    //     $today = now();
    
    //     // Determine the start date based on the filter
    //     if ($FilterData === 'Last1Year') {
    //         $startDate = $today->copy()->subYear();
    //     } elseif ($FilterData === 'Last3Years') {
    //         $startDate = $today->copy()->subYears(3);
    //     } elseif ($FilterData === 'Last5Years') {
    //         $startDate = $today->copy()->subYears(5);
    //     } else {
    //         return response()->json(['error' => 'Invalid filter selected'], 400);
    //     }
    
    //     $formattedStartDate = $startDate->format('Y-m-d');
    //     $formattedEndDate = $today->format('Y-m-d');
    
    //     $StaffAccounts = StaffAccount::where('AcademyCode', '=', $admin)->get();
    //     $result = [];
    
    //     foreach ($StaffAccounts as $employee) {
    //         $employeeID = $employee->id;
    //         $joiningDate = \Carbon\Carbon::parse($employee->created_at);
    //         $expectedSalary = $employee->Salary + $employee->Allowances; // Assuming there is an ExpectedSalary field in StaffAccount
    
    //         // Calculate the effective start date
    //         $effectiveStartDate = $joiningDate->greaterThan($startDate) ? $joiningDate : $startDate;
    
    //         // Initialize monthly data array
    //         $months = [];
    //         for ($date = $effectiveStartDate->copy(); $date <= $today; $date->addMonth()) {
    //             $monthKey = $date->format('Y-m');
    //             $months[$monthKey] = [
    //                 'month' => $monthKey,
    //                 'debit' => 0,
    //                 'credit' => 0 // Initialize credit to 0
    //             ];
    //         }
    
    //         // Fetch ManageSalary records
    //         $ManageSalary = ManageSalary::where('AcademyCode', '=', $admin)
    //             ->where('EmployeeID', '=', $employeeID)
    //             ->whereBetween('Date', [$effectiveStartDate->format('Y-m-d'), $formattedEndDate])
    //             ->get();
    
    //         // Group salary records by month
    //         $monthlyData = $ManageSalary->groupBy(function($date) {
    //             return \Carbon\Carbon::parse($date->Date)->format('Y-m');
    //         });
    
    //         // Populate the employee monthly data
    //         foreach ($monthlyData as $month => $data) {
    //             $debit = $data->sum('TotalSalary');
                
    //             // Set the debit to the sum of TotalSalary
    //             $months[$month]['debit'] = $debit;
    //         }
    
    //         // If salary is not paid for a month, set credit to expected salary
    //         foreach ($months as $monthKey => $data) {
    //             if ($data['debit'] == 0) {
    //                 $months[$monthKey]['credit'] = $expectedSalary;
    //             }
    //         }
    
    //         // Add employee monthly data to the result array
    //         foreach ($months as $month => $data) {
    //             $result[] = [
    //                 'employee_name' => $employee->Name,
    //                 'AccontType' => $employee->AccountType, // assuming AccountType field exists
    //                 'month' => $month,
    //                 'debit' => $data['debit'],
    //                 'credit' => $data['credit']
    //             ];
    //         }
    //     }
    
    //     return response()->json($result);
    // }

    // this is last update code
    public function searchTransactionLogs(Request $request) {
        
        // Retrieve admin session data
        $admin = session()->get('AcademyCode', []);
    
        // Get filter data from request
        $filterData = $request->input('FilterData');
        $startDate = null;
    
        switch ($filterData) {
            case 'Last1Year':
                $startDate = now()->subYear()->format('Y-m-d');
                break;
            case 'Last3Years':
                $startDate = now()->subYears(3)->format('Y-m-d');
                break;
            case 'Last5Years':
                $startDate = now()->subYears(5)->format('Y-m-d');
                break;
            default:
                return response()->json(['error' => 'Invalid filter selected'], 400);
        }
    
        // Fetch StaffAccounts records
        $staffAccounts = StaffAccount::where('AcademyCode', $admin)->get();
    
        // Fetch ManageSalary records
        $manageSalaryRecords = ManageSalary::where('manage_salaries.AcademyCode', $admin)
            ->select('manage_salaries.*',                     
                    'bank_accounts.BankName as BankName',
                    'bank_accounts.Title as BankTitle',
                    'bank_accounts.AccountType as BankAccountType'
                )
            ->join('bank_accounts', 'manage_salaries.BankID', '=', 'bank_accounts.id')
            ->whereBetween('manage_salaries.Date', [$startDate, now()->format('Y-m-d')])
            ->get();
    
        // Fetch ManageExpense records
        $manageExpenseRecords = ManageExpense::where('manage_expenses.AcademyCode', $admin)
            ->select('manage_expenses.*', 
                'expence_categories.CategoryName as CategoryName',
                'bank_accounts.BankName as BankName',
                'bank_accounts.Title as BankTitle',
                'bank_accounts.AccountType as BankAccountType'
            )
            ->join('expence_categories', 'manage_expenses.ExpenseID', '=', 'expence_categories.id')
            ->join('bank_accounts', 'manage_expenses.BankID', '=', 'bank_accounts.id')
            ->orderBy('manage_expenses.id', 'desc')
            ->whereBetween('manage_expenses.Date', [$startDate, now()->format('Y-m-d')])
            ->get();
    

        $expenseQuery = ManageUtlityExpense::join('utlity_expense_categories', 
                'manage_utlity_expenses.ExpenseID', '=', 'utlity_expense_categories.id'
            )
            ->join('bank_accounts', 'manage_utlity_expenses.BankID', '=', 'bank_accounts.id')
            ->select(
                'manage_utlity_expenses.*',
                'manage_utlity_expenses.Amount as ExpenseAmount',
                'utlity_expense_categories.CategoryName as ExpenseName',
                'bank_accounts.BankName as BankName',
                'bank_accounts.Title as BankTitle',
                'bank_accounts.AccountType as BankAccountType'
            )
            ->where('manage_utlity_expenses.AcademyCode', '=', $admin)
            ->orderBy('utlity_expense_categories.id', 'desc')
            ->whereBetween('manage_utlity_expenses.Date', [$startDate, now()->format('Y-m-d')])
            ->get();

        // Combine and format the data
        $result = [];
    
        foreach ($expenseQuery as $record) {
            $result[] = [
                'employee_name' => $record->ExpenseName,
                'AccountType' => 'Expense',
                'month' => \Carbon\Carbon::parse($record->Date)->format('d-m-Y'),
                'debit' => $record->Amount,
                'credit' => $record->BankName . ' - ' . $record->BankTitle . ' - ' . $record->BankAccountType
            ];
        }

        foreach ($manageSalaryRecords as $record) {
            // Find corresponding staff account
            $employee = $staffAccounts->where('employee_id', $record->employee_id)->first();
    
            $result[] = [
                'employee_name' => $employee->Name . ' - ' . $employee->AccountType,
                'AccountType' => 'Salary',
                'month' => \Carbon\Carbon::parse($record->Date)->format('d-m-Y'),
                'debit' => $record->TotalSalary,
                'credit' => $record->BankName . ' - ' . $record->BankTitle . ' - ' . $record->BankAccountType
            ];
        }
    
        foreach ($manageExpenseRecords as $record) {
            $result[] = [
                'employee_name' => $record->CategoryName, // Assuming CategoryName contains the expense category
                'AccountType' => 'Liability',
                'month' => \Carbon\Carbon::parse($record->Date)->format('d-m-Y'),
                'debit' => $record->Amount,
                'credit' => $record->BankName . ' - ' . $record->BankTitle . ' - ' . $record->BankAccountType // Assuming BankName contains the bank name
            ];
        }
    
        // \Log::info("ManageCashOutflows query results: " . json_encode($result));

        return response()->json($result);
    }
    // End Audit Trails

    // Start Reporting and Analytics
    public function GarphicalCharts() {
        $admin = session()->get('AcademyCode', []);
    
        // Get the current date and the start of the month
        $startOfMonth = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
        $startOfYear = \Carbon\Carbon::now()->startOfYear()->format('Y-m-d');
        $endOfYear = \Carbon\Carbon::now()->endOfYear()->format('Y-m-d');
    
        // this month expense
        $ManageExpense = ManageExpense::where('AcademyCode', '=', $admin)
            ->whereBetween('Date', [$startOfMonth, $currentDate])
            ->sum('Amount');


        $PaymentRecords = PaymentRecords::where('AcademyCode', '=', $admin)
        ->whereBetween('created_at', [$startOfMonth, $currentDate])
        ->sum('Paid');

        // total students
        $admitStudent = admitStudent::where('AcademyCode', '=', $admin)->count();
        // Total Staff
        $StaffAccount = StaffAccount::where('AcademyCode', '=', $admin)->count();
 

        // Reporting And Analytics        
        $YearManageAssets = ManageAssets::where('AcademyCode', '=', $admin)
            ->whereBetween('Date', [$startOfYear, $endOfYear])
            ->sum('Amount');

        $YearManageExpense = ManageExpense::where('AcademyCode', '=', $admin)
            ->whereBetween('Date', [$startOfYear, $endOfYear])
            ->sum('Amount');

        $YearPaymentRecords = PaymentRecords::where('AcademyCode', '=', $admin)
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->sum('Paid');
        
        $YearManageSalary = ManageSalary::where('AcademyCode', '=', $admin)
            ->whereBetween('Date', [$startOfYear, $endOfYear])
            ->sum('TotalSalary');
        
        $YearadmitStudent = admitStudent::where('AcademyCode', '=', $admin)
            ->whereBetween('AdmissionDate', [$startOfYear, $endOfYear])
            ->count();

        return view('index', [
            'ManageExpense' => $ManageExpense,
            'PaymentRecords' => $PaymentRecords,
            'admitStudent' => $admitStudent,
            'StaffAccount' => $StaffAccount,

            // this year data
            'YearManageAssets' => $YearManageAssets,
            'YearManageExpense' => $YearManageExpense,
            'YearPaymentRecords' => $YearPaymentRecords,
            'YearManageSalary' => $YearManageSalary,
            'YearadmitStudent' => $admitStudent,

        ]);
    }
    // End Reporting and Analytics

    // Start Utlity Expense
    public function UtlityExpenseCategory(){
        return view('UtlityExpenseCategory.UtlityExpenseCategory');
    }

    public function SaveUtlityExpenseCategory(Request $req){
        try {
            // Create an array to store all the new class entries
            $newClasses = [];
            $currentTime = \Carbon\Carbon::now()->format('Y-m-d');
    
            // Get the admin session
            $admin = session()->get('AcademyCode', '');
    
            // Loop through each class entry submitted in the form
            foreach ($req->Expensecategory as $category_name) {
                // Create a new ExpenceCategory object
                $SClass = new UtlityExpenseCategory;
    
                // Generate a unique code for the class
                do {
                    $uniqueID = \Str::random(50);
                } while (UtlityExpenseCategory::where('UniqueCode', $uniqueID)->exists());
    
                // Check if the class already exists within the specified AcademyCode
                $existingClass = UtlityExpenseCategory::where('CategoryName', $category_name)
                                                ->where('AcademyCode', $admin)
                                                ->first();
    
                // If the class already exists in the academy, skip adding it and return an error message
                if ($existingClass) {
                    $req->session()->flash('status', 'One or more Expense Category already exist in the specified academy.');
                    return redirect()->back();
                }
    
                // Otherwise, add the class entry to the array                
                $newClasses[] = [
                    'CategoryName' => $category_name,
                    'AcademyCode' => $admin, // Use $admin here
                    'UniqueCode' => $uniqueID,
                    'CreateDate' => $currentTime
                ];
            }
    
            // Bulk insert all the new class entries
            UtlityExpenseCategory::insert($newClasses);
    
            // Flash success message
            $req->session()->flash('Success_status', 'Expense Category Added Successfully!');
            return redirect()->route('AllUtlityExpenseCategory');
    
        } catch (\Exception $e) {
            // Log the error message for debugging
            \Log::error('Error adding classes: ' . $e->getMessage());
    
            // Flash error message
            $req->session()->flash('status', 'Failed to add classes. Please try again later.');
            return redirect()->back();
        }
    }

    public function AllUtlityExpenseCategory(){
        $admin = session()->get('AcademyCode', []);
        $UtlityExpenseCategory = UtlityExpenseCategory::where('AcademyCode', $admin)->get();
        return view('UtlityExpenseCategory.AllUtlityExpense', ['UtlityExpenseCategory' => $UtlityExpenseCategory]);
    }

    public function DropUtlityExpenseCategory($id){
        $UtlityExpenseCategory = UtlityExpenseCategory::where('id', $id)->delete();
        Session::flash('Success_status', 'Expense Category Deleted Successfully!');
        return redirect()->route('AllUtlityExpenseCategory');
    }

    public function EditUtlityExpenseCategory($id){
        $admin = session()->get('AcademyCode', []);
        $UtlityExpenseCategory = UtlityExpenseCategory::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->first();
        return view('UtlityExpenseCategory.EditUtlityExpenseCategory', ['UtlityExpenseCategory' => $UtlityExpenseCategory]);
    }

    public function UpdateUtlityExpenseCategory(Request $req, $id){
        $admin = session()->get('AcademyCode', []);
        $UtlityExpenseCategory = UtlityExpenseCategory::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->first();

        $UtlityExpenseCategory->CategoryName = $req->Expensecategory;
        $UtlityExpenseCategory->save();

        Session::flash('Success_status', 'Expense Category Updated Successfully!');
        return redirect()->route('AllUtlityExpenseCategory');
    }
    // End Utlity Expense

    // Start Manage Utlity Expense
    public function ManageUtlityExpense(){
        $admin = session()->get('AcademyCode', '');
        $UtlityExpense = UtlityExpenseCategory::where('AcademyCode', '=' , $admin)->get();
        $BankAccount = BankAccount::where('AcademyCode', '=' , $admin)->get();
        return view('Manage_Utlity_Expense.Manage_Utlity_Expense', [
            'UtlityExpense' => $UtlityExpense,
            'BankAccount' => $BankAccount
        ]);
    }

    public function SaveManageUtlityExpense(Request $req){

        $admin = session()->get('AcademyCode', '');
        $ManageUtlityExpense = new ManageUtlityExpense;
        // Generate a unique code for the class
        do {
            $uniqueID = \Str::random(50);
        } while (ManageUtlityExpense::where('UniqueCode', $uniqueID)->exists());

        $ManageUtlityExpense->Date = $req->Date;
        $ManageUtlityExpense->Amount = $req->Amount;
        $ManageUtlityExpense->Description = $req->Description;
        $ManageUtlityExpense->ExpenseID = $req->ExpenseCategory;
        $ManageUtlityExpense->BankID = $req->DebitAccount;
        $ManageUtlityExpense->AcademyCode = $admin;
        $ManageUtlityExpense->UniqueCode = $uniqueID;

        $ManageUtlityExpense->save();

        $req->session()->flash('Success_status', 'Manage Expense added Successfully!');
        return redirect()->route('AllManageUtlityExpense');
    }

    public function AllManageUtlityExpense(){
        $admin = session()->get('AcademyCode', '');    

        $ManageUtlityExpense = ManageUtlityExpense::where('manage_utlity_expenses.AcademyCode', $admin)
            ->select('manage_utlity_expenses.*', 
                'utlity_expense_categories.CategoryName as CategoryName',
                'bank_accounts.BankName as BankName'
            )
            ->join('utlity_expense_categories', 'manage_utlity_expenses.ExpenseID', '=', 'utlity_expense_categories.id')
            ->join('bank_accounts', 'manage_utlity_expenses.BankID', '=', 'bank_accounts.id')
            ->orderBy('manage_utlity_expenses.id', 'desc')
            ->get();

        return view('Manage_Utlity_Expense.All_Manage_Utlity_Expense', ['ManageUtlityExpense' => $ManageUtlityExpense]);
    }

    public function DropManageUtlityExpense($id){
        $admin = session()->get('AcademyCode', '');    
        $ManageUtlityExpense = ManageUtlityExpense::where('AcademyCode', $admin)
        ->where('UniqueCode', $id)
        ->delete();

        Session::flash('Success_status', 'Manage Expense deleted Successfully!');
        return redirect()->route('AllManageUtlityExpense');
    }

    public function EditManageUtlityExpense($id){
        $admin = session()->get('AcademyCode', '');
        $UtlityExpenseCategory = UtlityExpenseCategory::where('AcademyCode', $admin)->get();
        $BankAccount = BankAccount::where('AcademyCode', $admin)->get();
        
        $ManageUtlityExpense = ManageUtlityExpense::where('manage_utlity_expenses.UniqueCode', $id)
            ->select('manage_utlity_expenses.*', 
                'utlity_expense_categories.CategoryName as CategoryName',
                'bank_accounts.BankName as BankName',
                'bank_accounts.Title as BankTitle'
            )
            ->join('utlity_expense_categories', 'manage_utlity_expenses.ExpenseID', '=', 'utlity_expense_categories.id')
            ->join('bank_accounts', 'manage_utlity_expenses.BankID', '=', 'bank_accounts.id')
            ->where('manage_utlity_expenses.AcademyCode', $admin)        
            ->first();

        return view('Manage_Utlity_Expense.Edit_Manage_Utlity_Expense', [
            'ManageUtlityExpense' => $ManageUtlityExpense,
            'BankAccount' => $BankAccount,
            'UtlityExpenseCategory' => $UtlityExpenseCategory
        ]);
    }

    public function UpdateManageUtlityExpense(Request $req, $id){
        $admin = session()->get('AcademyCode', '');
        $ManageUtlityExpense = ManageUtlityExpense::where('UniqueCode', '=', $id)
            ->where('AcademyCode', '=', $admin)
            ->first();
        
        $ManageUtlityExpense->Date = $req->Date;
        $ManageUtlityExpense->Amount = $req->Amount;
        $ManageUtlityExpense->Description = $req->Description;
        $ManageUtlityExpense->ExpenseID = $req->ExpenseCategory;
        $ManageUtlityExpense->BankID = $req->DebitAccount;        

        $ManageUtlityExpense->save();

        $req->session()->flash('Success_status', 'Manage Expense updated Successfully!');
        return redirect()->route('AllManageUtlityExpense');
    }

    public function SearchUtlityExpenseReport(Request $request) {
        $admin = session()->get('AcademyCode', []);
        $DateRange = $request->input('DateRange');
        // DateRange ko split karo start aur end dates mein
        list($startDate, $endDate) = explode(' - ', $DateRange);
        // DateTime object mein convert karo
        $startDateTime = \DateTime::createFromFormat('m/d/Y', $startDate);
        $endDateTime = \DateTime::createFromFormat('m/d/Y', $endDate);
        // MySQL ke date format mein convert karo
        $formattedStartDate = $startDateTime->format('Y-m-d');
        $formattedEndDate = $endDateTime->format('Y-m-d');

        try {
            // Fetch data from the database using the provided parameters
            $ManageUtlityExpense = ManageUtlityExpense::join('utlity_expense_categories', 
                    'manage_utlity_expenses.ExpenseID', '=', 'utlity_expense_categories.id')
                ->select('manage_utlity_expenses.*', 'utlity_expense_categories.CategoryName as ExpenseName', 
                'bank_accounts.BankName as BankName',
                'bank_accounts.Title as BankTitle',
                'bank_accounts.AccountType as BankAccountType',
                )
                ->join('bank_accounts', 'manage_utlity_expenses.BankID', '=', 'bank_accounts.id')
                ->where('manage_utlity_expenses.AcademyCode', '=', $admin)
                ->whereBetween('manage_utlity_expenses.Date', [$formattedStartDate, $formattedEndDate])
                ->get();


            \Log::info("ManageCashOutflows query results: " . json_encode($ManageUtlityExpense));

            // Data ko JSON format mein return karna
            return response()->json($ManageUtlityExpense);
        } catch (\Exception $e) {
            \Log::error("Database query error: " . $e->getMessage());
            return response()->json(['error' => 'Server error occurred.'], 500);
        }
    
    }
    // End Manage Utlity Expense

}
