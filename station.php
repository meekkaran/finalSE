<?php
require_once "connect.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}

// Define variables and initialize with empty values
$stationName = $stationAddress = $stationContact = "";
$stationName_err = $stationAddress_err = $stationContact_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // validate stationName
    if(empty(trim($_POST["stationName"]))){
        $stationName_err = "Please enter a stationName.";
    } else{
        // Prepare a select statement
        $sql = "SELECT stationId FROM station WHERE stationName = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_stationName);
            
            // Set parameters
            $param_stationName = trim($_POST["stationName"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $stationName_err = "This stationName is already taken.";
                } else{
                    $stationName = trim($_POST["stationName"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
      // validate stationAddress
      if(empty(trim($_POST["stationAddress"]))){
        $stationName_err = "Please enter a stationAddress.";
    } else{
        // Prepare a select statement
        $sql = "SELECT stationId FROM station WHERE stationAddress = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_stationAddress);
            
            // Set parameters
            $param_stationAddress = trim($_POST["stationAddress"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $stationAddress_err = "This stationAddress is already taken.";
                } else{
                    $stationAddress = trim($_POST["stationAddress"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

       // validate stationContact
       if(empty(trim($_POST["stationContact"]))){
        $stationName_err = "Please enter a stationContact.";
    } else{
        // Prepare a select statement
        $sql = "SELECT stationId FROM station WHERE stationContact = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_stationContact);
            
            // Set parameters
            $param_stationContact = trim($_POST["stationContact"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $stationContact_err = "This stationContact is already taken.";
                } else{
                    $stationContact = trim($_POST["stationContact"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Check input errors before inserting in database
    if(empty($stationName_err) && empty($stationAddress_err) && empty($stationContact_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO station (stationName, stationAddress, stationContact) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_stationName, $param_stationAddress, $stationContact);
            
            // Set parameters
            $param_stationName = $stationName;
            $param_stationAddress = $stationAddress;
            $param_stationContact= $stationContact;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to cases page
                header("location: case.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($connection);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wstationidth=device-wstationidth, initial-scale=1.0">
    <title>Station</title>
    
    
    <style>
    /* Style the submit button with a specific background color etc */

    .login-box{
width: 300px;
position: absolute;
top:0%;
left: 50%;
transform: translate(-50%,20%);
color: black;
display: ;

}
.login-box #hl{

	float: left;
	font-size: 40px;
	border-bottom: 6px solid #4caf50;
	margin-bottom: 50px;
	padding: 13px 0;

}

.textbox{
	width: 100%;
	overflow: hidden;
	font-size: 20px;
	padding:8px 0;
	margin: 8px 0;
	border-bottom:1px solid; 
}

.textbox i{
	width: 26px;
	float: left;text-align: center;
}

.textbox input{
	border: none;
	outline: none;
	background: none;
}
.btn{
	width: 100%;
	background: none;
	border: 2px solid black;
	color: red;
	padding: 5px;
	font-size: 18px;
	cursor: pointer;
	margin: 12px;
}
input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }
    /* When moving the mouse over the submit button, add a darker green color */
    input[type=submit]:hover {
    background-color: #45a049;
    }
    /* Style the submit button with a specific background color etc */
    input[type=reset] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }
    /* When moving the mouse over the submit button, add a darker green color */
    input[type=reset]:hover {
    background-color: #45a049;
    }
    /* Add a background color and some padding around the form */
    .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    height:550px;
    width:550px;
    position: absolute;
    top:0%;
    left: 50%;
    transform: translate(-50%,20%);
    color: black;
    
    }/* CSS Document */
    
    </style>
</head>
<body>

<div class="container">
<form method="post">
<select name="stationNames">
                    <option value="">Select Station to report the case</option>
                    <option value="1">Makupa</option>
                    <option value="2">Chaani</option>
                    <option value="3">Ongata</option>
                    <option value="4">Langata Baracks</option>
                    <option value="5">Westlands</option>
                    <option value="6">Docks</option>
                    <option value="6">Docks</option>
                    <option value="7">Ballerina</option>
                    <option value="8">Bamburi</option>
                    <option value="9">Mtwapa</option>
                    <option value="10">Runda</option>
                    <option value="11">Kibokoni</option>
                    <option value="12">Tewa</option>
                    <option value="13">Mewa</option>
                    <option value="14">Markiti</option>
                    <option value="15">Docks</option>
                    <option value="16">Changamwe</option>
                    <option value="17">LA</option>
                    <option value="18">Pari</option>
                    <option value="19">Afrique</option>
                    <option value="20">Kanji</option>
                    <option value="21">wwerdja</option>

                </select>
                <br>
                </br>
<select name="stationAddresss" >
<option value="">Select address </option>
<option value="1">3910, Makupa</option>
<option value="2">5040, Chaani</option>
<option value="3">4567, Ongata</option>
<option value="4">2390, Langata Baracks</option>
<option value="5">5098, Westlands</option>
<option value="6">6790, Docks</option>
                    <option value="7"> 23456,Ballerina</option>
                    <option value="8">2456,Bamburi</option>
                    <option value="9">23456,Mtwapa</option>
                    <option value="10">5678,Runda</option>
                    <option value="11">789876,Kibokoni</option>
                    <option value="12">7653456,Tewa</option>
                    <option value="13">123456,Mewa</option>
                    <option value="14">776534,Markiti</option>
                    <option value="15">0876234,Docks</option>
                    <option value="16">3456,Changamwe</option>
                    <option value="17">643345,LA</option>
                    <option value="18">345654,Pari</option>
                    <option value="19">234654,Afrique</option>
                    <option value="20">345677,Kanji</option>
                    <option value="21">87458,wwerdja</option>


</select>
<br>
</br>
<select name="stationContacts" >
<option value="">Select Contacts </option>
<option value="1">020-238712, Makupa</option>
<option value="2">020-456789, Chaani</option>
<option value="3">020-999567, Ongata</option>
<option value="4">020-333999, Langata Baracks</option>
<option value="5">020-433567, Westlands</option>
<option value="6">020-456790, Docks</option>
<option value="6">020-546777,Mtongwe</option>
                    <option value="7">020-45678,Ballerina</option>
                    <option value="8">020-345687,Bamburi</option>
                    <option value="9">020-234566,Mtwapa</option>
                    <option value="10">020-564372,Runda</option>
                    <option value="11">020-456789,Kibokoni</option>
                    <option value="12">020-345667,Tewa</option>
                    <option value="13">020-2345677,Mewa</option>
                    <option value="14">020-45678765,Markiti</option>
                    <option value="15">020-34567888,Docks</option>
                    <option value="16">020-452678929,Changamwe</option>
                    <option value="17">020-56980000,LA</option>
                    <option value="18">020-367323,Pari</option>
                    <option value="19">020-3456765,Afrique</option>
                    <option value="20">020-4212121,Kanji</option>
                    <option value="21">020-2345554,wwerdja</option>

</select>

<p>After selecting type them down here.</p>
<h2 style="color: black;">Station Selection</h2>
        <p style="color: black;">Please fill this form to select a station.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div <?php echo (!empty($stationName_err)) ? 'has-error' : ''; ?>>
                <label>stationName</label>
                <input type="text" name="stationName" class="form-control" placeholder="stationName" value="<?php echo $stationName; ?>">
                <span class="help-block"><?php echo $stationName_err; ?></span>
            </div> 
            <br>   
            <div <?php echo (!empty($stationAddress_err)) ? 'has-error' : ''; ?>>
                <label>Address</label>
                <input type="text" name="stationAddress" class="form-control" placeholder="stationAddress" value="<?php echo $stationAddress; ?>">
                <span class="help-block"><?php echo $stationAddress_err; ?></span>
            </div>
            <br>
            <div <?php echo (!empty($stationContact_err)) ? 'has-error' : ''; ?>>
                <label>Contact</label>
                <input type="text" name="stationContact" class="form-control" placeholder="contact" value="<?php echo $stationContact; ?>">
                <span class="help-block"><?php echo $stationContact; ?></span>
            </div>
            
            <div >
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <p style="color: black; display:none;">Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
</div> 
                </form>
</body>
</html>