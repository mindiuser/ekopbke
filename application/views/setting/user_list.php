<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/assets/js/plugin/datatable/css/editor.dataTables.min.css" rel="stylesheet">

<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-icon" data-background-color="purple">
    <i class="material-icons">assignment</i>
</div>
<div class="card-content">
<h4 class="card-title">USER PROFILE</h4>
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
<?php
if(!empty($data)) {
    foreach($data as $row){
    ?>
        <tr>
            <td><?php echo isset($row->UID)?$row->UID:'';?></td>
            <td><?php echo isset($row->NAMA)?$row->NAMA:'';?></td>
            <td><?php echo isset($row->LVL)?$row->LVL:'';?></td>
            <td><?php echo isset($row->BAGIAN)?$row->BAGIAN:'';?></td>
            <td><?php echo isset($row->JABATAN)?$row->JABATAN:'';?></td>
            <td><?php echo isset($row->ADMINISTRATOR)?$row->ADMINISTRATOR:'';?></td>
            <td><?php echo isset($row->SETTING)?$row->SETTING:'';?></td>
            <td><?php echo isset($row->MIF_REGISTRATSI)?$row->MIF_REGISTRASI:'';?></td>
            <td><?php echo isset($row->MIF)?$row->MIF:'';?></td>
            <td><?php echo isset($row->MIF_APPROVAL)?$row->MIF_APPROVAL:'';?></td>
            <td><?php echo isset($row->MONITORING)?$row->MONITORING:'';?></td>
            <td><?php echo isset($row->REGULASI)?$row->REGULASI:'';?></td>
            <td><?php echo isset($row->IDREG)?$row->IDREG:'';?></td>
            <td><?php echo isset($row->IDCAB)?$row->IDCAB:'';?></td>
            <td><?php echo isset($row->ST)?$row->ST:'';?></td>
            <td class="text-right">
                <button type="button" rel="tooltip" class="btn btn-xs btn-success btn-round">
                    <i class="material-icons">edit</i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-xs btn-danger btn-round">
                    <i class="material-icons">close</i>
                </button>
            </td>
        </tr>

<?php
    }
}
?>
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
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/dataTables.editor.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/plugin/datatable/js/vfs_fonts.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "language": {
                search: "_INPUT_",
                searchPlaceholder: "Search records"
            },
            "dom": "<'dt-actionbutton'><'dt-actionbulk'>flr<'dt-advance-search'>B<'dt-alert col-md-12 no-padding'>tip",
            "buttons": [ 'excel', 'pdf', 'print']

        });

        var actionbutton = '<a class="btn btn-sm btn-success" href="" id="add"><i class="fa fa-plus"></i><span style="padding-left:5px">Baru</span></a>';
        $(".dt-actionbutton").html(actionbutton);

        //var table = $('#datatables').DataTable();

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

        $('.card .material-datatables label').addClass('form-group');
    });
</script>