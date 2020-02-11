<?php 
  require('./database.php');

  if (isset($_POST["create"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $queryCreate = "INSERT INTO accounts VALUES (null, '$username', '$password')";
    $sqlCreate = mysqli_query($connection, $queryCreate);

    echo '<script>alert("Successfull created!")</script>';
    echo '<script>window.location.href = "/php-crud-tutorial/index.php"</script>';
  } else {
    echo '<script>window.location.href = "/php-crud-tutorial/index.php"</script>';
  }
?>