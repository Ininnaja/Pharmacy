<?php
include('connection.php');
session_start();

// ตรวจสอบว่ามีการส่งค่า MedID มาหรือไม่
if (isset($_GET['MedID'])) {
    $MedID = $_GET['MedID'];

    // ดึงข้อมูลยา
    $query = "SELECT * FROM medicine WHERE MedID = '$MedID'";
    $result = mysqli_query($conn, $query);

    // ตรวจสอบว่าคำสั่ง SQL สำเร็จและมีข้อมูล
    if ($result && mysqli_num_rows($result) > 0) {
        $medicine = mysqli_fetch_assoc($result);
        // แสดงข้อมูลยาหรือดำเนินการต่อ
    } else {
        echo "Medicine not found or query failed.";
        exit();
    }
} else {
    echo "MedID is not defined.";
    // หรือเปลี่ยนเส้นทางไปยังหน้าอื่น
    // header('Location: index.php');
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UPDATE MEDICINE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <div class="flexbox">
        <div class="item-5">
            <h1 style="color:#0071AE; text-align: center;">Update Medicine</h1>
            <div class="box">
                <div class="content">
                    <form action="update_db.php" method="POST">
                        <input type="hidden" value="<?php echo htmlspecialchars($medicine['MedID']); ?>" name="MedID">
                        <div class="flexbox">
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="Medname">ชื่อยา :</label>
                                    <input type="text" name="Medname" class="form-control" value="<?php echo htmlspecialchars($medicine['MedName']); ?>" required>
                                </div>
                            </div>
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="MedID">รหัสยา :</label>
                                    <input type="text" name="MedID" class="form-control" value="<?php echo htmlspecialchars($medicine['MedID']); ?>" required>
                                </div>
                            </div>
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="RegNo">Reg. No.</label>
                                    <input type="text" name="RegNo" class="form-control" value="<?php echo htmlspecialchars($medicine['RegNo']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="flexbox">
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="Indications">สรรพคุณ :</label>
                                    <input type="text" name="Indications" class="form-control" value="<?php echo htmlspecialchars($medicine['Indications']); ?>" required>
                                </div>
                            </div>
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="Precautions">ข้อควรระวัง :</label>
                                    <input type="text" name="Precautions" class="form-control" value="<?php echo htmlspecialchars($medicine['Precautions']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="flexbox">
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="Contraindications">ข้อห้ามใช้ :</label>
                                    <input type="text" name="Contraindications" class="form-control" value="<?php echo htmlspecialchars($medicine['Contraindications']); ?>" required>
                                </div>
                            </div>
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="Effects">ผลข้างเคียงยา :</label>
                                    <input type="text" name="Effects" class="form-control" value="<?php echo htmlspecialchars($medicine['Effects']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="flexbox">
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="Dosage">วิธีใช้ยา :</label>
                                    <input type="text" name="Dosage" class="form-control" value="<?php echo htmlspecialchars($medicine['Dosage']); ?>" required>
                                </div>
                            </div>
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="UniPrice">ราคา :</label>
                                    <input type="text" name="UniPrice" class="form-control" value="<?php echo htmlspecialchars($medicine['UniPrice']); ?>" required>
                                </div>
                            </div>
                            <div class="item-2">
                                <div class="form-name">
                                    <label for="QuantityStock">จำนวนในสต็อก :</label>
                                    <input type="text" name="QuantityStock" class="form-control" value="<?php echo htmlspecialchars($medicine['QuantityStock']); ?>" required>
                                </div>
                            </div>
                            <div class="item-1">
                                <div>
                                    <form action="update_db.php" method="POST">
                                        <input type="hidden" name="MedID" value="<?php echo htmlspecialchars($medicine['MedID']); ?>">
                                        <button type="submit">
                                            <img class="img" src="P3.png" width="65" height="58" alt="Update">
                                        </button>
                                    </form>
                                    <form action="delete.php" method="GET" style="display:inline;">
                                        <input type="hidden" name="MedID" value="<?php echo htmlspecialchars($medicine['MedID']); ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this medicine?');">
                                            <img src="P2.png" width="65" height="58" alt="Delete">
                                        </button>
                                    </form>

                                </div>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>