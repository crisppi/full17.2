<?php
session_start();
if ($_SESSION['username']) {
    session_destroy();
    header("Location: cad_evento.php");
}
