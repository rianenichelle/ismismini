<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="lux.css">
</head>

<body>
    <br><br>
    <div class="box">
        <div class="container">
            <h2>REGISTER</h2>
            <form action="register.php" method="POST">
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" placeholder="Enter your first name" required>
            </div>
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp" placeholder="Enter your last name" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="type" class="form-control" id="address" name="address" aria-describedby="emailHelp" placeholder="Enter your address" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Enter your password name" required>
            </div>
            <div class="form-group">
                <label for="type">Select</label>
                <select class="form-control" id="exampleSelect1" name="type">
                    <option>Teacher</option>
                    <option>Student</option>
                </select>
            </div>
                <input type="submit" class="form-group btn btn-primary" name="submit" aria-describedby="emailHelp" value="Register">
            </form>
        </div>
    </div>

    <?php
        session_start();
        
        $servername = "localhost";
        $username="root";
        $password="";
        $dbname="ismis";

        if(isset($_POST['submit'])){
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            $pw=$_POST['password'];
            $type=$_POST['type'];

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO account (account_id,fname,lname,address,email,type,password) VALUES('','$fname','$lname','$address','$email','$type','$pw')";

            if (mysqli_query($conn, $sql) == TRUE) {
                echo "<script language='javascript'>alert('Registration Successfully Added!');window.location.href='index.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" .mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    ?>
</body>
</html>