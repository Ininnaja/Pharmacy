<?php
include('connection.php');
session_start();

// ตรวจสอบการเข้าสู่ระบบ
if (!isset($_SESSION['UserID'])) {
    $_SESSION['msg'] = "You must login first!!";
    header('location:Login.php');
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['UserID']);
    header('location:Login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo mb-4">
            <img src="user.png" alt="User Logo">
        </div>

        <p>Welcome <strong><?php echo $_SESSION['UserID']; ?></strong></p>

        <a href="#" class="logo1 mb-4"><img src="medicine.png" alt=""></a>
        <a href="addmed.php" class="logo2 mb-4"><img src="drop.png" alt=""></a>
        <a href="#" class="logo3 mb-4"><img src="setting.png" alt=""></a>
        <?php if (isset($_SESSION['UserID'])) : ?>
            <a href="indexpu.php?logout=1" class="logo4 mb-4"><img src="exit.png" alt=""></a>
        <?php endif ?>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Header -->
        <header class="d-flex justify-content-between align-items-center">
            <span class="hamburger" id="hamburger">☰</span>
            <h1 class="mx-auto" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);"><strong>Medicines Details</strong></h1>
        </header>
        <hr class="custom-hr">
        <br>

        <!-- Search bar -->
        <input type="search" id="search-bar" class="form-control form-control-light search-input mb-4" placeholder="Search...">

        <!-- Medicine Cards -->
        <div id="medicine-container">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM medicine");

            while ($medicine = mysqli_fetch_assoc($result)) {
            ?>
                <div class="medicine-card" data-name="<?php echo strtolower($medicine['MedName']); ?>">
                    <div class="medicine">
                        <div class="pic">
                            <img src="uploads/<?php echo $medicine['Image']; ?>" alt="Medicine Image">
                        </div>
                        <div class="medicine-info">
                            <h2><?php echo $medicine['MedName']; ?></h2><br>
                            <p><strong>สรรพคุณ</strong>: <?php echo $medicine['Indications']; ?></p>
                            <p><strong>ข้อควรระวัง</strong>: <?php echo $medicine['Precautions']; ?></p>
                            <p><strong>ผลข้างเคียง</strong>: <?php echo $medicine['Effects']; ?></p>
                            <p><strong>วิธีการใช้</strong>: <?php echo $medicine['Dosage']; ?></p><br>
                            <p><strong>Reg. No.</strong> <?php echo $medicine['RegNo']; ?></p>
                        </div>
                        <div class="medicine-actions">
                            <h2><strong>MedID :</strong> <?php echo $medicine['MedID']; ?></h2><br><br>
                            <h2>ราคา: <?php echo $medicine['UniPrice']; ?> บาท</h2>
                        </div>
                        <div class="medicine-end">
                            <a href="update.php?MedID=<?php echo $medicine['MedID']; ?>"><img src="edit.png" alt="Edit"></a>
                            <a href="stock.php?MedID=<?php echo $medicine['MedID']; ?>"><img src="stock.png" alt="Stock"></a>
                            
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <br>
    </div>

    <!-- JavaScript -->
    <script>
        // Toggle sidebar visibility
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const hamburger = document.getElementById('hamburger');

        hamburger.addEventListener('click', function() {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('shifted');
        });

        // ฟังก์ชันสำหรับค้นหายา
        const searchBar = document.getElementById('search-bar');
        const medicineCards = document.querySelectorAll('.medicine-card');

        searchBar.addEventListener('input', function () {
            const searchText = searchBar.value.toLowerCase();

            medicineCards.forEach(card => {
                const medicineName = card.getAttribute('data-name');
                if (medicineName.includes(searchText)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
</body>

</html>
