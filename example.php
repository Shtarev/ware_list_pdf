<?php
require_once __DIR__ . '/vendor/autoload.php'; 

$mpdf = new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . DIRECTORY_SEPARATOR . 'pdf',
    'orientation' => 'L'
]);

$res = 'res';

$Nr = 0;
$Description = 1;
$Description_RUS = 2;
$Country = 3;
$Qantity = 4;
$Price_EUR = 5;
$Amount_EUR = 6;
$Amount_RUB = 7;

$Qantity_res = 0;
$Price_EUR_res = 0;
$Amount_EUR_res = 0;
$Amount_RUB_res = 0;

$tbody = '';

$arr = json_decode($_POST['data'], true);

// $sendData['date_date'];
$sendData = $arr['sendData'];


$seller_name = $arr['sendData']['seller_name'];
$date_date = $arr['sendData']['date_date'];
$seller_street = $arr['sendData']['seller_street'];
$seller_coutry = $arr['sendData']['seller_coutry'];
$buyer_name = $arr['sendData']['buyer_name'];
$from_data = $arr['sendData']['from_data'];
$buyer_street = $arr['sendData']['buyer_street'];
$buyer_coutry = $arr['sendData']['buyer_coutry'];


// $data[1][$Description];
$data = $arr['data'];

unset($arr);

$mpdf->WriteHTML('<style>table {text-align: center; font-size: 20pt; width: 100%;}</style>', 1);

$tbody = '';

foreach($data as $key => $value) {
	if($key) {
		$tbody = $tbody . '<tr><td>' . $value[$Nr] . '</td><td>' . $value[$Description] . '</td><td>' . $value[$Description_RUS] . '</td><td>' . $value[$Country] . '</td><td>' . $value[$Qantity] . '</td><td>' . $value[$Price_EUR] . '</td><td>' . $value[$Amount_EUR] . '</td><td>' . $value[$Amount_RUB] . '</td></tr>';

		$Qantity_res = (int)$value[$Qantity] + $Qantity_res;
		$Price_EUR_res = (int)$value[$Price_EUR] + $Price_EUR_res;
		$Amount_EUR_res = (int)$value[$Amount_EUR] + $Amount_EUR_res;
		$Amount_RUB_res = (int)$value[$Amount_RUB] + $Amount_RUB_res;
	}

}

$html = <<<EOD
<table border="0" width="100%">
   <caption></caption>
   <tbody>
      <tr>
         <th style="text-align: left;" width="100px" rowspan="3">DATE: </th>
         <td></td>

         <th style="text-align: left;" rowspan="3" width="120px">SELLER: </th>
         <td>$seller_name</td>
      </tr>
      <tr>
         <td>$date_date</td>
         <td>$seller_street</td>
      </tr>
      <tr>
         <td></td>
         <td>$seller_coutry</td>
      </tr>
   </tbody>

   <tbody>
      <tr>
         <th style="text-align: left;" width="100px" rowspan="3">FROM: </th>
         <td></td>

         <th style="text-align: left;" rowspan="3" width="120px">BUYER: </th>
         <td>$buyer_name</td>
      </tr>
      <tr>
         <td>$from_data</td>
         <td>$buyer_street</td>
      </tr>
      <tr>
         <td></td>
         <td>$buyer_coutry</td>
      </tr>
   </tbody>
</table>

<br><br>
<table border="1" width="100%">
	<thead>
		<tr>
			<th>Nr</th>
			<th>Description</th>
			<th>Description_RUS</th>
			<th>Country</th>
			<th>Qantity</th>
			<th>Price_EUR</th>
			<th>Amount_EUR</th>
			<th>Amount_RUB</th>
		</tr>
	</thead>
	<tbody>
		$tbody
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4" style="text-align: right; padding-right: 5px">TOTAL:</th>
			<th style="text-align: center;">$Qantity_res</th>
			<th style="text-align: center;">$Price_EUR_res</th>
			<th style="text-align: center;">$Amount_EUR_res</th>
			<th style="text-align: center;">$Amount_RUB_res</th>
		</tr>
	</tfoot>
</table>
EOD;

$mpdf->WriteHTML($html, 2);

// сохранит под именем mpdf.pdf'
$mpdf->Output('pdf/pdfs/mpdf.pdf', false);
// TODO: fix link
echo json_encode('pdf/pdfs/mpdf.pdf', JSON_UNESCAPED_UNICODE);