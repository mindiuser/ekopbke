<?php $this->load->view('shared/css_content');?>
<div class="row" id="buku_besar">
<div class="col-md-12">
<div class="card mt-20">
<div class="card-content">
<h3 class="card-title"><i class="fa fa-book" aria-hidden="true"></i> DAFTAR REKENING BUKU BESAR</h3>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>KODE</th>
    <th>NAMA BUKU BESAR</th>
    <th>KATEGORI</th>
    <th>GOLONGAN</th>
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
$this->load->view('rekening/bukubesar_add_modal',['jenis'=>$jenis]);
$this->load->view('rekening/bukubesar_edit_modal',['jenis'=>$jenis]);
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var idModalAdd = "#add-bukubesar-modal";
        var idModalEdit = "#edit-bukubesar-modal";
        var initBar = function(){
            var actionbutton = '';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-jenis-label">JENIS REKENING </span> <span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-jenis">';
            <?php if(!empty($jenis)){ foreach($jenis as $row) { ?>
            actionbutton += '<li><a href="#" class="select-jenis" id="<?php echo $row->ACCJENIS;?>" label="<?php echo $row->JENIS;?>"><?php echo $row->JENIS;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-kelompok-label">KELOMPOK </span><span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-kelompok">';
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<button type="button" id="add" class="btn-new btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var reloadTable = function(kelompok){
            $.ajax({
                url: "<?php echo my_url();?>/rekening/buku_besar_data",
                type: 'POST',
                dataType:'json',
                data: {
                    kelompok:kelompok
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

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": dtBtn,
            "ajax": "<?php echo my_url();?>/rekening/buku_besar_data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" accbb="'+row[0]+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" accbb="'+row[0]+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 4
                }
            ]
        });
        initBar();

        $('#buku_besar').on("click",".select-jenis",function(){
            var $that = $(this);
            $.ajax({
                url: "<?php echo base_url();?>/rekening/filter_kelompok",
                type: 'POST',
                dataType:'html',
                data: {
                    jenis_rekening : $(this).attr('id')
                },
                success: function(options) {
                    $("ul#filter-kelompok").html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    $('.dt-alert .alert').addClass('alert-danger').removeClass('alert-success hidden').text(textStatus);
                }
            });

            $("#filter-jenis-label").text("JENIS REKENING : "+$(this).attr("label"));
            var tgt = $("#filter-jenis-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-jenis-label").attr("jenis-filtered",$(this).attr('id'));
            reloadTable(0);

            $("option",$("#jenis-add-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);

                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });

            $("option",$("#jenis-edit-form")).each(function(){
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
                url: "<?php echo my_url();?>rekening/filter_kelompok_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    jenis_rekening : $(this).attr('id')
                },
                success: function(options) {
                    $("#kelompok-add-form",$('#add-bukubesar-modal')).html(options);
                    $("#kelompok-edit-form",$('#edit-bukubesar-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        $("#buku_besar").on('click',".select-kelompok",function () {
            var $that = $(this);
            reloadTable($(this).attr("id"));
            $("#filter-kelompok-label").text("Kelompok : "+$(this).attr("label"));
            var tgt = $("#filter-kelompok-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-kelompok-label").attr("kelompok-filtered",$(this).attr('id'));
            $("option",$("#kelompok-add-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);

                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });

            $("option",$("#kelompok-edit-form")).each(function(){
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

        $('#add-bukubesar-modal').on("change","#jenis-add-form",function(){
            var jenis = $("option:selected",$(this)).val();
            $.ajax({
                url: "<?php echo my_url();?>rekening/filter_kelompok_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    jenis_rekening : jenis
                },
                success: function(options) {
                    $("#kelompok-add-form",$('#add-bukubesar-modal')).html(options);
                    $("#kelompok-edit-form",$('#edit-bukubesar-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

        });

        /*************************
         * Add New Record
         **********************/
        var clearFormModalAdd = function(){
            $("input",$("#add-bukubesar-modal")).each(function(){
                $(this).val("");
            });
            $("textarea",$("#add-bukubesar-modal")).each(function(){
                $(this).text("");
            });
            $("select",$("#add-bukubesar-modal")).each(function(){
                var $this = this;
                $("option",$($this)).each(function(){
                    $(this).removeAttr("selected");
                });
            });
            $(".modal-alert","#add-bukubesar-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        $("#buku_besar").on('click', '#add', function() {
            clearFormModalAdd();
            $("#add-bukubesar-modal").modal("show");
            return false;
        });

        var hideFormAddModal = function(){
            $(["input"],$("#add-bukubesar-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#add-bukubesar-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#add-bukubesar-modal").modal("hide");
        }

        var hideFormEditModal = function(){
            $(["input"],$("#edit-bukubesar-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#edit-bukubesar-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#edit-bukubesar-modal").modal("hide");
        }

        $("#add-bukubesar-modal").on('click', '#bukubesar-submit', function() {
            var kelompok = $("option:selected",$("#kelompok-add-form")).val();
            var accbb = $("[name='id']",$("#add-bukubesar-modal")).val();
            var bukubesar = $("[name='bukubesar']",$("#add-bukubesar-modal")).val();
            var kategori = $("option:selected",$("#kategori-add-form")).val();
            var golongan = $("option:selected",$("#golongan-add-form")).val();
            var resiko = $("[name='resiko']",$("#add-bukubesar-modal")).val();

            if(kelompok.trim() == ''){
                $(".modal-alert","#add-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Kelompok masih kosong");
                return false;
            }
            if(accbb.trim() == ''){
                $(".modal-alert","#add-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Account Buku Besar masih kosong");
                return false;
            }
            if(bukubesar.trim() == ''){
                $(".modal-alert","#add-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Buku Besar masih kosong");
                return false;
            }
            if(kategori.trim() == ''){
                $(".modal-alert","#add-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Kategori masih kosong");
                return false;
            }
            if(golongan.trim() == ''){
                $(".modal-alert","#add-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Golongan masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'rekening/buku_besar/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    kelompok:kelompok,accbb:accbb,bukubesar:bukubesar,kategori:kategori,golongan:golongan,resiko:resiko
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormAddModal();
                        showAlerts('success',data.message);
                        var kelompok = $("#filter-kelompok-label").attr("kelompok-filtered");
                        reloadTable(kelompok);
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
            var accbb = $(this).attr('accbb');
            $.ajax({
                url: "<?php echo my_url().'/rekening/buku_besar/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    accbb:accbb
                },
                success: function(status) {
                    if(status == true){
                        showAlerts('success','Data telah didelete');
                        var kelompok = $("#filter-kelompok-label").attr("kelompok-filtered");
                        reloadTable(kelompok);
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

        var clearFormModalEdit = function(accbb){
            $.ajax({
                url: "<?php echo my_url().'/rekening/buku_besar/detail';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    accbb:accbb
                },
                success: function(dt) {
                    var data = dt.data[0];
                    var jenis = $("[name='jenis']",$("#edit-bukubesar-modal"));
                    var option = "<option selected='selected' value='"+data.accjenis+"' >"+data.jenis+"</option>";
                    $(jenis).html(option);
                    var kelompok = $("[name='kelompok']",$("#edit-bukubesar-modal"));
                    var option = "<option selected='selected' value='"+data.acckel+"' >"+data.kel+"</option>";
                    $(kelompok).html(option);
                    $("[name='id']",$("#edit-bukubesar-modal")).val(data.accbb);
                    $("[name='bukubesar']",$("#edit-bukubesar-modal")).val(data.bukubesar);
                    $("[name='kategori']",$("#edit-bukubesar-modal")).val(data.kategori);
                    $("[name='golongan']",$("#edit-bukubesar-modal")).val(data.golongan);
                    $("[name='resiko']",$("#edit-bukubesar-modal")).val(data.resiko);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

            $(".modal-alert","#edit-bukubesar-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        // Edit record
        table.on('click', '.edit', function() {
            var accbb = $(this).attr('accbb');
            clearFormModalEdit(accbb);
            $("#edit-bukubesar-modal").modal("show");
            return false;
        });

        $("#edit-bukubesar-modal").on('click', '#bukubesar-edit-submit', function() {
            var kelompok = $("option:selected",$("#kelompok-edit-form")).val();
            var accbb = $("[name='id']",$("#edit-bukubesar-modal")).val();
            var bukubesar = $("[name='bukubesar']",$("#edit-bukubesar-modal")).val();
            var kategori = $("option:selected",$("#kategori-edit-form")).val();
            var golongan = $("option:selected",$("#golongan-edit-form")).val();
            var resiko = $("[name='resiko']",$("#edit-bukubesar-modal")).val();

            if(kelompok.trim() == ''){
                $(".modal-alert","#edit-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Kelompok masih kosong");
                return false;
            }
            if(accbb.trim() == ''){
                $(".modal-alert","#edit-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Account Buku Besar masih kosong");
                return false;
            }
            if(bukubesar.trim() == ''){
                $(".modal-alert","#edit-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Buku Besar masih kosong");
                return false;
            }
            if(kategori.trim() == ''){
                $(".modal-alert","#edit-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Kategori masih kosong");
                return false;
            }
            if(golongan.trim() == ''){
                $(".modal-alert","#edit-bukubesar-modal").addClass("alert-danger").removeClass("hide").text("Golongan masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'rekening/buku_besar/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    kelompok:kelompok,accbb:accbb,bukubesar:bukubesar,kategori:kategori,golongan:golongan,resiko:resiko
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormEditModal();
                        showAlerts('success',data.message);
                        var kelompok = $("#filter-kelompok-label").attr("kelompok-filtered");
                        reloadTable(kelompok);
                    }
                    else {
                        //showAlerts('error',data.message);
                        showErrorModal(idModalEdit,data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    //showAlerts('error',textStatus);
                    showErrorModal(idModalAdd,textStatus);
                }
            });

            return false;

        });


    });
</script>