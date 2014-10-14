<label>Kategori:</label>
<select name="kategori" id="kategori">
    <option value="0">-- Pilih Kategori --</option>
    <?php foreach ($query as $d): ?>
        <option value="<?php echo $d->id_kategori; ?>"><?php echo $d->nama_kategori; ?></option>
    <?php endforeach; ?>
</select>