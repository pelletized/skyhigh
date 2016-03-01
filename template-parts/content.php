<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skyhigh
 */

?>

<?php 
	if (is_single()) { ?>
	<article id="post-<?php the_ID(); ?>" class="col-single">		
<?php }  else { ?>
	<article id="post-<?php the_ID(); ?>" class="col">			
<?php } ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		 ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
		//featured image links to post for now
		if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		<?php endif; ?>
		
		<?php 
		//advanced custom field 
		$image = get_field('product_image');
		$link = get_field('product_link');
			if (!empty($image)) {
				echo '<a href="' . $link . '" rel="nofollow" target="_blank"><img src="' . $image['sizes']['homepage-thumb'] . '" alt="' . get_the_title() . '" class="product-image"></a>';
				
			}
		//echo $image['url'];
		if (!empty($link)) {		
		?>
		
		<div class="row">
			<div class="col product-price">
				<?php the_field('product_price'); ?>
			</div>
			<div class="col product-link">
				<a href="<?php the_field('product_link'); ?>" rel="nofollow" target="_blank" class="btn btn-blue">
					Check it out &raquo;
				</a>	
			</div>
		</div><!--/.row-->	
		<?php
		};
			
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'read more <span class="meta-nav">&rarr;</span>', 'skyhigh' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
			
			
			/*
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'skyhigh' ),
				'after'  => '</div>',
			) );
			*/
		?>
	</div><!-- .entry-content -->	
</article><!-- #post-## -->
