<?php $base = base_url();?>
<?php if (is_logged_in ()): ?>
<?php if (from_session('level') == 2): ?>
        <div class="navigation">        
            <ul class="menu" id="menu">
                <li><span class="rkap"></span><a href="<?php echo $base; ?>login/do_logout">Logout</a></li>
                <li><span class="hk"></span><a href="<?php echo $base; ?>rkap">Setting</a></li>
                <li><span class="user"></span><a href="<?php echo $base; ?>user">User</a></li>
                <li><span class="details"></span><a href="<?php echo $base; ?>produksi">Produksi</a></li>
                <li><span class="home"></span><a href="<?php echo $base; ?>">Home</a></li>
            </ul>
        </div>
<?php elseif (from_session('level') == 1): ?>
            <div class="navigation2">
                <ul class="menu" id="menu">
                    <li><span class="rkap"></span><a href="<?php echo $base; ?>login/do_logout">Logout</a></li>
                    <li><span class="details"></span><a href="<?php echo $base; ?>produksi">Produksi</a></li>
                    <li><span class="home"></span><a href="<?php echo $base; ?>unit">Home</a></li>
                </ul>
            </div>
<?php endif; ?>
<?php else: ?>
                <div class="navigation3">
                    <ul class="menu" id="menu">
                        <li style="margin: 32px 0 0 0; color:#b8860b"><em>"The Information System for Palm Oil Mill Production"</em></li>
                    </ul>
                </div>
<?php endif; ?>