<?php
    include 'config.php';
    $conn = getConnection();
    $sql = "DELETE FROM cart"; 
    if ($conn->query($sql) === TRUE) {
        echo "A fizetés sikeres volt és a termékek törölve lettek a kosárból.";
    } else {
        echo "Hiba történt a fizetés során: " . $conn->error;
    }
    
    $conn->close();
?>