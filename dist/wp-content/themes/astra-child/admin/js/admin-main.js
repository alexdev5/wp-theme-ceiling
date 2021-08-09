

window.onload = function () {

  // Выделим  другим цветом
  // Принимает массив елементов и шордкод, без []
  function setColorShortcode(elements, shortcode) {
    if(!shortcode || !elements)
      return false;

    let spanClass = 'shortcode';
    let dopClass = ' short-tag-' + shortcode;
    let classAll = spanClass + dopClass;
    // определим позицию курсора

    let regexp = new RegExp(`(\\[${shortcode}\\])([^\\[]+)?`, 'gi');
    let regexpBack = new RegExp('<span[^>]+>(\\[[^\\]]+\\])(\\s+)?<\\/[^>]+>', 'gm');

    if(elements.length && elements.length > 0){
      elements.forEach(function (el, idx) {
        let text = el.textContent;
        let ct = text.replace(regexp, '<span class="' + classAll +'">$1</span>$2');
        el.innerHTML = ct;
      });
    }
    else{
      let text = elements.innerHTML;
      let cursorPosition = getCursorPosition(elements);

      // Если нет совпадений - выход
      if(!text.match(regexp))
        return false;

      // Если уже вставлен span, выход
      if(text.match(regexpBack))
        return false;

      let ct = text.replace(regexp, '<span class="' + classAll +'">$1</span>$2');
      elements.innerHTML = ct;
      setCursorPosition(elements, cursorPosition);
    }



  }

  //
  let cursorPosition = 0;
  function setColor(color) {
    color = color || '#E29095';
    let shortcode = 'br';

    let gutenbergEditor = document.querySelector('.block-editor-block-list__layout');

    if(!gutenbergEditor)
      return false;

    let blocksText = document.querySelectorAll('.rich-text');

    if(!blocksText)
      return false;

    setColorShortcode(blocksText, shortcode, color);

    // Проверка шорткодов при нажатии
    let interval = null;
    blocksText.forEach(function (el) {
      el.addEventListener('input', function () {

        if(interval)
          clearTimeout(interval);

        interval = setTimeout(function () {
          setColorShortcode(el, shortcode, color);
        }, 300);

      });
    });


  }


  /* Получить позицию курсора */
  function getCursorPosition(parent) {
    let selection = document.getSelection();
    let range = new Range;
    range.setStart(parent, 0);
    range.setEnd(selection.anchorNode, selection.anchorOffset);
    return range.toString().length
  }

  /* Установить позицию курсора */
  function setCursorPosition(parent, position) {
    let child = parent.firstChild;
    while(position > 0) {
      let length = child.textContent.length;
      if(position > length) {
        position -= length;
        child = child.nextSibling
      }
      else {
        if(child.nodeType == 3) return document.getSelection().collapse(child, position)
        child = child.firstChild;
      }
    }
  }

  //setColor();

  /* Установить длинну блока по сетке */
  function setWidthGridBlock() {
    let blockWithClassGrid = document.querySelectorAll('.wp-block-columns');
    if(!blockWithClassGrid)
      return false;

    let col3 = document.querySelectorAll('.wp-block-column.col-3');
    let col9 = document.querySelectorAll('.wp-block-column.col-9');

    col3.forEach(function (el, idx) {
      console.log(el.parentElement);
      el.style.width = 100/12 * 3 + '%';
      el.style.flexBasis = 'auto';
    });
    col9.forEach(function (el, idx) {
      el.style.width = 100/12 * 9 + '%';
      el.style.flexBasis = 'auto';
    });

  }
  setWidthGridBlock();

};