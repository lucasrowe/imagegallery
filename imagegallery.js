$('.swipebox').swipebox();

$('#mygallery').justifiedGallery({
    lastRow : 'nojustify',
    rowHeight : 200,
    rel : 'gallery2',
    margins : 1
}).on('jg.complete', function () {
    $('.swipebox').swipebox();
});

$(window).scroll(function() {
  if($(window).scrollTop() + $(window).height() == $(document).height()) {
    for (var i = 0; i < 5; i++) {
      $('#mygallery').append('<a class="gallery swipebox" href="photos/kitten.jpg">' +
          '<img src="photos/kitten.jpg" />' +
          '</a>');
    }
    $('#mygallery').justifiedGallery('norewind');
  }
});
