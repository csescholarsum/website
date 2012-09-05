//tab effects

var TabbedContent = {
	init: function() {	
		$(".tab_item").mouseover(function() {
		
			var background = $(this).parent().find(".moving_bg");
			
			$(background).stop().animate({
				left: $(this).position()['left']
			}, {
				duration: 500
			});
			
			TabbedContent.slideContent($(this));
			
		});
	},
	
	slideContent: function(obj) {
		
		var margin = $(obj).parent().parent().find(".slide_content").width();
		margin = margin * ($(obj).prevAll().size() - 1);
		margin = margin * -1;

		//Select content class of tab id
		//alert($(obj).attr('id'));
		//alert( $(".slide_content ." + $(obj).attr('id')).css('height'));

		//$(".slide_content").css('height', $(".slide_content ." + $(obj).attr('id')).css('height'));
		$('.slide_content').stop().animate({
			height: $(".slide_content ." + $(obj).attr('id')).css('height')
		}, {
			duration: 200
		});


		$(obj).parent().parent().find(".tabslider").stop().animate({
			marginLeft: margin + "px"
		}, {
			duration: 300
		});
	}
}

$(document).ready(function() {
	TabbedContent.init();
});