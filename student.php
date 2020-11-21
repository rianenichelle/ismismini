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
            <li class="nav-item active">
                <a class="nav-link" href="student.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="stud_schedule.php">Schedule</a>
            </li>
            </ul>
            <form method="POST" class="form-inline my-2 my-lg-0">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="logout">Logout</button>
            <?php
                if(isset($_POST['logout'])){
                    session_start();
                    session_unset();
                    session_destroy();

                    header("Location:index.php");
                }
            ?>
            </form>
        </div>
        </nav>

    <br><br>

    <div class="container">
        <h1>Student</h1>
        <br>

    <!--NEW SUBJECT-->
    <div class="list-group-item flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <div class="form-group">
                <h2 class="text-muted">Enroll in a subject.</h2>
                
                <form action="student.php" method="POST">
                <?php
                // Create connection
        
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sched_sql = "SELECT * FROM teacher_schedule 
                            INNER JOIN subject ON teacher_schedule.subj_id=subject.subj_id";
                $result = $conn->query($sched_sql);

                if($result->num_rows > 0) {
                    echo '<table class="table table-hover">';
                    echo "<tr class='table-active'>";
                    echo '<th scope="col">Course Name</th>';
                    echo '<th scope="col">Instructor</th>';
                    echo '<th scope="col">Schedule</th>';
                    echo '<th scope="col">Room</th>';
                    echo '<th scope="col">No. of Students</th>';
                    echo "</tr>";
                
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $t_id = $row['teacher_id'];
                        echo "<tr>";
                        echo "<td>".$row["description"]."</td>";
                        $sql2  = "SELECT * FROM account WHERE account_id = '$t_id'";
                        $result2 = $conn->query($sql2);
                        while($row2 = $result2->fetch_assoc()){
                            echo "<td>".$row2['lname']. ", ".$row2['fname']."</td>";
                        }
                        echo "<td>".$row['date']." ".$row['time_start']." - ".$row['time_end']."</td>";
                        echo "<td>".$row["room"]."</td>";
                        echo "<td>".$row["quantity"]."</td>";
                        echo "<td> <button class='btn btn-primary' value='".$row["sched_id"]."' name='enroll_id'>ENROLL</button></td>";
                        $_SESSION['enroll_id'] = 0;
                        echo "</tr>";
                    }
                }     
                echo "</table>";
                mysqli_close($conn);
                ?>
                </form>
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['enroll_id'])){
            $enroll_id = $_POST['enroll_id'];
            $conn = mysqli_connect($servername, $username, $password,$dbname);
            

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM teacher_schedule WHERE sched_id = '$enroll_id' ";
            $query = mysqli_query($conn,$sql);

            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_array($query)){ //getting content of TEACHER schedule database that we want to get
                    $subj_id = $row['subj_id'];
                    $quantity = $row['quantity'];

                    $sql2 = "SELECT * FROM subject WHERE subj_id = '$subj_id' ";//getting contents of SUBJECT database for maximum quantity
                    $query2 = mysqli_query($conn,$sql2);

                    if(mysqli_num_rows($query2) > 0 &&  $_SESSION['enroll_id'] != 1){
                        while($row2 = mysqli_fetch_array($query2) ){ 
                            if($quantity < $row2['max_stud']){
                                $sql3 = "SELECT * FROM student_schedule INNER JOIN teacher_schedule ON student_schedule.sched_id = teacher_schedule.sched_id"; //getting the student schedule whether or not it is empty
                                $query3 = mysqli_query($conn,$sql3);
                                // $res = 0
                                if(mysqli_num_rows($query3) > 0 ){
                                    while($row3 = mysqli_fetch_array($query3) && $_SESSION['enroll_id'] != 1){
                                        if($row['time_start'] == $row3['time_end'] && $res ){
                                            $_SESSION['enroll_id'] = 1;
                                        }else{
                                            $enroll_sql = "INSERT INTO student_schedule(stud_id, sched_id, account_id) VALUES('','$enroll_id','$account_id')";                                                        
                                            $quantity = $quantity + 1;
                                            $_SESSION[$subj_id] = 1;
                                            $_SESSION['enroll_id'] = 1;
                                            $res = 1;

                                            
                                            if (mysqli_query($conn,$enroll_sql) === TRUE) {
                                                 echo "Successfully Enrolled in a Subject";
                                                            
                                                $update_sql = "UPDATE teacher_schedule SET quantity = '$quantity' WHERE sched_id = '$enroll_id'";
                                                $update = mysqli_query($conn,$update_sql);
                                                header("Location:student.php");
                                                $res = 1;
                                            } else {
                                                $res = 0;
                                                echo "Error: " . $subj_sql . "<br>" .  mysqli_error($conn);
                                            }
                                        }
                                        break;
                                    }
                                }else{
                                    if($_SESSION['enroll_id'] == 0){
                                        $enroll_sql = "INSERT INTO student_schedule (stud_id,sched_id,account_id) 
                                                   VALUES('','$enroll_id','$account_id')";
                                        $_SESSION['enroll_id'] = 1;
                                        $quantity = $quantity + 1;
                                        $res = 1;


                                        if (mysqli_query($conn,$enroll_sql) === TRUE ) {
                                            echo "Successfully Enrolled in a Subject";
                                                
                                            $update_sql = "UPDATE teacher_schedule SET quantity = $quantity WHERE sched_id = $enroll_id";
                                            $update = mysqli_query($conn,$update_sql);
                                            header("Location:student.php");

                                        } else {
                                            echo "Error: " . $enroll_sql . "<br>" .  mysqli_error($conn);
                                        }
                                    }
                                    
                                }
                            }
                        }
                    } else {
                        echo "<h3>NOT ENROLLED IN ANY SCHEDULE</h3>";
                    }
                }
            }
            mysqli_close($conn);

        }

    ?>

    <br><br>
