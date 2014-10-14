<?php $base = base_url(); ?>
<div class="well">
    <?php if ($rows > 0): ?>
        <form class="form_perpanjangan" method="POST" action="<?php echo $base; ?>rekanan/to_wl">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sortable"></th><th class="sortable">Nama Perusahaan</th><th>Alamat</th><th>Nama Pimpinan</th><th class="sortable">Bidang Usaha</th><th class="sortable">Gol.</th>
                    </tr>
                </thead><!--END OF table thead-->
                <tbody>
                    <?php
                    $a = 0;
                    ?>
                    <?php foreach ($data as $d): ?>
                        <?php $a++; ?>
                        <tr>
                            <td><input type="checkbox" name="id_rekanan[]" value="<?php echo $d->id_rekanan; ?>"></td>
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
                                    <?php
                                    if (count($rows) > 1)
                                        echo $i . ". " . $r->nama_bidang;
                                    else
                                        echo $r->nama_bidang;
                                    ?>
                                    <br />
                                <?php endforeach; ?>
                            </td>
                            <td><?php echo $d->golongan; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody><!--END OF table tbody-->
            </table><!--END OF table.data-->	
        </form>
    <?php else: ?>
        <p style="color: red;">Data belum tersedia.</p>
    <?php endif; ?>
</div>
