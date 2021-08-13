import * as lib from '@inc/libs'

export default function (){
  let btns = $('.hover-block--btns');
  let postMore = $('.post-grid--more');

  if (!lib.is_elem(btns)) return false;

  btns.on('click', 'a', function (evt) {
    evt.preventDefault();
    let btn = $(this);
    console.log(btn);
    let parent = btn.parents('.post-grid-last');
    let btnLess = parent.find('.show-less');
    let btnMore = parent.find('.show-less');

    if (btn.hasClass('show-more')){
      btnLess.addClass('hidden');
      postMore.fadeIn();
      btnMore.removeClass('hidden');
      parent.addClass('post-grid-last--less')
    } else{
      btnLess.removeClass('hidden');
      postMore.fadeOut(200, function () {
        btnMore.addClass('hidden');
        parent.removeClass('post-grid-last--less')
      });
    }

  });

}