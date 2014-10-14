<script type="text/javascript">
    $(function() {
        $( "#save_hk" ).click(function(){
            var tahun = $( ".tahun" ).val();
            var bulan = $( ".bulan" ).val();  
            var hk = $( "#hk" ).val();  
                     
            if(tahun == "" || bulan == "" || hk == ""){
                alert("Error. Lengkapi seluruh form!");
            }else{
                $.ajax({
                    url: site+'hk/check_rows/'+tahun+'/'+bulan,
                    success: function(response){
                        if(response > 0) alert('Error. Data sudah tersedia!');
                        else $( "form.save_hk" ).submit();
                    }
                });      
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
</style>
<?php $base = base_url(); ?>
<ul class="breadcrumb">
    <li><a href="<?php echo $base; ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo $base; ?>hk">HK</a> <span class="divider">/</span></li>
    <li class="active">Edit HK</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">

        <div class="btn-toolbar">
            <?php if (isset($rows)): ?>
                <button id="edit_hk" class="btn btn-primary"><i class="icon-save"></i> Save Change</button>
            <?php else: ?>
                <button id="save_hk" class="btn btn-primary"><i class="icon-save"></i> Save</button>
            <?php endif; ?>
            <a href="<?php echo $base; ?>hk" data-toggle="modal" class="btn">Back</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                    <form class="save_hk" id="tab" method="post" action="<?php echo $base; ?>hk/insert">
                        <label>Tahun</label>
                        <select name="tahun" class="tahun">                            
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                        </select>
                        <label>Bulan</label>
                        <select name="bulan" class="bulan">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <label>Jlh HK</label>
                        <input type="text" value="" id="hk" name="jlh_hari" maxlength="2">
                    </form>
                </div>
            </div>

        </div>
