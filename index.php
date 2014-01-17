<?php get_header(); ?>

<div class="row">
   <div class="col-md-8">

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'skeleton' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
  	<?php the_title(); ?>
  </a>
  </h1>  
  <?php the_content(); ?>


<?php endwhile;  ?> 


<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous pull-left"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older', 'skeleton' ) ); ?></div>
					<div class="nav-next pull-right"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>', 'skeleton' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>


<?php else: ?>

  <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

  </div>
  <div class="col-md-4">
	<?php    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-1') ) : 
    endif; ?>	

 
  </div>
</div><!-- end row -->

<?php get_footer(); ?>