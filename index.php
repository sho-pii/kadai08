<?php
ini_set("display_errors", 'On');
error_reporting(E_ALL);

require_once('functions.php');

$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  // 画像を取得
    $sql = 'SELECT * FROM gs_bm_table ORDER BY date DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll();

    session_start();
    $_SESSION['images'] = $images;
} else {
  // 画像を保存
  if (!empty($_FILES['image']['name'])) {
      $name = $_FILES['image']['name'];
      $type = $_FILES['image']['type'];
      $content = file_get_contents($_FILES['image']['tmp_name']);
      $size = $_FILES['image']['size'];
      $detail = $_POST['detail'];
      $title = $_POST['title'];

      $stmt = $pdo->prepare("INSERT INTO
                            gs_bm_table(
                                id, name, type, content, size, detail, date, title
                            ) VALUES (
                                NULL, :name, :type, :content, :size, :detail, sysdate(), :title
                            )");

      $stmt->bindValue(':name', $name, PDO::PARAM_STR);
      $stmt->bindValue(':type', $type, PDO::PARAM_STR);
      $stmt->bindValue(':content', $content, PDO::PARAM_STR);
      $stmt->bindValue(':size', $size, PDO::PARAM_INT);
      $stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
      $stmt->bindValue(':title', $title, PDO::PARAM_STR);
      $stmt->execute();

  }
  header('Location: index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>画像を保存するアプリ</title>
</head>

<body>
  <header>
    <h1>画像を保存</h1>
  </header>
<div class="row">
    <div class="col-3"><!-- 画面左 -->
      <form method="post" enctype="multipart/form-data" action="insert.php">
        <div class="form-group">
          <label>画像を選択</label>
          <input type="file" name="image" required>
        </div>
        <div class="form-group">
          <label>タイトル</label>
          <input type="text" name="title" class="form-control" >
        </div>
        <div class="form-group">
          <label>詳細</label>
          <textarea class="form-control" rows="3" name="detail"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
      </form>
    </div>
    <div class="col-9"><!-- メイン 画面右-->
      <div class="box" data-spy="scroll" data-offset="0" >
        <ul class="list-unstyled">
          <?php for ($i = 0; $i < count($images); $i ++): ?>
          <li class="media mt-5 box-li">
            <a href="#lightbox" data-toggle="modal" data-slide-to="<?= $i; ?>">
              <img src="select.php?id=<?= $images[$i]['id']; ?>" width="300" height="auto" class="mr-3">
            </a>
            <div class="media-body">
              <p style="color: #878787;"><?= $images[$i]['date']; ?></p>
              <h5 style="font-weight:bold;"><?= $images[$i]['title']; ?></h5>
              <button type="button" class="btn btn-link"><i class="fa-solid fa-heart fa-lg fa-beat-fade" style="color: #f524a8;"></i></button>
              <p class="detail"><?= $images[$i]['detail']; ?></p>
            </div>
          </li>
          <?php endfor; ?>
        </ul>
      </div>
    </div>
    <div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel" style="position: fixed;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($images); $i++): ?>
                    <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
                <?php endfor; ?>
            </ol>

            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($images); $i++): ?>
                    <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                    <img src="select.php?id=<?= $images[$i]['id']; ?>" class="d-block w-100">
                    </div>
                <?php endfor; ?>
            </div>

            <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>

</div>

    <!-- JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>