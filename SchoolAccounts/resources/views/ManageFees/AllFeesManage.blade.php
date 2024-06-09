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
                            <h4 class="card-title">Fees Manage Details</h4>
                            <h4 class="card-title">

                                <button class="btn btn-primary mb-2"> <a href="{{ route('ManageFees') }}" class="text-decoration-none text-white">Add More</a> </button>

                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php $LoopID = 1; @endphp

                                        @foreach($FeesCategory as $FeesCategory)

                                        <tr>
                                            <td>{{ $LoopID++ }}</td>
                                            
                                            <td>{{ $FeesCategory->Title }}</td>
                                            <td>{{ $FeesCategory->PaymentType }}</td>
                                            <td><span class="badge badge-success">{{ 'Class '. $FeesCategory->ClassName }}</span></td>
                                            <td>{{ $FeesCategory->Amount }}</td>
                                            <td>{{ $FeesCategory->Date }}</td>
                                            <td>{{ Str::words($FeesCategory->Description, 5, '') }}</td>
                                            <td>
                                                <span>
                                                    <a href="{{ route('EditFeesCategory', $FeesCategory->UniqueCode) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil color-muted"></i> 
                                                    </a>
                                                    <a href="{{ route('DropFeesCategory', $FeesCategory->UniqueCode) }}" data-toggle="tooltip" data-placement="top" title="Close">
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