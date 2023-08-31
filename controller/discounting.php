<?php
require "Currency_Format.php";
if (isset($_POST['type'])) {
    $mrc = intval($_POST['cost']) * intval($_POST['qty']);
    $perc = intval($_POST['percent']) / 100;
    $disc = $mrc - ($mrc * $perc);
    INR($disc);
}
