<?php
//Main colors
$acc    = ep_opt('style-accent-color');//Accent color
$hc     = ep_opt('style-highlight-color');//Highlight color
$lc     = ep_opt('style-link-color');//Link color
$lhc    = ep_opt('style-link-hover-color');//Link hover color

//Preloader
$preloader_bg_color = ep_opt('preloader_bg_color');
$preloader_color = ep_opt('preloader_color');
$preloader_box_color = ep_opt('preloader_box_color');
$preloader_text_color = ep_opt('preloader_text_color');
//Notification
$notification_bg_color = ep_opt('notification_bg_color');

//Menu Styles
$menuBgColor = ep_opt('menu-background-color') ;
$menuTextColor =  ep_opt('menu-text-color');
$MenuHoverColor    = ep_opt('menu-text-hover-color');//menu hover color
$menuOpacity=  ep_opt('menu-opacity');
    
if ((isset($menuOpacity) && !empty($menuOpacity)) || ($menuOpacity == "0") ) {
    $menuOpacity=  ep_opt('menu-opacity')/100;
} else {
    $menuOpacity = 0.98;
}

//Initial menu value
$initialMenuBgColor = ep_opt('initial-menu-background-color');
$initialMenuTextColor = ep_opt('initial-menu-text-color');
$initialMenuHoverColor =  ep_opt('initial-menu-text-hover-color');//initial menu hover color
$initialMenuOpacity = ep_opt('initial-menu-opacity');

if ((isset($initialMenuOpacity) && !empty($initialMenuOpacity)) || ($initialMenuOpacity == 0) ) {
    $initialMenuOpacity=  ep_opt('initial-menu-opacity')/100;
} else {
    $initialMenuOpacity = 0.98;
}

?>

/* Menu */
#menuBgColor, aside.vertical_menu_area,#epHeader.wave-menu-header
{
	background-color: <?php echo esc_attr($menuBgColor); ?>;
	opacity: <?php echo esc_attr($menuOpacity); ?>;
}

header .navigation > ul > li > a , .vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation li a
{
	color: <?php echo esc_attr($menuTextColor); ?>;
}
                
header .navigation > ul > li .spanHover, .vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation li .verticalspanHover { 
    background-color:<?php echo esc_attr($MenuHoverColor); ?>;
}

header .navigation > ul > li:hover .spanHover { 
    background-color:<?php echo esc_attr($MenuHoverColor); ?> !important;
}

#headerFirstState .menuBgColor
{
	background-color: <?php echo esc_attr($initialMenuBgColor); ?>;
	opacity: <?php echo esc_attr($initialMenuOpacity); ?>;
}

header a.trigger {
    background-color : <?php echo esc_attr($menuBgColor); ?>;
}

#epHeader.wave-menu-header .widget.widget_woocommerce-wishlist {
    background-color : <?php echo esc_attr($menuBgColor); ?>;
}

#epHeader.wave-menu-header .widget.widget_woocommerce-dropdown-cart {
    background-color : <?php echo esc_attr($menuBgColor); ?>;
}

#epHeader.wave-menu-header .search-button {
background-color : <?php echo esc_attr($menuBgColor); ?>;
}

header .morph-shape {
    fill : <?php echo esc_attr($menuBgColor); ?>;
}

.wave-menu .menu-list a span {
    color: <?php echo esc_attr($menuTextColor); ?>;
}

.wave-menu .menu-list li:hover > a span, .wave-menu .menu-list li.active > a span, .wave-menu .menu-list li.current_page_item > a span {
    background-color: <?php echo esc_attr($MenuHoverColor); ?>;
}

#headerFirstState .navigation li a
{
	color: <?php echo esc_attr($initialMenuTextColor); ?>;
}
               
header #headerFirstState .navigation > ul > li .spanHover  {
    background-color:<?php echo esc_attr($initialMenuHoverColor); ?>;
}

