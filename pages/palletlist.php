<h1 class="page-header hidden-print">
    Pallets
    <span class="pull-right">
        <a href="/?action=editpallet" class="btn btn-primary"><i class="fa fa-plus"></i> New Pallet</a>
    </span>
</h1>
<input type="text" id="palletsearchbox" class="form-control" placeholder="Type to search" />
<br />
<table class="table table-bordered" id="pallettable">
    <thead>
        <tr>
            <th class="hidden-print">Actions</th>
            <th>Pallet ID #</th>
            <th>Items</th>
            <th>Pallet Weight</th>
            <th>Box Weight</th>
            <th>Total Weight</th>
            <th>Date</th>
        </tr>
    </thead>
    <?php
    $pallets = $database->select('pallets', '*', ['LIMIT' => 30]);
    foreach ($pallets as $pallet) {
        ?>
        <tr>
            <td class="hidden-print">
                <a href="/?action=editpallet&palletid=<?php echo $pallet['palletid']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                <a href="/?action=printpallet&palletid=<?php echo $pallet['palletid']; ?>" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a>
            </td>
            <td>
                <span style="display: none;">P<?php echo $pallet['palletid']; ?>P</span><?php echo $pallet['palletid']; ?>
            </td>
            <td>
                <?php
                // This should be optimized in the future if it's slow.  It could probably become a JOIN in the above query.
                $items = $database->select('pallet_items', 'catid', ['palletid' => $pallet['palletid']]);
                foreach ($items as $item) {
                    echo $item . "<br />";
                }
                ?>
            </td>
            <td>
                <?php echo $pallet['palletweight'] + 0;
                echo " " . WEIGHT_UNIT_STRING; ?>
            </td>
            <td>
    <?php echo $pallet['boxweight'] + 0;
    echo " " . WEIGHT_UNIT_STRING; ?>
            </td>
            <td>
                <?php echo $pallet['totalweight'] + 0;
                echo " " . WEIGHT_UNIT_STRING; ?>
            </td>
            <td>
        <?php echo date("F j, Y, g:i a", strtotime($pallet['palletdate'])); ?>
            </td>
        </tr>
    <?php
}
?>
</table>
<script src="js/tablesearch.js"></script>
<script>
    bindsearch('#palletsearchbox', '#pallettable');
</script>