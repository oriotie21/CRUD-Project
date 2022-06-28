<?php
if(!session_id()){
    session_start();
  }
  if(isset($_SESSION["id"])){
  $_SESSION = array();
  }
  echo "<script>document.location.href = 'loginpage.php'</script>"
?>