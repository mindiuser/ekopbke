<div class="modal fade" id="edit-penilaian-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-eyedropper mr-10"></i> Edit Kategori Penilaian Kesehatan</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        KODE
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="kode" class="form-control" maxlength="5" required disabled>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Kategori Penilaian
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="aspek" class="form-control" maxlength="50" required >
                    </div>

                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Bobot
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="bobot" class="form-control" maxlength="4" required >
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="penilaian-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="penilaian-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
