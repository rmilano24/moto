(function ($) {


	function ImageFields()
    {
        var $imageSec    = $('.section-page-type-switch2'),
            $fields      = $imageSec.find('.text-input '),
            $dupBtn      = $('<a class="duplicate-button" href="#">Add Image</a>'),
            $remBtn      = $('<a class="remove-button" href="#">Remove</a>');

        //Click handler for remove button
        $remBtn.click(function(e){
            e.preventDefault();

            var $this = $(this);

            $this.parent().remove();

            $fields = $imageSec.find('.text-input');

            if($fields.length < 2)
            //Remove the button
                $fields.find('.remove-button').remove();
        });


        //Add remove button if there is more than one image field
        if($fields.length > 1)
            $fields.append($remBtn.clone(true));

        //Add duplicate button after last upload field
        $fields.filter(':last').after($dupBtn);

        $dupBtn.click(function(e){
            e.preventDefault();

            //Don't try to reuse $fields var above ;)
            $fields        = $imageSec.find('.text-input ');
            var $lastField = $fields.filter(':last'),
                $clone     = $lastField.clone(true);

            //Clear the value (if any)
            $clone.find('input[type="text"]').val('');

            $lastField.after($clone);

            //Refresh
            $fields        = $imageSec.find('.text-input ');
            //Add 'remove' button to all fields
            //Rest of 'remove' buttons will get cloned
            if($fields.length == 2)
                $fields.append($remBtn.clone(true));
        });
    }


    function PageTemplateSections()
    {
        var $templates  = $('select#page_template'),
            $blogMetaBox    = $('#blog_meta_box'),
            $postdivrich = $('#postdivrich'),
            $vcEditor = $('#wpb_visual_composer');
			
        function changeHandler()
        {
            var selected = $templates.find(':selected').val();

            if('main-page.php' == selected)
            {

				setTimeout(function() {
					//$postdivrich.slideUp('fast');
					$postdivrich.addClass('hiddeneditor');
					$vcEditor.addClass('hiddeneditor');
					$('#poststuff .composer-switch').addClass('hide-box');
				},200);
				$blogMetaBox.slideUp('fast');
				
            }
            else {
			
			
				var $container = $('.ep-main'),
					$pageType = $container.find('select[name="page-type-switch"]'),  
					$selected = $pageType.find('option:selected'),
					val = $selected.val();
			
				if ( val === 'blog-section')  {
					//$postdivrich.slideUp('fast');
					$postdivrich.addClass('hiddeneditor');
					$vcEditor.addClass('hiddeneditor');
					$('#poststuff .composer-switch').addClass('hide-box');
					$blogMetaBox.slideDown('fast');
				} else {
				
					//$postdivrich.slideDown('fast');
					$postdivrich.removeClass('hiddeneditor');
					$vcEditor.removeClass('hiddeneditor');
					$('#poststuff .composer-switch').removeClass('hide-box');
					$(window).scrollTop($(window).scrollTop()+10);//trick to fix bug of editor - when editor shown again, the editor content was disorganized 
					$blogMetaBox.slideDown('fast');
				}
			
            }
        }

        $templates.change(changeHandler);
        changeHandler();
    }
	
	function pageType()
    {
        var $container = $('.ep-main'),
            $pageType = $container.find('select[name="page-type-switch"],select[name="page-position-switch"],select[name="blog-type-switch"]'),
            $sec = $container.find('.section-page-position-switch,.section-page-sidebar, .section-blog-sidebar ,.section-footer-widget-area,.section-revolutionslider,.section-footer-map,.section-parallax-options,.section-blog-type-switch,.section-Overlay-options,.section-video-options'),
			$postdivrich = $('#postdivrich'),
            $vcForm = $('#wpb_visual_composer'),
			$titleShow = $container.find('select[name="title-bar"]'),
			$titleSec = $container.find('#field-title-text,#field-subtitle-text').parent(),
			$pagePositionType = $container.find('select[name="page-position-switch"]');
            $blogType = $container.find('select[name="blog-type-switch"]');
	
	
		//  Slide Up/Down Title Options
		$titleShow.change(function(){
			var $titleSelected = $titleShow.find('option:selected'),
			tVal = $titleSelected.val();
			
			if( tVal === "1" )
			{
				$titleSec.slideDown('fast');
			}
			else if ( tVal === "0" || tVal === "2" ) {
				$titleSec.slideUp('fast');
			}
		}).change();
		//End Slide Up/Down Title Options
		
        $pageType.change(function(){
            var $selected = $pageType.find('option:selected'),
                val = $selected.val(),
                $vcbtn = $('#poststuff .composer-switch'),
                $selected = $container.find('.section-'+val),
				
				$positionSelected = $pagePositionType.find('option:selected'),
				positionVal = $positionSelected.val();
                
                // Blog Type option    Creative - Toggle
                $blogTypeSelected = $blogType.find('option:selected'),
				blogTypeVal = $blogTypeSelected.val();

				/*  Slide Up/Down Editor For Blog */ 
				if( val === 'blog-section')
				{
				    //$postdivrich.slideUp('fast');
				    $postdivrich.addClass('hiddeneditor');
				    $vcForm.addClass('hiddeneditor');
				    //$vcForm.slideUp('fast');
				    $vcbtn.slideUp('fast');
				}
				else {
				    //$postdivrich.slideDown('fast');
				    $postdivrich.removeClass('hiddeneditor');
				    $vcbtn.slideDown('fast');
				    $vcForm.removeClass('hiddeneditor');
					/*$vcbtn.find('a.wpb_switch-to-composer').bind('click',function(e) {
				    	e.preventDefault();
				    	return false;
					});*/
				    //$vcbtn.find('a.wpb_switch-to-composer').trigger('click').trigger('click'); // trick to fix bug - Activate visual composer on content of editor again

					
				}

				if ( val == 'custom-section' && positionVal == '1' )
				{
					$selected = $container.find('.section-page-position-switch');	
				}
				else if ( val == 'custom-section'  && positionVal == '0' )
				{
					$selected = $container.find('.section-page-position-switch,.section-page-sidebar,.section-footer-widget-area,.section-footer-map,.section-revolutionslider');
				}
				else if ( val == 'blog-section' && positionVal == '1' )
				{
					$selected = $container.find('.section-page-position-switch');	
				}
				else if (val == 'blog-section' && positionVal == '0' && blogTypeVal == '1') //blogTypeVal = 1 for clasic blog
				{
				    $selected = $container.find('.section-page-position-switch,.section-blog-sidebar , .section-blog-type-switch ,.section-footer-widget-area,.section-footer-map,.section-revolutionslider');
				}
				else if (val == 'blog-section' && positionVal == '0' && blogTypeVal == '0') //blogTypeVal = 1 for toggle blog
				{
				    $selected = $container.find('.section-page-position-switch,.section-blog-type-switch,.section-footer-widget-area,.section-footer-map,.section-revolutionslider');
				}
				
            $sec.not($selected).slideUp('fast').next('hr').hide();
            $selected.slideDown('fast').next('hr').show();
			
			$positionSelected.not($selected).slideUp('fast').next('hr').hide();
			$positionSelected.slideDown('fast').next('hr').show();
			
        }).change();

    }
	
	function colorInput() {
	
		$('#blog_meta_box .colorinput').each(function () {
            var $input  = $(this),
                $parent = $input.parent(),
				$picker = $('<div class="color-selector"><div></div></div>'),
				col     = $input.val();
                $parent.append($picker);

            $picker.find('div').css('backgroundColor', col);

            $picker.ColorPicker({
                color: col,
                onChange: function (hsb, hex, rgb) {
                    $picker.find('div').css('backgroundColor', '#' + hex);
                    $input.val('#' + hex);
                }
            });
        });
	
	}
    $(document).ready(function () {
        PageTemplateSections();
		ImageFields();
		pageType();
		colorInput();
		setTimeout(function(){
			if($('#wpb_visual_composer').css('display') === undefined || $('#wpb_visual_composer').css('display') == 'none') {
				$('.composer-switch .wpb_switch-to-composer').trigger('click');
			}
		},100);
		
    });

})(jQuery);