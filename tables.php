<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!---LINKS-->
    <link rel="stylesheet" type="text/css" href="lux.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <title>Mini ISMIS.</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Mini ISMIS.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="tables.php">Tables</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
        </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    </nav>

<br><br>

<div class="container">
<h2>Subjects</h2>



<?php
//DISPLAY SUBJECTS TABLE

    session_start();

    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "ismis";
    // $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // $sql = "SELECT id, fname, lname, email, pw, addr FROM profiles";
    // $result = $conn->query($sql);

    // $orders_query=mysqli_query($conn,"SELECT * FROM orders 
    //             INNER JOIN order_details ON orders.order_id=order_details.order_id
    //             INNER JOIN customers ON orders.customer_id=customers.customer_id
    //             INNER JOIN products ON order_details.product_id
    //             WHERE shipper_id='$shipper_id';") 
    //         or die("Error: " . mysqli_error($conn));

    // if ($result->num_rows > 0) {
    //     echo '<table class="table table-hover" >';
    //     echo "<tr>";
    //     echo '<th scope="col">ID</th>';
    //     echo '<th scope="col">First Name</th>';
    //     echo '<th scope="col">Last Name</th>';
    //     echo '<th scope="col">Email</th>';
    //     echo '<th scope="col">Address</th>';
    //     echo '<th scope="col"></th>';
    //     echo '<th scope="col"></th>';
    //     echo "</tr>";
        
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo "<tr>";
    //         echo "<td>".$row["id"]."</td>";
    //         echo "<td>".$row["fname"]."</td>";
    //         echo "<td>".$row["lname"]."</td>";
    //         echo "<td>".$row["email"]."</td>";
    //         echo "<td>".$row["addr"]."</td>";
    //         echo "<td><i class="fa fa-trash" aria-hidden="true"></i></td>";
    //         echo "</tr>";
    //     }
    // }
    // echo "</table>";
    // $conn->close();
    // ?>

<h2>Faculty</h2>

<?php
//DISPLAY FACULTY TABLE

    // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // $sql = "SELECT id, fname, lname, email, pw, addr FROM profiles";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     echo '<table class="table table-hover" >';
    //     echo "<tr>";
    //     echo '<th scope="col">ID</th>';
    //     echo '<th scope="col">First Name</th>';
    //     echo '<th scope="col">Last Name</th>';
    //     echo '<th scope="col">Email</th>';
    //     echo '<th scope="col">Address</th>';
    //     echo "</tr>";
        
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo "<tr>";
    //         echo "<td>".$row["id"]."</td>";
    //         echo "<td>".$row["fname"]."</td>";
    //         echo "<td>".$row["lname"]."</td>";
    //         echo "<td>".$row["email"]."</td>";
    //         echo "<td>".$row["addr"]."</td>";
    //         echo "</tr>";
    //     }
    // }
    // echo "</table>";
    // $conn->close();
?>

<h2>Students</h2>

<?php
//DISPLAY TABLE

    // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // $sql = "SELECT id, fname, lname, email, pw, addr FROM profiles";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     echo '<table class="table table-hover" >';
    //     echo "<tr>";
    //     echo '<th scope="col">ID</th>';
    //     echo '<th scope="col">First Name</th>';
    //     echo '<th scope="col">Last Name</th>';
    //     echo '<th scope="col">Email</th>';
    //     echo '<th scope="col">Address</th>';
    //     echo "</tr>";
        
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo "<tr>";
    //         echo "<td>".$row["id"]."</td>";
    //         echo "<td>".$row["fname"]."</td>";
    //         echo "<td>".$row["lname"]."</td>";
    //         echo "<td>".$row["email"]."</td>";
    //         echo "<td>".$row["addr"]."</td>";
    //         echo "</tr>";
    //     }
    // }
    // echo "</table>";
    // $conn->close();
?>

<h2>Schedules</h2>

<?php
//DISPLAY TABLE

    // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // $sql = "SELECT id, fname, lname, email, pw, addr FROM profiles";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     echo '<table class="table table-hover" >';
    //     echo "<tr>";
    //     echo '<th scope="col">ID</th>';
    //     echo '<th scope="col">First Name</th>';
    //     echo '<th scope="col">Last Name</th>';
    //     echo '<th scope="col">Email</th>';
    //     echo '<th scope="col">Address</th>';
    //     echo "</tr>";
        
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo "<tr>";
    //         echo "<td>".$row["id"]."</td>";
    //         echo "<td>".$row["fname"]."</td>";
    //         echo "<td>".$row["lname"]."</td>";
    //         echo "<td>".$row["email"]."</td>";
    //         echo "<td>".$row["addr"]."</td>";
    //         echo "</tr>";
    //     }
    // }
    // echo "</table>";
    // $conn->close();
?>

</body>
</html>