<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100 mt-5">    
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
                        <h4 class="card-title">Employee Salaries Details</h4>
                        <!-- <h4 class="card-title">
                            <button class="btn btn-primary mb-2"> <a href="{{ route('ManageEmployeeSalary') }}" class="text-decoration-none text-white">Add More</a> </button>
                        </h4> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Academy Name</th>
                                        <th scope="col">Academy Email</th>
                                        <th scope="col">Academy Phone</th>
                                        <th scope="col">Academy Register Date</th>                                            
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @php $LoopID = 1; @endphp

                                @foreach($admin as $AcademyDetail)
                                    <tr>
                                        <td>{{ $LoopID++ }}</td>
                                        <td>{{ $AcademyDetail->Name }}</td>
                                        <td>{{ $AcademyDetail->Email }}</td>
                                        <td>{{ $AcademyDetail->Phone }}</td>
                                        <td>{{ $AcademyDetail->RegisterDate }}</td>
                                        <td>
                                            <a class="btn btn-primary mb-2" href="{{ route('AdminVisitPanel', $AcademyDetail->AcademyCode) }}" data-toggle="tooltip" data-placement="top" title="Profile" class="mr-2">
                                                View Panel
                                            </a>
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

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>