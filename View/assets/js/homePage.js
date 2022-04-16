$(document).ready(function() {

    $('.js-categorys').select2();
    $('#clickMovementInstallments').click(function() {
        $('.movementInstallments').toggle();
    });
    genereteTableMovementsOfThisMonth();
    getAllOutgoingMovementsOfThisMonthAjax();
    getAllOutgoingMovementsOfThisWeekAjax();
    startDataTable();
    $("#formRegisterMovement").validate();
    $("#formRegisterMovement").submit(function(e) {
        if ($(this).valid()) {
            let data = $(this).serializeArray();
            e.preventDefault();
            $.ajax({
                url: "ajaxInsertMovement",
                data: data,
                dataType: "json",
                type: "POST",
                success: function(data) {
                    Swal.fire({
                        icon: data.type,
                        text: data.message,
                    })
                    if (data.type == 'success') {
                        $('#registerMovement').modal('toggle');
                        clearFormItems();
                        genereteTableMovementsOfThisMonth();
                        getAllOutgoingMovementsOfThisMonthAjax();
                        getAllOutgoingMovementsOfThisWeekAjax();
                        startDataTable();
                    }
                }
            });
        }
    });
});

function genereteTableMovementsOfThisMonth() {
    $.ajax({
        url: "genereteTableMovementsOfThisMonth",
        dataType: "json",
        success: function(data) {
            $('.data-table').html(data.html)
        }
    });
}

function getAllOutgoingMovementsOfThisMonthAjax() {
    $.ajax({
        url: "getAllOutgoingMovementsOfThisMonthAjax",
        dataType: "json",
        success: function(data) {
            $('.gastos-totais').html(data.value.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }))
        }
    });
}

function getAllOutgoingMovementsOfThisWeekAjax() {
    $.ajax({
        url: "getAllOutgoingMovementsOfThisWeekAjax",
        dataType: "json",
        success: function(data) {
            $('.gastos-semana').html(data.value.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }))
        }
    });
}

function startDataTable() {
    setTimeout(function() { $('.listMovements').dataTable() }, 500)
}