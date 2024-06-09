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
                        <h4 class="card-title">Generate Fees</h4>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">

                            <form method="post" action="{{ route('MakePayment') }}">
                                @csrf
                                <div class="row">                                
                                    <div class="col">
                                        <label>Class:</label>
                                        <select class="form-control" name="Class" id="sel1" required>
                                            <option value="" selected disabled>Select</option>
                                            <option value="AllClasses">All Classes</option>
                                            @foreach($SClass as $SClass)
                                                <option value="{{ $SClass->id }}">{{ 'Class '. $SClass->Class}}</option>
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Fees Category:</label>
                                        <select class="form-control" name="FeesCategory" id="sel1" required>
                                            <option value="" selected disabled>Select</option>
                                            @foreach($FeesCategory as $FeesCategory)
                                                <option value="{{ $FeesCategory->id }}">{{ $FeesCategory->Title}}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>                                
                                </div>

                                    <div class="row">

                                    
                                    <div class="col-12 mt-2 d-flex justify-content-end align-items-end">                                    
                                        <button type="submit" class="btn btn-primary mb-2 ml-2">Save</button>
                                    </div>
                                    
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
