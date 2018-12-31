<?php
 if (!isset($_GET['test'])) {
        http_response_code(404);
?>
     <p>Тест не выбран</p>
     <p><a href="list.php">Список тестов</a></p>
<?php
    exit;
} 

if (isset($_GET['test'])) {
   
   $hungle = file_get_contents($_GET['test']);
   $content = json_decode($hungle, true);
   $head = $content[0]['question'];
   $block[] = $content[0]['items'];


} else {
  http_response_code(404);
  echo '<h3>Тест не выбран</h3>';
}

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Генератор тестов на PHP и JSON</title>
</head>
<body>

<?php 
if (isset($head)) {
  echo "<h2>$head</h2>";
  ?>
    <form action="" method="POST" enctype="multipart/form-data"> 
    <fieldset>
      <p><input type="text" name="name" placeholder="Введите ваше имя"></p>
  <?php 
  for ($i=0; $i < count($content[0]['items']); $i++) { 
     ?>
     <p><h4> <?php echo ($content[0]['items'][$i]['quest'] ); ?> </p></h4> 
     <?php    
     
     for ($k = 0; $k < count($content[0]['items'][$i]['answers']); $k++) { 
      $correct[] = $content[0]['items'][$i]['answers'][$k]['result'];
       ?>
     <label><input type=radio name="<?= $i ?>" value="<?= $content[0]['items'][$i]['answers'][$k]['answer'] ?>"><?php $content[0]['items'][$i]['answers'][$k]['answer'] ?></label>
    <?php
    echo ($content[0]['items'][$i]['answers'][$k]['answer']);
     } 
   } ?>
       </fieldset>
    <input class="add" type="submit" name="add" value="Отправить">
  </form> <?php
  }


if (!empty($_POST['add'])) {
    foreach ($content[0]['items'] as $key => $value) {   
          for ($i = 0; $i < count($_POST); $i++) {          
            if ($i == $key) {
                for ($k = 0; $k < count($content[0]['items'][$i]['answers']); $k++) {
                  if (isset($_POST[$i]) && $_POST[$i] === $content[0]['items'][$i]['answers'][$k]['answer']) {
                        $results[] = $content[0]['items'][$i]['answers'][$k]['result'];
                       // var_dump($results);

                    }
                }
            }
        }
    }
}

     else {
      echo 'Вы не ответили на вопросы';
     }

$result = array_sum($results);
$correct = array_sum($correct);
$name = $_POST['name'];
if ($result === $correct) {
?>
      <div class="img">
      <img src="sert2.php">
      <?php 
      $sert = imagecreatetruecolor(200, 200);
      imagepng($sert);


      ?>
      <img src="sert2.php">
      <h2><?=$name?></h2>
                        
                        
      <p>Вы правильно ответили на все вопросы этого теста!!!</p>
    </div>
<?php
} else {
?>
     <h4>Попробуйте еще раз</h4>
<?php
}
?>

<p><a href="list.php">Выбрать другой тест</a></p>


</body>
</html>