<div class="modal fade" id="edit-kabupaten-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-user mr-10"></i> Edit Kabupaten</b>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Propinsi
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="propinsi-edit-form" name="propinsi" class="form-control" required disabled>
                            <?php if(!empty($propinsi)){ foreach($propinsi as $row) { ?>
                                <option value="<?php echo $row->ID_PROP;?>"><?php echo $row->NAMA_PROPINSI;?></option>;
                            <?php }} ?>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        IDKAB
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="id" class="form-control" maxlength="6" required disabled>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Kota / Kab
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select name="res" class="form-control" required>
                            <option value="">Pilih Kabupaten/Kota</option>
                            <option value="KAB">KAB</option>
                            <option value="KOTA">KOTA</option>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Nama Kabupaten
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="kabupaten" class="form-control" maxlength="200" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        Ibu Kota
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="ibukota" class="form-control" maxlength="200" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="kabupaten-edit-submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" id="kabupaten-edit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
