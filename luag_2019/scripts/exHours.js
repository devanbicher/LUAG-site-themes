$=jQuery;

$(document).ready(function() {
    $(".exhibition-header .gallery-toggle-wrap").click(function() {
	var wrapper = $(".exhibition-header .views-field-field-hours")[0];
	var arrow = $("#gallery-hours-arrow");
	if (wrapper) {
	    var wrapHeight = wrapper.scrollHeight;
	    if ($(wrapper).css("max-height") === "0px") {
		$(wrapper).css("max-height", wrapHeight + "px");
		$(wrapper).css("opacity", "1");
		$(wrapper).css("transition", "max-height .5s 0s, opacity .3s .3s");
		$(arrow).css("transform", "scaleY(-1)");
	    } else {
		$(wrapper).css("max-height", "0");
		$(wrapper).css("opacity", "0");
		$(wrapper).css("transition", "max-height .5s .2s, opacity .3s 0s");
		$(arrow).css("transform", "scaleY(1)");
	    }
	}
    });
});
