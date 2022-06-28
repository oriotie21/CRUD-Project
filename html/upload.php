<?php
  error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
?>
<?php

if(!session_id()){
    session_start();
  }
if(!$_SESSION['id']){
    echo "<script>
    alert('login again')
    document.location.href='loginpage.php'
    </script>";
}

//세션 아이디랑 인덱스에 있는 번호 아이디랑 맞는지 확인(존재하는것과 동시에 글쓴이가 맞으면 수정, 아니면 권한 없음 출력)
$conn = mysqli_connect('localhost', 'root', '12345678', 'boardb');
if($_GET["idx"]){
  $query = "select * from posts where id=".$_GET["idx"];
  $row = mysqli_fetch_array(mysqli_query($conn, $query));
  if(!$row || $row["author"] != $_SESSION["id"]){
    echo "권한 없음!";
    exit();
  }
  //파일체크
  $file_name = $_FILES['file_input']['name'];
  if($file_name != NULL){
  $tmp_path = $_FILES['file_input']['tmp_name'];
  move_uploaded_file($tmp_path, "../upload/".$file_name);
  }
  $file_query = mysqli_fetch_array(mysqli_query($conn, "select * from posts where id=".$_GET['idx']));
  if($file_query['filepath'] != "../upload/"){
      unlink($file_query['filepath']);
  }

  $update_query = "update posts set title='".$_POST["title"]."', content='".$_POST["textbox"]."', time='".date('Y-m-d H:i:s')."', filepath='"."../upload/".$file_name."' where id=".$_GET["idx"];
  mysqli_query($conn, $update_query);
  echo "<script>alert('수정 완료'); document.location.href='main.php';</script>";
}else{
   //파일체크
   $file_name = $_FILES['file_input']['name'];
   if($file_name != NULL){
   $tmp_path = $_FILES['file_input']['tmp_name'];
   move_uploaded_file($tmp_path, "../upload/".$file_name);
   }
$query = "insert into posts(author, title, content, time, filepath) values ('".$_SESSION["id"]."', '".$_POST['title']."', '".$_POST['textbox']."', '".date('Y-m-d H:i:s')."', '../upload/".$file_name."');";
echo "<script>document.location.href='main.php'</script>";
mysqli_query($conn, $query);
}
?>