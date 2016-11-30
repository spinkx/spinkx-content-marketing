	/* <![CDATA[ */

	// Masonry
	jQuery.noConflict()(function($){
				$(document).ready(function() {

					var $container = $('#blog-entry');

					$container.imagesLoaded(function(){
			  			$container.masonry({
							itemSelector: '.masonry-box',
							isAnimated: true,
						});
					});

					// Infinite Scroll

			$container.infinitescroll({
				navSelector  : '.pagination',    // selector for the paged navigation 
				nextSelector : '.pagination a',  // selector for the NEXT link (to page 2)
				itemSelector : '.masonry-box',     // selector for all items you'll retrieve
				maxPage	: 4,
				loading : {
					finishedMsg: ( typeof ct_localization_infinite != 'undefined' || ct_localization_infinite != null ) ? ct_localization_infinite.no_posts : "No more posts to show.",
					img: '../images/ajax-loader.gif'
				}
			},

			// trigger Masonry as a callback
			function( newElements ) {
				var $newElems = $( newElements ).css({ opacity: 0 });

				$newElems.imagesLoaded(function()   {
					$newElems.animate({ opacity: 1 });
					$container.masonry( 'appended', $newElems, true );

					
					// post like system
					$(".post-like a").click(function() {

						heart = $(this);
						post_id = heart.data("post_id");

						$.ajax({
							type: "post",
							url: ajax_var.url,
							data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
							success: function(count){
								if(count != "already") {
									heart.addClass("voted");
									heart.siblings(".count").text(count);
								}
							}
						});
						return false;
					}) // end post like system
				});
			});
				});
	});

	jQuery.noConflict()(function($){
		$(window).resize(function() {
			var $container = $('#blog-entry');
			$container.masonry();
		});

		$(window).load(function() {
			var $container = $('#blog-entry');
			$container.masonry();
		});

		window.onresize = function() {
			var $container = $('#blog-entry');

			if ( $(window).width() <= 1200 ) {
				//console.log(window.innerWidth);
				//console.log('nontumb');

				$( "#blog-entry article" ).removeClass( "col1 col2 col3" );
				$( "#blog-entry article" ).addClass( "three_columns" );

	  			$container.masonry({
					itemSelector: '.masonry-box',
					isAnimated: true,
										columnWidth: 0
				});
			} else {
				//console.log('tumb');
	  			$container.masonry({
										itemSelector: '.masonry-box',
										isAnimated: true,
									});
			}
		}
		
	});

	/* ]]> */
	
	
	/* <![CDATA[ */
var ct_localization_infinite = {"loading_posts":"<em>Loading the next set of posts...<\/em>","no_posts":"No more posts to show."};
/* ]]> */
