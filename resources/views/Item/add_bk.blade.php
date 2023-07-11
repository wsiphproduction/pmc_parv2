@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Maintenance</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Items</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Item Management</h4>
        </div>
    </div>

<div style="display:none;" class="alert alert-success alert-dismissable" id="success_item"></div>                        
<div style="display:none;" class="alert alert-danger alert-dismissable" id="error_item"></div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form id="form_add_item" onsubmit="save_item(); return false;">
                    <div class="hpanel responsive-mg-b-30">
                        <div class="panel-body">
                            <div class="p-xs h4"><center>ADD ITEM FORM</center></div>
                            @csrf
                            <input type="hidden" id="total_items" name="total_items" value="0">
                            <div class="chosen-select-single mg-b-20">
                                <label><b>Category</b></label>
                                <div class="form-group">
                                    <label class="radio-inline mr-3">
                                        <input type="radio" name="optionsRadios" id="optionsRadios4" value="1"> PPE</label>
                                    <label class="radio-inline mr-3">
                                        <input type="radio" name="optionsRadios" id="optionsRadios5" value="2"> Tools</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios" id="optionsRadios6" value="3"> Capex</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios" id="optionsRadios6" value="4"> Others</label>
                                </div>
                            </div>
                                    
                            <div class="chosen-select-single mg-b-20" id="empdiv">
                                <label><b>Location</b></label>
                                <div class="form-group">
                                    <label class="radio-inline mr-3">
                                        <input type="radio" name="location" id="locationb" value="AGUSAN"> Agusan</label>
                                    <label class="radio-inline mr-3">
                                        <input type="radio" name="location" id="locationa" value="DAVAO"> Davao</label>
                                </div>
                            </div>

                            <div class="form-group data-custon-pick" id="ppetype_div">
                                <label>Description</label>
                                <div class="chosen-select-single mg-b-20">
                                    <select required class="select2_demo_3 form-control" name="descppe" id='descppe' onchange="PPE_select($( this ).val());">
                                        <option value="">Select PPE..</option>
                                        <option value="SAFETY SHOES">SAFETY SHOES</option>
                                        <option value="RUBBER BOOTS">RUBBER BOOTS</option>
                                        <option value="RAINCOAT">RAINCOAT</option>
                                        <option value="GLOVES">GLOVES</option>
                                        <option value="HARD HAT">HARD HAT</option>
                                        <option value="GOOGLES">GOOGLES</option>
                                        <option value="SPECTACLES">SPECTACLES</option>
                                        <option value="MOTORCYCLE HELMET">MOTORCYCLE HELMET</option> 
                                        <option value="REFLECTORIZED VEST">REFLECTORIZED VEST</option>                    
                                    </select>
                                </div>
                            </div>
                                    
                            <div class="form-group-inner" id="description_div">
                                <div class="form-group data-custon-pick">
                                    <label><b>Description</b></label>
                                    <input required type="text" class="form-control" placeholder="Description" name='desc'>
                                </div>
                            </div>

                            <div class="form-group-inner">
                                <label>Qty</label>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-select-list">
                                                    <input type="text" name='qty' id='qty' onkeyup="var t = parseFloat($('#price').val()) * parseFloat($(this).val()); $('#cost').val(t);" class="form-control form-filter inline text-right" value="1" onkeypress="return isNumberKey(event);"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                               <div class="chosen-select-single mg-b-20">
                                                    <select required class="select2_demo_3 form-control" name='uom' id="uom">
                                                        @foreach($uom as $u)
                                                        <option value="{{ $u->code }}">{{ $u->description }}</option>
                                                        @endforeach                 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-inner">
                                <div class="form-group data-custon-pick">
                                    <label><b>Unit Cost</b></label>
                                    <input type="text" name='price' id='price' onkeyup="var t = parseFloat($('#qty').val()) * parseFloat($(this).val()); $('#cost').val(t);" class="form-control numberonly form-filter text-right" value="0.00" onkeypress="return isNumberKey(event);">
                                </div>
                            </div>

                            <div class="form-group-inner">
                                <label>Serial</label>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-select-list">
                                                    <input type="text" name='ser' id='serial' onkeyup='isSerialExist($( this ).val(),"#serial")' placeholder="Serial" class="form-control inline form-filter">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <input type="checkbox" class="i-checks" name="noserial" id="noserial" onclick='serial_check("noserial","serial");'> No Serial #
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-inner">
                                <div class="form-group data-custon-pick">
                                    <label><b>Details</b></label>
                                    <textarea cols="40" rows="3" class="form-control" name='details' placeholder="Property = Value"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-select-list">
                                                    <input type="text" name='invoiced' id='invoiced' placeholder="Invoice / DR" class="form-control form-filter">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name='bisd' id='bisd' placeholder="BIS / Batch no." class="form-control form-filter">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-select-list">
                                                    <input type="text" name='pod' id='pod' placeholder="PO" class="form-control form-filter">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name='rqd' id='rqd' placeholder="RQ" class="form-control form-filter">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group-inner">
                                <div class="form-group data-custon-pick">
                                    <input type="checkbox" name="isict" id="isict"> <font style="color:gray;font-size:12px;font-style:italic;">Check if this is an ICT item.</font>
                                </div>
                            </div>

                            <div class="form-group-inner">
                                <div class="form-group data-custon-pick">
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div id="serials"></div> 
            </div>
        </div> 
    </div>
    
