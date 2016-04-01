<style>
    .not-active {
 pointer-events: none;
 cursor: default;
}
</style>
<div class="row" id="container_div">
    <br/>
    <div class="col-lg-12">

        <div class="col-lg-12">

            <div class="col-lg-3">
                <select id="t_courses"	name="t_courses" class="selectpicker">
                    <option value="">Undergone Training Courses</option>
                    <?php
                    $role_id = $this->session->userdata('role_id');
                    if ($role_id == -1) {
                        foreach ($course_list as $key => $list) {
                            if ($list->parent_list == 0) {
                                if ($list->has_child == 1) {
                                    echo '<optgroup label="' . $list->course_name . '">';
                                    foreach ($course_list as $child) {
                                        if ($list->course_id == $child->parent_list) {
                                            echo '<o <th width="5%">New Company</th>ption value="' . $child->course_id . '">' . $child->course_name . '</option>';
                                        }
                                    }
                                    echo '</optgroup>';
                                } else {
                                    echo '<option value="' . $list->course_name . '">' . $list->course_name . '</option>';
                                }
                            }
                        }
                    } else {
                        foreach ($course_list as $key => $list) {
                            if ($list->parent_list == 0) {
                                echo '<option value="' . $list->course_name . '">' . $list->course_name . '</option>';
                            }
                        }
                    }
                    ?>
                </select>

            </div>
            <div class="col-lg-3">
                <select id="degree" name="degree" class="selectpicker">
                    <option value="">Qualification</option>
                    <option value="Engineering Graduate">Engineering Graduate</option>
                    <option value="Post Graduate">Post Graduate</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Any other">Any other</option>

                </select>		
            </div>
            <div class="col-lg-3">
                <select id="c_courses"	name="c_courses" class="selectpicker">
                    <option value="">Certified Courses</option>
                    <?php
                    foreach ($course_list as $key => $list) {
                            if ($list->parent_list == 0) {
                                if ($list->has_child == 1) {
                                    echo '<optgroup label="' . $list->course_name . '">';
                                    foreach ($course_list as $child) {
                                        if ($list->course_id == $child->parent_list) {
                                            echo '<option value="' . $child->course_id . '">' . $child->course_name . '</option>';
                                        }
                                    }
                                    echo '</optgroup>';
                                } else {
                                    echo '<option value="' . $list->course_name . '">' . $list->course_name . '</option>';
                                }
                            }
                        }
                    ?>
                </select>
            </div>

        </div>
        <div class="col-lg-12">
            <div class="col-lg-3">
                <select id="expec_salary" name="expec_salary" class="selectpicker">
                    <option value="">Expect Salary</option>
                    <option value="1 to 2 Lakhs">1 to 2 Lakhs</option>
                    <option value="2 to 4 lakhs">2 to 4 lakhs</option>
                    <option value="4 to 6 Lakhs">4 to 6 Lakhs</option>
                    <option value="6 to 8 Lakhs">6 to 8 Lakhs </option>
                    <option value="8 to 10 Lakhs">8 to 10 Lakhs</option>
                </select>
            </div>
            <div class="col-lg-3">
                <select id="experience"	name="experience" class="selectpicker">
                    <option value="">Select Experience</option>
                    <option value="0">Fresher</option>
                    <option value="0-1 Yr">0-1 Yr</option>
                    <option value="1-3 Yrs">1-3 Yrs</option>
                    <option value="3-5 Yrs">3-5 Yrs</option>
                    <option value="5 to 7 yrs">5 to 7 yrs </option>
                    <option value="7 to 10 yrs">7 to 10 yrs</option>
                    <option value="Above 10 yrs">Above 10 yrs</option>
                </select>
            </div>
            <div class="col-lg-3">
                <select id="a_experience" name="a_experience" class="selectpicker">
                    <option value="">Select Fresher/Experience</option>
                    <option value="0">Fresher</option>
                    <option value="1">Experience</option>
                    <option value="both">Both</option>
                </select>
            </div>

        </div>
        <div class="col-lg-12">
            <div class="col-lg-3">
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-lg-3">
                <input type="text" id="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="col-lg-3">
                <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact">
            </div>
            <div class="col-lg-3">
                <button type="button" id="search_jobseekers" class="btn btn-default btn-success">Search</button>
            </div>
        </div>
        <div class="col-lg-7" style="padding: 10px;">
            <button type="button" id="send_mails" class="btn btn-default btn-primary">Send To Employer</button>
            <button type="button" id="send_mails_to_jobseeker" class="btn btn-default btn-primary">Send to Candidate</button>
            
        </div>

    </div>
    <div id="error_msg"></div>
    <div id="table_body_box" class="table-responsive col-lg-12">
        <table class="table table-hover dataTables-example" id="table_box"  >
            <thead>
                <tr>
                    <th width="5%"><input type="checkbox" id="checkAll" /></th>
                    <th width="5%">Serial No</th>
                    <th width="5%" style="display:none">Userid</th>
                    <th width="5%">Full Name</th>
                    <th width="5%">Contact</th>
                    <th width="5%" style="display:none">Age</th>
                    <th width="5%">Email</th>
                    <th width="5%" style="display:none">Qualification</th>
                    <th width="5%" style="display:none">Current Location</th>
                    <th width="5%" style="display:none">Address</th>
                    <th width="2%">Certified Courses</th>
                    <th width="2%">Undergone Training</th>
                    <th width="5%">Fresher/ Experience</th>
                    <th width="5%" style="display:none">Company Name</th>
                    <th width="5%" style="display:none">Job Title</th>
                    <th width="5%" style="display:none">No. of years working</th>
                    <th width="5%" style="display:none">Present Salary</th>
                    <th width="5%" style="display:none">Expected Salary</th>
                    <th width="5%" style="display:none">Brief Description of Key Skills & his Requirement</th>
                    <th width="5%" style="display:none">Resume Name</th>
                    <th width="5%" style="display:none">Resume</th>
                    <th width="5%">Job Status</th>
                    <th width="5%">New Company</th>
                    <th width="5%">Resume date</th>
                    <th width="5%" style="width: 200px;">Actions/ Resume</th>
                    <th width="5%" style="width: 200px;">Approval</th>
                </tr>
            </thead>
            <tbody id="search_body">
                <?php
                $count = 1;
                foreach ($users_data as $row) {
                    $exp = $row->experience == '0' ? 'Fresher' : $row->experience;
                    echo '<tr>';
                    if ($row->status == "active") {
                        echo "<td><input type='checkbox' class='checkbox1' name='check[]' value='{$row->userId}'></td>";
                    } else {
                        echo "<td><input type='checkbox' disabled='true'></td>";
                    }
                    echo "<td>{$row->userId}</td>";
                    echo "<td style='display:none'>{$row->userId}</td>";
                    echo "<td>{$row->name}</td>";
                    echo "<td>{$row->mobile}</td>";
                    echo "<td style='display:none'>{$row->age}</td>";
                    echo "<td>{$row->email}</td>";
                    echo "<td style='display:none'>{$row->degree}</td>";
                    echo "<td style='display:none'>{$row->address}</td>";
                    echo "<td style='display:none'>{$row->curr_location}</td>";
                    echo "<td>{$row->c_courses}</td>";
                    echo "<td>{$row->t_courses}</td>";
                    echo "<td>{$exp}</td>";
                    echo "<td style='display:none'>{$row->company_name}</td>";
                    echo "<td style='display:none'>{$row->job_title}</td>";
                    echo "<td style='display:none'>{$row->years_in_curr_job}</td>";
                    echo "<td style='display:none'>{$row->pres_salary}</td>";
                    echo "<td style='display:none'>{$row->expec_salary}</td>";
                    echo "<td style='display:none'>{$row->skills}</td>";
                    echo "<td style='display:none'>{$row->resume_name}</td>";
                    echo "<td style='display:none'></td>";
                    echo "<td>{$row->Job_status}</td>";
                    echo "<td>{$row->new_company_name}</td>";
                    echo "<td>{$row->resume_date}</td>";
                    if ($row->resume_name == "") {
                        echo "<td><a href='javascript:void(0);' data-id=" . $row->userId . " class='glyphicon glyphicon-eye-open btn-document-new-modals' title='View'></a>&nbsp;&nbsp;"
                        . "<a href='javascript:void(0);' data-id=" . $row->userId . " class='glyphicon glyphicon-pencil btn-update-modals' title='Edit'></a>&nbsp;&nbsp;"
                        . "<a href='javascript:void(0);' data-id=" . $row->userId . " class='glyphicon glyphicon-trash btn-delete-modals' title='Delete'></a>&nbsp;";
//                        . "<a href='#' class='glyphicon glyphicon-paperclip not-active' title='No Resume' disabled='disabled'></a>";
                        echo '</td>';
                    } else {
                        echo "<td><a href='javascript:void(0);' data-id=" . $row->userId . " class='glyphicon glyphicon-eye-open btn-document-new-modals' title='View'></a>&nbsp;&nbsp;"
                        . "<a href='javascript:void(0);' data-id=" . $row->userId . " class='glyphicon glyphicon-pencil btn-update-modals' title='Edit'></a>&nbsp;&nbsp;"
                        . "<a href='javascript:void(0);' data-id=" . $row->userId . " class='glyphicon glyphicon-trash btn-delete-modals' title='Delete'></a>&nbsp;"
                        . "<a href='" . base_url() . "resumes/" . $row->resume_name . "' target='blank' class='glyphicon glyphicon-paperclip' title='Resume'></a>";
                        echo '</td>';
                    }
                    if ($row->status == "active") {
                        echo "<td class='btn-success'>" . $row->status . "</td></tr>";
                    } else {
                        echo "<td class='btn-primary'>" . $row->status . "</td></tr>";
                    }

                    $count++;
                }
                ?>
            </tbody>

        </table>
    </div>
    <!-- jobseeker's view Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #ccc">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Jobseeker Details</h4>
                </div>
                <div class="modal-body view-modals">
                    <div class="container-fluid">
                        <div  class="row">  
                            <div id="body_content" class="col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3>Jobseeker Details</h3>
                                    </div>

                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <!-- /.panel-heading --> 
                                            <div class="panel-body">
                                                <div class="dataTable_wrapper" >
                                                    <table class="table table-striped table-bordered table-hover" id="student-detail">
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
                    </div> 
                </div> 
            </div></div></div>

    <!-- jobseeker's edit Modal -->  
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #ccc">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Jobseeker</h4>
                </div>
                <div class="modal-body view-modals">
                    <div class="container-fluid">
                        <div  class="row">  
                            <div id="body_content" class="col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3>Edit Jobseeker</h3>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <!-- /.panel-heading --> 
                                            <div class="panel-body">
                                                <div class="dataTable_wrapper" >
                                                    <table class="table table-striped table-bordered table-hover" id="edit_jobseeker">
                                                        <tbody>
                                                            <tr><td align='right'>UserId</td> 
                                                                <td><input type="text" id="edit_userid" class="form-control" name="edit_userid" readonly="readonly"></td></tr>
                                                            <tr><td align='right'>Full Name</td> 
                                                                <td><input type="text" id="edit_name" class="form-control" name="edit_name"></td></tr>
                                                            <tr><td align='right'>Contact No.</td>  
                                                                <td><input type="text" id="edit_contact" class="form-control" name="edit_contact"></td></tr>
                                                            <tr><td align='right'>Age</td> 
                                                                <td><input type="text" id="edit_age" class="form-control" name="edit_age"></td></tr>
                                                            <tr><td align='right'>Email</td> 
                                                                <td> <input type="text" id="edit_email" class="form-control" name="edit_email"></td></tr>
                                                            <tr><td align='right'>Qualification</td>  
                                                                <td><input type="text" id="edit_qualification" class="form-control" name="edit_qualification"></td></tr>
                                                            <tr><td align='right'>Address</td>  
                                                                <td><input type="text" id="edit_address" class="form-control" name="edit_address"></td></tr>
                                                            <tr><td align='right'>Curent Location</td>  
                                                                <td><input type="text" id="edit_curre_locat" class="form-control" name="edit_curre_locat"></td></tr>
                                                            <tr><td align='right'>Skils</td>  
                                                                <td><input type="text" id="edit_skils" class="form-control" name="edit_skils"></td></tr>
                                                            <tr><td align='right'>Certified Courses</td>  
                                                                <td><input type="text" id="edit_certify_course" class="form-control" name="edit_certify_course"></td></tr>
                                                            <tr><td align='right'>Undergone Training</td>  
                                                                <td>
                                                                    <input type="text" id="edit_training_course" class="form-control" name="edit_training_course">
                                                                </td></tr>
                                                            <tr><td align='right'>Experience</td>  
                                                                <td><input type="text" id="edit_exp" class="form-control" name="edit_exp"></td></tr>
                                                            <tr><td align='right'>Company Name</td>  
                                                                <td><input type="text" id="edit_company" class="form-control" name="edit_company"></td></tr>
                                                            <tr><td align='right'>Job Title</td>
                                                                <td><input type="text" id="edit_title" class="form-control" name="edit_title"></td></tr>
                                                            <tr><td align='right'>No. of years working</td>  
                                                                <td><input type="text" id="edit_years_exp" class="form-control" name="edit_years_exp"></td></tr>
                                                            <tr><td align='right'>Present Salary</td>  
                                                                <td><input type="text" id="edit_present_sal" class="form-control" name="edit_present_sal"></td></tr>
                                                            <tr><td align='right'>Expected Salary</td>  
                                                                <td><input type="text" id="edit_expect_sal" class="form-control" name="edit_expect_sal"></td></tr>
                                                            <tr><td align='right'>Job Status</td>  
                                                                <td><select id="job_status" name="job_status"  > <!-- class="selectpicker"   -->
                                                                        <option value=""></option>
                                                                        <option value="No">No</option>
                                                                        <option value="Yes">Yes</option>
                                                                    </select></td></tr>
                                                            <tr><td align='right'>New Company</td>  
                                                                <td><input type="text" id="edit_new_company" class="form-control" name="edit_new_company"></td></tr>
                                                            <tr><td align='right'>Status</td>  
                                                                <td><select id="status" name="status"  >
                                                                        <option value=""></option>
                                                                        <option value="active">active</option>
                                                                        <option value="inactive">inactive</option>
                                                                    </select></td></tr>
																	 <tr><td align='right'>Update Resume</td>  
                                                                <td><input type="file" name="add_resume"  id="add_resume" disabled="true" ></td></tr>
                                                            <tr><td align='right'></td>  
                                                                <td><input type="submit" id="update_data" class="btn btn-default btn-success" value="Update"></td></tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
											<div class="form-group" style="">
											<label for="expec_salary" class="col-sm-4 control-label">Update Resume</label>
											<div class="col-sm-8">
												<input type="file" name="add_resume"  id="add_resume" disabled="true" >
												<button type="button" id="upload_resume" class="btn btn-default btn-success">Upload Resume</button>
												<button type="button" id="cancel_upload" class="btn btn-default btn-success">Cancel</button>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div></div></div>

    <!-- Add course Modal -->
    <div class="modal fade" id="AddCourseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #ccc">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Course</h4>
                </div>
                <div class="modal-body view-modals">
                    <div class="container-fluid">
                        <div  class="row">  
                            <div id="body_content" class="col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3>Add Course</h3>
                                    </div>

                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <!-- /.panel-heading --> 
                                            <div class="panel-body">
                                                <div class="dataTable_wrapper" >
                                                    <div id="error_course"></div>
                                                    <form class="form-horizontal add_course_form" id="add_course_form" role="form">

                                                        <div class="form-group">
                                                            <label for="course_name" class="col-sm-4  control-label">Course Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Course Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sub_course_of" class="col-sm-4  control-label">Parent Course Name</label>
                                                            <div class="col-sm-8">
                                                                <select name="sub_course_of" id="sub_course_of" class="form-control">
                                                                    <option value="0"></option>
                                                                    <?php
                                                                    foreach ($course_list as $key => $list) {
                                                                        if ($list->parent_list == 0) {
                                                                            echo '<option value="' . $list->course_id . '">' . $list->course_name . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-sm-offset-4 col-sm-10">
                                                                <button type="submit" class="btn btn-default btn-success">Add Course</button>
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
                    </div> 
                </div> 
            </div></div></div>
    <!-- Send Mails To Employee Modal -->
    <div class="modal fade" id="SendingmailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #ccc">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Sending Mail To Employer</h4>
                </div>
                <div class="modal-body view-modals">
                    <div class="container-fluid">
                        <div  class="row">  
                            <div id="body_content" class="col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12">

                                    </div>

                                </div>
                                <!-- /.row -->
                                <form class="form-horizontal send-detail-form">
                                    <div id="send_error"></div>
                                    <div class="form-group">
                                        <label for="subject" class="col-sm-3 control-label">To Mail Id</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="to_mail" id="to_mail" >
                                                <option></option>
                                                <?php
                                                foreach ($employee as $value) {
                                                    echo "<option value='" . $value->email . "'>" . $value->email . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <label for="subject" class="col-sm-3 control-label">Employer Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="emp_name" class="form-control" name="emp_name" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject" class="col-sm-3 control-label">Company Name</label>
                                        <div class="col-sm-9">
                                            <span class="form-control" id="emp_company_name" ></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Designation</label>
                                        <div class="col-sm-9">
                                            <span class="form-control" id="emp_designation"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <!--<button type="button" class="btn btn-success" id="get_mail_list">Get</button>-->
                                           <input type="hidden" class="form-control" id="student_ids" name="student_ids" placeholder="">
                                            <input type="hidden" class="form-control" id="mail_array" name="mail_array" placeholder="">
                                            <input type="hidden" class="form-control" id="student_names" name="student_names" placeholder="">
                                            <input type="hidden" class="form-control" id="student_location" name="student_location" placeholder="">
                                            <input type="hidden" class="form-control" id="student_Qualification" name="student_Qualification" placeholder="">
                                            <input type="hidden" class="form-control" id="student_c-course" name="student_c-course" placeholder="">
                                            <input type="hidden" class="form-control" id="student_t-course" name="student_t-course" placeholder="">
                                            <input type="hidden" class="form-control" id="student_age" name="student_age" placeholder="">
                                            <input type="hidden" class="form-control" id="student_experiance" name="student_experiance" placeholder="">
                                            <input type="hidden" class="form-control" id="resume" name="resume" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group" id="email_list">

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-10">
                                            <button type="submit" class="btn btn-success">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div></div></div>
    <!-- Send Mails To Employee Modal -->
    <div class="modal fade" id="Sendingmails_To_Seeker_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #ccc">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Sending Mail To Jobseeker</h4>
                </div>
                <div class="modal-body view-modals">
                    <div class="container-fluid">
                        <div  class="row">  
                            <div id="body_content" class="col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12">

                                    </div>

                                </div>
                                <!-- /.row -->
                                <form class="form-horizontal send-mail_to_seeker-form">
                                    <div id="seeker_send_error"></div>
                                 
                                    <div class="form-group">
                                        <label for="subject" class="col-sm-3 control-label">Subject</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Mail Body</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="3" id="message" name="message" placeholder="Mail Body"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-2">

                                            <input type="hidden" class="form-control" id="mail_array" name="mail_array" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group" id="email_list">

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-10">
                                            <button type="submit" class="btn btn-success">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div></div></div>

</div>
</div>
</div>
</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<script>
    $(function () {
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    $(function () {
        $('.modal-body').perfectScrollbar();
        $('.ps-scrollbar-x-rail').addClass('hidden');
    });
</script>
<script type="text/javascript">
    $('#add_employee').click(function () {
        window.location = "<?php echo base_url(); ?>registration/employerRegister";
    });

</script>