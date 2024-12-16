<?php
// การเชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Pharmacy";

try {
    // สร้างการเชื่อมต่อ
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลยาทั้งหมดจากตาราง medicines
    $stmt = $conn->prepare("SELECT * FROM medicines");
    $stmt->execute();

    // เก็บข้อมูลในรูปแบบ associative array
    $medicines = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการยาทั้งหมด</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .medicine-card {
            background-color: #fff;
            padding: 20px;
            margin: 10px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .medicine-card h2 {
            margin: 0;
            color: #28a745;
        }
        .medicine-card p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>รายการยาทั้งหมด</h1>
        <?php if (count($medicines) > 0): ?>
            <?php foreach ($medicines as $medicine): ?>
                <div class="medicine-card">
                    <h2><?php echo htmlspecialchars($medicine['medicine_name']); ?></h2>
                    <p><strong>รหัสยา:</strong> <?php echo htmlspecialchars($medicine['product_code']); ?></p>
                    <p><strong>ราคาต่อหน่วย:</strong> <?php echo htmlspecialchars($medicine['price']); ?> บาท</p>
                    <p><strong>จำนวนคงเหลือ:</strong> <?php echo htmlspecialchars($medicine['quantity']); ?> หน่วย</p>
                    <p><strong>รายละเอียดเพิ่มเติม:</strong> <?php echo htmlspecialchars($medicine['description']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">ไม่มีข้อมูลยาในระบบ</p>
        <?php endif; ?>
    </div>
</body>
</html>
