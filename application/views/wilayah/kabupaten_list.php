<?php $this->load->view('shared/css_content');?>
<div class="row" id="kabupaten">
<div class="col-md-12">
<div class="card mt-20">
<div class="card-content">
<h3 class="card-title"><i class="fa fa-map-marker" aria-hidden="true"></i> DAFTAR WILAYAH KABUPATEN</h3>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>ID</th>
    <th>KABUPATEN</th>
    <th>RES</th>
    <th>IBU KOTA</th>
    <th class="disabled-sorting">ACTIONS</th>
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
$this->load->view('wilayah/kabupaten_add_modal',['propinsi'=>$propinsi]);
$this->load->view('wilayah/kabupaten_edit_modal',['propinsi'=>$propinsi]);
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var idModalAdd = "#add-kabupaten-modal";
        var idModalEdit = "#edit-kabupaten-modal";
        var reloadTable = function(propinsi){
            $.ajax({
                url: "<?php echo my_url();?>/wilayah/kabupaten/data",
                type: 'POST',
                dataType:'json',
                data: {
                    propinsi:propinsi
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
            actionbutton += '<span id="filter-propinsi-label">PILIH PROPINSI</span><span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-propinsi">';
            <?php if(!empty($propinsi)){ foreach($propinsi as $row) { ?>
            actionbutton += '<li><a href="#" class="select-propinsi" id="<?php echo $row->ID_PROP;?>" label="<?php echo $row->NAMA_PROPINSI;?>"><?php echo $row->NAMA_PROPINSI;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<button type="button" id="add" class="btn-new btn btn-sm btn-primary" style="margin-left:3px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": dtBtn,
            "ajax": "<?php echo base_url();?>/wilayah/kabupaten/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                       return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" data-editvalue="'+row+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" id_kab="'+row[0]+'" id_prop="'+row[4]+'" class="delete btn btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    className: "dt-right",
                    "targets": 4
                }
            ]
        });
        initBar();

        $("#filter-propinsi").on('click',".select-propinsi",function () {
            var $that = $(this);
            reloadTable($that.attr('id'));

            $("#filter-propinsi-label").text("Propinsi : "+$(this).attr("label"));
            var tgt = $("#filter-propinsi-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-propinsi-label").attr("propinsi-filtered",$that.attr('id'));

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

        });

        var clearFormModalAdd = function(){
            $("[name='id']",$("#add-kabupaten-modal")).val('');
            $("[name='res']",$("#add-kabupaten-modal")).val('');
            $("[name='kabupaten']",$("#add-kabupaten-modal")).val('');
            $("[name='ibukota']",$("#add-kabupaten-modal")).val('');
            $(".modal-alert","#add-kabupaten-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        $("#kabupaten").on('click', '#add', function() {
            clearFormModalAdd();
            $("#add-kabupaten-modal").modal("show");
            return false;
        });

        var hideFormAddModal = function(){
            $(["input"],$("#add-kabupaten-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#add-kabupaten-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#add-kabupaten-modal").modal("hide");
        }

        $("#add-kabupaten-modal").on('click', '#kabupaten-submit', function() {
            var id_prop = $("option:selected",$("#propinsi-add-form")).val();
            var id_kab = $("[name='id']",$("#add-kabupaten-modal")).val();
            var tg = $("[name='res']",$("#add-kabupaten-modal"));
            var res = $("option:selected",$(tg)).val();
            var kabupaten = $("[name='kabupaten']",$("#add-kabupaten-modal")).val();
            var ibukota = $("[name='ibukota']",$("#add-kabupaten-modal")).val();

            if(id_prop.trim() == ''){
                $(".modal-alert","#add-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("Propinsi masih kosong");
                return false;
            }
            if(id_kab.trim() == ''){
                $(".modal-alert","#add-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("ID masih kosong");
                return false;
            }
            if(res.trim() == ''){
                $(".modal-alert","#add-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("Tipe masih kosong");
                return false;
            }
            if(kabupaten.trim() == ''){
                $(".modal-alert","#add-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("Nama kabupaten masih kosong");
                return false;
            }
            if(ibukota.trim() == ''){
                $(".modal-alert","#add-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("Ibukota masih kosong");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'/wilayah/kabupaten/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_prop:id_prop,id_kab:id_kab,res:res,kabupaten:kabupaten,ibukota:ibukota
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormAddModal();
                        showAlerts('success',data.message);
                        var propinsi = $("#filter-propinsi-label").attr("propinsi-filtered");
                        reloadTable(propinsi);
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
            var id_kab = $(this).attr('id_kab');
            var id_prop = $(this).attr('id_prop');
            $.ajax({
                url: "<?php echo my_url().'/wilayah/kabupaten/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_prop:id_prop,id_kab:id_kab
                },
                success: function(status) {
                    if(status == true){
                        showAlerts('success','Data telah didelete');
                        var propinsi = $("#filter-propinsi-label").attr("propinsi-filtered");
                        reloadTable(propinsi);
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
            $("[name='id']",$("#edit-kabupaten-modal")).val(value[0]);
            var sel = $("[name='res']",$("#edit-kabupaten-modal"));
            $("option",$(sel)).each(function(){
                var rs = value[2].replace(/\.$/, "");
                if($(this).val() == rs){
                    $(this).attr("selected","selected");
                }
            });
           // $("[name='res']",$("#edit-kabupaten-modal")).val(value[2]);
            $("[name='kabupaten']",$("#edit-kabupaten-modal")).val(value[1]);
            $("[name='ibukota']",$("#edit-kabupaten-modal")).val(value[3]);
            $(".modal-alert","#edit-kabupaten-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        // Edit record
        table.on('click', '.edit', function() {
           var t = $(this).data('editvalue');
            clearFormModalEdit(t.split(','));
            $("#edit-kabupaten-modal").modal("show");
            return false;
        });

        $("#edit-kabupaten-modal").on('click', '#kabupaten-edit-submit', function() {
            var id_prop = $("option:selected",$("#propinsi-add-form")).val();
            var id_kab = $("[name='id']",$("#edit-kabupaten-modal")).val();
            var tg = $("[name='res']",$("#edit-kabupaten-modal"));
            var res = $("option:selected",$(tg)).val();
            var kabupaten = $("[name='kabupaten']",$("#edit-kabupaten-modal")).val();
            var ibukota = $("[name='ibukota']",$("#edit-kabupaten-modal")).val();

            if(id_prop.trim() == ''){
                $(".modal-alert","#edit-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("Propinsi masih kosong");
                return false;
            }
            if(id_kab.trim() == ''){
                $(".modal-alert","#edit-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("ID masih kosong");
                return false;
            }
            if(res.trim() == ''){
                $(".modal-alert","#edit-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("Tipe masih kosong");
                return false;
            }
            if(kabupaten.trim() == ''){
                $(".modal-alert","#edit-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("Nama kabupaten masih kosong");
                return false;
            }
            if(ibukota.trim() == ''){
                $(".modal-alert","#edit-kabupaten-modal").addClass("alert-danger").removeClass("hide").text("Ibukota masih kosong");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'/wilayah/kabupaten/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    id_prop:id_prop,id_kab:id_kab,res:res,kabupaten:kabupaten,ibukota:ibukota
                },
                success: function(data) {
                    if(data.status == true){
                        $("#edit-kabupaten-modal").modal("hide");
                        showAlerts('success',data.message);
                        var propinsi = $("#filter-propinsi-label").attr("propinsi-filtered");
                        reloadTable(propinsi);
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

        return false;

    });
</script>