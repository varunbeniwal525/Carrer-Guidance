<?php

include('connection.php');

if(isset($_POST['submit']))
{
    $cname=$_POST['course_name'];
    $subname=$_POST['sub_course'];
    $sub_cat_name=$_POST['sub_coursecat'];
    $fname=$_POST['fname'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $address=$_POST['address'];
    $password=md5($_POST['password']);
     $image=$_FILES["img"]["name"];
    $image1=$_FILES["img"]["tmp_name"];

    $path="userimages/$image";
    // directory creation for product images
    move_uploaded_file($image1,$path);
    

   
$query=mysqli_query($conn,"INSERT INTO users(courseid,categoryid,sub_courseid,fullname,email,mobile,address,password,userimage) values ('$cname','$subname','$sub_cat_name','$fname','$email','$mobile','$address','$password','$image')");

    if($query)
    {
        echo"succesfull";
        header("location:login.php");
        
    }
}
   ?>