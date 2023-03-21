<?php
$fileName = $_FILES['afile']['name'];
$fileType = $_FILES['afile']['type'];
$fileContent = file_get_contents($_FILES['afile']['tmp_name']);
$dataUrl = 'data:' . $fileType . ';base64,' . base64_encode($fileContent);

$file = '../sujets/'.$fileName;
file_put_contents($file, $fileContent);

$json = json_encode(array(
  'name' => $file,
  'type' => $fileType,
  'dataUrl' => $dataUrl,
));

echo $json;
?>
