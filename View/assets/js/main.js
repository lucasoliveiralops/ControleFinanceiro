$(document).ready(function() {
    $("#loginForm").validate({
        rules: {
            password: "required",
            email: {
                required: true,
                email: true
            }
        }
    });
});

function clearFormItems() {
    $('input.canClearInput').val('');
    $('input.canClearInput').prop("checked", false);
    $('select.canClearInput').prop('selectedIndex', 0);
    $('select.canClearInput').each(function() {
        let isSelect2 = $(this).hasClass("select2-hidden-accessible");
        if (isSelect2) {
            $(this).select2('destroy');
            $(this).prop('selectedIndex', 0);
            $(this).select2();
        }
    });
}