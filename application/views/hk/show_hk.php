<?php $base = base_url(); ?>
<div class="well">
    <?php if ($rows > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Tahun</th>
                    <th>Bulan</th>
                    <th>Jlh HK</th>
                    <th style="width: 26px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($query as $q): ?>
                    <tr>           
                        <td><?php echo $q->tahun; ?></td>
                        <td><?php echo $this->fungsi->bulan($q->bulan); ?></td>
                        <td><?php echo $q->jlh_hari; ?></td>

                        <td>
                            <a href="<?php echo $base; ?>hk/delete/<?php echo $q->id; ?>" url="<?php echo $base; ?>produksi/edit/<?php echo $q->id; ?>" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color:red;">Error. Data belum tersedia!</p>
    <?php endif; ?>
</div>