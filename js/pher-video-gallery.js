
( function( $, elementor ) {
	"use strict";
// console.log("loaded pheriche video gallery script");

// Brutally check teh body for mutations, to watch for the IFRAME appearing.
 let mList =document.getElementsByTagName("BODY")[0];

 let options = {
   childList: true,
   attributes: true,
   characterData: false,
   subtree: false,
   attributeFilter: ['one', 'two'],
   attributeOldValue: false,
   characterDataOldValue: false
 };
 let observer = new MutationObserver(mCallback);

 function mCallback(mutations) {
   for (let mutation of mutations) {
     if (mutation.type === 'childList') {
			// NOW GO LOOKING IN THE DOM FOR THE LIGHTBGOX
			let videoEl =	document.getElementById("elementor-lightbox");
			if(document.body.contains(videoEl)){
				console.log('the lightbox has instantiated');
				console.log(videoEl);
				doVideoFrame(videoEl);
			}//endif
     }
   }
 }

 observer.observe(mList, options);

function doVideoFrame(videoEl){
	//console.log('checking');
	let theiframe = videoEl.querySelector('iframe');
	console.log('is there a frame ? ' + theiframe);

	var iframe = videoEl.querySelector('iframe');
	var player = new Vimeo.Player(iframe);
	//player.play()
	var promise = player.play();

	player.on('play', function() {
		console.log('Played the video');
  });

}


}( jQuery, window.elementorFrontend ) );