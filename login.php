<?php
// Connect to database
include 'connect.php';
// Start session
session_start();
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Get form data
  $id = $_POST['id'];
  $password = $_POST['password'];

  // Hash password
  $hashed_password = hash('sha256', $password);


  // Prepare SQL statement with parameterized query
  $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ? AND user_pass = ?");
  mysqli_stmt_bind_param($stmt, "is", $id, $hashed_password);

  // Execute SQL statement
  mysqli_stmt_execute($stmt);

  // Get query result
  $result = mysqli_stmt_get_result($stmt);

  // Check if user exists
  if (mysqli_num_rows($result) == 1) {
    // If user exists, get user's role
    $row = mysqli_fetch_assoc($result);
    $role = $row['user_role'];

    // Set session variables and redirect to products page for admin role
    $_SESSION['id'] = $id;
    $_SESSION['user_role'] = $role;
	header('location: productions.php');
  } else {
    // If user does not exist, display error message
    echo "<div class='container w-50 text-center p-2 text-bg-danger text-light'><h5>Invalid id or password.</h5></div>";
  }
} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
	<style type="text/css">
		body {
			background-color: #f7f7f7;
		}
		.form-signin {
			max-width: 380px;
			padding: 15px;
			margin: 0 auto;
			margin-top: 100px;
		}
		.form-signin .form-floating:focus-within {
			z-index: 2;
		}
		.form-signin input[type="text"],
		.form-signin input[type="password"] {
			margin-bottom: 20px;
			border-bottom-left-radius: 0;
			border-bottom-right-radius: 0;
		}
		.form-signin input[type="text"]:focus,
		.form-signin input[type="password"]:focus {
			z-index: 1;
		}
		.form-signin label {
			margin-bottom: 5px;
			font-weight: 500;
		}
	</style>
</head>
<body>
	<main class="form-signin">
			<form action="login.php" method="post" autocomplete="off">
				<h1 class=" mb-5 fw-bold fw-normal text-center">Login </h1>

				<label for="id" class="visually-hidden">ID</label>
				<input type="text" id="id" name="id" class="form-control rounded" placeholder=" ID" required autofocus>

				<label for="password" class="visually-hidden">Password</label>
				<input type="password" id="password" name="password" class=" rounded form-control" placeholder=" Password" required>

				<button class="w-100 btn btn-lg btn-success" type="submit" name="submit">Login</button>
				<button class="w-100 btn btn-lg btn-primary mt-2"><a class="px-2 py-2 text-decoration-none text-light" href="signup.php">Sign up</a></button>
			</form>
	</main>
</body>
</html>