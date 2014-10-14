<script type="text/javascript">
    $(function() {
        $("#yes_iujk").hide();
        $("#no_iujk").show();
            
        $("#radio").buttonset();
        $("#rad").buttonset();
        $( "#check" ).button();
        
        $("#link_iujk").click(function () {
            $("#yes_iujk").show();
            $("#no_iujk").hide();
        });
        
        $("#link_iujk2").click(function () {
            $("#yes_iujk").hide();
            $("#no_iujk").show();
        });
        
        $("input[type='checkbox']#group").change(function () {
            $(this).parent().next().find("input[type='checkbox']").prop('checked', this.checked);
        });
        
        $( "#save_rekanan" ).click(function(){
            var s = 1;
            var arr_style = new Array('nama_perusahaan','nama_pimpinan','no_telp','jabatan','srp','n_akta_notaris','tdp','skitu','siup','n_npwp','kta_asosiasi');
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
                
            var area = $.trim($('#alamat_perusahaan').val());
            if (area.length == 0) {
                s = 0;
                text += "* Alamat Perusahaan\n\r";
            }
            if ($("select[name='golongan']").val() == '0') {
                s = 0;
                text += "* Golongan\n\r";
            }
            if (!$("input[name='struktur']:checked").val()) {
                s = 0;
                text += "* Struktur organisasi\n\r";
            }
            
            if(s == 0){
                alert("Lengkapi seluruh field bertanda (*) ! \n\r" +text);
            }else{
                if(!$('.form_rekanan input[type="checkbox"]#sub').is(':checked')){
                    alert("Error. Lengkapi Sub Bidang!");
                }else{
                    $( "form.form_rekanan" ).submit();
                }
                
            }
        });
    });
</script>
<style>

    #date, #date2, .date{
        width:90px;
    }

    table tr td label{
        text-align: center;
    }

    input[type='checkbox']{
        font-weight: bold;
    }

    #group { font-weight: bold; }

    #sub_bidang { margin-left: 1em; }

    .redborder{
        border:red;
    }

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
            <button id="save_rekanan" class="btn btn-primary"><i class="icon-save"></i> Save</button>
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
            <form class="form_rekanan" method="POST" action="<?php echo $base; ?>rekanan/insert">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active in" id="dasar">
                        <div style="float:left;">
                            <label>* Nama Perusahaan<span>:</span></label><input type="text" name="nama_perusahaan" value="" />
                            <label>* Pimpinan<span>:</span></label><input type="text" name="nama_pimpinan" value="" />
                            <label>* Alamat<span>:</span></label><textarea name="alamat_perusahaan" id="alamat_perusahaan"></textarea>
                        </div>
                        <div style="float:left; margin: 0 0 0 35px;">
                            <label> No. Telp<span>:</span></label><input type="text" name="no_telp" value="" />
                            <label>* Jabatan<span>:</span></label><input type="text" name="jabatan" value="" />
                            <label>* Golongan<span>:</span></label>
                            <?php $g = array('G1', 'G2', 'G3', 'G4', 'G5', 'G6', 'G7', 'K', 'M', 'B', 'NK'); ?>
                            <select name="golongan">
                                <option value="0">-- Pilih --</option>
                                <?php for ($i = 0; $i < count($g); $i++): ?>
                                    <option value="<?php echo $g[$i]; ?>"><?php echo $g[$i]; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="tab-pane fade" id="dokumen">
                        <div style="float:left;">
                            <label>* SRP/SBU <input style="margin: 0 0 3px 10px;" type="checkbox" name="c_srp"> Dalam Pengurusan?<span>:</span></label><input type="text" value="" readonly />
                            <input class="date" type="text" name="srp" value="" />

                            <label>* Akta Notaris <input style="margin: 0 0 3px 10px;" type="checkbox" value="" name="c_akta_notaris"> Dalam Pengurusan?<span>:</span></label><input type="text" name="n_akta_notaris" value="" />

                            <label>* TDP <input style="margin: 0 0 3px 10px;" type="checkbox" name="c_tdp"> Dalam Pengurusan?<span>:</span></label><input type="text" value="" readonly />
                            <input class="date" type="text" name="tdp" value="" />

                            <label>* SKITU <input style="margin: 0 0 3px 10px;" type="checkbox" name="c_skitu"> Dalam Pengurusan?<span>:</span></label><input type="text" value="" readonly />
                            <input class="date" type="text" name="skitu" value="" />

                        </div>
                        <div style="float:left; margin: 0 0 0 35px;">
                            <div id="no_iujk">
                                <label>*SIUP
                                    <span></span> <input style="margin: 0 0 3px 10px;" type="checkbox" name="c_siup"> Dalam Pengurusan?
                                    <span style="float:right; margin: 3px 0 0 0;">
                                        <a id="link_iujk" href="#">Show IUJK</a>
                                    </span>
                                </label>
                                <input type="text" value="" readonly/>
                                <input class="date" type="text" name="siup" value="" />
                            </div>
                            <div id="yes_iujk">
                                <label>*SIUP <input style="margin: 0 0 3px 10px;" type="checkbox" name="c_siup"> Dalam Pengurusan?
                                    <span></span>
                                    <span style="float:right; margin: 3px 0 0 0;">
                                        <a id="link_iujk2" href="#">Hide IUJK</a>
                                    </span>
                                </label>
                                <input type="text" value="" readonly/>
                                <input class="date" type="text" name="siup" value="" />

                                <label>
                                    *IUJK <input style="margin: 0 0 3px 10px;" type="checkbox" name="c_iujk"> Dalam Pengurusan?<span>:</span>
                                </label>
                                <input type="text" value="" readonly />
                                <input class="date" type="text" name="iujk" value="" />
                            </div>
                            
                            <label>* NPWP <input style="margin: 0 0 3px 10px;" type="checkbox" name="c_npwp"> Dalam Pengurusan?<span>:</span></label><input type="text" name="n_npwp" value="" />

                            <label>* KTA Asosiasi <input style="margin: 0 0 3px 10px;" type="checkbox" name="c_kta"> Dalam Pengurusan?<span>:</span></label><input type="text" value="" readonly />
                            <input class="date" type="text" name="kta_asosiasi" value="" />

                            <label>* Struktur Org.<span>:</span></label>
                            <input type="radio" id="struktur" name="struktur" value="0" />TIDAK LENGKAP &nbsp;&nbsp;&nbsp;
                            <input type="radio" id="struktur" name="struktur" value="1" />LENGKAP
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
                                    <?php $query = $this->drt_model->get_kategori_from_bidang(1); ?>
                                    <?php foreach ($query as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" name="sub[]" id="sub" value="<?php echo $d->id_sub; ?>" />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="tab-pane fade" id="konstruksi">
                                    <?php $query = $this->drt_model->get_kategori_from_bidang(2); ?>
                                    <?php foreach ($query as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" name="sub[]" id="sub" value="<?php echo $d->id_sub; ?>" />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="tab-pane fade" id="asuransi">
                                    <?php $query = $this->drt_model->get_kategori_from_bidang(3); ?>
                                    <?php foreach ($query as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" name="sub[]" id="sub" value="<?php echo $d->id_sub; ?>" />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="tab-pane fade" id="konsultansi">
                                    <?php $query = $this->drt_model->get_kategori_from_bidang(4); ?>
                                    <?php foreach ($query as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" name="sub[]" id="sub" value="<?php echo $d->id_sub; ?>" />&nbsp;<?php echo $d->nama_sub; ?>
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
