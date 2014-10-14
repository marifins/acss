<script type="text/javascript">
    $(function() {
        $("#radio").buttonset();
        $("#rad").buttonset();
        
        $('form#tab2 :input').prop("disabled", true);
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
            <a href="<?php echo $base; ?>rekanan/edit/<?php echo $query->id_rekanan;?>" data-toggle="modal" class="btn">Edit Data</a>
            <a href="<?php echo $base; ?>rekanan/" data-toggle="modal" class="btn">Back</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#dasar" data-toggle="tab">Informasi Dasar</a></li>
                <li><a href="#dokumen" data-toggle="tab">Kelengkapan Dokumen</a></li>
                <li><a href="#bidang" data-toggle="tab">Bidang Usaha</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="dasar">
                    <form id="tab">
                        <div style="float:left;">
                            <label><b>Nama Perusahaan</b><span>:</span></label><label><?php echo $query->nama_rekanan; ?></label><br />
                            <label><b>Pimpinan</b><span>:</span></label><label><?php echo $query->nama_pimpinan; ?></label><br />
                            <label><b>Alamat</b><span>:</span></label><label><?php echo $query->alamat_rekanan; ?></label><br />              
                        </div>
                        <div style="float:left; margin: 0 0 0 35px;">
                            <label><b>No. Telp</b><span>:</span></label><label><?php echo $query->no_telp; ?></label>
                            <label><b>Jabatan</b><span>:</span></label><label><?php echo $query->jabatan_pimpinan; ?></label><br />
                            <label><b>Golongan</b><span>:</span></label><label><?php echo $query->golongan; ?></label><br />
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
                <?php
                $d = $this->drt_model->get_dokumen($query->id_rekanan);
                ?>
                <div class="tab-pane fade" id="dokumen">
                    <form id="tab2">
                        <div style="float:left;">
                            <label>SRP/SBU<span>:</span></label><input type="text" value="<?php echo $d->n_srp_sbu; ?>" />
                            <input class="date" type="text" value="<?php echo $this->fungsi->set_indo($d->srp_sbu); ?>" />

                            <label>Akta Notaris<span>:</span></label><input type="text" value="<?php echo $d->n_akta_notaris; ?>" />

                            <label>TDP<span>:</span></label><input type="text" value="<?php echo $d->n_tdp; ?>" />
                            <input class="date" type="text" value="<?php echo $this->fungsi->set_indo($d->tdp); ?>" />

                            <label>SKITU<span>:</span></label><input type="text" value="<?php echo $d->n_skitu; ?>" />
                            <input class="date" type="text" value="<?php echo $this->fungsi->set_indo($d->skitu); ?>" />
                        </div>
                        <div style="float:left; margin: 0 0 0 35px;">
                            <label>SIUP<span>:</span></label><input type="text" value="<?php echo $d->n_siup; ?>" />
                            <input class="date" type="text" value="<?php echo $this->fungsi->set_indo($d->siup); ?>" />
                            <?php if ($d->iujk != '0000-00-00'): ?>
                                <label>IUJK<span>:</span></label><input type="text" value="<?php echo $d->n_iujk; ?>" />
                                <input class="date" type="text" value="<?php echo $this->fungsi->set_indo($d->iujk); ?>" />
                            <?php endif; ?>
                                
                            <label>NPWP<span>:</span></label><input type="text" value="<?php echo $d->n_npwp; ?>" />

                            <label>KTA Asosiasi<span>:</span></label><input type="text" value="<?php echo $d->n_kta_asosiasi; ?>" />
                            <input class="date" type="text" value="<?php echo $this->fungsi->set_indo($d->kta_asosiasi); ?>" />

                            <label>Struktur Org.<span>:</span></label>
                            <div id="radio">
                               <?php echo ($d->struktur_org == 0) ? "TIDAK LENGKAP" : "LENGKAP"; ?>
                            </div>
                        </div>
                    </form>
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
                                <?php $query2 = $this->drt_model->get_kategori_from_bidang(1);?>
                                    <?php foreach ($query2 as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" disabled="disabled" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            $data2 = $this->drt_model->get_sub_from_rekanan($query->id_rekanan);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" id="check1" value="<?php echo $d->id_sub; ?>" <?php echo find($data2, $d->id_sub); ?> disabled="disabled" />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                            <div class="tab-pane fade" id="konstruksi">
                                <?php $query2 = $this->drt_model->get_kategori_from_bidang(2);?>
                                    <?php foreach ($query2 as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" disabled="disabled" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            $data2 = $this->drt_model->get_sub_from_rekanan($query->id_rekanan);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" id="check1" value="<?php echo $d->id_sub; ?>" <?php echo find($data2, $d->id_sub); ?> disabled="disabled" />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                            <div class="tab-pane fade" id="asuransi">
                                <?php $query2 = $this->drt_model->get_kategori_from_bidang(3);?>
                                    <?php foreach ($query2 as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" disabled="disabled" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            $data2 = $this->drt_model->get_sub_from_rekanan($query->id_rekanan);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" id="check1" value="<?php echo $d->id_sub; ?>" <?php echo find($data2, $d->id_sub); ?> disabled="disabled" />&nbsp;<?php echo $d->nama_sub; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <br />
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                            <div class="tab-pane fade" id="konsultansi">
                                <?php $query2 = $this->drt_model->get_kategori_from_bidang(4);?>
                                    <?php foreach ($query2 as $q): ?>
                                        <div id="group"><input type="checkbox" id="group" disabled="disabled" />&nbsp;<?php echo $q->nama_kategori; ?></div>
                                        <div id="format">
                                            <?php
                                            $data = $this->drt_model->get_sub($q->id_kategori);
                                            $data2 = $this->drt_model->get_sub_from_rekanan($query->id_rekanan);
                                            foreach ($data as $d):
                                                ?>
                                                <div id="sub_bidang">
                                                    <input type="checkbox" id="check1" value="<?php echo $d->id_sub; ?>" <?php echo find($data2, $d->id_sub); ?> disabled="disabled" />&nbsp;<?php echo $d->nama_sub; ?>
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

        </div>
<?php
function find($array, $val){
    foreach($array as $a) {
        if($a->id_sub_bidang == $val){
            echo "checked='checked'";
        }
    }
}
?>