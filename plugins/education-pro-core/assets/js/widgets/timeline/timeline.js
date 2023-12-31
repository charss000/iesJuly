// Timeline
jQuery(function($) {'use strict';
    function VerticalTimeline( element ) {
        this.element = element;
        this.blocks = this.element.getElementsByClassName("tx-timeline-container");
        this.images = this.element.getElementsByClassName("tx-timeline-icon");
        this.contents = this.element.getElementsByClassName("tx-timeline-content");
        this.offset = 0.8;
        this.hideBlocks();
    };

    VerticalTimeline.prototype.hideBlocks = function() {
        if ( !"classList" in document.documentElement ) {
            return; // no animation on older browsers
        }
        //hide timeline blocks which are outside the viewport
        var self = this;
        for( var i = 0; i < this.blocks.length; i++) {
            (function(i){
                if( self.blocks[i].getBoundingClientRect().top > window.innerHeight*self.offset ) {
                    self.images[i].classList.add("tx-vhidden"); 
                    self.contents[i].classList.add("tx-vhidden"); 
                }
            })(i);
        }
    };

    VerticalTimeline.prototype.showBlocks = function() {
        if ( ! "classList" in document.documentElement ) {
            return;
        }
        var self = this;
        for( var i = 0; i < this.blocks.length; i++) {
            (function(i){
                if( self.contents[i].classList.contains("tx-vhidden") && self.blocks[i].getBoundingClientRect().top <= window.innerHeight*self.offset ) {
                    // add bounce-in animation
                    self.images[i].classList.add("tx-timeline-icon-bounce-in");
                    self.contents[i].classList.add("tx-timeline-content-bounce-in");
                    self.images[i].classList.remove("tx-vhidden");
                    self.contents[i].classList.remove("tx-vhidden");
                }
            })(i);
        }
    };

    var verticalTimelines = document.getElementsByClassName("tx-timeline-wrap"),
        verticalTimelinesArray = [],
        scrolling = false;
    if( verticalTimelines.length > 0 ) {
        for( var i = 0; i < verticalTimelines.length; i++) {
            (function(i){
                verticalTimelinesArray.push(new VerticalTimeline(verticalTimelines[i]));
            })(i);
        }

        //show timeline blocks on scrolling
        window.addEventListener("scroll", function(event) {
            if( !scrolling ) {
                scrolling = true;
                (!window.requestAnimationFrame) ? setTimeout(checkTimelineScroll, 250) : window.requestAnimationFrame(checkTimelineScroll);
            }
        });
    }

    function checkTimelineScroll() {
        verticalTimelinesArray.forEach(function(timeline){
            timeline.showBlocks();
        });
        scrolling = false;
    };
    var getElementsInArea = (function(docElm) {
        var viewportHeight = docElm.clientHeight;
        return function(e, opts) {
            var found = [],
                i;
            if (e && e.type == 'resize')
                viewportHeight = docElm.clientHeight;
            for (i = opts.elements.length; i--;) {
                var elm = opts.elements[i],
                    pos = elm.getBoundingClientRect(),
                    topPerc = pos.top / viewportHeight * 100,
                    bottomPerc = pos.bottom / viewportHeight * 100,
                    middle = (topPerc + bottomPerc) / 2,
                    inViewport = middle > opts.zone[1] && middle < (100 - opts.zone[1]);
                elm.classList.toggle(opts.markedClass, inViewport);
                if (inViewport)
                    found.push(elm)
            }
        }
    })(document.documentElement);

    window.addEventListener('scroll', f)
    window.addEventListener('resize', f)

    function f(e) {
        getElementsInArea(e, {
            elements: document.querySelectorAll('.tx-timeline-container'),
            markedClass: 'highlight',
            zone: [15, 15]
        })
    }

        var contentBlock = $( '.tx-timeline-wrap' ),
            contentBlock = $( '.tx-timeline-container' ),
            line = $( '.tx-timeline-line-over' );

        var contentBlockHeight = [];

        $( window ).on( 'scroll', function(e) {
            contentBlock.each(function( index ) {
                contentBlockHeight.push( $(this).outerHeight() );
                if( $(this).find( '.highlight' ) ) {
                    $(this).find( '.tx-timeline-line-over' ).css( 'height', contentBlockHeight[index] + 'px' );
                }
            });

            if( this.oldScroll > this.scrollY == false ) {
                this.oldScroll = this.scrollY;
                // Scroll Down
                $( '.tx-timeline-container.highlight' ).prev().find('.tx-timeline-line-over').addClass( 'tx-highlighted' );

            }else if( this.oldScroll > this.scrollY == true ) {
                this.oldScroll = this.scrollY;
                // Scroll Up
                $( '.tx-timeline-container.highlight' ).next().find('.tx-timeline-line-over').removeClass( 'tx-highlighted' );
            }
        });




}); // End of jquery  

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */