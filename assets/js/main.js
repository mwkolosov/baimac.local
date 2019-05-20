
'use strict';

(function($)
{
	$(document).ready(function()
	{
        $('.owl-carousel').owlCarousel({
            margin:10,
            nav:false,
			dotsData:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })





		$(window).trigger('resize')
	})




	$(window)

	.on('resize', function()
	{
		
	})

	.on('scroll', function()
	{
		
	})

	.on('touchmove', function()
	{
		
	})






	$.fn.reCheckbox = function()
	{
		$(this).each(function()
		{
			var checkboxCnt = $("<div>", { class: "recheckbox" })
				.append(
					$("<span>", {
						class: "header",
						text: $(this).attr('title')
					})
				)
				.append(
					$("<span>", { class: "levers" })
					.append( $("<span>", { class: "lever lever-off" }) )
					.append( $("<span>", { class: "lever lever-on" }) )
				)

			checkboxCnt.on('click', function()
			{
				$(this).prev().prop('checked', !$(this).prev().prop('checked') ).trigger('change')
			})

			$(this).after( checkboxCnt )
			$(this).on('remove', function() { checkboxCnt.remove() })
		})
	};



	$.fn.reSelect = function()
	{
		$(this).each(function()
		{
			var checkboxCnt = $("<div>", { class: "reselect" })
			if( $(this).attr('title') )
				checkboxCnt.append( $("<label>", { text: $(this).attr('title') }) )
			$(this).after( checkboxCnt ).appendTo( checkboxCnt )
		})
	};



	function drawModal( header )
	{
		var popover = $("<div>", { class: "popover-modal" })
			.append(
				$("<div>", {
					class: "backlay",
					click: function( e )
					{
						if( !$(e.target).closest(".overlay").length )
						{ $(this).closest(".popover-modal").fadeOut(function(){ $(this).remove() }) }
					}
				})
				.append(
					$("<div>", { class: "overlay" })
					.append(
						$("<h2>", {
							class: "main-header",
							text: header
						})
					)
					.append( $("<div>", { class: "cnt" }) )
				)
			)
			.appendTo( $("body") )
			.fadeIn()

		popover.on('close', function()
		{
			$(this).closest(".popover-modal").children(".backlay").trigger('click')
		})

		return popover.find(".cnt")
	};
})
(jQuery);



function includeModule( module ) { $.getScript('/assets/js/modules/'+ module +'.js') }
function getCookie( name) { var matches = document.cookie.match(new RegExp( "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)" )); return matches ? decodeURIComponent(matches[1]) : undefined; }
function setCookie( name, value, options ) { options = options || { expries: 31536000, path: "/" }; var expires = options.expires; if (typeof expires == "number" && expires) { var d = new Date(); d.setTime(d.getTime() + expires * 1000); expires = options.expires = d; } if (expires && expires.toUTCString) { options.expires = expires.toUTCString(); } value = encodeURIComponent(value); var updatedCookie = name + "=" + value; for (var propName in options) { updatedCookie += "; " + propName; var propValue = options[propName]; if (propValue !== true) { updatedCookie += "=" + propValue; } } document.cookie = updatedCookie; }
function getSuffix( one, three, many, count ) { return ( count < 10 ? (count == 1 ? one : (count > 1 & count < 5 ? three : many ) ) : (count > 10 && count < 21 ? many : (count % 10 == 1 ? one : (count % 10 > 1 & count % 10 < 5 ? three : many ) ) ) ); }