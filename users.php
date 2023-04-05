<?php
include'security_url.php';
include'adm.php'; 
include'connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css"><style>*{margin:0;padding:0;box-sizing:border-box;}</style>
    <title>Users</title><style>td{font-weight:bold;}</style>
</head>
<body style="height:100vh;display:flex;flex-direction:column;justify-content:space-between;"> 
<nav class="navbar bg-dark py-1">
    <div class="container-fluid">
        <a class="fs-2 text-light navbar-brand" href="#">SwiftStore</a> 
            <ul class="nav ms-auto">
                <?php if ($_SESSION['user_role'] === 'admin'){
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link text-light'href='users.php'>Users</a>
                    </li>
                    ";
                }
                ?> 
                <li class="nav-item">
                    <a class="nav-link text-light" href="productions.php">Productions</a>
                </li>
                <?php if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'supplier'){
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link text-light'href='add_product.php'>Add Product</a>
                    </li>
                    ";
                }
                ?> 
                <li class="nav-item">
                    <form action="logout.php" method="post"><button type="submit" name="logout" class="btn btn-danger">Logout</button></form>
                </li>
            </ul> 
    </div>
</nav>
<h1 class="fw-bold text-center">Users</h1>
<div class="container">
    <!-- Add a search form -->
    <form method="post" class=" w-50 my-3" autocomplete="off">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search...">
            <button type="submit" class="btn btn-primary">Search</button> 
        </div>
    </form>
<?php
  // Check if the search form was submitted
  if (isset($_POST['search'])) {
    // Get the search term from the form input
    $search = $_POST['search'];

    // Add a WHERE clause to the SQL query to filter the results
    $sql = "SELECT id, user_name, user_email, user_role, user_image FROM users WHERE id LIKE '%$search%' OR user_name LIKE '%$search%' OR user_email LIKE '%$search%' OR user_role LIKE '%$search%'";
  } else {
    $sql = "SELECT id, user_name, user_email, user_role, user_image FROM users";
  }
    // Execute the query and output the results in a table
    $result = $conn->query($sql);
    if ($result->num_rows > 0 ) {
        echo"
        <table class='table caption-top table-bordered border-dark'>
            <thead class='table-dark'>
                <tr>
                    <th scope=\'col\'>id</th>
                    <th scope=\'col\'>Username</th>
                    <th scope=\'col\'>Email</th>
                    <th scope=\'col\'>Role</th>
                    <th scope=\'col\'>Image</th>
                    <th scope=\'col\'>Operation</th>
                </tr>
            </thead>
            <tbody>";
    while($row = $result->fetch_assoc()) {
            $id=$row['id'];
            $username=$row['user_name'];
            $useremail=$row['user_email'];
            $userrole=$row['user_role'];
            $userimage=$row['user_image'];
            echo "<tr>
                <td>$id</td>
                <td>$username</td>
                <td>$useremail</td>
                <td>$userrole</td>
                <td class='img'><img src='$userimage'width='100px'height='100px'/></td>
                <td class=\"text-center\">
                    <button type='submit' class=' btn btn-danger'><a class=\"text-light text-decoration-none\" href=\"delete_user.php?deleteid=$id\">Delete</a></button>
                    <button type='submit' class=' btn btn-primary'><a class=\"text-light text-decoration-none\" href=\"update_user.php?updateid=$id\">Update</a></button>
                </td>
            </tr>";
    }
    echo"   </tbody>
    </table>";
    }
    else {
        echo "<br><b class='fs-2'>No results found.<b>";
    }
?>
</div>
<footer class="text-center bg-dark text-light py-1">
    <div class="container">
        <p class="mb-0">Copyright &copy; <?php echo date("Y"); ?> SwiftStore . All rights reserved.</p>
    </div>
</footer>
<script src="/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
