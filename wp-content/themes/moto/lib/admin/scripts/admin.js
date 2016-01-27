(function ($) {

    var utility = {
        //Checks if element as desired attribute
        HasAttr: function ($elm, attr) {
            return typeof $elm.attr(attr) != 'undefined';
        },
        GetAttr: function ($elm, attr, def) {
            return this.HasAttr($elm, attr) ? $elm.attr(attr) : def;
        }
    };

    //Show/hide fields based on selected value
    function FieldSelector() {
        $('.field-selector select').each(function () {
            var $select = $(this),
                $section = $select.parents('.section'),
                fieldList = utility.GetAttr($select, 'data-fields', ''),
                $fields = $section.find(fieldList);

            $select.change(function () {
                var $selected = $select.find('option:selected');

                if (!utility.HasAttr($selected, 'data-show')) {
                    $fields.slideUp('fast');
                    return;
                }

                var show = $selected.attr('data-show'),
                    $items = $section.find(show);

                $fields.not($items).slideUp('fast');
                $items.slideDown('fast');
            }).change();
        });
    }

    //Handles icon selector
    function iconSelect() {

        $('input.icon-filed').each(function () {

            var $iconInput = $(this);
            var $pxIconsContainer = $iconInput.parents('.ep-icon-container');

            if ($iconInput.attr('value') !== '') {
                $pxIconsContainer.find('.ep-icon[data-name=' + $iconInput.attr('value') + ']').addClass('selected');
            }


            $pxIconsContainer.find('.ep-icon').click(function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $iconInput.attr('value', '');
                }
                else {
                    $iconInput.attr('value', $(this).attr('data-name'));
                    $pxIconsContainer.find('.ep-icon').removeClass('selected');
                    $(this).addClass('selected');
                }

            });

        });
    }

    function CSVInput() {

        $('.csv-input').each(function () {
            var $container = $(this),
                $hidden = $container.find('input[type="hidden"]'),
                $input = $container.find('input[type="text"]'),
                $addBtn = $container.find('.btn-add'),
                $list = $container.find('.list');

            var values = $hidden.val().length > 0 ? $hidden.val().split(',') : [];

            //Add current items to our list
            for (i = 0; i < values.length; i++) {
                var val = values[i],
                    text = val.replace('%666', ','),//Evil char 
                    $item = GetNewItem(val, text);

                $list.append($item);
                HandleCloseBtn($item);
            }

            AssembleList();

            //Handle add button
            $addBtn.click(function (e) {
                e.preventDefault();

                var val = $input.val();
                val = $.trim(val);
                $input.val('');//Clear

                if (val.length < 1)
                    return;

                var $item = GetNewItem(val.replace(",", "%666"), val);
                HandleCloseBtn($item);
                $item.hide();

                $list.prepend($item);

                AssembleList();

                $item.slideDown('fast', function () { $(window).resize(); });
            });

            function AssembleList() {
                $hidden.val('');//Clear the current list
                var vals = [];

                $list.find('.value').each(function () {
                    var value = $(this).attr('data-val');
                    vals.push(value);
                });

                $hidden.val(vals.join(','));
            }

            function HandleCloseBtn($item) {
                //Remove item on click
                $item.find('.btn-close').click(function (e) {
                    e.preventDefault();

                    $item.slideUp('fast', function () { $item.remove(); AssembleList(); $(window).resize(); });
                });
            }

            function GetNewItem(val, text) {
                return $('<div class="value" data-val="' + val + '"><span>' + text + '</span><a href="#" class="btn-close"></a></div>');
            }

        });


    }

    function ImageSelect() {
        var $controls = $('.imageSelect');

        $controls.each(function () {
            var $select = $(this),
                $input = $select.find('input'),
                $options = $select.find('a');

            if( !$select.find('.selected').length )
            {
                $select.find('a').eq(0).addClass('selected');
                $input.val($select.find('a').eq(0).html());
            }
            

            //Hide input control
            $input.hide();

            $options.click(function (e) {
                e.preventDefault();

                var $ctl = $(this);

                if ($ctl.hasClass('selected'))
                    return;

                $options.removeClass('selected');
                $ctl.addClass('selected');

                $input.val($ctl.html());
            });
        });
    }

    function Chosen() {
        if (!$.fn.chosen)
            return;

        $('.chosen').chosen();
    }

    function Combobox() {
        $('.select').each(function () {
            var $this = $(this),
                $overlay = $this.find('div'),
                $select = $this.find('select');

            $select.change(function () {
                $overlay.html($select.find('option:selected').text());
            });

            $select.change();
        });
    }

    function ColorPicker() {
        if (!$.fn.ColorPicker)
            return;

        $('#appearance .colorinput').each(function () {
            var $input = $(this),
                $parent = $input.parent(),
                $picker = $('<div class="color-selector"><div></div></div>'),
                $view = $parent.find('.color-view'),
                col = $input.val();
            $parent.append($picker);

            $picker.find('div').css('backgroundColor', col);
            $view.css('backgroundColor', col);

            var $style = $('select[name="style-preset-color"]'),
                styleName = $style.find(':selected').val();
            if ($style.length) {
                if (styleName == "custom") {
                    $view.css({ "display": "none" });
                    $picker.css({ "display": 'block' });
                    $input.prop("readonly", false);
                    $input.css({ 'cursor': 'text', 'font-style': 'normal', 'color': '#666666' });

                } else {
                    $view.css({ "display": "block" });
                    $picker.css({ "display": 'none' });
                    $input.prop("readonly", true);
                    $input.css({ 'cursor': 'not-allowed', 'font-style': 'italic', 'color': '#9B9B9B' });

                }

            }

            $picker.ColorPicker({
                color: col,
                onChange: function (hsb, hex, rgb) {
                    $picker.find('div').css('backgroundColor', '#' + hex);
                    $input.val('#' + hex);
                }
            });

        });

        $('#preloader .colorinput , #header .colorinput , #menu .colorinput , #headerstyle .colorinput , #headerStartBtn .colorinput , #footer .colorinput , #notification .colorinput, #social .colorinput').each(function () {
            var $input = $(this),
                $parent = $input.parent(),
                $picker = $('<div class="color-selector"><div></div></div>'),
                col = $input.val();
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

    function Sliders() {
        if (!$.fn.noUiSlider)
            return;

        var $sliders = $('input[type="range"]');

        $sliders.each(function () {
            var $this = $(this),
                $parent = $this.parent(),
                $label = $('<span></span>'),
                min = 0,
                max = 100,
                start = 0,
                isSwitch = $this.hasClass('switch'),
                sliderCls = isSwitch ? 'switch' : 'slider',
                $slider = $('<div class="' + sliderCls + '"></div>'),
                $states = ['Off', 'On'],
                setupState = true;//For switches


            //Set label
            $parent.find('.label').prepend($label);

            if ('value' in this.attributes)
                $label.html(this.attributes['value'].value);

            //Set values
            if (isSwitch) {
                min = 0;
                max = 1;

                if ($this.attr('data-state0') !== undefined)
                    $states[0] = $this.attr('data-state0');

                if ($this.attr('data-state1') !== undefined)
                    $states[1] = $this.attr('data-state1');

            }
            else {

                if ($this.attr('min') !== undefined)
                    min = parseInt($this.attr('min'));

                if ($this.attr('max') !== undefined)
                    max = parseInt($this.attr('max'));

                if ($this.attr('step') !== undefined)
                    step = parseInt($this.attr('step'));
                else
                    step = 0.01;

            }

            if ('value' in this.attributes &&
                this.attributes['value'].value.length > 0)
                start = parseInt(this.attributes['value'].value);
            else
                start = min + max * 0.5;

            $this.hide();
            $slider.appendTo($parent);

            if (isSwitch) {
                $slider.noUiSlider({
                    start: start,
                    range: {
                        'min': [min],
                        'max': [max]
                    },
                    step: 1,
                    direction: "ltr",
                    behaviour: 'tap',
                    connect: "upper"
                });
            }
            else {
                $slider.noUiSlider({
                    start: [start],
                    range: {
                        'min': [min],
                        'max': [max]
                    },
                    step : step,
                    direction: "ltr",
                    behaviour: 'tap',
                });
            }

            $slider.on({
                slide: Handle_Change,
            });


            function Handle_Change(e) {
                var value = $slider.val();

                if (isNaN(value) || (setupState && isSwitch && start > 0 && start < 1))
                    value = min;

                if (isSwitch) {

                    $label.html($states[Math.ceil(value)]);
                }  
                else
                {
                    if(Math.ceil(step) == step && $.isNumeric(step)) 
                    {
                        $label.html(Math.ceil(value));
                        value = Math.ceil(value);
                    }
                    else
                    {
                        $label.html(value);
                    } 
                }

                $this.val(value);

                setupState = false;
            }

            var $midbar = $slider.find('.noUi-midBar'),
                left = $midbar.css('left'),
                right = $midbar.css('right');

            if (left == '0px' && right == '0px' && $slider.val() != max) {
                $midbar.css({ right: $this.width() });
            }

            var $sliderHandle = $slider.find('.noUi-handle');


            if (isSwitch) {

                Handle_Change();
            }


        });

    }

    function Tooltips() {


        $('.section-tooltip').each(function () {
            var $this = $(this),
                text = $this.html(),
                $icon = $('<a href="#"></a>'),
                $wrap = $('<div class="tip_wrapper"><div class="text">' + text + '</div><div class="arrow_shade"></div><div class="arrow"></div></div>');

            $this.html('');
            $this.append($icon);
            $this.append($wrap);
            $wrap.css({ opacity: 0, display: 'none' });

            function Adjust_Tooltip() {
                $wrap.css({ right: 0, top: -(($wrap.outerHeight() - $icon.outerHeight() * 0.5) + 15) });
            }

            Adjust_Tooltip();

            $icon.click(function (e) {
                e.preventDefault();
            });

            if ($.fn.hoverIntent)
                $this.hoverIntent(InHandler, OutHandler);
            else
                $this.hover(InHandler, OutHandler);

            function InHandler() {
                $wrap.css({ display: 'block' });
                Adjust_Tooltip();
                $wrap.stop().animate({ opacity: 1 }, 200);
            }

            function OutHandler() {
                $wrap.stop().animate({ opacity: 0, }, { duration: 200, complete: function () { $wrap.css({ display: 'none' }); } });
            }

        });

    }

    function Save_Button() {
        var $btns = $('.ep-main .save-button'),
            $loadingIcons = $btns.find('.loading-icon'),
            $saveIcons = $btns.find('.save-icon'),
            $form = $('.ep-container'),
            $dummyData = $('.ep-main input[name="import_dummy_data"]');

        $btns.click(function (e) {
            var $btn = $(this);

            if ($btn.hasClass('loading')) {
                e.preventDefault();
                return;
            }

            var data = $form.find('input,textarea,select').serialize();

            $loadingIcons.css({ display: 'inline' });
            $saveIcons.hide();

            $btns.addClass('loading');


            //Todo: Save the settings
            //Test ajax call
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: data,
                success: function (data, textStatus, jqXHR) {
                    //TODO: Show proper saved message
                    //alert(data);
                    OnSaveComplete();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    OnSaveComplete();

                    alert('Error occured in saving data');
                }
            });

            function OnSaveComplete() {
                $loadingIcons.hide();
                $saveIcons.css({ display: 'inline' });
                $btns.removeClass('loading');

                //Reload page if import dummy data option is selected
                if ($dummyData.length && $dummyData.val() == '1')
                    document.location.reload(true);
            }

            e.preventDefault();
        });


    }

    function Tabs() {
        var $tabs = $('.ep-tab a'),
            $active = $();

        $tabs.each(function () {
            var $this = $(this),
                href = $this.attr('href'),
                $container = $(href);

            $this.click(function (e) {
                e.preventDefault();

                if ($this.hasClass('active'))
                    return;

                $tabs.removeClass('active');
                $this.addClass('active');

                $active.fadeOut(100);
                $container.fadeIn(400);

                //Scroll iconContainer to show the select icon
                var $pxIconsContainer = $container.find('.ep-icon-container');
                $pxIconsContainer.each(function () {
                    if ($(this).find('.selected').length) {
                        var $offset = $(this).find('.selected').offset().top - $(this).offset().top;
                        if ($offset > 0) {
                            $(this).stop().animate({
                                scrollTop: $offset + "px"
                            }, 200);
                        }
                    }
                });

                $active = $container;

                $(window).resize();
            });

            if ($this.hasClass('active')) {
                $this.removeClass('active');
                $this.click();
                $active = $container;

                //scroll iconContainer to show the select icon
                var $pxIconsContainer = $container.find('.ep-icon-container');
                $pxIconsContainer.each(function () {
                    if ($(this).find('.selected').length) {
                        var $offset = $(this).find('.selected').offset().top - $(this).offset().top;
                        if ($offset > 0) {
                            $(this).stop().animate({
                                scrollTop: $offset + "px"
                            }, 200);
                        }
                    }
                });
            }
            else {
                $container.fadeOut(100);
            }

        });

    }

    function Sidebar_Accordion() {
        var $panels = $('#ep-sidebar-accordion > div'),
            $head = $('#ep-sidebar-accordion > h3 a');

        $panels.hide();

        var $active = $('#ep-sidebar-accordion > h3 a.active'),
            $target = $();

        if ($active.length > 0) {
            $target = $active.parent().next();
            $target.show();
        }


        $head.click(function (e) {
            var $this = $(this);

            $target = $this.parent().next();

            if (!$this.hasClass('active')) {
                var $prev = $('#ep-sidebar-accordion > h3 a.active').parent().next();

                $head.removeClass('active');

                $prev.slideUp('slow', 'easeOutQuad');
                $target.slideDown('slow', 'easeOutQuad');
                $this.addClass('active');

            }

            e.preventDefault();
        });
    }

    function Thickbox() {
        var $currentField = $();
        var $imageField = $();
        var $imageFieldContainer = $();

        $('.upload-field .upload-button').click(function (e) {
            var $this = $(this),
                $parent = $this.parent(),
                referer = 'ep-settings',
                title = 'Upload';

            if ($parent.attr('data-referer') !== undefined)
                referer = $parent.attr('data-referer');

            if ($parent.attr('data-title') !== undefined)
                title = $parent.attr('data-title');

            $currentField = $(this).prev();
            $imageField = $(this).siblings('.upload-thumb').find('img');
            $imageFieldContainer = $(this).siblings('.upload-thumb');

            var $pid = jQuery('#post_ID'),
                postId = $pid.length > 0 ? $pid.val() : '0';

            tb_show(title, 'media-upload.php?post_id=' + postId + '&referer=' + referer + '&type=image&TB_iframe=true', false);

            e.preventDefault();
        });

        $('.upload-thumb .close').click(function (e) {
            $(this).parents('.upload-thumb').removeClass("show");
            $(this).parents('.upload-field').find('input').val('');
        });

        var orig_send_to_editor = window.send_to_editor;

        window.send_to_editor = function (html) {
            if ($currentField.length) {
                var image_url = $(html).attr('href');
				if(image_url == undefined)
                {
                    image_url = $(html).attr('src');
                }
                $currentField.val(image_url);
                $imageField.attr({ 'src': image_url });

                if ((image_url).length) {
                    $imageFieldContainer.addClass('show');
                }

                $imageField = $();
                $currentField = $();
                tb_remove();
            }
            else {
                if (typeof orig_send_to_editor != 'undefined')
                    orig_send_to_editor(html);
            }
        }
    }

    function ImageFields() {
        var $imageSec = $('.section-home-slides'),
            $fields = $imageSec.find('.upload-field'),
            $dupBtn = $('<a class="duplicate-button" href="#">Add Image</a>'),
            $remBtn = $('<span class="remove-button"><a class=" close" href="#"><span class="close-icon"></span></a></span>');

        //Click handler for remove button
        $remBtn.click(function (e) {
            e.preventDefault();

            var $this = $(this);

            $this.parent().remove();

            $fields = $imageSec.find('.upload-field');

            if ($fields.length < 2)
                //Remove the button
                $fields.find('.remove-button').remove();
        });


        //Add remove button if there is more than one image field
        if ($fields.length > 1)
            $fields.append($remBtn.clone(true));

        //Add duplicate button after last upload field
        $fields.filter(':last').after($dupBtn);

        $dupBtn.click(function (e) {
            e.preventDefault();

            //Don't try to reuse $fields var above ;)
            $fields = $imageSec.find('.upload-field');
            var $lastField = $fields.filter(':last'),
                $clone = $lastField.clone(true);

            //Clear the value (if any)
            $clone.find('input[type="text"]').val('');
            $clone.find('.upload-thumb').removeClass('show');
            $clone.find('img').attr('src','');

            $lastField.after($clone);

            //Refresh
            $fields = $imageSec.find('.upload-field');
            //Add 'remove' button to all fields
            //Rest of 'remove' buttons will get cloned
            if ($fields.length == 2)
                $fields.append($remBtn.clone(true));
        });
    }

    function HomeType() {
        var $container = $('#header'),
            $intro_types = $container.find('.intro_type');
            

        $intro_types.find('a').on('click',function(){
            $intro_types.find('a').removeClass('selected');
            $(this).addClass('selected');
            intro_typ_change();
        });

        intro_typ_change();

        // Home type  
        function intro_typ_change() {
            var $selected = $container.find('a.selected');

            if ( $selected.hasClass('home-revolutionSlider') ) {
                $(".section-home-revolutionSlider").slideDown('fast').next('hr').show();
                $(".section-home-slider").slideUp('fast').next('hr').hide();
                $(".section-home-map").slideUp('fast').next('hr').hide();
                $(".section-home-slider-overlay").slideUp('fast').next('hr').hide();
                $(".section-home-start-btn").slideUp('fast').next('hr').hide();
                $(".section-home-start-btn-style").slideUp('fast').next('hr').hide();
            } else if($selected.hasClass('home-slider')) {
                $(".section-home-revolutionSlider").slideUp('fast').next('hr').hide();
                $(".section-home-slider").slideDown('fast').next('hr').show();
                $(".section-home-map").slideUp('fast').next('hr').hide();
                $(".section-home-slider-overlay").slideDown('fast').next('hr').show();
                $(".section-home-start-btn").slideDown('fast').next('hr').show();
                $(".section-home-start-btn-style").slideDown('fast').next('hr').show();
            }
            else
            {
                $(".section-home-revolutionSlider").slideUp('fast').next('hr').hide();
                $(".section-home-slider").slideUp('fast').next('hr').hide();
                $(".section-home-map").slideDown('fast').next('hr').show();
                $(".section-home-slider-overlay").slideDown('fast').next('hr').show();
                $(".section-home-start-btn").slideDown('fast').next('hr').show();
                $(".section-home-start-btn-style").slideDown('fast').next('hr').show();        
            }
        };

    }

    function homeTextRotator() {

        $('.section-text-rotator1').prev('hr').css('height', '2px');
        $('[class*=section-text-rotator]').next('hr').css('height', '2px');

        // hide empty text Rotator When Load Page except first item
        var $TextRotatorInput = $('.section-text-rotator1'),
        $allTextRotatorInput = $('[class*=section-text-rotator]');

        // this Code Cause First text Rotator be Visible 
        $textRotatorInputNotFirst = $allTextRotatorInput.not(':first');
        $allTextRotatorInput.first().find('.deleteImageSelect input').attr('value', '2');

        $textRotatorInputNotFirst.each(function () {
            $DISValue = $(this).find('.deleteImageSelect input').attr('value');
            if ($DISValue == "1") {
                $(this).hide().next('hr').hide();
            }

        });



        // Add New Text More BTN 
        $tDupBtn = $('<a class="duplicate-text-button" href="#"> <span class="plus"> + </span> <span class="add"> Add </span> </a>');

        var $filTRCounter = 0;
        $textRotatorInputNotFirst.each(function () {

            var $this = $(this);
            var $inputValue = $this.find('.deleteImageSelect input').attr('value');
            if ($inputValue === "2") {
                $filTRCounter++;
            }

        });

        if ($filTRCounter < 9) {

            //Add duplicate button after last text field
            $allTextRotatorInput.filter(':last').after($tDupBtn);

        }

        var $homeStyleSection = $('.section-home-text-slider'),
        $emptyTextRotatorInput = $homeStyleSection.find('input:text[value=""]').parent('.text-input'),
        $textRotatorInput = $homeStyleSection.find('input:text').parent('.text-input'),
        $tDupBtn = $('<a class="duplicate-text-button" href="#"><span class="plus"> + </span> <span class="add"> Add </span> </a>');

        if ((10 - $emptyTextRotatorInput.length) < 9) {
            //Add duplicate button after last text field
            $textRotatorInput.filter(':last').after($tDupBtn);

        }

        $('.duplicate-text-button').click(function (e) {

            e.preventDefault();

            var $emptytextRotator = $('.section-text-rotator1');

            $textRotatorInputNotFirst.each(function () {

                var $this = $(this);
                if ($this.find('.deleteImageSelect input').attr('value') === "1") {
                    $emptytextRotator = $emptytextRotator.add($this);
                }

            });


            $emptytextRotator = $emptytextRotator.not(':first');



            if ($emptytextRotator.length < 10 && $emptytextRotator.length > 0) {

                $emptytextRotator.first().show().next('hr').show();;
                $emptytextRotator.first().find('.deleteImageSelect input').attr('value', '2 ');

                if ($emptytextRotator.length == 1) {

                    $('.duplicate-text-button').hide();

                }
            }

            $allTextRotatorInput.find('.deleteImageSelect input').filter();


        })

        $emptyTextRotatorInput.not(':first').hide();


        // remover text roter by Click On Remove Btn And Set deleteImageSelect value = 1 (empty) 
        $(document).on('click', '.imageSelect.deleteImageSelect', function () {

            var $this = $(this);
            $this.find('input').attr('value', '1');
            $this.parents('.section').slideUp('fast').next('hr').hide();

            $parent = $this.parent('[class*=section-text-rotator]');

            $input = $parent.find('[id*=field-home-text]');
            $inputSubtitle = $parent.find('[id*=field-home-subtitle]');
            $imageInput = $parent.find('[id*=field-header-image]');
            $textArea = $parent.find('.text-rotator-textarea-input').find('textarea');
            $iconInput = $parent.find('.text-rotator-icon-input input')

            $iconInput.removeAttr('value');// empty iconbox 
            var $pxInputIcon = $parent.find('.ep-icon-container');
            $pxInputIcon.find('.ep-icon').removeClass('selected');

            $input.removeAttr('value');//empty title box
            $imageInput.removeAttr('value');//empty Image box
            $inputSubtitle.removeAttr('value');// empty subtitle 
            $textArea.val('');// empty textarea

        });

    }

    function preloader() {

        var $preloaderTypeSelected = $('.section-preloader-type .imageSelect a.selected');
        $preloaderTypeSelected = $preloaderTypeSelected.text();

        $preloadertext = $('.section-preloader-text');
        $preloaderlogo = $('.section-preloader-logo');
        $preloaderboxcolor = $('.section-preloader_color').find('.field').eq(1);

        if ($preloaderTypeSelected == 'creative') {
            $preloadertext.add($preloaderlogo).add($preloaderboxcolor).slideDown('fast');
        } else {
            $preloadertext.add($preloaderlogo).add($preloaderboxcolor).slideUp('fast').show();
            $('.section-preloader-text').add($preloaderboxcolor).next('hr').hide();
        }

        $(document).on('click', '.section-preloader-type .imageSelect a', function () {

            var $this = $(this);
            $preloaderType = $this.text();

            if ($preloaderType == "creative") {
                $preloadertext.add($preloaderlogo).add($preloaderboxcolor).slideDown('fast');
                $('.section-preloader-text').next('hr').show();
            } else {
                $preloadertext.add($preloaderlogo).add($preloaderboxcolor).slideUp('fast');
                $('.section-preloader-text').next('hr').hide();
            }

        });

    }

    function menu() {

        var $container = $('#menu'),

            // Header Position 
            $headerPosition = $container.find('.section-header-position .imageList a.selected'),
            $headerPositionVal = $headerPosition.text();

            //HeaderTop Style
            $HeadertopStyle = $container.find('.section-header-style .imageList a.selected'),
            $HeadertopStyleVal = $HeadertopStyle.text();
            
            // Header Color 
            $HeaderColor = $container.find('.section-menu-color');
            // Header intial Color  - Only Hybrid menu 
            $HeaderTopIntialColor = $container.find('.section-initial-menu-color');
            // Header intial Logo  - Only Hybrid menu 
            $intialLogo = $container.find('.section-logo');
            // Header top Style 
            $headerStyle = $container.find('.section-header-style');
            // Header Top Hover Style
            $HeaderTopHoverStyle = $container.find('.section-menu-hover-style');
            // Menu vertical background Image
            $section_vertical_menu_background = $container.find('.section-vertical_menu_background');
            $section_vertical_menu_social_style = $container.find('.section-social-icon-style');
            
            
        if ($headerPositionVal == 1) { // 1 = Header Top

            // slid Up Menu vertical background Image
            $section_vertical_menu_background.slideUp('fast').next('hr').hide();
            $section_vertical_menu_social_style.slideUp('fast').next('hr').hide();
            $headerStyle.add($HeaderTopHoverStyle).slideDown('fast').next('hr').show();
            $(".section-menu-color").find('.field').eq(3).show(); // Hide opacity Option in left and Right menu

            // Slide up intail Color panel When Epico Menu ( hybrid Menu ) is not selected
            if ($HeadertopStyleVal == "epico-menu") {
                $HeaderTopIntialColor.slideDown('fast').next('hr').show();
                $intialLogo.slideDown('fast').next('hr').show();
            } else {
                $HeaderTopIntialColor.slideUp('fast').next('hr').hide();
                $intialLogo.slideUp('fast').next('hr').hide();
            }                                    

            // Slide up intail Color panel When Epico Menu ( hybrid Menu ) is not selected
            if ($HeadertopStyleVal == "wave-menu") {
                $(".section-menu-color").find('.field').eq(3).hide();
                $('.section-toggle-menu-style').show().next('hr').show();
                $('.section-menu-hover-style').hide().next('hr').hide();
            } else {
                $(".section-menu-color").find('.field').eq(2).show();
                $(".section-menu-color").find('.field').eq(3).show();
                $('.section-toggle-menu-style').hide().next('hr').hide();
                $('.section-menu-hover-style').show().next('hr').show();
            }

        } else if ($headerPositionVal == 2 || $headerPositionVal == 3) { // header is left or Right 

            $headerStyle.add($HeaderTopHoverStyle).add($HeaderTopIntialColor).slideUp('fast').next('hr').hide();
            $section_vertical_menu_background.slideDown('fast').next('hr').show();
            $section_vertical_menu_social_style.slideDown('fast').next('hr').show();

            $HeaderColor.slideDown('fast'); // slid down color
            $(".section-menu-color").find('.field').eq(2).show();// this feild Hide in Wave menu 
            $(".section-menu-color").find('.field').eq(3).show();// this feild Hide in Wave menu 
            $HeaderTopIntialColor.slideUp('fast').next('hr').hide(); // intial header slide up 
            $intialLogo.slideUp('fast').next('hr').hide();//intial logo
            $HeaderTopHoverStyle.slideUp('fast').next('hr').hide(); // Top hover Style slide Up 
            $(".section-menu-color").find('.field').eq(3).hide(); // Hide opacity Option in left and Right menu
        }

        // Menu Position
        $(document).on('click', '.section-header-position .imageList a', function () {
			
            var $select = $(this),
            $headerPositionVal = parseInt($(this).text());

            $HeadertopStyle = $container.find('select[name="header-style"]'),
            $HeadertopStyleVal = $HeadertopStyle.find('option:selected').val();

			
            if ($headerPositionVal == 2 || $headerPositionVal == 3) { // header is left or Right 

                $headerStyle.add($HeaderTopHoverStyle).slideUp('fast').next('hr').hide();
				$section_vertical_menu_background.slideDown('fast').next('hr').show();

				$HeaderColor.slideDown('fast'); // slid down color
				$HeaderTopIntialColor.slideUp('fast').next('hr').hide(); // intial header slide up 
				$intialLogo.slideUp('fast').next('hr').hide();//intial logo
				$HeaderTopHoverStyle.slideUp('fast').next('hr').hide(); // Top hover Style slide Up 
				$(".section-menu-color").find('.field').eq(3).hide(); // Hide opacity Option in left and Right menu

            } else if ($headerPositionVal == 1) { // 1 = Header Top
				
                // Slide up intail Color panel When Epico Menu ( hybrid Menu ) is not selected
                if ($HeadertopStyleVal == "epico-menu") {
                    $HeaderTopIntialColor.slideDown('fast').next('hr').show();
                } else {
                    $HeaderTopIntialColor.slideUp('fast').next('hr').hide();
                }

                $(".section-menu-color").find('.field').eq(3).show(); // Hide opacity Option in left and Right menu
                $headerStyle.add($HeaderTopHoverStyle).add($HeaderTopIntialColor).slideDown('fast').next('hr').show();
                $section_vertical_menu_background.slideUp('fast').next('hr').hide();

            }

        });
		

        // menu top style 
        $(document).on('click', '.section-header-style .imageList a', function () {

            var $select = $(this),
                val = $(this).text(),
                $MenuLogo = $container.find('.section-logo,.section-logo-second'),
                $selected = $('#menu').find('.section-' + val);
  
            if (val == 'fixed-menu' || val == 'scroll-sticky' || val == 'wave-menu') {

                $(".section-logo").slideUp('fast').next('hr').hide();
                $(".section-initial-menu-color").slideUp('fast').next('hr').hide();


                if (val == 'wave-menu') {

                    $(".section-menu-style").slideUp('fast').next('hr').hide();

                    $(".section-menu-color").find('.field').eq(3).hide();
                    $('.section-toggle-menu-style').slideDown('fast').next('hr').show();
                    $('.section-menu-hover-style').slideUp('fast').next('hr').hide();

                } else if ((val == 'fixed-menu' || val == 'scroll-sticky')) {

                    $(".section-menu-style").slideDown('fast').next('hr').show();
                    $(".section-menu-color").find('.field').eq(2).show();
                    $(".section-menu-color").find('.field').eq(3).show();
                    $('.section-toggle-menu-style').slideUp('fast').next('hr').hide();
                    $('.section-menu-hover-style').slideDown('fast').next('hr').show();
                }

            } else if (val == 'epico-menu') {
                $(".section-logo-second , .section-logo , .section-initial-menu-color ").slideDown('fast').next('hr').show();
                $('.section-toggle-menu-style').hide().next('hr').hide();
                $(".section-menu-color").find('.field').eq(2).show();
                $(".section-menu-color").find('.field').eq(3).show();
            }

            //$MenuLogo.not($selected).slideUp('fast').next('hr').hide();
            $selected.slideDown('fast').next('hr').show();

        }).change();

    }

    function demo_importer() {
        $(document).on('click', 'a.import', function (e) {
            e.preventDefault();
            var $import_button = $(this);
            var $demo = $(this).parents('.demo');
            swal({
                title: "Do you want to import demo content?",
                text: "It maybe makes duplicate content!",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Import data!",
                closeOnConfirm: true
            }, function () {

                $demo.removeClass('failed success');
                $demo.addClass('loading');
                if ($demo.find('.alert-box').length == 0) {
                    var $alert_box = $('body').find('.alert-box').first().clone();
                    $import_button.before($alert_box);
                }

                var data = {
                    action: 'importer_callback',
                    demo_name: $import_button.siblings('input').val()
                };

                $.post(ajaxurl, data, function (response) {
                    $demo.removeClass('loading failed success');

                    if (response == 0) {
                        $demo.addClass('failed');
                        if (!$import_button.parents('.demo').hasClass('failed')) {
                            $demo.removeClass('loading failed success').addClass('failed');
                            var $failed = $alert_box.find('.fail');
                            $failed.find('.sa-icon').css({ 'display': 'block' }).addClass('animateErrorIcon');
                            $failed.find('.sa-icon .sa-x-mark').addClass('animateXMark');
                        }
                    }
                    else {
                        $demo.addClass('succesful');
                        var $success = $alert_box.find('.success');
                        $success.find('.sa-icon').css({ 'display': 'block' }).addClass('animate');
                        $success.find('.sa-icon .sa-tip').addClass('animateSuccessTip');
                        $success.find('.sa-icon .sa-long').addClass('animateSuccessLong');
                    }
                });

            });


        });
    }

    function setRowTypeIcon ()
    {
        $('span.row_type').each(function(){
            if($(this).html() == "parallax")
            {
                $(this).addClass('parallax-type'); 
            }
            else if($(this).html() == "video")
            {
                $(this).addClass('video-type');
            }
            else
            {
                $(this).removeClass('parallax-type video-type');
            }
        })
    }

    $(document).ready(function () {

        FieldSelector();
        CSVInput();
        ImageSelect();
        Save_Button();
        Thickbox();
        Tooltips();
        Sliders();
        ColorPicker();
        Combobox();
        Chosen();
        Tabs();
        Sidebar_Accordion();
        ImageFields();
        HomeType();
        homeTextRotator();
        menu();
        iconSelect();
        demo_importer();
        preloader();
        setTimeout(function(){
            setRowTypeIcon();
        },800);

        $('button.vc_panel-btn-save').on('click',function(){
            setTimeout(function(){
                setRowTypeIcon();
            },200);
        });
        

    });

})(jQuery);