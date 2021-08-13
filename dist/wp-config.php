<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'u828288623_maxwp' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'u828288623_maxwp' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'G_m9DfCYB' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/{n$H<dD`z+?k:?6pevi.pn-;a[x6nVy6Jmigg:$mVs~v)r7Hj.Vs*L J.SNjK=2' );
define( 'SECURE_AUTH_KEY',  'ex4s*Xw]WmQmmS0N~HS-Bz*q@p5X6|b]g7joU6tkA4Jn3g8l}jjDvHM$V!jVHQx=' );
define( 'LOGGED_IN_KEY',    'T)_dt,g26U]1}W/4gYO0jm~r2UX27O}Q>e_P0#P-aM|MNikISP%Mulg};y{uJ&w{' );
define( 'NONCE_KEY',        ' gR|Xxc]e[GBh[+oqpaU|=7pA/pm*./HYA$PlwbGET*V8`J_RGs*d=t9Dz185 LQ' );
define( 'AUTH_SALT',        '7Q*E[@UDl5/TN}KD=U<KWMJt[xkJiXkB +-o3eU/+Zk^,f5YH=M1lcEZlg;D),il' );
define( 'SECURE_AUTH_SALT', ',%&fRN%;u$*p`brr9kppp4H7!khl2PYq[Px#v?LBWpn`boZKuJ.@./%h0gv1P~9r' );
define( 'LOGGED_IN_SALT',   'm0b7(id*Nikywd#l*n &B^n-y(~#L*IPza=tiY0C&dDo&&K)-X4hB@9=a8]v-tv[' );
define( 'NONCE_SALT',       '5jadiWU7!2y8cowdzqsgOr4Zn)ViHcYn`h<!o>T95&n?? >^M5[m5fIMxi+tAUy~' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
define('WPCF7_AUTOP', false );


/* Отключение редактирования файлов в админке WP */
define('DISALLOW_FILE_EDIT', true);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
