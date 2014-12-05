<?php
require('functions.php');

$id = $_GET['id'];

$result = getVerreContenance($dbh,$id)['Quantite_Verre'];
die($result);
echo $result;
?>