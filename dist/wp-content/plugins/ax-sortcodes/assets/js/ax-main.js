
// Подгрузка постов
jQuery(function($){
  var $elemPosts = $('.symptoms-women.page-pms');

  var ajaxurl = $elemPosts.data('ajaxurl');
  var args = $('#args-posts-page').text();
  var current_page = $elemPosts.data('currentpage');
  var max_pages = $elemPosts.data('maxpages');
  var offsetOrigin = $elemPosts.data('offset');
  var offset = offsetOrigin;
  var ollObject = $elemPosts.find('.wp-block-column');

  $('#true_loadmore').click(function(){
    $(this).text('Загрузка...');
    // изменяем текст кнопки, вы также можете добавить прелоадер
    var data = {
      'action': 'loadmore',
      'args': args,
      'offset': offset,
      'numberposts': offsetOrigin,
    };
    $.ajax({
      url:ajaxurl, // обработчик
      data:data, // данные
      type:'POST', // тип запроса
      success:function(data){
        if( data ) {
          $('#true_loadmore').text('Загрузить ещё');

          $elemPosts.append(data);
          current_page++; // увеличиваем номер страницы на единицу
          offset += offsetOrigin;
          ollObject = $elemPosts.find('.wp-block-column');

          console.log(ollObject.length);
          console.log(offset);

          if (ollObject.length < offset) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
        } else {
          //$('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
        }
      }
    });
  });

  //
  function showDotsForTestPms() {
    var $testBlock = $('.wpProQuiz_content .wpProQuiz_quiz');
    var $testList = $('.wpProQuiz_content .wpProQuiz_quiz .wpProQuiz_list');

    if($testList.length == 0)
      return;

    var $testListItem = $testList.find('.wpProQuiz_listItem');
    var $dotsBlock = $('<div>', {
      class: 'wpProQuiz_dots'
    });

    for(var i = 0; i<$testListItem.length; i++){
      var $dot = $('<div>', { class: 'wpProQuiz_dots--dot' });
      $dotsBlock.append($dot);
    }

    $testBlock.append($dotsBlock);

    // отслеживаем клики по точкам
    var dots =  $('.wpProQuiz_dots--dot');
    /*dots.on('click', function (evt) {
      var _index = $(this).index();
      $testListItem.css('display', 'none');
      $testListItem.eq(_index).fadeIn();
    });*/

    // Отслеживаем нажатия на кнопки Next/Prev
    $testListItem.on('click', function (evt) {
      var _index = $(this).index();
      if(evt.target.classList.contains('wpProQuiz_button') && evt.target.getAttribute('name')=='next'){
        dots.eq(_index).addClass('-active-');
      }

    });
  }


  showDotsForTestPms();
});