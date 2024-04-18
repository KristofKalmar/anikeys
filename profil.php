<?php
    session_start();
    ini_set('display_errors', 1);
    include 'php/config/config.php';
    $conn = getConnection();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // További adatok frissítése
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

        header("Location: profile.php");
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
    <?php include 'php/components/header.php'; ?>
    <div class="container">
        <div class="colorBG"></div>
        <div class="verticalContainer">
        <div class="profileContentContainer">
            <div class="profileContentWidthContainer">
                <img class="profileBlurBG" alt="profkep" src="assets/profilkep.jpg" />
                <div class="profile">
                    <form action="updateprofile.php" method="post" enctype="multipart/form-data">
                            <img src="<?php echo $user['imageURL']; ?>" alt="profkep" id="profilePic">
                            <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">   
                    </form>             
                    <div class="profileTextContainer">
                    <div class="name">
                            <?php
                                echo $user['name'];
                            ?>
                        </div>
                        <div class="job">
                            <?php
                                echo $user['role'];
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="contentContainer">
    <div class="sidenav">
        <div class="sidenav-url">
            <div class="url">
                <a href="index.php" onclick="showIdentity()">Főoldal</a>
            </div>
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
                <a href="#notifications" onclick="showNotifications()">Értesítések</a>
            </div>
			<div class="url">
                <a href="logout.php">Kijelentkezés</a>
            </div>
        </div>
    </div>
    <!-- Profil (általános) Section -->
    <div class="main">
        <div class="identitySection" id="identitySection">
            <h2>Általános</h2>
            <div class="card">
                <div class="card-body">
                    <i class="fa fa-pen fa-xs edit"></i>
					<form action="updateprofile.php" method="post">
                    <table>
                        <tbody>
                            <tr>
                                <td>Neved</td>
                                <td>:</td>
                                <td>
									<div class="input-wrapper">
									<input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
									</div>
								</td>
                            </tr>
                            <tr>
                                <td>Felhasználónév</td>
                                <td>:</td>
                                <td>
                                    <div class="input-wrapper">
                                        <input type="text" id="newUsername" name="newUsername" value="<?php echo $user['username']; ?>" required>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <div class="input-wrapper">
                                        <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Lakcím</td>
                                <td>:</td>
                                <td>
									<div class="input-wrapper">
									<input type="text" id="address"   name="address" value="<?php echo $user['address']; ?>" required>
									</div>
								</td>
                            </tr>
                            <tr>
                                <td>Telefonszám:</td>
                                <td>:</td>
                                <td>
									<div class="input-wrapper">
									<input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
									</div>

								</td>
                            </tr>
                            <tr>
                                <td>Születésnap</td>
                                <td>:</td>
                                <td>
									<div class="input-wrapper">
									<input type="date" id="birthday"  name="birthday" value="<?php echo $user['birthday']; ?>" required >
									</div>
								</td>
                            </tr>
                            <tr>
                                <td>
									 <button class="button" id="saveBtn" type="submit" name="save">Adatok mentése</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
					</form>
                </div>
            </div>
        </div>
		<!-- Beállítások Section -->
        <div id="settingsSection" style="display:none;">
            <h2>Beállítások</h2>
            <div class="card">
                <div class="card-body">
                    <i class="fa fa-pen fa-xs edit"></i>
                    <table>
                        <tbody>
                            <tr>
                                <td>Kommunikációs preferenciák</td>
                                <td>:</td>
                                <td>
                                    <label><input type="checkbox" name="email_notification" checked> Email értesítések</label><br>
                                    <label><input type="checkbox" name="newsletter_subscription" checked> Hírlevél feliratkozás</label><br>
                                </td>
                            </tr>
                            <tr>
                                <td>Privát beállítások</td>
                                <td>:</td>
                                <td>
                                    <label><input type="checkbox" name="profile_visibility" checked> Profil láthatósága</label><br>
                                </td>
                            </tr>
                            <tr>
                                <td>Nyelvi preferenciák</td>
                                <td>:</td>
                                <td>
                                    <div class="select-wrapper">
                                        <select name="select2">
                                            <option value="angol">Angol</option>
                                            <option value="nemet">Német</option>
                                            <option value="magyar" selected>Magyar</option>
                                         </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="button" name="save">Adatok mentése</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Jelszó változtatás Section -->
        <div id="changepassSection" style="display:none;">
            <h2>Jelszó változtatás</h2>
            <div class="card">
                <div class="card-body">
                    <i class="fa fa-pen fa-xs edit"></i>
                    <form action="updatepassword.php" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>Felhasználó neved</td>
                            <td>:</td>
                            <td>
                                <div class="input-wrapper">
                                    <input type="text" name="username" maxlength="25" id="felhasznaloneved" placeholder="Minta név" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Jelenlegi jelszó</td>
                            <td>:</td>
                            <td>
                                <div class="input-wrapper">
                                    <input type="password" name="password" maxlength="25" required id="jelenlegijelszod">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Új jelszó</td>
                            <td>:</td>
                            <td>
                                <div class="input-wrapper">
                                    <input type="password" name="new_password" maxlength="25" required id="ujjelszod">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Új jelszó mégegyszer</td>
                            <td>:</td>
                            <td>
                                <div class="input-wrapper">
                                    <input type="password" name="confirm_new_password" maxlength="25" required id="ujjelszod_megerosit">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="button" type="submit" name="save">Adatok mentése</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
                </div>
            </div>
        </div>

        <!-- Értesítések Section -->
        <div id="notificationsSection" style="display:none;">
            <h2>Értesítések</h2>
            <div class="card">
                <div class="card-body">
                     <i class="fa fa-pen fa-xs edit"></i>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <label class="switcher">
                                    <input type="checkbox" class="switcher-input" checked>
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Születésnapi ajánlatok</span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" >
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Kiemelt események és időszakok</span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Kiemelt ajánlatok és promóciók</span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" >
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Fontos frissítések és változások</span> <br>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Elhagyott kosár emlékeztető</span> <br>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" >
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Rendelés visszaigazolása</span> <br>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Rendelés státusza</span> <br>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="button">Adatok mentése</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    </div>

</div></div>
      <?php include 'php/components/footer.php'; ?>
</body>

</html>