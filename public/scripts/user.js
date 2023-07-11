
$(document).on("click", ".deactivate", function () {
    $(".modal-body #duid").val($(this).data('uid'));
});

$(document).on("click", ".activate", function () {
    $(".modal-body #auid").val($(this).data('uid'));
});

$(document).on("click", ".update", function () {
    $(".modal-body #euid").val($(this).data('uid'));
    $(".modal-body #domain").val($(this).data('domain'));
});

function update_emp_dept(){
    var x = $('#employee').val();
    var i = x.split("|");
    $('#dept').val(i[1]);
    
}