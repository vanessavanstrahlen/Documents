<?php
require_once('../Controllers/DocumentsController.php');

//Este archivo PHP se utiliza para enrutamiento y gestión de solicitudes hechas en el archivo: app.js
// Verifica si el parámetro 'action' está presente en la URL y corresponde a una acción específica.
// Dependiendo del valor del parámetro 'action' en la URL, se invoca el método correspondiente en la instancia de DocumentsController.

if ($_GET['action'] && $_GET['action'] == 'read') {
    $documents = new DocumentsController();
    $documents->read();
}

if ($_GET['action'] && $_GET['action'] == 'update') {
    $documents = new DocumentsController();
    $documents->update($_POST['DOC_ID'], $_POST);
}

if ($_GET['action'] && $_GET['action'] == 'create') {
    $documents = new DocumentsController();
    $documents->create($_POST);
}

if ($_GET['action'] && $_GET['action'] == 'delete') {
    $documents = new DocumentsController();
    $documents->delete($_POST['DOC_ID']);
}

if ($_GET['action'] && $_GET['action'] == 'login') {
    $documents = new DocumentsController();
    $documents->login($_POST['USUARIO'], $_POST['PASSWORD']);


}

if ($_GET['action'] && $_GET['action'] == 'consultartipos') {
    $documents = new DocumentsController();
    $documents->consultartipos();
}

if ($_GET['action'] && $_GET['action'] == 'consultarprocesos') {
    $documents = new DocumentsController();
    $documents->consultarprocesos();
}