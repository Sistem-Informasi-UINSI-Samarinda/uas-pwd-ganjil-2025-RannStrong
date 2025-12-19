<?php
session_start();
require "../koneksi.php";

if(isset($_SESSION['login'])) { header('location: index.php'); } // Jika sudah login, lempar ke index
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login | Manchester United</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body style="background: #1a1a1a;">
    <div style="width: 350px; margin: 100px auto; background: white; padding: 30px; border-radius: 10px;">
        <h2 style="text-align: center; color: #DA291C;">Admin Manchester Utd</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="loginbtn" class="btn btn-primary" style="width:100%;">Login</button>
        </form>
        <?php
        if(isset($_POST['loginbtn'])){
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = $_POST['password'];
            $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
            
            if(mysqli_num_rows($query) > 0){
                $data = mysqli_fetch_array($query);
                if(password_verify($password, $data['password'])){
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['login'] = true;
                    header('location: index.php');
                } else { echo "<p style='color:red;'>Password Salah!</p>"; }
            } else { echo "<p style='color:red;'>Username tidak ditemukan!</p>"; }
        }
        ?>
    </div>
</body>
</html>