$(document).ready(function () {

    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetchStudent();

    function fetchStudent()
    {

        $.ajax({
            type: "GET",
            url: "/student",
            dataType: "json",
            success: function (response) {
                $('tbody').html("");
                $.each(response.student, function(key, item){
                    $('tbody').append('<tr>\
                                <td>'+item.id+'</td>\
                                <td><img src="http://localhost:8000/upload/'+item.image+'" width="110px" height="150px"></td>\
                                <td>'+item.first_name+'</td>\
                                <td>'+item.last_name+'</td>\
                                <td>'+item.course+'</td>\
                                <td>'+item.phone+'</td>\
                                <td><button type="button" value="'+item.id+'"class="edit_student_btn btn btn-success btn-sm">Edit</button></td>\
                                <td><button type="button" value="'+item.id+'"class="delete_btn btn btn-danger btn-sm">Delete</button></td>\
                            </tr>');
                });
            }
        });
    }

    //Add Jquery

    $(document).on('submit', '#add_student_form', function (e) {
        e.preventDefault();
        
        let formData = new FormData($('#add_student_form')[0]);

        $.ajax({
            type: "POST",
            url: "/student",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 400) {
                    $('#save_errorList').html("");
                    $('#save_errorList').removeClass('d-none');
                    $.each(response.errors, function (key, err_value) {
                        $('#save_errorList').append('<li>' + err_value + '</li>');
                    });
                } else if (response.status == 200) {
                    $('#save_errorList').html("");
                    $('#save_errorList').addClass('d-none');
                    document.getElementById("add_student_form").reset();
                    $('#addStudentModal').modal('hide');
                    $('.modal-backdrop').remove();
                    // alert(response.message);
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(response.message);

                    fetchStudent();
                    
                }
            }
        });
    });
    //End Add jquery

    //Edit Jquery

$(document).on('click', '.edit_student_btn', function (e) {
    e.preventDefault();

         var student_id = $(this).val();
        $('#editStudentModal').modal('show');




        $.ajax({
        type: "GET",
        url: "/student/" + student_id,
        success: function (response) {

            
            if (response.status == 404) 
            {

                // alert(response.message);
                alertify.set('notifier','position', 'top-right');
                alertify.success(response.message);
                $('#editStudentModal').modal('hide');

            } else 
            {
                $('#edit_fname').val(response.student.first_name);
                $('#edit_lname').val(response.student.last_name);
                $('#edit_course').val(response.student.course);
                $('#edit_phone').val(response.student.phone);
                $('#student_id').val(student_id);
            }
            }
            });
        
  });

        //End Edit Jquery

        //Update Jquery
    $(document).on('submit', '#update_student_form', function (e) {
        e.preventDefault();
    
        var id = $('#student_id').val();
        let EditformData = new FormData($('#update_student_form')[0]); // Corrected the constructor name
    
        $.ajax({
            type: "POST",
            url: "/update-student/" + id,
            data: EditformData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 400) {
                    $('#update_errorList').html("");
                    $('#update_errorList').removeClass('d-none');
    
                    $.each(response.errors, function (key, error) {
                        $('#update_errorList').append('<li>' + error + '</li>');
                    });
                } else if (response.status == 400) {
                    // alert(response.message);
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(response.message);
                } else if (response.status == 200) {
                    $('#update_errorList').html("");
                    $('#update_errorList').addClass('d-none');
                    debugger;
                    $('#editStudentModal').modal('hide');
                    // alert(response.message);
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(response.message);
                    fetchStudent();
                }
            }
        });
    });

    //End Update Jquery

        //Delete Jquery

        $(document).ready(function () {
            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
        
                var $student_id = $(this).val();
                $('#deleteStudentModal').modal('show');
                $('#deleting_student_id').val($student_id);
            });
        
            $(document).on('click', '.delete_modal_btn', function (e) {
                e.preventDefault();
        
                var id = $('#deleting_student_id').val();
        
                $.ajax({
                    type: "DELETE",
                    url: "/student/" + id,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 404) {
                            // alert(response.message);
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(response.message);
                            $('#deleteStudentModal').modal('hide');
                        } else if (response.status == 200) {
                            fetchStudent();
                            $('#deleteStudentModal').modal('hide');
                            // alert(response.message);
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(response.message);
                        }
                    }
                });
            });
        });
        
    

        //End Delete Jquey
       
});