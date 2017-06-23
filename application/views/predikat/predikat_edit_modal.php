<div class="modal fade" id="edit-predikat-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-user mr-10"></i> Edit Bagian</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Predikat
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="predikat" class="form-control" maxlength="50" required>
                        <input type="hidden" name="kode" maxlength="50" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Min
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="number" name="min" class="form-control" maxlength="5" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Rasio Min
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="rmin" class="form-control" maxlength="5" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Maks
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="number" name="maks" class="form-control" maxlength="5" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Rasio Maks
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="rmaks" class="form-control" maxlength="5" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="predikat-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="predikat-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
