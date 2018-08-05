$(document).ready(function() {
"use strict";
	$('a').on('click', function() {
		if ($(this).attr('current') === $('input').val())
			{getTweets($('input').val());}
		else {
			$('#tweets').empty();
			getTweets($('input').val());
		}
	});

	function getTweets(dato) {
		$.ajax({
				url: "tweet.php",
				type: "POST",
				data: { param:dato },
				dataType: "json",
				success: function(data) {
						console.log(data);
						$('a').attr('current',$('input').val());

						$.each(data.statuses, function (index, tweet) {
						var $tweets = $('.tweet').first().clone();
							
							$.ajax({
								url: "operacionesDb.php",
								type: "POST",
								data: { id:tweet.user.id,
									   uname:tweet.user.screen_name,
									   name:tweet.user.name,
									   location:tweet.user.time_zone,
									   tw:tweet.text,
									   fecha3:tweet.user.created_at
									  },
								dataType: "text",
								success: function(data){
									console.log(data);
								},error:function(data){
									console.log();
								}
							});
						
							$tweets.find('.id').text(tweet.user.id);
							$tweets.find('.uname').text(tweet.user.screen_name);
							$tweets.find('.name').text(tweet.user.name);
							$tweets.find('.location').text(tweet.user.location);
							$tweets.find('.tw').text(tweet.text);
							$tweets.find('.date').text((tweet.created_at).substring(0, (tweet.created_at).length - 5));

						$tweets.hide().appendTo('#tweets').fadeIn();
					});
				}
			});
	}
});