<?php
    $checkTitle = get_post_meta( get_the_ID(), "title-bar", true );
    $title = get_post_meta( get_the_ID(), "title-text", true );
    $subTitle = get_post_meta( get_the_ID() , "subtitle-text", true );
?>

<?php if ( $checkTitle != 0 )  { ?>
    <!-- headr title And Subtitle -->
        <?php if ( ( $checkTitle == 1 ) && ! empty( $title )) { ?>
            <div class="title"><h3><?php echo esc_attr($title); ?></h3></div>
        <?php } if (  ( $checkTitle == 1 ) && ! empty( $subTitle ) ) { ?>
            <div class="subtitle"><?php echo esc_attr($subTitle) ; ?></div>
        <?php } if ( $checkTitle == 2 ) { ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
        <?php } ?>
<?php } ?>
