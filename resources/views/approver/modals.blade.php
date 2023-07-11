<div class="modal fade" id="disapprove" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30 bg-danger">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-18 tx-sm-20 mg-b-2 tx-white">CONFIRMATION <span id="trn"></span></h4>
                        <p class="tx-13 tx-color-03 mg-b-0 tx-white">Are you sure you want to disapprove this request? Plese state your reason for disapproving this request.</p>
                    </div>
                </div>
            </div>
            <form method="post" action="/request/par/disapproved">
                @csrf
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <input type="hidden" name="rid" id="rid" value="">
                    <input type="hidden" name="pid" id="pid" value="">
                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Reason <i class="tx-danger">*</i></label>
                        <textarea class="form-control" name="reason_deny" rows="3" placeholder="State your reason here for denying the request"></textarea>
                    </div>

                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Disapprove Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30 bg-danger">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-18 tx-sm-20 mg-b-2 tx-white">CONFIRMATION <span id="trn"></span></h4>
                        <p class="tx-13 tx-color-03 mg-b-0 tx-white">Are you sure you want to approve this request? This will unpost the requested par.</p>
                    </div>
                </div>
            </div>
            <form method="post" action="/request/par/approved">
                @csrf
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <input type="hidden" name="rid" id="rid" value="">
                    <input type="hidden" name="pid" id="pid" value="">
                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Approve Request</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="decline" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30 bg-danger">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-18 tx-sm-20 mg-b-2 tx-white">CONFIRMATION <span id="trn"></span></h4>
                        <p class="tx-13 tx-color-03 mg-b-0 tx-white">Are you sure you want to decline this request? Plese state your reason for disapproving this request.</p>
                    </div>
                </div>
            </div>
            <form method="post" action="/request/item/disapproved">
                @csrf
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <input type="hidden" name="iid" id="iid" value="">
                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Reason <i class="tx-danger">*</i></label>
                        <textarea class="form-control" name="reason_deny" rows="3" placeholder="Indicate your reason for disapproving this request"></textarea>
                    </div>

                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Disapprove Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="open" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30 bg-primary">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-18 tx-sm-20 mg-b-2 tx-white">CONFIRMATION <span id="trn"></span></h4>
                        <p class="tx-13 tx-color-03 mg-b-0 tx-white">Are you sure you want to approve this request? This will open the selected item.</p>
                    </div>
                </div>
            </div>
            <form method="post" action="/request/item/approved">
                @csrf
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <input type="hidden" name="iid" id="iid" value="">
                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Approve Request</button>
                </div>
            </form>
        </div>
    </div>
</div>


