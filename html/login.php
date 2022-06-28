
<?php
if(!session_id()){
  session_start();
}

$conn = mysqli_connect('localhost', 'root', '12345678', 'boardb');
$id = $_POST["id"];
$pw = $_POST["pw"];
$query = "select * from user_info where id='".$id."' and pw='".hash('sha256',$pw)."';";
$result = mysqli_query($conn, $query);
$row = $result->fetch_array();
if($row == null){
    echo "<script>
      alert('로그인 실패')
      history.go(-1)
      </script>";
}else{
    if(!session_id()){
      session_start();
    }
    $_SESSION["id"] = $id;
    echo "<script>document.location.href = 'main.php'</script>";
}

?>