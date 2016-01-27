<?php 
        
    $termNames = get_the_term_list( $id , 'skills', '<span>#', '</span>  <span>#', ' </span>' ); // get the item skills
    $title_attributes = ep_get_meta('attribute-title');
    $value_attributes = ep_get_meta('attribute-value');
    $portfolio_social_share = ep_get_meta('portfolio-social-share'); // get portfolio social share 

?>

<ul class="socailshare project-detail">
    <!-- portfolio tags -->
    <?php
    if($portfolio_social_share == 1 || $termNames != '')
    {
        ?>

    <li class="project portfolio_social_share">
        <?php 

        if($termNames != '')
        {
            ?>
                <span class="project-title">
                    <?php  _e('Tags :', 'epicomedia') ?> 
                </span>
                <span class="project-subtitle project-skill">
                    <?php echo $termNames ?>
                </span>
            <?php
        }

        if( $portfolio_social_share == 1 ) { ?>
    
        <!-- portfolio Socail share -->
         
        <div class="socialShareContainer">
            <div class="social_share_toggle">
                <i class="icon-share2"></i>
                <?php get_template_part('templates/social-share'); ?>
            </div>
        </div>
        
        <?php } ?>

    </li>


        <?php
    }

    ?>
    <?php if ( is_array($title_attributes) && count($title_attributes) > 0 ) { ?>
                
        <!-- Project Detail -->
        <?php foreach( $title_attributes as $key => $title ) { ?>
        
            <?php if (!(empty($title))) { ?>
            
                <li class="project">
                    <span class="project-title">
                        <?php echo esc_attr($title) ?> : 
                    </span>
                    <span class="project-subtitle">
                        <?php echo esc_attr($value_attributes[$key]) ?>
                    </span>
                </li>
            
           <?php } ?>
                        
        <?php } ?>
            
    <?php  }//end if is_array ?>
</ul>
