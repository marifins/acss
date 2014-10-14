<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <title>{title}</title>
        <!-- Meta Tags -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <!-- External CSS -->
        <?php //foreach($styles as $style) echo HTML::style($style), "\n";?>
        <?php
        $base = base_url();
        $css = $base . 'assets/css/';
        $js = $base . 'assets/js/';
        $i = $base . 'assets/images/';
        ?>
        <link rel="stylesheet" href="<?php echo $css; ?>jquery-ui-1.10.3.custom.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $css; ?>home.css" type="text/css" />
        <!-- External Javascripts -->
        <?php //foreach($scripts as $script) echo HTML::script($script), "\n";?>

        <script type="text/javascript" src="<?php echo $js; ?>jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo $js; ?>jquery-ui-1.10.3.custom.js"></script>
		<script type="text/javascript" src="<?php echo $js; ?>jquery.tools.min.js"></script>
        <script type="text/javascript">
            var base = "<?php echo base_url(); ?>";
            var fullDate = new Date() 
            //convert month to 2 digits
            var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
    
            var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();
            var count = 1;
			
			$('.media').media();

            function transition() {

                if(count == 1) {
                    $('#show').load(base +'bulanan/index_ajax/'+"0" +"/"+currentDate).fadeOut( 300 ).delay( 50 ).fadeIn( 500 );
                    count = 2;

                } else if(count == 2) {
                    $('#show').load(base +'pengumuman').fadeOut( 300 ).delay( 50 ).fadeIn( 500 );
                    count = 3;

                } else if(count == 3) {
                    $('#show').load(base +'gallery/show/1').fadeOut( 300 ).delay( 50 ).fadeIn( 500 );
                    count = 4;
                    
                } else if(count == 4) {
                    $('#show').load(base +'gallery/show/2').fadeOut( 300 ).delay( 50 ).fadeIn( 500 );
                    count = 5;
                    
                } else if(count == 5) {
                    $('#show').load(base +'gallery/show/3').fadeOut( 300 ).delay( 50 ).fadeIn( 500 );
                    count = 6;
                    
                } else if(count == 6) {
                    $('#show').load(base +'gallery/show/4').fadeOut( 300 ).delay( 50 ).fadeIn( 500 );
                    count = 7;
                    
                } else if(count == 7) {
                    $('#show').load(base +'gallery/show/5').fadeOut( 300 ).delay( 50 ).fadeIn( 500 );
                    count = 8;
                    
                } else if(count == 8) {
                    $('#show').load(base +'show/index_ajax/'+"0" +"/"+currentDate).fadeOut( 300 ).delay( 50 ).fadeIn( 500 );
                    count = 1;
                }          

            }
			//$('#show').load(base +'bulanan/index_ajax/'+"0" +"/"+currentDate).fadeOut( 300 ).delay( 50 ).fadeIn( 500 );//
            setInterval(transition, 5000);
            //$('#mainscreen').load(base +'show/index_ajax/'+"0" +"/"+currentDate).slideUp( 300 ).delay( 100 ).fadeIn( 400 );
					
        </script>
    </head>
    <body style="background-color: #eeeeee;" overflow="hidden">
          <div id="page-wrap">
            <div>
                <div id="temp"></div>
                {content}
            </div>
        </div>
        <div id="show_load"> </div>
    </body>
</html>
