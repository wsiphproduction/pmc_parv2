<div class="modal fade" id="open-item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
                <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-18 tx-sm-20 mg-b-2">REQUEST TO OPEN ITEM</h4>
                        <p class="tx-13 tx-color-03 mg-b-0">This Item is already used, You need to ask permission from your manager to edit this item.</p>
                    </div>
                </div>
            </div>
            <form method="post" action="/item/email/open-item">
                @csrf
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <input class="form-control" type="hidden" name="tracking" id="track" value="">
                    <input class="form-control" type="hidden" name="tid" id="tid" value="">
                    <input class="form-control" type="hidden" name="item" id="item" value="">
                    <input class="form-control" type="hidden" name="details" id="det" value="">

                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">To <i class="tx-danger">*</i></label>
                        <input required type="email" name="to_email" class="form-control" placeholder="Receiving Mail">
                    </div>

                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Subject <i class="tx-danger">*</i></label>
                        <input required type="text" name="subject" class="form-control" placeholder="Subject">
                    </div>

                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Message <i class="tx-danger">*</i></label>
                        <textarea required name="message" class="form-control" rows="5" placeholder="State your reason of unposting this par"></textarea>
                    </div>
  
                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send Request</button>
                </div>
            </form>
        </div>
    </div>
</div>