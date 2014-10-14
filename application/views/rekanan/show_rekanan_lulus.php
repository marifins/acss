<?php $base = base_url(); ?>
<style>
    #title{
        float:right;
        color:#25b14a;
        font-size: 17px;
        margin: 0 0 10px 0;
    }
</style>
<div class="well">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#lulus" data-toggle="tab">Rekanan Lulus</a></li>
        <li><a href="#tidak_lulus" data-toggle="tab">Rekanan Tidak Lulus</a></li>
        <div id="title">TAHUN <b><?php echo $data2->tahun; ?></b> &nbsp; TAHAP <b><?php echo $data2->tahap_drt; ?></b></div>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="lulus">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sortable">No</th><th class="sortable">Nama Perusahaan</th><th>No. SKEP</th><th>TMT</th><th class="sortable">Masa Berlaku s/d</th><th class="sortable">Keterangan</th>
                    </tr>
                </thead><!--END OF table thead-->
                <tbody>            
                    <?php $a = 0; ?>
                    <?php foreach ($data as $d): ?>
                    <?php $a++; ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><a href="<?php echo $base; ?>rekanan/details/<?php echo $d->id_rekanan; ?>"><?php echo $d->nama_rekanan; ?></a></td>
                            <td><?php echo $d->no_skep; ?></td>
                            <td><?php echo $this->fungsi->set_indo($d->tmt); ?></td>
                            <td><?php echo $this->fungsi->set_indo($d->akhir_masa_berlaku); ?></td>
                            <td><?php echo $d->keterangan; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody><!--END OF table tbody-->
            </table><!--END OF table.data-->	
        </div>
        <div class="tab-pane fade" id="tidak_lulus">
            <?php if(count($data3) > 0):?>
            <table class="table">
                <thead>
                    <tr>
                        <th class="sortable">No</th><th class="sortable">Nama Perusahaan</th><th>Alamat</th><th>Nama Pimpinan</th><th class="sortable">Bidang Usaha</th><th class="sortable">Gol.</th>
                    </tr>
                </thead><!--END OF table thead-->
                <tbody>            
                    <?php $a = 0; ?>
                    <?php foreach ($data3 as $d): ?>
                    <?php $a++; ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><a href="<?php echo $base; ?>rekanan/details/<?php echo $d->id_rekanan; ?>"><?php echo $d->nama_rekanan; ?></a></td>
                            <td><?php echo $d->alamat_rekanan; ?></td>
                            <td><?php echo $d->nama_pimpinan; ?><br /><p style="padding-top: 5px;"><?php echo $d->jabatan_pimpinan; ?></p></td>
                            <?php
                            $rows = $this->drt_model->get_bidang($d->id_rekanan);
                            ?>
                            <td>
                                <?php $i = 0; ?>
                                <?php foreach ($rows as $r): ?>
                                    <?php $i++; ?>
                                    <?php echo $i . ". " . $r->nama_bidang; ?><br />
                                <?php endforeach; ?>
                            </td>
                            <td><?php echo $d->golongan; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody><!--END OF table tbody-->
            </table><!--END OF table.data-->
            <?php else:?>
            <p style="color:red;">Data tidak tersedia.</p>
            <?php endif;?>
        </div>
    </div>
</div>
