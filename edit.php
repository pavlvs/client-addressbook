<?php
session_start();

// if user is not logged in
if (!$_SESSION['loggedInUser']) {

    // send them to the login page
    header("Location: index.php");
}

// get ID sent by GET collection
$clientID = $_GET['id'];

// connect to the database
include 'includes\connection.php';

// connect to the database
include 'includes\functions.php';

// query the database
$query = "SELECT * FROM clients WHERE id='$clientID'";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {

    // we have data!
    // set some variables
    while ($row = mysqli_fetch_assoc($result)) {
        $clientName = $row['name'];
        $clientEmail = $row['email'];
        $clientPhone = $row['phone'];
        $clientAddress = $row['address'];
        $clientCompany = $row['company'];
        $clientNotes = $row['notes'];
    }

} else {
    $alertMessage = '<div class="alert alert-warning">Nothing to see here.<a
            href="clients.php">Head back/a>.</div>';
}

// if update button was submitted
if (isset($_POST['update'])) {
    //set variables
    $clientName = validateFormData($_POST['clientName']);
    $clientEmail = validateFormData($_POST['clientEmail']);
    $clientPhone = validateFormData($_POST['clientPhone']);
    $clientAddress = validateFormData($_POST['clientAddress']);
    $clientCompany = validateFormData($_POST['clientCompany']);
    $clientNotes = validateFormData($_POST['clientNotes']);

    // new database query and result
    $query = "UPDATE clients
            SET name='$clientName',
            email='$clientEmail',
            phone='$clientPhone',
            address='$clientAddress',
            company='$clientCompany',
            notes='$clientNotes'
            WHERE id='$clientID'";

    $result = mysqli_query($conn, $query);

    if ($result) {

        //redirect to clients page with query string
        header("Location: clients.php?alert=updatesuccess");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

}

if (isset($_POST['delete'])) {
    $alertMessage = "<div class='alert alert-danger'>
                   <p>Are you sure you want to delete this client? No take backs!</p><br>
                   <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?
                   id=$clientID' method='post'>
                   <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete'
                   value='Yes, delete!'>
                   <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>
                   Oops, no thanks!</a>
                   </form>
                   </div>";
}

if (isset($_POST['confirm-delete'])) {

    // new database query & result
    $query = "DELETE FROM clients WHERE id='$clientID'";
    $result = mysqli_query($conn, $query);

    if ($result) {

        // redirect to client page with query strin
        header("Location: clients.php?alert=deleted");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
// close the database connection
mysqli_close($conn);

// include the header file
include 'includes\header.php';
?>

<h1>Edit Client</h1>

<?php echo $alertMessage; ?>

<form class="row" action="<?php echo htmlspecialchars
($_SERVER['PHP_SELF']); ?>?id=<?php echo $clientID; ?>" method="post">
    <div class="form-group col-sm-6">
        <label for="client-name">Name</label>
        <input id="client-name" class="form-control input-lg" type="text"
               name="clientName" value="<?php echo $clientName; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-email">Email</label>
        <input id="client-email" class="form-control input-lg" type="text"
               name="clientEmail" value="<?php echo $clientEmail; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-phone">Phone</label>
        <input id="client-phone" class="form-control input-lg" type="text"
               name="clientPhone" value="<?php echo $clientPhone; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-address">Address</label>
        <input id="client-address" class="form-control input-lg" type="text"
               name="clientAddress" value="<?php echo $clientAddress; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-company">Company</label>
        <input id="client-company" class="form-control input-lg" type="text"
               name="clientCompany" value="<?php echo $clientCompany; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-notes">Notes</label>
        <textarea id="client-notes" class="form-control input-lg"
                  name="clientNotes"><?php echo $clientNotes; ?></textarea>
    </div>
    <div class="col-sm-12">
        <hr>
        <button class="btn btn-lg btn-danger pull-left" type="submit"
                name="delete">Delete
        </button>
        <div class="pull-right">
            <a class="btn btn-lg btn-default" href="clients.php"
               type="button">Cancel</a>
            <button class="btn btn-lg btn-success" type="submit"
                    name="update">Update
            </button>
        </div>
    </div>
</form>

<?php include 'includes/footer.php';?>
