<?php 
    $connection  = mysqli_connect("localhost", "root", "", "newspaper") or die("Connection Failed");
    $userid = $_GET['userid'];

    $sqlQuery = "DELETE FROM user WHERE user_id = {$userid}";
    if(mysqli_query($connection, $sqlQuery))
    {
        header("Location: http://localhost/NewsPaperWebsite/admin/users.php");
    }
    mysqli_close($connection);
?>