<!-- ============================================= OPEN ITEM MODAL ============================================= -->
<div class="modal fade" id="open-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 style="font-family: cursive;" class="modal-title text-center" id="myModalLabel"> REQUEST TO OPEN ITEM</h4>
            </div>
            <div class="modal-body">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet box purple">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Open Item 
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div style="font-size:10px;font-family: monospace;" class="note note-warning">Note : This Item is already used, You need to ask permission from your manager to edit this item.</div>
                        <div class="table-scrollable">
                            <form method="post" action="/item/email/open-item">
                                @csrf
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tracking </td>
                                            <td>
                                                <input class="form-control" readonly type="text" name="tracking" id="track" value="">
                                                <input class="form-control" readonly type="hidden" name="tid" id="tid" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Description </td>
                                            <td><input class="form-control" readonly type="text" name="item" id="item" value=""> </td>
                                        </tr>
                                        <tr>
                                            <td>Details </td>
                                            <td><input class="form-control" readonly type="text" name="details" id="det" value=""> </td>
                                        </tr>
                                        <tr>
                                            <td> To <i class="font-red">*</i></td>
                                            <td><input required class="form-control" type="text" name="to_email" placeholder="Receiving Mail"></td>
                                        </tr>
                                        <tr>
                                            <td> Subject <i class="font-red">*</i></td>
                                            <td><input required class="form-control" type="text" name="subject" placeholder="Subject"></td>
                                        </tr>
                                        <tr>
                                            <td> Reason <i class="font-red">*</i></td>
                                            <td>
                                                <textarea required class="form-control" name="message" rows="10" placeholder="Explain why you want to open this Item"></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group form-md-line-input form-md-floating-label has-info">
                                    <button type="submit" class="btn blue pull-right"><i class="icon-paper-plane"></i> SEND REQUEST</button>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
</div>
<!-- ============================================= END MODAL ============================================= -->