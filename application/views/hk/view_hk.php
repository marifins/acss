<script type="text/javascript">
    $(function() {
        $(".tahun").change(function(){
            var tahun = $(".tahun").val();
            load('hk/index_ajax/'+tahun, '#show');
        });
    });
    
</script>
<style>
    #pilih_tahun{
        margin: 0 0 0 5px;
    }
    select.tahun{
        width: 100px;
        margin: 0 0 0 5px;
        font-size: 17px;
        font-weight: bold;
    }
</style>
<?php $base = base_url(); ?>
<ul class="breadcrumb">
    <li><a href="<?php echo $base; ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">HK</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if (isset($_GET['s'])): ?>
            <?php if ($_GET['s'] == 'success'): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>System:</strong> Success. HK telah diupdate!
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="btn-toolbar">
            <a href="<?php echo $base; ?>/hk/add" class="btn btn-primary"><i class="icon-plus"></i> New Data</a>
            <select name="tahun" class="tahun">
                <option value="2013">2013</option>
                <option value="2014">2014</option>
            </select>    
            <div class="btn-group">
            </div>
        </div>

        <div id="show">
            <?php $this->load->view('hk/show_hk'); ?>
        </div>

