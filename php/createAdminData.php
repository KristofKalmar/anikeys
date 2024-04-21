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
    move_uploaded_file($_FILES['imageURL']['tmp_name'], '../uploads/' . $_FILES['imageURL']['name']);
}


$imageURL = !empty($_FILES) ? 'uploads/' . $_FILES['imageURL']['name'] : '';

$sql = "CREATE TABLE IF NOT EXISTS products (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price INT NOT NULL,
  description TEXT NOT NULL,
  sale INT NOT NULL,
  category_id INT NOT NULL,
  creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  imageURL VARCHAR(255) DEFAULT NULL,
  CPU INT DEFAULT 0,
  GPU INT DEFAULT 0,
  MEMORY INT DEFAULT 0,
  OPSYSTEM INT DEFAULT 0,
  STORAGE_GB INT DEFAULT 0,
  CONSTRAINT CHK_Sale CHECK (sale BETWEEN 0 AND 100),
  CONSTRAINT CHK_CategoryID CHECK (category_id BETWEEN 0 AND 4)
);";


if (!mysqli_query($conn, $sql)) {
    echo "Error creating table: " . mysqli_error($conn);
} else {


    $sql = "INSERT INTO products (name, price, description, sale, category_id, CPU, GPU, MEMORY, OPSYSTEM, STORAGE_GB, imageURL)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);


    $stmt->bind_param("sdssdddddds", $name, $priceVAT, $_POST['descriptionHTML'], $sale, $category, $_POST['CPU'], $_POST['GPU'], $_POST['MEMORY'], $_POST['OPSYSTEM'], $_POST['STORAGE'], $imageURL);


    if (!$stmt->execute()) {
        echo "Error inserting data: " . mysqli_error($conn);
    } else {

    }
}


mysqli_close($conn);
