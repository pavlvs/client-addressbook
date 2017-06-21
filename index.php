<?php
session_start();
include('includes/functions.php');
// connect to the database
include('includes/connection.php');

/* $password = password_hash("abc123", PASSWORD_DEFAULT); */
/* echo $password; */

$formEmail = "";
$loginError = "";

// if login form was submitted
if (isset($_POST['login'])) {
    // create variables
    // wrap data with validate function
    $formEmail = validateFormData($_POST['email']);
    $formPass = validateFormData($_POST['password']);

    // create query
    $query = "SELECT name, password FROM users WHERE email='$formEmail'";

    // store the result
    $result = mysqli_query($conn, $query);

    //verify if result is returned
    if (mysqli_num_rows($result) > 0) {
        // store basic user data invariables
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $hashedPass = $row['password'];
        }

        // verify hashed password with submtted password
        if (password_verify($formPass, $hashedPass)) {
            // correct login details!
            // store data in session variables

            $_SESSION['loggedInUser'] = $name;

            // redirect user to clients page
            header("Location: clients.php");
        } else {
            // error message
            $loginError = "<div class='alert alert-danger'>Wrong username / password
                combination</div>";
        }
    } else {// there are no results in the database
        $loginError = "<div class='alert alert-danger'>No such user in the database. 
            Please try again. <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
}
// close mysql connection
mysqli_close($conn);

include 'includes/header.php';

// $password = password_hash("abc123", PASSWORD_DEFAULT);
// echo $password;

?>


<h1>Client Address Book</h1>
<p class="lead">Log in to your account :)</p>
<?php echo $loginError; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="form-inline" method="post">
  <div class="form-group">
    <label for="login-email" class="sr-only" >Email</label>
    <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="<?php echo $formEmail; ?>">
  </div>
   <div class="form-group">
    <label for="login-password" class="sr-only" >Email</label>
    <input type="password" class="form-control" id="login-password" placeholder="password" name="password" >
  </div>
  <button class="btn btn-primary" type="submit" name="login">Login</button>
</form>


<?php include 'includes/footer.php'; ?>

