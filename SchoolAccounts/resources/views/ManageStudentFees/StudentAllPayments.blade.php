@extends('master')
@section('content')

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">

        <div class="row">                    
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#FeesManage" data-toggle="tab" class="nav-link active show">Fees Manage</a></li>
                                    <li class="nav-item"><a href="#FeesHistory" data-toggle="tab" class="nav-link">Fees History</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="FeesManage" class="tab-pane fade active show">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th class="col-1" scope="col">Roll #</th>
                                                            <th class="col-1" scope="col">Student Name</th>
                                                            <th class="col-1" scope="col">Father Name</th>
                                                            <th class="col-2" scope="col">Fee Title</th>
                                                            <th scope="col">Total</th>
                                                            <th class="col-1" scope="col">Late Fees</th>
                                                            <th class="col-1" scope="col">Paid</th>
                                                            <th class="col-1" scope="col">Due</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $No = 1; @endphp
                                                        @foreach($PaymentRecords as $Records)
                                                            <tr>
                                                                <td>{{ $No++ }}</td>
                                                                <td><span class="badge badge-success">{{ $students->UniqueCode }}</span></td>
                                                                <td>{{ $students->SName }}</td>
                                                                <td>{{ $students->FName }}</td>
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
                                                                <td>
                                                                    @if($Records->PaidStatus == 0)
                                                                        <button class="btn btn-danger">UnPaid</button>
                                                                    @elseif($Records->PaidStatus == 2)
                                                                        <button class="btn btn-warning">PartialPaid</button>
                                                                    @else
                                                                        <button class="btn btn-success">Paid</button>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Fee Options</button>
                                                                        <div class="dropdown-menu" x-placement="bottom-start">
                                                                            @if($Records->PaidStatus == 1)
                                                                                <a class="dropdown-item" href="javascript:void()" class="mr-2" id="no-drop">Quick Payment</a>
                                                                                <a class="dropdown-item" href="javascript:void()" class="mr-2" id="no-drop">Partial Payment</a>
                                                                            @elseif($Records->PaidStatus == 2)
                                                                                <a class="dropdown-item" href="javascript:void()" class="mr-2" id="no-drop">Quick Payment</a>
                                                                                <a class="dropdown-item" href="javascript:void()" data-placement="top" title="Partial Payments" data-toggle="modal" data-target="#PartialModal{{ $Records->UniqueCode }}">Partial Payment</a>
                                                                            @else
                                                                                <a class="dropdown-item" href="javascript:void()" data-placement="top" title="Quick Payments" data-toggle="modal" data-target="#modal{{ $Records->UniqueCode }}" class="mr-2">Quick Payment</a>
                                                                                <a class="dropdown-item" href="javascript:void()" data-placement="top" title="Partial Payments" data-toggle="modal" data-target="#PartialModal{{ $Records->UniqueCode }}">Partial Payment</a>
                                                                            @endif                                                                            
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
                                                                    <td><span class="badge badge-success">{{ $students->UniqueCode }}</span></td>
                                                                    <td>{{ $students->SName }}</td>
                                                                    <td>{{ $students->FName }}</td>
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
</div>
<!--**********************************
    Content body end
***********************************-->

@include('ManageStudentFees.FeeReceviedDetailModal')
@endsection