<form action="student.php" method="POST">
    <?php
        $conn = mysqli_connect($servername, $username, $password,$dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM student_schedule 
                INNER JOIN teacher_schedule ON student_schedule.sched_id = teacher_schedule.sched_id
                INNER JOIN subject ON teacher_schedule.subj_id = subject.subj_id 
                WHERE account_id = '$account_id'"; 
                //getting the student schedule whether or not it is empty
        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
            echo '<table class="table table-hover">';
            echo "<tr class='table-active'>";
            echo '<th scope="col">Course Name</th>';
            echo '<th scope="col">Instructor</th>';
            echo '<th scope="col">Schedule</th>';
            echo '<th scope="col">Room</th>';
            echo "</tr>";
            while($row = mysqli_fetch_array($query)){
                $teacher_id = $row['teacher_id'];
                echo "<tr>";
                echo "<td>".$row["description"]."</td>";
                $sql2  = "SELECT * FROM account WHERE account_id = '$teacher_id'";
                $result2 = $conn->query($sql2);
                while($row2 = $result2->fetch_assoc()){
                    echo "<td>".$row2['lname']. ", ".$row2['fname']."</td>";
                }
                echo "<td>".$row['date']." ".$row['time_start']." - ".$row['time_end']."</td>";
                echo "<td>".$row["room"]."</td>";
                echo "<td> <button class='btn btn-primary' value='".$row["sched_id"]."' name='del_id'>DELETE</button></td>";
                echo "</tr>";
            }
        }
        mysqli_close($conn);

    ?>
    <br>
</form>
    
    <br><br>
    
    <?php
        $conn = mysqli_connect($servername, $username, $password,$dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if(isset($_POST['del_id'])){
            $delete_id = $_POST['del_id'];
            
            $sql = "SELECT * FROM student_schedule WHERE stud_id = '$delete_id'";
            $query = mysqli_query($conn,$sql);
            if($query->num_rows>0){
                $row=$query->fetch_assoc();
                $id=$row['sched_id'];
                $quantity=$row['quantity'];
            }
            
            $quantity2=$quantity-1;

            $del_sql = "DELETE FROM student_schedule WHERE sched_id = '$delete_id'";
            $_SESSION['enroll_id'] == 0;
            if (mysqli_query($conn,$del_sql) === TRUE) {
                $update_sql = "UPDATE teacher_schedule SET quantity = quantity-1 WHERE sched_id=$delete_id";
                if(mysqli_query($conn, $update_sql)===TRUE){
                    echo "<script language='javascript'>alert('Information Successfully Deleted!');window.location.href='student.php';</script>";
                } 
            }else {
                echo "Error deleting record: " . $conn->error;
            }
        }
        
        ?>
    </div>
    <div class="container">
        <h1>Class Schedule</h1>
    </div>
    </body>
</html>  