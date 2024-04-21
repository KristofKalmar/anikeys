<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "anikeys");

ini_set('display_errors', 1);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}


$name = $_POST['name'];
$priceVAT = $_POST['priceVAT'];
$sale = $_POST['sale'];
$category = $_POST['category'];

if (empty($name) || strlen($name) > 255) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid name: Name cannot be empty or longer than 255 characters."]);
    exit;
}

if (!is_numeric($priceVAT) || $priceVAT <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid priceVAT: Price must be a positive number."]);
    exit;
}

if (!is_numeric($sale) || $sale < 0 || $sale > 100) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid sale: Sale must be between 0 and 100."]);
    exit;
}

if (!is_numeric($category) || $category < 0 || $category > 4) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid category: Category must be between 0 and 4."]);
    exit;
}

if (!empty($_FILES)) {
    unlink($_POST['oldImagePath']);
    $newImagePath = '../uploads/' . $_FILES['imageURL']['name'];
    $newUploadPath = 'uploads/' . $_FILES['imageURL']['name'];
    move_uploaded_file($_FILES['imageURL']['tmp_name'], $newImagePath);
} else {

    $newUploadPath = $_POST['oldImagePath'];
    $newImagePath = $_POST['oldImagePath'];
}

$imageURL = $newUploadPath;

$query = "UPDATE products
SET name = ?,
    price = ?,
    description = ?,
    sale = ?,
    category_id = ?,
    CPU = ?,
    GPU = ?,
    MEMORY = ?,
    OPSYSTEM = ?,
    STORAGE_GB = ?,
    imageURL = ?
WHERE id = ?";


$stmt = $conn->prepare($query);
$stmt->bind_param("sdsiiiiiiisi", $name, $priceVAT, $_POST['descriptionHTML'], $sale, $category, $_POST['CPU'], $_POST['GPU'], $_POST['MEMORY'], $_POST['OPSYSTEM'], $_POST['STORAGE'], $imageURL, $_POST['id']);
$stmt->execute();
$stmt->close();
