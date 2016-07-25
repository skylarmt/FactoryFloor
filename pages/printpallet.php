<?php
$palletid;
if (!is_empty($_POST['palletid'])) {
    $palletid = $_POST['palletid'];
}
// Enable the form to pass the new ID back in after save, prevent duplicate records
if (!is_empty($_GET['palletid'])) {
    $palletid = $_GET['palletid'];
}

if (!is_empty($palletid)) {
    $pallet = $database->select('pallets', '*', ['palletid' => $palletid])[0];
    $items = $database->select('pallet_items', 'catid', ['palletid' => $palletid]);
}
?>
<span class="pull-right hidden-print"><a href="javascript:window.print()" class="btn btn-info"><i class="fa fa-print"></i> Print</a> <a href="./?action=palletlist" class="btn btn-warning"><i class="fa fa-times"></i> Exit</a></span>
<h1 class="h3">Helena Industries Big Sky E-Recycling<!-- <span class="pull-right">CyclePoint</span> --></h1>
<h2 class="h4">Pallet Inventory Label</h2>
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <h1>Pallet #: <?php echo $pallet['palletid']; ?></h1>
        <img class="img-responsive" src="makebarcode.php?data=P<?php echo $pallet['palletid']; ?>&type=code39" />
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="pull-right">
            <h1>Total Weight: <?php echo ($pallet['totalweight'] + 0) . " " . WEIGHT_UNIT_STRING; ?></h1>
            <h2>Pallet Weight: <?php echo ($pallet['palletweight'] + 0) . " " . WEIGHT_UNIT_STRING; ?></h2>
            <h2>Box Weight: <?php echo ($pallet['boxweight'] + 0) . " " . WEIGHT_UNIT_STRING; ?></h2>
        </div>
    </div>
</div>
<h1>Items:</h1>
<div class="list-group">
<?php
foreach ($items as $item) {
    ?>
    <div class="list-group-item">
    <?php echo $item; ?>
    </div>
    <?php
}
?>
</div>