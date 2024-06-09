@extends('master')
@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <form method="post" action="{{ route('SaveStaffAccount') }}" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control input-default" name="Name" placeholder="Name" required>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Phone: <span>(Optional)</span> </label>
                                                <input type="text" class="form-control input-default" name="Phone" placeholder="Phone">
                                            </div>
                                        </div>                                

                                    </div>
                            
                                    <div class="form-group">
                                        <label>Email: <span>(Required)</span> </label>
                                        <input type="text" class="form-control input-default" name="Email" placeholder="Email" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Image: <span>(Optional)</span> </label>
                                        <input type="file" class="form-control input-default" name="Image">
                                    </div>
                                
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Account Type: <span>(Required)</span> </label>
                                                <select class="form-control" name="Account_Type" id="sel1" required>
                                                    <option value="" selected disabled>Select</option>                                                    
                                                    <option value="Accountant">Accountant</option>                                                    
                                                    <option value="Teacher">Teacher</option>                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Salary: <span>(Required)</span> </label>
                                                <input type="text" class="form-control" name="Salary" placeholder="Salary Amount" required>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Allowances: <span>(Optional)</span> </label>
                                                <input type="text" class="form-control" name="Allowances" placeholder="Allowances '1000'" required>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Deductions: <span>(Optional)</span> </label>
                                                <input type="text" class="form-control" name="Deductions" placeholder="Deductions '1000'" required>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">                                        
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Can Add: <span>(Required)</span> </label>
                                                <select class="form-control" name="CanAdd" id="sel1" required>
                                                    <option value="" selected disabled>Select</option>                                        
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>                                                
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Can Edit: <span>(Required)</span> </label>
                                                <select class="form-control" name="CanEdit" id="sel1" required>
                                                    <option value="" selected disabled>Select</option>                                        
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>                                                
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Can Delete: <span>(Required)</span> </label>
                                                <select class="form-control" name="CanDrop" id="sel1" required>
                                                    <option value="" selected disabled>Select</option>                                        
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>                                                
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group d-flex justify-content-end align-items-end">
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