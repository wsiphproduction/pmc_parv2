
<div class="modal effect-scale" id="close-par" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Close Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/par/close" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="cid" name="pid">
                    <p>Please state your reason for closing this transaction. <i class="text-danger">*</i></p>
                    <textarea required name="remarks" class="form-control" cols="3" rows="3"></textarea>
                    
                    <p>Upload supporting documents <i class="text-danger">*</i></p>
                    <input required type="file" class="form-control" name="uploadFile[]" multiple>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger">Yes, Close</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal effect-scale" id="post-par" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Post Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/par/post" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="items" name="items">
                    <input type="hidden" id="pid" name="pid">
                    <input type="hidden" id="refpar" name="refpar">
                    <p>Please upload file before posting this par. You will not be able to update this record. This operation cannot be undone.</p>
                    <input required type="file" class="form-control" name="uploadFile[]" multiple>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger">Yes, Post</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="email-par" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30 bg-primary">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-18 tx-sm-20 mg-b-2 tx-white">Get Link</h4>
                    </div>
                </div>
            </div>
            <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                <p>Click 'Copy Link' button and send it to the end-user through Skype or attached this link on email.</p>
                <input type="text" name="" class="form-control" readonly id="parid">
            </div>
            <div class="modal-footer pd-x-20 pd-y-15">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="copyLink()">Copy Link</button>
            </div>
        </div>
    </div>
</div>

<div class="modal effect-scale" id="close-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Close Accountability Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/par/item/close" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <input type="hidden" name="iid" id="iid" value="">
                    <input type="hidden" name="hid" id="hid" value="">
                    
                    <div class="form-group">
                        <select required class="form-control" name="close_type" >
                            <option selected>Choose Return/Close Type</option>
                            @foreach($close_data as $c)
                            <option value="{{$c->description}}">{{$c->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Upload supporting document <i class="tx-danger">*</i></label>
                        <input required type="file" class="form-control" name="uploadFile[]" multiple>
                    </div>
                        
                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Qty <i class="tx-danger">*</i></label>
                        <input type="number" step="0.01" name="qty" id="c_qty" class="form-control text-right">
                    </div>

                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Item Condition <i class="tx-danger">*</i></label>
                        <textarea required class="form-control" name="condition" rows="3" placeholder="State the item's conditions, parts, usability, storage, location, etc..."></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Remarks <i class="tx-danger">*</i></label>
                        <textarea required class="form-control" name="reason" rows="3" placeholder="Indicate reason for closing this item"></textarea>
                    </div> -->

                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Close Item</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal effect-scale" id="transfer-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Transfer Accountability Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" method="post" action="/par/transfer-item/auto">
                @csrf
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <input type="hidden" name="iid" id="item_id">
                    <input type="hidden" name="hid" id="header_id">
                    <input type="hidden" name="cost" id="icost">
                    <input type="hidden" name="xid" class="xid">
                    <input type="hidden" class="dept" name="isdept" id="isdept">
                    
                    <div class="form-group" id="personaldiv" style="display: none;">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Transfer To (Personal)<i class="tx-danger">*</i></label>
                        <div class="wd-md-100p">
                            <input type="search" name="emp" id="employees" class="form-control employees-input" placeholder="Search Lastname/ID of employee to search">
                            <span><img style="display: none;" id="emp_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                            <div id="employee_list" class="empt"></div>
                            <input type="hidden" id="dept" name="emp_dept">
                        </div>
                    </div>

                    <div class="form-group" id="deptdiv" style="display: none;">                            
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Transfer To (Common)<i class="tx-danger">*</i></label>
                        <div class="wd-md-100p">
                            <input type="search" name="dept" id="department" class="form-control search_dept" placeholder="Enter department name to search">
                            <span><img style="display: none;" id="dept_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                            <div id="department_list"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Qty <i class="tx-danger">*</i></label>
                        <input required type="number" name="qty" id="qty_t" class="form-control text-right qty_t">
                    </div>

                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Item Condition <i class="tx-danger">*</i></label>
                        <textarea required class="form-control" name="new_condition" rows="3" placeholder="State the item's conditions, parts, usability, storage, location, etc..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Reason <i class="tx-danger">*</i></label>
                        <textarea required class="form-control" name="reason" rows="3" placeholder="State your reason why you want to transfer the item..."></textarea>
                    </div>

                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="receiver-received-button" class="btn btn-primary">Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal effect-scale" id="transfer-multiple-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Transfer Accountability Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" method="post" action="/par/transfer-item/auto">
                @csrf
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <input type="hidden" name="iid" id="item_id">
                    <input type="hidden" name="hid" id="header_id">
                    <input type="hidden" name="cost" id="icost">
                    <input type="hidden" name="xid" class="xid">
                    <input type="hidden" class="dept" name="isdept" id="isdept">
                    
                    <div class="form-group" id="personaldiv" style="display: none;">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Transfer To (Personal)<i class="tx-danger">*</i></label>
                        <div class="wd-md-100p">
                            <input type="search" name="emp" id="employees" class="form-control" placeholder="Search Lastname/ID of employee to search">
                            <span><img style="display: none;" id="emp_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                            <div id="employee_list"></div>
                            <input type="hidden" id="dept" name="emp_dept" class="emp_dept">
                        </div>
                    </div>

                    <div class="form-group" id="deptdiv" style="display: none;">                            
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Transfer To (Common)<i class="tx-danger">*</i></label>
                        <div class="wd-md-100p">
                            <input type="search" name="dept" id="department" class="form-control search_dept" placeholder="Enter department name to search">
                            <span><img style="display: none;" id="dept_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                            <div id="department_list"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Qty <i class="tx-danger">*</i></label>
                        <input required type="number" name="qty" id="qty_t" class="form-control text-right qty_t">
                    </div>

                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Item Condition <i class="tx-danger">*</i></label>
                        <textarea required class="form-control" name="new_condition" rows="3" placeholder="State the item's conditions, parts, usability, storage, location, etc..."></textarea>
                    </div>

                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>