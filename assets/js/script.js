// Wrap every letter in a span
$('.ml10 .letters').each(function(){
  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
});

anime.timeline({loop: false})
  .add({
    targets: '.ml10 .letter',
    rotateY: [-90, 0],
    duration: 1300,
    delay: function(el, i) {
      return 45 * i;
    }
  })
//    .add({
//    targets: '.ml10',
//    opacity: 0,
//    duration: 1000,
//    easing: "easeOutExpo",
//    delay: 1000
//  })
;