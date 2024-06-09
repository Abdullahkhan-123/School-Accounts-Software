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
                        <h4 class="card-title">Liability Manage Expense</h4>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">

                            <form method="post" action="{{ route('SaveManageExpense') }}">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label class="sr-only">Date</label>
                                        <input type="date" class="form-control mb-2 admitClass" name="Date" required>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col">
                                        <label>Expense Category:</label>
                                        <select class="form-control" name="ExpenseCategory" id="sel1" required>
                                            <option value="" selected disabled>Select</option>

                                            @foreach($ExpenceCategory as $ExpenceCategory)
                                                <option value="{{ $ExpenceCategory->id }}">{{ $ExpenceCategory->CategoryName}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label>Debit Account:</label>
                                        <select class="form-control" name="DebitAccount" id="sel1" required>
                                            <option value="" selected disabled>Select</option>

                                            @foreach($BankAccount as $BankAccount)
                                                <option value="{{ $BankAccount->id }}">{{ $BankAccount->BankName . ' - ' . $BankAccount->Title }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Amount</label>
                                        <input type="text" class="form-control mb-2" placeholder="Debit Amount '0'" name="Amount" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Description</label>
                                        <textarea class="form-control mb-2" name="Description"></textarea>                                        
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
