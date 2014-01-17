<?php get_header(); ?>


	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	
	<h1><?php the_title(); ?></h1>

	
	  	<?php the_content(); ?>
	  	<?php edit_post_link('edit', '<p>', '</p>'); ?>

	<?php endwhile; else: ?>
		<p><?php _e('Sorry, this page does not exist.'); ?></p>
	<?php endif; ?>



<?php get_footer(); ?>