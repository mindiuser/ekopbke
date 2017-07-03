<div class="modal fade" id="edit-propinsi-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-map-marker mr-10"></i> Edit Propinsi</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        ID
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="edit-id" class="form-control" maxlength="2" required disabled >
                        <input type="hidden" name="edit-id-old">
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Propinsi
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="edit-propinsi" class="form-control" maxlength="50" required >
                        <input type="hidden" name="edit-propinsi-old" >
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="propinsi-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="propinsi-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
