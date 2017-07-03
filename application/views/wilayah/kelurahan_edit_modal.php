<div class="modal fade" id="edit-kelurahan-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-map-marker mr-10"></i> Edit kelurahan</b>
                <button type="button" class="close" title="close"><span aria-hidden="true" data-dismiss="modal">&times;</span><span class="hide">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Propinsi
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="propinsi-edit-form" name="propinsi" class="form-control" disabled required>
                            <option value="">PILIH PROPINSI</option>;
                            <?php if(!empty($propinsi)){ foreach($propinsi as $row) { ?>
                                <option value="<?php echo $row->ID_PROP;?>"><?php echo $row->NAMA_PROPINSI;?></option>;
                            <?php }} ?>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Kabupaten
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="kabupaten-edit-form" name="kabupaten" class="form-control" disabled required>
                            <option value="">PILIH KABUPATEN</option>;
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Kecamatan
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="kecamatan-edit-form" name="kecamatan" class="form-control" disabled required>
                            <option value="">PILIH KECAMATAN</option>;
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        ID Kelurahan
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="id" class="form-control" maxlength="15" disabled required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Nama kelurahan
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="kelurahan" class="form-control" maxlength="200" required>
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
                        Longitude
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="longitude" class="form-control" maxlength="20" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Lattitude
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="lattitude" class="form-control" maxlength="20" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="kelurahan-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="kelurahan-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
