<?php $this->load->view('shared/css_content');?>
<div class="row" id="user">
<div class="col-md-12">
<div class="card mt-20">
<div class="card-content">
<h3 class="card-title"><i class="fa fa-user-circle" aria-hidden="true"></i> USER PROFILE</h3>
<div class="toolbar">
    <!--        Here you can write extra buttons/actions for the toolbar              -->
</div>
<div class="material-datatables">
<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
<thead>
<tr>
    <th>USER ID</th>
    <th>NAME</th>
    <th>LEVEL</th>
    <th>BAGIAN</th>
    <th>JABATAN</th>
    <th>ADMINISTRATOR</th>
    <th>SETTING</th>
    <th>REGISTRASI MITRA</th>
    <th>REGISTRASI</th>
    <th>APPROVAL</th>
    <th>DASHBOARD</th>
    <th>REGULASI</th>
    <th>AKSES REGIONAL</th>
    <th>AKSES CABANG</th>
    <th>STATUS</th>
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
$this->load->view('setting/user_add_modal',$params);
$this->load->view('setting/user_edit_modal',$params);
$this->load->view('shared/js_content');
?>
<script type="text/javascript">
    $(document).ready(function() {
        var reloadTable = function(){
            $.ajax({
                url: "<?php echo my_url();?>/user/profile/data",
                type: 'POST',
                dataType:'json',
                data: {},
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
            actionbutton += '<button type="button" id="add" class="btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": [ 'excel', 'pdf', 'print'],
            "ajax": "<?php echo my_url();?>/user/profile/data",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="edit btn btn-xs btn-primary" uid="'+row[0]+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="delete btn btn-xs btn-danger" uid="'+row[0]+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 15
                }
            ]
        });
        initBar();

        $("#user").on('click', '#add', function() {
            var that = $(this);
            $("input[type='text']",$("#add-user-modal")).each(function(){
                $(this).val('');
            });
            $("input[type='password']",$("#add-user-modal")).each(function(){
                $(this).val('');
            });
            $("input[type='checkbox']",$("#add-user-modal")).each(function(){
                $(this).removeAttr("checked");
            });
            $("select",$("#add-user-modal")).each(function(){
                $("option:selected",$(this)).removeAttr("selected");
            });
            $(".modal-alert","#add-user-modal").removeClass("alert-danger").addClass("hide").text("");
            $("#add-user-modal").modal("show");
            return false;
        });

        $("#add-user-modal").on('click', '#user-submit', function() {
            var uid = $("input[name='uid']",$("#add-user-modal")).val();
            var nama = $("input[name='nama']",$("#add-user-modal")).val();
            var password = $("input[name='password']",$("#add-user-modal")).val();
            var sel1 = $("select[name='level']",$("#add-user-modal"));
            var level= $("option:selected",sel1).val();
            var sel2 = $("select[name='bagian']",$("#add-user-modal"));
            var bagian= $("option:selected",sel2).val();
            var sel3 = $("select[name='jabatan']",$("#add-user-modal"));
            var jabatan= $("option:selected",sel3).val();
            var sel4 = $("select[name='regional']",$("#add-user-modal"));
            var regional= $("option:selected",sel4).val();
            var sel5 = $("select[name='cabang']",$("#add-user-modal"));
            var cabang= $("option:selected",sel5).val();
            if(uid.trim() == ''){
                $(".modal-alert",$("#add-user-modal")).addClass("alert-danger").removeClass("hide").text("UID masih kosong");
                return false;
            }
            if(nama.trim() == ''){
                $(".modal-alert",$("#add-user-modal")).addClass("alert-danger").removeClass("hide").text("Nama masih kosong");
                return false;
            }
            if(password.trim() == ''){
                $(".modal-alert",$("#add-user-modal")).addClass("alert-danger").removeClass("hide").text("Password masih kosong");
                return false;
            }
            if(level.trim() == ''){
                $(".modal-alert",$("#add-user-modal")).addClass("alert-danger").removeClass("hide").text("Level masih kosong");
                return false;
            }
            if(bagian.trim() == ''){
                $(".modal-alert",$("#add-user-modal")).addClass("alert-danger").removeClass("hide").text("Bagian masih kosong");
                return false;
            }
            if(jabatan.trim() == ''){
                $(".modal-alert",$("#add-user-modal")).addClass("alert-danger").removeClass("hide").text("Jabatan masih kosong");
                return false;
            }
            if(regional.trim() == ''){
                $(".modal-alert",$("#add-user-modal")).addClass("alert-danger").removeClass("hide").text("Regional masih kosong");
                return false;
            }
            if(cabang.trim() == ''){
                $(".modal-alert",$("#add-user-modal")).addClass("alert-danger").removeClass("hide").text("Cabang masih kosong");
                return false;
            }
            var administrator = ($("[name='administrator']",$("#add-user-modal")).is(":checked"))?1:0;
            var setting = ($("[name='setting']",$("#add-user-modal")).is(":checked"))?1:0;
            var registrasi_mitra = ($("[name='registrasi_mitra']",$("#add-user-modal")).is(":checked"))?1:0;
            var master = ($("[name='master']",$("#add-user-modal")).is(":checked"))?1:0;
            var approval = ($("[name='approval']",$("#add-user-modal")).is(":checked"))?1:0;
            var dashboard = ($("[name='dashboard']",$("#add-user-modal")).is(":checked"))?1:0;
            var regulasi = ($("[name='regulasi']",$("#add-user-modal")).is(":checked"))?1:0;
            var status = $("[name='status']:checked",$("#add-user-modal")).val();
            $.ajax({
                url: "<?php echo my_url().'/user/profile/add';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    uid:uid,nama:nama,password:password,level:level,bagian:bagian,jabatan:jabatan,administrator:administrator,
                    setting:setting,registrasi_mitra:registrasi_mitra,master:master,approval:approval,
                    dashboard:dashboard,regulasi:regulasi,regional:regional,cabang:cabang,status:status
                },
                success: function(data) {
                    $("input[type='text']",$("#add-user-modal")).each(function(){
                        $(this).val('');
                    });
                    $("input[type='checkbox']",$("#add-user-modal")).each(function(){
                        $(this).removeAttr("checked");
                    });
                    $("select",$("#add-user-modal")).each(function(){
                        $("option:selected",$(this)).removeAttr("selected");
                    });
                    $(".modal-alert","#add-user-modal").removeClass("alert-warning").addClass("hide").text("");
                    $("#add-user-modal").modal("hide");
                    if(data.status == true){
                        showAlerts('success',data.message);
                        reloadTable();
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

        table.on('click', '.edit', function() {
            var that = $(this);
            $("input[type='text']",$("#add-user-modal")).each(function(){
                $(this).val('');
            });
            $("input[type='password']",$("#add-user-modal")).each(function(){
                $(this).val('');
            });
            $("input[type='checkbox']",$("#add-user-modal")).each(function(){
                $(this).removeAttr("checked");
            });
            $("select",$("#add-user-modal")).each(function(){
                $("option:selected",$(this)).removeAttr("selected");
            });
            $(".modal-alert","#add-user-modal").removeClass("alert-danger").addClass("hide").text("");
            $("#edit-user-modal").modal("show");
            return false;
        });

        // Delete a record
        table.on('click', '.delete', function(e) {
            var uid = $(this).attr('uid');
            $.ajax({
                url: "<?php echo my_url().'/user/profile/delete';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    uid:uid
                },
                success: function(status) {
                    console.log(status);
                    if(status == true){
                        showAlerts('success','Data telah didelete');
                        reloadTable();
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