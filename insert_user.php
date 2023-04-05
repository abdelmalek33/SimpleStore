<?php 

if(isset($_POST['submit'])){

    $user_name=$_POST['user_name'];
    $user_email=$_POST['user_email'];
    $user_role=$_POST['user_role'];
    
    $user_image=$_FILES['user_image'];
    $image_location=$_FILES['user_image']['tmp_name'];
    $image_name = $_FILES['user_image']['name'];
    $image_up="images_users/".$image_name;
    
    $user_pass=$_POST['user_pass'];
    // Hash password
    $user_pass = hash('sha256', $user_pass);

    $sql="insert into users(user_name,user_pass,user_email,user_role,user_image) 
    values(?,?,?,?,?)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssss",$user_name,$user_pass,$user_email,$user_role,$image_up);
    $result= $stmt->execute();
    
    move_uploaded_file($image_location,$image_up);
    
    $inserted_id = $stmt->insert_id; // Get the ID of the inserted row

    if ($result) {
        echo "<pre><div style=\"padding:10px;text-align:center;\" class=\"text-bg-success\">"." \^_^/ Data inserted successfully \^_^/
<b>--> User ID: $inserted_id <--</b>
--> Now go to login page to enter to your account <--
</div></pre>";
    }else{
        die(mysqli_error($conn));
    }

}