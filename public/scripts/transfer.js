
// $(document).ready(function(){
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     $('#filter_par_list').submit(function(e){
//         e.preventDefault();
//         $.ajax({
//             type: "GET",
//             url: "/search/par_details",
//             data: $('#filter_par_list').serialize(),
//             success: function( response ) {
//             $('#par_list').html(response);
                
//             }
//         });
//     });
// });


// # Search Employee from HRIS
$(document).ready(function(){
    var typingTimer;

	$('#employees').keydown(function(){
	    $('#emp_spinner').show();
	    clearTimeout(typingTimer);
	    typingTimer = setTimeout(doneTypingEmployee, 1000);
	});

	function doneTypingEmployee(){
	    var query = $('#employees').val();
	    var _token = $('input[name="_token"]').val();
	    $.ajax({
	        url: "/employee/fetch",
	        method: "POST",
	        data: { query :query, _token:_token },
	        success: function(data)
	        {
	            $('#emp_spinner').hide();
	            $('#employee_list').fadeIn();
	            $('#employee_list').html(data);
	        }
	    })
	}

    $('#department').keydown(function(){
        $('#dept_spinner').show();
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTypingDepartment, 1000);
    });

    function doneTypingDepartment(){
        var query = $('#department').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/api/dept",
            method: "POST",
            data: { query :query, _token:_token },
            success: function(data)
            {
                $('#dept_spinner').hide();
                $('#department_list').fadeIn();
                $('#department_list').html(data);
            }
        })
    }
});



$(document).on('click','.emp_li',function(){
    var emp = $(this).text();
    var i = emp.split("=");

    $('#employees').val(i[0]);
    $('#dept').val(i[1]);
    
    $('#employee_list').fadeOut();
});

$(document).on('click','.dept_li',function(){
    $('#department').val($(this).text());
    $('#department_list').fadeOut();
});
// # end search employee

// modal jquery
$(document).on("click", ".post-par", function () {
    var id = $(this).data('pid');
    $(".modal-body #items").val($('#'+id+'_items').val());
    $(".modal-body #pid").val(id);
    $(".modal-body #refpar").val($(this).data('refpar'));
    
});

$(document).on("click", ".close-par", function () {
    var id = $(this).data('pid');
    $(".modal-body #cid").val( id );
});


$(document).on("click", ".transfer-item", function () {
    $('#transfer-item').modal('show');

    $(".modal-body #header_id").val($(this).data('hid'));
    $(".modal-body #item_id").val($(this).data('iid'));
    $(".modal-body #qty_t").val($(this).data('qty'));
    $(".modal-body #icost").val($(this).data('cost'));
    $(".modal-body #isdept").val($(this).data('dept'));
    $(".modal-body .xid").val($(this).data('xid'));

    if($(this).data('dept') == 1){
        $(".modal-body #deptdiv").show();
    } else {
        $(".modal-body #personaldiv").show();
    }

    var qty = $(this).data('qty');
    $(".modal-body #qty_t").prop('min',1);
    $(".modal-body #qty_t").prop('max',qty);

});


$(document).on("click", ".close-item", function () {
	$('#close-item').modal('show');

    $(".modal-body #c_qty").val($(this).data('qty'));
    $(".modal-body #hid").val($(this).data('hid'));
    $(".modal-body #iid").val($(this).data('iid'));

    var qty = $(this).data('qty');
    $(".modal-body #c_qty").prop('min',1);
    $(".modal-body #c_qty").prop('max',qty);
});

$(document).on("click", ".email-par", function () {
    var p   = $(this).data('p');
    var a   = $(this).data('a');
    var dd  = $(this).data('dd');
    var ab  = $(this).data('ab');
    var ad  = $(this).data('ad');
    var eid = $(this).data('eid'); 

    $(".modal-body #p").val(p);
    $(".modal-body #a").val(a);
    $(".modal-body #dd").val(dd);
    $(".modal-body #ab").val(ab);
    $(".modal-body #ad").val(ad);
    $(".modal-body #eid").val(eid);
    $("#ue_pid").text(p);
});

$('#filter_category').on('change', function(){
    if($(this).val() == 2){
        $('#statusdiv').show('slow');
        $('#searchdiv').hide();
    } else {
        $('#searchdiv').show('slow');
        $('#statusdiv').hide();
    }
});



// end modal