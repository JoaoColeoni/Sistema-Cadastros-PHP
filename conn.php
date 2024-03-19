<?php
// Create connection
$conn = new mysqli($DBSERVER.':'.$DBPORT, $DBUSER, $DBPASS);

// Check connection
try {
    $conn = new PDO("mysql:host=$DBSERVER:$DBPORT;dbname=$DBNAME", $DBUSER, $DBPASS);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>