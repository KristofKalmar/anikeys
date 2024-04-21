<?php
session_start();
ini_set('display_errors', 1);
include 'php/config/config.php';
$conn = getConnection();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

$create_cart_table_sql = "CREATE TABLE IF NOT EXISTS purchasedProducts (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_id` INT NOT NULL,
        `username` varchar(255) NOT NULL,
        `added_at` datetime DEFAULT current_timestamp(),
        `code` varchar(255) NOT NULL,
        `revealed` INT NOT NULL,
        PRIMARY KEY (`id`)
    );";

if ($conn->query($create_cart_table_sql) === TRUE) {
    $tableExistsQuery = "SELECT COUNT(*) AS table_exists
            FROM INFORMATION_SCHEMA.TABLES
            WHERE TABLE_NAME = 'purchasedProducts'";

    $result = mysqli_query($conn, $tableExistsQuery);
    $row = mysqli_fetch_assoc($result);
    $tableExists = $row['table_exists'];


    if ($tableExists) {
        $sql = "SELECT purchasedProducts.*, purchasedProducts.id AS id_pproduct, products.*
                    FROM purchasedProducts
                    INNER JOIN products ON purchasedProducts.product_id = products.id
                    WHERE purchasedProducts.username = '$username' ORDER BY products.name";
        $results = mysqli_query($conn, $sql);
    } else {
        $results = NULL;
    }
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (!empty($password) && strlen($password) >= 8) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql_update_password = "UPDATE users SET hashed_password = ? WHERE username = ?";
        $stmt_update_password = $conn->prepare($sql_update_password);
        $stmt_update_password->bind_param('ss', $hashed_password, $_SESSION['username']);
        $stmt_update_password->execute();
    }

    $sql_update_user = "UPDATE users SET username = ?, email = ? WHERE username = ?";
    $stmt_update_user = $conn->prepare($sql_update_user);
    $stmt_update_user->bind_param('sss', $name, $email, $_SESSION['username']);
    $stmt_update_user->execute();

    header("Location: profil.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $CPU = $_POST['CPU'];
    $GPU = $_POST['GPU'];
    $MEMORY = $_POST['MEMORY'];
    $OPSYSTEM = $_POST['OPSYSTEM'];

    $sql_update_user = "UPDATE users SET CPU = ?, GPU = ?, MEMORY = ?, OPSYSTEM = ? WHERE username = ?";
    $stmt_update_user = $conn->prepare($sql_update_user);
    $stmt_update_user->bind_param('dddd', $CPU, $GPU, $MEMORY, $OPSYSTEM);
    $stmt_update_user->execute();

    header("Location: profil.php");
    exit();
}

$sql_select_user = "SELECT * FROM users WHERE username = ?";
$stmt_select_user = $conn->prepare($sql_select_user);
$stmt_select_user->bind_param('s', $_SESSION['username']);
$stmt_select_user->execute();
$result_user = $stmt_select_user->get_result();
$user = $result_user->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="css/profil.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/profile.js"></script>
    <script src="js/imageUpload.js"></script>
</head>

