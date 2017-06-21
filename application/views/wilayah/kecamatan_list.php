<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/buttons.dataTables.min.css" rel="stylesheet">


<div class="row" id="kecamatan">
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-icon" data-background-color="purple">
    <i class="material-icons">assignment</i>
</div>
<div class="card-content">
<h4 class="card-title">DAFTAR WILAYAH KECAMATAN</h4>
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
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/vfs_fonts.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var initBar = function(){
            var actionbutton = '';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-propinsi-label">PILIH PROPINSI</span> <span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-propinsi">';
            <?php if(!empty($propinsi)){ foreach($propinsi as $row) { ?>
            actionbutton += '<li><a href="#" class="select-propinsi" id="<?php echo $row->ID_PROP;?>" label="<?php echo $row->NAMA_PROPINSI;?>"><?php echo $row->NAMA_PROPINSI;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<div class="btn-group">';
            actionbutton += '<button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-kabupaten-label">PILIH KABUPATEN</span><span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-kabupaten">';
            <?php if(!empty($kabupaten)){ foreach($kabupaten as $row) { ?>
            actionbutton += '<li><a href="#" class="select-kabupaten" id="<?php echo $row->ID_KAB;?>"  label="<?php echo $row->NAMA_KABUPATEN;?>"><?php echo $row->NAMA_KABUPATEN;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<button type="button" class="btn btn-sm btn-success" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": ['excel'],
            "ajax": "<?php echo base_url();?>/index.php/parameter/wilayah/ajax_kecamatan",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                        return '<a href="javascript:void(0)" class="btn btn-xs btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="btn btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    "targets": 3
                }
            ]
        });

        initBar();

        $('.select-propinsi').on("click",function(){
            $.ajax({
                url: "<?php echo base_url();?>/index.php/parameter/wilayah/filter_kabupaten",
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
            $(tgt).removeClass("btn-success").addClass("btn-warning");
        });

        $('.select-kabupaten').each(function(){
            console.log($(this).attr("id"));
            var that = $(this);

        });

        $("#filter-kabupaten").on('click',".select-kabupaten",function () {
            $.ajax({
                url: "<?php echo base_url();?>/index.php/parameter/wilayah/ajax_kecamatan",
                type: 'POST',
                dataType:'json',
                data: {
                    kabupaten : $(this).attr('id')
                },
                success: function(newData) {
                    var table = $('#datatables').DataTable();
                    table.clear();
                    table.rows.add(newData.data).draw();
                },
                error: function(xhr, textStatus, ThrownException){
                    $('#main-alert').addClass('alert-danger').removeClass('alert-success hidden').text(textStatus);
                },
                completed: function(){
                }
            });

            $("#filter-kabupaten-label").text("Kabupaten : "+$(this).attr("label"));
            var tgt = $("#filter-kabupaten-label").parent(".btn");
            $(tgt).removeClass("btn-success").addClass("btn-warning");
        });

        $('.card .material-datatables label').addClass('form-group');

    });
</script>