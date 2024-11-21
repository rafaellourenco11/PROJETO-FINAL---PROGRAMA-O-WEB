<?php 
include_once("templetes/topo.php");
include_once("templetes/menu.php");

if (empty($_SERVER['QUERY_STRING'])) {
    $var = "conteudo.php";
    include_once($var);
} else {
    if (isset($_GET['pg'])) {
        $pg = $_GET['pg'];
        if (file_exists("$pg.php")) {
            include_once("$pg.php");
        } else {
            include_once("agendeagora.php");
        }
    } else {
        include_once("agendeagora.php");
    }
}

include_once("templetes/rodape.php");
?>
