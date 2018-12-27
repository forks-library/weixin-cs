<?php
require_once '../../config.php';

$server = DB_HOST;
$username = DB_USER;
$password = DB_PASS;
$dbname = DB_NAME;

$dsn = 'mysql:dbname='.$dbname.';host='.$server.';port=3306';
$nickname = $_POST['nickname'];
$total_fee =$_POST['total_fee'];
$order = $_POST['order'];
$pic_num = $_POST['pic_num'];
$create_time = date('Y:m:d H:i:s',time());

try {
    $db = new PDO($dsn, $username, $password); // also allows an extra parameter of configuration
} catch(PDOException $e) {
    die('Could not connect to the database:<br/>' . $e);
}
$db->query('set names utf8;'); 
$stmt = $db->prepare("INSERT INTO stat(nickname,total_fee,`order`,pic_num,create_time) VALUES (:nickname, :total_fee,:order,:pic_num,:create_time)");

$stmt->bindParam(':nickname', $nickname);
$stmt->bindParam(':total_fee', $total_fee);
$stmt->bindParam(':order', $order);
$stmt->bindParam(':pic_num',$pic_num);
$stmt->bindParam(':create_time',$create_time);


$stmt->execute();

echo json_encode($stmt->errorInfo());

