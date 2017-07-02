<?php $this->load->view('shared/css_content');?>
<div class="row" id="kelurahan">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h3 class="card-title"><i class="fa fa-map-marker" aria-hidden="true"></i> DAFTAR WILAYAH KELURAHAN</h3>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>KELURAHAN</th>
                            <th>LONGITUDE</th>
                            <th>LATTITUDE</th>
                            <th class="disabled-sorting">Actions</th>
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
$this->load->view('wilayah/kelurahan_add_modal',['propinsi'=>$propinsi]);
$this->load->view('wilayah/kelurahan_edit_modal',['propinsi'=>$propinsi]);
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var idModalAdd = "#add-kelurahan-modal";
        var idModalEdit = "#edit-kelurahan-modal";

        var reloadTable = function(kecamatan){
            $.ajax({
                url: "<?php echo my_url();?>/wilayah/kelurahan/data",
                type: 'POST',
                dataType:'json',
                data: {
                    kecamatan:kecamatan
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
            "ajax": "<?php echo base_url();?>/wilayah/kelurahan/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" data-editvalue="'+row+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" id_kel="'+row[0]+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 4
                }
            ]
        });

        initBar();

        $('#kelurahan').on("click",'.select-propinsi',function(){
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
            reloadTable(0);

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
                    $("#kabupaten-add-form",$('#add-kelurahan-modal')).html(options);
                    $("#kabupaten-edit-form",$('#edit-kelurahan-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        $('#kelurahan').on("click",'.select-kabupaten',function(){
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
            reloadTable(0);

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
                    $("#kecamatan-add-form",$('#add-kelurahan-modal')).html(options);
                    $("#kecamatan-edit-form",$('#edit-kelurahan-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        $("#kelurahan").on('click',".select-kecamatan",function () {
            var $that = $(this);
            var kecamatan = $that.attr('id');
            reloadTable(kecamatan);
            $("#filter-kecamatan-label").text("Kecamatan: "+$(this).attr("label"));
            var tgt = $("#filter-kecamatan-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-kecamatan-label").attr("kecamatan-filtered",$that.attr('id'));

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
        });

        $("#add-kelurahan-modal").on("change","#propinsi-add-form",function(){
            var propinsi = $("option:selected",$(this)).val();
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kabupaten_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    propinsi : propinsi
                },
                success: function(options) {
                    console.log(options);
                    $("#kabupaten-add-form",$('#add-kelurahan-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
            return false;
        });

        $("#add-kelurahan-modal").on("change","#kabupaten-add-form",function(){
            var kabupaten = $("option:selected",$(this)).val();
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kecamatan_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    kabupaten : kabupaten
                },
                success: function(options) {
                    console.log(options);
                    $("#kecamatan-add-form",$('#add-kelurahan-modal')).html(options);
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
            $("input",$("#add-kelurahan-modal")).each(function(){
                $(this).val("");
            });
            $("textarea",$("#add-kelurahan-modal")).each(function(){
                $(this).text("");
            });
            $("select",$("#add-kelurahan-modal")).each(function(){
                var $this = this;
                $("option",$($this)).each(function(){
                    $(this).removeAttr("selected");
                });
            });
            $(".modal-alert","#add-kelurahan-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        $("#kelurahan").on('click', '#add', function() {
            clearFormModalAdd();
            $("#add-kelurahan-modal").modal("show");
            return false;
        });

        var hideFormAddModal = function(){
            $(["input"],$("#add-kelurahan-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#add-kelurahan-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#add-kelurahan-modal").modal("hide");
        }

        var hideFormEditModal = function(){
            $(["input"],$("#edit-kecamatan-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#edit-kecamatan-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#edit-kecamatan-modal").modal("hide");
        }

        $("#add-kelurahan-modal").on('click', '#kelurahan-submit', function() {
            var id_prop = $("option:selected",$("#propinsi-add-form")).val();
            var id_kab = $("option:selected",$("#kabupaten-add-form")).val();
            var id_kec = $("option:selected",$("#kecamatan-add-form")).val();
            var id_kel = $("[name='id']",$("#add-kelurahan-modal")).val();
            var kelurahan = $("[name='kelurahan']",$("#add-kelurahan-modal")).val();
            var kodepos = $("[name='kodepos']",$("#add-kelurahan-modal")).val();
            var longitude = $("[name='longitude']",$("#add-kelurahan-modal")).val();
            var lattitude = $("[name='lattitude']",$("#add-kelurahan-modal")).val();

            if(id_prop.trim() == ''){
                $(".modal-alert","#add-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("Propinsi masih kosong");
                return false;
            }
            if(id_kab.trim() == ''){
                $(".modal-alert","#add-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("Kabupaten masih kosong");
                return false;
            }
            if(id_kec.trim() == ''){
                $(".modal-alert","#add-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("ID masih kosong");
                return false;
            }
            if(id_kel.trim() == ''){
                $(".modal-alert","#add-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("ID masih kosong");
                return false;
            }
            if(kelurahan.trim() == ''){
                $(".modal-alert","#add-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("Nama kecamatan masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'/wilayah/kelurahan/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_prop:id_prop,id_kab:id_kab,id_kec:id_kec,id_kel:id_kel,kelurahan:kelurahan,kodepos:kodepos,longitude:longitude,lattitude:lattitude
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormAddModal();
                        showAlerts('success',data.message);
                        var kecamatan = $("#filter-kecamatan-label").attr("kecamatan-filtered");
                        reloadTable(kecamatan);
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
            var id_kel = $(this).attr('id_kel');
            $.ajax({
                url: "<?php echo my_url().'/wilayah/kelurahan/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_kel:id_kel
                },
                success: function(status) {
                    if(status == true){
                        showAlerts('success','Data telah didelete');
                        var kecamatan = $("#filter-kecamatan-label").attr("kecamatan-filtered");
                        reloadTable(kecamatan);
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
                url: "<?php echo my_url().'/wilayah/kelurahan/detail';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_kel:value[0]
                },
                success: function(dt) {
                    var data = dt.data[0];
                    $("[name='id']",$("#edit-kelurahan-modal")).val(data.id_kel);
                    var prop = $("[name='propinsi']",$("#edit-kelurahan-modal"));
                    var option = "<option selected='selected' value='"+data.id_prop+"' >"+data.propinsi+"</option>";
                    $(prop).html(option);
                    var kab = $("[name='kabupaten']",$("#edit-kelurahan-modal"));
                    var option = "<option selected='selected' value='"+data.id_kab+"' >"+data.kabupaten+"</option>";
                    $(kab).html(option);
                    var kec = $("[name='kecamatan']",$("#edit-kelurahan-modal"));
                    var option = "<option selected='selected' value='"+data.id_kec+"' >"+data.kecamatan+"</option>";
                    $(kec).html(option);
                    $("[name='kelurahan']",$("#edit-kelurahan-modal")).val(data.kelurahan);
                    $("[name='kodepos']",$("#edit-kelurahan-modal")).val(data.kodepos);
                    $("[name='longitude']",$("#edit-kelurahan-modal")).val(data.longitude);
                    $("[name='lattitude']",$("#edit-kelurahan-modal")).val(data.lattitude);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

            $(".modal-alert","#edit-kelurahan-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        // Edit record
        table.on('click', '.edit', function() {
            var t = $(this).data('editvalue');
            clearFormModalEdit(t.split(','));
            $("#edit-kelurahan-modal").modal("show");
            return false;
        });

        $("#edit-kelurahan-modal").on('click', '#kelurahan-edit-submit', function() {
            var id_prop = $("option:selected",$("#propinsi-edit-form")).val();
            var id_kab = $("option:selected",$("#kabupaten-edit-form")).val();
            var id_kec = $("option:selected",$("#kecamatan-edit-form")).val();
            var id_kel = $("[name='id']",$("#edit-kelurahan-modal")).val();
            var kelurahan = $("[name='kelurahan']",$("#edit-kelurahan-modal")).val();
            var kodepos = $("[name='kodepos']",$("#edit-kelurahan-modal")).val();
            var longitude = $("[name='longitude']",$("#edit-kelurahan-modal")).val();
            var lattitude = $("[name='lattitude']",$("#edit-kelurahan-modal")).val();

            if(id_prop.trim() == ''){
                $(".modal-alert","#edit-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("Propinsi masih kosong");
                return false;
            }
            if(id_kab.trim() == ''){
                $(".modal-alert","#edit-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("Kabupaten masih kosong");
                return false;
            }
            if(id_kec.trim() == ''){
                $(".modal-alert","#edit-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("ID masih kosong");
                return false;
            }
            if(id_kel.trim() == ''){
                $(".modal-alert","#edit-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("ID masih kosong");
                return false;
            }
            if(kelurahan.trim() == ''){
                $(".modal-alert","#edit-kelurahan-modal").addClass("alert-danger").removeClass("hide").text("Nama kecamatan masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'/wilayah/kelurahan/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_prop:id_prop,id_kab:id_kab,id_kec:id_kec,id_kel:id_kel,kelurahan:kelurahan,kodepos:kodepos,longitude:longitude,lattitude:lattitude
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormAddModal();
                        showAlerts('success',data.message);
                        var kecamatan = $("#filter-kecamatan-label").attr("kecamatan-filtered");
                        reloadTable(kecamatan);
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