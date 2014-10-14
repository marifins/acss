<option value="0">- Tahap -</option>
<?php foreach ($query as $d): ?>
    <option value="<?php echo $d->tahap_drt; ?>"><?php echo "Tahap ". $d->tahap_drt; ?></option>
<?php endforeach; ?>
