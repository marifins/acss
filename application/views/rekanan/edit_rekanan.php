<script type="text/javascript">
    $(function() {
        $("input[name='id_perusahaan']").hide();
        
        $("input[type='checkbox']#group").change(function () {
            $(this).parent().next().find("input[type='checkbox']").prop('checked', this.checked);
        });
        
        $( "#edit_rekanan" ).click(function(){
            var s = 1;
            var arr_style = new Array('enama_perusahaan','enama_pimpinan','eno_telp','ejabatan','esrp','eakta_notaris','etdp','eskitu','esiup','en_npwp','ekta_asosiasi');
            var arr_name = new Array('Nama Perusahaan','Nama Pimpinan','No. Telp','Jabatan','SRP','Akta Notaris','TDP','SKITU','SIUP','NPWP','KTA Asosiasi');
            var text = "";
            for(var i=0; i<arr_style.length; i++){
                var temp = $( "input[name="+arr_style[i]+"]" ).val();
                if( temp == ""){
                    s = 0;
                    //$( "input[name="+arr_style[i]+"]" ).css("border", "1px solid red");
                    text += "* " +arr_name[i] +"\n\r";
                }
            }
            
            var area = $.trim($('#ealamat_perusahaan').val());
            if (area.length == 0) {
                s = 0;
                text += "* Alamat Perusahaan\n\r";
            }
            if ($("select[name='egolongan']").val() == '0') {
                s = 0;
                text += "* Golongan\n\r";
            }
            if (!$("input[name='estruktur']:checked").val()) {
                s = 0;
                text += "* Struktur organisasi\n\r";
            }
            
            if(s == 0){
                alert("Lengkapi seluruh field bertanda (*) ! \n\r" +text);
            }else{
                if(!$('.form_edit_rekanan input[type="checkbox"]').is(':checked')){
                    alert("Error. Lengkapi Sub Bidang!");
                }else{
                    $( "form.form_edit_rekanan" ).submit();
                }
            }
        });
    });
</script>
<style>
    #tbs0, #tbs1, #tbs2, #tbs3, #tbs4, #tbs5{
        width:50px;
    }

    #date, #date2, .date{
        width:90px;
    }

    table tr td label{
        text-align: center;
    }

    #group { font-weight: bold; }

    #sub_bidang { margin-left: 1em; }

</style>
<?php $base = base_url(); ?>

