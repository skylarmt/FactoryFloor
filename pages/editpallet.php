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
}
?>
<h1 class="page-header">
    <?php
    if (!is_empty($palletid)) {
        echo "Edit Pallet #" . $palletid;
    } else {
        echo "New Pallet";
    }
    ?>
</h1>
<form action="doeditpallet.php" method="POST" onsubmit="prettysave();">
    <?php if (!is_empty($palletid)) { ?>
        <input type="hidden" name="palletid" value="<?php echo $palletid; ?>" />
    <?php } ?>
    Pallet Weight (<?php echo WEIGHT_UNIT_STRING; ?>):
    <input type="number" step="0.01" name="palletweight" required="required" class="form-control" value="<?php echo $pallet['palletweight']; ?>"/>
    <br />
    Box Weight (<?php echo WEIGHT_UNIT_STRING; ?>):
    <input type="number" step="0.01" name="boxweight" required="required" class="form-control" value="<?php echo $pallet['boxweight']; ?>"/>
    <br />
    Total Weight (<?php echo WEIGHT_UNIT_STRING; ?>):
    <input type="number" step="0.01" name="totalweight" required="required" class="form-control" value="<?php echo $pallet['totalweight']; ?>"/>
    <br />
    Date:
    <input type="datetime" name="palletdate" placeholder="12/30/16" required="required" class="form-control" value="<?php echo $pallet['palletdate']; ?>"/>
    <p><i>Protip: You can type "now" into the date box to automatically insert the current date and time.</i></p>
    <br />
    Items on Pallet:
    <input type="text" placeholder="Type to search" id="itemfilterbox" class="form-control"/>
    <div style="height: 300px; overflow-x: auto; overflow-y: scroll;">
        <table id="itemstable" class="table">
            <?php
            $allitems = $database->select('itemcategories', ['catid', 'catname']);
            $activeitems = $database->select('pallet_items', 'catid', ['palletid' => $palletid]);
            foreach ($allitems as $item) {
                ?>
                <tr>
                    <td><input type="checkbox" name="items[]" value="<?php echo $item['catid']; ?>" <?php if (in_array($item['catid'], $activeitems)) { echo 'checked="checked"'; } ?> /></td>
                    <td><?php echo $item['catid']; ?></td>
                    <td><?php echo $item['catname']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <br />
    Notes:
    <textarea name="notes">
        <?php echo $pallet['notes']; ?>
    </textarea>
    <br />
    <button id="savebtn" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save Pallet</button>
    <a class="btn btn-warning" href="./?action=palletlist"><i class="fa fa-times"></i> Exit</a>
    <?php if (!is_empty($palletid)) { ?>
        <a class="btn btn-info" href="./?action=printpallet&palletid=<?php echo $palletid; ?>"><i class="fa fa-print"></i> Print Label</a>
    <?php } ?>
</form>
<script src="js/tablesearch.js"></script>
<script>
    bindsearch('#itemfilterbox', '#itemstable');
    function clearpretty() {
        setTimeout(function () {
            $('#savebtn').prop('disabled', false);
            $('#savebtn').html('<i class="fa fa-floppy-o"></i> Save Pallet');
        }, 2000);
    }

    function prettysave() {
        $('#savebtn').prop('disabled', true);
        $('#savebtn').html('<i class="fa fa-check"></i> Pallet Saved!');
        clearpretty();
    }
</script>