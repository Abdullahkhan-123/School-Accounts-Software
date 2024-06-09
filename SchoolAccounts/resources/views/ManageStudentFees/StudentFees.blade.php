@extends('master')
@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row">

                <!-- First Row -->
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
                
                    <div class="card p-2">
                        
                        <div class="row d-flex justify-content-center">

                            <div class="col-lg-3">
                                <label>Select Class:</label>
                                    <select class="form-control" name="Class" id="sel1">
                                        <option value="" selected disabled>Select</option>

                                        @foreach($AllClasses as $class)
                                            <option value="{{ $class->id }}">{{ 'Class '. $class->Class }}</option>
                                        @endforeach
                                        
                                    </select>
                            </div>


                            <div class="col-lg-1 mt-4">
                                <button class="btn btn-primary mb-1 mt-1" id="fetchData"> Search </button>
                            </div>

                        </div>                            
                        
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student Information</h4>
                            <h4 class="card-title">

                                <div class="row d-flex">
                                
                                    <!-- export as print -->
                                    <form method="post" action="">
                                        @csrf
                                        <input type="hidden" name="Classprint" id="Classprint">
                                        <input type="hidden" name="Sectionprint" id="Sectionprint">
                                        <input type="hidden" name="Typeprint" id="Typeprint">
                                        <input type="hidden" name="Campusprint" id="Campusprint">
                                        <button class="btn btn-primary mb-2 mr-1" type="submit">Print</button>
                                    </form>

                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                        
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-responsive-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Reference #</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">Student Gender</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Admission Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Button click event listener
            $('#fetchData').click(function() {
                // Obtain values from form fields
                const classId = $('#sel1').val(); // Class select field se value obtain karna
                const sectionId = $('#sel2').val(); // Section select field se value obtain karna
                const type = $('#sel3').val(); // Type select field se value obtain karna
                const campus = $('#sel4').val(); // Campus select field se value obtain karna

                // Set hidden input values to export csv
                $('#Class').val(classId);
                $('#Section').val(sectionId);
                $('#Type').val(type);
                $('#Campus').val(campus);

                // Set hidden input values to export pdf 
                $('#Classpdf').val(classId);
                $('#Sectionpdf').val(sectionId);
                $('#Typepdf').val(type);
                $('#Campuspdf').val(campus);

                // Set hidden input values to export print 
                $('#Classprint').val(classId);
                $('#Sectionprint').val(sectionId);
                $('#Typeprint').val(type);
                $('#Campusprint').val(campus);

                // AJAX request
                $.ajax({
                    url: '/SearchStudentInformation', // Server-side route URL
                    method: 'GET',
                    data: {
                        classId: classId,
                        sectionId: sectionId,
                        type: type,
                        campus: campus
                    },
                    success: function(data) {
                        // Clear the existing table body
                        $('table tbody').empty();

                        // Populate the table with new data
                        data.forEach(function(item, index) {
                            $('table tbody').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td> <span class="badge badge-success"> ${item.UniqueCode} </span> </td>
                                    <td>${item.SName}</td>
                                    <td>${item.FName}</td>
                                    <td>${item.SGender}</td>
                                    <td>${item.ClassName}</td>
                                    <td>${item.AdmissionDate}</td>
                                    <td>

                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Manage Fees</button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 34px, 0px);">
                                                    
                                                    <a class="dropdown-item" href="{{ url('/Student_All_Payments') }}/${item.UniqueCode}" data-toggle="tooltip" data-placement="top" title="Payments" class="mr-2">
                                                        All Payments
                                                    </a>

                                                    <a class="dropdown-item" href="{{ url('/StudentDetails') }}/${item.UniqueCode}" data-toggle="tooltip" data-placement="top" title="Profile" class="mr-2">
                                                        View Profile
                                                    </a>

                                                </div>
                                        </div>

                                    </td>
                                </tr>
                            `);
                        });
                    }
                });
            });
        });
    </script>

@endsection