header.borderhover #headerFirstState .navigation ul li:hover a, header.borderhover #headerFirstState .navigation ul li.active a, header.borderhover #headerFirstState .navigation ul li.current_page_item a {
    background-color:<?php echo esc_attr($initialMenuHoverColor); ?>;
}

.single-portfolio header .navigation > ul > li .spanHover,.single-portfolio .vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation li .verticalspanHover,
.single-portfolio header.borderhover .navigation li:hover a ,.single-portfolio header.borderhover .navigation li.active a ,.single-portfolio header.borderhover .navigation > ul > li.current_page_item a {
    color:<?php echo esc_attr($menuTextColor); ?> !important;
}

header.borderhover .navigation ul li:hover a, header.borderhover .navigation ul li.active a, header.borderhover .navigation ul li.current_page_item a {
    background-color:<?php echo esc_attr($MenuHoverColor); ?>;
}

.single-portfolio header.borderhover .navigation ul li:hover > a {
    background-color:<?php echo esc_attr($MenuHoverColor); ?> !important;
    color:#fff !important;
}

/* Anchor */
a{ color:<?php echo esc_attr($lc); ?>; }
a:hover{ color:<?php echo esc_attr($lhc); ?>; }

/* Text Selection */
::-moz-selection { background: <?php echo esc_attr($hc); ?>; /* Firefox */ }
::selection { background: <?php echo esc_attr($hc); ?>; /* Safari */ }

.pageNavigation .more-link-arrow:hover,
.wpcf7-form .label.inputfocus ,
#respond-wrap .label.inputfocus ,
#respond .label.inputfocus ,
#review_form  .label.inputfocus ,
.wpcf7-form .graylabel.inputfocus ,
#respond-wrap  .graylabel.inputfocus ,
#respond .graylabel.inputfocus ,
#review_form .graylabel.inputfocus , 
header .navigation-button:hover ,
#phoneNav, 
.navigation-mobile a:hover ,
.widget-area a:hover,
.iconbox .glyph ,
.iconbox.transparentbackground .icon span.glyph,
.team-member .icons li:hover a,
.pieChart .perecent,
.iconPchart .icon, 
.comment-reply-title small a , 
.comments-list .comment-reply-link, 
.portfolio_text .portfolio_text_meta .like .jm-post-like.liked.icon-heart5:before ,
.postphoto .like .jm-post-like.liked.icon-heart5:before,
.isotope.lightStyle .postphoto .like .jm-post-like.liked.icon-heart5:before,
.subnavigation li:hover a ,
#portfoliSingle .like .jm-post-like.liked.icon-heart5:before ,
.search-item .count , 
.showcase:not(.showcase-mobile) .item-list h6.active,
.showcase:not(.showcase-mobile) .item-list h6:hover {
    color: <?php echo esc_attr($acc); ?>;
}

#comment-text textarea::-webkit-input-placeholder,
#comment-text textarea:-moz-placeholder, 
#comment-text textarea:-ms-input-placeholder {
    color: <?php echo esc_attr($acc); ?>;
}

.sticky .accordion_box10 .blogTitle ,
.sticky .accordion_box2 .accordion_title {
    color:<?php echo esc_attr($acc); ?> !important;
}

.sticky .blogAccordion .rightBorder {
    border-right: 2px solid <?php echo esc_attr($acc); ?> !important;
}

#respond-wrap .input-text input:focus,
#respond-wrap .input-textarea textarea:focus ,
#respond .input-text input:focus,
#respond .input-textarea textarea:focus ,
#review_form input:focus,
#review_form  textarea:focus, 
.wpcf7-form-control-wrap input[type="email"]:focus,
.wpcf7-form-control-wrap input[type="text"]:focus ,
.wpcf7-form-control-wrap textarea:focus , 
.custom-title .shape-container.triangle .shape-line , 
.custom-title .shape-container.triangle .shape-line:after , 
.custom-title .shape-container.triangle .shape-line:before {
    border-bottom:  4px solid <?php echo esc_attr($acc); ?>;
}

