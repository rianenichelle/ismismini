<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!---LINKS-->
        <link rel="stylesheet" type="text/css" href="lux.css">
        


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
                <li class="nav-item active">
                    <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
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
        <h1>Faculty</h1>
        <br>

        <h2>Schedules</h2>
    <?php
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ismis";
        
        //DISPLAY SCHEDULES TABLE

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sched_sql = "SELECT * FROM schedule 
                       INNER JOIN faculty ON schedule.sched_id=faculty.fac_id
                       WHERE fac_id='$fac_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-hover" >';
            echo "<tr>";
            echo '<th scope="col">ID</th>';
            echo '<th scope="col">Course</th>';
            echo '<th scope="col">Instructor</th>';
            echo '<th scope="col">Schedule</th>';
            echo '<th scope="col">Group Number</th>';
            echo '<th scope="col">No. of Students</th>';
            echo "</tr>";
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["sched_id"]."</td>";
                echo "<td>".$row["sched_inst"]."</td>";
                echo "<td>".$row["date"]. $row["start"]. $row["end"]."</td>";
                echo "<td>".$row["group_no"]."</td>";
                echo "<td>".$row["no_of_studs"]."</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        $conn->close();
    ?>


        <br>
        <?php
            // $servername = "localhost";
            // $username = "root";
            // $password = "";
            // $dbname = "accounts";

            // $conn = new mysqli($servername, $username, $password, $dbname);
            // // Check connection
            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // } 

            // $id = $_POST["iddel"];
            // $sql = "SELECT id, fname, lname, email, pw, addr FROM profiles WHERE id=$id";
            // $result = $conn->query($sql);

            // if ($result->num_rows > 0) {
            //     $sql = "SELECT id, fname, lname, email, pw, addr FROM profiles WHERE id=$id";
            //     $result = $conn->query($sql);

            //     $id = $_POST["iddel"];
            //     // sql to delete a record
            //     $sql = "DELETE FROM profiles WHERE id=$id";

            //     if ($conn->query($sql) === TRUE) {
            //         echo "<script language='javascript'>alert('Information Successfully Deleted!');window.location.href='register.php';</script>";
            //     } else {
            //         echo "Error deleting record: " . $conn->error;
            //     }
            // } else {
            //     echo "No record found!";
            // }

            // $conn->close();
            ?>

        </div>
    </body>

</html>  