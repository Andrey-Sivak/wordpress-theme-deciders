jQuery(document).ready(function ($) {
	const grid = document.querySelector('.layout-grid');
	const items = grid.querySelectorAll('.masonry-item');

	if (window.matchMedia('(min-width: 767px)').matches) {
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
	}

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
});
