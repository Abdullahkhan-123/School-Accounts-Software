@extends('master')
@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
    
            <div class="row">
        
                <div class="col-lg-12">
        
                @if(Session::has('status'))
                    <div class="alert alert-danger mb-0 text-center" role="alert">
                        {{ Session::get('status') }}
                    </div>
                @elseif(Session::has('Success_status'))
                    <div class="alert alert-success mb-0 text-center" role="alert">
                        {{ Session::get('Success_status') }}
                    </div>
                @endif
                
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Bank Accounts List</h4>
                            <h4 class="card-title">
                                <button class="btn btn-primary mb-2"> <a href="{{ route('BankAccounts') }}" class="text-decoration-none text-white">Add More</a> </button>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Bank Name</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Account Type</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php $LoopID = 1; @endphp

                                        @foreach($BankAccount as $BankAccount)

                                        <tr>
                                            <td>{{ $LoopID++ }}</td>
                                            
                                            <td>{{ $BankAccount->BankName }}</td>
                                            <td>{{ $BankAccount->Title }}</td>
                                            <td>{{ $BankAccount->AccountType }}</td>
                                            <td>{{ $BankAccount->Balance }}</td>
                                            <td>{{ $BankAccount->Date }}</td>                                            
                                            <td>{{ Str::words($BankAccount->Description, 5, '') }}</td>
                                            <td>
                                                <span>
                                                    <a href="{{ route('EditBankAccounts', $BankAccount->UniqueCode) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil color-muted"></i> 
                                                    </a>
                                                    <a href="{{ route('DropBankAccounts', $BankAccount->id) }}" data-toggle="tooltip" data-placement="top" title="Close">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            
        </div>
    </div>

@endsection