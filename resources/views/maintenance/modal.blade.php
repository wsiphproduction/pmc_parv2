<!-- ================== User Modals ======================== -->
    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
            <div class="modal-content">
                <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
                    <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <div class="media align-items-center">
                        <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                        <div class="media-body mg-sm-l-20">
                            <h4 class="tx-18 tx-sm-20 mg-b-2">Update Account Credentials</h4>
                        </div>
                    </div>
                </div>
                <form action="/user/update" method="post">
                    @csrf
                    <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                        <input type="hidden" id="euid" name="uid">
                        <div class="row row-sm">
                            <div class="col-sm">
                                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Username <i class="tx-danger">*</i></label>
                                <input type="text" required id="domain" name="domain" class="form-control" >
                            </div>
                            <div class="col-sm-5 mg-t-20 mg-sm-t-0">
                                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Password <i class="tx-danger">*</i></label>
                                <input type="password" required name="pword" class="form-control" placeholder="*********">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Role <i class="tx-danger">*</i></label>
                            <select class="form-control" name="role">
                                <option>Select Role</option>
                                <option value="read and write">Read &amp; Write</option>
                                <option value="read only">Read Only</option>
                                <option value="admin">Admin</option>
                                <option value="department user">Department User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer pd-x-20 pd-y-15">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal effect-scale" id="activate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">User Activation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/user/activate" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="auid" name="uid">
                        <p>Are you sure you want to activate this user ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Yes, Activate</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">User Deactivation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/user/deactivate" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="duid" name="uid">
                        <p>Are you sure you want to deactivate this user ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger">Yes, Deactivate</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- ================== User Modals ======================== -->


<!-- ================== Close Type ======================== -->
    <div class="modal effect-scale" id="close-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Close Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form autocomplete="off" method="post" action="/close_type/add">
                    @csrf
                    <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                        
                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Description <i class="tx-danger">*</i></label>
                            <input autofocus="on" required type="text" name="close_type" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer pd-x-20 pd-y-15">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="close-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Close Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form autocomplete="off" method="post" action="/close_type/update">
                    @csrf
                    <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                        <input type="hidden" id="eclose_id" name="id">

                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Description <i class="tx-danger">*</i></label>
                            <input type="text" class="form-control" name="desc" id="close_desc">
                        </div>

                    </div>
                    <div class="modal-footer pd-x-20 pd-y-15">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="close-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/close_type/delete" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="dclose_id" name="id">
                        <p>Are you sure you want to delete inventory code? This operation cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger">Yes, Delete</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- ================== User Modals ======================== -->



<!-- ================== Stock Type Modals ======================== -->
    <div class="modal effect-scale" id="stock-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Stock Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form autocomplete="off" method="post" action="/stock_type/add">
                    @csrf
                    <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                        
                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Stock Type <i class="tx-danger">*</i></label>
                            <input autofocus="on" required type="text" name="code" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Description <i class="tx-danger">*</i></label>
                            <textarea required class="form-control" name="desc" rows="3" placeholder="Code Description"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer pd-x-20 pd-y-15">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="stock-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Stock Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form autocomplete="off" method="post" action="/stock_type/update">
                    @csrf
                    <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                        <input type="hidden" id="estock_id" name="id">
                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Stock Type <i class="tx-danger">*</i></label>
                            <input autofocus="on" required type="text" name="stype" id="stype" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Description <i class="tx-danger">*</i></label>
                            <textarea required class="form-control" name="desc" id="sdesc" rows="2" placeholder="Code Description"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer pd-x-20 pd-y-15">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="stock-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/stock_type/delete" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="dstock_id" name="id">
                        <p>Are you sure you want to delete stock type? This operation cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger">Yes, Delete</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- ================== Stock Type Modals ======================== -->


<!-- ================== Stock Type Modals ======================== -->
    <div class="modal effect-scale" id="dept-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Department Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form autocomplete="off" method="post" action="/dept/add">
                    @csrf
                    <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                        
                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Department Code <i class="tx-danger">*</i></label>
                            <input autofocus="on" required type="text" name="code" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Description <i class="tx-danger">*</i></label>
                            <textarea required class="form-control" name="desc" rows="3" placeholder="Code Description"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer pd-x-20 pd-y-15">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="dept-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Department Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form autocomplete="off" method="post" action="/dept/update">
                    @csrf
                    <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                        <input type="hidden" id="edeptid" name="id">
                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Department Code <i class="tx-danger">*</i></label>
                            <input autofocus="on" required type="text" name="code" id="deptcode" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Description <i class="tx-danger">*</i></label>
                            <textarea required class="form-control" name="desc" id="ddesc" rows="2" placeholder="Department Description"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer pd-x-20 pd-y-15">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="dept-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/dept/delete" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="ddeptid" name="id">
                        <p>Are you sure you want to delete this department code? This operation cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger">Yes, Delete</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- ================== Stock Type Modals ======================== -->
