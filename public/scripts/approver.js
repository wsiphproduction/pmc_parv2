$(document).on('click', '.request_par', function() {
    var id = $(this).data('rid');
    var data = get_request_par_details(id);
});

function get_request_par_details(id){
    $.ajax({
        type: 'get',
        url: '/par/request/details/'+id,
        success: function(data) {
            $('#request_details').html(data);
        }
    });
}

$(document).on('click', '.request_item', function() {
    var id = $(this).data('iid');
    var data = get_request_item_details(id);
});

function get_request_item_details(id){
    $.ajax({
        type: 'get',
        url: '/item/request/details/'+id,
        success: function(data) {
            $('#request_details').html(data);
        }
    });
}

$(document).on("click", ".disapprove", function () {
    var id = $(this).data('rid');
    var pid = $(this).data('pid');
    $(".modal-body #rid").val( id );
    $(".modal-body #pid").val( pid );
});

$(document).on("click", ".approve", function () {
    var id = $(this).data('rid');
    var pid = $(this).data('pid');
    $(".modal-body #rid").val( id );
    $(".modal-body #pid").val( pid );
    
});

$(document).on("click", ".decline", function () {
    var id = $(this).data('iid');
    $(".modal-body #iid").val( id );
    
});

$(document).on("click", ".open", function () {
    var id = $(this).data('iid');
    $(".modal-body #iid").val( id );
    
});