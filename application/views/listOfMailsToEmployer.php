
<div class="row">
    <br/>
    <div class="col-lg-12 ">
        <span id="errorEmp"></span>
        <h4 class="modal-title" id="myModalLabel">List of Student Details to Employer : </h4><br>
        <table class="table table-hover dataTables-example" id="table_box" >
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Jobseeker Name</th>
                    <th>Jobseeker Email</th>
                    <th>obseeker Contact</th>
                    <th>Employer Name</th>
                    <th>Company Name</th>
                    <th>Employer Email</th>
                </tr>
            </thead>
            <tbody id="">
                <?php
                $i = 1;
                foreach ($listOfMails as $list) {
                    echo "<tr>";
                    echo "<td align='center'>" . $i . "</td>";
                    echo "<td>" . $list->name . "</td>";
                    echo "<td>" . $list->email . "</td>";
                    echo "<td>" . $list->mobile . "</td>";
                    echo "<td>" . $list->employer_name . "</td>";
                    echo "<td>" . $list->company_name . "</td>";
                    echo "<td>" . $list->employer_email . "</td>";
                    
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>