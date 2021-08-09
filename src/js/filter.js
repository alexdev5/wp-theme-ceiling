import * as lib from '@inc/libs'

export default function () {
  let filterElement = document.querySelector('.type-filter');
  let $filterElement = $('.type-filter');

  let dataFilter = lib._GET('f');

  if (dataFilter){
    dataFilter = dataFilter.split(',');

    dataFilter.forEach(el=>{
      let _inp = $(`input[name="${el}"]`);
      if (lib.is_elem(_inp)){
        _inp.prop('checked', true);
      }
    });
  } else{
    // Отметить флажек "Все"
    $filterElement.find('input.all').prop('checked', true);
  }

  $filterElement.on('change', 'input', changeFilter);

  // Filter mobile
  if (MD<WIDTH_SCREEN)
    return false;

  let filterMobile = $('.filter-dropdown');
  filterMobile.on('click', function (evt) {
    console.log(22);
    $filterElement.slideToggle(400);

  });
}

/**
 * onChange filter
 * */
function changeFilter(evt){
  let el = $(this);
  let parent = el.parents('.type-filter');
  let linkDefault = parent.find('.all').data('link');


  let cats = [];
  let sign = '?';
  if (el.hasClass('all')){
    // Если категория "Все"
    cats = linkDefault;
  } else{
    sign = '&';
    let fields = parent.find('input:checked');

    fields.each(function (idx) {
      let name = $(this).attr('name');
      if (name){
        cats.push(name)
      }
    });

    cats = cats.join(',');

    if (cats){
      cats = `?f=${cats}`;
    } else{
      sign = '&';
      cats = linkDefault;
    }
  }

  if (lib._GET('view')){
    cats = `${cats}${sign}view=${lib._GET('view')}`
  }
  window.history.pushState({}, 'filter', cats);

  window.location.reload()

    // send
 /* lib.sendAjax({'cat':22}, res=>{
    console.log(res);
  });*/
  // send
}

function createCheckbox($data) {
  let html = ``;
  $data.forEach(el=>{
    html += `<label class="checkbox">`;
    html += `<input type="checkbox" name="${el.slug}" value="${el.id}" data-count="${el.count}">`;
    html += `<b><svg viewBox="0,0,50,50">
      <path d="M5 30 L 20 45 L 45 5"></path>
    </svg></b>`;
    html += `<span>${el.name}</span>`;
    html += `</label>`;
  });

  return html;
}

function createSelect($data) {

}

