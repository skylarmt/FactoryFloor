/**
 * Filter a table with a search box.
 * @param {String} searchboxid the jQuery selector for the search box
 * @param {String} tableid the selector for the table to filter
 * @returns {undefined}
 */
function bindsearch(searchboxid, tableid) {
    /*
     * Credit to http://stackoverflow.com/a/9127872/2534036
     */
    var $rows = $(tableid + ' tr');
    $(searchboxid).keyup(function () {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

        $rows.show().filter(function () {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
}