.custom-title .shape-container .hover-line ,
.iconbox.rectangle .icon span.glyph,
.iconbox.circle .icon span.glyph ,
.team-member .member-line ,
.team-member:hover .member-plus ,
.pieChart .dot-container .dot ,
.testimonials .quot-icon, 
.post-meta .hr-extra-small.hr-margin-small , 
.progress_bar .progressbar_percent, 
.progress_bar .progressbar_percent:after, 
.item-content:before ,
.widget.widget_woocommerce-dropdown-cart li .qbutton.chckoutbtn {
    background-color:<?php echo esc_attr($acc); ?>;
}

.woocommerce ul.products li.product a.added_to_cart, .woocommerce-page ul.products li.product a.added_to_cart {
    background-color:<?php echo esc_attr($acc); ?> !important;
}

.textLeftBorder .title ,
.wpb_heading {
    border-left:solid <?php echo esc_attr($acc); ?> 8px;
}

.textLeftBorder.fontSize123 .title {
    border-left:15px solid <?php echo esc_attr($acc); ?>;
}

.custom-title .shape-container.square .shape-line ,
.custom-title .shape-container.rotated_square .shape-line , 
.custom-title .shape-container.circle .shape-line {
    border: 4px solid <?php echo esc_attr($acc); ?>;
}

.iconbox.rectangle .icon span.glyph,
.iconbox.circle .icon span.glyph {
    border: 2px solid <?php echo esc_attr($acc); ?>;
}

.testimonials:before ,
.testimonials:after {
    border-top: 3px solid <?php echo esc_attr($acc); ?>;
}

.testimonials .quot-icon:before {
    border-top-color:<?php echo esc_attr($acc); ?>;
    border-bottom-color:<?php echo esc_attr($acc); ?>;
    border-left-color:<?php echo esc_attr($acc); ?>;
}

.testimonials .quot-icon:after {
    border-bottom-color: <?php echo esc_attr($acc); ?>;
}

/* woocomerce */
.widget.widget_woocommerce-dropdown-cart .header_cart .header_cart_span {
    background-color: <?php echo esc_attr($acc); ?> !important;
}

.widget.widget_woocommerce-wishlist a span.wishlist_items_number {
    background-color: <?php echo esc_attr($acc); ?> !important;
}

.woocommerce .product .summary .price, .woocommerce-page .product .summary .price {
     color: <?php echo esc_attr($acc); ?>;
}
.woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt,
.woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover {
    background-color: <?php echo esc_attr($acc); ?> !important;
}


/* notification */
<?php
if ( ep_opt('notification_bg_color')) {  ?>

#notification {
    background-color: <?php echo esc_attr($notification_bg_color); ?>
}

<?php } ?>


/* preloader */
<?php

if ( ep_opt('preloader_bg_color')) {  ?>

#preloader {
    background-color: <?php echo esc_attr($preloader_bg_color); ?>
}

<?php } ?>

<?php if ( ep_opt('preloader_color')) {  ?>

#preloader .ball {
    background:<?php echo esc_attr($preloader_color); ?>;
}

.preloader_circular .path {
    stroke:<?php echo esc_attr($preloader_color); ?>;
}

#prelaoder-simple .rect {
    stroke:<?php echo esc_attr($preloader_color); ?>;
}

#preloader_box .rect {
    stroke:<?php echo esc_attr($preloader_color); ?>;
}

<?php } ?>

<?php if ( ep_opt('preloader_box_color')) {  ?>

#preloader_box {
    background: <?php echo esc_attr($preloader_box_color); ?>
}

<?php } ?>

<?php if ( ep_opt('preloader_text_color')) {  ?>

.preloader-text {
    color: <?php echo esc_attr($preloader_text_color); ?>
}

<?php } ?>

