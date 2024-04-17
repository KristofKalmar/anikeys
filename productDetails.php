<?php 
    session_start();    
    include 'config.php';
    $conn = getConnection();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit(); 
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#00243D">
    <title>ANI KEYS</title>
    <link rel="stylesheet" href="css/productDetails.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <script src="js/jquery-3.7.1.min.js"></script>
  </head>
  <body>
    <?php include './componentsphp/header/header.php'; ?>
	  <script src="./components/footer/footer.js"></script>
	  <script src="./components/rowList/rowList.js"></script>
    <div class="productDetailsContainer">
        <img src="assets/avatar.jpg" alt="Avatar" class="productDetailsHeroBackgroundImage" />
        <img src="assets/avatar.jpg" alt="Herosimg" class="productDetailsHeroImage" />
        <div class="productDetailsContentContainer">
            <p class="productDetailsTitle">Avatar: Frontiers of Pandora</p>
            <p class="productDetailsDescriptionText">
                Termékleírás:
                <br><br>
                Üdvözöllek a lélegzetelállító Pandora világában az "Avatar: Frontiers of Pandora" epikus nyílt világú akció-kalandjátékban, amely elragad téged James Cameron ikonikus filmuniverzumának buja és vibráló tájaira. A történet az első film eseményei előtt játszódik, és egy Na'vi harcosként indulhatsz el egy úton, hogy megvéd a hazádat az RDA vállalat behatoló ereje ellen.
                <br><br>
                Fedezd fel Pandora kiterjedő dzsungeleit, magasodó hegyeit és titokzatos biolumineszcens erdeit, miközben izgalmas harcokba bocsátkozol, megoldasz környezeti rejtvényeket és szövetséget kovácsolsz ennek a idegen világnak a sokféle lakójával. A lenyűgöző grafika, az innovatív játékmechanikák és a lebilincselő történettel az "Avatar: Frontiers of Pandora" egy felejthetetlen játékélményt nyújt, amely másokhoz nem hasonlítható.
                <br><br>
                <div class="productDetailsTableTitle">Ajánlott specifikációk:</div>
                <table class="productDetailsTable">
                    <tbody>
                        <tr>
                            <th>Operációs Rendszer</th>
                            <td>Windows 10 (64-bit)</td>
                        </tr>
                        <tr>
                            <th>Processzor</th>
                            <td>AMD Ryzen 7 5800X vagy Intel Core i7-10700K</td>
                        </tr>
                        <tr>
                            <th>Memória</th>
                            <td>16 GB RAM</td>
                        </tr>
                        <tr>
                            <th>Grafikus Kártya</th>
                            <td>NVIDIA GeForce RTX 3080 vagy AMD Radeon RX 6800 XT</td>
                        </tr>
                        <tr>
                            <th>Tárhely</th>
                            <td>50 GB szabad hely (SSD ajánlott)</td>
                        </tr>
                        <tr>
                            <th>DirectX</th>
                            <td>Verzió 12</td>
                        </tr>
                        <tr>
                            <th>További Megjegyzések</th>
                            <td>Szélessávú internetkapcsolat szükséges az online funkciókhoz</td>
                        </tr>
                    </tbody>
                </table>
                <div class="productDetailsTableSpacer"></div>
                <div class="productDetailsTableTitle">Minimális specifikációk:</div>
                <table class="productDetailsTable">
                    <tbody>
                        <tr>
                            <th>Operációs Rendszer</th>
                            <td>Windows 10 (64-bit)</td>
                        </tr>
                        <tr>
                            <th>Processzor</th>
                            <td>AMD Ryzen 5 3600 vagy Intel Core i5-9400F</td>
                        </tr>
                        <tr>
                            <th>Memória</th>
                            <td>8 GB RAM</td>
                        </tr>
                        <tr>
                            <th>Grafikus Kártya</th>
                            <td>NVIDIA GeForce GTX 1660 Ti vagy AMD Radeon RX 5700</td>
                        </tr>
                        <tr>
                            <th>Tárhely</th>
                            <td>50 GB szabad hely (SSD ajánlott)</td>
                        </tr>
                        <tr>
                            <th>DirectX</th>
                            <td>Verzió 12</td>
                        </tr>
                        <tr>
                            <th>További Megjegyzések</th>
                            <td>Szélessávú internetkapcsolat szükséges az online funkciókhoz</td>
                        </tr>
                    </tbody>
                </table>
            </p>
        </div>
    </div>
    <div class="productDetailsBuyContainer">
        <div class="productDetailsBuyContentContainer">
            <button class="productDetailsPurchaseButton">Kosárba</button>
            <p class="productDetailsPrice" >27,490 Ft</p>
        </div>
    </div>
    <?php include './componentsphp/rowList/rowList.php'; ?>
    <div data-title="Kiemelt ajánlatok" data-logo="sale.svg" id="rowList"></div>
    <?php include './componentsphp/footer/footer.php'; ?>
  </body>
</html>