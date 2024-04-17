<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#00243D">
    <title>Összes termék</title>

    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="stylesheet" href="allProducts.css">
    <link rel="stylesheet" href="./componentsphp/header/header.css">
    <link rel="stylesheet" href="./componentsphp/footer/footer.css">
    <link rel="stylesheet" href="./componentsphp/rowList/rowList.css">
    <link rel="stylesheet" href="./componentsphp/showcasedItem/showcasedItem.css">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <script src="js/jquery-3.7.1.min.js"></script>
  </head>
  <body>
    <?php include './componentsphp/header/header.php'; ?> <br> 
    <div data-title="Keresés eredménye" data-logo="search_category.svg" data-multiLine="true" id="rowList"></div>
    <div class="pagionationContainer">
        <div class="paginationContentContainer">
            <div class="paginationPage">
                1
            </div>
            <div class="paginationPage">
                2
            </div>
            <div class="paginationDots">
                ...
            </div>
            <div class="paginationPage">
                →
            </div>
            <div class="paginationPage">
                10
            </div>
        </div> 
    </div>  <br> <br> 
    <?php include './componentsphp/showcasedItem/showcasedItem.php'; ?>
    <div data-title="Kiemelt ajánlatok"  data-logo="sale.svg" ></div>
    <?php include './componentsphp/rowList/rowList.php"'; ?>
    <?php include './componentsphp/footer/footer.php'; ?>
  </body>
</html>