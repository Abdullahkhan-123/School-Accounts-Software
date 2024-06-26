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
                        <h4 class="card-title">Fees Manage</h4>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">

                            <form method="post" action="{{ route('SaveFeesCategory') }}">
                                @csrf

                                    <div class="row">
                                        <div class="col">
                                            <label>Title</label>
                                            <input type="text" class="form-control mb-2" name="Title"
                                                placeholder="Title" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label>Class:</label>
                                            <select class="form-control" name="Class" id="sel1" required>
                                                <option value="" selected disabled>Select</option>
                                                @foreach($SClass as $SClass)
                                                    <option value="{{ $SClass->id }}">{{ 'Class ' . $SClass->Class }}</option>
                                                @endforeach                                            
                                            </select>
                                        </div>                                    
                                
                                        <div class="col">
                                            <label>Payment Type:</label>
                                            <select class="form-control" name="PaymentType" id="sel1" required>
                                                <option value="" selected disabled>Select</option>      
                                                <option value="Cash">Cash</option>
                                                <option value="Online">Online</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <label>Amount</label>
                                            <input type="text" class="form-control mb-2" name="Amount"
                                                placeholder="Amount" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label>Description</label>
                                            <textarea class="form-control" name="Description"></textarea>
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
