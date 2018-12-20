<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Book Room</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Book Room</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Form</div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error on Complaint !
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Complaint Successfully Added !
                            </div>";
                    }
                    ?>
                    <form role="form"  data-toggle="validator" method="post" action="ajax.php">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" placeholder="Hiker Name" name="complainant_name" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Hike Route" name="complaint_type" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Contact Number</label>
                                <textarea class="form-control" name="complaint" placeholder="Contact Number" required></textarea>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-lg btn-primary" name="createComplaint">Submit</button>
                        <button type="reset" class="btn btn-lg btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Form Management</div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['resolveError'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error on Resolve !
                            </div>";
                    }
                    if (isset($_GET['resolveSuccess'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Complaint Successfully Resolve !
                            </div>";
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%" id="rooms">
                        <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Customer Name</th>
                            <th>Room Number</th>
                            <th>Contact Number</th>
                            <th>Apply Date</th>
                            <th>Accepted Date</th>
                            <th>Remarks</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $complaint_query = "SELECT * FROM complaint";
                        $complaint_result = mysqli_query($connection, $complaint_query);
                        if (mysqli_num_rows($complaint_result) > 0) {
                            $num = 0;
                            while ($complaint = mysqli_fetch_assoc($complaint_result)) {
                                $num++
                                ?>
                                <tr>
                                    <td><?php echo $num ?></td>
                                    <td><?php echo $complaint['complainant_name'] ?></td>
                                    <td><?php echo $complaint['complaint_type'] ?></td>
                                    <td><?php echo $complaint['complaint'] ?></td>
                                    <td><?php echo date('M j, Y',strtotime($complaint['created_at'])) ?></td>
                                    <td>
                                        <?php if(!$complaint['resolve_status']){
                                            echo '<button class="btn btn-success" data-toggle="modal" data-target="#complaintModal" data-id="' . $complaint['id'] . '" id="complaint">Accept</a>';
                                        } else{
                                            echo date('M j, Y',strtotime($complaint['resolve_date']));
                                        }
                                        ?>
                                    </td>
                                    <th><?php echo $complaint['budget'] ?></th>


                                </tr>
                            <?php }
                        } else {
                            echo "No Rooms";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Room Modal -->
    <div id="complaintModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Room Accept</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form data-toggle="validator" role="form" method="post" action="ajax.php">
                                <div class="form-group">
                                    <label>Accepted/NotAccepted</label>
                                    <input class="form-control" placeholder="Remarks" name="budget" data-error="Enter Budget" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="complaint_id" name="complaint_id" value="">
                                <button class="btn btn-success pull-right" name="resolve_complaint">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <p class="back-link">CMS Developed by <a href="">Ayush</a></p>
        </div>
    </div>

</div>    <!--/.main-->