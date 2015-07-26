// when the DOM is ready...
$(document).ready(function () {

    var $panels = $('#slider .scrollContainer > div');
    var $container = $('#slider .scrollContainer');
		
		var $panels1 = $('#slider1 .scrollContainer1 > div');
    var $container1 = $('#slider1 .scrollContainer1');

		var $panels2 = $('#slider2 .scrollContainer2 > div');
    var $container2 = $('#slider2 .scrollContainer2');
		
		var $panels3 = $('#slider3 .scrollContainer3 > div');
    var $container3 = $('#slider3 .scrollContainer3');
		
		var $panels4 = $('#slider4 .scrollContainer4 > div');
    var $container4 = $('#slider4 .scrollContainer4');


    // if false, we'll float all the panels left and fix the width 
    // of the container
    var horizontal = true;

    // float the panels left if we're going horizontal
    if (horizontal) {
        $panels.css({
            'float' : 'left',
            'position' : 'relative' // IE fix to ensure overflow is hidden
        });
				$panels1.css({
            'float' : 'left',
            'position' : 'relative' // IE fix to ensure overflow is hidden
        });
				$panels2.css({
            'float' : 'left',
            'position' : 'relative' // IE fix to ensure overflow is hidden
        });
				$panels3.css({
            'float' : 'left',
            'position' : 'relative' // IE fix to ensure overflow is hidden
        });
				$panels4.css({
            'float' : 'left',
            'position' : 'relative' // IE fix to ensure overflow is hidden
        });

        // calculate a new width for the container (so it holds all panels)
        $container.css('width', $panels1[0].offsetWidth * $panels1.length);
				$container1.css('width', $panels1[0].offsetWidth * $panels1.length);
				$container2.css('width', $panels2[0].offsetWidth * $panels2.length);
				$container3.css('width', $panels3[0].offsetWidth * $panels3.length);
				$container4.css('width', $panels4[0].offsetWidth * $panels4.length);
    }

    // collect the scroll object, at the same time apply the hidden overflow
    // to remove the default scrollbars that will appear
    var $scroll = $('#slider .scroll').css('overflow', 'hidden');
		var $scroll1 = $('#slider1 .scroll1').css('overflow', 'hidden');
		var $scroll2 = $('#slider2 .scroll2').css('overflow', 'hidden');
		var $scroll3 = $('#slider3 .scroll3').css('overflow', 'hidden');
		var $scroll4 = $('#slider4 .scroll4').css('overflow', 'hidden');

    // apply our left + right buttons
    //$scroll1
          // .before('<img class="scrollButtons left" src="../images/timeline/timelineNavLeft.png" />')
          // .after('<img class="scrollButtons right" src="../images/timeline/timelineNavLeft.png" />');

    // handle nav selection
    function selectNav() {
        $(this)
            .parents('ul:first')
                .find('a')
                    .removeClass('selected')
                .end()
            .end()
            .addClass('selected');
    }

    $('#slider .navigation').find('a').click(selectNav);
		$('#slider1 .navigation').find('a').click(selectNav);
		$('#slider2 .navigation').find('a').click(selectNav);
		$('#slider3 .navigation').find('a').click(selectNav);
		$('#slider4 .navigation').find('a').click(selectNav);

    // go find the navigation link that has this target and select the nav
    function trigger(data) {
        var el = $('#slider .navigation').find('a[href$="' + data.id + '"]').get(0);
        selectNav.call(el)
				;
				var el1 = $('#slider1 .navigation').find('a[href$="' + data.id + '"]').get(0);
        selectNav.call(el1)
				;
				var el2 = $('#slider2 .navigation').find('a[href$="' + data.id + '"]').get(0);
        selectNav.call(el2)
				;
				var el3 = $('#slider3 .navigation').find('a[href$="' + data.id + '"]').get(0);
        selectNav.call(el3)
				;
				var el4 = $('#slider4 .navigation').find('a[href$="' + data.id + '"]').get(0);
        selectNav.call(el4)
				;
    }

    if (window.location.hash) {
        trigger({ id : window.location.hash.substr(1) });
    } else {
        $('ul.navigation a:first').click();
    }

    // offset is used to move to *exactly* the right place, since I'm using
    // padding on my example, I need to subtract the amount of padding to
    // the offset.  Try removing this to get a good idea of the effect
    var offset = parseInt((horizontal ? 
        $container.css('paddingTop') : 
        $container.css('paddingLeft')) 
        || 0) * -1;
		var offset1 = parseInt((horizontal ? 
        $container1.css('paddingTop') : 
        $container1.css('paddingLeft')) 
        || 0) * -1;
		var offset2 = parseInt((horizontal ? 
        $container2.css('paddingTop') : 
        $container2.css('paddingLeft')) 
        || 0) * -1;
		var offset3 = parseInt((horizontal ? 
        $container3.css('paddingTop') : 
        $container3.css('paddingLeft')) 
        || 0) * -1;
		var offset4 = parseInt((horizontal ? 
        $container4.css('paddingTop') : 
        $container4.css('paddingLeft')) 
        || 0) * -1;


    var scrollOptions = {
        target: $scroll, // the element that has the overflow

        // can be a selector which will be relative to the target
        items: $panels,

        navigation: '.navigation a',

        // selectors are NOT relative to document, i.e. make sure they're unique
        prev: 'img.left', 
        next: 'img.right',

        // allow the scroll effect to run both directions
        axis: 'xy',

        onAfter: trigger, // our final callback

        offset: offset,

        // duration of the sliding effect
        duration: 500,

        // easing - can be used with the easing plugin: 
        // http://gsgd.co.uk/sandbox/jquery/easing/
        easing: 'swing'
    };
		var scrollOptions1 = {
        target: $scroll1, // the element that has the overflow

        // can be a selector which will be relative to the target
        items: $panels1,

        navigation: '.navigation a',

        // selectors are NOT relative to document, i.e. make sure they're unique
        prev: 'img.left1', 
        next: 'img.right1',

        // allow the scroll effect to run both directions
        axis: 'xy',

        onAfter: trigger, // our final callback

        offset: offset,

        // duration of the sliding effect
        duration: 500,

        // easing - can be used with the easing plugin: 
        // http://gsgd.co.uk/sandbox/jquery/easing/
        easing: 'swing'
    };
		var scrollOptions2 = {
        target: $scroll2, // the element that has the overflow

        // can be a selector which will be relative to the target
        items: $panels2,

        navigation: '.navigation a',

        // selectors are NOT relative to document, i.e. make sure they're unique
        prev: 'img.left2', 
        next: 'img.right2',

        // allow the scroll effect to run both directions
        axis: 'xy',

        onAfter: trigger, // our final callback

        offset: offset,

        // duration of the sliding effect
        duration: 500,

        // easing - can be used with the easing plugin: 
        // http://gsgd.co.uk/sandbox/jquery/easing/
        easing: 'swing'
    };
		var scrollOptions3 = {
        target: $scroll3, // the element that has the overflow

        // can be a selector which will be relative to the target
        items: $panels3,

        navigation: '.navigation a',

        // selectors are NOT relative to document, i.e. make sure they're unique
        prev: 'img.left3', 
        next: 'img.right3',

        // allow the scroll effect to run both directions
        axis: 'xy',

        onAfter: trigger, // our final callback

        offset: offset,

        // duration of the sliding effect
        duration: 500,

        // easing - can be used with the easing plugin: 
        // http://gsgd.co.uk/sandbox/jquery/easing/
        easing: 'swing'
    };
		var scrollOptions4 = {
        target: $scroll4, // the element that has the overflow

        // can be a selector which will be relative to the target
        items: $panels4,

        navigation: '.navigation a',

        // selectors are NOT relative to document, i.e. make sure they're unique
        prev: 'img.left4', 
        next: 'img.right4',

        // allow the scroll effect to run both directions
        axis: 'xy',

        onAfter: trigger, // our final callback

        offset: offset,

        // duration of the sliding effect
        duration: 500,

        // easing - can be used with the easing plugin: 
        // http://gsgd.co.uk/sandbox/jquery/easing/
        easing: 'swing'
    };

    // apply serialScroll to the slider - we chose this plugin because it 
    // supports// the indexed next and previous scroll along with hooking 
    // in to our navigation.
    $('#slider').serialScroll(scrollOptions);
		$('#slider1').serialScroll1(scrollOptions1);
		$('#slider2').serialScroll2(scrollOptions2);
		$('#slider3').serialScroll3(scrollOptions3);
		$('#slider4').serialScroll4(scrollOptions4);

    // now apply localScroll to hook any other arbitrary links to trigger 
    // the effect
    $.localScroll(scrollOptions);
		$.localScroll1(scrollOptions1);
		$.localScroll2(scrollOptions2);
		$.localScroll3(scrollOptions3);
		$.localScroll4(scrollOptions4);

    // finally, if the URL has a hash, move the slider in to position, 
    // setting the duration to 1 because I don't want it to scroll in the
    // very first page load.  We don't always need this, but it ensures
    // the positioning is absolutely spot on when the pages loads.
    scrollOptions.duration = 1;
		scrollOptions1.duration = 1;
		scrollOptions2.duration = 1;
		scrollOptions3.duration = 1;
		scrollOptions4.duration = 1;
    $.localScroll.hash(scrollOptions);
		$.localScroll1.hash(scrollOptions1);
		$.localScroll2.hash(scrollOptions2);
		$.localScroll3.hash(scrollOptions3);
		$.localScroll4.hash(scrollOptions4);

});