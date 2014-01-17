      <footer>
       

       <div class="row">
  <div class="col-md-8">
       
         <?php
   // Footer text
			if (of_get_option('footer_text') <> "" ) {
				 echo '<p>'.of_get_option('footer_text').'</p>';
			}
?>

  </div>
  <div class="col-md-4">
  				<!-- Social Icons -->
				<ul class="icons unstyled nav-pills pull-right">
				<?php
				   // Facebook
							if (of_get_option('facebook_adr') <> "" ) {
								 echo ' <li class="facebook"><a href="'.of_get_option('facebook_adr').'" target="_blank">Facebook</a></li>';
							}
				?>				
				<?php
				   // Twitter
							if (of_get_option('twitter_adr') <> "" ) {
								 echo '<li class="twitter"><a href="'.of_get_option('twitter_adr').'" target="_blank">Twitter</a></li>';
							}
				?>
				
			</ul>
     
    	   </div>
		</div><!-- end row -->
	</footer>

    </div> <!-- /container -->

    <?php wp_footer(); ?>

   

   

    <?php
   // Google Analytics
			if (of_get_option('footer_scripts') <> "" ) {
				echo '<script type="text/javascript">'.stripslashes(of_get_option('footer_scripts')).'</script>';
			}
?>


  </body>
</html>