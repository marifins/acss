<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>404 Error Page</title>
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
    </head>

    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> 
    <body class=""> 
        <div class="row-fluid">
            <div class="http-error">
                <div class="http-error-message">
                    <div class="error-caption">
                        <p>Oops!</p>
                    </div>
                    <div class="error-message">
                        <p>This page doesn't exist.<p>
                        <p class="return-home"><a href="<?php echo $base;?>">Back to the home page</a></p>
                    </div>
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