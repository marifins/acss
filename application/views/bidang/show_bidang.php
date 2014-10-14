<style>
    #group { font-weight: bold; }
    #sub_bidang { margin-left: 1em; }
</style>
<?php $base = base_url(); ?>
    <div class="well">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#leveransir" data-toggle="tab">Leveransir</a></li>
            <li><a href="#konstruksi" data-toggle="tab">Konstruksi</a></li>
            <li><a href="#asuransi" data-toggle="tab">Asuransi</a></li>
            <li><a href="#konsultansi" data-toggle="tab">Konsultansi</a></li>
        </ul>

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane active in" id="leveransir">
                <?php $query = $this->drt_model->get_kategori_from_bidang(1); ?>
                <?php foreach ($query as $q): ?>
                    <div id="group"><?php echo $q->nama_kategori; ?></div>
                    <div id="format">
                        <?php
                        $data = $this->drt_model->get_sub($q->id_kategori);
                        foreach ($data as $d):
                            ?>
                            <div id="sub_bidang">
                                <?php echo $d->nama_sub; ?>
                            </div>
                        <?php endforeach; ?>
                        <br />
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="tab-pane fade" id="konstruksi">
                <?php $query = $this->drt_model->get_kategori_from_bidang(2); ?>
                <?php foreach ($query as $q): ?>
                    <div id="group"><?php echo $q->nama_kategori; ?></div>
                    <div id="format">
                        <?php
                        $data = $this->drt_model->get_sub($q->id_kategori);
                        foreach ($data as $d):
                            ?>
                            <div id="sub_bidang">
                                <?php echo $d->nama_sub; ?>
                            </div>
                        <?php endforeach; ?>
                        <br />
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="tab-pane fade" id="asuransi">
                <?php $query = $this->drt_model->get_kategori_from_bidang(3); ?>
                <?php foreach ($query as $q): ?>
                    <div id="group"><?php echo $q->nama_kategori; ?></div>
                    <div id="format">
                        <?php
                        $data = $this->drt_model->get_sub($q->id_kategori);
                        foreach ($data as $d):
                            ?>
                            <div id="sub_bidang">
                               <?php echo $d->nama_sub; ?>
                            </div>
                        <?php endforeach; ?>
                        <br />
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="tab-pane fade" id="konsultansi">
                <?php $query = $this->drt_model->get_kategori_from_bidang(4); ?>
                <?php foreach ($query as $q): ?>
                    <div id="group"><?php echo $q->nama_kategori; ?></div>
                    <div id="format">
                        <?php
                        $data = $this->drt_model->get_sub($q->id_kategori);
                        foreach ($data as $d):
                            ?>
                            <div id="sub_bidang">
                                <?php echo $d->nama_sub; ?>
                            </div>
                        <?php endforeach; ?>
                        <br />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>



