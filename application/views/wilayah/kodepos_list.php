<?php $this->load->view('shared/css_content');?>
<div class="row" id="kodepos">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h3 class="card-title">DAFTAR WILAYAH KODE POS</h3>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID KEL</th>
                            <th>KELURAHAN</th>
                            <th>KODEPOS</th>
                            <th>KECAMATAN</th>
                            <th>KOTA/KAB</th>
                            <th>KABUPATEN</th>
                            <th>PROPINSI</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<?php
$this->load->view('wilayah/kodepos_add_modal',['propinsi'=>$propinsi]);
$this->load->view('wilayah/kodepos_edit_modal',['propinsi'=>$propinsi]);
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var idModalAdd = "#add-kodepos-modal";
        var idModalEdit = "#edit-kodepos-modal";

        var reloadTable = function(kecamatan,kabupaten,propinsi){
            $.ajax({
                url: "<?php echo my_url();?>/wilayah/kodepos/data",
                type: 'POST',
                dataType:'json',
                data: {
                    kecamatan:kecamatan,kabupaten:kabupaten,propinsi:propinsi
                },
                success: function(newData) {
                    var xtable = $('#datatables').DataTable();
                    xtable.clear();
                    xtable.rows.add(newData.data).draw();
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        }

        var initBar = function(){
            var actionbutton = '';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-propinsi-label">PILIH PROPINSI</span> <span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-propinsi">';
            <?php if(!empty($propinsi)){ foreach($propinsi as $row) { ?>
            actionbutton += '<li><a href="#" class="select-propinsi" id="<?php echo $row->ID_PROP;?>" label="<?php echo $row->NAMA_PROPINSI;?>"><?php echo $row->NAMA_PROPINSI;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';

            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-kabupaten-label">PILIH KABUPATEN</span><span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-kabupaten">';
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-kecamatan-label">PILIH KECAMATAN</span><span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-kecamatan">';
            actionbutton += '</ul>';
            actionbutton += '</div>';

            actionbutton += '<button type="button" id="add" class="btn-new btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": ['excel'],
            "ajax": "<?php echo base_url();?>/wilayah/kodepos/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" data-editvalue="'+row+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" id_kode="'+row[2]+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 7
                }
            ]
        });

        initBar();

        $('#kodepos').on("click",'.select-propinsi',function(){
            var $that = $(this);
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kabupaten",
                type: 'POST',
                dataType:'html',
                data: {
                    propinsi : $(this).attr('id')
                },
                success: function(options) {
                    $("ul#filter-kabupaten").html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

            $("#filter-propinsi-label").text("Propinsi: "+$(this).attr("label"));
            var tgt = $("#filter-propinsi-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-propinsi-label").attr("propinsi-filtered",$that.attr('id'));
            $("#filter-propinsi-label").attr("propinsi-filtered-label",$that.attr('label'));
            reloadTable(0,0,0);

            $("option",$("#propinsi-add-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);
                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });

            $("option",$("#propinsi-edit-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);
                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kabupaten_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    propinsi : $that.attr('id')
                },
                success: function(options) {
                    $("#kabupaten-add-form",$('#add-kodepos-modal')).html(options);
                    $("#kabupaten-edit-form",$('#edit-kodepos-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        $('#kodepos').on("click",'.select-kabupaten',function(){
            var $that = $(this);
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kecamatan",
                type: 'POST',
                dataType:'html',
                data: {
                    kabupaten : $(this).attr('id')
                },
                success: function(options) {
                    $("ul#filter-kecamatan").html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
            $("#filter-kabupaten-label").text("Kabupaten: "+$(this).attr("label"));
            var tgt = $("#filter-kabupaten-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-kabupaten-label").attr("kabupaten-filtered",$that.attr('id'));
            $("#filter-kabupaten-label").attr("kabupaten-filtered-label",$that.attr('label'));
            reloadTable(0,0,0);

            $("option",$("#kabupaten-add-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);
                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });

            $("option",$("#kabupaten-edit-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);
                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kecamatan_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    kabupaten : $that.attr('id')
                },
                success: function(options) {
                    $("#kecamatan-add-form",$('#add-kodepos-modal')).html(options);
                    $("#kecamatan-edit-form",$('#edit-kodepos-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        $("#kodepos").on('click',".select-kecamatan",function () {
            var $that = $(this);
            var propinsi = $("#filter-propinsi-label").attr("propinsi-filtered-label");
            var kabupaten = $("#filter-kabupaten-label").attr("kabupaten-filtered-label");
            var kecamatan = $that.attr('label');
            reloadTable(kecamatan,kabupaten,propinsi);
            $("#filter-kecamatan-label").text("Kecamatan: "+$(this).attr("label"));
            var tgt = $("#filter-kecamatan-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-kecamatan-label").attr("kecamatan-filtered",$that.attr('id'));
            $("#filter-kecamatan-label").attr("kecamatan-filtered-label",$that.attr('label'));
            $("option",$("#kecamatan-add-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);
                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });

            $("option",$("#kecamatan-edit-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);
                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });
            var id_kec = $that.attr('id');
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kelurahan_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    kecamatan : id_kec
                },
                success: function(options) {
                    $("#kelurahan-add-form",$('#add-kodepos-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        $("#add-kodepos-modal").on("change","#propinsi-add-form",function(){
            var propinsi = $("option:selected",$(this)).val();
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kabupaten_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    propinsi : propinsi
                },
                success: function(options) {
                    $("#kabupaten-add-form",$('#add-kodepos-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
            return false;
        });

        $("#add-kodepos-modal").on("change","#kabupaten-add-form",function(){
            var kabupaten = $("option:selected",$(this)).val();
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kecamatan_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    kabupaten : kabupaten
                },
                success: function(options) {
                    $("#kecamatan-add-form",$('#add-kodepos-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
            return false;
        });

        $("#add-kodepos-modal").on("change","#kecamatan-add-form",function(){
            var kecamatan = $("option:selected",$(this)).val();
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kelurahan_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    kecamatan : kecamatan
                },
                success: function(options) {
                    $("#kelurahan-add-form",$('#add-kodepos-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
            return false;
        });

        /*************************
         * Add New Record
         **********************/
        var clearFormModalAdd = function(){
            $("input",$("#add-kodepos-modal")).each(function(){
                $(this).val("");
            });
            $("textarea",$("#add-kodepos-modal")).each(function(){
                $(this).text("");
            });
            $("select",$("#add-kodepos-modal")).each(function(){
                var $this = this;
                $("option",$($this)).each(function(){
                    $(this).removeAttr("selected");
                });
            });
            $(".modal-alert","#add-kodepos-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        $("#kodepos").on('click', '#add', function() {
            clearFormModalAdd();
            $("#add-kodepos-modal").modal("show");
            return false;
        });

        var hideFormAddModal = function(){
            $(["input"],$("#add-kodepos-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#add-kodepos-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#add-kodepos-modal").modal("hide");
        }

        var hideFormEditModal = function(){
            $(["input"],$("#edit-kodepos-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#edit-kodepos-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#edit-kodepos-modal").modal("hide");
        }

        $("#add-kodepos-modal").on('click', '#kodepos-submit', function() {
            var prop = $("option:selected",$("#propinsi-add-form")).text();
            var kab = $("option:selected",$("#kabupaten-add-form")).text();
            var res = $("option:selected",$("#kabupaten-add-form")).attr('res');
            var kec = $("option:selected",$("#kecamatan-add-form")).text();
            var id_kel = $("option:selected",$("#kelurahan-add-form")).val();
            var kelurahan = $("option:selected",$("#kelurahan-add-form")).text();
            var kodepos = $("[name='kodepos']",$("#add-kodepos-modal")).val();

            if(prop.trim() == ''){
                $(".modal-alert","#add-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Propinsi masih kosong");
                return false;
            }
            if(kab.trim() == ''){
                $(".modal-alert","#add-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Kabupaten masih kosong");
                return false;
            }
            if(kec.trim() == ''){
                $(".modal-alert","#add-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Kecamatan masih kosong");
                return false;
            }
            if(id_kel.trim() == ''){
                $(".modal-alert","#add-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Kelurahan masih kosong");
                return false;
            }
            if(kodepos.trim() == ''){
                $(".modal-alert","#add-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Kodepos masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'/wilayah/kodepos/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    prop:prop,res:res,kab:kab,kec:kec,id_kel:id_kel,kelurahan:kelurahan,kodepos:kodepos
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormAddModal();
                        showAlerts('success',data.message);
                        var propinsi = $("#filter-propinsi-label").attr("propinsi-filtered-label");
                        var kabupaten = $("#filter-kabupaten-label").attr("kabupaten-filtered-label");
                        var kecamatan = $("#filter-kecamatan-label").attr("kecamatan-filtered-label");
                        reloadTable(kecamatan,kabupaten,propinsi);
                    }
                    else {
                        //showAlerts('error',data.message);
                        showErrorModal(idModalAdd,data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    //showAlerts('error',textStatus);
                    showErrorModal(idModalAdd,textStatus);
                }
            });
        });

        table.on('click', '.delete', function(e) {
            var id_kode = $(this).attr('id_kode');
            $.ajax({
                url: "<?php echo my_url().'/wilayah/kodepos/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_kode:id_kode
                },
                success: function(status) {
                    if(status == true){
                        showAlerts('success','Data telah didelete');
                        var propinsi = $("#filter-propinsi-label").attr("propinsi-filtered-label");
                        var kabupaten = $("#filter-kabupaten-label").attr("kabupaten-filtered-label");
                        var kecamatan = $("#filter-kecamatan-label").attr("kecamatan-filtered-label");
                        reloadTable(kecamatan,kabupaten,propinsi);
                    }
                    else {
                        showAlerts('error','Silahkan ulangi lagi');
                    }

                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        var clearFormModalEdit = function(value){
            $.ajax({
                url: "<?php echo my_url().'/wilayah/kodepos/detail';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_kode:value[2]
                },
                success: function(dt) {
                    var data = dt.data[0];
                    $("[name='kodepos']",$("#edit-kodepos-modal")).val(data.kodepos);
                    $("[name='kodepos-old']",$("#edit-kodepos-modal")).val(data.kodepos);
                    var prop = $("[name='propinsi']",$("#edit-kodepos-modal"));
                    var option = "<option selected='selected' value='"+data.prop+"' >"+data.prop+"</option>";
                    $(prop).html(option);
                    var kab = $("[name='kabupaten']",$("#edit-kodepos-modal"));
                    var option = "<option selected='selected' value='"+data.kab+"' res='"+data.res+"' >"+data.kab+"</option>";
                    $(kab).html(option);
                    var kec = $("[name='kecamatan']",$("#edit-kodepos-modal"));
                    var option = "<option selected='selected' value='"+data.kec+"' >"+data.kec+"</option>";
                    $(kec).html(option);
                    var kel = $("[name='kelurahan']",$("#edit-kodepos-modal"));
                    var option = "<option selected='selected' value='"+data.id_kel+"' >"+data.kel+"</option>";
                    $(kel).html(option);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

            $(".modal-alert","#edit-kodepos-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        // Edit record
        table.on('click', '.edit', function() {
            var t = $(this).data('editvalue');
            clearFormModalEdit(t.split(','));
            $("#edit-kodepos-modal").modal("show");
            return false;
        });

        $("#edit-kodepos-modal").on('click', '#kodepos-edit-submit', function() {
            var prop = $("option:selected",$("#propinsi-edit-form")).text();
            var kab = $("option:selected",$("#kabupaten-edit-form")).text();
            var res = $("option:selected",$("#kabupaten-edit-form")).attr('res');
            var kec = $("option:selected",$("#kecamatan-edit-form")).text();
            var id_kel = $("option:selected",$("#kelurahan-edit-form")).val();
            var kelurahan = $("option:selected",$("#kelurahan-edit-form")).text();
            var kodepos = $("[name='kodepos']",$("#edit-kodepos-modal")).val();
            var kodepos_old = $("[name='kodepos-old']",$("#edit-kodepos-modal")).val();

            if(prop.trim() == ''){
                $(".modal-alert","#edit-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Propinsi masih kosong");
                return false;
            }
            if(kab.trim() == ''){
                $(".modal-alert","#edit-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Kabupaten masih kosong");
                return false;
            }
            if(kec.trim() == ''){
                $(".modal-alert","#edit-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Kecamatan masih kosong");
                return false;
            }
            if(id_kel.trim() == ''){
                $(".modal-alert","#edit-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Kelurahan masih kosong");
                return false;
            }
            if(kodepos.trim() == ''){
                $(".modal-alert","#edit-kodepos-modal").addClass("alert-danger").removeClass("hide").text("Kodepos masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'/wilayah/kodepos/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    kodepos_old:kodepos_old,kodepos:kodepos
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormEditModal();
                        showAlerts('success',data.message);
                        var propinsi = $("#filter-propinsi-label").attr("propinsi-filtered-label");
                        var kabupaten = $("#filter-kabupaten-label").attr("kabupaten-filtered-label");
                        var kecamatan = $("#filter-kecamatan-label").attr("kecamatan-filtered-label");
                        reloadTable(kecamatan,kabupaten,propinsi);
                    }
                    else {
                        //showAlerts('error',data.message);
                        showErrorModal(idModalEdit,data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    //showAlerts('error',textStatus);
                    showErrorModal(idModalEdit,textStatus);
                }
            });
        });

    });
</script>