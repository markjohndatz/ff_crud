@extends('layouts.master')

@section('content')
  

{{-- add new student modal start --}}
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="add_student_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <ul class="alert alert-warning d-none" id="save_errorList"></ul>
                    <div class="row">
                        <div class="col-lg">
                            <label for="fname">FirstName</label>
                            <input type="text" name="fname" class="form-control" required>
                        </div>
                        <div class="col-lg">
                            <label for="lname">LastName</label>
                            <input type="text" name="lname" class="form-control" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="course">Course</label>
                        <input type="text" name="course" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="image">SelectImage</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_student_btn" class="btn btn-primary">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new student modal end --}}

{{-- edit student modal start --}}
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="update_student_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">

                    <input type="hidden" name="student_id" id="student_id">

                    <ul class="alert alert-warning d-none" id="update_errorList"></ul>
                    <div class="row">
                        <div class="col-lg">
                            <label for="fname">FirstName</label>
                            <input type="text" name="fname" id="edit_fname" class="form-control" required>
                        </div>
                        <div class="col-lg">
                            <label for="lname">LastName</label>
                            <input type="text" name="lname" id="edit_lname"class="form-control" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="course">Course</label>
                        <input type="text" name="course" id="edit_course"class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" id="edit_phone" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="image">SelectImage</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_student_btn" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End edit student modal end --}}

{{-- Delete student modal start --}}

<!-- Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <h4>Are you sure you want to delete?</h4>
                <input type="hidden" id="deleting_student_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="delete_modal_btn btn btn-primary">Delete</button>
            </div>

        </div>
    </div>
</div>

{{-- Delete student modal end --}}


<div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="text-dark">Manage Student</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i
                            class="bi-plus-circle me-2"></i>Add New Student</button>
                </div>
                <div class="card-body">
                    <div class="table-reponsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>Course</th>
                                    <th>Phone</th>
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

@endsection

@section('scripts')

<script src="{{ asset('js/student.js') }}"></script>

@endsection
