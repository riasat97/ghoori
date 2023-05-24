{{ HTML::script('growl/js/classie.js') }}
{{ HTML::script('growl/js/notificationFx.js') }}
{{ HTML::script('public/js/fbscript.js?v=1.2') }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<!-- {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js') }} -->
<script type="text/javascript">
function renderPriceWithCommas() {
	$( ".pricewithcomma" ).each(function( index ) {

	  var x = $( this ).text();
	  $( this ).text(addCommas(x));

	});
}

function addCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function removeCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(",", "");
    return parts.join(".");
}

$(function () {
	renderPriceWithCommas();
});
</script>