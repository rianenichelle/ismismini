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
    <h1>Administrator</h1>
    <br>

    <!--NEW SUBJECT-->
    <div class="list-group-item flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        
        <div class="form-group">
            <h2 class="text-muted">Create a new subject.</h2>
            <form action="admin.php" method = "POST">
                <label class="col-form-label">Subject Name</label>
                <input type="text" name="subject" class="form-control col-sm-6" required><br>
                
                <label class="col-form-label">Maximum Number of Students</label>
                <input type="number" name="max_stud" placeholder="1" class="form-control col-sm-4" required><br>

                <label class="col-form-label">Number of Groups</label>
                <input type="number" name="group_no" placeholder="1" class="form-control col-sm-4" required>
                <br><br>
                
                <input type="submit" class="btn btn-primary" name ="create_subj" value="Create Subject">
            </form>
        </div>

        </div>
    </div>

    <?php
        session_start();

        $servername = "localhost";
        $username="root";
        $password="";
        $dbname="ismis";

        //CREATE NEW RECORD
        if(isset($_POST['create_subj'])){
            $subject=$_POST['subject'];
            $max_stud=$_POST['max_stud'];
            $group_no=$_POST['group_no'];

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $subj_sql = "INSERT INTO subjects (subj_id, name, max_stud, no_of_groups) 
                    VALUES ('','$subject', '$max_stud', '$group_no')";

            if ($conn->query($subj_sql) === TRUE) {
                echo "New Subject Added!";
            } else {
                echo "Error: " . $subj_sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        
        ?>
    <br><br>
    <!--NEW SCHEDULE-->
    <div class="list-group-item flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        
        <div class="form-group">
            <h2 class="text-muted">Create a new schedule.</h2>
            <form action="admin.php" method = "POST">
                <label class="col-form-label">Select a subject:</label>
                <select name="sched_subj" class="custom-select">
                    <?php //dynamic subjects here
                    
                    // foreach(subject blah blah)
                    //     echo "<option value=".$subj_id">"One"</option>";
                        ?>
                </select>
                
                <label class="col-form-label">Assign an instructor:</label>
                <select name="sched_inst" class="custom-select">
                    <?php //dynamic teachers here
                    
                    // foreach(subject blah blah)
                    //     echo "<option value=".$subj_id">"One"</option>";
                        ?>
                </select>

                <label class="col-form-label">Days</label>
                <select name="date" class="custom-select">
                    <option value="m">M</option>
                    <option value="mw">MW</option>
                    <option value="mf">MF</option>
                    <option value="wf">WF</option>
                    <option value="tth">TTh</option>
                    <option value="f">F</option>
                    <option value="s">S</option>
                </select>

                <label class="col-form-label">Select timeslot:</label>
                <input type="time" name="start"class="form-control form-control-sm col-sm-4" required> to
                <input type="time" name="end" class="form-control form-control-sm col-sm-4" required><br>

                <input type="submit" class="btn btn-primary" name ="create_sched" value="Create Schedule">
            </form>
        </div>
    </div>
    </div>

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