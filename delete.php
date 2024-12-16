<?php
include('connection.php');
session_start();

// ตรวจสอบว่ามีการส่งค่า MedID มาหรือไม่
if (isset($_GET['MedID'])) {
    $MedID = $_GET['MedID'];

    // ตรวจสอบว่า MedID ไม่ว่างเปล่า
    if (!empty($MedID)) {
        // ลบข้อมูลยาโดยใช้ MedID
        $query = "DELETE FROM medicine WHERE MedID = '$MedID'";

        if (mysqli_query($conn, $query)) {
            // หากลบสำเร็จ ให้เปลี่ยนเส้นทางไปที่หน้า indexpu.php
            header("Location: indexpu.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "MedID is not defined.";
        exit();
    }
} else {
    echo "MedID is not set.";
    exit();
}
?>
