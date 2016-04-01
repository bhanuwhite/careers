$(document).ready(function () {
   
   $('#add_new_course').click(function(){
        $('#AddCourseModal').modal('show');
   });
   $('#add_course_form').validate({
        rules: {
            course_name: {
                required: true,
            }
        },
        messages: {
            course_name: {
                required: "Course Name is required.",
            }
        },
        onkeyup: false,
        submitHandler: function (form) {
            var course_name = $("#course_name").val();
            var sub_course_of = $("#sub_course_of").val();

            $.post(APP_URL + 'login/addNewCourse', {
                course_name: course_name,
                sub_course_of: sub_course_of
            },
                    function (response) {
                        $('#error_course').empty();
                        console.log(response)
                        if(response.status == 200){
                             $('#error_course').text(response.message);
                             $('input').empty();
                             location.reload();
                        }
                        else{
                            $('#error_course').text(response.message);
                        }
                    },'json');
                }
            });

    $('body').on('click', '.btn-document-new-modals', function(){

        var Student_id = $(this).closest('tr').find("td:eq(1)").text();
        $(".btn-document-new-modals").data("id");
        
        $.post('get_seeker_details', {
            Student_id: Student_id
        },
        
        function (response)
        {
            if (response.status == 200) {
                var obj = response.users_data
                //trHTML = response.details[0].document_name;
                $('#viewModal').modal('show');
                var content = '';

                content += '<tr><td>UserId</td> <td>' + obj[0]['userId'] + '</td></tr>\n\
                                    <tr><td>Full Name</td> <td>' + obj[0]['name'] + '</td></tr>\n\
                                    <tr><td>Contact No.</td>  <td>' + obj[0]['mobile'] + '</td></tr>\n\
                                    <tr><td>Age</td> <td>' + obj[0]['age'] + ' </td></tr>\n\
                                    <tr><td>Email</td> <td>' + obj[0]['email'] + ' </td></tr>\n\
                                    <tr><td>Address</td>  <td>' + obj[0]['address'] + '</td></tr>\n\
                                    <tr><td>Current Location</td>  <td>' + obj[0]['curr_location'] + '</td></tr>\n\
                                    <tr><td>Qualification</td>  <td>' + obj[0]['degree'] + '</td></tr>\n\
                                    <tr><td>Skils</td>  <td>' + obj[0]['skills'] + '</td></tr>\n\
                                    <tr><td>Certified Courses</td>  <td>' + obj[0]['c_courses'] + '</td></tr>\n\
                                    <tr><td>Undergone Training</td>  <td>' + obj[0]['t_courses'] + '</td></tr>\n\
                                    <tr><td>Experience</td>  <td>' + obj[0]['experience'] + '</td></tr>\n\
                                    <tr><td>Company Name</td>  <td>' + obj[0]['company_name'] + '</td></tr>\n\
                                    <tr><td>Job Title</td><td>' + obj[0]['job_title'] + '</td></tr>\n\
                                    <tr><td>No. of years working</td>  <td>' + obj[0]['years_in_curr_job'] + '</td></tr>\n\
                                    <tr><td>Present Salary</td>  <td>' + obj[0]['pres_salary'] + '</td></tr>\n\
                                    <tr><td>Expected Salary</td>  <td>' + obj[0]['expec_salary'] + '</td></tr>\n\
                                    <tr><td>Job Status</td>  <td>' + obj[0]['Job_status'] + '</td></tr>\n\\n\
                                    <tr><td>Job Status</td>  <td>' + obj[0]['new_company_name'] + '</td></tr>\n\
                                    <tr><td>Status</td>  <td>' + obj[0]['status'] + '</td></tr>';
                $('#student-detail tbody').html(content);
            }
            else if (response.status == 201) {
                $('#viewModal').modal('show');
                $('#student-detail tbody').text('Currently no data.');
//$('#msg').text('Database Error !').css({"color": "#228B22", "font-weight": "bold"});
            }
            else {
                $('#viewModal').modal('show');
                $('#student-detail tbody').text('Bad server response');
            }
        }, 'json');
    });


    $('body').on('click','.btn-update-modals', function () {
        var Student_id = $(this).closest('tr').find("td:eq(2)").text();
        var name = $(this).closest('tr').find("td:eq(3)").text();
        var mobile = $(this).closest('tr').find("td:eq(4)").text();
        var age = $(this).closest('tr').find("td:eq(5)").text();
        var email = $(this).closest('tr').find("td:eq(6)").text();
        var degree = $(this).closest('tr').find("td:eq(7)").text();
        var address = $(this).closest('tr').find("td:eq(8)").text();
        var curr_location = $(this).closest('tr').find("td:eq(9)").text();
        var c_courses = $(this).closest('tr').find("td:eq(10)").text();
        var t_courses = $(this).closest('tr').find("td:eq(11)").text();
        var experience = $(this).closest('tr').find("td:eq(12)").text();
        var company_name = $(this).closest('tr').find("td:eq(13)").text();
        var job_title = $(this).closest('tr').find("td:eq(14)").text();
        var years_in_curr_job = $(this).closest('tr').find("td:eq(15)").text();
        var pres_salary = $(this).closest('tr').find("td:eq(16)").text();
        var expec_salary = $(this).closest('tr').find("td:eq(17)").text();
        var skills = $(this).closest('tr').find("td:eq(18)").text();
        var job_status = $(this).closest('tr').find("td:eq(21)").text();
        var new_company = $(this).closest('tr').find("td:eq(22)").text();
        var status = $(this).closest('tr').find("td:eq(24)").text();
        
        $('#EditModal').modal('show');                                                                 

        $('#edit_userid').val(Student_id);
        $('#edit_name').val(name);
        $('#edit_contact').val(mobile);
        $('#edit_age').val(age);
        $('#edit_email').val(email);
        $('#edit_qualification').val(degree);
        $('#edit_address').val(address);
        $('#edit_curre_locat').val(curr_location);
        $('#edit_certify_course').val(c_courses);
        $('#edit_training_course').val(t_courses);
        $('#edit_exp').val(experience);
        $('#edit_company').val(company_name);
        $('#edit_title').val(job_title);
        $('#edit_years_exp').val(years_in_curr_job);
        $('#edit_present_sal').val(pres_salary);
        $('#edit_expect_sal').val(expec_salary);
        $('#edit_skils').val(skills);
//       $('#status').val(status);
       $('#edit_new_company').val(new_company);
        $("#status option[value='" + status + "']").prop("selected", true);
        $("#job_status option[value='" + job_status + "']").prop("selected", true);

    });

    $('body').on('click','.btn-delete-modals',function () {
        var student = $(this).closest('tr').find("td:eq(1)").text();
        var abc = confirm("You want to delete this record");
        if (abc) {
            $.post('remove_seeker_details', {
                Student_id: student
            },
            function (response)
            {
                $('#error_msg').empty();
                if (response.status == 200)
                {
                    location.href = "welcome";
                    console.log(response)
                    $('#error_msg').text(response.message);
                }
                else
                {
                    //location.href = "welcome";  
                    console.log(response)
                    $('#error_msg').text(response.message);
                }
            }, 'json');
        }
        else {
            console.log(abc)
        }
    });
    
    $('#update_data').click(function(){
       var edit_Student_id = $('#edit_userid').val();
       var edit_name = $('#edit_name').val();
       var edit_mobile = $('#edit_contact').val();
       var edit_age = $('#edit_age').val();
       var edit_email =  $('#edit_email').val();
       var edit_degree = $('#edit_qualification').val();
       var edit_address = $('#edit_address').val();
       var edit_curr_location = $('#edit_curre_locat').val();
       var edit_c_courses = $('#edit_certify_course').val();
       var edit_t_courses = $('#edit_training_course').val();
       var edit_experience = $('#edit_exp').val();
       var edit_company_name = $('#edit_company').val();
       var edit_job_title = $('#edit_title').val();
       var edit_years_in_job = $('#edit_years_exp').val();
       var edit_pres_salary =  $('#edit_present_sal').val();
       var edit_expec_salary = $('#edit_expect_sal').val();
       var edit_skills = $('#edit_skils').val();
       var edit_status = $('#status').val();
       var edit_job_status = $('#job_status').val();
       var edit_new_company = $('#edit_new_company').val();
       console.log(edit_new_company)
        $.post('update_seeker_details', {
                edit_Student_id: edit_Student_id,
                edit_name:edit_name,
                edit_mobile:edit_mobile,
                edit_age:edit_age,
                edit_email:edit_email,
                edit_degree:edit_degree,
                edit_address:edit_address,
                edit_curr_location:edit_curr_location,
                edit_c_courses:edit_c_courses,
                edit_t_courses:edit_t_courses,
                edit_experience:edit_experience,
                edit_company_name:edit_company_name,
                edit_job_title:edit_job_title,
                edit_years_in_job:edit_years_in_job,
                edit_pres_salary:edit_pres_salary,
                edit_expec_salary:edit_expec_salary,
                edit_skills:edit_skills,
                edit_status:edit_status,
                edit_job_status:edit_job_status,
                edit_new_company:edit_new_company
            },
            function (response)
            {
                $('#error_msg').empty();
                if(response.status == 200)
                {
                    location.href = "welcome";
                    $('#error_msg').text(response.message);
                }
                else{
                    $('#error_msg').text(response.message); 
                }
             }, 'json');
    });
    
    
    
});


