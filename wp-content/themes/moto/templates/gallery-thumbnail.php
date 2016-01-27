<?php 

/* This template file displays the thumbnail of a gallery post on the homepage. */

// Get post 
global $post;

/* Get options for thumbnail */
$pFeaturedSize  = (get_post_meta(get_the_ID(), 'portfolio-featured-size', true)) ? strtolower(preg_replace('/\s+/', '-', get_post_meta(get_the_ID(), 'portfolio-featured-size', true))) : 'square'; // Featured Size of image 
$terms    = get_the_terms( get_the_ID(), 'gallery_cat' ); // Filter terms
$background = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
$hasimages      = (has_post_thumbnail()) ? 'hasimages' : 'noimages'; // Image class for sizing
$postFormat =  get_post_format();
$pLink  = (get_post_meta(get_the_ID(), 'link-url', true)) ; 

// This Code Use For Show Iamge Place Holderlder For gallery  When Import DummyData! :)
$thumbchk = get_post_meta($post->ID,'_thumbnail_id',false);
if(empty($thumbchk)){
    // if $thumbchk[0] is Empty 
} else {
    $thumbchk = wp_get_attachment_image_src($thumbchk[0], $pFeaturedSize, false);  // URL of Featured first slide
}

if(empty($thumbchk)){
    $hasimages = 'noimages'; 
} 


if ( $postFormat == "link")
{
    $isLink  =  true;
} else {
    $isLink  =  false;
}

// Add additional post classes 
$postclasses = array(
    $pFeaturedSize,
    'isotope-item',
    $hasimages
);

// Add terms to post classes for filtering 
if ($terms) : 
    foreach ($terms as $term) : 
        array_push($postclasses,'term-'.$term->term_id.' ');
    endforeach; 
endif;  


$termNames = get_the_term_list( $post->ID , 'gallery_cat', '<span>', '</span> , <span> ', ' </span>' ); // get the item categories
    
?>

<!-- The Post -->
<div <?php post_class($postclasses);?> >
    <div class="postphoto">
        <?php echo ep_thumbnail_gallery_slideshow($pFeaturedSize, $post->ID ,$post->post_name,$terms, $isLink , $pLink); ?>
    </div>  
    <?php if ( $portolio_type == "portfolio_text" ) { ?>
    
        <!-- meta dada for portfolio text style -->
        <div class="portfolio_text_meta">
            <div class="like"><?php echo getPostLikeLink( get_the_ID() ); ?></div>
            
            <div class="right_meta">
                <div class="title">
                    <?php echo get_the_title($post->ID); ?>
                </div>
                <div class="category">
                    <?php echo $termNames; ?>
                </div>
            </div>
        </div>
        
    <?php } ?>
    
</div>


<!-- End The Post -->