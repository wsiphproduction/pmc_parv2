
$(function(){
    'use strict'
    $('.select2-no-search').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Choose Filter Category'
    });

    $('.select2-status').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Choose One'
    });

    $('.select2-option').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Choose One'
    });

    $('#docdatefrom').datepicker({ dateFormat:'mm-dd-yy'});
    $('#docdateto').datepicker({ dateFormat:'mm-dd-yy'});
});


// Filter report
$('#rtype').on('change', function(){

    if($(this).val() == 1){
        $('#personal').show(); 
        $('#opt_sel').show();
        $('#common').hide(); 
        $('#item_status').hide();
        $('#doc_status').hide();
        $('#department').val('');
    }

    if($(this).val() == 2){
        $('#common').show();
        $('#opt_sel').show();
        $('#personal').hide();
        $('#item_status').hide();
        $('#doc_status').hide();
        $('#employees').val('');
    }

    if($(this).val() == 3){
        $('#doc_status').show();
        $('#common').hide(); 
        $('#personal').hide(); 
        $('#opt_sel').hide();
        $('#item_status').hide();
        $('#personal').val('');
        $('#common').val(''); 
    }

    if($(this).val() == 4){
        $('#item_status').show();
        $('#common').hide(); 
        $('#personal').hide(); 
        $('#opt_sel').hide();
        $('#doc_status').hide(); 
        $('#personal').val('');
        $('#common').val(''); 
    }
});

$('#opt_select').on('change', function(){

    if($(this).val() == 1){
        $('#personal').hide(); 
        $('#common').hide(); 
        $('#employees').val('');
        $('#department').val('');
    }

    if($(this).val() == 2){
        if($('#rtype').val() == 1){
            $('#personal').show();
        }

        if($('#rtype').val() == 2){
            $('#common').show();
        }   
    }
});



$('#option_personal').on('change', function(){
    if($(this).val() == 2){
        $('#personal').show('slow');
        $('#dates').hide(); 
        $('.dt_from').val('');
        $('.dt_to').val('');
        
    } else {
        $('#personal').hide();
        $('#dates').show('slow');
        $('.docdatefrom').val('');
        $('.docdateto').val('');
        $('.emp').val('');
    }
});

$('#option_common').on('change', function(){
    if($(this).val() == 2){
        $('#common').show('slow');
        $('#dates').hide(); 
        $('.dt_from').val('');
        $('.dt_to').val('');
    } else {
        $('#common').hide();
        $('#dates').show('slow');
        $('.doc_date_from_dept').val('');
        $('.doc_date_to_dept').val('');
        $('.dept').val('');
    }
});




$(document).on('click','.emp_li',function(){
    $('#employees').val($(this).text());
    $('#employee_list').fadeOut();
});  

$(document).on('click','.dept_li',function(){
    $('#department').val($(this).text());
    $('#department_list').fadeOut();
});