<?php 
$footerwidgetbanner = ep_opt('footer-widget-banner');
if (ep_opt('footer-widget-banner')) {
?>

.footer-widgetized {
    min-height:580px;
    background: transparent url(<?php echo esc_url($footerwidgetbanner); ?>) repeat bottom center;
    background-size: cover;
}

.footer-widgetized-gradient {
    min-height:800px;
}
        
.footer-widgetized-wrap {
    padding-top:150px;
}
  
<?php } ?>



/*######## Set font ########*/

/* General font */
<?php
//Fonts
$bodyFont = ep_opt('font-body');
$navFont  = ep_opt('font-navigation');
$headFont = ep_opt('font-headings');
$ShortcodeFont = ep_opt('font-shortcode');
?>

<?php if ( $bodyFont !== 'Open Sans') { ?>
body,
.wpb_content_element,
.desktopBlog .accordion_content p,
.not_found_page p,
.wpcf7-form-control-wrap input[type="email"],
.wpcf7-form-control-wrap input[type="text"],
.wpcf7-form-control-wrap textarea,
.input-text input[type="text"],
.input-textarea textarea,
.imageBox .title .subtitle,
.imageBox .content .text,
.textBox .subtitle,
.textBox .text,
.widget-area a,
.iconbox .content,
.iconbox .more-link a,
.custom-iconbox .content,
.team-member .member-info cite,
.team-member .member-info p,
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a,
.wpb_tabs_nav .wpb_tab p ,.wpb_accordion_section .wpb_text_column p ,.wpb_tab .wpb_content_element p,
.counterBoxDetails,
.pieChartBox .subtitle,
.testimonial blockquote,
.comment-reply-title small a,
.blog_social_share_title,
.postphoto .skills,
.cblog .post-content p ,
.singlePost .post p,
.notificationText,
.item-content p,
.caption-subtitle,
.caption .button
.woocommerce .woocommerce-ordering select, .woocommerce-page .woocommerce-ordering select,
.widget.widget_woocommerce-dropdown-cart .wc_cart_product_info .wc_cart_product_name,
.woocommerce table.shop_table .product-name a,
.woocommerce table.cart div.coupon .input-text, .woocommerce-page table.cart div.coupon .input-text,
.woocommerce .cart .button, .woocommerce .cart input.button,
.shipping-calculator-form select,
.shipping-calculator-form input[type="text"],
button[name="calc_shipping"].button {
    font-family:'<?php echo esc_attr($bodyFont); ?>', sans-serif;
}
<?php } ?>


/* Heading & titles */

<?php if ( $headFont !== 'Dosis') { ?>
h1,h2,h3,h4,h5,h6,
form input[type="submit"],
.blogAccordion .leftBorder .monthYear,
.blogAccordion .accordion_title,
.blogAccordion .accordion_title .day,  
.desktopBlog .blogAccordion .accordion_box10 .blogTitle,
#search-form input[type="text"],
#fullScreenSlider.slide .arrows-button-prev .text, #fullScreenSlider.slide .arrows-button-next .text,
.widget-area .widget-title,
.footer-widgetized .progressbar .title,
.footer-widgetized .widget-title,
.post .post-title,
.post-date,
.post-info,
.page-title,
#blogSingle .arrows-button-prev .text, #blogSingle .arrows-button-next .text,
.preloader-text,
.caption-title,
.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale , .woocommerce span.onsale, .woocommerce-page span.onsale ,
.woocommerce ul.products li.product h3, .woocommerce-page ul.products li.product h3,
.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,
.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins,
.woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del,
.woocommercepage .page-title,
.woocommerce #reviews h3,
#review_form_wrapper form .comment-form-rating label,
.woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info,
.woocommerce ul.cart_list li .amount, .woocommerce ul.product_list_widget li .amount ,
.woocommerce .widget_shopping_cart .total strong, .woocommerce.widget_shopping_cart .total strong,
.woocommerce .widget_price_filter .price_slider_wrapper .price_label , .woocommerce-page  .widget_price_filter .price_slider_wrapper .price_label,
.widget.widget_woocommerce-dropdown-cart .total,
.widget.widget_woocommerce-dropdown-cart .wc_cart_product_info .price , .widget.widget_woocommerce-dropdown-cart .wc_cart_product_info .quantity,
.out_of_stock_badge_loop,
.woocommerce form.checkout .woocommerce-error, .woocommerce-page form.checkout .woocommerce-error ,
.woocommerce table.shop_table th, .woocommerce table.shop_table td, .woocommerce table.shop_table th,
woocommerce .product .summary .price, .woocommerce-page .product .summary .price,
.woocommerce div.product .woocommerce-tabs ul.tabs li a,
.woocommerce-cart .cart-collaterals .cart_totals table,
.custom-title .title,
.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span {
    font-family:'<?php echo esc_attr($headFont); ?>', sans-serif;
}
<?php } ?>


