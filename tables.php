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

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ismis";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $subj_query="SELECT * FROM subject";
        $result = $conn->query($subj_query);

        if ($result->num_rows > 0) {
            echo '<table class="table table-hover">';
            echo "<tr class='table-active'>";
            echo '<th scope="col">ID</th>';
            echo '<th scope="col">Course Name</th>';
            echo '<th scope="col">Max Students</th>';
            echo "</tr>";
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["subj_id"]."</td>";
                echo "<td>".$row["description"]."</td>";
                echo "<td>".$row["max_stud"]."</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        $conn->close();
    ?>

    <h2>Faculty</h2>

    <?php
    //DISPLAY FACULTY TABLE
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM account WHERE type=2";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-hover" >';
            echo "<tr class='table-active'>";
            echo '<th scope="col">ID</th>';
            echo '<th scope="col">First Name</th>';
            echo '<th scope="col">Last Name</th>';
            echo '<th scope="col">Email</th>';
            echo "</tr>";
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["account_id"]."</td>";
                echo "<td>".$row["fname"]."</td>";
                echo "<td>".$row["lname"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        $conn->close();
    ?>

    <h2>Students</h2>

    <?php
    //DISPLAY STUDENTS TABLE

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stud_sql = "SELECT * FROM account WHERE type=1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-hover" >';
            echo "<tr class='table-active'>";
            echo '<th scope="col">ID</th>';
            echo '<th scope="col">First Name</th>';
            echo '<th scope="col">Last Name</th>';
            echo '<th scope="col">Email</th>';
            echo "</tr>";
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["account_id"]."</td>";
                echo "<td>".$row["fname"]."</td>";
                echo "<td>".$row["lname"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        $conn->close();
    ?>

    <h2>Schedules</h2>
    <?php
    //DISPLAY SCHEDULES TABLE

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sched_sql = "SELECT * FROM teacher_schedule";
        $result = $conn->query($sched_sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-hover">';
            echo "<tr class='table-active'>";
            echo '<th scope="col">ID</th>';
            echo '<th scope="col">Course</th>';
            echo '<th scope="col">Instructor</th>';
            echo '<th scope="col">Schedule</th>';
            echo '<th scope="col">Room</th>';
            echo '<th scope="col">No. of Students</th>';
            echo "</tr>";
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["sched_id"]."</td>";
                echo "<td>".$row["subj_id"]."</td>";
                echo "<td>".$row["teacher_id"]."</td>";
                echo "<td>".$row['date']." ".$row['time_start']." - ".$row['time_end']."</td>";
                echo "<td>".$row["room"]."</td>";
                echo "<td>".$row["quantity"]."</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        $conn->close();
    ?>

    <div class="row">
        <div class="list-group-item flex-column align-items-start col-sm-6">
        <div class="w-100 justify-content-between">
            <h2>Remove a subject.</h2>
                <form action="tables.php" method="POST">
                    <label class="col-form-label">Enter ID: </label>
                    <input type="text" name="del" class="form-control form-control-sm col-sm-2"><br>
                    
                    <input type="submit" name="del_subj" class="btn btn-primary" value="Delete">
                </form>

                <?php
                    //DELETE A SUBJECT.
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "ismis";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    if (isset($_POST['del_subj'])){
                        $id=$_POST["del"];
                    }
                    
                    $subj_sql = "SELECT * FROM subject WHERE subj_id=$id";
                    $result = $conn->query($subj_sql);

                    if ($result->num_rows > 0) {   
                         // sql to delete a record
                         if (isset($_POST['del_subj'])){
                            $id=$_POST["del"];
                        }
                        $sql = "DELETE FROM subject WHERE subj_id=$id";
                        $result = $conn->query($sql);
                        if ($conn->query($sql) === TRUE) {
                            echo "<script language='javascript'>alert('Information Successfully Deleted!');window.location.href='register.php';</script>";
                        } else {
                            echo "Error deleting record: " . $conn->error;
                            }
                    } else {
                        echo "No record found!";
                    }

                    $conn->close();
                ?>

            </div>
        </div><br>

        <div class="list-group-item flex-column align-items-start col-sm-6">
            <div class="w-100 justify-content-between">
            <h2>Edit A Class Schedule.</h2>
                    <form action="update.php" method="get">
                    <label class="col-form-label">Enter ID: </label>
                    <input type="text" name = "idedit" id = "idedit" class="form-control form-control-sm col-sm-2"><br>
                    <input type="submit" class="btn btn-primary" value="UPDATE">
                </form>
                </div>
        </div>
    </div>
    <br><br>    

    </body>
</html>