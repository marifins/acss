<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head>
        <meta charset="utf-8">
        <title>{title}</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <?php
        $base = base_url();
        $css = $base . 'assets/css/';
        $js = $base . 'assets/js/';
        $lib = $base . 'assets/lib/';
        $i = $base . 'assets/images/';
        ?>
        
        <link rel="stylesheet" href="<?php echo $css; ?>jquery-ui-1.10.3.custom.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $lib; ?>bootstrap/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $css; ?>theme.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $lib; ?>font-awesome/css/font-awesome.css" type="text/css" />
        
        <script type="text/javascript" src="<?php echo $js; ?>jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo $js; ?>jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" src="<?php echo $js; ?>main.js"></script>

        <!-- Demo page code -->

        <style type="text/css">
            .ui-autocomplete {
                max-height: 100px;
                overflow-y: auto;
                /* prevent horizontal scrollbar */
                overflow-x: hidden;
            }
            /* IE 6 doesn't support max-height
            * we use height instead, but this forces the menu to always be this tall
            */
            * html .ui-autocomplete {
                height: 100px;
            }
            .ui-autocomplete-category {
                font-weight: bold;
                padding: .2em .4em;
                margin: .8em 0 .2em;
                line-height: 1.5;
            }
            #line-chart {
                height:300px;
                width:800px;
                margin: 0px auto;
                margin-top: 1em;
            }
            .brand { font-family: georgia, serif; }
            .brand .first {
                color: #ccc;
                font-style: italic;
            }
            .brand .second {
                color: #fff;
                font-weight: bold;
            }
        </style>

        <script type='text/javascript'>
            var site = "<?php echo site_url(); ?>";
            var loading_image_large = "<?php echo $i; ?>loading_large.gif";
            var loading_image_small = "<?php echo $i; ?>loading.gif";
            var base = "<?php echo base_url(); ?>";
        </script>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> 
    <body class=""> 
        <!--<![endif]-->
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav pull-right">
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo from_session('username'); ?>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="<?php echo $base; ?>myaccount">My Account</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" class="visible-phone" href="#">Settings</a></li>
                            <li class="divider visible-phone"></li>
                            <li><a tabindex="-1" href="<?php echo $base; ?>login/do_logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <a class="brand" href="index.html"><i>Daftar Rekanan Terseleksi</i><span class="first"> DRT</span></a>
            </div>
        </div>
        <div class="sidebar-nav">
            <form method="POST" action="<?php echo $base;?>search" id="main_search" class="search form-inline">
                <input type="text" name="search" placeholder="Search..." />
            </form>

            <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard</a>
            <ul id="dashboard-menu" class="nav nav-list collapse in">
                <li><a href="<?php echo $base; ?>">Home</a></li>
            </ul>

            <a href="#setting-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Settings <i class="icon-chevron-up"></i></a>
            <ul id="setting-menu" class="nav nav-list collapse in">
                <li ><a href="<?php echo $base; ?>bidang">Bidang</a></li>
                <li ><a href="<?php echo $base; ?>bidang/add_kategori">Tambah Kategori</a></li>
                <li ><a href="<?php echo $base; ?>bidang/add_sub_bidang">Tambah Sub Bidang</a></li>
            </ul>

            <a href="#tbs-menu" class="nav-header" data-toggle="collapse"><i class="icon-align-justify"></i>Daftar Rekanan<i class="icon-chevron-up"></i></a>
            <ul id="tbs-menu" class="nav nav-list collapse in">
                <li ><a href="<?php echo $base; ?>rekanan/add">Tambah Rekanan</a></li>
                <li ><a href="<?php echo $base; ?>rekanan">Lihat Seluruh Rekanan</a></li>
            </ul>
            
            <a href="<?php echo $base; ?>rekanan/perpanjang" class="nav-header"><i class="icon-random"></i>Perpanjang Rekanan</a>
            <a href="<?php echo $base; ?>rekanan/waiting_list" class="nav-header"><i class="icon-time"></i>Waiting List</a>
            <a href="<?php echo $base; ?>rekanan/lulus" class="nav-header"><i class="icon-list"></i>Rekanan Terseleksi</a>
        </div>

        <div class="content">
            <div class="header">
                <div class="stats">
                    <p class="stat"><a href="<?php echo $base; ?>seleksi">PROSES SELEKSI >></a></p>
                </div>
                <h1 class="page-title">{h1}</h1>
            </div>

            {content}

            <footer>
                <hr>
                <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>

                <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
            </footer>

        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $lib; ?>bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
    });
</script>

</body>
</html>


