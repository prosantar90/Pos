<?php
$attendance = new attendance($conn);
if (isset($_POST['attendance_delete'])) {
    $id = checkInput($_POST['attendance_delete']);
    $run = $attendance->deleteAttendance($id);
    if($run){
        echo 'ok';
    }
}

/**
 * Export attendance
 */
if (isset($_POST['group__exportCsv'])) {
    $filename = 'groups_data.csv';
    $header = array('SL No', 'Group Name', 'Aadhaar No','Address','Phone No', 'Register');

    $query = "SELECT * FROM samiti_group  ORDER BY samiti_group .id DESC";
    
    // Format the 'purchase_at' column with the date format 'd-m-Y H:i:s'
    export_csv($filename, $header, $query, $conn, 'created_at', 'd-m-Y');
}
