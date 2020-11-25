<?php
    session_start();
    include 'connect.php';
    if($_SESSION['account_id']==0){
        header("Location:index.php");
    }
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

<?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        if(isset($_POST['edit_sched'])){
                $id=$_SESSION['id'];
                $subject=$_POST['sched_subj'];
                $date=$_POST['date'];
                $time_start=$_POST['time_start'];
                $time_end=$_POST['time_end'];
                $teacher=$_POST['sched_inst'];
                $room=$_POST['room'];
    
                $subj_sql = "UPDATE teacher_schedule SET 
                                subj_id= '$subject', 
                                date = '$date', 
                                time_start = '$time_start', 
                                time_end = '$time_end',
                                teacher_id = '$teacher', 
                                room = '$room'
                                WHERE sched_id=$id";
                $result = $conn->query($subj_sql);
                if ($conn->query($subj_sql) === TRUE) {
                    echo "<script language='javascript'>alert('Schedule successfully updated!');window.location.href='tables.php';</script>";
                } else {
                    echo "Error: " . $subj_sql . "<br>" . $conn->error;
                }
        }
    
        $conn->close();
        ?>