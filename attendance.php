<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
$samiti = new samiti_group($conn);
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                <?php alertMsg();?>
                <div class="card">
                    <div class="card-header">
                      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#attendanceModal">Mark Attendance</button>
                        <div class="card-header-right">
                                <button id="attendance__exportCsv" data-id="attendance__exportCsv"
                                    class="btn btn-default">Export CSV</button>
                                <button id="customer__importCsv" data-id="import_import_csv" class="btn btn-default">Import CSV</button>
                            </div>
                             <div class="text-center" id="imort_frm"style="display:none;">
                                <form id="import_csv_form" action="action.php" method="POST" enctype="multipart/form-data" >
                                    <input type="file" name="import_csv_customers" id="import_csv_customers" accept=".csv">
                                    <input type="submit" value="Submit" class="btn btn-primary border-0" name="import_customers">
                            </form>
                             </div>
                    </div>
                <div class="card-body">
                <table class="table table-hover" id="attendance_lists">
                  <thead>
                    <th>#</th>
                    <th>Group Name</th>
                    <th>Attendance Date</th>
                    <th>Adhar No</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>
                </table>
                
                <!-- Attendance Button -->
                    
                </div>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Attendance Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="action.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Mark Attendance</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            
              <select name="present_id" id="present_id" class="form-control select1"> 
              <?php
              $run = $samiti->getAllGroups();
              foreach ($run as $row) {
                echo '<option value="'.$row['id'].'">'.$row['group_name'].'</option>';
              }
              
            //   exit();
            //   $groups = $conn->query("SELECT id, group_name FROM samiti_group");
            //   while ($row = $groups->fetch_assoc()) {
                //   echo '<div class="form-check">
                //           <input class="form-check-input" type="checkbox" name="present_groups[]" value="'.$row['id'].'" id="group_'.$row['id'].'">
                //           <label class="form-check-label" for="group_'.$row['id'].'">'.$row['group_name'].'</label>
                //         </div>';
            //   }
            //   ?>
            </select>
          <input type="hidden" name="attendance_date" value="<?= date('Y-m-d') ?>">
          </div>

           <div class="form-group">
            <select name="present_group" id="present_group" class="form-control select1" required>
              <option value="">Select Option</option>
              <option value="present">Present</option>
              <option value="absent">Absent</option>
            </select>
        </div>
        </div>
       
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit Attendance</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Group View Ajax -->
 <!-- View Customer as a profile -->
<div class="modal" id="group_view_ajax">
    <div class="modal-dialog content-width">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Group View</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-bodi" id="group_view">
               <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Father Name</th>
                        <th>Aadhar No</th>
                        <th>Phone No</th>
                        <th>Addrress</th>
                    </thead>
                    <tbody id="group_views">

                    </tbody>
               </table>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php' ?>