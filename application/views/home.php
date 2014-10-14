<style>
    #desc{
        text-transform: uppercase;
    }
</style>
<?php
$base = base_url();
$img = $base . 'assets/images/';

function coloring($date) {
    $yesterday = date("Y-m-d", time() - (60 * 60 * 24));
    if ($date < $yesterday) {
        return "<p class=\"outofdate\">" . $date . "</p>";
    } else {
        return "<p class=\"detail\">" . $date . "</p>";
    }
}
?>
<ul class="breadcrumb">
    <li><a href="">Home</a> <span class="divider">/</span></li>
    <li class="active">Dashboard</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">
      
        <div id="search_result">
        <div class="row-fluid">

            <div class="block">
                <a href="#page-stats" class="block-heading" data-toggle="collapse">Latest Stats</a>
                <div id="page-stats" class="block-body collapse in">
                    <?php
                    $total_rekanan = $this->drt_model->count_rekanan();
                    $wl_rows = $this->drt_model->count_waiting_list();
                    $wl = $this->drt_model->waiting_list_10();
                    $dt = $this->drt_model->tahun_tahap();
                    ?>
                    <div class="stat-widget-container">
                        <div class="stat-widget">
                            <div class="stat-button">
                                <p class="title"><?php echo $total_rekanan; ?></p>
                                <p id="desc">Total Rekanan<br />Terdaftar</p>
                            </div>
                        </div>

                        <div class="stat-widget">
                            <div class="stat-button">
                                <p class="title"><?php echo $wl_rows; ?></p>
                                <p id="desc">Waiting List</p>
                            </div>
                        </div>

                        <div class="stat-widget">
                            <div class="stat-button">
                                <p class="title"><?php echo $dt->tahun; ?></p>
                                <p id="desc">Tahun Seleksi</p>
                            </div>
                        </div>

                        <div class="stat-widget">
                            <div class="stat-button">
                                <p class="title"><?php echo $dt->tahap_drt; ?></p>
                                <p id="desc">Tahap Seleksi</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="block span6">
                <a href="#widget1container" class="block-heading" data-toggle="collapse">System</a>
                <div id="widget1container" class="block-body collapse in">
                    <h2>DRT Apps?</h2>
                    <p>Aplikasi ini digunakan untuk mengelola data rekanan PTPN I (Persero).</p>
                    <ul>
                        <li>Menu Setting, digunakan untuk menambah data Kategori Bidang dan Sub Bidang.</li>
                        <li>Menu Daftar Rekanan,  untuk melihat seluruh data rekanan yang telah terdaftar dan menambah data rekanan baru.</li>
                        <li>Menu Waiting List, digunakan untuk melihat Waiting List rekanan yang belum masuk proses seleksi.</li>
                        <li>Menu Rekanan Terseleksi, untuk melihat data rekanan yang Lulus dan Tidak Lulus seleksi.</li>
                        <li>Proses Seleksi, digunakan melakukan proses seleksi.</li>
                    </ul>
                    <p>Untuk informasi lebih lanjut, silahkan hubungi Bagian Perencanaan & Pengembangan Urusan SIM & TI PT Perkebunan Nusantara I(Persero).</p>
                </div>
            </div>
            <div class="block span6">
                <a href="#tablewidget" class="block-heading" data-toggle="collapse">Waiting List<span class="label label-warning"><?php echo $wl_rows; ?></span></a>
                <div id="tablewidget" class="block-body collapse in">
                    <?php if ($wl_rows > 0): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Perusahaan</th>
                                    <th>Bidang Usaha</th>
                                    <th>Golongan</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($wl as $r): ?>
                                    <tr>
                                        <td><?php echo $r->nama_rekanan; ?></td>
                                        
                                        <?php
                                        $rows_bidang = $this->drt_model->get_bidang($r->id_rekanan);
                                        ?>
                                        <td>
                                            <?php $i = 0; ?>
                                            <?php foreach ($rows_bidang as $d): ?>
                                                <?php $i++; ?>
                                                <?php 
                                                    if(count($rows_bidang) > 1) echo $i .". ". $d->nama_bidang;
                                                    else echo $d->nama_bidang;
                                                ?>
                                            <br />
                                            <?php endforeach; ?>
                                        </td>
                                        <td><?php echo $r->golongan; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <p><a href="<?php echo $base; ?>rekanan/waiting_list">More...</a></p>
                    <?php else: ?>
                        <p style="padding:10px 0 0 0;">Data belum tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        </div>