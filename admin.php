<?php
    include 'php/config/config.php';
    $conn = getConnection();
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $table_name = 'products';
    $sql = "SELECT table_name
            FROM information_schema.tables
            WHERE table_name = '$table_name'
            LIMIT 1";
    $table_result = $conn->query($sql);

    if ($table_result->num_rows > 0) {
        $download_sql = "SELECT * FROM $table_name";
        $result = $conn->query($download_sql);
    } else {
        $result = [];
    }

    $conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <meta name="theme-color" content="#000">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Admin</title>
</head>
<body>
    <header>
        <a href="index.php" class="adminLogoAnchor">
        <object
            class="logo"
            data="assets/logo.svg"
        ></object>
        </a>
        <div class="headerButtonsContainer">
            <button
                class="headerButton"
                id="saveProductsButton"
                disabled
            >
                Mentés
            </button>
            <button
                class="headerButton"
                id="addProductButton"
            >
                Új termék
            </button>
        </div>
    </header>
    <main>
        <table id="table">
            <thead>
                <tr>
                    <th>Név</th>
                    <th>Kép</th>
                    <th>Leírás</th>
                    <th>Bruttó ár</th>
                    <th>Kedvezmény</th>
                    <th>CPU</th>
                    <th>GPU</th>
                    <th>Memória</th>
                    <th>Operációs rendszer</th>
                    <th>Tárhely</th>
                    <th>Kategória</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 0;

                    while($result == [] ? $row = NULL : $row = mysqli_fetch_assoc($result))
                    {
                ?>
                <tr name="<?php echo $row["id"] ?>" id="tableRow_final_<?php echo $i ?>">
                    <td>
                        <input name="tableInputName" id="tableInputName_${currentIndex}" class="tableInput" placeholder="Termék neve" value="<?php echo $row['name'] ?>">
                    </td>
                    <td>
                        <div class="tableCheckboxContainer">
                            <img id="tableRow_final_image_<?php echo $i ?>" class="indexPic" alt="<?php if($row['imageURL'] == ''){echo "assets/placeholder.svg";} else {echo $row['imageURL'];} ?>" src="<?php if($row['imageURL'] == ''){echo "assets/placeholder.svg";} else {echo $row['imageURL'];} ?>" />
                            <input name="tableInputFile" id="tableInputFile_${currentIndex}" type="file">
                        </div>
                    </td>
                    <td>
                        <input name="tableInputDescription" id="tableInputDescription_${currentIndex}" class="tableInput" placeholder="Leírás... (HTML5)" value="<?php echo $row['description'] ?>">
                    </td>
                    <td>
                        <div class="tableInputContainer">
                            <input name="tableInputPrice" id="tableInputPrice_${currentIndex}" placeholder="Bruttó ár" type="number" class="tableInput tableInputPrice" value="<?php echo $row['price'] ?>">
                            <div class="tablePriceText">
                                Ft
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="tableInputContainer">
                            <input name="tableInputSale" id="tableInputSale_${currentIndex}" placeholder="Kedvezmény (%)" type="number" class="tableInput tableInputPrice" value="<?php echo $row['sale'] ?>">
                            <div class="tablePriceText">
                                %
                            </div>
                        </div>
                    </td>
                    <td><select name="tableInputCPU" id="tableInputCPU_${currentIndex}" class="tableInput tableInputSelect">
                        <option <?php if($row['CPU'] == 0){echo "selected";} ?>>...</option>
                        <option <?php if($row['CPU'] == 1){echo "selected";} ?>>i3</option>
                        <option <?php if($row['CPU'] == 2){echo "selected";} ?>>i5</option>
                        <option <?php if($row['CPU'] == 3){echo "selected";} ?>>i7</option>
                        <option <?php if($row['CPU'] == 4){echo "selected";} ?>>i9</option>
                    </select></td>
                    <td><select name="tableInputGPU" id="tableInputGPU_${currentIndex}" class="tableInput tableInputSelect">
                        <option <?php if($row['GPU'] == 0){echo "selected";} ?>>...</option>
                        <option <?php if($row['GPU'] == 1){echo "selected";} ?>>Nvidia GeForce RTX 3050</option>
                        <option <?php if($row['GPU'] == 2){echo "selected";} ?>>Nvidia GeForce RTX 3060</option>
                        <option <?php if($row['GPU'] == 3){echo "selected";} ?>>Nvidia GeForce RTX 3070</option>
                        <option <?php if($row['GPU'] == 4){echo "selected";} ?>>Nvidia GeForce RTX 3080</option>
                        <option <?php if($row['GPU'] == 5){echo "selected";} ?>>Nvidia GeForce RTX 3090</option>
                        <option <?php if($row['GPU'] == 6){echo "selected";} ?>>Nvidia GeForce RTX 4060</option>
                        <option <?php if($row['GPU'] == 7){echo "selected";} ?>>Nvidia GeForce RTX 4070</option>
                        <option <?php if($row['GPU'] == 8){echo "selected";} ?>>Nvidia GeForce RTX 4080</option>
                        <option <?php if($row['GPU'] == 9){echo "selected";} ?>>Nvidia GeForce RTX 4090</option>
                    </select></td>
                    <td><select name="tableInputMEMORY" id="tableInputMEMORY_${currentIndex}" class="tableInput tableInputSelect">
                        <option <?php if($row['MEMORY'] == 0){echo "selected";} ?>>...</option>
                        <option <?php if($row['MEMORY'] == 1){echo "selected";} ?>>2 GB</option>
                        <option <?php if($row['MEMORY'] == 2){echo "selected";} ?>>4 GB</option>
                        <option <?php if($row['MEMORY'] == 3){echo "selected";} ?>>8 GB</option>
                        <option <?php if($row['MEMORY'] == 4){echo "selected";} ?>>16 GB</option>
                        <option <?php if($row['MEMORY'] == 5){echo "selected";} ?>>32 GB</option>
                        <option <?php if($row['MEMORY'] == 6){echo "selected";} ?>>64 GB</option>
                    </select></td>
                    <td><select name="tableInputOPSYSTEM" id="tableInputOPSYSTEM_${currentIndex}" class="tableInput tableInputSelect">
                        <option <?php if($row['OPSYSTEM'] == 0){echo "selected";} ?>>...</option>
                        <option <?php if($row['OPSYSTEM'] == 1){echo "selected";} ?>>Windows (64bit)</option>
                        <option <?php if($row['OPSYSTEM'] == 2){echo "selected";} ?>>Windows 10 (64bit)</option>
                        <option <?php if($row['OPSYSTEM'] == 3){echo "selected";} ?>>Windows 11 (64bit)</option>
                    </select></td>
                    <td>
                        <div class="tableInputContainer">
                            <input name="tableInputSTORAGE" id="tableInputSTORAGE_${currentIndex}" placeholder="Minimum tárhely (GB)" type="number" class="tableInput tableInputPrice" value="<?php if($row['STORAGE_GB'] == 0) {echo "";} else {echo $row['STORAGE_GB'];} ?>">
                            <div class="tablePriceText">
                                GB
                            </div>
                        </div>
                    </td>
                    <td><select name="tableInputCategory" id="tableInputCategory_${currentIndex}" class="tableInput tableInputSelect">
                        <option <?php if($row['category_id'] == 0){echo "selected";} ?>>...</option>
                        <option <?php if($row['category_id'] == 1){echo "selected";} ?>>PC</option>
                        <option <?php if($row['category_id'] == 2){echo "selected";} ?>>Playstation</option>
                        <option <?php if($row['category_id'] == 3){echo "selected";} ?>>Xbox</option>
                        <option <?php if($row['category_id'] == 4){echo "selected";} ?>>Nintendo</option>
                    </select></td>
                    <td>
                        <button id="tableDeleteButton_final" class="tableDeleteIconContainer">
                            <object class="tableDeleteIcon" data="assets/delete.svg"></object>
                        </button>
                    </td>
                </tr>
                <?php
                $i = $i + 1;

                    }
                ?>
            </tbody>
        </table>
    </main>
    <script src="./js/admin.js"></script>
    <script src="jquery-3.7.1.min.js"></script>
</body>
</html>