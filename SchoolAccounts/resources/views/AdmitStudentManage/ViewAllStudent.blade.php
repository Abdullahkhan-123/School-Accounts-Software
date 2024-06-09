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
                            <h4 class="card-title">Student Manage</h4>
                            <h4 class="card-title">

                                <button class="btn btn-primary mb-2"> <a href="{{ route('AdmitStudent') }}" class="text-decoration-none text-white">Add More</a> </button>

                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Student Code</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">Student Gender</th>
                                            <th scope="col">Class</th>                                            
                                            <th scope="col">Admission Date</th>                                            
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php $LoopID = 1; @endphp

                                        @foreach($AllStudent as $AllStudent)

                                        <tr>
                                            <td>{{ $LoopID++ }}</td>
                                            <td>
                                                <span class="badge badge-success">
                                                    {{ $AllStudent->UniqueCode }}
                                                </span>
                                            </td>                                        
                                            <td>{{ $AllStudent->SName }}</td>
                                            <td>{{ $AllStudent->FName }}</td>
                                            <td>{{ $AllStudent->SGender }}</td>
                                            <td>{{ $AllStudent->ClassName }}</td>                                    
                                            <td>{{ $AllStudent->AdmissionDate }}</td>                                        
                                            
                                            <td>
                                                <span>
                                                    <a href="{{ route('EditStudent', $AllStudent->UniqueCode) }}" class="mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil color-muted"></i> 
                                                    </a>

                                                    <a href="{{ route('StudentDetails', $AllStudent->UniqueCode) }}" data-toggle="tooltip" data-placement="top" title="Profile" class="mr-2">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>

                                                    <a href="{{ route('DropStudent', $AllStudent->UniqueCode) }}" data-toggle="tooltip" data-placement="top" title="Close">
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