<?php
require_once('../includes/config.php');
$bdd->query("UPDATE bots SET online = '0'");
?>