<div class="modal fade" id="add-regulasi-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-user mr-10"></i> Tambahkan Regulasi</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Tema
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="tema" class="form-control" maxlength="35" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Keterangan
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="keterangan" class="form-control" maxlength="50" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        File
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="file" id="file" name="file"  maxlength="50" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="regulasi-submit" class="btn btn-primary btn-sm">Tambah</button>
                <button type="button" id="regulasi-submit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
