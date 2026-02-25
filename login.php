<?php
	session_start();
    if(!empty($_SESSION['email'])) {
      header('location:index.php');
    }
	include 'connection.php';

	$usernameErr = $emailErr = $passwordErr = $retypepasswordErr = "";
    $username = $error = $password = $retypepassword = $error = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

	    // LOGIN PROCESS
	    if (isset($_POST['login'])) {
	        $email = $_POST['email'];
	        $pass = $_POST['pass'];

	        if (empty($email) || empty($pass)) {
	            $error = 'All fields are required';
	        } else {
	            $sql = "SELECT username, email, password FROM users WHERE email = ?";
	            $stmt = mysqli_prepare($conn, $sql);
	            mysqli_stmt_bind_param($stmt, "s", $email);
	            mysqli_stmt_execute($stmt);
	            $result = mysqli_stmt_get_result($stmt);
	            $row = mysqli_fetch_assoc($result);

	            if ($row && password_verify($pass, $row['password'])) {
	                $_SESSION['email'] = $row['email'];
	                $_SESSION['name'] = $row['username'];
	                header('location:index.php');
	                exit();
	            } else {
	                $error = "Email/Password is wrong";
	            }
	        }

	    }

	    // SIGNUP PROCESS
	    elseif (isset($_POST['singup'])) {

	        // Validation
	        if (empty($_POST["username"])) {
	            $usernameErr = "Username is required";
	        } else {
	            $username = $_POST["username"];
	        }

	        if (empty($_POST["signup_email"])) {
	            $emailErr = "Email is required";
	        } else {
	            $email = $_POST["signup_email"];
	        }

	        if (empty($_POST["password"])) {
	            $passwordErr = "Password is required";
	        } elseif (strlen($_POST["password"]) < 6) {
	            $passwordErr = "Password must be at least 6 characters long.";
	        } elseif (!preg_match('/[0-9]/', $_POST["password"])) {
	            $passwordErr = "Password must include at least one number.";
	        } elseif (!preg_match('/[\W]/', $_POST["password"])) {
	            $passwordErr = "Password must include at least one special character.";
	        } else {
	            $password = $_POST["password"];
	             $password = password_hash($password, PASSWORD_BCRYPT);
	        }

	        if (empty($_POST["c_password"])) {
	            $retypepasswordErr = "Password is required";
	        } elseif ($_POST['c_password'] !== $_POST['password']) {
	            $retypepasswordErr = "Password not matched";
	        } else {
	            $retypepassword = $_POST["c_password"];
	        }

	        // If no validation error, insert user
	        if (
	            empty($usernameErr) && empty($emailErr) &&
	            empty($passwordErr) && empty($retypepasswordErr)
	        ) {
	            $sql = "INSERT INTO users (`username`, `email`, `password`) VALUES (?, ?, ?)";
	            $stmt = mysqli_prepare($conn, $sql);
	            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
	            $store_result = mysqli_stmt_execute($stmt);

	            if ($store_result) {
	                $_SESSION['email'] = $email;
	                $_SESSION['name'] = $username;
	                header('location:index.php');
	                exit();
	            } else {
	                $error = "Validation Error, User not register.";
	            }
	        }
	    }
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login & Registration</title>
  <link rel="stylesheet" type="text/css" href="samiya/css/login.css">
</head>
<body>
  <div class="container" id="container">
    <div class="form-header" id="form-header">
      <h2 id="form-title">Login</h2>
      <div class="form-toggle" id="form-toggle-text">
        New here? <span id="toggle-button">Create an account</span>
      </div>
    </div>
    <?php if (isset($error) && !empty($error)) : ?>
	  <div class="custom-alert">
	    <?= htmlspecialchars($error) ?>
	  </div>
	<?php endif; ?>
    <!-- Login Form -->
    <form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-message" id="login-message"></div>
      <input type="email" id="login-email" name="email" placeholder="Email" required />
      <input type="password" id="login-password" name="pass" placeholder="Password" required />
      <input type="submit" value="Login" name="login" class="loginBtn" />
    </form>
    <!-- Registration Form -->
    <form id="register-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="hidden">
      <div class="form-message" id="register-message"></div>
      <input type="text" id="register-username" name="username" placeholder="Username" required />
      <div class="error">
          <small class="input-small"><?php echo $usernameErr; ?></small>
      </div>
      <input type="email" name="signup_email" id="register-email" placeholder="Email" required />
      <div class="error">
          <small class="input-small"><?php echo $emailErr; ?></small>
      </div>
      <input type="password" name="password" id="register-password" placeholder="Password" required />
      <div class="error">
          <small class="input-small"><?php echo $passwordErr; ?></small>
      </div>
      <input type="password" name="c_password" id="register-password-confirm" placeholder="Confirm Password" required />
      <div class="error">
          <small class="input-small"><?php echo $retypepasswordErr; ?></small>
      </div>

      <input type="submit" class="loginBtn" name="singup" value="Sign up" />
    </form>
  </div>

  <script type="text/javascript" src="samiya/js/login.js"></script>
</body>
</html>

