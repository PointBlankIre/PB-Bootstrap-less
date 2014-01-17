 <!DOCTYPE html>
 <head>
    <meta charset="utf-8">
    <title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
  </head>
  <body>


  <div class="navbar navbar navbar-static-top" role="navigation">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>                                 

                  <a class="navbar-brand" href="<?php echo site_url(); ?>"></a>

                </div>
                <div class="navbar-collapse collapse">
                  <?php wp_nav_menu( array( 'menu_class' => 'nav navbar-nav','container' => false, 'walker'  => new BootstrapNavMenuWalker()) ); ?>
                                              <ul class="nav navbar-nav navbar-right">
                        <li>        
                             <?php // Header text
                                if (of_get_option('header_extra') <> "" ) {
                                   echo '<h2>'.of_get_option('header_extra').'</h2>';
                                }
                          ?>
                            <?php if ( ! dynamic_sidebar( 'Sidebar 2' ) ) : ?>
                                <?php endif; ?>
                        </li>
                      </ul>
                </div><!--/.navbar-collapse -->


              </div>
  </div><!-- navbar -->

 

  <div class="container">

  