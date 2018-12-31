<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Генератор тестов на PHP и JSON</title>
</head>
<body>
<h2>Список доступных тестов</h2>

<?php 
$fileList = glob('files/*.json');
foreach ($fileList as $key) {	
$hungle = file_get_contents($key);
$content = json_decode($hungle, true); 
	    foreach ($content as $test) {
        $question = $test["question"];?>
       <p><a href=<?= "test.php?test=$key" ?>><?= $question ?></a></p>
    	   <?php
    }
}
?>

<p><a href="admin.php">ЗАГРУЗИТЬ НОВЫЙ ТЕСТ</a></p>       
    

</body>
</html>