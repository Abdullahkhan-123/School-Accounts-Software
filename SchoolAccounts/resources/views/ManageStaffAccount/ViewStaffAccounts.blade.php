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
                            <h4 class="card-title">Staff Manage</h4>
                            <h4 class="card-title">

                                <button class="btn btn-primary mb-2"> <a href="{{ route('StaffAccount') }}" class="text-decoration-none text-white">Add More</a> </button>

                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Account Type</th>                                            
                                            <th scope="col">Account Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php $LoopID = 1; @endphp

                                        @foreach($StaffAccount as $StaffAccount)

                                        <tr>
                                            <td>{{ $LoopID++ }}</td>
                                            
                                            <td>{{ $StaffAccount->Name }}</td>
                                            <td>{{ $StaffAccount->Email }}</td>
                                            <td>{{ $StaffAccount->Phone }}</td>
                                            <td>{{ $StaffAccount->AccountType }}</td>
                                            <td>
                                                @if($StaffAccount->Status == '1')
                                                    <a href="#" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <button class="btn btn-success btn-small text-white" id="no-drop">
                                                            Active <i class="fa fa-check color-muted"></i>
                                                        </button>                                                        
                                                    </a>
                                                    <a href="{{ route('DeactivateStaffAccount', $StaffAccount->UniqueCode) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">                                                        
                                                        <button class="btn btn-danger btn-small">Deactivate</button>
                                                    </a>
                                                @elseif($StaffAccount->Status == '2')
                                                    <a href="{{ route('ActiveStaffAccount', $StaffAccount->UniqueCode) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <button class="btn btn-success btn-small text-white">Active</button>
                                                    </a>
                                                    <a href="#" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">                                                        
                                                        <button class="btn btn-danger btn-small" id="no-drop">
                                                            Deactivate <i class="fa fa-check color-muted"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('ActiveStaffAccount', $StaffAccount->UniqueCode) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <button class="btn btn-success btn-small text-white">
                                                            Active <i class="fa fa-times color-muted"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('DeactivateStaffAccount', $StaffAccount->UniqueCode) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">                                                        
                                                        <button class="btn btn-danger btn-small">
                                                            Deactivate <i class="fa fa-times color-muted"></i>
                                                        </button>
                                                @endif
                                            </td>
                                            <td>
                                                <span>
                                                    <a href="{{ route('EditStaffAccount', $StaffAccount->UniqueCode) }}" class="mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil color-muted"></i>
                                                    </a>
                                                    <a href="{{ route('StaffProfileDetail', $StaffAccount->UniqueCode) }}" data-toggle="tooltip" data-placement="top" title="Profile" class="mr-2">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>
                                                    <a href="{{ route('DropStaffAccount', $StaffAccount->id) }}" data-toggle="tooltip" data-placement="top" title="Close">
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