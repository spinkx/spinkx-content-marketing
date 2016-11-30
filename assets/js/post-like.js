jQuery(document).ready(function() {

	jQuery(".post-like a").click(function(){
	
		heart = jQuery(this);
	
		post_id = heart.data("post_id");
		
		jQuery.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
			success: function(count){
				if(count != "already")
				{
					heart.addClass("voted");
					heart.siblings(".count").text(count);
				}
			}
		});
		
		return false;
	})
})