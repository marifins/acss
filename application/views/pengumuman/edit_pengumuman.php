<script type="text/javascript">
    $(function() {
        $( "#id" ).css('display','none');
        
        $( "#update_notice" ).click(function(){
            var judul = $( "#judul" ).val();
            var isi = $( "#isi" ).val();  
            var tanggal = $( "#tanggal" ).val();  
            var pejabat = $( "#pejabat" ).val();  
            var jabatan = $( "#jabatan" ).val();  
                     
            if(judul == "" || isi == "" || tanggal == "" || pejabat == "" || jabatan == ""){
                alert("Error. Lengkapi seluruh form!");
            }else{
                $( "form.update_notice" ).submit();     
            }
        });
    });
</script>
<style>
    select.tahun, select.bulan, select.tahun, input#hk{
        font-size: 17px;
        font-weight:bold;
    }

    select.tahun{
        width: 100px;
    }

    select.bulan{
        width: 150px;
    }

    input#hk{
        width: 50px;
    }
    textarea{
        width:95%;
    }
</style>
<?php $base = base_url(); ?>
<ul class="breadcrumb">
    <li><a href="<?php echo $base; ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo $base; ?>pengumuman/view">Pengumuman</a> <span class="divider">/</span></li>
    <li class="active">Update Pengumuman</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">

        <div class="btn-toolbar">
            <button id="update_notice" class="btn btn-primary"><i class="icon-save"></i> Save Change</button>
            <a href="<?php echo $base; ?>pengumuman/view" data-toggle="modal" class="btn">Back</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                    <form class="update_notice" id="tab" method="post" action="<?php echo $base; ?>pengumuman/update">
                        <input type="text" id="id" name="id" value="<?php echo $query->id; ?>" maxlength="2">
                        <label>Judul</label>
                        <input type="text" id="judul" name="judul" value="<?php echo $query->judul; ?>" maxlength="25">
                        <label>Isi Pengumuman</label>
                        <textarea id="isi" name="isi" maxlength="470"><?php echo $query->isi; ?></textarea>
                        <label>Tempat, Tanggal Dikeluarkan</label>
                        <input type="text" id="tanggal" name="tanggal" value="<?php echo $query->tanggal; ?>" maxlength="25">
                        <label>Nama Pejabat</label>
                        <input type="text" id="pejabat" name="pejabat" value="<?php echo $query->pejabat; ?>" maxlength="25">
                        <label>Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" value="<?php echo $query->jabatan; ?>" maxlength="25">
                    </form>
                </div>
            </div>

        </div>
