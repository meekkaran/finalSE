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
$stationName = $caseCategory = $caseDate = $caseTime = $victimGender =$caseDescription="";
$stationName_err = $caseCategory_err = $caseDate_err = $caseTime_err= $victimGender_err= $caseDescription_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // validate stationName
    if(empty(trim($_POST["stationName"]))){
        $stationName_err = "Please enter a stationName.";
    } else{
        // Prepare a select statement
        $sql = "SELECT caseId FROM station WHERE stationName = ?";
        
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
    
      // validate caseCategory
      if(empty(trim($_POST["caseCategory"]))){
        $caseCategory_err = "Please enter a caseCategory.";
    } else{
        // Prepare a select statement
        $sql = "SELECT caseId FROM station WHERE caseCategory = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_caseCategory);
            
            // Set parameters
            $param_caseCategory = trim($_POST["caseCategory"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $caseCategory_err = "This caseCategory is already taken.";
                } else{
                    $caseCategory = trim($_POST["caseCategory"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
/*
       // validate caseDate
       if(empty(trim($_POST["caseDate"]))){
        $caseDate_err = "Please enter a caseDate.";
    } else{
        // Prepare a select statement
        $sql = "SELECT caseId FROM station WHERE caseDate = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_caseDate);
            
            // Set parameters
            $param_caseDate = trim($_POST["caseDate"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                 //store result 
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $caseDate_err = "This caseDate is already taken.";
                } else{
                    $caseDate = trim($_POST["caseDate"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

      // validate caseTime
      if(empty(trim($_POST["caseTime"]))){
        $caseTime_err = "Please enter a caseTime.";
    } else{
        // Prepare a select statement
        $sql = "SELECT caseId FROM station WHERE caseTime = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_caseTime);
            
            // Set parameters
            $param_caseTime = trim($_POST["caseTime"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //store result 
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $caseTime_err = "This caseTime is already taken.";
                } else{
                    $caseTime= trim($_POST["caseTime"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

     // validate victimGender
     if(empty(trim($_POST["victimGender"]))){
        $victimGender_err = "Please enter a victimGender.";
    } else{
        // Prepare a select statement
        $sql = "SELECT caseId FROM station WHERE victimGender = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_victimGender);
            
            // Set parameters
            $param_victimGender = trim($_POST["victimGender"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //store result
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $victimGender_err = "The gender is already choosen.";
                } else{
                    $victimGender= trim($_POST["victimGender"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }*/

     // validate caseDescription
     if(empty(trim($_POST["caseDescription"]))){
        $caseDescription_err = "Please enter a caseDescription.";
    } else{
        // Prepare a select statement
        $sql = "SELECT caseId FROM station WHERE caseDescription = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_caseDescription);
            
            // Set parameters
            $param_caseDescription = trim($_POST["caseDescription"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $caseDescription_err = "This caseDescription is already taken.";
                } else{
                    $caseDescription= trim($_POST["caseDescription"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Check input errors before inserting in database
    if(empty($stationName_err) && empty($caseCategory_err) && empty($caseDescription_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO cases (stationName, caseCategory, caseDescription) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_stationName, $param_caseCategory, $param_caseDescription );
            
            // Set parameters
            $param_stationName = $stationName;
            $param_caseCategory = $caseCategory;
            $param_caseDescription=$caseDescription;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to cases page
                header("success");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case</title>
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
    align-items:center;
    
    }/* CSS Document */
    
    </style>
</head>
<body>

<h1><a href="index.php">Home</a></h1>

                
                <div class="container">
<h2 style="color: black;">Case Form</h2>
<select id="Case category" name="caseCategory">
                    <option value="1">Select Case Category</option>
                    <option value="2">Theft</option>
                    <option value="3">Wanted</option>
                    <option value="4">Assault</option>
                    <option value="5">Robbery</option>
                    <option value="6">Domestic Violence/Rape</option>
                    <option value="7">Miscellenous</option>
                </select>
<br></br>
                <select name="stationNames">
                    <option value="">Re-Select Station to report the case</option>
                    <option value="1">Makupa</option>
                    <option value="2">Chaani</option>
                    <option value="3">Ongata</option>
                    <option value="4">Langata Baracks</option>
                    <option value="5">Westlands</option>
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

                <p>After selecting the above fill the form below</p>
        <p style="color: black;">Please fill this form to Record your case.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div <?php echo (!empty($caseCategory_err)) ? 'has-error' : ''; ?>>
                <label>caseCategory</label>
                <input type="text" name="caseCategory" class="form-control" placeholder="caseCategory" value="<?php echo $caseCategory; ?>">
                <span class="help-block"><?php echo $caseCategory_err; ?></span>
            </div> 
            <br>   
            <div <?php echo (!empty($stationName_err)) ? 'has-error' : ''; ?>>
                <label>stationName</label>
                <input type="text" name="stationName" class="form-control" placeholder="stationName" value="<?php echo $stationName; ?>">
                <span class="help-block"><?php echo $stationName_err; ?></span>
            </div> 
        
            <br>   
                    
            
            <div <?php echo (!empty($caseDescription_err)) ? 'has-error' : ''; ?>>
                <label>caseDescription</label>
                <input type="text" name="caseDescription" class="form-control" placeholder="caseDescription" value="<?php echo $caseDescription; ?>" >
                <span class="help-block"><?php echo $caseDescription; ?></span>
            </div>
            
            <br>
            <div >
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <p style="color: black; display:none;">Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
</div> 
                
</body>
</html>