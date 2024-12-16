<?php include('connection.php') ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="flexbox">
        <div class="item">
            <div class="content">
                <h1 style="color:#0071AE; font-size: 50px;">Welcome to Pharmacy</h1>
                <img class="img" src="P1.png" alt="Pharmacy Image">
            </div>
        </div>
        <div class="item">
            <div class="content">
                <h1 style="color:#0071AE; font-size: 50px;margin-bottom:5%">LOGIN</h1>
                <h2 style="color:#0071AE; font-size: 30px; margin-bottom:10%">Log in to check medicines in stock</h2>

                <form action="login_db.php" onsubmit = "return isvalid()" method="post">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div>
                            <h3>
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </h3>
                        </div>
                    <?php endif ?>
                    <div class="input-group my-3">
                        <span class="input-group-text rounded-pill" id="basic-addon1">
                            <i class="fas fa-user"></i>
                        </span>
                        <input class="form-control form-control-lg rounded-pill" type="text" name="UserID" placeholder="User ID" aria-label="User ID">
                    </div>

                    <div class="input-group my-3">
                        <span class="input-group-text bg-white rounded-pill" id="basic-addon2">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input class="form-control form-control-lg rounded-pill" type="password" name="IDNumber" placeholder="Password" aria-label="Password">
                    </div>
                    <button class="btn btn-primary rounded-pill" type="submit" value ="Login" name="submit" style="color:#0071AE;margin-top:10%; font-size: 25px; background-color: #B2F5FF; box-shadow:6px 6px 6px #9B9B9B">
                        LOGIN
                    </button>
                </form>
            </div>
            <script>
                function isvalid(){
                    var UserID = document.form.UserID.value;
                    var password = document.form.UserID.value;
                    if(UserID.length=="" && password.length=="" ){
                        alert("UserID and Password field is empty!!!");
                        return false
                    }
                    else {
                        if(UserID.length==""){
                        alert("UserID is empty!!!");
                        return false
                    }
                    if(password.length=="" ){
                    alert("Password is empty!!!");
                    return false
                    }
                }
            }
            </script>
        </div>

    </div>
</body>

</html>
