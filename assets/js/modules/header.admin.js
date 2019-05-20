(function($)
{
	var mdElement, mdElementPos

	$(document).ready(function()
	{
		mdElement = $("#md-header-admin a")
		mdElementPos = getCookie('md.header.admin.position')

		$(window).trigger('resize')

		mdElement.addClass("loaded").draggable({
			containment: "parent",
			snap: "#md-header-admin",
			snapTolerance: mdElement.width()/2,
			stop: function(e, ui)
			{
				mdElementPos = JSON.stringify( ui.offset )
				setCookie('md.header.admin.position', mdElementPos)
			}
		})
	})

	$(window).on('resize', function()
	{
		if( mdElement && mdElementPos )
		{
			var top = JSON.parse( mdElementPos ).top,
				left = JSON.parse( mdElementPos ).left,
				offset = $("#md-header-admin").offset().left + 1

			top = top < 0 ?
				offset :
				( top > $(window).height() - offset - mdElement.height() ?
					$(window).height() - offset - mdElement.height() :
					top 
				)

			left = left < 0 ?
				offset :
				( left > $(window).width() - offset - mdElement.width() ?
					$(window).width() - offset - mdElement.width() :
					left 
				)

			mdElement.css({ top: top, left: left })
		}
	})
})
(jQuery)