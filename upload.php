<?php
    session_start(); 

    if(isset($_POST["imgSubmit"]) && isset($_SESSION["username"])) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        //méret kezelés
        if ($_FILES["fileToUpload"]["size"] > 50000000000) {
            echo "<script>alert('Sajnáljuk, a fájl túl nagy.'); window.location.href = 'profil.php';</script>";
            $uploadOk = 0;
        }
        // kivételkezelés (nemtudom h kell e, de i guess igen)
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "<script>alert('Sajnáljuk, csak JPG, JPEG, PNG és GIF fájlokat lehet feltölteni.'); window.location.href = 'profil.php';</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<script>alert('Sajnáljuk, a fájl feltöltése sikertelen.'); window.location.href = 'profil.php';</script>";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                include 'php/config/config.php';
                $conn = getConnection();
                $username = $_SESSION["username"];

                $sql = "UPDATE users SET imageURL='$targetFile' WHERE username='$username'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('A fájl ". basename( $_FILES["fileToUpload"]["name"]). " sikeresen mentve'); window.location.href = 'profil.php';</script>";
                } else {
                    echo "<script>alert('Hiba az adatok mentésekor: " . $conn->error . "'); window.location.href = 'profil.php';</script>";
                }
                $conn->close();
            } else {
                echo "<script>alert('Sajnáljuk, hiba történt a fájl feltöltése közben.'); window.location.href = 'profil.php';</script>";
            }
        }
    }
?>
