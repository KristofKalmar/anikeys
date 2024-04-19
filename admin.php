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