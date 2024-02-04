<?php
	require_once('qrcode.class.php');
?>
<style type="text/css">
<!--
table.qr
{
	border-collapse: collapse;
	border: solid 1px black;
	table-layout: fixed;
}

table.qr td
{
	width: 5px;
	height: 5px;
	font-size: 2px;
}

table.qr td.on
{
	background: #000000;
}
-->
</style>	

<?php
	$qrcode = new QRcode(utf8_encode('ggf'));
	$qrcode->displayHTML();
?>