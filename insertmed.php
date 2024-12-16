<?php
include('connection.php');
session_start();

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลจากฟอร์ม
    $medName = $_POST['MedName'];
    $medID = $_POST['MedID'];
    $price = $_POST['price'];
    $reg_no = $_POST['reg_no'];
    $indications = $_POST['indications'];
    $precautions = $_POST['precautions'];
    $contraindications = $_POST['contraindications'];
    $effects = $_POST['Effects'];
    $dosage = $_POST['Dosage'];

    // อัปโหลดรูปภาพ
    $image = $_FILES['Image']['name'];
    $target = "uploads/" . basename($image);

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $query = "INSERT INTO medicine (MedName, MedID, UniPrice, RegNo, Indications, Precautions, Contraindications, Effects, Dosage, Image) VALUES ('$medName', '$medID', '$price', '$reg_no', '$indications', '$precautions', '$contraindications', '$effects', '$dosage', '$image')";
    

    if (mysqli_query($conn, $query)) {
        // อัปโหลดรูปภาพถ้าข้อมูลถูกเพิ่มสำเร็จ
        if (move_uploaded_file($_FILES['Image']['tmp_name'], $target)) {
            // Redirect ไปที่ indexpu.php
            header("Location: indexpu.php");
            exit();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

