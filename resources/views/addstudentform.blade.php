@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Student Form</div>
                <div class="card-body">
                    <form method="post" action="{{ url('/storestudent') }}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                            <label for="nameInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameInput" name="nameInput">
                        </div>
                        <div class="mb-3">
                            <label for="InputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="emailInput" name="emailInput">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="departmentInput" class="form-label">Department</label>
                            <input type="text" class="form-control" id="departmentInput" name="departmentInput">
                        </div>
                        <div class="mb-3">
                            <label for="rollNoInput" class="form-label">Roll No.</label>
                            <input type="text" class="form-control" id="rollNoInput" name="rollNoInput">
                        </div>
                        <div class="mb-3">
                            <label for="batchYearInput" class="form-label">Batch Year</label>
                            <input type="text" class="form-control" id="batchYearInput" name="batchYearInput">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck">
                            <label class="form-check-label" for="exampleCheck1">I confirm that the information provided by me is correct and in case of any false inforamtion institute has the right for dismissal of my application.</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection