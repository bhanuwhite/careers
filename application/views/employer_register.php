<div class="row">
    <br/>
    <div class="col-lg-12 ">
        <div class="row empSearchBar" >  
            <button type="button" class="btn btn-default" id="add_employer">Add Employee</button>
            <select id="companySearch" class="selectpicker">
                <option></option>
                <?php
                foreach ($company as $company) {
                    echo "<option value='" . $company->company_name . "'>" . $company->company_name . "</option>";
                }
                ?>
            </select>
        </div>
        <span id="errorEmp"></span>
        <table class="table table-hover dataTables-example" id="table_box" >
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th style="display: none">EmpId</th>
                    <th>Employer Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Company Name</th>
                    <th>Designation</th>
                    <th>Approval</th>
                </tr>
            </thead>
            <tbody id="searchBody">
                <?php
                $i = 1;
                foreach ($employee as $emp) {
                    echo "<tr>";
                    echo "<td align='center'>" . $i . "</td>";
                    echo "<td style='display:none'>" . $emp->id . "</td>";
                    echo "<td>" . $emp->name . "</td>";
                    echo "<td>" . $emp->email . "</td>";
                    echo "<td>" . $emp->mobile . "</td>";
                    echo "<td>" . $emp->company_name . "</td>";
                    echo "<td>" . $emp->designation . "</td>";
                    echo "<td align='center'><a href='javascript:void(0);' data-id=" . $emp->id . " class='glyphicon glyphicon-pencil btn-employer-update' title='Edit'></a>&nbsp;&nbsp;"
                    . "<a href='javascript:void(0);' data-id=" . $emp->id . " class='glyphicon glyphicon-trash btn-employer-delete' title='Delete'></a>&nbsp;";
                    echo "</td>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="add_employeModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #ccc">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Employer</h4>
            </div>
            <div class="modal-body view-modals">
                <div class="container-fluid">
                    <div  class="row">  
                        <div id="body_content" class="col-xs-12">

                            <div id="errJobseeker"></div>
                            <form class="form-horizontal job-seeker-register-form" id="employer_form" role="form">
                                <!-- Name -->
                                <div class="form-group">
                                    <label for="jobseeker_name" class="col-sm-4 control-label control-label-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="jobseeker_name" name="jobseeker_name" placeholder="Name">
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <label for="jobseeker_email" class="col-sm-4 control-label control-label-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="jobseeker_email" name="jobseeker_email" placeholder="Email">
                                    </div>
                                </div>

                                <!-- Company Name -->
                                <div class="form-group">
                                    <label for="company_name" class="col-sm-4 control-label control-label-label">Company Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name">
                                    </div>
                                </div>
                                <!-- Designation -->
                                <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label control-label-label">Designation</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                                    </div>
                                </div>
                                <!-- Mobile -->
                                <div class="form-group">
                                    <label for="jobseeker_mobile" class="col-sm-4 control-label control-label-label">Mobile</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="jobseeker_mobile" name="jobseeker_mobile" placeholder="Mobile">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-10">
                                        <button type="submit" class="btn btn-default btn-success">Register</button>
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
<div class="modal fade" id="edit_employeModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #ccc">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Employer</h4>
            </div>
            <div class="modal-body view-modals">
                <div class="container-fluid">
                    <div  class="row">  
                        <div id="body_content" class="col-xs-12">

                            <div id="errEmpUpdate"></div>
                            <form class="form-horizontal job-seeker-register-form" id="edit_employer_form" role="form">
                                <!-- Name -->
                                <div class="form-group">
                                    <label for="edit_employer_name" class="col-sm-4 control-label control-label-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" class="form-control" id="employer_id" name="employer_id" placeholder="Name">
                                        <input type="text" class="form-control" id="edit_employer_name" name="edit_employer_name" placeholder="Name">
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <label for="edit_employer_email" class="col-sm-4 control-label control-label-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="edit_employer_email" name="edit_employer_email" placeholder="Email">
                                    </div>
                                </div>

                                <!-- Company Name -->
                                <div class="form-group">
                                    <label for="edit_company_name" class="col-sm-4 control-label control-label-label">Company Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_company_name" name="edit_company_name" placeholder="Company Name">
                                    </div>
                                </div>
                                <!-- Designation -->
                                <div class="form-group">
                                    <label for="edit_designation" class="col-sm-4 control-label control-label-label">Designation</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_designation" name="edit_designation" placeholder="Designation">
                                    </div>
                                </div>
                                <!-- Mobile -->
                                <div class="form-group">
                                    <label for="edit_employer_mobile" class="col-sm-4 control-label control-label-label">Mobile</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_employer_mobile" name="edit_employer_mobile" placeholder="Mobile">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-10">
                                        <button type="submit" class="btn btn-default btn-success">Register</button>
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
</div> <!-- /container -->
</div>
</div>

<script src="<?php echo base_url(); ?>assets/js/add_course.js" type="text/javascript"></script>
