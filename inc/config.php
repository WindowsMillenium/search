<?php
/* Configuration */
ini_set("display_errors", "on"); // Do you want to see the errors ?

 $host = "localhost"; // Hostname
 $port = "3306"; // MySQL Port; Default : 3306
 $user = "root"; // Username Here
 $pass = "backstreetboys"; // Password Here
 $db   = "search"; // Database Name
 $dbh  = new PDO('mysql:dbname='.$db.';host='.$host.';port='.$port, $user, $pass);
/* End Configuration */
?>
