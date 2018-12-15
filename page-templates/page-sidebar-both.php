<?php
/*
Template Name: Left/Right Sidebars
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container">
	<div class="main-grid sidebar-both">
		<main class="main-content narrow">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		 </main>
	<?php get_sidebar('primary'); ?>
	<?php get_sidebar('secondary'); ?>
	</div>
</div>
<?php get_footer();
