@extends('layouts.app')

@section('content')
<!-- <div>Hello User</div> -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="d-grid gap-2 d-md-flex justify-content-md-center">
    <!-- "Add Student Button" -->
    <a type="button" onclick="showHideAddStudentForm()" value="off" id="showhidestudentsformbutton" class="btn btn-primary">Add Student</a>
    <!-- "Show Student Table -->
    <a type="button" onclick="showHideStudentTable()" value="off" id="showhidestudenttablebutton" class="btn btn-primary">Show Student Table</a>
</div>
<br>
            
<!-- "Add Student Form" -->
<div class="container-student-form" style="display:none">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Add Student Form</div>
                <div class="card-body">
                    <form method="post" action="{{ url('/storestudent') }}">
                    {{ csrf_field() }}
                        <div class="mb-3">
                            <input type="text" class="form-control" id="nameInput" name="nameInput" placeholder="Enter Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="emailInput" name="emailInput" placeholder="Enter Email (We'll never share your email with anyone else)" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="departmentInput" name="departmentInput" placeholder="Enter Department" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="rollNoInput" name="rollNoInput" placeholder="Enter Roll No." required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="batchYearInput" name="batchYearInput" placeholder="Enter Batch year" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck" required>
                            <label class="form-check-label" for="exampleCheck1">I confirm that the information provided by me is correct and in case of any false inforamtion institute has the right for dismissal of my application.</label>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addStudent()" id="addstudentbutton">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- "Students Table" -->
<div class="container-student-table" style="display:none">
    <div class="card">
        <div class="card-header">Students Table</div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Sr#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Department</th>
                        <th scope="col">Roll#</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody  id="studentTable">
                    @foreach($students as $key => $student)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->department }}</td>
                            <td>{{ $student->roll_no }}</td>
                            <td>{{ $student->batch }}</td>
                            <td>
                                <!-- <a type="button" onclick="updateStudent()" value="off" id="updatestudentbutton" class="btn btn-outline-success btn-sm">Update</a> -->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
                                <a type="button" onclick="deleteStudent()" value="off" id="deletestudentbutton" class="btn btn-outline-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<!-- "Update Student Form"
