<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>

    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="">Logged as <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    <p>
        <a href="reset-password.php" class="">Reset Your Password</a>
        <a href="logout.php" class="">Sign Out of Your Account</a>
    </p>

<p>


    <form action="welcome.php" method="post">
        <input type="number" placeholder="DD" name="day">
        <input type="number" placeholder="MM" name="month">
        <input type="number" placeholder="YYYY" name="year">
        <input type="text" placeholder="plan" name="plan">

        <input type ="submit">
    </form>

    <calender><?php





        require_once "config.php";

        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $plan = $_POST['plan'];
        $user = $_SESSION["username"];

        $sql = "INSERT into calender(Date,Plan,User) values('$year$month$day','$plan','$user')";

        if ($link->query($sql) === TRUE) {
            // echo "ADDED: ".$name.", ".$age.", ".$gender;
        } else {
            echo "Error: ".$sql."<br>".$link->error;
        }



        $sql = "SELECT * FROM calender ORDER BY Date ASC";

        $result = mysqli_query($link, $sql);

        echo "<table border='1'>
      <tr>

         <th>Date</th>
         <th>User</th>
         <th>Plan</th>
      </tr>";

        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['Date'] . "</td>";
            echo "<td>" . $row['User'] . "</td>";
            echo "<td>" . $row['Plan'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($link);
        ?>









    </calender>



</p>












</body>
</html>