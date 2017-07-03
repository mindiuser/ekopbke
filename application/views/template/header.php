<!-- Bootstrap core CSS     -->
<link href="<?php echo base_url();?>public/assets/css/bootstrap.min.css" rel="stylesheet" />
<!--  Material Dashboard CSS    -->
<link href="<?php echo base_url();?>public/assets/css/material-dashboard.css" rel="stylesheet" />
<!--  CSS for Demo Purpose, don't include it in your project     -->
<link href="<?php echo base_url();?>public/assets/css/demo.css" rel="stylesheet" />
<!--     Fonts and icons     -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
<!--   Core JS Files   -->
<script src="<?php echo base_url();?>public/assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/assets/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function showAlerts(type,message){
        $('#main-alert').removeClass('hide');
        if(type == 'success'){
            var xmessage = '<button type="button" class="close" data-dismiss="alert">x</button><strong>Sukses!</strong> '+message;
            $('.alert',$('#main-alert')).addClass('alert-success').removeClass('alert-danger').html(xmessage);
        }else if(type == 'error'){
            var xmessage = '<button type="button" class="close" data-dismiss="alert">x</button><strong>Gagal!</strong> '+message;
            $('.alert',$('#main-alert')).addClass('alert-danger').removeClass('alert-success').html(xmessage);
        }else{
            var xmessage = '<button type="button" class="close" data-dismiss="alert">x</button><strong>Info!</strong> '+message;
            $('.alert',$('#main-alert')).addClass('alert-info').removeClass('alert-danger').html(xmessage);
        }
        $('.alert',"#main-alert").fadeTo(6000, 500).slideUp(500, function(){
            $('.alert',"#main-alert").slideUp(6000);
        });
    }
    function clearAlerts(){
        $('#main-alert').addClass('hide');
        $('.alert',$('#main-alert')).removeClass('alert-info').removeClass('alert-danger').addClass('alert-success').html('');
    }
    function showErrorModal(target,message){
        $('.modal-alert',$(target)).removeClass('hide');
        if(typeof message == 'object'){
            message = (message.message)?message.message:' Data yang anda masukkan invalid';
        }
        var xmessage = '<button type="button" class="close" data-dismiss="alert">x</button><strong> Gagal!</strong> '+message;
        $('.modal-alert',$(target)).addClass('alert-danger').removeClass('alert-success').html(xmessage);
        $('.modal-alert',$(target)).fadeTo(6000, 500).slideUp(500, function(){
            $('.alert',"#main-alert").slideUp(6000);
        });
    }
    function clearErrorModal(target,message){
        $('.modal-alert',$(target)).addClass('hide');
        $('.modal-alert',$(target)).removeClass('alert-info').removeClass('alert-danger').addClass('alert-success').html('');
    }
</script>