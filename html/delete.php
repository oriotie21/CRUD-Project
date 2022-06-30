<?php
  error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
?>
<?php
if(!session_id()){
    session_start();
}
$idx = $_GET['idx'];
$conn = mysqli_connect('localhost', 'root', '12345678', 'boardb');
$query = "select * from posts where id=".$idx;
$row = mysqli_fetch_array(mysqli_query($conn, $query));
if(!$row){
    echo "삭제되었거나 존재하지 않는 글입니다.";
    exit();
}
$author = $row['author'];
if($author != $_SESSION['id']){
    echo "권한 없음";
    exit();
}
$delete_query = "delete from posts where id=".$idx;
mysqli_query($conn, $delete_query);
$filepath = $row['filepath'];
if($filepath != "../upload/"){
    unlink($filepath);
}
echo "
<script>
alert('삭제 완료')
document.location.href = 'main.php';
</script>
";

?>