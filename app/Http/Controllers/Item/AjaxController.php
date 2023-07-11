<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Items;


class AjaxController extends Controller 
{

    public function generate_serials(Request $request)
    {
        
        if($request->qty>0){

            $nxtid = Items::get_category_series($request->category);

            $data='
            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bars"></i> Serial Numbers
                    </div>                    
                </div>
            <div class="portlet-body form">

            <table class="table table-striped table-bordered table-hover" style="font-size:14px;">
            <tr style="color:blue;font-weight:bold;text-align:center;">
                <td valign="middle">No Serial#</td>
                <td valign="middle">Tracking no.</td>
                <td>Serial no.</td>
            </tr>';

                for($x=1; $x<=$request->qty; $x++){
                    if($x > 1){ $nxtid++; }
                    $data.='<tr>
                    <td><input type="checkbox" name="noserial'.$x.'" id="noserial'.$x.'" onclick=\'serial_check("noserial'.$x.'","ser'.$x.'");\' class="form-control input-sm"></td>
                    <td>'.Items::itemrefcodetemp($nxtid,$request->category).'</td>
                    <td class="has-success"><input type="text" name="ser'.$x.'" id="ser'.$x.'" onkeyup=\'isSerialExist($( this ).val(),"#ser'.$x.'")\' class="form-control form-filter input-sm"></td>
                    </tr>';
                }

            $data.='</table></div></div>';  

            return $data;
        }

        
    }

   

    public function itemrefcodetemp($n,$y){
        $dd=date('Y-m-d');
        $r=strlen($n);
        $e=4 - $r;
        $z="";
        for($x=1;$x<=$e;$x++){
            $z.="0";
        }
        $refcode=date('y',strtotime($dd)).date('m',strtotime($dd)).$y.$z.$n;
        return $refcode;
    }
    

    public function ppe(Request $request){
        $data='
            <table class="table table-hover" style="font-size:14px;">
            <tr class="div1"><td colspan="2"><h3>Specifications</h3></td></tr>';

            $type=$request->type;
            if($type=='SAFETY SHOES' || $type=='RUBBER BOOTS'){ 
                $temp_data='
                    <tr class="div1"><td>Size:</td>                                                     
                        <td>
                            <select name="asize" id="asize" class="form-control margin-bottom-10 form-filter input-sm">
                                <option value="0">Select Size..
                                <option value="5">5
                                <option value="6">6
                                <option value="7">7
                                <option value="8">8
                                <option value="9">9
                                <option value="10">10
                                <option value="11">11
                                <option value="12">12
                                <option value="13">13
                            </select>
                        </td>
                    </tr>
                    <tr class="div1"><td>Color:</td>                                                        
                        <td>
                            <select name="acolor" id="acolor" class="form-control margin-bottom-10 form-filter input-sm">
                                <option value="0">Select Color..
                                <option value="YELLOW">YELLOW
                                <option value="GREEN">GREEN
                                <option value="GRAY">GRAY
                                <option value="WHITE">WHITE
                                <option value="BLUE">BLUE
                                <option value="RED">RED
                                <option value="ORANGE">ORANGE                       
                            </select>
                        </td>
                    </tr>';
            }
            elseif($type=='RAINCOAT' || $type=='GLOVES'){   
                $temp_data='
                    <tr class="div1"><td>Size:</td>                                                     
                        <td>
                            <select name="bsize" id="bsize" class="form-control margin-bottom-10 form-filter input-sm">
                                <option value="0">Select Size..
                                <option value="SMALL">SMALL
                                <option value="MEDIUM">MEDIUM
                                <option value="LARGE">LARGE
                                <option value="EXTRA LARGE">EXTRA LARGE
                            </select>
                        </td>
                    </tr>
                    <tr class="div1"><td>Color:</td>                                                        
                        <td>
                            <select name="bcolor" id="bcolor" class="form-control margin-bottom-10 form-filter input-sm">
                                <option value="0">Select Color..
                                <option value="YELLOW">YELLOW
                                <option value="GREEN">GREEN
                                <option value="GRAY">GRAY
                                <option value="WHITE">WHITE
                                <option value="BLUE">BLUE
                                <option value="RED">RED
                                <option value="ORANGE">ORANGE                       
                            </select>
                        </td>
                    </tr>';
            }
            elseif($type=='HARD HAT'){  
                $temp_data='
                    <tr class="div1"><td>Color:</td>                                                        
                        <td>
                            <select name="ccolor" id="ccolor" class="form-control margin-bottom-10 form-filter input-sm">
                                <option value="0">Select Color..
                                <option value="YELLOW">YELLOW
                                <option value="GREEN">GREEN
                                <option value="GRAY">GRAY
                                <option value="WHITE">WHITE
                                <option value="BLUE">BLUE
                                <option value="RED">RED
                                <option value="ORANGE">ORANGE                       
                            </select>
                        </td>
                    </tr>';
            }
            elseif($type=='GOOGLES' || $type=='SPECTACLES'){    
                $temp_data='
                    <tr class="div1"><td>Color:</td>                                                        
                        <td>
                            <select name="dcolor" id="dcolor" class="form-control margin-bottom-10 form-filter input-sm">
                                <option value="0">Select Color..
                                <option value="CLEAR">CLEAR
                                <option value="DARK">DARK
                            </select>
                        </td>
                    </tr>';
            }
            elseif($type=='REFLECTORIZED VEST'){    
                $temp_data='
                    <tr class="div1"><td>Color:</td>                                                        
                        <td>
                            <select name="ccolor" id="ccolor" class="form-control margin-bottom-10 form-filter input-sm">
                                <option value="0">Select Color..
                                <option value="APPLE GREEN">APPLE GREEN
                                <option value="ORANGE">ORANGE
                                                        
                            </select>
                        </td>
                    </tr>';
            }
            else{
                $temp_data='';
            }
            $data.=$temp_data."</table>";
            return $data;
    }
    
}