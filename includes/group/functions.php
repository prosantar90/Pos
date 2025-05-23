<?php 
$samiti = new samiti_group($conn);
$customer = new customers($conn);
$attendance = new attendance($conn);
if (isset($_POST['add_group'])) {
    print_r($_POST);
    $samiti_name = checkInput($_POST['group_name']);
    $samiti_adhar = checkInput($_POST['group_aadhar']);
    $samiti_phone = checkInput($_POST['group_phone']);
    $samiti_addres = checkInput($_POST['group_address']);
    $query = array(
        'group_name' => $samiti_name,
        'g_adhar'   => $samiti_adhar,
        'phone_no' => $samiti_phone,
        'group_addrss' => $samiti_addres
    );
     try {
        $run  = $samiti->addGroup($query);
        if ($run) {
            $_SESSION['res_type'] = 'success';
            $_SESSION['response'] = 'Successfully Inserted';
        } else {
            $_SESSION['res_type'] = 'danger';
            $_SESSION['response'] = 'Failed to insert data';
        }
        header('location:group_frm.php');
    } catch (Exception $e) {
        $_SESSION['res_type'] = 'danger';
        $_SESSION['response'] = 'SQL Error: ' . $e->getMessage();
        header('location:group_frm.php');
    }
}


if (isset($_POST['getGroupId'])) {

    $groupId = checkInput($_POST['getGroupId']);
    $run = $customer->getGroupId($groupId);

    if (!empty($run)) {
        $no = 1;
        foreach ($run as $row) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['customer_name'] ?></td>
                <td><?= $row['father_name'] ?></td>
                <td><?= $row['aadhaar_no'] ?></td>
                <td><?= $row['phone_number'] ?></td>
                <td><?= $row['customer_address'] ?></td>
            </tr>
            <?php
        }
    } else {
        echo "No Customer added yet";
    }
    exit();
}

/**
 * Get Group Details Using Group Id
 * 
 */
if (isset($_GET['group_id'])) {
    $gid= checkInput($_GET['group_id']);
    $row = $samiti->getGroupById($gid);
    $samiti_name = $row['group_name'];
    $samiti_id = $row['id'];

}


// $date = date('Y m d');
// $present_groups = isset($_POST['present_groups']) ? $_POST['present_groups'] : [];

if (isset($_POST['present_group'])) {
    $presentgroup = checkInput($_POST['present_group']);
    $group_id = checkInput($_POST['present_id']);
    $date = checkInput($_POST['attendance_date']);
    $status = $presentgroup;

    $data = array(
        'group_id' => $group_id,
        'attendance_date' => $date,
        'status'    =>  $status
    );
    $run = $attendance->addAttendance($data);
    if ($run) {
        header('location:attendance.php');
        $_SESSION['res_type']='success';
        $_SESSION['response']=  $presentgroup;
    }else{
        header('location:attendance.php');
        $_SESSION['res_type'] ='danger';
        $_SESSION['response'] ='Absent';
    }
}
// $all_groups = $db->query("SELECT id FROM groups");
// while ($group = $all_groups->fetch_assoc()) {
//     $status = in_array($group['id'], $present_groups) ? 'present' : 'absent';
//     $group_id = $group['id'];
//     $db->query("INSERT INTO group_attendance (group_id, attendance_date, status) VALUES ($group_id, '$date', '$status')");
// }

// header("Location: attendance_page.php?msg=Attendance saved successfully");
// exit;

/**
 * Export Group
 */
if (isset($_POST[''])) {
    $filename = 'attendance_data.csv';
    $header = array('SL No', 'Group Name','Attendance Date', 'Aadhaar No', 'status');

    $query = "SELECT group_attendance.id, samiti_group.group_name, group_attendance.attendance_date,samiti_group.g_adhar,group_attendance.status FROM group_attendance LEFT JOIN samiti_group ON group_attendance.group_id = samiti_group.id ORDER BY group_attendance.id DESC";
    
    // Format the 'purchase_at' column with the date format 'd-m-Y H:i:s'
    export_csv($filename, $header, $query, $conn, 'created_at', 'd-m-Y');
}
