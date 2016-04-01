            <div class="row">
                <div class="col-lg-8 col-lg-offset-1">
                    <div id="errJobseeker"></div>
                    <form class="form-horizontal job-seeker-form" style="padding-top:20px;" id="job-seeker-profile-form" name="job-seeker-profile-form" role="form">
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Username(Your Email ID)</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" placeholder="" disabled="true" value="<?php echo $user_data->email; ?>">
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label">Change Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password1" name="password1" disabled="true" placeholder="">
                                <button type="button" id="change_password" class="btn btn-default btn-success" style="margin-left: 111%;margin-top: -15%;">Change Password</button>
                                <button type="button" style="display: none;margin-left: 111%;margin-top: 5%;" id="cancel_password" class="btn btn-default btn-success" style="margin-left: 111%">Cancel</button>
                            </div>
                        </div>
                        <!-- Confirm password -->
                        <div class="form-group">
                            <label for="password2" class="col-sm-4 control-label">Confirm Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password2" name="password2"  disabled="true" placeholder="">
                            </div>
                        </div>
                        <!-- add resume -->
                        <div class="form-group" style="">
                            <label for="expec_salary" class="col-sm-4 control-label">Resume</label>
                            <div class="col-sm-8">
                                <input type="file" name="add_resume"  id="add_resume" disabled="true" >
                                <button type="button" id="upload_resume" class="btn btn-default btn-success" style="margin-left: 111%;margin-top: -15%;">Upload Resume</button>
                                <button type="button" style="display: none;margin-left: 111%;margin-top: 5%;" id="cancel_upload" class="btn btn-default btn-success" style="margin-left: 111%">Cancel</button>
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label control-label">Full Name&nbsp;&nbsp;<span style="color: #FF0000">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="userName" name="userName" placeholder="" value="<?php echo $user_data->name; ?>">
                                </div>
                            </div>

                            <!-- Mobile Number -->
                            <div class="form-group">
                                <label for="mobile" class="col-sm-4 control-label control-label">Contact Number(Mobile)&nbsp;&nbsp;<span style="color: #FF0000">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="" value="<?php echo $user_data->mobile; ?>">
                                </div>
                            </div>
                            <!-- Current Location -->
                            <div class="form-group">
                                <label for="curr_location" class="col-sm-4 control-label control-label">Current Location&nbsp;&nbsp;<span style="color: #FF0000">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="curr_location" name="curr_location" placeholder="" value="<?php echo $user_data->curr_location; ?>">
                                </div>
                            </div>
                            <!-- Age -->
                            <div class="form-group">
                                <label for="age" class="col-sm-4 control-label control-label">Age&nbsp;&nbsp;<span style="color: #FF0000">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="age" name="age" placeholder="" value="<?php echo $user_data->age; ?>">
                                </div>
                            </div>
                            <!-- Educational Qualification -->
                            <!-- Degree -->
                            <div class="form-group">
                                <label for="degree" class="col-sm-4 control-label control-label">Degree&nbsp;&nbsp;<span style="color: #FF0000">*</span></label>
                                <div class="col-sm-8">
                                    <!--
                                    <input type="text" class="form-control" id="degree" name="degree" placeholder="" value="<?php echo $user_data->degree; ?>">
                                    -->
                                    <select id="degree" name="degree" class="selectpicker">
                                        <option value="">Select Qualification</option>
                                        <option value="Engineering Graduate">Engineering Graduate</option>
                                        <option value="Post Graduate">Post Graduate</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Any other">Any other</option>

                                    </select>	      
                                </div>
                            </div>
                            <!-- Certified Courses -->
                            <div class="form-group">
                                <label for="c_courses" class="col-sm-4 control-label control-label">Certified Courses&nbsp;&nbsp;<span style="color: #FF0000">*</span></label>
                                <div class="col-sm-8">
                                  <!-- <input type="text" class="form-control" id="c_courses" name="c_courses" placeholder="" value="<?php echo $user_data->c_courses; ?>"> -->
                                    <select id="c_courses" name="c_courses[]" class="selectpicker" multiple>
                                        <!-- <option value="">Select Course</option> -->
                                        <?php
                                        foreach ($course as $key => $list) {
                                if ($list->parent_list == 0) {
                                    if ($list->has_child == 1) {
                                        echo '<optgroup label="' . $list->course_name . '">';
                                        foreach ($course as $child) {
                                            if ($list->course_id == $child->parent_list) {
                                                echo '<option value="' . $child->course_name . '">' . $child->course_name . '</option>';
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
                            <!-- Undergone Training Courses -->
                            <div class="form-group">
                                <label for="t_courses" class="col-sm-4 control-label control-label">Undergone Training Courses&nbsp;&nbsp;<span style="color: #FF0000">*</span></label>
                                <div class="col-sm-8">
                                    <!--<input type="text" class="form-control" id="t_courses" name="t_courses" placeholder="" value="<?php echo $user_data->t_courses; ?>">-->
                                    <select id="t_courses" name="t_courses[]" class="selectpicker" multiple>
                                        <!-- <option value="">Select Course</option> -->
                                        <?php
                             foreach ($course as $key => $list) {
                                if ($list->parent_list == 0) {
                                    if ($list->has_child == 1) {
                                        echo '<optgroup label="' . $list->course_name . '">';
                                        foreach ($course as $child) {
                                            if ($list->course_id == $child->parent_list) {
                                                echo '<option value="' . $child->course_name . '">' . $child->course_name . '</option>';
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

                            <!-- Present Employment Details: (If Applicable):-->
                            <!-- Company Name -->
                            <div class="form-group" style="">
                                <label for="company_name" class="col-sm-4 control-label">Present Employer / company Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="" value="<?php echo $user_data->company_name; ?>" >
                                </div>
                            </div>
                            <!-- Job Title -->
                            <div class="form-group" style="">
                                <label for="job_title" class="col-sm-4 control-label">Job Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="job_title" name="job_title" placeholder="" value="<?php echo $user_data->job_title; ?>">
                                </div>
                            </div>
                            <!-- No. Of Years in current job -->
                            <div class="form-group" style="">
                                <label for="years_in_curr_job" class="col-sm-4 control-label">No. Of Years in current job</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="years_in_curr_job" name="years_in_curr_job" placeholder="" value="<?php echo $user_data->years_in_curr_job; ?>">
                                </div>
                            </div>
                            <!-- Present Salary: -->
                            <div class="form-group" style="">
                                <label for="pres_salary" class="col-sm-4 control-label">Present salary per annum</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="pres_salary" name="pres_salary" placeholder="" value="<?php echo $user_data->pres_salary; ?>">
                                </div>
                            </div>



                            <!-- Experience -->
                            <div class="form-group">
                                <label for="experience" class="col-sm-4 control-label control-label-label">Total No. Years of working Experience</label>
                                <div class="col-sm-8">
                                  <!-- <input type="text" class="form-control" id="experience" name="experience" placeholder="" value="<?php echo $user_data->experience; ?>"> -->
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
                            </div>
                            <!-- Expected Salary: -->
                            <div class="form-group" style="">
                                <label for="expec_salary" class="col-sm-4 control-label">Expected Salary</label>
                                <div class="col-sm-8">
                          <!--	<input type="text" class="form-control" id="expec_salary" name="expec_salary" placeholder="" value="<?php echo $user_data->expec_salary; ?>"> -->
                                    <select id="expec_salary"	name="expec_salary" class="selectpicker">
                                        <option value="">Select Salary</option>
                                        <option value="1 to 2 Lakhs">1 to 2 Lakhs</option>
                                        <option value="2 to 4 lakhs">2 to 4 lakhs</option>
                                        <option value="4 to 6 Lakhs">4 to 6 Lakhs</option>
                                        <option value="6 to 8 Lakhs">6 to 8 Lakhs </option>
                                        <option value="8 to 10 Lakhs">8 to 10 Lakhs</option>
                                        <option value="11 to 15 Lakhs">11 to 15 Lakhs </option>
                                        <option value="16 to 20 Lakhs">16 to 20 Lakhs</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- Brief Description of your Skills & Requirement: -->
                        <div class="form-group" style="">
                            <label for="skills" class="col-sm-4 control-label control-label">Brief Description of your Skills & Requirement&nbsp;&nbsp;<span style="color: #FF0000">*</span></label>
                            <div class="col-sm-8">
                                <textarea  class="form-control" id="skills" name="skills" placeholder="Description not be more than 400 words."><?php echo $user_data->skills; ?></textarea>
              <!--		<select id="skills"	name="skills" class="selectpicker" multiple>
                      
                              <option value="MCSE">MCSE</option>
                              <option value="CCNA">CCNA</option>
                              <option value="CCNP">CCNP</option>
                              <option value="CCIE">CCIE</option>
                              <option value="VM Ware">VM Ware</option>
                              <option value="CCNA Voice">CCNA Voice</option>
                              <option value="CCNA Security">CCNA Security</option>
                              <option value="Hadoop">Hadoop</option>
                              <option value="Microsoft Exchange">Microsoft Exchange</option>
                              <option value="Linux RHCE administrator">Linux RHCE administrator</option>
                              <option value="Hadoop">Ethical hacker & counter measures</option>
                              </select>	      -->
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-default btn-success">Update Profile</button>
                            </div>

                        </div>

                    </form>

                

            </div>
        </div> <!-- /container -->
        </div>
        </div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
          <script>
            $(document).ready(function () {

                $('#degree').val('<?php echo $user_data->degree; ?>');
                //$('#c_courses').val('<?php echo $user_data->c_courses; ?>');
                var tmp = '<?php echo $user_data->c_courses; ?>';
                $.each(tmp.split(","), function (i, e) {
                    if (e.length > 0)
                        $("#c_courses option[value='" + e + "']").prop("selected", true);
                });
                
                var training = '<?php echo $user_data->t_courses; ?>';
                $.each(training.split(","), function (i, e) {
                    if (e.length > 0)
                        $("#t_courses option[value='" + e + "']").prop("selected", true);
                });
                
                //$('#skills').val('<?php echo $user_data->skills; ?>');
                var tmp2 = '<?php echo $user_data->skills; ?>';
                //$.each(tmp2.split(","), function(i,e){
                //	if(e.length>0)
                //	$("#skills option[value='" + e + "']").prop("selected", true);
                //});
                $('#expec_salary').val('<?php echo $user_data->expec_salary; ?>');
                $('#experience').val('<?php echo $user_data->experience; ?>');

                $('.selectpicker').selectpicker();


            });
        </script>

