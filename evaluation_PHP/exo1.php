<?php
$dteeng = '1966-07-22';
$dtefr = date('d/m/Y', date('Y', $dteeng).'-'.date('m', $dteeng).'-'.date('d', $dteeng));
// $dtefr = date('d/m/Y', date('Y-m-d'));
echo date('Y', time());
// echo $dtefr;
?>
