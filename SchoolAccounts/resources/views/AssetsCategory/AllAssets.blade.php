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
                            <h4 class="card-title">All Assets List</h4>
                            <h4 class="card-title">
                                <button class="btn btn-primary mb-2"> <a href="{{ route('AssetsCategory') }}" class="text-decoration-none text-white">Add More</a> </button>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Head Of Expense</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php $LoopID = 1; @endphp

                                        @foreach($AssetsCategory as $CategoryName)

                                        <tr>
                                            <td>{{ $LoopID++ }}</td>
                                            
                                            <td>{{ $CategoryName->CategoryName }}</td>                                        
                                            <td>
                                                <span>
                                                    <a href="{{ route('EditAssetsCategories', $CategoryName->UniqueCode) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil color-muted"></i> 
                                                    </a>
                                                    <a href="{{ route('DropAssetsCategories', $CategoryName->id) }}" data-toggle="tooltip" data-placement="top" title="Close">
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