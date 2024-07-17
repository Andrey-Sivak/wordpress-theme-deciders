jQuery(document).ready(function($) {
    var grid = document.querySelector('.layout-grid');

    var msnry = new Masonry( grid, {
        itemSelector: '.masonry-item',
        columnWidth: '.grid-sizer',
        percentPosition: true,
        gutter: 22
    });

    imagesLoaded( grid ).on( 'progress', function() {
        // layout Masonry after each image loads
        msnry.layout();
    });
});