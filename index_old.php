<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#00243D">
    <title>ANI KEYS</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/index.js"></script>
  </head>
  <body>
	  <script src="./components/header/header.js"></script>
	  <script src="./components/footer/footer.js"></script>
	  <script src="./components/showcasedItem/showcasedItem.js"></script>
	  <script src="./components/rowList/rowList.js"></script>
    <div id="header"></div>
    <div class="hl_textbox">
      <img src="./assets/hfw.jpg" alt="h1" class="hl_img" />
      <div class="hl_textbox_contentContainer">
        <img class="hl_logo" alt="h1" src="assets/hfw_logo.svg" />
        <div class="hl_buttonContainer">
          <a href="productDetails.html" class="hl_button">Megtekintés</a>
          <button class="hl_button">Kosárba</button>
        </div>
      </div>
    </div>
    <div id="showcasedItems"></div>
    <div data-title="Kiemelt ajánlatok" data-logo="sale.svg" id="rowList"></div>
    <div id="footer"></div>
  </body>
</html>