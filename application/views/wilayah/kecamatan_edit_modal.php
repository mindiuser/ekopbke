<div class="modal fade" id="edit-kecamatan-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-map-marker mr-10"></i> Edit Kecamatan</b>
                <button type="button" class="close" title="close"><span aria-hidden="true" data-dismiss="modal">&times;</span><span class="hide">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Kabupaten
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="kabupaten-edit-form" name="kabupaten" disabled class="form-control" required>
                            <option value="">PILIH KABUPATEN</option>;
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        ID KEC
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="id" class="form-control" maxlength="10" disabled required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Nama Kecamatan
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="kecamatan" class="form-control" maxlength="200" required>
                    </div>
                </div>
                <div class="row small-list-margin hide">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Kode Pos
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="kodepos" class="form-control" maxlength="20" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Keterangan
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <textarea class="form-control" name="keterangan" cols="5" rows="5" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="kecamatan-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="kecamatan-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
