<?php $this->load->view('shared/css_content');?>
<div class="row" id="jabatan">
<div class="col-md-12">
<div class="card mt-20">
<div class="card-content">
<h3 class="card-title"><i class="fa fa-user-circle" aria-hidden="true"></i> DAFTAR JABATAN</h3>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>URUT</th>
    <th>JABATAN</th>
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
$this->load->view('setting/jabatan_add_modal',['bagian'=>$bagian]);
$this->load->view('setting/jabatan_edit_modal',['bagian'=>$bagian]);
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var currentBagian = function(){
            return $("#filter-bagian-label").attr("val");
        }

        var reloadTable = function(bagian){
            $.ajax({
                url: "<?php echo my_url();?>/user/jabatan/data",
                type: 'POST',
                dataType:'json',
                data: {bagian:bagian},
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
            actionbutton += '<span id="filter-bagian-label">PILIH BAGIAN</span> <span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-bagian">';
            <?php if(!empty($bagian)){ foreach($bagian as $row) { ?>
            actionbutton += '<li><a href="#" class="select-bagian" id="<?php echo $row->URUT;?>" label="<?php echo $row->BAGIAN;?>"><?php echo $row->BAGIAN;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<button type="button" id="add" class="btn-new btn btn-sm btn-primary"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": [ 'excel', 'pdf', 'print'],
            "ajax": "<?php echo my_url();?>/user/jabatan/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" urut="'+row[0]+'" jabatan="'+row[1]+'" bagian="'+row[2]+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" urut="'+row[0]+'" jabatan="'+row[1]+'" bagian="'+row[2]+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 2
                }
            ]
        });
        initBar();

        $("#filter-bagian").on('click',".select-bagian",function () {
            var $that = $(this);
            reloadTable($(this).attr('label'));

            $("#filter-bagian-label").text("Bagian : "+$(this).attr("label")).attr("val",$(this).attr('label'));
            var tgt = $("#filter-bagian-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
            $("#filter-bagian-label").attr("bagian-filtered",$that.attr('id'));

            $("option",$("#bagian-add-form")).each(function(){
                if($(this).val() == $that.attr('id')){
                    $(this).attr("selected","selected");
                    $(this).prop('disabled',false);

                }
                else {
                    $(this).removeAttr("selected");
                    $(this).prop('disabled',true);
                }
            });

            $("option",$("#bagian-edit-form")).each(function(){
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

        $("#jabatan").on('click', '#add', function() {
            $(".modal-alert","#add-jabatan-modal").removeClass("alert-danger").addClass("hide").text("");
            /*var select = $("select[name='bagian']","#add-jabatan-modal");
            $("option",$(select)).each(function(){
                if($(this).val() == currentBagian()){
                    $(this).attr("selected","selected");
                    if(currentBagian() != ''){
                        $("select[name='bagian']","#add-jabatan-modal").attr("disabled");
                    }
                }
                else {
                    $(this).removeAttr("selected");
                }
            });*/
            $("#add-jabatan-modal").modal("show");
            return false;
        });

        $("#add-jabatan-modal").on('click', '#jabatan-submit', function() {
            var bagian = $("option:selected",$("#bagian-add-form")).attr('label');
            var urut = $("input[name='urut']","#add-jabatan-modal").val();
            var jabatan = $("input[name='jabatan']","#add-jabatan-modal").val();
            if(bagian.trim() == ''){
                $(".modal-alert","#add-jabatan-modal").addClass("alert-danger").removeClass("hide").text("Bagian belum dipilih");
                return false;
            }
           /* if(urut.trim() == ''){
                $(".modal-alert","#add-jabatan-modal").addClass("alert-danger").removeClass("hide").text("Nomor urut masih kosong");
                return false;
            }*/
            if(jabatan.trim() == ''){
                $(".modal-alert","#add-jabatan-modal").addClass("alert-danger").removeClass("hide").text("Nama jabatan masih kosong");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'/user/jabatan/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    urut : urut, bagian:bagian,jabatan:jabatan
                },
                success: function(data) {
                    /*$("[name='urut']",$("#add-jabatan-modal")).val('');*/
                    $("[name='jabatan']",$("#add-jabatan-modal")).val('');
                    $(".modal-alert","#add-jabatan-modal").removeClass("alert-warning").addClass("hide").text("");
                    $("#add-jabatan-modal").modal("hide");
                    if(data.status == true){
                        showAlerts('success',data.message);
                        reloadTable(currentBagian());
                    }
                    else {
                        showAlerts('error',data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });
        });

        $("#add-jabatan-modal").on('click', '#jabatan-submit-cancel', function(){
            //$(".modal-alert","#add-bagian-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='urut']",$("#add-jabatan-modal")).val('');
            $("[name='jabatan']",$("#add-jabatan-modal")).val('');
            $("#add-jabatan-modal").modal("hide");
        });


        // Edit record
        table.on('click', '.edit', function() {
            $("[name='edit-urut']",$("#edit-jabatan-modal")).val($(this).attr('urut'));
            $("[name='edit-jabatan']",$("#edit-jabatan-modal")).val($(this).attr('jabatan'));
            $("[name='edit-urut-old']",$("#edit-jabatan-modal")).val($(this).attr('urut'));
            $("[name='edit-jabatan-old']",$("#edit-jabatan-modal")).val($(this).attr('jabatan'));
            $("#edit-jabatan-modal").modal("show");
            return false;
        });

        $("#edit-jabatan-modal").on('click', '#jabatan-edit-submit', function() {
            var bagian = $("option:selected",$("#bagian-edit-form")).attr('label');
            var urut = $("input[name='edit-urut']","#edit-jabatan-modal").val();
            var jabatan = $("input[name='edit-jabatan']","#edit-jabatan-modal").val();
            var urut_old = $("input[name='edit-urut-old']","#edit-jabatan-modal").val();
            var jabatan_old = $("input[name='edit-jabatan-old']","#edit-jabatan-modal").val();
            if(bagian.trim() == ''){
                $(".modal-alert","#add-jabatan-modal").addClass("alert-danger").removeClass("hide").text("Bagian masih kosong");
                return false;
            }
           /* if(urut.trim() == ''){
                $(".modal-alert","#edit-jabatan-modal").addClass("alert-danger").removeClass("hide").text("Nomor urut masih kosong");
                return false;
            }*/
            if(jabatan.trim() == ''){
                $(".modal-alert","#edit-jabatan-modal").addClass("alert-danger").removeClass("hide").text("Nama jabatan masih kosong");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'/user/jabatan/edit';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    bagian:bagian, urut :urut, jabatan:jabatan, urut_old:urut_old, jabatan_old:jabatan_old
                },
                success: function(data) {
                    //console.log(data);
                    $("[name='edit-urut']",$("#edit-jabatan-modal")).val('');
                    $("[name='edit-jabatan']",$("#edit-jabatan-modal")).val('');
                    $("[name='edit-urut-old']",$("#edit-jabatan-modal")).val('');
                    $("[name='edit-jabatan-old']",$("#edit-jabatan-modal")).val('');
                    $("#edit-jabatan-modal").modal("hide");
                    if(data.status == true){
                        showAlerts('success',data.message);
                        reloadTable(currentBagian());
                    }
                    else {
                        showAlerts('error',data.message);
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

        });

        $("#edit-jabatan-modal").on('click', '#jabatan-edit-cancel', function(){
            $(".modal-alert","#edit-jabatan-modal").removeClass("alert-danger").addClass("hide").text("");
            $("[name='urut']",$("#edit-jabatan-modal")).val('');
            $("[name='jabatan']",$("#edit-jabatan-modal")).val('');
            $("#edit-jabatan-modal").modal("hide");
        });

        // Delete a record
        table.on('click', '.delete', function(e) {
            var urut = $(this).attr('urut');
            var bagian = $(this).attr('bagian');
            var jabatan = $(this).attr('jabatan');
            $.ajax({
                url: "<?php echo my_url().'/user/jabatan/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    urut:urut, bagian:bagian, jabatan:jabatan
                },
                success: function(status) {
                    if(status == true){
                        showAlerts('success','Data telah didelete');
                        reloadTable(currentBagian());
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



    });
</script>