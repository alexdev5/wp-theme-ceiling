
import * as lib from '@inc/libs'

export default function () {
  /* Contact form 7 */
  checkSendForm();
  maskPhone();
  onClickCallbackButton();

  let modalCall = $('#modal-order');

  $('.btn-order').on('click', function (evt) {
    evt.preventDefault();

    modalCall.modal('show');
  });
}



function hideModal(modal, clearMessageSend) {
  setTimeout(function () {
    if(clearMessageSend){
      modal.find('.wpcf7-response-output').html('').hide(300, function () {
        //$(this).attr('style', 'display:none!important');
      });
    }
    modal.modal('hide');
  },600);
}

function checkSendForm() {
  var cf7 = $('.wpcf7');

// Успешная отправка формы
  cf7.on('wpcf7mailsent', function(event){

    let form = $(this);
    let successMessage = form.find('.wpcf7-response-output');
    let modal = form.find('.modal');
    let modalDialog = form.find('.modal-dialog');
    let modalBody = form.find('.modal-body');

    modalBody.append(successMessage.detach());

    //hideModal(modal, true);
    //hideModal(modal);
  });

// Неудачная отправка формы
  cf7.on('wpcf7invalid', function(event){
    console.log("неуспешно");
  });
}

function maskPhone() {
  var inputs = document.querySelectorAll(".form-call .wpcf7-text");
  //+38 (___) ___ - __ - __
  var im = new Inputmask("+38 (099) 999-99-99");
  im.mask(inputs);

  let callback = $('.form-call');
  let callbackForm = callback.parents('form');
  callbackForm.on('submit', function (evt) {
    evt.preventDefault();

    if (inputs.inputmask("isComplete")){
      console.log('complete');
    }
  })
}


function onClickCallbackButton() {
  let callback = $('.form-call');
  let callbackCF7 = callback.parents('.wpcf7');
  callbackCF7.addClass('form-call-cf');
  callback.css('display', 'block');

  let btn = $('.btn-callback');

  btn.on('click', function (evt) {
   // let coords = this.getBoundingClientRect();

    //
    if (callbackCF7.css('display')==='block'){
      callbackCF7.fadeOut(200, function () {
        callbackCF7.removeClass('marker-bottom');
      });
      return;
    } else{
      callbackCF7.fadeIn();
    }

    //
    let coords = getCoords(this);

    let style = {
      top: coords.bottom + 40,
      left: coords.right-callbackCF7.width(),
    };

    // Открыть внизу
    if (coords.bottom+callbackCF7.height() > document.documentElement.scrollWidth){
      callbackCF7.addClass('marker-bottom');
      style.top = coords.bottom-callbackCF7.height()-70;
    }

    // Для мобильного
    if (LG>WIDTH_SCREEN){
      style.left = coords.right-callbackCF7.width()+33;
    }

    callbackCF7.css(style);
  });

  // Закрыть форму
  callbackCF7.find('.btn-close').on('click', function (evt) {
    callbackCF7.fadeOut(200, function () {
      callbackCF7.removeClass('marker-bottom');
    });
  })
}

// получаем координаты элемента в контексте документа
function getCoords(elem) {
  let box = elem.getBoundingClientRect();

  return {
    top: box.top + pageYOffset,
    bottom: box.top + pageYOffset + box.height,
    left: box.left + pageXOffset,
    right: box.left + box.width,
  };
}
