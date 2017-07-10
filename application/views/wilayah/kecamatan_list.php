<?php $this->load->view('shared/css_content');?>
<div class="row" id="kecamatan">
<div class="col-md-12">
<div class="card">
<div class="card-content">
<h3 class="card-title"> <i class="fa fa-map-marker mr-10" aria-hidden="true"></i>  DAFTAR WILAYAH KECAMATAN</h3>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>ID</th>
    <th>KECAMATAN</th>
    <th>KETERANGAN</th>
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
$this->load->view('wilayah/kecamatan_add_modal',['propinsi'=>$propinsi]);
$this->load->view('wilayah/kecamatan_edit_modal',['propinsi'=>$propinsi]);
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var idModalAdd = "#add-kecamatan-modal";
        var idModalEdit = "#edit-kecamatan-modal";

        var reloadTable = function(kabupaten){
            if(typeof kabupaten == 'undefined'){
                kabupaten = 0;
            }
            $.ajax({
                url: "<?php echo my_url();?>/wilayah/kecamatan/data",
                type: 'POST',
                dataType:'json',
                data: {
                    kabupaten:kabupaten
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
            <?php if(!empty($kabupaten)){ foreach($kabupaten as $row) { ?>
            actionbutton += '<li><a href="#" class="select-kabupaten" id="<?php echo $row->ID_KAB;?>"  label="<?php echo $row->NAMA_KABUPATEN;?>"><?php echo $row->NAMA_KABUPATEN;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<button type="button" id="add" class="btn-new btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var clearFormModalAdd = function(){
            $("input",$("#add-kecamatan-modal")).each(function(){
                $(this).val("");
            });
            $("textarea",$("#add-kecamatan-modal")).each(function(){
                $(this).text("");
            });
            $("select",$("#add-kecamatan-modal")).each(function(){
                var $this = this;
                $("option",$($this)).each(function(){
                    $(this).removeAttr("selected");
                });
            });
            $(".modal-alert","#add-kecamatan-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        var clearFormModalEdit = function(){
            $("input",$("#edit-kabupaten-modal")).each(function(){
                $(this).val("");
            });
            $("textarea",$("#edit-kabupaten-modal")).each(function(){
                $(this).text("");
            });
            $("select",$("#edit-kabupaten-modal")).each(function(){
                var $this = this;
                $("option",$($this)).each(function(){
                    $(this).removeAttr("selected");
                });
            });
            $(".modal-alert","#edit-kecamatan-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": dtBtn,
            "ajax": "<?php echo base_url();?>/wilayah/kecamatan/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" data-editvalue="'+row+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" id_kec="'+row[0]+'" ><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 3
                }
            ]
        });

        initBar();

        /*************************
         * Filter and Filter data
         **********************/
        $("#filter-propinsi").on("click",'.select-propinsi',function(){
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
                    $('.dt-alert .alert').addClass('alert-danger').removeClass('alert-success hidden').text(textStatus);
                }
            });

            $("#filter-propinsi-label").text("Propinsi : "+$(this).attr("label"));
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
                    $("#kabupaten-add-form",$('#add-kecamatan-modal')).html(options);
                    $("#kabupaten-edit-form",$('#edit-kecamatan-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

        });

        $("#filter-kabupaten").on('click',".select-kabupaten",function () {
            var $that = $(this);
            reloadTable($that.attr('id'));
            $("#filter-kabupaten-label").text("Kabupaten : "+$(this).attr("label"));
            var tgt = $("#filter-kabupaten-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-kabupaten-label").attr("kabupaten-filtered",$that.attr('id'));

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
        });

        $('#add-kecamatan-modal').on("change","#propinsi-add-form",function(){
            var propinsi = $("option:selected",$(this)).val();
            $.ajax({
                url: "<?php echo my_url();?>wilayah/filter_kabupaten_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    propinsi : propinsi
                },
                success: function(options) {
                    $("#kabupaten-add-form",$('#add-kecamatan-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showErrorModal(idModalAdd,textStatus);
                }
            });

        });

        /*************************
         * Add New Record
         **********************/
        $("#kecamatan").on('click', '#add', function() {
            clearFormModalAdd();
            $("#add-kecamatan-modal").modal("show");
            return false;
        });

        var hideFormAddModal = function(){
            $(["input"],$("#add-kecamatan-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#add-kecamatan-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#add-kecamatan-modal").modal("hide");
        }

        var hideFormEditModal = function(){
            $(["input"],$("#edit-kecamatan-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#edit-kecamatan-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#edit-kecamatan-modal").modal("hide");
        }

        $("#add-kecamatan-modal").on('click', '#kecamatan-submit', function() {
            var id_prop = $("option:selected",$("#propinsi-add-form")).val();
            var id_kab = $("option:selected",$("#kabupaten-add-form")).val();
            var id_kec = $("[name='id']",$("#add-kecamatan-modal")).val();
            var kecamatan = $("[name='kecamatan']",$("#add-kecamatan-modal")).val();
            var kodepos = $("[name='kodepos']",$("#add-kecamatan-modal")).val();
            var keterangan = $("[name='keterangan']",$("#add-kecamatan-modal")).val();

            if(id_prop.trim() == ''){
                $(".modal-alert","#add-kecamatan-modal").addClass("alert-danger").removeClass("hide").text("Propinsi masih kosong");
                return false;
            }
            if(id_kab.trim() == ''){
                $(".modal-alert","#add-kecamatan-modal").addClass("alert-danger").removeClass("hide").text("Kabupaten masih kosong");
                return false;
            }
            if(id_kec.trim() == ''){
                $(".modal-alert","#add-kecamatan-modal").addClass("alert-danger").removeClass("hide").text("ID masih kosong");
                return false;
            }
            if(kecamatan.trim() == ''){
                $(".modal-alert","#add-kecamatan-modal").addClass("alert-danger").removeClass("hide").text("Nama kecamatan masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'/wilayah/kecamatan/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_prop:id_prop,id_kab:id_kab,id_kec:id_kec,kecamatan:kecamatan,kodepos:kodepos,keterangan:keterangan
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormAddModal();
                        showAlerts('success',data.message);
                        var kabupaten = $("#filter-kabupaten-label").attr("kabupaten-filtered");
                        reloadTable(kabupaten);
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
            var id_kec = $(this).attr('id_kec');
            $.ajax({
                url: "<?php echo my_url().'/wilayah/kecamatan/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_kec:id_kec
                },
                success: function(status) {
                    if(status == true){
                        showAlerts('success','Data telah didelete');
                        var kabupaten = $("#filter-kabupaten-label").attr("kabupaten-filtered");
                        reloadTable(kabupaten);
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
                url: "<?php echo my_url().'/wilayah/kecamatan/detail';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_kec:value[0]
                },
                success: function(dt) {
                    var data = dt.data[0];
                    $("[name='id']",$("#edit-kecamatan-modal")).val(data.id_kec);
                    var kab = $("[name='kabupaten']",$("#edit-kecamatan-modal"));
                    var option = "<option selected='selected' value='"+data.id_kab+"' >"+data.kabupaten+"</option>";
                    $(kab).html(option);
                    $("[name='kecamatan']",$("#edit-kecamatan-modal")).val(data.kecamatan);
                    $("[name='kodepos']",$("#edit-kecamatan-modal")).val(data.kodepos);
                    $("[name='keterangan']",$("#edit-kecamatan-modal")).val(data.keterangan);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });


            $(".modal-alert","#edit-kecamatan-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        // Edit record
        table.on('click', '.edit', function() {
            var t = $(this).data('editvalue');
            clearFormModalEdit(t.split(','));
            $("#edit-kecamatan-modal").modal("show");
            return false;
        });

        $("#edit-kecamatan-modal").on('click', '#kecamatan-edit-submit', function() {
            var id_kab = $("option:selected",$("#kabupaten-edit-form")).val();
            var id_kec = $("[name='id']",$("#edit-kecamatan-modal")).val();
            var kecamatan = $("[name='kecamatan']",$("#edit-kecamatan-modal")).val();
            var kodepos = $("[name='kodepos']",$("#edit-kecamatan-modal")).val();
            var keterangan = $("[name='keterangan']",$("#edit-kecamatan-modal")).val();
            if(id_kab.trim() == ''){
                $(".modal-alert","#edit-kecamatan-modal").addClass("alert-danger").removeClass("hide").text("Kabupaten masih kosong");
                return false;
            }
            if(id_kec.trim() == ''){
                $(".modal-alert","#edit-kecamatan-modal").addClass("alert-danger").removeClass("hide").text("ID masih kosong");
                return false;
            }
            if(kecamatan.trim() == ''){
                $(".modal-alert","#edit-kecamatan-modal").addClass("alert-danger").removeClass("hide").text("Nama kecamatan masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'/wilayah/kecamatan/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_kab:id_kab,id_kec:id_kec,kecamatan:kecamatan,kodepos:kodepos,keterangan:keterangan
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormEditModal();
                        showAlerts('success',data.message);
                        var kabupaten = $("#filter-kabupaten-label").attr("kabupaten-filtered");
                        reloadTable(kabupaten);
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