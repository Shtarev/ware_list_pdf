<?php
$res = 'res';

$Nr = 0;
$Description = 1;
$Description_RUS = 2;
$Country = 3;
$Qantity = 4;
$Price_EUR = 5;
$Amount_EUR = 6;
$Amount_RUB = 7;

$arr = json_decode($_POST['data'], true);

// $sendData['date_date'];
$sendData = $arr['sendData'];
// $data[1][$Description];
$data = $arr['data'];
unset($arr);

// TODO: here
$res = $data[1][$Description];


echo json_encode($res, JSON_UNESCAPED_UNICODE);