<?php
include('connection.php');
session_start();

// ตรวจสอบการเข้าสู่ระบบ
if (!isset($_SESSION['UserID'])) {
    $_SESSION['msg'] = "You must login first!!";
    header('location:Login.php');
    exit();
}

$medName = "";
$quantity = 0;

// ตรวจสอบว่า MedID ถูกส่งมาจาก URL หรือไม่
if (isset($_GET['MedID'])) {
    $medID = $_GET['MedID']; // รับค่า MedID จาก URL

    // ตรวจสอบรูปแบบ MedID
    if (!preg_match('/^M\d{4}$/', $medID)) {
        die("MedID ไม่ถูกต้อง");
    }

    // ดึงข้อมูลจากฐานข้อมูล
    $query = "SELECT MedName, QuantityStock FROM medicine WHERE MedID = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("การเตรียมคำสั่ง SQL ล้มเหลว: " . $conn->error);
    }

    $stmt->bind_param("s", $medID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("การเรียกข้อมูลล้มเหลว: " . $conn->error);
    }

    if ($row = $result->fetch_assoc()) {
        $medName = $row['MedName'];
        $quantity = $row['QuantityStock'];
    } else {
        $medName = "ไม่พบข้อมูลยา";
        $quantity = 0;
    }

    // การจัดการคำขอ POST สำหรับเพิ่มหรือลดจำนวน
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];

        if ($action === 'increase') {
            $quantity += 1;
        } elseif ($action === 'decrease' && $quantity > 0) {
            $quantity -= 1;
        }

        // อัปเดตฐานข้อมูล
        $updateQuery = "UPDATE medicine SET QuantityStock = ? WHERE MedID = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("is", $quantity, $medID);
        $updateStmt->execute();
        $updateStmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="up.css">

</head>

<body>
    <div class="flexbox">
        <div class="item-1">
            <div class="content">
                <a href="indexpu.php"><img class="img" src="P4.png" width="60" height="60"></a>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h1 style="color:#0071AE; text-align: center;">Stock Medicind</h1>
        <h1 style="color:#0071AE; text-align: center;"><?php echo htmlspecialchars($medName); ?></h1>
        <div style="display: flex; justify-content: center; align-items: center;">
            <img class="img" src="p55.png" alt="Pharmacy Image" style="width: 30%; height: auto;">
        </div>
        <p style="padding:3%; color:#0071AE; text-align: center; font-size: 36px;">Quantity Stock: <?php echo htmlspecialchars($quantity); ?> ชิ้น</p>

        <!-- ฟอร์มสำหรับเพิ่มหรือลดจำนวน -->
        <form style="display: flex; justify-content: center; align-items: center;" method="post" class="mb-3">
            <button type="submit" name="action" value="increase" class="btn btn-success" style="margin-right: 10px;">Increase Quantity</button>
            <button type="submit" name="action" value="decrease" class="btn btn-danger">Decrease Quantity</button>
        </form>

    </div>
</body>

</html>