// Вернуть данные с елемента
window.LG = 992;
window.MD = 768;
window.SM = 720;
window.XS = 576;
window.WIDTH_SCREEN = document.documentElement.clientWidth;

export function getDataJSON($el) {
  let data = $el.data('json');

  if (data){
    data = JSON.parse(data);
  } else {
    data = {};
  }
  return data;
}

/* libs */
/* Формат числа на группы */
export function number_format(_number, _decimal, _separator=null) {
  _decimal = _decimal || 0;
  _separator = _separator!==null ? _separator : ' ';
  _number = _number || 0;
  var decimal = (typeof (_decimal) != 'undefined') ? _decimal : 2;
  var separator = (typeof (_separator) != 'undefined') ? _separator : '';
  var r = parseFloat(_number);
  var exp10 = Math.pow(10, decimal);
  r = Math.round(r * exp10) / exp10;
  var rr = Number(r).toFixed(decimal).toString().split('.');
  var b = rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g, "\$1" + separator);
  r = (rr[1] ? b + '.' + rr[1] : b);
  return r;
}

export function is_elem(elem) {

  if (!elem){
    return false;
  }
  if (elem instanceof jQuery || elem instanceof NodeList){
    return elem.length > 0;
  }
  else if(typeof elem == 'string'){
    return $(elem).length > 0;
  }

  return !!elem;
}

/* Get random */
export function getRandom(min, max) {
  // случайное число от min до (max+1)
  let rand = min + Math.random() * (max + 1 - min);
  return Math.floor(rand);
}

/* Get browser */

export function getJsonData(data){
  if (data){
    data = JSON.parse(data);
  } else {
    data = {};
  }
  return data;
}


export function getBrowser() {
  var sBrowser, sUsrAg = navigator.userAgent;

//The order matters here, and this may report false positives for unlisted browsers.

  if (sUsrAg.indexOf("Firefox") > -1) {
    sBrowser = "Firefox";
    //"Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:61.0) Gecko/20100101 Firefox/61.0"
  } else if (sUsrAg.indexOf("Opera") > -1) {
    sBrowser = "Opera";
  } else if (sUsrAg.indexOf("Trident") > -1) {
    sBrowser = "IE";
    //"Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; .NET4.0C; .NET4.0E; Zoom 3.6.0; wbx 1.0.0; rv:11.0) like Gecko"
  } else if (sUsrAg.indexOf("Edge") > -1) {
    sBrowser = "Edge";
    //"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36 Edge/16.16299"
  } else if (sUsrAg.indexOf("Chrome") > -1) {
    sBrowser = "Chrome";
    //"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/66.0.3359.181 Chrome/66.0.3359.181 Safari/537.36"
  } else if (sUsrAg.indexOf("Safari") > -1) {
    sBrowser = "Safari";
    //"Mozilla/5.0 (iPhone; CPU iPhone OS 11_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1 980x1306"
  } else {
    sBrowser = "unknown";
  }
  return sBrowser;
}


export function getPlatform() {
  var userDeviceArray = [
    {device: 'Android', platform: /Android/},
    {device: 'iPhone', platform: /iPhone/},
    {device: 'iPad', platform: /iPad/},
    {device: 'Symbian', platform: /Symbian/},
    {device: 'Windows Phone', platform: /Windows Phone/},
    {device: 'Tablet OS', platform: /Tablet OS/},
    {device: 'Linux', platform: /Linux/},
    {device: 'Windows', platform: /Windows NT/},
    {device: 'Macintosh', platform: /Macintosh/}
  ];

  var platform = navigator.userAgent;
  for (var i in userDeviceArray) {
    if (userDeviceArray[i].platform.test(platform)) {
      return userDeviceArray[i].device;
    }
  }
  return 'Unkown';
}

/**
 * Определить операционную систему
 * */
export function getOS(){
  if (navigator.appVersion.indexOf('Windows')>=0) return 'Windows';
  if (navigator.appVersion.indexOf('Linux')>=0) return 'Linux';
  if (navigator.appVersion.indexOf('Sun')==0) return 'SunOS';
}


/**
 * Добавить и удалить класс через определенное время
 * */
export function blinkClass($el, className, time = 1000) {
  if (!is_elem($el) && !className)
    return '';
  $el.addClass(className);
  setTimeout(function () {
    if ($el.hasClass(className)){
      $el.removeClass(className)
    }
  }, time)
}

export function getGlobalData() {
  let elem = document.querySelector('.sc-global-data')
  if (!elem)
    return {};

  return JSON.parse(elem.textContent);
}


/**
 * Парсин строки ГЕТ
 * */
export function _GET(key) {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const params = Object.fromEntries(urlSearchParams.entries());

  if (!key)
    return params;

  return params[key];
}

export function sendAjax(filter, successAJAX, beforeSendAJAX, error) {
  // Для adminAJAX
  filter.nonce = makeeScript.nonce;
  filter.action = 'makee_ajax_posts';
  $.ajax({
    type: "POST",
    url: makeeScript.ajaxurl,
    success: successAJAX,
    beforeSend: beforeSendAJAX,
    error: error,
    async: true,
    data: filter,
    dataType: 'JSON',
  });
}