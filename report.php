<?php

require_once "connect.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}

  //CONVERTING HTML TO PHP
  if(isset($_POST['submit'])){
    $stationName = $_POST['stationName'];
    $caseDate = $_POST['caseDate'];
    $caseTime = $_POST['caseTime'];
    $victimGender = $_POST['victimGender'];
    $caseDescription = $_POST['caseDescription'];
}

//ensuring that data is valid....error handling logic gate
if(empty($stationName)){
    echo '<script>alert("A Name is required")</script>';
}
else if(empty($caseDate)){
    echo '<script>alert("Date is required")</script>';
}
else if(empty($caseTime)){
    echo '<script>alert("Time is required")</script>';
}
else if(empty($victimGender)){
    echo '<script>alert("Gender is required")</script>';
}
else if(empty($caseDescription)){
    echo '<script>alert("Description is required")</script>';
}
//If data is clean then we feed it to the DB
else{
    $sql = "INSERT INTO cases(stationName, caseDate,caseTime,victimGender,caseDescription)
            VALUES('$stationName', '$caseDate','$caseTime','$victimGender','$caseDescription')";
}
 //Feedback if data has been inserted
if(isset($_POST['submit'])){
    if(mysqli_query($conn, $sql)){
        echo '<script>alert("Your details have been captured. We are solving your case in a few.")</script>';
    }
    else{
        echo '<script>alert("Error: Information was not captured well. Try again!!")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report incidence</title>
    <link rel="stylesheet" href="report.css">
</head>

<body>

    <div class="topbar">
        <div id="logo">
            <img src="./img/cuff.png">
            <h1><span class="highlight">Report </span>Crimes</h1>
        </div>
    </div>

    <div style="float: right;">
    <p>
        <a href="reset.php" class="btn btn-warning" style="background-color: gray;color: white;padding: 12px 20px;border: none;border-radius: 4px;cursor: pointer;text-decoration: none;">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger" style="background-color: gray;color: white;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;text-decoration: none;">Log out</a>
    </p>
</div><br>


    <div class="container">
        <div class="top">
            <h1>Report incidence</h1>
            <p>Incident Reporting Form</p>
        </div>
       <h1>Case reporting</h1>
       <p>We deal with your reported cases according to how you present them</p>
<p>First of all choose a reporting station near you</p>
<p>After that you will be redirected to a page that allows you to report your case.</p>

<ol>
<a href="station.php"><li>Station selection</li></a>

</ol>










    


</body>

</html>