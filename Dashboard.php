<?php
  echo"logged in";
  if (isset($_POST['logout'])) {
    session_unset();  
    session_destroy();  
    echo"session destroy";
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
<button type="submit" name="logout">Logout</button>
</body>
</html>