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
            <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tables.php">Schedule</a>
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
<h1>Student</h1>
<br>

<!--NEW SUBJECT-->
<div class="list-group-item flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
    
    <div class="form-group">
        <h2 class="text-muted">Enroll in a subject.</h2>
        <form action="admin.php" method = "POST">

            <label class="col-form-label">Select a subject:</label>
            <select name="stud_sched_subj" class="custom-select">
                <?php //dynamic subjects here
                
                // foreach(subject blah blah)
                //     echo "<option value=".$subj_id">"One"</option>";
                    ?>
            </select>
            
            <label class="col-form-label">Select a class schedule:</label>
            <select name="subj_inst" class="custom-select">
                <?php //dynamic subjects here
                
                // foreach(subject blah blah)
                //     echo "<option value=".$subj_id">""</option>";
                ?>
            </select>

            <br><br>
            <input type="submit" class="btn btn-primary" name ="enroll" value="Enroll">
        </form>
    </div>
</div>
</div>

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
                <?php //dynamic subjects here
                
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
                <option value="s">S</option>
            </select>

            <label class="col-form-label">Select timeslot:</label>
            <input type="time" name="start"class="form-control form-control-sm col-sm-4" required> to
            <input type="time" name="end" class="form-control form-control-sm col-sm-4" required><br>
            <input type="submit" class="btn btn-primary" name ="submit" value="Submit">
        </form>
    </div>
</div>
</div>


<br>

<h2>Class Schedule</h2>

    <?php
    //DISPLAY CLASS SCHEDULE
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

        // if ($result->num_rows > 0) {
        //     echo '<table class="table table-hover" >';
        //     echo "<tr>";
        //     echo '<th scope="col">Class Code</th>';
        //     echo '<th scope="col">Course</th>';
        //     echo '<th scope="col">Instructor</th>';
        //     echo '<th scope="col">Schedule</th>';
        //     echo "</tr>";
            
        //     // output data of each row
        //     while($row = $result->fetch_assoc()) {
        //         echo "<tr>";
        //         echo "<td>".$row["id"]."</td>";
        //         echo "<td>".$row["subject"]."</td>";
        //         echo "<td>".$row["inst"]."</td>";
        //         echo "<td>".$row["day"] $row["time"]."</td>";
        //        
        //         echo "</tr>";
        //     }
        // }
        // echo "</table>";
        // $conn->close();
    ?>

<br><br>

</div>
</body>

</html>  