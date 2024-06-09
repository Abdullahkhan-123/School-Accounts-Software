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
                        <h4 class="card-title">Expense Category</h4>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">

                            <form method="post" action="{{ route('SaveUtlityExpenseCategory') }}" id="addClassForm">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label class="sr-only">Admit Expense</label>
                                        <input type="text" class="form-control mb-2 admitClass" name="Expensecategory[]"
                                            placeholder="Admit Expense" required>
                                    </div>

                                    <div class="col-12 mt-2 d-flex justify-content-end align-items-end">
                                        <button type="button" class="btn btn-primary mb-2" id="addMoreFields">Add More
                                            Fields</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('addMoreFields').addEventListener('click', function () {
            var form = document.getElementById('addClassForm');
            var input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control mb-2 admitClass';
            input.name = 'Expensecategory[]'; // Corrected name
            input.placeholder = 'Admit Expense';
            form.insertBefore(input, form.lastElementChild.previousElementSibling);
        });
    });
</script>

@endsection
