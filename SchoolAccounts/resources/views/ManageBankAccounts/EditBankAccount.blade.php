@extends('master')
@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row">

            <!-- First Row -->
            <div class="col-xl-12 col-xxl-12">

                <!-- Academic Information -->
                <div class="card col-6 d-flex m-auto justify-content-center">

                    @if(Session::has('status'))
                    <div class="alert alert-danger mb-0 text-center" role="alert">
                        {{ Session::get('status') }}
                    </div>
                    @elseif(Session::has('Success_status'))
                    <div class="alert alert-success mb-0 text-center" role="alert">
                        {{ Session::get('Success_status') }}
                    </div>
                    @endif

                    <div class="card-header">
                        <h4 class="card-title">Bank Account</h4>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">

                            <form method="post" action="{{ route('UpdateBankAccounts', $BankAccount->UniqueCode) }}">
                                @csrf
                                    <div class="row">                                
                                        <div class="col">
                                            <label>Bank Name</label>
                                            <input type="text" class="form-control mb-2" name="BankName"
                                                placeholder="Bank Name" value="{{ $BankAccount->BankName }}" required>
                                        </div>

                                        <div class="col">
                                            <label>Title</label>
                                            <input type="text" class="form-control mb-2" name="Title"
                                                placeholder="Title" value="{{ $BankAccount->Title }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <label>Branch Code</label>
                                            <input type="text" class="form-control mb-2" name="BranchCode"
                                                placeholder="Branch Code" value="{{ $BankAccount->BranchCode }}" required>
                                        </div>

                                        <div class="col-8">
                                            <label>Account Number</label>
                                            <input type="text" class="form-control mb-2" name="AccountNumber"
                                                placeholder="Account Number" value="{{ $BankAccount->AccountNumber }}" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label>Account IBAN Number <span>Optional</span> </label>
                                            <input type="text" class="form-control mb-2" name="IBANNumber"
                                                placeholder="IBAN Number" value="{{ $BankAccount->IBANNumber }}">
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col">
                                            <label>Account Type:</label>
                                            <select class="form-control" name="AccountType" id="sel1" required>
                                                <option value="{{ $BankAccount->AccountType }}" selected>{{ $BankAccount->AccountType }}</option>

                                                @if($BankAccount->AccountType == 'Capital')
                                                    <option value="FixedAssets">Fixed Assets</option>
                                                    <option value="CurrentAssets">Current Assets</option>
                                                @elseif($BankAccount->AccountType == 'FixedAssets')
                                                    <option value="Capital">Capital</option>
                                                    <option value="CurrentAssets">Current Assets</option>
                                                @elseif($BankAccount->AccountType == 'CurrentAssets')
                                                    <option value="Capital">Capital</option>
                                                    <option value="FixedAssets">Fixed Assets</option>
                                                @else
                                                    <option value="Capital">Capital</option>
                                                    <option value="FixedAssets">Fixed Assets</option>
                                                    <option value="CurrentAssets">Current Assets</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label>Opening Balance</label>
                                            <input type="text" class="form-control mb-2" name="Balance"
                                                placeholder="Balance" value="{{ $BankAccount->Balance }}" required>
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-12 mt-2 d-flex justify-content-end align-items-end">                                        
                                            <button type="submit" class="btn btn-primary mb-2 ml-2">Save</button>
                                        </div>
                                    </div>
                                    
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
