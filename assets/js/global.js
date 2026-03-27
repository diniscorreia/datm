/* Author: Ricardo Mestre

*/

$(document).ready(function(){
/*
    $('#page').pulse({
    backgroundColor: ['red', 'yellow', 'green', 'blue'],
    opacity: [0, 1],
    });
*/
/*
$('#page0').pulse({
                opacity: [0,1]
            }, {
                times: 999999    
            });
*/

});

(function($) {
	$(function() {
		$twitter = $('#latest-tweets');
		
		if ($twitter.length) {
			$twitter.find('.item-list-wrapper').tweet({
				username: $twitter.data('username'),
				count: $twitter.data('count'),
				loading_text: "loading tweets..."
			});
		}
	});
}(jQuery))