<div class="container-update-student-form" style="display:none">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Update Student Form</div>
                <div class="card-body">
                    <form method="post" action="{{ url('/storestudent') }}">
                    {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="nameInput" class="form-label"></label>
                            <input type="text" class="form-control" id="nameInput" name="nameInput" placeholder="Enter Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="InputEmail" class="form-label"></label>
                            <input type="email" class="form-control" id="emailInput" name="emailInput" placeholder="Enter Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="departmentInput" class="form-label"></label>
                            <input type="text" class="form-control" id="departmentInput" name="departmentInput" placeholder="Enter Department" required>
                        </div>
                        <div class="mb-3">
                            <label for="rollNoInput" class="form-label"></label>
                            <input type="text" class="form-control" id="rollNoInput" name="rollNoInput" placeholder="Enter Roll No." required>
                        </div>
                        <div class="mb-3">
                            <label for="batchYearInput" class="form-label"></label>
                            <input type="text" class="form-control" id="batchYearInput" name="batchYearInput" placeholder="Enter Batch Year" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="updateStudent()" id="updatestudentbutton">Submit</button>
                            <button type="button" class="btn btn-primary" onclick="cancelStudentFormButton()" id="addstudentbutton">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style='height:70%'>
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Student Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/storestudent') }}">
                {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="nameInput" class="form-label"></label>
                        <input type="text" class="form-control" id="nameInput" name="nameInput" placeholder="Enter Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputEmail" class="form-label"></label>
                        <input type="email" class="form-control" id="emailInput" name="emailInput" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="departmentInput" class="form-label"></label>
                        <input type="text" class="form-control" id="departmentInput" name="departmentInput" placeholder="Enter Department" required>
                    </div>
                    <div class="mb-3">
                        <label for="rollNoInput" class="form-label"></label>
                        <input type="text" class="form-control" id="rollNoInput" name="rollNoInput" placeholder="Enter Roll No." required>
                    </div>
                    <div class="mb-3">
                        <label for="batchYearInput" class="form-label"></label>
                        <input type="text" class="form-control" id="batchYearInput" name="batchYearInput" placeholder="Enter Batch Year" required>
                    </div>
                    <div class="mb-3">
                        <label for="nameInput" class="form-label"></label>
                        <input type="text" class="form-control" id="nameInput" name="nameInput" placeholder="Enter Name">
                        <div id="emailHelp" class="form-text">Above input is not required. This is a sample Input to check modal scroll.</div>
                    </div>
                    <div class="mb-3">
                        <label for="InputEmail" class="form-label"></label>
                        <input type="email" class="form-control" id="emailInput" name="emailInput" placeholder="Enter Email">
                        <div id="emailHelp" class="form-text">Above input is not required. This is a sample Input to check modal scroll.</div>
                    </div>
                    <div class="mb-3">
                        <label for="departmentInput" class="form-label"></label>
                        <input type="text" class="form-control" id="departmentInput" name="departmentInput" placeholder="Enter Department">
                        <div id="emailHelp" class="form-text">Above input is not required. This is a sample Input to check modal scroll.</div>
                    </div>
                    <div class="mb-3">
                        <label for="rollNoInput" class="form-label"></label>
                        <input type="text" class="form-control" id="rollNoInput" name="rollNoInput" placeholder="Enter Roll No.">
                        <div id="emailHelp" class="form-text">Above input is not required. This is a sample Input to check modal scroll.</div>
                    </div>
                    <div class="mb-3">
                        <label for="batchYearInput" class="form-label"></label>
                        <input type="text" class="form-control" id="batchYearInput" name="batchYearInput" placeholder="Enter Batch Year">
                        <div id="emailHelp" class="form-text">Above input is not required. This is a sample Input to check modal scroll.</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateStudent()" id="updatestudentbutton">Save Changes</button>
                <button type="button" class="btn btn-secondary" onclick="cancelStudentFormButton()" id="addstudentbutton" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
  </div>
</div>
@endsection
<!-- AJAX CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    function showHideAddStudentForm(){
        var buttonType = $('#showhidestudentsformbutton').attr('value');
        if( buttonType == 'off'){
            $('.container-student-form').show();
            $('#showhidestudentsformbutton').text('Hide Student Form');
            $('#showhidestudentsformbutton').attr('value','on');
        } else {
            $('.container-student-form').hide();
            $('#showhidestudentsformbutton').text('Show Student Form');
            $('#showhidestudentsformbutton').attr('value','off')
        }   
    }

    function showHideStudentTable(){
        var buttonType = $('#showhidestudenttablebutton').attr('value');
        if( buttonType == 'off'){
            $('.container-student-table').show();
            $('#showhidestudenttablebutton').text('Hide Student Table');
            $('#showhidestudenttablebutton').attr('value','on');
        } else {
            $('.container-student-table').hide();
            $('#showhidestudenttablebutton').text('Show Student Table');
            $('#showhidestudenttablebutton').attr('value','off');
        }
    }

    function addStudent(){
        var nameInput = $('#nameInput').val();
        var emailInput = $('#emailInput').val();
        var departmentInput = $('#departmentInput').val();
        var rollNoInput = $('#rollNoInput').val();
        var batchYearInput = $('#batchYearInput').val();

        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('nameInput', nameInput);
        formData.append('emailInput', emailInput);
        formData.append('departmentInput', departmentInput);
        formData.append('rollNoInput', rollNoInput);
        formData.append('batchYearInput', batchYearInput);

        $.ajax({
            type: 'POST',
            url: '/storestudent',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result){
                debugger
                if(result.status){
                    $('#studentTable').load('loadStudentTable');
                    $('#nameInput').val('');
                    $('#emailInput').val('');
                    $('#departmentInput').val('');
                    $('#rollNoInput').val('');
                    $('#batchYearInput').val('');
                }
            }
        })
    }

    // function updateStudent(){
    //     var updateStudentButtonValue = $('#updatestudentbutton').attr('value');
    //     if (updateStudentButtonValue == 'off'){
    //         $('.container-update-student-form').show();
    //         $('#updatestudentbutton').text('Confirm');
    //         $('#updatestudentbutton').val('off');
    //     } else {
    //         $('.container-update-student-form').hide();
    //         $('#updatestudentbutton').text('Update');
    //         $('#updatestudentbutton').val('on');
    //     }
    // }

    function updateStudent(){
        var updateStudentButtonValue = $('#updatestudentbutton').attr('value');
        if (updateStudentButtonValue == 'off'){
            $('.modal').show();
            $('#updatestudentbutton').text('Confirm');
            $('#updatestudentbutton').val('off');
        } else {
            $('.modal').hide();
            $('#updatestudentbutton').text('Update');
            $('#updatestudentbutton').val('on');
        }
    }
</script>