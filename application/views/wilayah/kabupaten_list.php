<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/editor.dataTables.min.css" rel="stylesheet">

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
            actionbutton += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">';
            actionbutton += '<span id="filter-propinsi-label">PILIH PROPINSI</span><span class="caret"></span></button>';
            actionbutton += '<ul class="dropdown-menu" role="menu" id="filter-propinsi">';
            <?php if(!empty($propinsi)){ foreach($propinsi as $row) { ?>
            actionbutton += '<li><a href="#" class="select-propinsi" id="<?php echo $row->ID_PROP;?>" label="<?php echo $row->NAMA_PROPINSI;?>"><?php echo $row->NAMA_PROPINSI;?></a></li>';
            <?php }} ?>
            actionbutton += '</ul>';
            actionbutton += '</div>';
            actionbutton += '<button type="button" class="btn btn-sm btn-primary" style="margin-left:5px"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></button>';
            actionbutton += '';
            $(".dt-actionbutton").html(actionbutton);
        }

        var table = $('#datatables').DataTable({
            "responsive": true,
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": ['excel'],
            "ajax": "<?php echo base_url();?>/index.php/parameter/wilayah/ajax_kabupaten",
            "columnDefs":[
                {
                    "render": function ( data, type, row ) {
                       return '<a href="javascript:void(0)" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="javascript:void(0)" class="btn btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    },
                    className: "dt-right",
                    "targets": 4
                }
            ]
        });
        initBar();
        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });

        $("#filter-propinsi").on('click',".select-propinsi",function () {
                $.ajax({
                    url: "<?php echo base_url();?>/index.php/parameter/wilayah/ajax_kabupaten",
                    type: 'POST',
                    dataType:'json',
                    data: {
                        propinsi : $(this).attr('id')
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

            $("#filter-propinsi-label").text("Propinsi : "+$(this).attr("label"));
            var tgt = $("#filter-propinsi-label").parent(".btn");
            $(tgt).removeClass("btn-primary").addClass("btn-warning");
        });

        $('.card .material-datatables label').addClass('form-group');

    });
</script>