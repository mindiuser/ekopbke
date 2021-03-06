<div class="modal fade" id="add-kabupaten-modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><i class="fa fa-map-marker mr-10"></i> Tambahkan Kabupaten</b>
                <button type="button" class="close" title="close"><span aria-hidden="true" data-dismiss="modal">&times;</span><span class="hide">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="modal-alert alert hide"></div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Propinsi
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select id="propinsi-add-form" name="propinsi" class="form-control" required>
                            <?php if(!empty($propinsi)){ foreach($propinsi as $row) { ?>
                               <option value="<?php echo $row->ID_PROP;?>"><?php echo $row->NAMA_PROPINSI;?></option>;
                            <?php }} ?>
                        </select>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        ID KAB
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="id" class="form-control" maxlength="6" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
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
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Nama Kabupaten
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="kabupaten" class="form-control" maxlength="200" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold label-input">
                        Ibu Kota
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="ibukota" class="form-control" maxlength="200" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="kabupaten-submit" class="btn btn-primary btn-sm">Tambah</button>
                <button type="button" id="kabupaten-submit-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
</div>
