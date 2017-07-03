<div class="modal fade" id="add-predikat-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-thermometer-full mr-10"></i> Tambahkan Predikat Penilaian Kesehatan</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Predikat
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="predikat" class="form-control" maxlength="50" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Min
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <input type="number" name="min" class="form-control" maxlength="5" required>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Rasio Min
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <input type="text" name="rmin" class="form-control" maxlength="5" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Maks
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <input type="number" name="maks" class="form-control" maxlength="5" required>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Rasio Maks
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <input type="text" name="rmaks" class="form-control" maxlength="5" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="predikat-submit" class="btn btn-primary btn-sm">Tambah</button>
                <button type="button" id="predikat-submit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
