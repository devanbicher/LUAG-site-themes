$=jQuery;

$(document).ready(function() {
    setTimeout(function(){
	$(".hidden").removeClass("hidden");
    }, 200);
});
$(document).ready(function() {
    $('a:has(*)').css('background-image','none');
    $('a:has(> strong)').css('background-image','linear-gradient(to bottom, var(--link-light) 0%, var(--link-light) 100%)');
});
