<?php
    session_start();
    if($_SESSION['account_id']==0){
        header("Location:index.php");
    }
    

    $servername = "localhost";
    $username="root";
    $password="";
    $dbname="ismis";
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
        <a class="navbar-brand" href="admin.php">Mini ISMIS.</a>
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
    <h1>Administrator</h1>
    <br>

    <!--NEW SUBJECT-->
    <div class="list-group-item flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        
        <div class="form-group">
            <h2 class="text-muted">Create a new subject.</h2>
            <form action="admin.php" method = "POST">
                <label class="col-form-label">Subject Name</label>
                <input type="text" name="description" class="form-control col-sm-6" required><br>
                
                <label class="col-form-label">Maximum Number of Students</label>
                <input type="number" name="max_stud" placeholder="1" class="form-control col-sm-4" required><br>

                <br><br>
                
                <input type="submit" class="btn btn-primary" name ="create_subj" value="Create Subject">
            </form>
        </div>

        </div>
    </div>

    <?php
        //CREATE NEW RECORD
        if(isset($_POST['create_subj'])){
            $subject=$_POST['description'];
            $max_stud=$_POST['max_stud'];

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $subj_sql = "INSERT INTO subject (subj_id, description, max_stud) 
                         VALUES ('','$subject', '$max_stud')";

            if ($conn->query($subj_sql) === TRUE) {
                echo "New Subject Added!";
            } else {
                echo "Error: " . $subj_sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        
        ?>
    <br><br>


    <!--ENROLL A STUDENT-->
    <div class="list-group-item flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        
        <div class="form-group">
            <h2 class="text-muted">Enroll a new student.</h2>
            <form action="admin.php" method = "POST">
            <label class="col-form-label">Select a student:</label>
                <select name="stud_acc" class="custom-select">
                    <?php //dynamic subjects here
                        $conn=new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sel_subj="SELECT * FROM account WHERE type='Student'";  

                        $query=mysqli_query($conn, $sel_subj);

                        while($row=mysqli_fetch_assoc($query)){
                            $fname=$row['fname'];
                            $lname=$row['lname'];
                            $stud_id=$row['account_id'];
                            echo "<option value='.$stud_id.'>".$fname." ".$lname."</option>";
                        }
                        $conn->close();
                        ?>
                </select>
                
                <label class="col-form-label">Select a subject & schedule:</label>
                <select name="subj_sched" class="custom-select">
                <?php //dynamic teachers here
                    $conn=new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                     $sel_sched="SELECT * FROM teacher_schedule 
                                INNER JOIN subject ON teacher_schedule.subj_id=subject.subj_id";  

                    $query=mysqli_query($conn, $sel_sched);

                    while($row=mysqli_fetch_assoc($query)){
                        $sched_id=$row['sched_id'];
                        $subject=$row['description'];
                        $date=$row['date'];
                        $time_start=$row['time_start'];
                        $time_end=$row['time_end'];
                        echo "<option value='.$sched_id.'>".$subject." [".$date." ".$time_start." - ".$time_end."]</option>";
                    }
                     
                    $conn->close();
                    ?>
                </select>

                <br><br>

                <input type="submit" class="btn btn-primary" name ="enroll_stud" value="Enroll Student">
            </form>
        </div>
    </div>
    </div>

    <br>

    <?php
         $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        if(isset($_POST['enroll_stud'])){
            $sched_id=$_POST['subj_sched'];
            $account_id=$_POST['stud_acc'];
            
            $subj_sql = "INSERT INTO student_schedule (stud_id, sched_id, account_id) 
                         VALUES ('','$sched_id', '$account_id')";

            if ($conn->query($subj_sql) === TRUE) {
                echo "Student Enrolled to a Schedule!<br><br>";
            } else {
                echo "Error: " . $subj_sql . "<br>" . $conn->error;
            }
        }
    ?>

        <!--NEW SCHEDULE-->
        <div class="list-group-item flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        
        <div class="form-group">
            <h2 class="text-muted">Create a new schedule.</h2>
            <form action="admin.php" method = "POST">
                <label class="col-form-label">Select a subject:</label>
                <select name="sched_subj" class="custom-select">
                    <?php //dynamic subjects here
                        $conn=new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sel_subj="SELECT * FROM subject";  

                        $query=mysqli_query($conn, $sel_subj);

                        while($row=mysqli_fetch_assoc($query)){
                            $subject=$row['description'];
                            $subj_id=$row['subj_id'];
                            echo "<option value='.$subj_id.'>".$subject."</option>";
                        }
                        $conn->close();
                        ?>
                </select>
                
                <label class="col-form-label">Assign an instructor:</label>
                <select name="sched_inst" class="custom-select">
                <?php //dynamic teachers here
                        $conn=new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sel_inst="SELECT * FROM account WHERE type='Teacher'";  

                        $query=mysqli_query($conn, $sel_inst);

                        while($row=mysqli_fetch_assoc($query)){
                            $inst_fname=$row['fname'];
                            $inst_lname=$row['lname'];
                            $inst_id=$row['account_id'];
                            echo "<option value='.$inst_id.'>".$inst_fname." ".$inst_lname."</option>";
                        }
                        $conn->close();
                        ?>
                </select>

                <label class="col-form-label">Days</label>
                <select name="date" class="custom-select">
                    <option value="M">M</option>
                    <option value="MW">MW</option>
                    <option value="MF">MF</option>
                    <option value="WF">WF</option>
                    <option value="TTh">TTh</option>
                    <option value="F">F</option>
                    <option value="S">S</option>
                </select>

                <label class="col-form-label">Select timeslot:</label>
                <input type="time" name="time_start"class="form-control form-control-sm col-sm-4" required> to
                <input type="time" name="time_end" class="form-control form-control-sm col-sm-4" required><br>
                
                <label class="col-form-label">Room:</label>
                <input type="text" name="room" class="form-control col-sm-4"><br>

                <input type="submit" class="btn btn-primary" name ="create_sched" value="Create Schedule">
            </form>
        </div>
    </div>
    </div>

    <br>

    <?php
         $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        if(isset($_POST['create_sched'])){
            $subject=$_POST['sched_subj'];
            $date=$_POST['date'];
            $time_start=$_POST['time_start'];
            $time_end=$_POST['time_end'];
            $teacher_id=$_POST['sched_inst'];
            $room=$_POST['room'];
            
            $subj_sql = "INSERT INTO teacher_schedule (sched_id, subj_id, date, time_start, time_end, teacher_id, room) 
                         VALUES ('','$subject', '$date', '$time_start', '$time_end', '$teacher_id', '$room')";

            if ($conn->query($subj_sql) === TRUE) {
                echo "New Schedule Added!<br>";
            } else {
                echo "Error: " . $subj_sql . "<br>" . $conn->error;
            }
        }

    ?>

    </div>
    </body>
</html>  