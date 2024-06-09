@extends('master')
@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <form method="post" action="{{ route('UpdateStudent', $StudentData->UniqueCode) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- First Row -->
                    <div class="col-lg-6 col-sm-12">
                        <!-- Student Information Cart -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Student Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                    <div class="form-group">
                                        <label>Student Name:</label>
                                        <input type="text" class="form-control input-default" name="SName" placeholder="Name" value="{{ $StudentData->SName }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Select Gender:</label>
                                        <select class="form-control" name="SGender" id="sel1">
                                            <option value="{{ $StudentData->SGender }}" selected>{{ $StudentData->SGender }}</option>  
                                            
                                            @if($StudentData->SGender != 'Male')
                                                <option value="Male">Male</option>
                                            @endif
                                            
                                            @if($StudentData->SGender != 'Female')
                                                <option value="Female">Female</option>
                                            @endif
                                            
                                            @if($StudentData->SGender != 'Other')
                                                <option value="Other">Other</option>
                                            @endif                                     
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Date Of Birth:</label>
                                        <input type="date" class="form-control input-default" name="SDOB" value="{{ $StudentData->SDOB }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Student Photo:</label>                                    
                                        <input type="file" class="form-control" name="SImage" id="inputGroupFile01">
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <img src="{{ asset('uploads/student_images/' . $StudentData->SImage) }}" alt="Image" style="height:auto; width:20%;">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <!-- Parent Information Cart -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Parent Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">                                
                                    
                                    <div class="col mt-2 mt-sm-0">                                    
                                        <input type="text" class="form-control" name="FName" placeholder="Father Name" value="{{ $StudentData->FName }}">
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="FCard" placeholder="Father ID Card (Without Dash)" value="{{ $StudentData->FCard }}">
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="FEmail" placeholder="Father Email" value="{{ $StudentData->FEmail }}">
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="FPhone" placeholder="Father Phone" value="{{ $StudentData->FPhone }}">
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="MPhone" placeholder="Mother Phone" value="{{ $StudentData->MPhone }}">
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="Religion" placeholder="Religion" value="{{ $StudentData->Religion }}">
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <textarea class="form-control" rows="2" name="HomeAddress" placeholder="Home Address">{{ $StudentData->HomeAddress }}</textarea>
                                    </div>
                                                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Second Row -->
                    <div class="col-lg-6 col-sm-12">
                        <!-- Other Information Cart -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Other Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">                                
                                
                                    <div class="form-group">
                                        <label>Monthly Fee:</label>
                                        <!-- <input type="text" class="form-control input-default" name="MonthlyFee" placeholder="Monthly Fee" value="{{ $StudentData->MonthlyFee }}"> -->
                                        <select class="form-control" name="MonthlyFee" id="sel1" required>
                                            <option value="{{ $StudentData->MonthlyFee }}" selected>{{ $StudentData->FeeCategory_Title. ' - ' . 'Class '. $StudentData->FeeCategory_Class. ' - ' .$StudentData->FeeCategory_Amount }}</option>
                                            @foreach($FeesCategory as $FeesCat)
                                                @if($FeesCat->id != $StudentData->MonthlyFee)
                                                    <option value="{{ $FeesCat->id }}">{{ $FeesCat->Title. ' - ' . 'Class '. $FeesCat->ClassName. ' - ' .$FeesCat->Amount }}</option>
                                                @endif
                                            @endforeach                                            
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Is Discounted Student?:</label>
                                        <select class="form-control" name="IsDiscountedStudent" id="sel1">
                                            <option value="{{ $StudentData->IsDiscountedStudent }}" selected>{{ $StudentData->IsDiscountedStudent }}</option>

                                            @if($StudentData->IsDiscountedStudent == 'Yes')
                                                <option value="No">No</option>
                                            @else
                                                <option value="Yes">Yes</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Welcome SMS Alert:</label>
                                        <select class="form-control" name="WelcomeSmsAlert" id="sel1">
                                        <option value="{{ $StudentData->WelcomeSmsAlert }}" selected>{{ $StudentData->WelcomeSmsAlert }}</option>

                                            @if($StudentData->WelcomeSmsAlert == 'Yes')
                                                <option value="No">No</option>
                                            @else
                                                <option value="Yes">Yes</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Generate Addmission Fee:</label>
                                        <select class="form-control" name="GererateAdmissionFee" id="sel1">
                                        <option value="{{ $StudentData->GererateAdmissionFee }}" selected>{{ $StudentData->GererateAdmissionFee }}</option>

                                            @if($StudentData->GererateAdmissionFee == 'Yes')
                                                <option value="No">No</option>
                                            @else
                                                <option value="Yes">Yes</option>
                                            @endif
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <!-- Academic Information -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Academic Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">                                

                                    <div class="col-auto">
                                        <label>Select Class:</label>
                                        <select class="form-control" name="Class" id="sel1">
                                            <option value="{{ $StudentData->ClassID }}" selected>{{'Class '. $StudentData->ClassName }}</option>

                                            @foreach($AllClasses as $AllClasses)
                                                @if($StudentData->ClassID == $AllClasses->id)
                                                @else
                                                    <option value="{{ $AllClasses->id }}">{{ 'Class '. $AllClasses->Class }}</option>
                                                @endif
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                    <div class="col-auto">
                                        <label>Admission Date</label>
                                        <input type="date" class="form-control mb-2" name="AdmissionDate" placeholder="Admission Date" value="{{$StudentData->AdmissionDate}}">
                                    </div>
                                    
                                    <div class="col-12 mt-2 d-flex justify-content-end align-items-end">
                                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                    </div>
                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

@endsection