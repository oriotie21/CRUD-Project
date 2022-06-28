<?php
$id = $_POST["id"];
$pw = $_POST["pw"];
$pwcheck = $_POST["pw_check"];
if($pwcheck != $pw){
    echo "<script>
      alert('두 비밀번호가 서로 다릅니다. 다시 확인하세요')
      history.go(-1)
      </script>";
}
$conn = mysqli_connect('localhost', 'root', '12345678', 'boardb');
$add_query = "insert into user_info(id, pw) values ('".$id."', '".hash("sha256", $pw)."');";
$q = "select * from user_info";
$exists_query = "select * from user_info where id='".$id."'";
$exists_query_result = mysqli_query($conn, $exists_query);
$row = $exists_query_result->fetch_array();
if($row != null){
  echo "<script>
  alert('동일한 id가 존재합니다.')
  history.go(-1)
  </script>";
}
$result =mysqli_query($conn, $add_query);
echo "<script> 
alert('회원가입 완료')
document.location.href='loginpage.php' </script>";

?>