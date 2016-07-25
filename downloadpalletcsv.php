<?php

require_once 'required.php';

redirectifnotloggedin();

$pallets = $database->select('pallets', '*');
$output = fopen("php://output", 'w') or die("Can't open php://output");
header("Content-Type:application/csv");
header("Content-Disposition:attachment;filename=pallets.csv");
/*
  <th>Pallet ID #</th>
  <th>Items</th>
  <th>Pallet Weight</th>
  <th>Box Weight</th>
  <th>Total Weight</th>
  <th>Date</th >
 */
fputcsv($output, array('Number', 'Items', 'Total Weight', 'Pallet Weight', 'Box Weight', 'Date'));
if (count($pallets) > 0) {
    foreach ($pallets as $pallet) {
        $items = $database->select('pallet_items', 'catid', ['palletid' => $pallet['palletid']]);
        $itemstring = implode("\n", $items);
        fputcsv($output, array($pallet['palletid'], $itemstring, $pallet['totalweight'], $pallet['palletweight'], $pallet['boxweight'], $pallet['palletdate']));
    }
}
fclose($output) or die("Can't close php://output");