<div class="row">
    <br>
    <div class="col-lg-2" ></div>
    <div class="modal fade" id="add_courseModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                               
                                <form class="form-horizontal add_course_form" id="add_course_form" role="form">

                                    <div class="form-group">
                                        <label for="course_name" class="col-sm-4  control-label">Course Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="course_name" name="course_name" autocomplete="off" placeholder="Course Name">
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
    <div class="modal fade" id="edit_courseModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #ccc">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Course</h4>
                </div>
                <div class="modal-body view-modals">
                    <div class="container-fluid">
                        <div  class="row">  
                            <div id="body_content" class="col-xs-12">
                                <span id="error_edit"></span>
                                <form class="form-horizontal edit_course_form" id="edit_course_form" role="form">
                                   
                                    <div class="form-group">
                                        <label for="course_name" class="col-sm-4  control-label">Course Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="course_id" name="course_id" >
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="course_name" class="col-sm-4  control-label">Course Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="edit_course_name" name="edit_course_name" >
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="sub_course_of" class="col-sm-4  control-label">Parent Course Name</label>
                                        <div class="col-sm-8">
                                            <select name="edit_sub_course_of" id="edit_sub_course_of" class="form-control">
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
    
    
    <div class="col-lg-8" >
        <div class="panel panel-default"  >
            <!-- /.panel-heading --> 
            <div class="panel-body">
                <div class="dataTable_wrapper" >
                    <button type="button" class="btn btn-default" id="add_course">Add Course</button>
                    <span id="courseError"></span>
                    <table class="table table-hover dataTables-example" id="table_box" >
                        <thead>
                            <tr>
                                <th width="5%">Serial No</th>
                                <th width="5%" style="display: none">CourseId</th>
                                <th width="5%">course Name</th>
                                <th width="5%"  style="display: none">Parent List</th>
                                <th width="5%">Approval</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <?php
                            $i = 1;
                            foreach ($course_list as $course) {
                                echo "<tr>";
                                echo "<td align='center'>" . $i . "</td>";
                                echo "<td style='display:none'>" . $course->course_id . "</td>";
                                echo "<td>" . $course->course_name . "</td>";
                                echo "<td  style='display:none'>" . $course->parent_list . "</td>";
                                echo "<td align='center'><a href='javascript:void(0);' data-id=" . $course->course_id . " class='glyphicon glyphicon-pencil btn-course-update' title='Edit'></a>&nbsp;&nbsp;"
                                . "<a href='javascript:void(0);' data-id=" . $course->course_id . " class='glyphicon glyphicon-trash btn-course-delete' title='Delete'></a>&nbsp;";
                                echo "</td>";
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="<?php echo base_url(); ?>assets/js/add_course.js" type="text/javascript"></script>