<body>
    <script>
        function revealCode(productId) {
            $.ajax({
                type: 'POST',
                url: 'php/revealProduct.php',
                data: {
                    id: productId
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Hiba történt a termék eltávolítása közben.');
                }
            });
        }

        function deleteProfile(id) {
            $.ajax({
                type: 'POST',
                url: 'php/deleteUser.php',
                data: {
                    id: id
                },
                success: function(response) {
                    window.location.href = "index.php";
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Hiba történt a termék eltávolítása közben.');
                }
            });

            return false;
        }
    </script>
    <?php include 'php/components/header.php'; ?>
    <div class="container">
        <div class="colorBG"></div>
        <div class="verticalContainer">
            <div class="profileContentContainer">
                <div class="profileContentWidthContainer">
                    <div class="blurred">
                        <img class="profileBlurBG" alt="profkep" src="<?php if ($user['imageURL'] != "") {
                                                                            echo $user['imageURL'];
                                                                        } else {
                                                                            echo "assets/placeholder_large.svg";
                                                                        } ?>" />
                    </div>
                    <form action="php/uploadProfilePic.php" method="post" class="form" enctype="multipart/form-data">
                        <div class="profile">
                            <img class="profilePic" id="profilePic" src="<?php if ($user['imageURL'] != "") {
                                                                                echo $user['imageURL'];
                                                                            } else {
                                                                                echo "assets/placeholder_large.svg";
                                                                            } ?>" alt="Profilkép"> <br>
                            <div class="profileTextContainer">
                                <div class="name">
                                    <?php
                                    if ($user['name'] != NULL) {
                                        echo $user['name'];
                                    } else {
                                        echo $user['username'];
                                    }
                                    ?>
                                    <a href="php/logout.php">
                                        <img src="assets/logout.svg" alt="Logout" width="18" height="18">
                                    </a>
                                </div>
                                <div class="job">
                                    <?php
                                    if ($user['role'] != NULL) {
                                        if ($user['role'] == 'admin') {
                                            echo '<a href="admin.php" style="color: white; text-decoration: none;">' . $user['role'] . '</a>';
                                        } else {
                                            echo $user['role'];
                                        }
                                    } else {
                                        echo "Felhasználó";
                                    }
                                    ?>
                                </div>
                                <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;"> <br>
                                <button class="button" id="saveBtn" type="imgSubmit" name="imgSubmit">Feltöltés</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="sidenav">
            <div class="sidenav-url">
                <?php
                if ($user['role'] == 'admin') {
                    echo '<div class="url"><a href="admin.php">Admin</a></div>';
                }
                ?>
                <div class="url">
                    <a href="#profile" onclick="showIdentity()">Profil</a>
                </div>
                <div class="url">
                    <a href="#settings" onclick="showSettings()">Beállítások</a>
                </div>
                <div class="url">
                    <a href="#changepass" onclick="showChangePassword()">Jelszó változtatás</a>
                </div>
                <div class="url">
                    <a href="#purchased-products" onclick="showPurchasedProducts()">Megvásárolt termékek</a>
                </div>
                <div class="url">
                    <a href="#notifications" onclick="showNotifications()">Értesítések</a>
                </div>
                <div class="url">
                    <a href="logout.php">Kijelentkezés</a>
                </div>
            </div>
        </div>
        <?php
        if ($results != NULL && $results->num_rows > 0) {
        ?>
            <div id="purchasedProductsSection" class="purchasedProductsSection">
                <div class="sectionContentContainer">
                    <div class="contentTitleContainer">
                        Termékkulcsaim
                        <div class="rowListDivider"></div>
                    </div>
                    <div class="card">
                        <div class="card-body card-table">
                            <table class="productsTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Név</th>
                                        <th>Termékkód</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($results != NULL && $results->num_rows > 0) {
                                        while ($row = $results->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td class="tableImg"><img class='tableImg' alt='Avatar' src="<?php if ($row['imageURL'] !== "") {
                                                                                                                    echo $row['imageURL'];
                                                                                                                } else {
                                                                                                                    echo 'assets/placeholder_large.svg';
                                                                                                                } ?>" width="96" height="96"></td>
                                                <td class="nameCell">
                                                    <div><?php echo $row['name'] ?></div>
                                                </td>
                                                <td class="priceCell">
                                                    <div><?php if ($row['revealed'] == true) {
                                                                echo $row['code'];
                                                            } ?><?php if ($row['revealed'] == false) { ?><button onclick="revealCode(<?php echo $row['id_pproduct'] ?>)">Felfedés</button><?php } ?></div>
                                                </td>
                                            </tr>
                                            <tr class="separator"></tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>Nincs elem a kosárban.</td></tr>";
                                    }

                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- Profil (általános) Section -->
        <div class="main">
            <div class="identitySection" id="identitySection">
                <div class="sectionContentContainer noGap">
                    <div class="contentTitleContainer titleContainerLight">
                        Általános
                        <div class="rowListDivider"></div>
                    </div>
                    <div class="card">
                        <i class="fa fa-pen fa-xs edit"></i>
                        <form action="php/updateprofile.php" method="post">
                            <table class="dataTable">
                                <tbody>
                                    <tr>
                                        <td>Neved</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Felhasználónév</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="text" id="newUsername" name="newUsername" value="<?php echo $user['username']; ?>" required>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lakcím</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telefonszám:</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Születésnap</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="date" id="birthday" name="birthday" value="<?php echo $user['birthday']; ?>" required>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="button" id="saveBtn" type="submit" name="save">Adatok mentése</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="identitySection card-specifications" id="identitySection">
                <div class="sectionContentContainer noGap">
                    <div class="contentTitleContainer titleContainerLight">
                        Saját specifikációk
                        <div class="rowListDivider"></div>
                    </div>
                    <div class="card">
                        <i class="fa fa-pen fa-xs edit"></i>
                        <form action="php/updateSpecs.php" method="post">
                            <table class="dataTable">
                                <tbody>
                                    <tr>
                                        <td>CPU</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <select id="CPU" name="CPU">
                                                    <option <?php if ($user['CPU'] == 0) {
                                                                echo "selected";
                                                            } ?> value="0">-</option>
                                                    <option <?php if ($user['CPU'] == 1) {
                                                                echo "selected";
                                                            } ?> value="1">i3</option>
                                                    <option <?php if ($user['CPU'] == 2) {
                                                                echo "selected";
                                                            } ?> value="2">i5</option>
                                                    <option <?php if ($user['CPU'] == 3) {
                                                                echo "selected";
                                                            } ?> value="3">i7</option>
                                                    <option <?php if ($user['CPU'] == 4) {
                                                                echo "selected";
                                                            } ?> value="4">i9</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>GPU</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <select id="GPU" name="GPU">
                                                    <option <?php if ($user['GPU'] == 0) {
                                                                echo "selected";
                                                            } ?> value="0">-</option>
                                                    <option <?php if ($user['GPU'] == 1) {
                                                                echo "selected";
                                                            } ?> value="1">Nvidia GeForce RTX 3050</option>
                                                    <option <?php if ($user['GPU'] == 2) {
                                                                echo "selected";
                                                            } ?> value="2">Nvidia GeForce RTX 3060</option>
                                                    <option <?php if ($user['GPU'] == 3) {
                                                                echo "selected";
                                                            } ?> value="3">Nvidia GeForce RTX 3070</option>
                                                    <option <?php if ($user['GPU'] == 4) {
                                                                echo "selected";
                                                            } ?> value="4">Nvidia GeForce RTX 3080</option>
                                                    <option <?php if ($user['GPU'] == 5) {
                                                                echo "selected";
                                                            } ?> value="5">Nvidia GeForce RTX 3090</option>
                                                    <option <?php if ($user['GPU'] == 6) {
                                                                echo "selected";
                                                            } ?> value="6">Nvidia GeForce RTX 4060</option>
                                                    <option <?php if ($user['GPU'] == 7) {
                                                                echo "selected";
                                                            } ?> value="7">Nvidia GeForce RTX 4070</option>
                                                    <option <?php if ($user['GPU'] == 8) {
                                                                echo "selected";
                                                            } ?> value="8">Nvidia GeForce RTX 4080</option>
                                                    <option <?php if ($user['GPU'] == 9) {
                                                                echo "selected";
                                                            } ?> value="9">Nvidia GeForce RTX 4090</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Memória</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <select id="MEMORY" name="MEMORY">
                                                    <option <?php if ($user['MEMORY'] == 0) {
                                                                echo "selected";
                                                            } ?> value="0">-</option>
                                                    <option <?php if ($user['MEMORY'] == 1) {
                                                                echo "selected";
                                                            } ?> value="1">2 GB</option>
                                                    <option <?php if ($user['MEMORY'] == 2) {
                                                                echo "selected";
                                                            } ?> value="2">4 GB</option>
                                                    <option <?php if ($user['MEMORY'] == 3) {
                                                                echo "selected";
                                                            } ?> value="3">8 GB</option>
                                                    <option <?php if ($user['MEMORY'] == 4) {
                                                                echo "selected";
                                                            } ?> value="4">16 GB</option>
                                                    <option <?php if ($user['MEMORY'] == 5) {
                                                                echo "selected";
                                                            } ?> value="5">32 GB</option>
                                                    <option <?php if ($user['MEMORY'] == 6) {
                                                                echo "selected";
                                                            } ?> value="6">64 GB</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Operációs rendszer</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <select id="OPSYSTEM" name="OPSYSTEM">
                                                    <option <?php if ($user['OPSYSTEM'] == 0) {
                                                                echo "selected";
                                                            } ?> value="0">-</option>
                                                    <option <?php if ($user['OPSYSTEM'] == 1) {
                                                                echo "selected";
                                                            } ?> value="1">Windows 7 (64bit)</option>
                                                    <option <?php if ($user['OPSYSTEM'] == 2) {
                                                                echo "selected";
                                                            } ?> value="2">Windows 10 (64bit)</option>
                                                    <option <?php if ($user['OPSYSTEM'] == 3) {
                                                                echo "selected";
                                                            } ?> value="3">Windows 11 (64bit)</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="button" id="saveBtn" type="submit" name="save_specs">Adatok mentése</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Jelszó változtatás Section -->
            <div class="settingsContainer card-password" id="changepassSection">
                <div class="sectionContentContainer">
                    <div class="contentTitleContainer titleContainerLight">
                        Jelszó visszaállítása
                        <div class="rowListDivider"></div>
                    </div>
                    <div class="card">
                        <i class="fa fa-pen fa-xs edit"></i>
                        <form action="php/updatepassword.php" method="post">
                            <table class="dataTable">
                                <tbody>
                                    <tr>
                                        <td>Felhasználó neved</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="text" name="username" maxlength="25" id="felhasznaloneved" placeholder="Minta név" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jelenlegi jelszó</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="password" name="password" maxlength="25" required id="jelenlegijelszod">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Új jelszó</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="password" name="new_password" maxlength="25" required id="ujjelszod">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Új jelszó mégegyszer</td>
                                        <td>
                                            <div class="input-wrapper">
                                                <input type="password" name="confirm_new_password" maxlength="25" required id="ujjelszod_megerosit">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="buttonsContainer">
                                <button class="button" type="submit" name="save">Adatok mentése</button>
                            </div>
                        </form>
                        <div class="deleteProfileContainer">
                            <button class="button" onclick="return deleteProfile(<?php echo $user['id'] ?>);">Profil törlése</button>
                            Figyelem, a törlés után a profilt nem lehet visszaállítani!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include 'php/components/footer.php'; ?>
</body>

</html>