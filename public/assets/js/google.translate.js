(function ( $ ) {
		
	
	'use strict';

	function addClassTags(){
		$( "h1,h2,h3,h4,h5,h6,p,a,span,button" )
		.contents()
		.filter(function(){
			return this.nodeType !== 1;
		}).wrap( "<trans class=\"translate\"> </trans>" );
	};

	function translateTagsContent(){
		var elementsTr = $('.translate');
		elementsTr.each(function() {
			var myData = $(this).html();
			var mine = $(this);
			
				$.get("index.php?action=translate&data=" + myData + "&lang=ja", function(data) {
					console.log(data);
					mine.text(data);
					

				});
			
			});
	}
	$('#myLoader').css({'display':'block'});
	addClassTags();
	translateTagsContent();

	setTimeout(function()
	{
		$("#myLoader").css({'display':'none'});
	}, 5000);


}( jQuery ));

