<?php
// korvaa oikeilla arvoilla
$con = mysqli_connect("server","user","passwd","db");

// Check connection
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
else {
    echo "connection successfull\n";
}
?>
