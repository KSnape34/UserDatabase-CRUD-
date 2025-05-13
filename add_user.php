<?php 

include "conn.php";

// define variables and set to empty values
$first_nameErr = $surnameErr = $emailErr = $genderErr = "";
$first_name = $surname = $email = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //Validate name
  $input_first_name = trim($_POST["first_name"]);
  if (empty([$input_first_name])) {
    $first_nameErr = "Name is required";
    } elseif(!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $first_nameErr = "Please enter a valid name.";
    } else{
        $first_name = $input_first_name;
    }
  
  $input_surname = trim($_POST["surname"]);
  if (empty([$input_surname])) {
    $surnameErr = "Name is required";
    } elseif(!filter_var($input_surname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $surnameErr = "Please enter a valid name.";
    } else{
        $surname = $input_surname;
    }

  // Validate email
    
  $input_email = trim($_POST["email"]);
  if (empty([$input_email])) {
    $emailErr = "Email is required";
    } elseif(!filter_var($input_email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/")))){
        $emailErr = "Please enter a valid email.";
    } else{
        $email = $input_email;
    }

    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Please select a gender.";
    } else{
    $gender = $input_gender;
    }

        // Check input errors before inserting in database
    if(empty($first_nameErr) && empty($surnameErr) && empty($emailErr) && empty($genderErr)){
        // Prepare an insert statement
        $sql = "INSERT INTO users (/*id,*/ first_name, surname, email, gender) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_first_name, $param_surname, $param_email, $param_gender);

            // Set parameters
            $param_first_name = $first_name;
            $param_surname = $surname;
            $param_email = $email;
            $param_gender = $gender;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}

/*function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string ($conn, $_POST['first_name']);
    $surname = mysqli_real_escape_string ($conn, $_POST['surname']);
    $email = mysqli_real_escape_string ($conn, $_POST['email']);
    $gender = $_POST['gender'];

    // validate first name
    

    $sql = "INSERT INTO `users`(`id`, `first_name`, `surname`, `email`, `gender`) 
    VALUES (NULL,'$first_name','$surname','$email','$gender')";

    $result = mysqli_query($conn, $sql);

    if($result) {
        header("Location: index.php?msg=New record created successfully");
    }
    else {
        echo "Failed: " . mysqli_error($conn);
    }
}*/

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP USER DATABASE APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<script>
 
 function validateForm() {
      var first_name = document.forms["userForm"]["first_name"].value;
      var surname = document.forms["userForm"]["surname"].value;
      var email = document.forms["userForm"]["email"].value;
      var gender = document.forms["userForm"]["gender"].value;

      var nameRegex = /^[a-zA-Z ]+$/;
      var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;

      if (!first_name.match(nameRegex)) {
        alert("Please enter a valid first name.");
        return false;
      }

      if (!surname.match(nameRegex)) {
        alert("Please enter a valid last name.");
        return false;
      }

      if (!email.match(emailRegex)) {
        alert("Please enter a valid email address.");
        return false;
      }
      
      if (gender === "") {
        alert("Please select a gender.");
        return false;
     }
      
      return true;
    }

</script>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5"
    style="background: #2A7B9B;
background: linear-gradient(90deg,rgba(42, 123, 155, 1) 0%, rgba(87, 199, 133, 1) 50%, rgba(237, 221, 83, 1) 100%);">
    CRUD PHP USER DATABASE APP 
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New User</h3>
            <p class="text-muted"> Complete the form below to add a new user</p>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <form name="userForm" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="width: 50vw; min-width: 300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First Name:</label>
                    <input type="text" autocomplete="off" class="form-control <?php echo (!empty($first_nameErr)) ? 'is-invalid' : ''; ?>" name="first_name" value="<?php echo $first_name; ?>" placeholder="Amy">
                    <span class="error">* <?php echo $first_nameErr;?></span>
                </div>

                <div class="col">
                    <label class="form-label">Surname:</label>
                    <input type="text" autocomplete="off" class="form-control <?php echo (!empty($surnameErr)) ? 'is-invalid' : ''; ?>" name="surname" value="<?php echo $surname; ?>" placeholder="Claren">
                    <span class="error">* <?php echo $surnameErr;?></span>
                </div>
                
            </div>

            <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" autocomplete="off" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" name="email" value="<?php echo $email; ?>" placeholder="name@example.com">
                    <span class="error">* <?php echo $emailErr;?></span>
            </div>

            <div class="form-group mb-3">
                <label>Gender:</label> &nbsp;
                          <select name="gender" class="form-control <?php echo (!empty($genderErr)) ? 'is-invalid' : ''; ?>">
                             <option value="">Select Gender</option>
                             <option value="male" <?php if($gender === 'male') echo 'selected'; ?>>Male</option>
                             <option value="female" <?php if($gender === 'female') echo 'selected'; ?>>Female</option>
                             <option value="other" <?php if($gender === 'other') echo 'selected'; ?>>Other</option>
                             </select>
                <span class="error">* <?php echo $genderErr;?></span>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>

        </form>
    </div>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu" crossorigin="anonymous"></script>
</body>
</html>