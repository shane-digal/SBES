<?php
  include 'paths_included.php';
  $db = new Db();

  $fileId = $_GET['id'];
  $sqlstr = "SELECT * FROM rec_employee_files
      WHERE file_id = $fileId
  ";
  $sql = $con->prepare($sqlstr);
  $sql->execute();
  $res = $sql->get_result();
  foreach($res as $key => $val) {
      $file = $val['file_link'];
  }
  $sql->close();
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($file).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      flush();
      readfile($file);
      exit;