	/*	   Waterfall Flow Code By: ONEO 2015.08.26
	NewWaterfall Flow Code By: ONEO 2016.10.25
------------------------------------------------------*/
(function($)
{
	$.fn.NewWaterfall = function(options)
	{
			var doc_width = jQuery(this).width();
			var marginLeft = 0;
			var dFlag = true;
			if( jQuery(document).width() <= 550 ) {
				jQuery('#spinkx-cont-popup .waterfall').attr('data-column', 2);
				actualwidth =  (100  - 9)  / 2;
				marginLeft = 3;
			} else if( jQuery(document).width() > 550  &&  jQuery(document).width() < 1024) {
				jQuery('#spinkx-cont-popup .waterfall').attr('data-column', 3);
				marginLeft = 2;
				actualwidth = ( 100 - 8 ) / 3;
			} else if( jQuery(document).width() >= 1024 ) {

				if(  options !== undefined && options.width > 0 ) {
					var actualwidth = options.width;
					var defaults = {
						width: actualwidth,
						delay: 60,
						repeatShow: false,
						height: options.height
					};
					dFlag = false;
				} else {
					var dataColumn = jQuery(this).attr('data-column');

					marginLeft = 0;
					if( dataColumn > 1 ) {
						marginLeft = 1 * dataColumn - 1;
						actualwidth = ( 100 - 7 ) / dataColumn;
					} else {
						actualwidth = 100;
					}

				}
			}
			
			if( dFlag ) {
				var defaults = {
					width: actualwidth,
					delay: 60,
					repeatShow: false
				};
			}
		//console.log(defaults);

		var config = $.extend({},defaults, options);

		var ul = this;
		// 功能
		var show = function(li)
		{
			if ($(window).scrollTop() + $(window).height() > $(li).offset().top)
			{
				$(li).addClass('show');
			}
			else if ($(window).scrollTop() + $(window).height() < $(li).offset().top)
			{
				if (config.repeatShow)
				{
					$(li).removeClass('show');
				}
			}
		}
		var refresh = function()
		{
			if(ul.length <= 0)
			{
				return;
			}

			ul.css({
				"position": "relative"
			});

			// 参数
			var lis = $(ul).children("li");

			if(lis.length <= 0)
			{
				return;
			}

			var ul_width = $(ul).width() - 17;
			var ul_column = parseInt(ul_width / config.width);
			ul_column = parseInt($(ul).attr('data-column'));

			if (lis.length < ul_column)
			{
				ul_column = lis.length;
			}
			
			var li_left = (ul_width - ul_column * config.width)/ul_column;
			//console.log("(ul_width = "+ul_width+"ul_column="+ul_column+"config.width"+config.width)

			if (ul_column > 0)
			{
				$(ul).removeClass('min');
				

				lis.css({
					"position": "absolute",
					"width": config.width+'%',

				});


				var maxHeight = 0;
				var list = []
				var nlist = []


				for (var i = 0; i < lis.length; i++)
				{

					list.push({
						"index": i,
						"bottom": 0,
						"height": $(lis[i]).height(),
					});
				}


				for (var i = 0; i < ul_column; i++)
				{
					nlist.push([]);
				}


				for (var i = 0; i < lis.length; i++)
				{
					if (i < ul_column)
					{
						list[i]["bottom"] = list[i]["height"];
						nlist[i].push(list[i]);
					}
					else
					{
						var b = 0;
						var l = 0;
						for (var j = 0; j < ul_column; j++)
						{
							var jh = nlist[j][nlist[j].length - 1]["bottom"] + list[i]["height"];
							if (b == 0 || jh < b)
							{
								b = jh;
								l = j;
							}
						}
						list[i]["bottom"] = b + 10;
						nlist[l].push(list[i]);
					}
				}


				for (var i = 0; i < nlist.length; i++)
				{
					for (var j = 0; j < nlist[i].length; j++)
					{

						if( i > 0) {

							$(lis[nlist[i][j]["index"]]).css({
								"left": ( i * config.width + marginLeft * i ) + '%',
								"top": nlist[i][j]["bottom"] - nlist[i][j]["height"],
							});
						} else {
							$(lis[nlist[i][j]["index"]]).css({
								"left": ( i * config.width ) + '%',
								"top": nlist[i][j]["bottom"] - nlist[i][j]["height"],
							});
						}

					}
				}

				// 设置最大高度
				for (var i = 0; i < nlist.length; i++)
				{
					var h = nlist[i][nlist[i].length -1]["bottom"];
					if (maxHeight < h)
					{
						maxHeight = h;
					}
				}
				$(ul).css("height",maxHeight);
				//$(ul).css("width","370px");
			}
			else
			{
				lis.attr("style","");
				ul.attr("style","");
				$(ul).addClass('min');
			}


			for (var i = 0; i < lis.length; i++)
			{
				show(lis[i]);
			}
		}
		
		// 刷新
		refresh();
		setInterval(refresh,config.delay);
	}
})(jQuery);