<head >
  <div align="right">
    <?php
  // 테이블 셋업 명령어 : create table posts (id char(20), title char(20), content text, time datetime);
  //삽입 명령어 : insert into posts values ('A', 'Test Title', 'Hello World!', '2022-06-22 22:00:00');

  if(!session_id()){
    session_start();
  }
  if(!isset($_SESSION["id"])){
    echo "<script>document.location.href = 'loginpage.php'</script>";
  }else{
    echo $_SESSION["id"]."님 환영합니다!";
  }
    ?>
    <?php
  error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
?>
    <a href="logout.php">로그아웃</a>
  </div>

</head>
<body>
  

<h1>
  Discussion Board
</h1>
<div>

</div>
<div>
<table border="1"> 
<thead>
<tr>
<th>ID</th>
<th>제목</th>
<th>글쓴이</th>
<th>작성시간</th>
</tr>
</thead>
<tbody>
<?php
$query = "select * from posts";
$conn = mysqli_connect('localhost', 'root', '12345678', 'boardb');
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$n = 0;
while($row){
  $n++;
  echo "<tr>";
  $idx = $row["id"];
  echo "<td>".$idx."</td>";
  echo "<td> <a href=view.php?idx=".$idx.">".$row["title"]."</a></td>";
  echo "<td>".$row["author"]."</td>";
  echo "<td>".$row["time"]."</td>";
  echo "</tr>";

  $row = mysqli_fetch_array($result);
}
if($n==0){
  echo "<tr><td>작성된 글이 없습니다.</tr></td>";
}
?>
<tr>

</tr>
<tr>

</tr>

</tbody>
</table>
</div>
<p>
  <button id="writeBtn" name="writeBtn" onClick="document.location.href='write.php'">글쓰기</button>
</body>