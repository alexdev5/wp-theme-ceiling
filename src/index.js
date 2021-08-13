

import './scss/styles.scss';

import * as lib from '@inc/libs'
import {Helpers} from "@inc/helpers";
import modalInit from "@js/modal";
import filterInit from "@js/filter";
import typeViewInit from "@js/view-type";
import slidersInit from "@js/sliders";
import homeInit from "@js/home";

window.addEventListener('load', function () {
  modalInit();
  showFullText();
  filterInit();
  typeViewInit();
  slidersInit();
  videoPlayerBg();
  homeInit();
});

function showFullText() {
  let p = $('.text-open-bottom, .text-open-bottom-js');
  p.on('click touchstart', function (evt) {
    let coords = this.getBoundingClientRect();

    let y = evt.clientY - coords.y;
    let bottomClick = coords.height - y;
    if (bottomClick>60)
      return;

    $(this).removeClass('text-open-bottom');

    //$(this)
  });
}

function videoPlayerBg() {
  setTimeout(function () {
    //$('.vidbacking').vidbacking();
  },1000);
}

/**
 *
 * */



