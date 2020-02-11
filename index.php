<?php 
  require("./read.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP CRUD by bossROD</title>
</head>

<style>
  html, body {
    margin: 0;
    padding: 0;
  }
  .main {
    height: 100vh;

    /* Grid */
    display: grid;
    grid-template-rows: auto auto 1fr;
    justify-items: center;
    row-gap: 20px;
    
  }
  .main .create-main {
    grid-row: 1/2;
    display: grid;
    grid-auto-rows: auto;
    row-gap: 5px;
  }
  .main .create-main h3 {
    text-align: center;
  }
  .main .export-main {
    grid-row: 2/3;
  }
  .main .read-main {
    grid-row: 3/4;
  }
  .main .read-main tr th {
    width: 200px;
  }
  .main .read-main tr td {
    text-align: center;
  }
  .main .read-main tr td:nth-child(4) {
    display: grid;
    grid-auto-flow: column;
  }
</style>

<body>
  <div class="main">
    <form class="create-main" action="/php-crud-tutorial/create.php" method="post">
      <h3>CREATE USER:</h3>
      <input type="text" name="username" placeholder="Enter username" required/>
      <input type="password" name="password" placeholder="Enter password" required/>
      <input type="submit" name="create" value="CREATE">
    </form>

    <form class="export-main" action="/php-crud-tutorial/pdf.php" method="post">
      <input type="submit" name="exportToPdf" value="EXPORT TO PDF" />
    </form>
    
    <table class="read-main">
      <tr>
        <th><a href="?column=id&sort=<?php echo $sort ?>">ID</a></th>
        <th><a href="?column=username&sort=<?php echo $sort ?>">USERNAME</a></th>
        <th><a href="?column=password&sort=<?php echo $sort ?>">PASSWORD</a></th>
        <th>ACTIONS</th>
      </tr>
      <?php while($results = mysqli_fetch_array($sqlAccounts)) { ?>
        <tr>
          <td><?php echo $results['id']; ?></td>
          <td><?php echo $results['username']; ?></td>
          <td><?php echo $results['password']; ?></td>
          <td>
            <form action="/php-crud-tutorial/update.php" method="post">
              <input type="submit" name="edit" value="EDIT" />
              <input type="hidden" name="editId" value="<?php echo $results['id']; ?>" />
              <input type="hidden" name="editUsername" value="<?php echo $results['username']; ?>" />
              <input type="hidden" name="editPassword" value="<?php echo $results['password']; ?>" />
            </form>
            <form action="/php-crud-tutorial/delete.php" method="post">
              <input type="submit" name="delete" value="DELETE" />
              <input type="hidden" name="deleteId" value="<?php echo $results['id']; ?>"/>
            </form>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>