
import * as lib1 from '@inc/libs'

import Swiper from 'swiper/bundle';
// core version + navigation, pagination modules:
//import SwiperCore, { Navigation, Pagination } from 'swiper/core';
import {is_elem} from "@inc/libs";

// configure Swiper to use modules
//SwiperCore.use([Navigation, Pagination]);

// import Swiper from 'swiper/bundle'; - полностью скрипт

export default function () {
  // lazy load
  let imgs = document.querySelectorAll('img.swiper-lazy');
  imgs.forEach(el=>{
    let $el = $(el);
    let src = $el.data('src');
    if (MD>WIDTH_SCREEN){
      // mobile
      src = $el.data('src-mobile');
    }
    $el.attr('src', src);
    $el.parent().find('.swiper-lazy-preloader').remove();
  });

  //
  sliderSlider();
  portfolioSlider();
  setPortfolioSliderMobile();

  /*
*/
}


function portfolioSlider() {

  const sliders = document.querySelectorAll('.portfolio-slider .swiper-container');

  if (!sliders)
    return;

  //



  sliders.forEach(el=>{
    let elSetting = lib1.getJsonData(el.dataset.settings);

    let data = {
      slidesPerView: "auto",
      spaceBetween: 35,
      loop:true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },

      pagination: {
        el: ".swiper-pagination",
        clickable:true,
        // type: "progressbar",
      },

      navigation: {
        nextEl: '.axslider-button--next',
        prevEl: '.axslider-button--prev',
      },
      breakpoints: {
        // when window width is >= 640px
        720: {
          slidesPerView: 'auto',
          spaceBetween: 40
        }
      },
    };

    data.slidesPerView = elSetting.slidesPerView;
    data.spaceBetween = elSetting.spaceBetween;

    data.breakpoints['720'].slidesPerView = elSetting.slidesPerView;
    data.breakpoints['720'].spaceBetween = elSetting.spaceBetween;

    new Swiper(el, data);
  });


}

/**
 * Post type = sliders
 * Для кастомного типа поста
 * */
function sliderSlider() {

  let sliders = document.querySelectorAll('.sliders .swiper-container');

  if (!sliders)
    return;

  sliders.forEach(el=>{
    let elSetting = lib1.getJsonData(el.dataset.settings);

    let data = {
      slidesPerView: "auto",
      spaceBetween: 35,
      loop:true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },

      pagination: {
        el: ".swiper-pagination",
        clickable:true,
        // type: "progressbar",
      },

      navigation: {
        nextEl: '.axslider-button--next',
        prevEl: '.axslider-button--prev',
      },

      // And if we need scrollbar
      scrollbar: {
        el: '.swiper-scrollbar',
      },
      // Responsive breakpoints
      breakpoints: {
        576: {
          slidesPerView: 'auto',
          spaceBetween: 30
        },
        // when window width is >= 640px
        720: {
          slidesPerView: 'auto',
          spaceBetween: 40
        }
      },
    };

    let assign = Object.assign(data, elSetting);

    if (getKey(elSetting, 'slidesPerView')){
      assign.breakpoints['720'].slidesPerView = parseInt(getKey(elSetting, 'slidesPerView'));
      assign.breakpoints['576'].slidesPerView = 3;
    }
    if (getKey(elSetting, 'disableOnInteraction')){
      assign.autoplay.disableOnInteraction = getKey(elSetting, 'disableOnInteraction');
    }


    if (elSetting.disableMobile &&  XS>WIDTH_SCREEN){
      let parents = $(el).parent('.sliders');
      parents
        .find('.swiper-slide')
        .addClass('no-swiper-slide')
        .removeClass('swiper-slide');
      parents
        .find('.swiper-wrapper')
        .addClass('no-swiper-wrapper')
        .removeClass('swiper-wrapper');

    } else{
      new Swiper(el, assign);
    }

  });

}

function getKey(obj, key) {
  if (obj.hasOwnProperty(key)){
    return obj[key];
  }

  return false;
}

// Запуск слайдера на мобильном дна странице "портфолио"
function setPortfolioSliderMobile() {
  if (XS<WIDTH_SCREEN){
    return false;
  }

  let divs = document.querySelectorAll('.portfolio-grid > [data-slider]');
  if (!is_elem(divs)){
    return false;
  }

  divs.forEach(el=>{
    let child = el.querySelector('.portfolio-item--image');
    let imgs = el.dataset.slider;
    let block = createSlider(lib1.getJsonData(imgs));

    $(child).empty().append(block);
  });

  //return;
  new Swiper('.portfolio-slider-mobile', {
    slidesPerView: "auto",
    spaceBetween: 20,
    loop:true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },

    pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },

    navigation: {
      nextEl: '.axslider-button--next',
      prevEl: '.axslider-button--prev',
    },
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });
}

/**
 * Создать слайд
 * */
// $data - array
function createSlide(url) {
  return `<div class="swiper-slide">
   <img src="${url}" alt="" width="280" height="280">
</div>`;
}

/**
 * Создать контейнер лайдера
 * */
function createSlider($data) {
  // $data - array

  let html = `<div class="swiper-container portfolio-slider-mobile">
         <div class="swiper-wrapper">`;

  $data.forEach(el=> {
    // el - url
    html += createSlide(el);
  });

  html += `</div>
        <div class="swiper-pagination"></div>
        <div class="axslider-button">
           <div class="axslider-button--prev">
              <img src="/wp-content/plugins/ax-sortcodes/assets/img/arrow-left.svg" alt="">
           </div>
           <div class="axslider-button--next">
              <img src="/wp-content/plugins/ax-sortcodes/assets/img/arrow-right.svg" alt="">
           </div>
        </div>
      </div>`;

  return html;
}