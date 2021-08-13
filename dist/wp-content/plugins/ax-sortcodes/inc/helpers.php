<?

function var_dump_pre($args, $isDie = false){
	echo '<pre>';
	var_dump($args);
	echo '</pre>';
	if ($isDie){
		die;
	}
}

if (!function_exists('print_r_pre')){
	function print_r_pre($args){
		echo '<pre>';
		print_r($args);
		echo '</pre>';
	}
}

if (!function_exists('valueIf')){
	function valueIf($if, $value='', $else=''){
		if($if){
			if($value)
				return $value;
			else
				return $if;
		}
		else{
			return $else;
		}
	}
}


if (!function_exists('view')){
	function view($file, $args = [], $debug=false){
		if (is_array($args) && count($args))
			extract($args);

		if ($debug){
			var_dump_pre(AXSHORTCODES . 'tamplate/' . "$file.php");
		}

		ob_start();
		include AXSHORTCODES . 'tamplate/' . "$file.php";
		return ob_get_clean();
	}
}

if (!function_exists('userIsAdmin')){
	function userIsAdmin(){
		if( current_user_can( 'administrator') ){
			return true;
		}
		return false;
	}
}

function axGetOption($key){
	return get_option('options_'. $key);
}

function kama_excerpt( $args = '', $id = null ){
	$post = get_post($id);

	if(!$post)
		global $post;

	$str_len = 500;
	$_meta = get_post_meta($post->ID, 'news_preview', true);

	if( is_string($args) )
		parse_str( $args, $args );

	$rg = (object) array_merge( array(
		'maxchar'     => $str_len,   // Макс. количество символов.
		'text'        => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
		// Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется
		// все до <!--more--> вместе с HTML.
		'autop'       => false,  // Заменить переносы строк на <p> и <br> или нет?
		'save_tags'   => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
		'more_text'   => '', // Текст ссылки `Читать дальше`.
		'ignore_more' => false, // нужно ли игнорировать <!--more--> в контенте
	), $args );

	$rg = apply_filters( 'kama_excerpt_args', $rg );

	if( ! $rg->text )
		$rg->text = $_meta ?: $post->post_content;

	$text = $rg->text;
	// убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
	$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
	// убираем шоткоды: [singlepic id=3]. Учитывает markdown
	$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
	$text = trim( $text );

	// <!--more-->
	if( ! $rg->ignore_more  &&  strpos( $text, '<!--more-->') ){
		preg_match('/(.*)<!--more-->/s', $text, $mm );

		$text = trim( $mm[1] );

		$text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
	}
	// text, excerpt, content
	else {
		$text = trim( strip_tags($text, $rg->save_tags) );

		// Обрезаем
		if( mb_strlen($text) > $rg->maxchar ){
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1', $text ); // кил последнее слово, оно 99% неполное
		}
	}

	// сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $rg->autop ){
		$text = preg_replace(
			array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
			array('',     '</p><p>',  '<br />', '</p>'),
			$text
		);
	}

	$text = apply_filters( 'kama_excerpt', $text, $rg );

	if( isset($text_append) )
		$text .= $text_append;

	wp_reset_postdata();
	return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}