import PostScroller from './PostScroller.js';

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

	new PostScroller();
});
