<?php

require_once 'required.php';

redirectifnotloggedin();

if (is_empty($_POST['palletid'])) {
    $newid = $database->insert('pallets', ['palletweight' => $_POST['palletweight'], 'boxweight' => $_POST['boxweight'], 'totalweight' => $_POST['totalweight'], 'notes' => $_POST['notes'], 'lastmodby' => $_SESSION['userid'], 'palletdate' => date('Y-m-d H:i:s', strtotime($_POST['palletdate']))]);
    $_POST['palletid'] = $newid;
    header('Location: /?action=editpallet&palletid=' . $newid);
} else {
    $database->update('pallets', ['palletweight' => $_POST['palletweight'], 'boxweight' => $_POST['boxweight'], 'totalweight' => $_POST['totalweight'], 'notes' => $_POST['notes'], 'lastmodby' => $_SESSION['userid'], 'palletdate' => date('Y-m-d H:i:s', strtotime($_POST['palletdate']))], ['palletid' => $_POST['palletid']]);
    header('Location: /?action=editpallet&palletid=' . $_POST['palletid']);
}

$database->pdo->beginTransaction();
try {
    $database->delete('pallet_items', ['palletid' => $_POST['palletid']]);
    foreach ($_POST['items'] as $item) {
        if ($database->has('itemcategories', ['catid' => $item])) {
            $database->insert('pallet_items', ['catid' => $item, 'palletid' => $_POST['palletid']]);
        }
    }
    $database->pdo->commit();
} catch (Exception $ex) {
    $database->pdo->rollBack();
}