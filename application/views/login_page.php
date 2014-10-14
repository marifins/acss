<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bootstrap Admin</title>
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

        <link rel="stylesheet" href="<?php echo $lib; ?>bootstrap/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $css; ?>theme.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $lib; ?>font-awesome/css/font-awesome.css" type="text/css" />

        <script type="text/javascript" src="<?php echo $js; ?>main.js"></script>
        <script type="text/javascript" src="<?php echo $lib; ?>jquery-1.7.2.min.js"></script>

        <!-- Demo page code -->

        <style type="text/css">
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

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

        <script>
            $(function() {
                $("#signin").click(function(){
                    $(this).closest('form').trigger('submit');
                });
            });
        </script>
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

                </ul>
                <a class="brand" href="index.html"><i>Daftar Rekanan Terseleksi</i><span class="first"> DRT</span></a>
            </div>
        </div>

        <div class="row-fluid">
            <div class="dialog">
                <div class="block">
                    <p class="block-heading">Sign In</p>
                    <div class="block-body">
                        <form name="flogin" method="POST" action="<?php echo $base; ?>login/do_login">
                            <?php if (isset($_GET['status'])): ?>
                                <p style="color:red;">Username atau Password Anda salah.</p>
                            <?php endif; ?>
                            <label>Username</label>
                            <input type="text" id="username" name="username" class="span12">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="span12">
                            <a href="#" class="btn btn-primary pull-right" id="signin">Sign In</a>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="<?php echo $lib; ?>bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript">
            $("[rel=tooltip]").tooltip();
            $(function() {
                $("input#username").focus();
                
                $("input#password").bind("enterKey",function(e){
                   $("form[name='flogin']").submit();
                });
                $("input#password").keyup(function(e){
                    if(e.keyCode == 13)
                    {
                        $(this).trigger("enterKey");
                    }
                });
                
                $('.demo-cancel-click').click(function(){return false;});
            });
        </script>

    </body>
</html>


