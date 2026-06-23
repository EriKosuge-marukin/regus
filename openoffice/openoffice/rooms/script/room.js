// openoffice room gallery script

jQuery(document).ready(function($){
        // $('#thumbs ul.thumbs li').opacityrollover({
        //         mouseOutOpacity:   onMouseOutOpacity,
        //             mouseOverOpacity:  1.0,
        //             fadeSpeed:         'fast',
        //             exemptionSelector: '.selected'
        //             });

        var gallery = $('#thumbs').galleriffic({
                delay:3000,
                numThumbs:20,
                preloadAhead:40,
                enableTopPager:            false,
                enableBottomPager:         true,
                maxPagesToShow:            7,  // The maximum number of pages to display in either the top or bottom pager
                imageContainerSel:         '#slideshow', // The CSS selector for the element within which the main slideshow image should be rendered
                controlsContainerSel:      '', // The CSS selector for the element within which the slideshow controls should be rendered
                captionContainerSel:       '', // The CSS selector for the element within which the captions should be rendered
                loadingContainerSel:       '', // The CSS selector for the element within which should be shown when an image is loading
                renderSSControls:          true, // Specifies whether the slideshow's Play and Pause links should be rendered
                renderNavControls:         true, // Specifies whether the slideshow's Next and Previous links should be rendered
                playLinkText:              'Play',
                pauseLinkText:             'Pause',
                prevLinkText:              'Previous',
                nextLinkText:              'Next',
                nextPageLinkText:          'Next &rsaquo;',
                prevPageLinkText:          '&lsaquo; Prev',
                enableHistory:             false, // Specifies whether the url's hash and the browser's history cache should update when the current slideshow image changes
                enableKeyboardNavigation:  true, // Specifies whether keyboard navigation is enabled
                autoStart:                 false, // Specifies whether the slideshow should be playing or paused when the page first loads
                syncTransitions:           false, // Specifies whether the out and in transitions occur simultaneously or distinctly
                defaultTransitionDuration: 1000, // If using the default transitions, specifies the duration of the transitions
                onSlideChange:             undefined, // accepts a delegate like such: function(prevIndex, nextIndex) { ... }
                onTransitionOut:           undefined, // accepts a delegate like such: function(slide, caption, isSync, callback) { ... }
                onTransitionIn:            undefined, // accepts a delegate like such: function(slide, caption, isSync) { ... }
                onPageTransitionOut:       undefined, // accepts a delegate like such: function(callback) { ... }
                onPageTransitionIn:        undefined, // accepts a delegate like such: function() { ... }
                onImageAdded:              undefined, // accepts a delegate like such: function(imageData, $li) { ... }
                onImageRemoved:            undefined  // accepts a delegate like such: function(imageData, $li) { ... }

                // onSlideChange:             function(prevIndex, nextIndex) {
                //     // 'this' refers to the gallery, which is an extension of $('#thumbs')
                //     this.find('ul.thumbs').children()
                //     .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                //     .eq(nextIndex).fadeTo('fast', 1.0);
                // },
                // onPageTransitionOut:       function(callback) {
                //     this.fadeTo('fast', 0.0, callback);
                // },
                // onPageTransitionIn:        function() {
                //     this.fadeTo('fast', 1.0);
                // }
            });
    });
