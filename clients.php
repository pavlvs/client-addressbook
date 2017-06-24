<?php
session_start();

//if user is not logged in lazy foo foo form-control foo php mysql foo lazy  lazy mysql
if (!$_SESSION['loggedInUser']) {
    // send them to the login page
    header("Location: index.php");
}

// connect to the database
include 'includes/connection.php';

// query and result
$query = "SELECT * FROM clients";
$result = mysqli_query($conn, $query);
$alertMessage = "";

//check for query string
if (isset($_GET['alert'])) {
    // new client added
    if ($_GET['alert'] ==  'success') {
       $alertMessage = "<div class='alert alert-success'>New client added! <a
           class='close' data-dismiss='alert'>&times;</a></div>";
   // client updated
    } elseif ($_GET['alert'] =='updatesuccess') {
        $alertMessage = "<div class='alert alert-success'>Client updated successfully! <a
           class='close' data-dismiss='alert'>&times;</a></div>";
    // client deleted
    } elseif ($_GET['alert'] ==  'deleted') {
        $alertMessage ="<div class='alert alert-success'>Client deleted! <a
           class='close' data-dismiss='alert'>&times;</a></div>";
    }
}

// close the mysql connection
mysqli_close($conn);

include 'includes/header.php';

?>

<h1>Client Address Book </h1>

<?php echo $alertMessage; ?>;

<table class="table table-stripped table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Company</th>
        <th>Edit</th>
    </tr>

<?php
if (mysqli_num_rows($result) > 0) {
    // we have data
    // output the data

    // TODO: Use fetch_array to display the clients table
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['company'] . "</td>";
        echo '<td><a href="edit.php?id=' . $row['id'] .'" 
            type="button" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-edit"></span></a></td>';
        echo "</tr>";
    }
} else {
    echo '<div class="alert alert-warning">You have no clients!</div>';
}
?>
    </table>

<?php include 'includes/footer.php'; ?>


