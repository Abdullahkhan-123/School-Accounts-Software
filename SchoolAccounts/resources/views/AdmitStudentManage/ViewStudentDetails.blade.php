@extends('master')
@section('content')

  <!--**********************************
            Content body start
        ***********************************-->        
        <div class="container-fluid">
            <div class="content-body">
        
                <!-- Profile Image section -->
                <div class="col-lg-12">
                    <div class="profile">
                        <div class="profile-head">
                            <div class="photo-content">
                                <div class="cover-photo"></div>
                                <div class="profile-photo">
                                    <img src="{{ asset('uploads/student_images/' . $StudentData->SImage) }}" class="img-fluid rounded-circle" alt="">
                                </div>
                            </div>
                            <div class="profile-info">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8">
                                        <div class="row">
                                            <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                                <div class="profile-name">
                                                    <h4 class="text-primary">{{ $StudentData->SName }}</h4>
                                                    <p>{{ 'Class ' . $StudentData->ClassName }}</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                                <div class="profile-email">
                                                    <h4 class="text-muted">{{ $StudentData->FEmail }}</h4>
                                                    <p>Email</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-4 prf-col">
                                                <div class="profile-call">
                                                    <h4 class="text-muted">{{ $StudentData->FPhone }}</h4>
                                                    <p>Phone No.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- student details section -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">                                
                                        <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active">Student Details</a></li>
                                        <li class="nav-item"><a href="#FeesHistory" data-toggle="tab" class="nav-link">Fees History</a></li>
                                    </ul>
                                    <div class="tab-content">                                    
                                        <div id="about-me" class="tab-pane fade active show">                                    
                                                                            
                                            <div class="row">

                                                <div class="col">
                                                    <div class="profile-personal-info pt-5">
                                                        <h4 class="text-primary mb-4">Student Personal Information</h4>
                                                        
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Student Code <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StudentData->UniqueCode }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Gender <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StudentData->SGender }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StudentData->SDOB }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Monthly Fee <span class="pull-right">:</span></h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StudentData->FeeCategory_Title. ' - ' . 'Class '. $StudentData->FeeCategory_Class. ' - ' . ' Fee Amount ' .$StudentData->FeeCategory_Amount }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-4">
                                                                <h5 class="f-w-500">Admission Date <span class="pull-right">:</span></h5>
                                                            </div>
                                                            <div class="col-8"><span>{{ $StudentData->AdmissionDate }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-4">
                                                                <h5 class="f-w-500">Is Discounted Student <span class="pull-right">:</span></h5>
                                                            </div>
                                                            <div class="col-8"><span>{{ $StudentData->IsDiscountedStudent }}</span>
                                                            </div>
                                                        </div>                                                        

                                                    </div>    
                                                </div>

                                                <div class="col">
                                                    <div class="profile-personal-info pt-5">
                                                        <h4 class="text-primary mb-4">Parent Information</h4>

                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Father Name <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StudentData->FName }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Father's ID Card <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StudentData->FCard }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Mother's Phone <span class="pull-right">:</span></h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StudentData->MPhone }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Religion <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StudentData->Religion }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-3">
                                                                <h5 class="f-w-500">Home Address <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-9"><span>{{ $StudentData->HomeAddress }}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            
                                        </div>

                                        <div id="FeesHistory" class="tab-pane fade">                                                                        
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Roll #</th>
                                                                <th scope="col">Student Name</th>
                                                                <th scope="col">Father Name</th>
                                                                <th class="col-3" scope="col">Fee Title</th>
                                                                <th scope="col">Total</th>
                                                                <th class="col-1" scope="col">Late Fees</th>
                                                                <th class="col-1" scope="col">Paid</th>
                                                                <th class="col-1" scope="col">Due</th>
                                                                <th class="col-1" scope="col">Pay Method</th>
                                                                <th scope="col">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $No = 1; @endphp
                                                            @foreach($PaymentRecords as $Records)
                                                                @if($Records->PaidStatus == 1 || $Records->PaidStatus == 2)
                                                                    <tr>
                                                                        <td>{{ $No++ }}</td>
                                                                        <td><span class="badge badge-success">{{ $StudentData->UniqueCode }}</span></td>
                                                                        <td>{{ $StudentData->SName }}</td>
                                                                        <td>{{ $StudentData->FName }}</td>
                                                                        <td>{{ $Records->FeesTitle. ' Of ' .$Records->FeeMonthName . ' ' . $Records->Year }}</td>
                                                                        <td>{{ $Records->AmtPaid }}</td>
                                                                        <td>
                                                                            @if($Records->IsLate == 0)
                                                                                0
                                                                            @else
                                                                                <div style="background-color: #FF1616 !important; width: 15px; height: 15px; border-radius: 50%;"></div>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $Records->Paid }}</td>
                                                                        <td>{{ $Records->Balance }}</td>
                                                                        <td>{{ $Records->PaymentMethod }}</td>
                                                                        <td>
                                                                            @if($Records->PaidStatus == 0)
                                                                                <button class="btn btn-danger">UnPaid</button>
                                                                            @elseif($Records->PaidStatus == 2)
                                                                                <button class="btn btn-warning">PartialPaid</button>
                                                                            @else
                                                                                <button class="btn btn-success">Paid</button>
                                                                            @endif
                                                                        </td>                                                                        
                                                                    </tr>
                                                                @endif
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
                    </div>
                </div>

            </div>
        </div>


@endsection