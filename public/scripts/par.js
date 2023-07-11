    $('#e_type').on('change', function(){
        if($(this).val() == 1){
            $('#empdiv').show('slow');
            $('#deptdiv').hide('slow');
            $('#contractordiv').hide('slow');

            $('#department').val('');
            $('#contractor').val('');

            $("#employees").attr("required",true);
            $("#contractor").attr("required",false);
            $("#department").attr("required",false);
        }

        if($(this).val() == 2){
            $('#deptdiv').show('slow');
            $('#empdiv').hide('slow');
            $('#contractordiv').hide('slow');

            $('#employees').val('');
            $('#contractor').val('');

            $("#department").attr("required",true);
            $("#contractor").attr("required",false);
            $("#employees").attr("required",false);
        }

        if($(this).val() == 3){
            $('#contractordiv').show('slow');
            $('#empdiv').hide('slow');
            $('#deptdiv').hide('slow');

            $('#employees').val('');
            $('#department').val('');

            $("#contractor").attr("required",true);
            $("#department").attr("required",false);
            $("#employees").attr("required",false);
        }

    });
    
    function removeItem(i){
        var new_value = $('#total_items').val();
        $('#total_items').val(parseInt(new_value)-1);

        $('#id'+i+'').show();
        $('#tr'+i+'').remove();

    }

    function addToItem(id,stockcode,desc,uom,serial,cost,qty){

        var old_value = $('#total_items').val();

        $('#id'+id+'').hide();

        var item_id = parseInt(old_value)+1;
        $('#total_items').val(parseInt(old_value)+1);

        if(serial == ''){
            $('#addedItems').append('<tr id="tr'+id+'">'+
                '<td style="display:none;" ><input type="text" class="form-control" name="item_id[]" value="'+id+'"></td>'+ 
                '<td class="wd-10p">'+id+'</td>'+
                '<td class="wd-10p">'+stockcode+'</td>'+
                '<td class="wd-30p">'+desc+'</td>'+
                '<td class="wd-20p"></td>'+
                '<td class="wd-10p"><input required type="text" name="qty[]" id="qty'+id+'" value="" class="form-control input-xs text-right"></td>'+
                '<td class="wd-10p">'+uom+'</td>'+
                '<td class="wd-10p"><input type="text" readonly id="cost_'+id+'" name="cost[]" class="form-control input-xs text-right" value="'+cost+'"></td>'+
                '<td class="wd-10p"><button class="btn btn-danger btn-sm" onclick=\"removeItem('+id+');\"><i class="fa fa-trash"></i></button></td>'+
                '</tr>');
        } else {
            $('#addedItems').append('<tr id="tr'+id+'">'+
                '<td style="display:none;" ><input type="text" class="form-control" name="item_id[]" value="'+id+'"></td>'+ 
                '<td class="wd-10p">'+id+'</td>'+
                '<td class="wd-10p">'+stockcode+'</td>'+
                '<td class="wd-30p">'+desc+'</td>'+
                '<td class="wd-20p">'+serial+'</td>'+
                '<td class="wd-10p"><input readonly type="text" name="qty[]" id="qty'+id+'" value="'+qty+'" class="form-control input-xs text-right"></td>'+
                '<td class="wd-10p">'+uom+'</td>'+
                '<td class="wd-10p"><input type="text" readonly id="cost_'+id+'" name="cost[]" class="form-control input-xs text-right" value="'+cost+'"></td>'+
                '<td class="wd-10p"><button class="btn btn-danger btn-sm" onclick=\"removeItem('+id+');\"><i class="fa fa-trash"></i></button></td>'+
                '</tr>');
        }

    }

