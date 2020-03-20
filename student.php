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

    <h1>Class Schedule</h1>

        <?php
        //DISPLAY CLASS SCHEDULE
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ismis";
        
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //$sql = "SELECT sched_id, sched_fac_id, datetime, course_name, course_group FROM schedules";
            $scheds_query=mysqli_query($conn,"SELECT * FROM schedules 
                INNER JOIN order_details ON orders.order_id=order_details.order_id
                INNER JOIN customers ON orders.customer_id=customers.customer_id
                INNER JOIN products ON order_details.product_id
                WHERE shipper_id='$shipper_id';") 
            or die("Error: " . mysqli_error($conn));

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

    <br>

    <div class="row">
    <div class="list-group-item flex-column align-items-start col-sm-6">
        <div class="w-100 justify-content-between">
        <h2>Remove an enrolled subject.</h2><br>
                <form action="delete.php" method="post">
                    <label style="color: #000">Enter ID: </label>
                    <input type="text" name = "iddel" id = "iddel" class="form-control form-control-sm col-sm-2"><br>
                    <input type="submit" class="btn btn-primary" value="DELETE">
            </form>
        </div>
    </div><br>

    </div>

    <br><br>

    </body>
</html>  