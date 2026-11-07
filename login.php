<?php
session_start();
require_once 'config/koneksi.php';
require_once 'config/helper.php';
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="foto/logo.png">
    <link rel="stylesheet" href="login.css">
    <title>iBarCrafts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container" id="container">
        <!-- Form Register -->
            <div class="form-container sign-up">
                <form method="POST" action="">
                    <h1>Create Account</h1>
                    <input type="text" name="nama" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="number" name="telepon" placeholder="telepon" required>
                    <input type="submit" name="register" value="Sign Up" class=" btn btn-warning">
                </form>

                <?php
// ...
if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $password = $_POST['password'];

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email is already registered
    $cek_email = $koneksi->prepare("SELECT * FROM pelanggan WHERE email_pelanggan = ?");
    $cek_email->bind_param("s", $email);
    $cek_email->execute();
    $result_email = $cek_email->get_result();

    if ($result_email->num_rows > 0) {
        echo "<div class='alert alert-danger'>Email telah digunakan</div>";
    } else {
        // Insert new user to 'pelanggan' table dengan password yang sudah di-hash
        $register_query = $koneksi->prepare("INSERT INTO pelanggan (nama_pelanggan, email_pelanggan, telepon_pelanggan, password_pelanggan) VALUES (?, ?, ?, ?)");
        $register_query->bind_param("ssss", $nama, $email, $telepon, $hashed_password);

        if ($register_query->execute()) {
            echo "<div class='alert alert-success'>Registrasi berhasil</div>";
            header("Location: login.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Registrasi Gagal</div>";
            echo "<meta http-equiv='refresh' content='1;url=login.php'>";
        }

        $register_query->close();
    }

    $cek_email->close();
}

?>

            </div>

        <div class="form-container sign-in">
        <form method="POST" action="">
                <h1>Sign In</h1>
                <input type="email" name="user" placeholder="Email">
                <input type="password" name="pass" placeholder="Password">
                <a href="lupapassword.php">Forget Your Password?</a>
                <button type="submit" name="login" class="btn btn-warning">Sign In</button>
            </form>

            
            <?php
        if (isset($_POST['login'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            // Cek di tabel 'admins' dengan password_verify
            $admin_query = $koneksi->prepare("SELECT * FROM admins WHERE username = ?");
            $admin_query->bind_param("s", $user);
            $admin_query->execute();
            $admin_result = $admin_query->get_result();
            $admin_query->close();

            $admin_data = null;
            $admin_login_ok = false;

            if ($admin_result->num_rows == 1) {
                $admin_data = $admin_result->fetch_assoc();
                // Cek password: support password_verify ATAU plain text (untuk data lama)
                if (password_verify($pass, $admin_data['passwords'])) {
                    $admin_login_ok = true;
                } elseif ($admin_data['passwords'] === $pass) {
                    // Password lama plain text - update ke hash
                    $new_hash = password_hash($pass, PASSWORD_DEFAULT);
                    $update_admin = $koneksi->prepare("UPDATE admins SET passwords = ? WHERE username = ?");
                    $update_admin->bind_param("ss", $new_hash, $user);
                    $update_admin->execute();
                    $update_admin->close();
                    $admin_login_ok = true;
                }
            }

            if (!$admin_login_ok) {
                // Cek di tabel 'pelanggan' dengan password_verify
                $pelanggan_query = $koneksi->prepare("SELECT * FROM pelanggan WHERE email_pelanggan = ?");
                $pelanggan_query->bind_param("s", $user);
                $pelanggan_query->execute();
                $pelanggan_result = $pelanggan_query->get_result();

                if ($pelanggan_result->num_rows == 1) {
                    $pelanggan_data = $pelanggan_result->fetch_assoc();
                    // Cek password: support password_verify ATAU plain text (untuk data lama)
                    if (password_verify($pass, $pelanggan_data['password_pelanggan'])) {
                        // Regenerate session ID untuk mencegah session fixation
                        session_regenerate_id(true);
                        $_SESSION['pelanggan'] = $pelanggan_data;
                        echo "<div class='alert alert-info'>Pelanggan login successful</div>";
                        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                    } elseif ($pelanggan_data['password_pelanggan'] === $pass) {
                        // Password lama plain text - update ke hash
                        $new_hash = password_hash($pass, PASSWORD_DEFAULT);
                        $update_pelanggan = $koneksi->prepare("UPDATE pelanggan SET password_pelanggan = ? WHERE email_pelanggan = ?");
                        $update_pelanggan->bind_param("ss", $new_hash, $user);
                        $update_pelanggan->execute();
                        $update_pelanggan->close();
                        session_regenerate_id(true);
                        $_SESSION['pelanggan'] = $pelanggan_data;
                        echo "<div class='alert alert-info'>Pelanggan login successful</div>";
                        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                    } else {
                        echo "<div class='alert alert-danger'>Login failed</div>";
                        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Login failed</div>";
                    echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                }
                $pelanggan_query->close();
            } else {
                session_regenerate_id(true);
                $_SESSION['admin'] = $admin_data;
                echo "<div class='alert alert-info'>Admin login successful</div>";
                echo "<meta http-equiv='refresh' content='1;url=admin/index.php'>";
            }
        }
        ?>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>REGISTER</h1>

                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>WELCOME</h1>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="login.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>