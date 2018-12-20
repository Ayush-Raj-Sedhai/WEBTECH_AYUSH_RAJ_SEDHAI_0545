
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="#">
        <em class="fa fa-home"></em>
      </a></li>
      <li class="active">Room Management</li>
    </ol>
    </div><!--/.row-->
    <br>
    <div class="row">
      <div class="col-lg-12">
        <div id="success"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Room Management
            <button class="btn btn-info pull-right" data-toggle="modal" data-target="#addRoom">Add Room</button>
          </div>
          <div class="panel-body">
            <?php
            if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error on Delete !
            </div>";
            }
            if (isset($_GET['success'])) {
            echo "<div class='alert alert-success'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully Delete !
            </div>";
            }
            ?>
            <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"
              id="rooms">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Room Type</th>
                  <th>Date</th>
                  <th>First Namr</th>
                  <th>Last Name </th>
                  <th>Type</th>
                  <th>Days</th>
                  <th>How you get information</th>
                  <th>How far from Hotel </th>
                  <th>Update</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $room_query = "SELECT * FROM room NATURAL JOIN room_type WHERE deleteStatus = 0 ";
                  $rooms_result = mysqli_query($connection, $room_query);
                  if (mysqli_num_rows($rooms_result) > 0) {
                  while ($rooms = mysqli_fetch_assoc($rooms_result)) { ?>


                  <tr>
                    <td><?php echo $rooms['room_no'] ?></td>
                    <td><?php echo $rooms['room_type'] ?></td>
                    <td><?php echo $rooms['date_taken'] ?></td>
                    <td><?php echo $rooms['organizer'] ?></td>
                    <td><?php echo $rooms['hiking_route'] ?></td>
                    <td><?php echo $rooms['coordinator'] ?></td>
                    <td><?php echo $rooms['hour_taken'] ?></td>
                    <td><?php echo $rooms['difficult_level'] ?></td>
                    <td><?php echo $rooms['km'] ?></td>
                    <td>
                      <button title="Edit Room Information" data-toggle="modal"
                      data-target="#editRoom" data-id="<?php echo $rooms['room_id']; ?>"
                      id="roomEdit" class="btn btn-info"><i class="fa fa-pencil"></i></button>

                      <a href="ajax.php?delete_room=<?php echo $rooms['room_id']; ?>"
                        class="btn btn-danger" onclick="return confirm('Are you Sure?')"><i
                        class="fa fa-trash" alt="delete"></i></a>
                    </td>
                  </tr>
                  <?php
                  }
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
      <div id="addRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add New Room</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <form id="addRoom" data-toggle="validator" action="" role="form" method="POST">
                    <div class="response"></div>
                    <div class="form-group">
                      <label>Room Type</label>
                      <select class="form-control" id="room_type_id" required
                        data-error="Select Room Type">
                        <option selected disabled>Select Room Type</option>
                        <?php
                        $query = "SELECT * FROM room_type";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                        while ($room_type = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $room_type['room_type_id'] . '">' . $room_type['room_type'] . '</option>';
                        }
                        }
                        ?>
                      </select>
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                      <label>ID No</label>
                      <input class="form-control" placeholder="ID No" id="room_no"
                      data-error="Enter ID No" >
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                      <label>Date</label>
                      <input type="date" id="date_taken" name="date_taken" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" id="organizer" name="organizer" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" id="hike_route" name="hike_route" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Type</label>
                      <input type="text" id="coordinator" name="coordinator" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Days Stay</label>
                      <input type="number" id="hour_taken" name="hour_taken" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>How Youg get information</label>
                      <input type="text" id="difficult_level" name="difficult_level" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>How far from hotel (KM)</label>
                      <input type="number" id="km" name="km" class="form-control">
                    </div>
                    <button class="btn btn-success pull-right" type="submit" name="add_room">Add Rooom</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Edit Room Modal -->
      <div id="editRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Room</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <form id="roomEditFrom" data-toggle="validator" role="form">
                    <div class="edit_response"></div>
                    <div class="form-group">
                      <label>Room Type</label>
                      <select class="form-control" id="edit_room_type" required
                        data-error="Select Room Type">
                        <option selected disabled>Select Room Type</option>
                        <?php
                        $query = "SELECT * FROM room_type";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                        while ($room_type = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $room_type['room_type_id'] . '">' . $room_type['room_type'] . '</option>';
                        }
                        }
                        ?>
                      </select>
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                      <label>ID No</label>
                      <input class="form-control" placeholder="ID No" id="edit_room_no" required
                      data-error="Enter ID No">
                      <div class="help-block with-errors"></div>
                    </div>
                    <input type="hidden" id="edit_room_id">
                    <button class="btn btn-success pull-right">Submit </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---customer details-->
      <div id="cutomerDetailsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Customer Detail</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <table class="table table-responsive table-bordered">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Customer Name</td>
                        <td id="customer_name"></td>
                      </tr>
                      <tr>
                        <td>Contact Number</td>
                        <td id="customer_contact_no"></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td id="customer_email"></td>
                      </tr>
                      <tr>
                        <td>ID Card Type</td>
                        <td id="customer_id_card_type"></td>
                      </tr>
                      <tr>
                        <td>ID Card Number</td>
                        <td id="customer_id_card_number"></td>
                      </tr>
                      <tr>
                        <td>Address</td>
                        <td id="customer_address"></td>
                      </tr>
                      <tr>
                        <td>Remaining Amount</td>
                        <td id="remaining_price"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---customer details ends here-->
      <!-- Check In Modal -->
      <div id="checkIn" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Check In Room</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <table class="table table-responsive table-bordered">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Customer Name</td>
                        <td id="getCustomerName"></td>
                      </tr>
                      <tr>
                        <td>Room Type</td>
                        <td id="getRoomType"></td>
                      </tr>
                      <tr>
                        <td>Room No</td>
                        <td id="getRoomNo"></td>
                      </tr>
                      <tr>
                        <td>Check In</td>
                        <td id="getCheckIn"></td>
                      </tr>
                      <tr>
                        <td>Check Out</td>
                        <td id="getCheckOut"></td>
                      </tr>
                      <tr>
                        <td>Total Price</td>
                        <td id="getTotalPrice"></td>
                      </tr>
                    </tbody>
                  </table>
                  <form role="form" id="advancePayment">
                    <div class="payment-response"></div>
                    <div class="form-group col-lg-12">
                      <label>Advance Payment</label>
                      <input type="number" class="form-control" id="advance_payment"
                      placeholder="Advance Payment">
                    </div>
                    <input type="hidden" id="getBookingID" value="">
                    <button type="submit" class="btn btn-primary pull-right">Payment & Check In</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Check Out Modal-->
      <div id="checkOut" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Check Out Room</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <table class="table table-responsive table-bordered">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Hiker Name</td>
                        <td id="getCustomerName_n"></td>
                      </tr>
                      <tr>
                        <td>Hikers Type</td>
                        <td id="getRoomType_n"></td>
                      </tr>
                      <tr>
                        <td>Roll No</td>
                        <td id="getRoomNo_n"></td>
                      </tr>
                      <tr>
                        <td>ONe dAY</td>
                        <td id="getCheckIn_n"></td>
                      </tr>
                      <tr>
                        <td>Check Out</td>
                        <td id="getCheckOut_n"></td>
                      </tr>
                      <tr>
                        <td>Total Amount</td>
                        <td id="getTotalPrice_n"></td>
                      </tr>
                      <tr>
                        <td>Remaining Amount</td>
                        <td id="getRemainingPrice_n"></td>
                      </tr>
                    </tbody>
                  </table>
                  <!--     <form role="form" id="checkOutRoom_n" data-toggle="validator">
                    <div class="checkout-response"></div>
                    <div class="form-group col-lg-12">
                      <label>Remaining Payment</label>
                      <input type="text" class="form-control" id="remaining_amount"
                      placeholder="Remaining Payment" required
                      data-error="Please Enter Remaining Amount">
                      <div class="help-block with-errors"></div>
                    </div>
                    <input type="hidden" id="getBookingId_n" value="">
                    <button type="submit" class="btn btn-primary pull-right">Payment & Checkout</button>
                  </form> -->
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
      </div>
       <?php
      // if(isset($_POST['addroute']))
      // {
      //   $date=$_POST['date'];
      //   $hiking_route=$_POST['hiking_route'];
      //   $coordinator=$_POST['coordinator'];
      //   $organizer=$_POST['organizer'];
      //   $hour_taken=$_POST['hour_taken'];
      //   $difficult_level=$_POST['difficult_level'];
      //   $km=$_POST['km'];
      //   //$query = "INSERT INTO room( date, organizer, hiking_route, coordinator, hour_taken, difficult_level, km) VALUES ('$date','$hiking_route','$coordinator','$organizer','$hour_taken','$difficult_level','$km')";
      //   echo $date;
      //   //$result = mysqli_query($connection, $query);

      // }
      ?>
