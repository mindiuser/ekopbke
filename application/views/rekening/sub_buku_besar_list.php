<?php $this->load->view('shared/css_content');?>
<div class="row" id="sub_buku_besar">
<div class="col-md-12">
<div class="card">
<div class="card-content">
<h3 class="card-title"><i class="fa fa-book" aria-hidden="true"></i> DAFTAR REKENING SUB BUKU BESAR</h3>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>KODE</th>
    <th>KETERANGAN</th>
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
$this->load->view('rekening/subbukubesar_add_modal',['jenis'=>$jenis]);
$this->load->view('rekening/subbukubesar_edit_modal',['jenis'=>$jenis]);
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var idModalAdd = "#add-subbukubesar-modal";
        var idModalEdit = "#edit-subbukubesar-modal";

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
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-buku-besar-label">BUKU BESAR </span><span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-buku-besar">';
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<button type="button" id="add" class="btn-new btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var reloadTable = function(buku_besar){
            $.ajax({
                url: "<?php echo my_url();?>/rekening/sub_buku_besar_data",
                type: 'POST',
                dataType:'json',
                data: {
                    buku_besar:buku_besar
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
            "ajax": "<?php echo my_url();?>/rekening/sub_buku_besar_data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" acc="'+row[0]+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" acc="'+row[0]+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 3
                }
            ]
        });
        initBar();

        $('#sub_buku_besar').on("click",".select-jenis",function(){
            var $that = $(this);
            $.ajax({
                url: "<?php echo my_url();?>/rekening/filter_kelompok",
                type: 'POST',
                dataType:'html',
                data: {
                    jenis_rekening : $(this).attr('id')
                },
                success: function(options) {
                    $("ul#filter-kelompok").html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

            $("#filter-jenis-label").text("JENIS : "+$(this).attr("label"));
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
                    $("#kelompok-add-form",$('#add-subbukubesar-modal')).html(options);
                    $("#kelompok-edit-form",$('#edit-subbukubesar-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        $('#filter-kelompok').on("click",'.select-kelompok',function(){
            var $that = $(this);
            $.ajax({
                url: "<?php echo my_url();?>/rekening/filter_buku_besar",
                type: 'POST',
                dataType:'html',
                data: {
                    kelompok : $(this).attr('id')
                },
                success: function(options) {
                    $("ul#filter-buku-besar").html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

            $.ajax({
                url: "<?php echo my_url();?>rekening/filter_buku_besar_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    kelompok : $(this).attr('id')
                },
                success: function(options) {
                    $("#bukubesar-add-form",$('#add-subbukubesar-modal')).html(options);
                    $("#bukubesar-edit-form",$('#edit-subbukubesar-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

            $("#filter-kelompok-label").text("Kelompok : "+$that.attr("label"));
            var tgt = $("#filter-kelompok-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-kelompok-label").attr("kelompok-filtered",$(this).attr('id'));
            reloadTable(0);
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

        $("#filter-buku-besar").on('click',".select-bukubesar",function () {
            var $that = $(this);
            reloadTable($(this).attr("id"));
            $("#filter-buku-besar-label").text("Buku Besar : "+$(this).attr("label"));
            var tgt = $("#filter-buku-besar-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-buku-besar-label").attr("buku-besar-filtered",$(this).attr('id'));
            $("option",$("#bukubesar-add-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);

                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });

            $("option",$("#bukubesar-edit-form")).each(function(){
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

        $('#add-subbukubesar-modal').on("change","#jenis-add-form",function(){
            var jenis = $("option:selected",$(this)).val();
            $.ajax({
                url: "<?php echo my_url();?>rekening/filter_kelompok_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    jenis_rekening : jenis
                },
                success: function(options) {
                    $("#kelompok-add-form",$('#add-subbukubesar-modal')).html(options);
                    $("#kelompok-edit-form",$('#edit-subbukubesar-modal')).html(options);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

        });

        $('#add-subbukubesar-modal').on("change","#kelompok-add-form",function(){
            var kelompok = $("option:selected",$(this)).val();
            $.ajax({
                url: "<?php echo my_url();?>rekening/filter_buku_besar_modal",
                type: 'POST',
                dataType:'html',
                data: {
                    kelompok : kelompok
                },
                success: function(options) {
                    $("#bukubesar-add-form",$('#add-subbukubesar-modal')).html(options);
                    $("#bukubesar-edit-form",$('#edit-subbukubesar-modal')).html(options);
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
            $("input",$("#add-subbukubesar-modal")).each(function(){
                $(this).val("");
            });
            $("textarea",$("#add-subbukubesar-modal")).each(function(){
                $(this).text("");
            });
            $(".modal-alert","#add-subbukubesar-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        $("#sub_buku_besar").on('click', '#add', function() {
            clearFormModalAdd();
            $("#add-subbukubesar-modal").modal("show");
            return false;
        });

        var hideFormAddModal = function(){
            $(["input"],$("#add-subbukubesar-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#add-subbukubesar-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#add-subbukubesar-modal").modal("hide");
        }

        var hideFormEditModal = function(){
            $(["input"],$("#edit-subbukubesar-modal")).each(function(i,v){
                $(this).val("");
            });
            $(".modal-alert","#edit-subbukubesar-modal").removeClass("alert-warning").addClass("hide").text("");
            $("#edit-subbukubesar-modal").modal("hide");
        }

        $("#add-subbukubesar-modal").on('click', '#subbukubesar-submit', function() {
            var jenis = $("option:selected",$("#jenis-add-form")).val();
            var kelompok = $("option:selected",$("#kelompok-add-form")).val();
            var bukubesar = $("option:selected",$("#bukubesar-add-form")).val();
            var acc = $("[name='id']",$("#add-subbukubesar-modal")).val();
            var keterangan = $("[name='keterangan']",$("#add-subbukubesar-modal")).val();
            var golongan = $("option:selected",$("#golongan-add-form")).val();
            var ku = $("option:selected",$("#ku-add-form")).val();

            if(jenis.trim() == ''){
                $(".modal-alert","#add-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Jenis masih kosong");
                return false;
            }
            if(kelompok.trim() == ''){
                $(".modal-alert","#add-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Kelompok masih kosong");
                return false;
            }
            if(bukubesar.trim() == ''){
                $(".modal-alert","#add-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Buku Besar masih kosong");
                return false;
            }
            if(acc.trim() == ''){
                $(".modal-alert","#add-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("ACC masih kosong");
                return false;
            }
            if(keterangan.trim() == ''){
                $(".modal-alert","#add-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Keterangan masih kosong");
                return false;
            }
            if(golongan.trim() == ''){
                $(".modal-alert","#add-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Golongan masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'rekening/sub_buku_besar/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    jenis:jenis,kelompok:kelompok,bukubesar:bukubesar,acc:acc,keterangan:keterangan,golongan:golongan,ku:ku
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormAddModal();
                        showAlerts('success',data.message);
                        var accbb = $("#filter-buku-besar-label").attr("buku-besar-filtered");
                        reloadTable(accbb);
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
            var acc = $(this).attr('acc');
            $.ajax({
                url: "<?php echo my_url().'/rekening/sub_buku_besar/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    acc:acc
                },
                success: function(status) {
                    if(status == true){
                        showAlerts('success','Data telah didelete');
                        var accbb = $("#filter-buku-besar-label").attr("buku-besar-filtered");
                        reloadTable(accbb);
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


        //---------------
        var clearFormModalEdit = function(acc){
            $.ajax({
                url: "<?php echo my_url().'/rekening/sub_buku_besar/detail';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    acc:acc
                },
                success: function(dt) {
                    var data = dt.data[0];
                    var jenis = $("[name='jenis']",$("#edit-subbukubesar-modal"));
                    var option = "<option selected='selected' value='"+data.accjenis+"' >"+data.jenis+"</option>";
                    $(jenis).html(option);
                    var kelompok = $("[name='kelompok']",$("#edit-subbukubesar-modal"));
                    var option = "<option selected='selected' value='"+data.acckel+"' >"+data.kel+"</option>";
                    $(kelompok).html(option);
                    var bb = $("[name='bukubesar']",$("#edit-subbukubesar-modal"));
                    var option = "<option selected='selected' value='"+data.accbb+"' >"+data.bb+"</option>";
                    $(bb).html(option);
                    $("[name='id']",$("#edit-subbukubesar-modal")).val(data.acc);
                    $("[name='keterangan']",$("#edit-subbukubesar-modal")).val(data.keterangan);
                    $("[name='golongan']",$("#edit-subbukubesar-modal")).val(data.golongan);
                    $("[name='ku']",$("#edit-subbukubesar-modal")).val(data.ku);
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

            $(".modal-alert","#edit-bukubesar-modal").removeClass("alert-warning").addClass("hide").text("");
        }

        // Edit record
        table.on('click', '.edit', function() {
            var acc = $(this).attr('acc');
            clearFormModalEdit(acc);
            $("#edit-subbukubesar-modal").modal("show");
            return false;
        });

        $("#edit-subbukubesar-modal").on('click', '#subbukubesar-edit-submit', function() {
            var jenis = $("option:selected",$("#jenis-edit-form")).val();
            var kelompok = $("option:selected",$("#kelompok-edit-form")).val();
            var bukubesar = $("option:selected",$("#bukubesar-edit-form")).val();
            var acc = $("[name='id']",$("#edit-subbukubesar-modal")).val();
            var keterangan = $("[name='keterangan']",$("#edit-subbukubesar-modal")).val();
            var golongan = $("option:selected",$("#golongan-edit-form")).val();
            var ku = $("option:selected",$("#ku-edit-form")).val();

            if(jenis.trim() == ''){
                $(".modal-alert","#edit-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Jenis masih kosong");
                return false;
            }
            if(kelompok.trim() == ''){
                $(".modal-alert","#edit-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Kelompok masih kosong");
                return false;
            }
            if(bukubesar.trim() == ''){
                $(".modal-alert","#edit-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Buku Besar masih kosong");
                return false;
            }
            if(acc.trim() == ''){
                $(".modal-alert","#edit-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("ACC masih kosong");
                return false;
            }
            if(keterangan.trim() == ''){
                $(".modal-alert","#edit-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Keterangan masih kosong");
                return false;
            }
            if(golongan.trim() == ''){
                $(".modal-alert","#edit-subbukubesar-modal").addClass("alert-danger").removeClass("hide").text("Golongan masih kosong");
                return false;
            }

            $.ajax({
                url: "<?php echo my_url().'rekening/sub_buku_besar/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    jenis:jenis,kelompok:kelompok,bukubesar:bukubesar,acc:acc,keterangan:keterangan,golongan:golongan,ku:ku
                },
                success: function(data) {
                    if(data.status == true){
                        hideFormEditModal();
                        showAlerts('success',data.message);
                        var accbb = $("#filter-buku-besar-label").attr("buku-besar-filtered");
                        reloadTable(accbb);
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

            return false;
        });


    });
</script>