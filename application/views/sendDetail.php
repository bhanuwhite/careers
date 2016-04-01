
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">                    
                    <form class="form-horizontal send-detail-form">
                        <div id="send_error"></div>
                        <div class="form-group">
                            <label for="subject" class="col-sm-3 control-label">To Mail Id</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="to_mail" id="to_mail" >
                                    <option></option>
                                    <?php
                                    foreach ($employee as $value) {
                                        echo "<option value='".$value->email."'>".$value->email."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="col-sm-3 control-label">Subject</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Message</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="message" name="message"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="col-sm-3 control-label">Student List From</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="stat_val" name="stat_val" placeholder="">
                            </div>
                            <label for="subject" class="col-sm-1 control-label">To</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="end_val" name="end_val" placeholder="">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success" id="get_mail_list">Get</button>
                                <input type="hidden" class="form-control" id="student_ids" name="student_ids" placeholder="">
                                <input type="hidden" class="form-control" id="mail_array" name="mail_array" placeholder="">
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
</div>
<!-- /container -->
</div>

    

<!-- Bootstrap core JavaScript
================================================== -->

<script src="<?php echo base_url(); ?>assets/js/send_mails.js"></script>
<script>
    $(document).ready(function () {

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