/* Shortcode title font */

<?php if ( $ShortcodeFont !== 'Dosis') { ?>
.button,
.titleSpace .title h3 ,.exPageTitleSpace .title h3,
.textBox .title,
.team-member .member-info .member-name,
.counterBox  .counterBoxNumber,
.pieChart .perecent,
.pieChartBox .title,
.testimonial .name,
.testimonials .quote .name ,
.testimonials .quote .job ,
.postphoto .title,
.portfolioSection .title h3,
.portfolio_text .portfolio_text_meta .right_meta,
.portfolio_text .portfolio_text_meta .right_meta .title,
.portfolio_text .portfolio_text_meta .like a .no_like,
.postphoto .like a,
.postphoto .like a .no_like,
.subnavigation a,
.subnavigation li a .post-count,
#portfoliSingle .like a,
#ajaxPDetail .pDHeader .title,
.portfolio_detail_creative .pd_creative_fixed_content .title_container .title,
.project-detail li.project,
ul.portfolio-filter li ul li a,
.progress_bar .progress_title,
.progress_percent_value,
.showcase h3,
.showcase .item-list h6,
.imageBox .content .title ,
.iconbox.iconbox-top .title,
.iconbox.iconbox-left .title,
.custom-iconbox .title,
.wpb_content_element .wpb_tabs_nav li a,
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header,
.postphoto .overlay .hover-title,
.wpb_toggle .title,
.vc_gitem-post-data.vc_gitem-post-data-source-post_title div,
.vc_gitem-post-data h4,
.vc_separator ,
.pricing-box .plan-price {
    font-family:'<?php echo esc_attr($ShortcodeFont); ?>', sans-serif !important;
}
<?php }

/* Navigation */
?>
<?php if ( $navFont !== 'Dosis') { ?>
header .navigation > ul > li > a,
header .navigation li li > a,   
.menu-list a span,
.vertical_menu_enabled .vertical_menu_area .vertical_menu_navigation a {
    font-family:'<?php echo esc_attr($navFont); ?>', sans-serif;
}
<?php } 


$socialcolor1 = ep_opt('social_custom1_color');
if ( ep_opt('social_custom1_color')) {
?>
.socialLinkShortcode.custom1 a:before{
	background: <?php echo esc_attr($socialcolor1); ?>
}
<?php } 


$socialcolor2 = ep_opt('social_custom2_color');
if ( ep_opt('social_custom2_color')) {
?>
.socialLinkShortcode.custom2 a:before{
	background: <?php echo esc_attr($socialcolor2); ?>
}
<?php }

 

$socialLogo1 = ep_opt('social_custom1_image');
$socialLogo2 = ep_opt('social_custom2_image');
?>
span.icon.icon-custom1{
    background-image: url("<?php echo esc_url($socialLogo1); ?>");
}
span.icon.icon-custom2{
    background-image: url("<?php echo esc_url($socialLogo2); ?>");
}

/*######## Style Overrides ########*/

<?php ep_eopt('additional-css'); ?>