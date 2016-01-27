(function ($) {
    function slide_dependencies() {
        var $metaBox = $('.ep-main');
        var $caption_link = $metaBox.find('.section-caption .imageList a');
        var $background_type = $metaBox.find('.section-background .imageList a');
        var $caption_image_icon_link = $metaBox.find('.section-caption-image-icon .imageList a');


        $caption_link.on('click',function() {
            apply_dependencies();
        });

        $background_type.on('click',function() {
            apply_dependencies();
        });


        $caption_image_icon_link.on('click',function() {
            apply_dependencies();
        });

    }

    function apply_dependencies() {
        var $metaBox = $('.ep-main');
        var $caption_link = $metaBox.find('.section-caption .imageList a.selected');
        var $background_type = $metaBox.find('.section-background .imageList a.selected');
        var $caption_image_icon_link = $metaBox.find('.section-caption-image-icon .imageList a.selected');

        if($caption_image_icon_link.hasClass('image') )
        {
           $caption_image_icon_link.parents('.section').siblings('.section-caption-image').fadeIn('fast').next('hr').fadeIn();
           $caption_image_icon_link.parents('.section').siblings('.section-caption-icon').fadeOut('fast').next('hr').fadeOut();
        }
        else
        {
           $caption_image_icon_link.parents('.section').siblings('.section-caption-image').fadeOut('fast').next('hr').fadeOut();
           $caption_image_icon_link.parents('.section').siblings('.section-caption-icon').fadeIn('fast').next('hr').fadeIn();
            
        }

        if($background_type.hasClass('image') )
        {
           $caption_image_icon_link.parents('.section').siblings('.section-background-image').fadeIn('fast').next('hr').fadeIn();
           $caption_image_icon_link.parents('.section').siblings('.section-background-video').fadeOut('fast').next('hr').fadeOut();

        }
        else
        {
           $caption_image_icon_link.parents('.section').siblings('.section-background-video').fadeIn('fast').next('hr').fadeIn();
           $caption_image_icon_link.parents('.section').siblings('.section-background-image').fadeOut('fast').next('hr').fadeOut();
        }


        if($caption_image_icon_link.hasClass('image') )
        {
           $caption_image_icon_link.parents('.section').siblings('.section-caption-image').fadeIn('fast').next('hr').fadeIn();
           $caption_image_icon_link.parents('.section').siblings('.section-caption-icon').fadeOut('fast').next('hr').fadeOut();
        }
        else
        {
           $caption_image_icon_link.parents('.section').siblings('.section-caption-image').fadeOut('fast').next('hr').fadeOut();
           $caption_image_icon_link.parents('.section').siblings('.section-caption-icon').fadeIn('fast').next('hr').fadeIn();
            
        }

        if($caption_link.hasClass('style5'))
        {
           $caption_link.parents('.imageSelect').siblings('.caption-align-field').fadeOut('fast');
        }
        else
        {
            $caption_link.parents('.imageSelect').siblings('.caption-align-field').fadeIn('fast');
        }
        
    }

    $(document).ready(function () {
        $('#postdivrich').addClass('hide-box');
        $('#postimagediv').addClass('hide-box');
        slide_dependencies();
        apply_dependencies();
    });

})(jQuery);