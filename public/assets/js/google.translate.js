(function ( $ ) {
		
	
	'use strict';
	function browserLang(){
		var userLang = navigator.language || navigator.userLanguage;
		return userLang; 
	}

	function addClassTags(){
		$( "h1,h2,h3,h4,h5,h6,p,a,span,button" )
		.contents()
		.filter(function(){
			return this.nodeType !== 1;
		}).wrap( "<trans class=\"translate\"> </trans>" );
	};

	function translateTagsContent(lang){

		var elementsTr = $('.translate');
		elementsTr.each(function() {
			var myData = $(this).html();
			var mine = $(this);
			
				$.get("index.php?action=translate&data=" + myData + "&lang=" + lang, function(data) {
					console.log(data);
					mine.text(data);
					

				});
			
			});
	}

	function translateContent(){
		if (browserLang() == 'fr') {

		} else {
			$('#myLoader').css({'display':'block'});
			addClassTags();
			translateTagsContent(browserLang());

			setTimeout(function()
			{
				$("#myLoader").css({'display':'none'});
			}, 5000);
		}
	}

	translateContent();


}( jQuery ));

