<div class="row" id="password">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h3 class="card-title"><i class="fa fa-lock" aria-hidden="true"></i> UBAH PASSWORD</h3>
                <br/>
                <br/>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        PASSWORD SEKARANG
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input type="password" name="lama" class="form-control" maxlength="5" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        PASSWORD BARU
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input type="password" name="baru" class="form-control" maxlength="50" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-bold">
                        ULANGI PASSWORD BARU
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input type="password" name="ulangi" class="form-control" maxlength="50" required>
                    </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                <button type="button" id="ubah-submit" class="btn btn-primary btn-sm">Ubah</button>
                <button type="button" id="ubah-cancel" class="btn btn-danger btn-sm"">Batal</button>
                        </div>
                </div>
                <div class="row small-list-margin">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div id="message-success" style="margin-top: 30px">
                        </div>
                        </div>
                    </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#password").on("click","#ubah-submit",function(){
            var lama = $("input[name='lama']",$("#password")).val();
            var baru = $("input[name='baru']",$("#password")).val();
            var ulangi = $("input[name='ulangi']",$("#password")).val();
            if(lama == ''){
                showAlerts('error',"Masukkan password sekarang");
                return false;
            }
            if(baru == ''){
                showAlerts('error',"Masukkan password baru");
                return false;
            }
            if(ulangi == ''){
                showAlerts('error',"Ulangi masukkan password baru");
                return false;
            }
            if(ulangi != baru){
                showAlerts('error',"PASSWORD BARU dan ULANGI PASSWORD PASSWORD BARU tidak sama");
                return false;
            }
            $.ajax({
                url: "<?php echo my_url().'user/profile/save_new_password';?>",
                type: 'POST',
                dataType:'json',
                data: {
                    lama:lama,baru:baru,ulangi:ulangi
                },
                success: function(data) {
                    if(data.status == true){
                        clearAlerts();
                        var actionbutton = '<div class="alert alert-info">Ubah password berhasil. Silahkan <a class="btn btn-xs btn-default" href="<?php echo site_url('logout');?>"><i class="fa fa-lock logout-icon"></i> Logout</a> lalu login kembali dengan password baru anda</div>';
                        $("#message-success",$("#password")).html(actionbutton);
                    }
                    else {
                        showAlerts('error',data.message);
                        $("#message-success",$("#password")).html('');
                    }
                },
                error: function(xhr, textStatus, ThrownException){
                    showAlerts('error',textStatus);
                }
            });

            return false;
        });
        return false;
    });
</script>
