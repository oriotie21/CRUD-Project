Hello Web!
<?php
if(!session_id()){
    session_start();
  }
  
if(!isset($_SESSION["id"])){
    echo "<script>
    document.location.href = 'loginpage.php'
    </script>";
}else{
    echo "<script>
    document.location.href = 'main.php'
    </script>";
}