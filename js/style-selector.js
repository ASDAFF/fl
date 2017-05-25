;(function($){
	'use strict';
	var SiteSaoPreview = {
		init: function(){
			var preview = $('.sitesao-preview'),
				wrapper = $('#wrapper');
			$(document).on('click','.sitesao-preview__control',function(e){
				 e.stopPropagation();
				 e.preventDefault();
				if(preview.hasClass("view")){
					preview.removeClass('view').stop(true,true).animate({left:-205+'px'},1000);
				}else{
					preview.addClass('view').stop(true,true).animate({left:0},1000);
				}
			});
			
			preview.find('select[data-name="layout-style"]').change(function(){
				wrapper.removeAttr('class').attr('class',$(this).val()+'-wrap');
				$('body').css({'background-image':''});
				$(document).trigger('dh-change-layout');
				
			});
			
			
			$(document).on('click','.sitesao-preview__content__section__bg-pattern a',function(e){
				 e.stopPropagation();
				 e.preventDefault();
				 $('body').css({'background-image':''});
				if(wrapper.hasClass('boxed-wrap')){
					$('body').css({'background-image':'url(' + $(this).data('pattern') + ') '});
				}
			});
			
			var buy_now = $("<div />").addClass("sitesao__buy-now").css({
				'bottom': '-70px',
			    'opacity': '0.8',
			    'position': 'fixed',
			    'right': '100px',
			    'text-align': 'center',
			    'z-index': '99999',
			    'width': '140px'
			});

			//$("body").append(buy_now);
			buy_now.delay(2000).animate({ bottom: "0" }, 300);
		}
	};
	$(document).ready(function(){
		SiteSaoPreview.init();
	});
})(jQuery);