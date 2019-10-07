$=jQuery;
$(document).ready(function() {
    if ($('.learn-acc')) {
	setSize();
	$('.learn-acc .views-row').each(function() { //set objecct position based on Learn Item's field
	    var pos = $('.views-field-field-image-orientation .field-content', this).html();
	    $('.views-field-field-learn-image img', this).css('object-position', '0% ' + pos);
	});
    }

    $(".learn-acc .views-row").click(function(event) {
	$(".learn-acc .views-row a").click(function(e) { //when a link is clicked, don't accordion
            e.stopPropagation();
	});
	$(".learn-acc .views-row .learn-image-input").click(function(e) {
            e.stopPropagation();
	});
	if (getSelection().toString().length > 0) { //check if user is trying to highlight text
		return;
	}
	if ($('.views-field-field-learn-image', this).is($('#learn-expanded'))) {
	    $('#learn-expanded').removeAttr('style');
	    $('#learn-expanded').removeAttr('id');
	}
	else {
	    $('#learn-expanded').removeAttr('style');
	    $('#learn-expanded').removeAttr('id');
	    $('.views-field-field-learn-image', this).attr('id', 'learn-expanded');
	    setSize();
	}
    });
});

/*resize learn item on window resize*/
$(window).resize(function() {
    setSize();
});

function setSize() { //find the max height of any accordion text and set an expanded item
    var size = 0;
	$('.learn-acc .learn-acc-body-link').each(function() {
	    var maxH = $(this).outerHeight();
	    if (maxH > size) {
		size = maxH;
	    }
	});
    size += 150;
    $('#learn-expanded').css('height', size);
    $('.learn-acc img').css('height', size); //set image to be proper size to utilize object position
}

/*Staging Page image position input boxes*/

$(document).ready(function() {
    if ($(".learn-acc-staging")[0]) {
	$(".learn-acc .views-row").each(function() {
	    var newDiv = $("<div/>")
		.addClass("learn-image-input")
		.html('Image position:&nbsp;<input type="number" min="0" max="100">');
	    $(this).append(newDiv);
	});
    }
    $('.learn-image-input').on('input', function() { //restrict input to 0 to 100
	var inVal = $('input', this)
	if (inVal.val() > 100) {
	    inVal.val(100);
	}
	if (inVal.val() < 0) {
	    inVal.val(0);
	}
	$(this).parent().find('img').css('object-position', '0% ' + inVal.val() + '%');
    });
});
