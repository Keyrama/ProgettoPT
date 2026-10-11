<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $username = trim($_POST["username"]);
        $sql = "SELECT id, username, password FROM users WHERE username = '" . trim($_POST["username"]) . "';";

        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $db = mysqli_select_db($conn, DB_NAME);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query($sql);

        if (!$result) {
          trigger_error('Invalid query: ' . $conn->error);
        }

        if ($result->num_rows > 1) {
          echo "Ops, something went wrong... DEBUG INFO: " . $sql;
          exit();
        } elseif ($result->num_rows == 1) {
          echo "Username already exists.";
          exit();
        }

        // Validate password
        if(empty(trim($_POST["password"]))){
            echo "Please enter a password.";
            exit();
        } elseif(strlen(trim($_POST["password"])) < 6){
            echo "Password must have atleast 6 characters.";
            exit();
        } else{
            $password = trim($_POST["password"]);
        }

        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            echo "Please confirm password.";
            exit();
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                echo "Password did not match.";
                exit();
            }
        }

        $sql = "INSERT INTO users (username, password) VALUES ('" . $username . "','" . md5($password) . "');";

        if($conn->query($sql) === TRUE){
          // Redirect to login page
          header("location: login.php");
        } else{
          echo "Something went wrong. Please try again later.";
        }

        $conn->close();
        }
    }

    // Close connection
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
