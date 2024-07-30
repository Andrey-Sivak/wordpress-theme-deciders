jQuery(document).ready(function ($) {
	if (window.matchMedia('(min-width: 767px)').matches) {
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

	const $window = $(window);
	const $container = $('.layout-grid.layout-4');
	const $posts = $('.ds-post');
	const $infoBlocks = $('.info-block-1, .info-block-2');
	let currentPostIndex = 0;
	let isFullscreenMode = false;

	function initMobileView() {
		if (window.matchMedia('(max-width: 767px)').matches) {
			setupMobileScrolling();
		} else {
			resetToDesktopView();
		}
	}

	function setupMobileScrolling() {
		$window.on('scroll', handlePageScroll);
		$container.on('scroll', debounce(handlePostScroll, 50));
		$posts.on('touchstart', handleTouchStart);
		$posts.on('touchmove', handleTouchMove);
	}

	function resetToDesktopView() {
		$window.off('scroll');
		$container.off('scroll');
		$posts.off('touchstart touchmove');
		$container.removeClass('fullscreen-mode');
		isFullscreenMode = false;
	}

	function handlePageScroll() {
		if (isFullscreenMode) return;

		const infoBlocksHeight = $infoBlocks
			.toArray()
			.reduce((total, el) => total + $(el).outerHeight(), 0);
		const firstPostTop = $posts.first().offset().top;
		const scrollTop = $window.scrollTop();
		const windowHeight = $window.height();

		if (scrollTop + windowHeight > firstPostTop + windowHeight / 2) {
			enterFullscreenMode();
		}
	}

	function enterFullscreenMode() {
		isFullscreenMode = true;
		$container.addClass('fullscreen-mode');
		$('html, body').animate(
			{ scrollTop: $posts.first().offset().top },
			300,
		);
		setTimeout(() => {
			$window.off('scroll');
			currentPostIndex = 0;
			scrollToPost(currentPostIndex);
		}, 300);
	}

	function handlePostScroll() {
		if (!isFullscreenMode) return;
		const scrollTop = $container.scrollTop();
		currentPostIndex = Math.round(scrollTop / window.innerHeight);
		// You can add additional logic here, like updating URL or analytics
	}

	let touchStartY = 0;

	function handleTouchStart(e) {
		if (!isFullscreenMode) return;
		touchStartY = e.originalEvent.touches[0].clientY;
	}

	function handleTouchMove(e) {
		if (!isFullscreenMode) return;
		const touchEndY = e.originalEvent.touches[0].clientY;
		const diff = touchStartY - touchEndY;

		if (Math.abs(diff) > 50) {
			// Minimum swipe distance
			if (diff > 0 && currentPostIndex < $posts.length - 1) {
				// Swipe up, go to next post
				scrollToPost(currentPostIndex + 1);
			} else if (diff < 0 && currentPostIndex > 0) {
				// Swipe down, go to previous post
				scrollToPost(currentPostIndex - 1);
			}
			e.preventDefault();
		}
	}

	function scrollToPost(index) {
		const $targetPost = $posts.eq(index);
		const scrollTo =
			$targetPost.offset().top -
			$container.offset().top +
			$container.scrollTop();
		$container.animate(
			{
				scrollTop: scrollTo,
			},
			300,
		);
		currentPostIndex = index;
	}

	// Debounce function to limit scroll event firing
	function debounce(func, wait) {
		let timeout;
		return function () {
			const context = this,
				args = arguments;
			clearTimeout(timeout);
			timeout = setTimeout(() => func.apply(context, args), wait);
		};
	}

	// Initialize
	initMobileView();
	$window.on('resize', initMobileView);
});
