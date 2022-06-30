
<h1>
<?php
  if(!session_id()){
    session_start();
  }
  $query = "select * from posts where id=".$_GET["idx"];
  $conn = mysqli_connect('localhost', 'root', '12345678', 'boardb');
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  if(!$row){
    echo "존재하지 않는 글 번호입니다.";
    exit();
  }
  echo $row["title"];
  ?>
</h1>
<div>
  <?php
  $query = "select * from posts where id=".$_GET["idx"];
  $conn = mysqli_connect('localhost', 'root', '12345678', 'boardb');
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  if(!$row){
    echo "존재하지 않는 글 번호입니다.";
    exit();
  }
  echo $row["content"];
  ?>
</div>
<p>
<?php
$file_query = mysqli_fetch_array(mysqli_query($conn, "select * from posts where id=".$_GET['idx']));
if($file_query['filepath'] != "../upload/"){
echo "<a href='download.php?idx=".$_GET["idx"]."'>첨부파일 다운로드 </a>";

}
?>

</p>
<button type="button" class="NavBtn" onClick="location.href='main.php'">돌아가기</button>
<?php
if($row["author"] == $_SESSION["id"]){
  echo "<button type='button' class='NavBtn' onClick='location.href=".'"write.php?idx='.$_GET["idx"].'"'."'>수정</button>";
  echo "<button type='button' class='NavBtn' onClick='location.href=".'"delete.php?idx='.$_GET["idx"].'"'."'>삭제</button>";
}
?>