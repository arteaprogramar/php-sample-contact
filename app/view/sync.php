<?php

$contact = new \app\domain\entity\ContactEntity();

$action = $_POST['action'];

if ($action != ACTION_CREATE && $action != ACTION_UPDATE) {
    $_SESSION['message'] = 'Se ha producido un error al crear o actualizar el registro';
    header('Location: /index.php');
}

$contact -> setId($_POST['id']);
$contact -> setName($_POST['name']);
$contact -> setFirstName($_POST['first_name'] ?? '');
$contact -> setEmail($_POST['email']);
$contact -> setPhone($_POST['phone']);

print_r($contact);
print_r($action);

$syncCase = new \app\domain\cases\SyncContact();
$response = $syncCase -> setAttributes([
    'action' => $action,
    'param' => $contact
]) -> execute() -> getResponse();

$_SESSION['message'] = $response -> data ? 'Se ha realizado la acción correctamente' : 'No se ha podido actualizar el contacto';
header('Location: /index.php');
exit();