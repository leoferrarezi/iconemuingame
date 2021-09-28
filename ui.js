$(function() {
	$('a.BasicOver img').hover(
		function() {
			this.src = this.src.replace( /.png$/, '_on.png' );
		},
			function() {
			this.src = this.src.replace( /_on\.png$/, '.png' );
		}
	);
});

var layer_menu=0
function showHide(id) {
	if (layer_menu==0) {
		layer_menu=1
		document.getElementById(id).style.display="block";
	} else {
		layer_menu=0
		document.getElementById(id).style.display="none";
	}
}