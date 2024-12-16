<?php
    session_start();
    include('connection.php');
    if(isset($_POST['submit'])) {
        $UserID =  mysqli_real_escape_string($conn, $_POST['UserID']);
        $IDNumber = mysqli_real_escape_string($conn, $_POST['IDNumber']);

        $sql = "SELECT * FROM users WHERE UserID = '$UserID' AND IDNumber = '$IDNumber'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count==1) {
            $_SESSION['UserID'] = $UserID;
            header("location:indexpu.php");
            exit();
        }
        else {
            echo '<script>
                window.location.href="Login.php";
                alert("Login failed. UserID or password")
            </script>';
        }
    }
?>