<ul class="breadcrumb">
    <li><a href="<?php echo $base; ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo $base; ?>rekanan">Daftar Rekanan</a> <span class="divider">/</span></li>
    <li class="active">Edit Rekanan</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">

        <div class="btn-toolbar">
            <button id="edit_rekanan" class="btn btn-primary"><i class="icon-save"></i> Save</button>
            <a href="<?php echo $base; ?>rekanan" data-toggle="modal" class="btn">Back</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#dasar" data-toggle="tab">Informasi Dasar</a></li>
                <li><a href="#dokumen" data-toggle="tab">Kelengkapan Dokumen</a></li>
                <li><a href="#bidang" data-toggle="tab">Bidang Usaha</a></li>
            </ul>
            <form class="form_edit_rekanan" method="POST" action="<?php echo $base; ?>rekanan/update">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active in" id="dasar">
                        <div style="float:left;">
                            <input type="text" name="id_perusahaan" value="<?php echo $query->id_rekanan; ?>"  />
                            <label>* Nama Perusahaan<span>:</span></label><input type="text" name="enama_perusahaan" value="<?php echo $query->nama_rekanan; ?>" readonly />
                            <label>* Pimpinan<span>:</span></label><input type="text" name="enama_pimpinan" value="<?php echo $query->nama_pimpinan; ?>" />
                            <label>* Alamat<span>:</span></label><textarea name="ealamat_perusahaan" id="ealamat_perusahaan"><?php echo $query->alamat_rekanan; ?></textarea>
                        </div>
                       
                        <?php $g = array('G1', 'G2', 'G3', 'G4', 'G5', 'G6', 'G7', 'K', 'NK'); ?>
                        <div style="float:left; margin: 0 0 0 35px;">
                             <label>* No. Telp<span>:</span></label><input type="text" name="eno_telp" value="<?php echo $query->no_telp; ?>" />
                            <label>* Jabatan<span>:</span></label><input type="text" name="ejabatan" value="<?php echo $query->jabatan_pimpinan; ?>" />
                            <label>* Golongan<span>:</span></label>
                            <select name="egolongan">
                                <option value="0">-- Pilih --</option>
                                <?php for ($i = 0; $i < 9; $i++): ?>
                                    <?php if ($g[$i] == $query->golongan): ?>
                                        <option value="<?php echo $g[$i]; ?>" selected><?php echo $g[$i]; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $g[$i]; ?>"><?php echo $g[$i]; ?></option>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                    $d = $this->drt_model->get_dokumen($query->id_rekanan);
                    ?>
                    <div class="tab-pane fade" id="dokumen">
                        <div style="float:left;">
                            <label>* SRP/SBU<span>:</span></label><input type="text" value="<?php echo $d->n_srp_sbu; ?>" readonly />
                            <input class="date" type="text" name="esrp" value="<?php echo $this->fungsi->set_indo($d->srp_sbu); ?>" />

                            <label>* Akta Notaris<span>:</span></label><input type="text" name="en_akta_notaris" value="<?php echo $d->n_akta_notaris; ?>" />

                            <label>* TDP<span>:</span></label><input type="text" value="<?php echo $d->n_tdp; ?>" readonly />
                            <input class="date" type="text" name="etdp" value="<?php echo $this->fungsi->set_indo($d->tdp); ?>" />

                            <label>* SKITU<span>:</span></label><input type="text" value="<?php echo $d->n_skitu; ?>" readonly />
                            <input class="date" type="text" name="eskitu" value="<?php echo $this->fungsi->set_indo($d->skitu); ?>" />
                        </div>
                        <div style="float:left; margin: 0 0 0 35px;">
                            <label>* SIUP<span>:</span></label><input type="text" value="<?php echo $d->n_siup; ?>" readonly />
                            <input class="date" type="text" name="esiup" value="<?php echo $this->fungsi->set_indo($d->siup); ?>" />
                            <?php if ($d->iujk != '0000-00-00'): ?>
                                <label>* IUJK<span>:</span></label><input type="text" value="<?php echo $d->n_iujk; ?>" readonly />
                                <input class="date" type="text" name="esiup" value="<?php echo $this->fungsi->set_indo($d->iujk); ?>" />
                            <?php endif; ?>
                                
                            <label>* NPWP<span>:</span></label><input type="text" name="en_npwp" value="<?php echo $d->n_npwp; ?>" />

                            <label>* KTA Asosiasi<span>:</span></label><input type="text" value="<?php echo $d->n_kta_asosiasi; ?>" readonly />
                            <input class="date" type="text" name="ekta_asosiasi" value="<?php echo $this->fungsi->set_indo($d->kta_asosiasi); ?>" />

                            <label>* Struktur Org.<span>:</span></label>
                            <div id="radio">
                                <input type="radio" id="estruktur" name="estruktur" value="0" <?php echo ($d->struktur_org == 0) ? "checked=checked" : ""; ?>/>TIDAK LENGKAP &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="estruktur" name="estruktur" value="1" <?php echo ($d->struktur_org > 0) ? "checked=checked" : ""; ?> />LENGKAP

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bidang">
                        <div class="well">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#leveransir" data-toggle="tab">Leveransir</a></li>
                                <li><a href="#konstruksi" data-toggle="tab">Konstruksi</a></li>
                                <li><a href="#asuransi" data-toggle="tab">Asuransi</a></li>
                                <li><a href="#konsultansi" data-toggle="tab">Konsultansi</a></li>
                            </ul>
                            <div id="myTabContent2" class="tab-content">
                                <div class="tab-pane active in" id="leveransir">
                                    <?php $query2 = $this->drt_model->get_kategori_from_bidang(1); ?>
                                    <?php foreach ($query2 as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            $data2 = $this->drt_model->get_sub_from_rekanan($query->id_rekanan);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" name="esub[]" id="sub" value="<?php echo $d->id_sub; ?>" <?php echo find($data2, $d->id_sub); ?> />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="tab-pane fade" id="konstruksi">
                                    <?php $query2 = $this->drt_model->get_kategori_from_bidang(2); ?>
                                    <?php foreach ($query2 as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            $data2 = $this->drt_model->get_sub_from_rekanan($query->id_rekanan);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" name="esub[]" id="sub" value="<?php echo $d->id_sub; ?>" <?php echo find($data2, $d->id_sub); ?> />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="tab-pane fade" id="asuransi">
                                    <?php $query2 = $this->drt_model->get_kategori_from_bidang(3); ?>
                                    <?php foreach ($query2 as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            $data2 = $this->drt_model->get_sub_from_rekanan($query->id_rekanan);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" name="esub[]" id="sub" value="<?php echo $d->id_sub; ?>" <?php echo find($data2, $d->id_sub); ?> />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="tab-pane fade" id="konsultansi">
                                    <?php $query2 = $this->drt_model->get_kategori_from_bidang(4); ?>
                                    <?php foreach ($query2 as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            $data2 = $this->drt_model->get_sub_from_rekanan($query->id_rekanan);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" name="esub[]" id="sub" value="<?php echo $d->id_sub; ?>" <?php echo find($data2, $d->id_sub); ?> />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>                  
                    </div>
                </div>
            </form>
        </div>
        <?php

        function find($array, $val) {
            foreach ($array as $a) {
                if ($a->id_sub_bidang == $val) {
                    echo "checked='checked'";
                }
            }
        }
        ?>