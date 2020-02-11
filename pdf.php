<?php 
  require('./database.php');
  require_once __DIR__ . '/vendor/autoload.php';

  if (isset($_POST['exportToPdf'])) {
    $currentDate = date("Y-m-d h:m:s");

    $queryAccounts = "SELECT * FROM accounts";
    $sqlAccounts = mysqli_query($connection, $queryAccounts);

    $rowAccounts = "";

    while ($rowAccount = mysqli_fetch_array($sqlAccounts)) {
      $rowAccounts .= '
        <tr>
          <td>'.$rowAccount['id'].'</td>
          <td>'.$rowAccount['username'].'</td>
          <td>'.$rowAccount['password'].'</td>
        </tr>
      ';
    }

    $html = '
      <link rel="stylesheet" href="./pdf.css">

      <h1> ACCOUNTS PDF by bossROD </h1>

      <table>
        <tr>
          <td><strong>Name: </strong></td>
          <td>bossROD </td>
        </tr>
        <tr>
          <td><strong>Date Exported: </strong></td>
          <td>'.$currentDate.' </td>
        </tr>
      </table>
      
      <table class="accounts-table">
        <tr>
          <th>ID</th>
          <th>USERNAME</th>
          <th>PASSWORD</th>
        </tr>
        '.$rowAccounts.'
      </table>
    ';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output("PDF_$currentDate.pdf", "D");
  } else {
    echo '<script>window.location.href = "/php-crud-tutorial/index.php"</script>';
  }
  
?>