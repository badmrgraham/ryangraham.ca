<?php
/** File: searchform.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * The template for displaying search forms
 *
 * @package Structr
 * @since Structr 1.0
 */

?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div><label class="screen-reader-text" for="s"><?php echo esc_html( 'Search for:', 'structr' ) ?></label>
		<input type="text" name="s" id="s" value="Type your search here ..." onfocus="if (this.value == 'Type your search here ...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Type your search here ...';}" />
		<button type="submit" class="search-submit structr-search-icon" id="searchsubmit" /></button>
	</div>
</form>
