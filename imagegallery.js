$('.swipebox').swipebox();

$('#mygallery').justifiedGallery({
    lastRow : 'nojustify',
    rowHeight : 200,
    rel : 'gallery2',
    margins : 1
}).on('jg.complete', function () {
    $('.swipebox').swipebox();
});
