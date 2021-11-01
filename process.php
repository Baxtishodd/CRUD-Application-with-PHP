<?php

   // session_start();

   $dbhost = 'localhost';
   $dbuser = 'tatu_user';
   $dbpass = '12345';
   $dbname = 'tatudb';

   $id = 0;
   $update = false;
   $firstname = "";
   $lastname = "";
   $phonenumber = "";

  

   
   $mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

   if(! $mysqli ) {
      die('Could not connect: ' . mysql_error());
   }
   
   if (isset($_POST['save'])){
   	$firstname = $_POST['firstname'];
   	$lastname = $_POST['lastname'];
      $phonenumber = $_POST['phonenumber'];

      setcookie($firstname, $lastname, $phonenumber, time() + (86400 * 30), '/');
      setcookie($lastname, $firstname, $phonenumber, time() + (86400 * 30), '/');

      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $phonenumber = $_POST['phonenumber'];



   	$mysqli -> query("INSERT INTO data (firstname, lastname, phonenumber) VALUES ('$firstname', '$lastname', '$phonenumber')") or
         die($mysqli -> error);

         echo "<p  align=center style='
         background-color: #5dd048;
         padding: 20px;
         border: none;
         width: 100%;
         margin-left: -10px;
         margin-top: -10px;
         '><a style='text-decoration: none;
         color: white;
         font-size: 18px;' href='index.php'>Successfully saved your data! | $firstname | $lastname | $phonenumber | :)</a></p";
   

      // $_SESSION['message'] = "Record has been saved!";
      // $_SESSION['msg_type'] = "success";

      // header("location: index.php");
   }

   if(isset($_GET['delete'])){
      $id = $_GET['delete'];
      $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

      // $_SESSION['message'] = "Record has been deleted!";
      // $_SESSION['msg_type'] = "danger";

      echo "<p align=center style='
      background-color: #ff95a4;
      padding: 20px;
      border: none;
      width: 100%;
      margin-left: -10px;
      margin-top: -10px;
      '><a  href='index.php' style='text-decoration: none;
      color: white;
      font-size: 18px;'>Successfully deleted your data!</a></p>";

      
      // header("location: index.php");
   }
   if (isset($_GET['edit'])){
      $id = $_GET['edit'];
      $update = true;
      $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
      if (count($result)==1){
         $row = $result->fetch_array();
         $firstname = $row['firstname'];
         $lastname = $row['lastname'];
         $phonenumber = $row['phonenumber'];
      }
   }
   if (isset($_POST['update'])){
      $id = $_POST['id'];
   
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $phonenumber = $_POST['phonenumber'];

      $mysqli->query("UPDATE data SET firstname='$firstname', lastname='$lastname', phonenumber='$phonenumber' WHERE id=$id;") or die($mysqli->error);
      
      echo "<p align=center style='
      background-color: #2fa7d6;
      padding: 20px;
      border: none;
      width: 100%;
      margin-left: -10px;
      margin-top: -10px;
      '><a  href='index.php' style='text-decoration: none;
      color: white;
      font-size: 18px;'>Successfully updated your data! | $firstname | $lastname | $phonenumber | :)</a></p>";
      
   }

   
?>