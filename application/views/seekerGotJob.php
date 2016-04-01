
<div class="row">
    <br/>
    <div class="col-lg-12 ">
        <span id="errorEmp"></span>
        <h4 class="modal-title" id="myModalLabel">List of Student with Company Name : </h4><br>
        <table class="table table-hover dataTables-example" id="table_box" >
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Jobseeker Name</th>
                    <th>Jobseeker Email</th>
                    <th>Jobseeker Contact</th>
                    <th>Company Name</th>
                </tr>
            </thead>
            <tbody id="">
                <?php
                $i = 1;
                foreach ($gotJob as $list) {
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $list->name . "</td>";
                        echo "<td>" . $list->email . "</td>";
                        echo "<td>" . $list->mobile . "</td>";
                        echo "<td>" . $list->new_company_name . "</td>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>