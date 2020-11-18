<?php
    session_start();
    if($_SESSION['account_id']==0){
        header("Location:index.php");
    }
    $servername = "localhost";
    $username="root";
    $password="";
    $dbname="ismis";
    $account_id = $_SESSION['account_id'];
?>

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
            <a class="navbar-brand" href="faculty.php">Mini ISMIS.</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="faculty.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Log Out</a>
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

        <h2>CLASS SCHEDULE</h2>
        <?php
            //DISPLAY FACULTY SCHEDULES TABLE

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

                $id_sql="SELECT * FROM account WHERE account_id='$account_id'";
                $query=mysqli_query($conn,$id_sql);

                if($fetch=mysqli_fetch_assoc($query)){
                    $tsched_sql = "SELECT * FROM teacher_schedule
                                  INNER JOIN account ON teacher_schedule.teacher_id=account.account_id 
                                  INNER JOIN subject ON teacher_schedule.subj_id=subject.subj_id
                                  WHERE teacher_id='$account_id'";
                    $result = $conn->query($tsched_sql);
                    if ($result->num_rows > 0) {
                        echo '<table class="table table-hover" >';
                        echo "<tr class='table-active'>";
                        echo '<th scope="col">ID</th>';
                        echo '<th scope="col">Course</th>';
                        echo '<th scope="col">Schedule</th>';
                        echo '<th scope="col">Room Number</th>';
                        echo '<th scope="col">No. of Students</th>';
                        echo "</tr>";
                        
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['sched_id']."</td>";
                            echo "<td>".$row["description"]."</td>";
                            echo "<td>".$row['date']." ".$row['time_start']." - ".$row['time_end']."</td>";
                            echo "<td>".$row["room"]."</td>";
                            echo "<td>".$row["quantity"]."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        

                        echo"<h2>LIST OF STUDENTS</h2>";
                        $data_sql = "SELECT * FROM student_schedule INNER JOIN account ON student_schedule.account_id = account.account_id 
                            INNER JOIN teacher_schedule ON student_schedule.sched_id = teacher_schedule.sched_id WHERE teacher_id = '$account_id'";
                        
                        $result2 = $conn->query($data_sql);
                    
                        if($result2->num_rows > 0) {
                            echo '<table class="table table-hover" >';
                            echo "<tr class='table-active'>";
                            echo '<th scope="col">Course ID</th>';
                            echo '<th scope="col">Name of Student</th>';
                            echo '<th scope="col">Date and Time</th>';
                            echo '<th scope="col">Room Number</th>';
                            echo "</tr>";        
                            while($row2 = $result2->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row2['sched_id']."</td>";
                                echo "<td>".$row2["fname"].", ".$row2['lname']."</td>";
                                echo "<td>".$row2['date']." ".$row2['time_start']." - ".$row2['time_end']."</td>";
                                echo "<td>".$row2["room"]."</td>";                                echo "</tr>";
                            }
                            echo "</table>";
                        }else{
                            echo"<h3>--NO STUDENTS ENROLLED YET--</h3>";

                        }
                    }
                      
                }
            
            $conn->close();
        ?>
        <br>
        </div>
    </body>
</html>