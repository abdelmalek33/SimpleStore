<?php 
if(isset($_POST['submit'])){
    
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description']; 
    // Move the uploaded file to the "photos" directory
    // Get the uploaded file data using the $_FILES superglobal
    $photo_tmp_name = $_FILES['product_photo']['tmp_name'];
    $photo_name = $_FILES['product_photo']['name'];
    $photo_path = "images_productions/".$photo_name;

    
    // Prepare and bind the SQL query
    $sql = "insert into productions (product_name, product_price, product_description, product_photo)
    values(?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("sdss", $product_name, $product_price, $product_description, $photo_path);
    move_uploaded_file($photo_tmp_name, $photo_path);
    
    // Execute the query and check for errors
    if ($stmt->execute()) {
        echo "<pre><div style=\"padding:5px;text-align:center;\" class=\"text-bg-success\">"." \^_^/ Data inserted successfully \^_^/
--> You can see the product in main page <--
</div></pre>";
    } else {
        die(mysqli_error($conn));
    }

}