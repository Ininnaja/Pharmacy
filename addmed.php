<?php include('connection.php') ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="page2.css"> <!-- ลิงก์ CSS เดียวกันกับหน้า indexpu.php -->
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo mb-4">
            <img src="user.png" alt="User Logo">
        </div>
        <p>Welcome <strong><?php echo $_SESSION['UserID']; ?></strong></p>
        <a href="indexpu.php" class="logo1 mb-4"><img src="medicine.png" alt="Medicine Icon"></a>
        <a href="addmed.php" class="logo2 mb-4"><img src="drop.png" alt="Add Medicine Icon"></a>
        <a href="#" class="logo3 mb-4"><img src="setting.png" alt="Settings Icon"></a>
        <?php if (isset($_SESSION['UserID'])) : ?>
            <a href="indexpu.php?logout=1" class="logo4 mb-4"><img src="exit.png" alt="Logout Icon"></a>
        <?php endif ?>
    </div>

    <div class="main-content" id="main-content">
        <!-- Header -->
        <header class="d-flex justify-content-between align-items-center">
            <!-- Hamburger button to toggle sidebar -->
            <span class="hamburger" id="hamburger">☰</span>

            <h1 class="mx-auto" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);"><strong>Medicines Details</strong>
            </h1>
        </header>
        <hr class="custom-hr">
        <br>

        <!-- Main Content Container -->
        <div class="container">
            <h2>Add a New Medicine</h2>
            <form action="insertmed.php" method="post" enctype="multipart/form-data">
                <input type="text" name="MedName" placeholder="Medicine Name" required><br>
                <input type="text" name="MedID" placeholder="MedID" required><br>
                <input type="text" name="price" placeholder="Price" required><br>
                <input type="text" name="reg_no" placeholder="Reg.No" required><br>
                <input type="text" name="indications" placeholder="สรรพคุณ" required><br>
                <input type="text" name="precautions" placeholder="ข้อควรระวัง" required><br>
                <input type="text" name="contraindications" placeholder="ข้อห้ามใช้" required><br>
                <input type="text" name="Effects" placeholder="ผลข้างเคียง" required><br>
                <input type="text" name="Dosage" placeholder="วิธีใช้ยา" required><br>
                <input type="file" name="Image" accept="image/png, image/jng, image/jpeg"><br>
                <input type="submit" value="ADD THE MEDICINE">
            </form>
        </div>
    </div>


    <script>
        // JavaScript to toggle sidebar visibility
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const hamburger = document.getElementById('hamburger');

        hamburger.addEventListener('click', function () {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('shifted');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
</body>

</html>