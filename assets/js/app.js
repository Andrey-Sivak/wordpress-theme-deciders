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

	const infoBlocks = document.querySelectorAll('.info-block');
	const posts = document.querySelectorAll('.ds-post');
	let isFullscreen = false;

	function checkFullscreenMode() {
		const scrollPosition = window.scrollY;

		const secondInfoBlockPosition =
			infoBlocks[1].getBoundingClientRect().bottom + window.scrollY;

		// if (scrollPosition > secondInfoBlockPosition && !isFullscreen) {
		// 	document.body.classList.add('fullscreen-mode');
		// 	posts.forEach((post) => post.classList.add('fullscreen'));
		// 	isFullscreen = true;
		// } else if (scrollPosition <= secondInfoBlockPosition && isFullscreen) {
		// 	document.body.classList.remove('fullscreen-mode');
		// 	posts.forEach((post) => post.classList.remove('fullscreen'));
		// 	isFullscreen = false;
		// }
	}

	// window.addEventListener('scroll', checkFullscreenMode);
	// window.addEventListener('resize', checkFullscreenMode);
	// checkFullscreenMode();
});
