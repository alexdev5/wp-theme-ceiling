import * as lib from '@inc/libs'

export default function (){
  let btns = $('.hover-block--btns > a');

  if (!lib.is_elem(btns)) return false;

  btns.on('click', 'a', function (evt) {
    let link = $(this);
    if (link.hasClass('show-more')){

    } else{

    }
  });

}