<?php
  error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
?>
<?php
$conn = mysqli_connect('localhost', 'root', '12345678', 'boardb');
$file_query = mysqli_fetch_array(mysqli_query($conn, "select * from posts where id=".$_GET['idx']));
if($file_query['filepath'] != "../upload/"){
    $down = $file_query['filepath'];
  $file = substr($down,9);
  
  $filesize = filesize($down);
  
  if(file_exists($down)){
    header("Content-Type:application/octet-stream");
    header("Content-Disposition:attachment;filename=$file");
    header("Content-Transfer-Encoding:binary");
    header("Content-Length:".filesize($down));
    header("Cache-Control:cache,must-revalidate");
    header("Pragma:no-cache");
    header("Expires:0");
    if(is_file($down)){
        $fp = fopen($down,"r");
        while(!feof($fp)){
          $buf = fread($fp,8096);
          $read = strlen($buf);
          print($buf);
          flush();
        }
        fclose($fp);
        echo "<script> history.go(-1) </script>";
    }
  }
} else{
    echo '<script>alert("잘못된 접근입니다.")</script>';

  }

?>