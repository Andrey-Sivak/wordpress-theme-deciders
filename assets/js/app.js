jQuery(document).ready(function ($) {
	const setupGrid =
		(window.matchMedia('(min-width: 767px)').matches &&
			document.body.classList.contains('home')) ||
		(document.body.classList.contains('single') &&
			(window.matchMedia('(min-width: 1280px)').matches ||
				window.matchMedia('(max-width: 1024px)').matches) &&
			window.matchMedia('(min-width: 767px)').matches);

	if (setupGrid) {
		const grid = document.querySelector('.layout-grid');
		const items = grid.querySelectorAll('.masonry-item');

		const msnry = new Masonry(grid, {
			itemSelector: '.masonry-item',
			columnWidth: '.grid-sizer',
			percentPosition: true,
			gutter: 22,
		});

		// Initial arrangement
		rearrangeItems(msnry);

		// Rearrange on window resize
		window.addEventListener('resize', rearrangeItems);

		imagesLoaded(grid).on('progress', function () {
			// layout Masonry after each image loads
			msnry.layout();
		});

		function rearrangeItems(msnry) {
			if (window.matchMedia('(max-width: 1279px)').matches) {
				// Move the first item to the third position
				if (items.length >= 3) {
					grid.insertBefore(items[0], items[2].nextSibling);
				}
			} else {
				// Restore original order
				grid.insertBefore(items[0], grid.firstChild);
			}
			msnry.reloadItems();
			msnry.layout();
		}

		return;
	}

	// TODO: temporarily for home page only.
	if (!document.body.classList.contains('home')) return;

	const posts = document.querySelectorAll('.ds-post');
	const pnls = posts.length;
	let scdir,
		hold = false;
	const well = document.querySelector('.layout-grid');
	const infoBlock2 = document.querySelector('.info-block-2');
	const firstPost = document.querySelector('.ds-post');
	let isFullscreenMode = false;

	function _scrollY(obj) {
		var slength,
			plength,
			pan,
			step = 100,
			vh = window.innerHeight / 100,
			vmin = Math.min(window.innerHeight, window.innerWidth) / 100;
		if (
			(this !== undefined && this.id === 'well') ||
			(obj !== undefined && obj.id === 'well')
		) {
			pan = this || obj;
			plength = parseInt(pan.offsetHeight / vh);
		}
		if (pan === undefined) {
			return;
		}
		plength = plength || parseInt(pan.offsetHeight / vmin);
		slength = parseInt(pan.style.transform.replace('translateY(', ''));
		if (scdir === 'up' && Math.abs(slength) < plength - plength / pnls) {
			slength = slength - step;
		} else if (scdir === 'down' && slength < 0) {
			slength = slength + step;
		} else if (scdir === 'down' && slength === 0) {
			slength = 0;
			disableFullscreenMode();
		} else if (scdir === 'top') {
			slength = 0;
		}

		if (hold === false) {
			hold = true;
			pan.style.transform = 'translateY(' + slength + 'vh)';
			setTimeout(function () {
				hold = false;
			}, 1000);
		}
		console.log(
			scdir +
				':' +
				slength +
				':' +
				plength +
				':' +
				(plength - plength / pnls),
		);
	}

	function _swipe(obj) {
		var swdir,
			sX,
			sY,
			dX,
			dY,
			threshold = 100,
			slack = 50,
			alT = 500,
			elT,
			stT;

		obj.addEventListener(
			'touchstart',
			function (e) {
				var tchs = e.changedTouches[0];
				swdir = 'none';
				sX = tchs.pageX;
				sY = tchs.pageY;
				stT = new Date().getTime();
			},
			false,
		);

		obj.addEventListener(
			'touchmove',
			function (e) {
				if (isFullscreenMode) {
					e.preventDefault();
				}
			},
			false,
		);

		obj.addEventListener(
			'touchend',
			function (e) {
				var tchs = e.changedTouches[0];
				dX = tchs.pageX - sX;
				dY = tchs.pageY - sY;
				elT = new Date().getTime() - stT;
				if (elT <= alT) {
					if (Math.abs(dX) >= threshold && Math.abs(dY) <= slack) {
						swdir = dX < 0 ? 'left' : 'right';
					} else if (
						Math.abs(dY) >= threshold &&
						Math.abs(dX) <= slack
					) {
						swdir = dY < 0 ? 'up' : 'down';
					}

					if (obj.id === 'well') {
						if (swdir === 'up') {
							scdir = swdir;
							_scrollY(obj);
						} else if (
							swdir === 'down' &&
							obj.style.transform !== 'translateY(0)'
						) {
							scdir = swdir;
							_scrollY(obj);
						}
						e.stopPropagation();
					}
				}
			},
			false,
		);
	}

	function isElementInViewport(el) {
		const rect = el.getBoundingClientRect();

		return (
			rect.top <
				(window.innerHeight || document.documentElement.clientHeight) &&
			rect.bottom > 0 &&
			rect.left <
				(window.innerWidth || document.documentElement.clientWidth) &&
			rect.right > 0
		);
	}

	function handleScroll() {
		const wellRect = well.getBoundingClientRect();
		const infoBlock2Rect = infoBlock2.getBoundingClientRect();

		if (
			isElementInViewport(firstPost) &&
			infoBlock2Rect.bottom <= 0 &&
			!isFullscreenMode
		) {
			enableFullscreenMode();
		} else if (infoBlock2Rect.bottom > 0 && isFullscreenMode) {
			disableFullscreenMode();
		}
	}

	function enableFullscreenMode() {
		infoBlock2.style.marginBottom = 'calc(110vh)';
		isFullscreenMode = true;
		well.style.position = 'fixed';
		well.style.top = '0';
		well.style.left = '0';
		well.style.width = '100%';
		well.style.overflow = 'hidden';
		well.style.background = '#000';
		well.style.zIndex = 100000;
		document.body.style.overflow = 'hidden';
	}

	function disableFullscreenMode() {
		infoBlock2.style.marginBottom = 0;
		isFullscreenMode = false;
		well.style.position = '';
		well.style.top = '';
		well.style.left = '';
		well.style.width = '';
		well.style.overflow = '';
		document.body.style.overflow = '';
		well.style.background = 'transparent';
		well.style.zIndex = 'unset';
		well.style.transform = 'translateY(0)';
	}

	well.style.transform = 'translateY(0)';

	well.addEventListener('wheel', function (e) {
		if (isFullscreenMode) {
			e.preventDefault();
			if (e.deltaY < 0) {
				scdir = 'down';
			}
			if (e.deltaY > 0) {
				scdir = 'up';
			}
			_scrollY(well);
		}
	});

	_swipe(well);

	window.addEventListener('scroll', handleScroll);
	window.addEventListener('resize', handleScroll);

	var tops = document.querySelectorAll('.ds-post');
	for (var i = 0; i < tops.length; i++) {
		tops[i].addEventListener('click', function () {
			scdir = 'top';
			_scrollY(well);
		});
	}
});
