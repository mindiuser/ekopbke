<div class="modal fade" id="edit-regulasi-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-gavel mr-10"></i> Edit Acuan Regulasi</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Tema
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="tema" class="form-control" maxlength="35" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Keterangan
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="keterangan" class="form-control" maxlength="50" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        File
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="file" id="file" name="file"  maxlength="50" style="margin-top:15px !important;" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="regulasi-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="regulasi-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
