@extends('master')
@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <form method="post" action="{{ route('UpdateStaffAccount', $StaffAccount->UniqueCode) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- First Row -->
                    <div class="col-lg-12 col-sm-12">
                        <!-- Inquiry Information form -->
                        <div class="card col-lg-6 col-sm-12 m-auto">
                            <div class="card-header">
                                <h4 class="card-title">Staff Accounts Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Name: <span>(Required)</span> </label>
                                                <input type="text" class="form-control input-default" name="Name" placeholder="Name" value="{{ $StaffAccount->Name }}" required>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Phone: <span>(Optional)</span> </label>
                                                <input type="text" class="form-control input-default" name="Phone" placeholder="Phone" value="{{ $StaffAccount->Phone }}">
                                            </div>
                                        </div>                                

                                    </div>
                            
                                    <div class="form-group">
                                        <label>Email: <span>(Required)</span> </label>
                                        <input type="text" class="form-control input-default" name="Email" placeholder="Email" value="{{ $StaffAccount->Email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Image: <span>(Optional)</span> </label>
                                        <input type="file" class="form-control input-default" name="Image">
                                        @if($StaffAccount->Image != '')
                                            <div class="d-flex justify-content-end align-items-end mt-1">
                                                <img src="{{ asset('uploads/staff_images/' . $StaffAccount->Image) }}" class="img-fluid" style="height:90px; width:150px;">
                                            </div>
                                        @endif
                                    </div>
                                
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Account Type: <span>(Required)</span> </label>
                                                <select class="form-control" name="Account_Type" id="sel1" required>
                                                    <option value="{{ $StaffAccount->AccountType }}" selected>{{ $StaffAccount->AccountType }}</option>
                                                    @if($StaffAccount->AccountType == 'Faculty')
                                                        <option value="Accountant">Accountant</option>
                                                        <option value="Receptionist">Receptionist</option>

                                                    @elseif($StaffAccount->AccountType == 'Accountant')
                                                        <option value="Faculty">Faculty</option>                                                        
                                                        <option value="Receptionist">Receptionist</option>
                                                    @elseif($StaffAccount->AccountType == 'Receptionist')
                                                        <option value="Faculty">Faculty</option>
                                                        <option value="Accountant">Accountant</option>
                                                    @else
                                                        <option value="Faculty">Faculty</option>
                                                        <option value="Accountant">Accountant</option>
                                                        <option value="Receptionist">Receptionist</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Salary: <span>(Required)</span> </label>
                                                <input type="text" class="form-control" name="Salary" placeholder="Salary Amount" value="{{ $StaffAccount->Salary }}" required>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Allowances: <span>(Optional)</span> </label>
                                                <input type="text" class="form-control" name="Allowances" placeholder="Allowances '1000'" value="{{ $StaffAccount->Allowances }}" required>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Deductions: <span>(Optional)</span> </label>
                                                <input type="text" class="form-control" name="Deductions" placeholder="Deductions '1000'" value="{{ $StaffAccount->Deductions }}" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Can Add: <span>(Required)</span> </label>
                                                <select class="form-control" name="CanAdd" id="sel1" required>
                                                    <option value="{{ $StaffAccount->CanAdd }}" selected>{{ $StaffAccount->CanAdd }}</option>
                                                    @if($StaffAccount->CanAdd == 'Yes')
                                                        <option value="No">No</option>
                                                    @else
                                                        <option value="Yes">Yes</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Can Edit: <span>(Required)</span> </label>
                                                <select class="form-control" name="CanEdit" id="sel1" required>
                                                    <option value="{{ $StaffAccount->CanEdit }}" selected>{{ $StaffAccount->CanEdit }}</option>                                        
                                                    @if($StaffAccount->CanEdit == 'Yes')
                                                        <option value="No">No</option>
                                                    @else
                                                        <option value="Yes">Yes</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Can Delete: <span>(Required)</span> </label>
                                                <select class="form-control" name="CanDrop" id="sel1" required>
                                                    <option value="{{ $StaffAccount->CanDrop }}" selected>{{ $StaffAccount->CanDrop }}</option>                                        
                                                    @if($StaffAccount->CanDrop == 'Yes')
                                                        <option value="No">No</option>
                                                    @else
                                                        <option value="Yes">Yes</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group d-flex justify-content-end align-items-end">
                                        <button type="submit" class="btn btn-primary mb-2">Save</button>
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