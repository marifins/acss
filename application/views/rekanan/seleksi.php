<script type="text/javascript">
    $(function() {
        $( "#confirm_seleksi" ).hide();
        
        $( "#tahun" ).change(function(){
            var tahun = $( this ).val();
            var tahap = $( "#tahap" ).val();
            if(tahap > 0){
                $( "#no_skep" ).val("01.CS/SKEP/"+tahap+"/"+tahun);
            }
        });
        
        $( "#tahap" ).change(function(){
            var tahun = $( "#tahun" ).val()
            var tahap = $( this ).val();
            if(tahun == 0){
                alert("Silahkan pilih tahun!");
            }else{
                $( "#no_skep" ).val("01.5/P/SKEP/"+tahap+"/"+tahun);
            }
        });
        
        $( "#button_proses_seleksi" ).click(function(){
            var s = 1;
            
            if ($("#tahun").val() == '0') s = 0;
            if ($("#tahap").val() == '0') s = 0;
            if ($("#tmt").val() == '0') s = 0;
            if ($("#sd").val() == '0') s = 0;
            if ($("#no_skep").val() == '') s = 0;
            
            if(s == 0){
                alert("Error. Lengkapi seluruh form!");
            }else{
                $( "a#confirm_seleksi" ).click();
            }
        });
        $( "#app_seleksi" ).click(function(){
            $( "form.proses_seleksi" ).submit();
        });
    });
    
</script>
<style>
    #pilih_tanggal{
        margin: 0 0 0 5px;
    }

    #tahun, #tahap{
        width:90px;
    }

    #tmt, #sd{
        width:125px;
    }
</style>
<?php $base = base_url(); ?>
<ul class="breadcrumb">
    <li><a href="">Home</a> <span class="divider">/</span></li>
    <li class="active">Proses Seleksi</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if (isset($_GET['s'])): ?>
            <?php if ($_GET['s'] == 'success'): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>System:</strong> Success. Rekanan telah diupdate!
                </div>
            <?php elseif ($_GET['s'] == 'success_delete'): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>System:</strong> Success. Rekanan <?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?> telah dihapus!
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php $base = base_url(); ?>

        <div class="btn-toolbar">
            <?php if ($rows > 0): ?>
                <a href="#myModal" id="confirm_seleksi" class="btn btn-primary" data-toggle="modal"></a>
                <a href="#" id="button_proses_seleksi" class="btn btn-primary"><i class="icon-play-circle"></i> Proses Seleksi</a>
                <a href="<?php echo $base; ?>rekanan/waiting_list" data-toggle="modal" class="btn">Waiting List</a>

                <?php $rows = $this->drt_model->count_waiting_list(); ?>
                <div style="float:right;">
                    <label style="color:#3d9fcf; padding: 3px 0 0 0;">System: terdapat <b><?php echo $rows; ?></b> perusahaan pada Waiting List</label>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="well">
        <?php if ($rows > 0): ?>
            <form class="proses_seleksi" method="POST" action="<?php echo $base; ?>/rekanan/proses_seleksi">
                <label>Tahun</label>
                <select id="tahun" name="tahun">
                    <option value="0">- Tahun -</option>
                    <?php $arr_tahap = array('2014', '2013'); ?>
                    <?php for ($i = 0; $i < count($arr_tahap); $i++): ?>
                        <option value="<?php echo $arr_tahap[$i]; ?>"><?php echo $arr_tahap[$i]; ?></option>
                    <?php endfor; ?>
                </select>
                <label>Tahap</label>
                <select id="tahap" name="tahap">
                    <option value="0">- Tahap -</option>
                    <?php $arr_tahap = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'); ?>
                    <?php for ($i = 0; $i < count($arr_tahap); $i++): ?>
                        <option value="<?php echo $arr_tahap[$i]; ?>"><?php echo $arr_tahap[$i]; ?></option>
                    <?php endfor; ?>
                </select>

                <label>Terhitung Mulai Tanggal</label><input type="text" class="date" id="tmt" name="tmt" value="">
                <label>Masa Berlaku s.d. Tanggal</label><input type="text" class="date" id="sd" name="sd" value="">
                <label>No SKEP</label><input type="text" id="no_skep" name="no_skep" value="">
            </form>
        <?php else: ?>
            <p style="color:red;">Proses seleksi belum dapat dilakukan. Silahkan tambah data rekanan yang akan mengikuti proses seleksi.</p>
            <a href="<?php echo $base; ?>rekanan/add" data-toggle="modal" class="btn">Tambah Rekanan Baru</a>&nbsp;
            <a href="<?php echo $base; ?>rekanan/perpanjang" data-toggle="modal" class="btn">Perpanjang Rekanan Terdaftar</a>
        <?php endif; ?>
    </div>


    <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Konfirmasi Seleksi Rekanan</h3>
        </div>
        <div class="modal-body">
            <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Anda yakin akan melanjutkan proses seleksi?</p>
        </div>
        <div class="modal-footer">
            <button id="app_seleksi" class="btn btn-danger" data-dismiss="modal">Seleksi</button>          
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>          
        </div>
    </div>