$(document).ready(function() {

	$('.film-gallery__bottom-content').magnificPopup({
		delegate: 'a',
		type: 'image',
		mainClass: 'mfp-fade',
		showCloseBtn:false,
		navigateByImgClick: true,
		gallery: {
			arrowMarkup: '<button type="button" class="film-gallery__arrow film-gallery__arrow--%dir% mfp-arrow mfp-arrow-%dir%"></button>',
			enabled: true,
			tPrev: '',
			tNext: '',
			tCounter: ''
		},
		callbacks: {
			buildControls: function () {
				this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
			}
		},
	});

	$('.film__trailer').magnificPopup({
		type:'iframe',
		mainClass: 'mfp-fade',
		showCloseBtn:false,
	});

	$('.film__show-all-sessions-btn').click(function() {
		$(this).parent().removeClass('max-height-on');
		$(this).parent().find('.partially-hidden-content').removeClass();
		$(this).detach();
	});

	let galleryWrapper = $('.film-gallery__bottom-content');
	let scrollVal = galleryWrapper.width();

	$('.film-gallery__btn.--prev').bind('click', function () {
		galleryWrapper[0].scrollBy({
			top:0,
			left: -scrollVal,
			behavior: 'smooth'
		});
	});
	$('.film-gallery__btn.--next').bind('click', function () {
		galleryWrapper[0].scrollBy({
			top:0,
			left: scrollVal,
			behavior: 'smooth'
		});
	});

});