<?php
if(!session_id()){
    session_start();
  }
  if(!isset($_SESSION["id"])){
    echo "<script>document.location.href = 'loginpage.php'</script>";
  }else{
    echo "<div align='right'>".$_SESSION["id"]."님 환영합니다! <a href='logout.php'>로그아웃</a></div>";
  }
  ?>

<h1>
게시글 작성
</h1>
<head>

</head>

<?php
echo "<form action='upload.php?idx=".$_GET["idx"]."' name='upload' enctype='multipart/form-data' method='post'>"
?>
  <?php
  $row = NULL;
  if($_GET["idx"]){
    $conn = mysqli_connect('localhost', 'root', '12345678', 'boardb');
    $query = "select * from posts where id=".$_GET["idx"];
    $row = mysqli_fetch_array(mysqli_query($conn, $query));
    if(!$row || $row["author"] != $_SESSION["id"]){
      echo "잘못된 접근입니다.";
      exit();
    }
  }
  
  ?>
<p>
  제목 : <?php
  if($row){
    echo "<input type='text' size=30 name='title' id='title' value='".$row["title"]."'</input>";
  }else{
    echo "<input type='text' size=30 name='title' id='title'></input>";
  }
  ?> 
</p>  
<p>
<textarea cols='50' rows='20' name='textbox' id='textbox'>
<?php
  if($row){
    echo $row["content"];
  }
  ?>

</textarea> 
</p>
    <p>
      <input id="file_input" name="file_input" type="file" />
</p>
<p>
      <input id="submit_button" name="submit_button" type="submit" />
</p>
</form>