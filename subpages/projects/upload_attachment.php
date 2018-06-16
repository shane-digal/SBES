<?php 
  $max_size = 1024*200;
  $extensions = array('jpeg', 'jpg', 'png', 'doc', 'docx', 'pdf');
  $dir = '../../uploads/projects/temp/';
  $count = 0;
  $error = '';
  $file_num = 1;

  if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_FILES['files']))
  {

    if(!isset($_SESSION['tmp_project_id']))
        $_SESSION['tmp_project_id'] = uniqid();

    $dir .= $_SESSION['tmp_project_id'] . '_';


    // loop all files
    foreach ( $_FILES['files']['name'] as $i => $name )
    {
      // if file not uploaded then skip it
      if ( !is_uploaded_file($_FILES['files']['tmp_name'][$i]) )
        continue; //$error .= 'no file uploaded /';

        // skip large files
      if ( $_FILES['files']['size'][$i] >= $max_size )
        continue; //$error .= 'large size on file' . $file_num . '/';

      // skip unprotected files
      if( !in_array(pathinfo($name, PATHINFO_EXTENSION), $extensions) )
        continue; //error .= 'error on file' . $file_num . '/';

        $target_file = $target_dir . basename($_FILES["image"]["name"][$i]);
      // now we can move uploaded files
        if( move_uploaded_file($_FILES["files"]["tmp_name"][$i], $dir . $name) )
          $count++;

      $file_num++;
    }
  }
  echo json_encode(array('count' => $count));
?>