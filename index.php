<?php

class Logger {
    private $color;       
    public $fruit;      
    protected $fastfood;  

    public function __construct($color, $fruit, $fastfood) {
        $this->color = $color;      
        $this->fruit = $fruit;       
        $this->fastfood = $fastfood; 
    }

    public function display() {
        echo "Color: " . $this->color . "<br>";
        echo "Fruit: " . $this->fruit . "<br>";
        echo "Fast Food: " . $this->fastfood . "<br>";
    }
}


$obj = new Logger("red", "apple", "burger");
$obj->display();


class log extends logger{
     public function displayFastfood(){
     return $this->display();
     }
}
class login extends logger{
    public function displayFastfood(){
    return $this->display();
    }
}

$obj2 = new login("yellow", "mango", "nuggets");
$obj2->display();

session_start();
//Form handling and validation 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $file = '';

    if (!isset($name) || empty($name)) {
        echo "Name is required.<br>";
    } else {
        echo "Name: $name<br>";
    }

    if (!isset($email) || empty($email)) {
        echo "Email is required.<br>";
    } else {
        echo "Email: $email<br>";
    }

    if (!isset($status) || empty($status)) {
        echo "Status is required.<br>";
    } else {
        echo "Status: $status<br>";
    }

    if (!isset($_FILES['file']['name']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo "File upload failed.<br>";
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        echo "Invalid name: Only letters and spaces are allowed.<br>";
    } else {
        echo "Valid name: $name<br>";
    }

    if (!preg_match("/^[\w\-\.]+@([\w\-]+\.)+[a-zA-Z]{2,7}$/", $email)) {
        echo "Invalid email format.<br>";
    } else {
        echo "Valid email: $email<br>";
    }
    if (!preg_match("/^[a-zA-Z]+$/", $status)) {
        echo "Invalid status: Only alphabets are allowed.<br>";
    } else {
        echo "Valid status: $status<br>";
    }


    if (isset($_FILES['file'])) {
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 2 * 1024 * 1024; 
        $fileType = mime_content_type($_FILES['file']['tmp_name']);
        $fileSize = $_FILES['file']['size'];
        $uploadDir = "uploads/";
        $targetFile = $uploadDir . basename($_FILES['file']['name']);
        echo "$targetFile.file is uploaded";
        if (!in_array($fileType, $allowedTypes)) {
            echo "Only JPG and PNG files are allowed.<br>";
        } elseif ($fileSize > $maxSize) {
            echo "File size exceeds 2MB.<br>";
        } elseif (!move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            echo "Failed to upload file.<br>";
        }
    }


    $_SESSION['name.id'] = $name;
    $_SESSION[$email] = $email;
    $_SESSION[$status] = $status;
    $_SESSION[$file] = $file;

    // Check if all session variables are set
    if (!isset($_SESSION[$name]) && !isset($_SESSION[$email]) && !isset($_SESSION[$status]) && !isset($_SESSION[$file])) {
        echo "One or more session variables are not set.";
    } else {
        echo "All session variables are set.";
    }

    
    if (isset($_SESSION['name.id'])) {
        echo "Already logged in.<br>";
    } else {
        var_dump($_SESSION);
        echo "User is not logged in.<br>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="Dashboard.php" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br><br>

        <label for="status">Status:</label>
        <input type="text" name="status" id="status"><br><br>

        <label for="file">Upload File:</label>
        <input type="file" name="file" id="file" accept=".jpg,.png,.pdf"><br><br>
        <button type="submit">Submit</button>
    </form>
</body>

</html>