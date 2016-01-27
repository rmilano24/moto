<!-- custom section  -->
<div class="customPageTopSpace"></div>

<?php

    $post_id = get_the_ID();

    if ( ( get_post_meta( $post_id, "page-type-switch", true ) == "blog-section" ) && ( get_post_meta( $post_id, "blog-type-switch", true ) == "0" ) ) {  ?>

		<?php get_template_part( 'templates/loop-page-blog' ); ?>
	
	<?php } else if ( ( get_post_meta( $post_id, "page-type-switch", true ) == "blog-section" ) && ( get_post_meta( $post_id, "blog-type-switch", true ) == "1" )  ) {  ?>	
		
		<div class="row">
			<div class="container">
		
				<?php get_template_part( 'templates/loop-page-cblog' ); ?>	
				
			</div>
		</div>

    <?php } else {

    $checkTitle = get_post_meta( get_the_ID(), "title-bar", true ); ?>

    <div class="container clearfix <?php  if ( $checkTitle != 0 ){	?> exPageTitleSpace <?php } ?>">

        <?php get_template_part( 'templates/page-title' ); ?>

    </div>

    <?php
    if (have_posts()) {
        while (have_posts()) { the_post();
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                <?php the_content(); ?>
            </div>
        <?php
        }//While have_posts
    }//If have_posts
    ?>

    <!-- custom Page End  -->

<?php }