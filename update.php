<?php
    session_start();
    include 'connect.php';
    if($_SESSION['account_id']==0){
        header("Location:index.php");
    }
    
    $_SESSION['id']=$_GET['idedit'];
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
            <a class="navbar-brand" href="admin.php">Mini ISMIS.</a>
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

        <!--NEW SCHEDULE-->
    <div class="list-group-item flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        
        <div class="form-group">
            <h2 class="text-muted">Update selected schedule.</h2>
            <form action="updates_sched.php" method = "POST">
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
                            echo "<option value='$subj_id'>".$subject."</option>";
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
                            echo "<option value='$inst_id'>".$inst_fname." ".$inst_lname."</option>";
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
                <input type="time" name="time_start"class="form-control form-control-sm col-sm-4" > to
                <input type="time" name="time_end" class="form-control form-control-sm col-sm-4" ><br>
                
                <label class="col-form-label">Room:</label>
                <input type="text" name="room" class="form-control col-sm-4"><br>

                <input type="submit" class="btn btn-primary" name ="edit_sched" value="Update Schedule">
            </form>
        </div>
    </div>
    </div>
    <br>

    </div>

    </body>
</html>