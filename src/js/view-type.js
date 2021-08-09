import * as lib from '@inc/libs'

// button-view
export default function () {
  let btns = $('.button-view');
  let btn = btns.find('.wp-block-button');
  let linkDefault = $('.type-filter .all').data('link');
  // view-tiles
  // view-list
  if (lib._GET('view')==='list'){
    btns.find('.view-tiles').css('display', 'block');
  } else {
    btns.find('.view-list').css('display', 'block');
  }

  btns.on('click touchstart', '.wp-block-button__link', function (){
    let parent = $(this).parent();
    let get = lib._GET();
    let sign = '?';

    let url = get.f ? `?f=${get.f}` : '';

    if (parent.hasClass('view-list')){
      // list
      if (url){
        sign = '&';
      }
      url = url+`${sign}view=list`;

    }

    if (!url)
      url = linkDefault;


    window.history.pushState({}, 'filter', url);
    window.location.reload()
  });
}