<?php
include('connection.php');
session_start();

// ตรวจสอบการส่งข้อมูล
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $MedID = $_POST['MedID'];
    $MedName = $_POST['Medname'];
    $RegNo = $_POST['RegNo'];
    $Indications = $_POST['Indications'];
    $Precautions = $_POST['Precautions'];
    $Contraindications = $_POST['Contraindications'];
    $Effects = $_POST['Effects'];
    $Dosage = $_POST['Dosage'];
    $UniPrice = $_POST['UniPrice'];
    $QuantityStock = $_POST['QuantityStock'];

    // สร้างคำสั่ง SQL สำหรับการอัปเดต
    $query = "UPDATE medicine SET 
        MedName = '$MedName',
        RegNo = '$RegNo',
        Indications = '$Indications',
        Precautions = '$Precautions',
        Contraindications = '$Contraindications',
        Effects = '$Effects',
        Dosage = '$Dosage',
        UniPrice = '$UniPrice',
        QuantityStock = '$QuantityStock'
        WHERE MedID = '$MedID'";

    // รันคำสั่ง SQL
    if (mysqli_query($conn, $query)) {
        // ถ้าอัปเดตสำเร็จ เปลี่ยนเส้นทางกลับไปที่ indexpu.php
        header('Location: indexpu.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
