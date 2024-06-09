
<!-- Registration Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0">
                    <div class="card-header bg-secondary text-center p-4">
                        <h1 class="text-white m-0">Create Password</h1>                        
                    </div>

                    @if(Session::has('status'))
                        <div class="alert alert-danger mb-0 text-center" role="alert">
                            {{ Session::get('status') }}
                        </div>
                    @elseif(Session::has('Success_status'))
                        <div class="alert alert-success mb-0 text-center" role="alert">
                            {{ Session::get('Success_status') }}
                        </div>
                    @endif

                    <div class="card-body rounded-bottom bg-primary p-5">
                        <!-- Admin form -->
                        <form method="post" action="{{ route('SaveStaffCreatePassword', ['id' => $StaffAccount->UniqueCode]) }}" enctype="multipart/form-data">
                            @csrf
                            <div id="adminForm">
                                <!-- Admin form fields -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">                                            
                                            <input type="password" class="form-control border-0 p-4" name="CreatePassword" placeholder="Create Password" required="required" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="password" class="form-control border-0 p-4" name="ConfirmPassword" placeholder="Confirm Password" required="required" />
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-secondary btn-block border-0 py-3" type="submit">Create</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