</div>
<br>
@endsection

@section('pagejs')
<script>
    $(document).ready(function() {
        $('#ppetype_div').hide();
    });
    function serial_check(a,b){
        var x = "#"+a;
        var y = "#"+b;        
        if ($(x).is(":checked")){
          $(y).hide("slow");
        }
        else{
           $(y).show("slow");
        }
    }

    function showValues() {
        var str = $( "form" ).serialize();
        $( "#results" ).text( str );
    }
    
    function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;
 
          return true;
       }
    $("#qty").keyup(function(){
        additem();
    });
    $('input[name=optionsRadios]').change(function() {
        additem();
    });
    function additem(){
        if($('input[name=optionsRadios]:checked').val()){ // check if category has value
            if($('#qty').val()==1){ //check if qty is more than 1
                $('.condiv').show("slow");
            }
            else{
                if($('input[name=optionsRadios]:checked').val()==2 || $('input[name=optionsRadios]:checked').val()==3){
                    $.ajaxSetup({
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                        }
                    })
                    $.ajax({
                      method: "GET",
                      url: "/item/generate_serials",
                      data: { qty: $('#qty').val(),category:$('input[name=optionsRadios]:checked').val()}
                    })
                      .done(function( html ) {
                        $( "#serials" ).html( html );
                        $('.condiv').hide("slow");
                      });
                    }
            }
            if($('input[name=optionsRadios]:checked').val()==1){
                $('#ppetype_div').show("slow");
                $('#description_div').hide("slow");       
                $('.condiv').hide("slow");
            }
            else if($('input[name=optionsRadios]:checked').val()==2){
                $('#ppetype_div').hide("slow"); 
                $('#description_div').show("slow");
                $('#serials').empty();
            }
            else if($('input[name=optionsRadios]:checked').val()==3){
                $('#ppetype_div').hide("slow"); 
                $('#description_div').show("slow");
                $('#serials').empty();
            }
            else if($('input[name=optionsRadios]:checked').val()==4){
                $('#ppetype_div').hide("slow"); 
                $('#description_div').show("slow");
                $('#serials').empty();
            }
        }
        else{
            alert('Please select item category first!');
            $('#qty1').val('1');
            return false;
        }
    }
    function PPE_select(a){
        if($(a).val()!=""){     
            $.ajax({
              method: "GET",
              url: "/item/ppe",
              data: { type: $('#descppe').val(),id:1}
            })
              .done(function( html ) {
                $( "#serials" ).html( html );
              });       
        }
    }
    function save_item(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                }
            })
            $( "#success_item" ).hide();
            $( "#error_item" ).hide();
            var formdata=$( "#form_add_item" ).serialize();
            $.ajax({
              method: "POST",
              url: "/item/save",
              data: formdata
            })            
              .done(function( d ) {  

                if(d.result){               
                    $( "#success_item" ).html( "Successfully Saved new Item!" );
                    $( "#success_item" ).show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("#form_add_item")[0].reset();
                }
                else{
                    $( "#error_item" ).html( d.remarks );
                    $( "#error_item" ).show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }
              });     
        
    }
    function isSerialExist(a,b){
        if(a.length>=3){
             $.ajax({
              method: "POST",
              url: "ajax.php?act=isSerialExist",
              data: { serial: a}
            })
              .done(function( html ) {
                var rs = String(html);
                if(rs.length==4){               
                    
                }
                else{
                    bootbox.dialog({
                        message: html,
                        title: "Warning! Serial# already exist.",
                        buttons: {
                          success: {
                            label: "Continue",
                            className: "green",
                            callback: function() {
                              
                            }
                          },
                          danger: {
                            label: "Erase Serial",
                            className: "blue",
                            callback: function() {
                              $(b).val("");
                            }
                          },
                          main: {
                            label: "Reset Eveything",
                            className: "red",
                            callback: function() {                     
                              $("#form_add_item")[0].reset();
                            }
                          }
                        }
                    });
                }
              });
        }        
    }
</script>
@endsection
