<?php
function connectDB() {
  try {
      $pdo = new PDO('mysql:dbname=kadai08;charset=utf8;host=localhost', 'root', '');
      return $pdo;
  } catch (PDOException $e) {
      exit('DBConnectError:'.$e->getMessage());
  }
}
?>