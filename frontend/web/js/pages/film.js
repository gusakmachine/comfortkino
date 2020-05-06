$(document).ready(function() {

	var owl = $('.film-gallery__bottom-content').owlCarousel({
		margin:15,
		nav: true,
		navClass: ['film-gallery__btn --prev','film-gallery__btn --next'],
		navText: ["<svg><use href=\"/img/static/icons/icons.svg#arrow-empty\"></use></svg>","<svg><use href=\"/img/static/icons/icons.svg#arrow-empty\"></use></svg>"],
		items:1,
	});

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

	$('.film__poster, .film__trailer-preview').magnificPopup({
		type: 'image',
		mainClass: 'mfp-fade',
		showCloseBtn:false,
		navigateByImgClick: true,
	});

	$('.film__trailer').magnificPopup({
		type:'iframe',
		mainClass: 'mfp-fade',
		showCloseBtn:false,
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

	if ($('.film .flex-wrapper').length < 3) {
		$('.film__show-all-sessions-btn').hide();
	} else {
		$('.film__show-all-sessions-btn').click(function() {
			$('.film').removeClass('partially-hidden-content');
			$(this).parent().removeClass('max-height-on');
			$(this).detach();
		});
	}

});