/**
 * Validates if a password has at least 6 characters
 * @param {*} inputtxt
 */
function CheckPassword(inputtxt)
{
    console.log(inputtxt);
    var passw = /^.{6,}$/;
    if (inputtxt.match(passw)) {
        return true;
    } else {
        return false;
    }
}

/* Modal Delete */
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});