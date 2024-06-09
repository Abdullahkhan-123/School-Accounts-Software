@extends('master')
@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <form method="post" action="{{ route('SaveAdmitStudent') }}" enctype="multipart/form-data">
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
                                        <input type="text" class="form-control input-default" name="SName" placeholder="Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Select Gender:</label>
                                        <select class="form-control" name="SGender" id="sel1" required>
                                            <option value="" selected disabled>Select</option>                                        
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>                                        
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Date Of Birth:</label>
                                        <input type="date" class="form-control input-default" name="SDOB" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Student Photo:</label>                                    
                                        <input type="file" class="form-control" name="SImage" id="inputGroupFile01" required>
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
                                        <input type="text" class="form-control" name="FName" placeholder="Father Name" required>
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="FCard" placeholder="Father ID Card (Without Dash)" required>
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="FEmail" placeholder="Father Email" required>
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="FPhone" placeholder="Father Phone (Please use country code)" required>
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="MPhone" placeholder="Mother Phone (Please use country code)" required>
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <input type="text" class="form-control" name="Religion" placeholder="Religion" required>
                                    </div>

                                    <div class="col mt-2 mt-sm-0">
                                        <label></label>
                                        <textarea class="form-control" rows="2" name="HomeAddress" placeholder="Home Address" required></textarea>
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
                                        <!-- <input type="text" class="form-control input-default" name="MonthlyFee" placeholder="Monthly Fee" required> -->
                                        <select class="form-control" name="MonthlyFee" id="sel1" required>
                                            <option value="" selected disabled>Select</option>
                                            @foreach($FeesCategory as $FeesCat)
                                                <option value="{{ $FeesCat->id }}">{{ $FeesCat->Title. ' - ' . 'Class '. $FeesCat->ClassName. ' - ' .$FeesCat->Amount }}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Is Discounted Student?:</label>
                                        <select class="form-control" name="IsDiscountedStudent" id="sel1" required>
                                            <option value="" selected disabled>Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Welcome SMS Alert:</label>
                                        <select class="form-control" name="WelcomeSmsAlert" id="sel1" required>
                                            <option value="" selected disabled>Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>                                        
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Generate Addmission Fee:</label>
                                        <select class="form-control" name="GererateAdmissionFee" id="sel1" required>
                                            <option value="" selected disabled>Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
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
                                        <select class="form-control" name="Class" id="sel1" required>
                                            <option value="" selected disabled>Select</option>

                                            @foreach($AllClasses as $AllClasses)
                                                <option value="{{ $AllClasses->id }}">{{ 'Class '. $AllClasses->Class }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                    <div class="col-auto">
                                        <label>Admission Date</label>
                                        <input type="date" class="form-control mb-2" name="AdmissionDate" placeholder="Admission Date" required>
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