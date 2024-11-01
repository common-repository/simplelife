<?php
/*
Plugin Name: SimpleLife
Plugin URI: http://kierandelaney.net/projects/simplelife/
Description: SimpleLife is a fully configurable simplepie based plugin to produce a lifestream on your wordpress powered blog. Makes use of the excellent <a href="http://simplepie.org/">SimplePie</a>. Either use the widget or place <code>&lt;?php if (function_exists('simplelife')) simplelife(); ?></code> in a page template.
Version: 1.2
Author: Kieran Delaney
Author URI: http://kierandelaney.net/

    Copyright 2007  Kieran Delaney  (email : hello@kierandelaney.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//code for stripos for php4 installations 
if (!function_exists("stripos")) {
    function stripos($haystack, $needle, $offset=0) {
        return strpos(strtolower($haystack), strtolower($needle), $offset);
    }
}


//timezone code
if (get_option('simple_tz')){
if (!function_exists("date_default_timezone_set")) {
  date_default_timezone_set(get_option('simple_tz'));   
}else{
   putenv('TZ='.get_option('simple_tz'));
}
}

//Function: Add Color Picker Javascript to admin head
add_action('admin_head', 'simple_title_colour_js');
function simple_title_colour_js() { 
echo '<script src="'.get_bloginfo('home').'/wp-content/plugins/simplelife/201a.js" type="text/javascript"></script>'; } 

//create options page
function simplelifeOptions() {
   if (function_exists('add_options_page')) {
		add_options_page('SimpleLife Options', 'SimpleLife', 8, basename(__FILE__), 'simplelifeOptionsPage');
    }
}

function simplelifeOptionsPage() {
  if (isset($_POST['info_update'])) { ?>
		<div id="message" class="updated fade">
		<p><strong>
<?php
                if($_POST['s_flickr']){
                   update_option('s_flickr', $_POST['s_flickr']);
                    if(!$_POST['flickrback'] || !$_POST['flickrtext']){
                    _e('Warning: You\'ve given me a Flickr ID - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                   update_option('flickrback', $_POST['flickrback']);
                   update_option('flickrtext', $_POST['flickrtext']);
                }else{
                   update_option('s_flickr', '');
                   update_option('flickrtext', '');
                   update_option('flickrback', '');
                }

                if($_POST['s_delicious']){
                   update_option('s_delicious', $_POST['s_delicious']);
                    if(!$_POST['delback'] || !$_POST['deltext']){
                    _e('Warning: You\'ve given me a Delicious Username - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                   update_option('delback', $_POST['delback']);
                   update_option('deltext', $_POST['deltext']);
                }else{
                   update_option('s_delicious', '');
                   update_option('deltext', '');
                   update_option('delback', '');
                }

                if($_POST['s_blog']){
                   update_option('s_blog', $_POST['s_blog']);
                    if(!$_POST['blogback'] || !$_POST['blogtext']){
                    _e('Warning: You\'ve given me a blog feed - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                    if(!$_POST['blogico']){
                    _e('Warning: You\'ve given me a blog feed - but you\'ve not chosen an icon!<br />', 'English');
                    }
                   update_option('blogico', $_POST['blogico']);
                   update_option('blogback', $_POST['blogback']);
                   update_option('blogtext', $_POST['blogtext']);

                }else{
                   update_option('s_blog', '');
                   update_option('blogtext', '');
                   update_option('blogback', '');
                   update_option('blogico', $_POST['blogico']);
                }

                if($_POST['s_twitter']){
                   update_option('s_twitter', $_POST['s_twitter']);
                    if(!$_POST['twitback'] || !$_POST['twittext']){
                    _e('Warning: You\'ve given me a Twitter Username - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                   update_option('twitback', $_POST['twitback']);
                   update_option('twittext', $_POST['twittext']);
                }else{
                   update_option('s_twitter', '');
                   update_option('twittext', '');
                   update_option('twitback', '');
                }

                if($_POST['s_lastfm']){
                   update_option('s_lastfm', $_POST['s_lastfm']);
                    if(!$_POST['lastback'] || !$_POST['lasttext']){
                    _e('Warning: You\'ve given me a Last.fm Username - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                   update_option('lastback', $_POST['lastback']);
                   update_option('lasttext', $_POST['lasttext']);
                }else{
                   update_option('s_lastfm', '');
                   update_option('lasttext', '');
                   update_option('lastback', '');
                }

                if($_POST['s_facebook']){
                   update_option('s_facebook', $_POST['s_facebook']);
                    if(!$_POST['faceback'] || !$_POST['facetext']){
                    _e('Warning: You\'ve given me a Facebook Status Feed - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                   update_option('faceback', $_POST['faceback']);
                   update_option('facetext', $_POST['facetext']);
                }else{
                   update_option('s_facebook', '');
                   update_option('facetext', '');
                   update_option('faceback', '');
                }

                if($_POST['simple_feed1']){
                   update_option('simple_feed1', $_POST['simple_feed1']);
                    if(!$_POST['simple_back1'] || !$_POST['simple_text1']){
                    _e('Warning: You\'ve added an additional feed (Exra Feed 1) - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                    if(!$_POST['simple_ico1']){
                    _e('Warning: You\'ve defined an additional feed - but you\'ve not chosen an icon!<br />', 'English');
                    }
                   update_option('simple_ico1', $_POST['simple_ico1']);
                   update_option('simple_back1', $_POST['simple_back1']);
                   update_option('simple_text1', $_POST['simple_text1']);
                }else{
                   update_option('simple_feed1', '');
                   update_option('simple_text1', '');
                   update_option('simple_back1', '');
                   update_option('simple_ico1', $_POST['simple_ico1']);
                }

                if($_POST['simple_feed2']){
                   update_option('simple_feed2', $_POST['simple_feed2']);
                    if(!$_POST['simple_back2'] || !$_POST['simple_text2']){
                    _e('Warning: You\'ve added an additional feed (Exra Feed 2) - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                    if(!$_POST['simple_ico2']){
                    _e('Warning: You\'ve defined an additional feed - but you\'ve not chosen an icon!<br />', 'English');
                    }
                   update_option('simple_ico2', $_POST['simple_ico2']);
                   update_option('simple_back2', $_POST['simple_back2']);
                   update_option('simple_text2', $_POST['simple_text2']);
                }else{
                   update_option('simple_feed2', '');
                   update_option('simple_text2', '');
                   update_option('simple_back2', '');
                   update_option('simple_ico2', $_POST['simple_ico2']);
                }

                if($_POST['simple_feed3']){
                   update_option('simple_feed3', $_POST['simple_feed3']);
                    if(!$_POST['simple_back3'] || !$_POST['simple_text3']){
                    _e('Warning: You\'ve added an additional feed (Exra Feed 3) - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                    if(!$_POST['simple_ico3']){
                    _e('Warning: You\'ve defined an additional feed - but you\'ve not chosen an icon!<br />', 'English');
                    }
                   update_option('simple_ico3', $_POST['simple_ico3']);
                   update_option('simple_back3', $_POST['simple_back3']);
                   update_option('simple_text3', $_POST['simple_text3']);
                }else{
                   update_option('simple_feed3', '');
                   update_option('simple_text3', '');
                   update_option('simple_back3', '');
                   update_option('simple_ico3', $_POST['simple_ico3']);
                }

                if($_POST['simple_feed4']){
                   update_option('simple_feed4', $_POST['simple_feed4']);
                    if(!$_POST['simple_back4'] || !$_POST['simple_text4']){
                    _e('Warning: You\'ve added an additional feed (Exra Feed 4) - but you\'ve not chosen all the style info!<br />', 'English');
                    }
                    if(!$_POST['simple_ico4']){
                    _e('Warning: You\'ve defined an additional feed - but you\'ve not chosen an icon!<br />', 'English');
                    }
                   update_option('simple_ico4', $_POST['simple_ico4']);
                   update_option('simple_back4', $_POST['simple_back4']);
                   update_option('simple_text4', $_POST['simple_text4']);
                }else{
                   update_option('simple_feed4', '');
                   update_option('simple_text4', '');
                   update_option('simple_back4', '');
                   update_option('simple_ico4', $_POST['simple_ico4']);
                }

                if($_POST['simple_flimit']){
                   update_option('simple_flimit', $_POST['simple_flimit']);
                }else{
                   update_option('simple_flimit', '0');
                }

                if($_POST['simple_cache']){
                   update_option('simple_cache', $_POST['simple_cache']);
                }else{
                   update_option('simple_cache', '0');
                }

                if($_POST['simplehovertext']){
                   update_option('simplehovertext', $_POST['simplehovertext']);
                }else{
                   _e('Warning: You\'ve not chosen a text color for the hover style. Things will get ugly.<br />', 'English');
                   update_option('simplehovertext', '');
                }

                if($_POST['simplehoverback']){
                   update_option('simplehoverback', $_POST['simplehoverback']);
                }else{
                   _e('Warning: You\'ve not chosen a background color for the hover style. Things will get ugly.<br />', 'English');
                   update_option('simplehoverback', '');
                }

                if($_POST['simple_hoverborder']){
                   update_option('simple_hoverborder', $_POST['simple_hoverborder']);
                }else{
                   _e('Warning: You\'ve not chosen a border color for the hover style. Things will get ineresting.<br />', 'English');
                   update_option('simple_hoverborder', '');
                }

                if($_POST['simple_time']){
                   update_option('simple_time', $_POST['simple_time']);
                }else{
                   _e('Warning: You\'ve not chosen a time format - resetting to default<br />', 'English');
                   update_option('simple_time', 'H:i');
                }

                if($_POST['simple_date']){
                   update_option('simple_date', $_POST['simple_date']);
                }else{
                   _e('Warning: You\'ve not chosen a date format - resetting to default<br />', 'English');
                   update_option('simple_date', 'M jS');
                }

                if($_POST['simple_tz']){
                   update_option('simple_tz', $_POST['simple_tz']);
                }else{
                   _e('Warning: You\'ve not chosen a timezone - using server default.<br />', 'English');
                   update_option('simple_tz', '');
                }


?>OPTIONS UPDATED
                </strong></p>
                </div>
<?php } ?>

<div id="colorpicker201" class="colorpicker201"></div>
  	<div class=wrap>
	<form method="post">
        <?php echo '<h2>SimpleLife Options</h2>'; ?>
        <?php _e('SimpleLife combines your data feeds (in <em>most</em> feed formats) from around the web, orders them, styles them and presents them as a Lifestream in your wordpress blog. After setting the options below, use the function <code>&lt;?php simplelife(); ?></code> - See the <a href="http://kierandelaney.net/blog/projects/simplelife/">SimpleLife WP Plugin Website</a> for documentation and updates. Insert your lifestream into your sidebar, or construct an entire recent web history all with one simple plugin. Read the instructions, and provide exactly what you are asked for - its not all usernames! Feel free to use the remaining spare feeds for any service I\'ve overlooked. Choosing a text and background colour for the entries in the lifestream will show you that color. Click update and the username box will give you a preview of the styles for that service.<br /><br />Remember, insert <code>&lt;?php simplelife(); ?></code> into any page template to insert the lifestream, or use the sidebar widget.<br /><br />For reference your server is running PHP version: <strong>', 'English'); echo phpversion(); ?></strong><br /><br />

	<table>
	  <tr><td><h3><?php _e('General Settings', 'English'); ?></h3></td>
          <td>&nbsp;</td></tr>
	  <tr><td><label for="simple_flimit"><?php _e('Max No. Of Items To Show (0 = Unlimited): ', 'English') ?></label></td><td><input type="text" name="simple_flimit" id="simple_flimit" maxlength="2" size="2" value="<?php if(get_option('simple_flimit')){ echo get_option('simple_flimit');} else { echo '0';} ?>" /></td></tr>
          <tr><td><label for="simple_cache"><?php _e('Cache Feeds For (Min): ', 'English') ?></label></td><td><input type="text" name="simple_cache" id="simple_cache" maxlength="2" size="2" value="<?php if(get_option('simple_cache')){ echo get_option('simple_cache');} else { echo '0';} ?>" /></td></tr>
<tr><td><label for="simple_time"><?php _e('Time Format: ', 'English') ?></label></td><td><input type="text" name="simple_time" id="simple_time" maxlength="10" size="10" value="<?php echo get_option('simple_time'); ?>" /></td></tr><tr><td>&nbsp;</td><td>Output: <strong><?php echo date(get_option('simple_time')); ?></strong></td></tr>	
<tr><td><label for="simple_date"><?php _e('Date Format: ', 'English') ?></label><br /><a href="http://uk3.php.net/date">Date/Time Format Documentation</a><br /><em>Update options to update time/date previews.</em></td><td><input type="text" name="simple_date" id="simple_date" maxlength="10" size="10" value="<?php echo get_option('simple_date'); ?>" /><br />Output: <strong><?php echo date(get_option('simple_date')); ?></strong></td></tr>
<tr><td><label for="simple_tz"><?php _e('Timezone: ', 'English') ?></label><br /><a href="http://uk3.php.net/manual/en/timezones.php">Timezones</a></td><td><input type="text" name="simple_tz" id="simple_tz" maxlength="20" size="20" value="<?php echo get_option('simple_tz'); ?>" /></td></tr>
	   <tr><td colspan=2><?php _e('<strong>Warning:</strong> Simplelife uses PHP5 to force a specific timezone. If you do not run on PHP5, in an attempt to be as wide reaching as possible Simplelife will attempt to set the environment variable. This occasionaly gets messy depending on your platform (some windows servers for example). <a href="http://php.net/#2007-07-13-1">PHP4 is dead anyway</a> - upgrade.', 'English') ?></td></tr>
   
           <tr><td><h3><?php _e('Hover Styles', 'English'); ?></h3></td>
           <td>&nbsp;</td></tr>	   
	   <tr><td colspan=2><?php _e('These are the styles that the lifestream entries will assume when you hover over them. The top and bottom have a 1px border, you can color the background and color the text.', 'English') ?></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simplehoverback','simplehoverback');">Select Background:</a>&nbsp;</td><td><input type="text" id="simplehoverback" name="simplehoverback" size="7" <?php if(get_option('simplehoverback')) echo 'style="background-color: '. get_option('simplehoverback') .';"'; ?> value="<?php echo get_option('simplehoverback') ?>"></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simplehovertext','simplehovertext');">Select Text:</a>&nbsp;</td><td><input type="text" id="simplehovertext" name="simplehovertext" size="7" <?php if(get_option('simplehovertext')) echo 'style="background-color: '. get_option('simplehovertext') .';"'; ?> value="<?php echo get_option('simplehovertext') ?>"></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simple_hoverborder','simple_hoverborder');">Select Border:</a>&nbsp;</td><td><input type="text" id="simple_hoverborder" name="simple_hoverborder" size="7" <?php if(get_option('simple_hoverborder')) echo 'style="background-color: '. get_option('simple_hoverborder') .';"'; ?> value="<?php echo get_option('simple_hoverborder') ?>"></td></tr>

	  <tr><td><h3><?php _e('Flickr Photos', 'English'); ?></h3></td>
	  <td>&nbsp;</td></tr>
          <tr><td><label for="s_flickr"><?php _e('Your Flickr ID (Try <a href="http://idgettr.com/">idgettr</a>): ', 'English') ?></label></td><td><input type="text" name="s_flickr" id="s_flickr" maxlength="20" size="20" <?php echo 'style="background-color: '. get_option('flickrback') .'; color: '. get_option('flickrtext') .';"'; ?> value="<?php if(get_option('s_flickr')) echo get_option('s_flickr'); ?>" /></td></tr>
          <tr><td><a href="javascript:onclick=showColorGrid2('flickrback','flickrback');">Select Background:</a>&nbsp;</td><td><input type="text" id="flickrback" name="flickrback" size="7" <?php if(get_option('flickrback')) echo 'style="background-color: '. get_option('flickrback') .';"'; ?> value="<?php echo get_option('flickrback') ?>"></td></tr>
          <tr><td><a href="javascript:onclick=showColorGrid2('flickrtext','flickrtext');">Select Text:</a>&nbsp;</td><td><input type="text" id="flickrtext" name="flickrtext" size="7" <?php if(get_option('flickrtext')) echo 'style="background-color: '. get_option('flickrtext') .';"'; ?> value="<?php echo get_option('flickrtext') ?>"></td></tr>

           <tr><td><h3><?php _e('del.icio.us Bookmarks', 'English'); ?></h3></td>
           <td>&nbsp;</td></tr>
	   <tr><td><label for="s_delicious"><?php _e('Your Delicious Username: ', 'English') ?></label></td><td><input type="text" name="s_delicious" id="s_delicious" maxlength="20" size="20" <?php echo 'style="background-color: '. get_option('delback') .'; color: '. get_option('deltext') .';"'; ?> value="<?php echo get_option('s_delicious'); ?>" /></td></tr>
           <tr><td><a href="javascript:onclick=showColorGrid2('delback','delback');">Select Background:</a>&nbsp;</td><td><input type="text" id="delback" name="delback" size="7" <?php if(get_option('delback')) echo 'style="background-color: '. get_option('delback') .';"'; ?> value="<?php echo get_option('delback') ?>"></td></tr>
           <tr><td><a href="javascript:onclick=showColorGrid2('deltext','deltext');">Select Text:</a>&nbsp;</td><td><input type="text" id="deltext" name="deltext" size="7" <?php if(get_option('deltext')) echo 'style="background-color: '. get_option('deltext') .';"'; ?> value="<?php echo get_option('deltext') ?>"></td></tr>
	        
           <tr><td><h3><?php _e('Personal Blog', 'English'); ?></h3></td>
           <td>&nbsp;</td></tr>
       	   <tr><td><label for="s_blog"><?php _e('Your Blog\'s Feed Address: ', 'English') ?></label></td><td><input type="text" name="s_blog" id="s_blog" maxlength="60" size="60" <?php echo 'style="background-color: '. get_option('blogback') .'; color: '. get_option('blogtext') .';"'; ?> value="<?php echo get_option('s_blog'); ?>" /></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('blogback','blogback');">Select Background:</a>&nbsp;</td><td><input type="text" id="blogback" name="blogback" size="7" <?php if(get_option('blogback')) echo 'style="background-color: '. get_option('blogback') .';"'; ?> value="<?php echo get_option('blogback') ?>"><br /></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('blogtext','blogtext');">Select Text:</a>&nbsp;</td><td><input type="text" id="blogtext" name="blogtext" size="7" <?php if(get_option('blogtext')) echo 'style="background-color: '. get_option('blogtext') .';"'; ?> value="<?php echo get_option('blogtext') ?>"></td></tr>
           <tr><td colspan=2><?php _e('The variable below is the filename (including extension) of your blog icon. You need to upload this to the <code>plugins/simplelife</code> directory. I\'ve included a samlple icon already which you are free to use or change.', 'English') ?></td></tr>
           <tr><td>Blog Icon Name:&nbsp;</td><td><input type="text" id="blogico" name="blogico" size="15" <?php if(get_option('blogico')) echo 'style="background-color: '. get_option('blogico') .';"'; ?> value="<?php echo get_option('blogico') ?>"></td></tr>

	   <tr><td><h3><?php _e('Twitter Status Updates', 'English'); ?></h3></td>
	   <td>&nbsp;</td></tr>
           <tr><td><label for="s_twitter"><?php _e('Your Twitter Feed: ', 'English') ?></label></td><td><input type="text" name="s_twitter" id="s_twitter" maxlength="60" size="60" <?php echo 'style="background-color: '. get_option('twitback') .'; color: '. get_option('twittext') .';"'; ?> value="<?php echo get_option('s_twitter'); ?>" /></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('twitback','twitback');">Select Background:</a>&nbsp;</td><td><input type="text" id="twitback" name="twitback" size="7" <?php if(get_option('twitback')) echo 'style="background-color: '. get_option('twitback') .';"'; ?> value="<?php echo get_option('twitback') ?>"></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('twittext','twittext');">Select Text:</a>&nbsp;</td><td><input type="text" id="twittext" name="twittext" size="7" <?php if(get_option('twittext')) echo 'style="background-color: '. get_option('twittext') .';"'; ?> value="<?php echo get_option('twittext') ?>"></td></tr>

	   <tr><td><h3><?php _e('Last.fm Music', 'English'); ?></h3></td>
           <td>&nbsp;</td></tr>	   
           <tr><td><label for="s_lastfm"><?php _e('Your Last.fm Username: ', 'English') ?></label></td><td><input type="text" name="s_lastfm" id="s_lastfm" maxlength="20" size="20" <?php echo 'style="background-color: '. get_option('lastback') .'; color: '. get_option('lasttext') .';"'; ?> value="<?php echo get_option('s_lastfm'); ?>" /></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('lastback','lastback');">Select Background:</a>&nbsp;</td><td><input type="text" id="lastback" name="lastback" size="7" <?php if(get_option('lastback')) echo 'style="background-color: '. get_option('lastback') .';"'; ?> value="<?php echo get_option('lastback') ?>"></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('lasttext','lasttext');">Select Text:</a>&nbsp;</td><td><input type="text" id="lasttext" name="lasttext" size="7" <?php if(get_option('lasttext')) echo 'style="background-color: '. get_option('lasttext') .';"'; ?> value="<?php echo get_option('lasttext') ?>"></td></tr>

	   <tr><td><h3><?php _e('Facebook Status Updates', 'English'); ?></h3></td>
           <td>&nbsp;</td></tr>	   
	   <tr><td colspan=2><?php _e('Facebooks easy, bu there are a few steps, as your status feed is prety well hidden! Go to your own facebook profile, go to your mini feed and choose "see all" from the top right. Now choose "Status Stories" from the right hand menu. Finally, bottom of the right hand menu, copy the link location of "My Status" and paste it here - ', 'English') ?></td></tr>
           <tr><td><label for="s_facebook"><?php _e('Facebook Feed Address: ', 'English') ?></label></td><td><input type="text" name="s_facebook" id="s_facebook" size="60" <?php echo 'style="background-color: '. get_option('faceback') .'; color: '. get_option('facetext') .';"'; ?> value="<?php echo get_option('s_facebook'); ?>" /></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('faceback','faceback');">Select Background:</a>&nbsp;</td><td><input type="text" id="faceback" name="faceback" size="7" <?php if(get_option('faceback')) echo 'style="background-color: '. get_option('faceback') .';"'; ?> value="<?php echo get_option('faceback') ?>"></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('facetext','facetext');">Select Text:</a>&nbsp;</td><td><input type="text" id="facetext" name="facetext" size="7" <?php if(get_option('facetext')) echo 'style="background-color: '. get_option('facetext') .';"'; ?> value="<?php echo get_option('facetext') ?>"></td></tr>

	   <tr><td><h3><?php _e('Extra Feed 1', 'English'); ?></h3></td>
           <td>&nbsp;</td></tr>	
	   <tr><td><label for="simple_feed1"><?php _e('Add the full address of any feed here -', 'English') ?></label></td><td><input type="text" name="simple_feed1" id="simple_feed1" size="60" <?php echo 'style="background-color: '. get_option('simple_back1') .'; color: '. get_option('simple_text1') .';"'; ?> value="<?php echo get_option('simple_feed1'); ?>" /></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simple_back1','simple_back1');">Select Background:</a>&nbsp;</td><td><input type="text" id="simple_back1" name="simple_back1" size="7" <?php if(get_option('simple_back1')) echo 'style="background-color: '. get_option('simple_back1') .';"'; ?> value="<?php echo get_option('simple_back1') ?>"></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simple_text1','simple_text1');">Select Text:</a>&nbsp;</td><td><input type="text" id="simple_text1" name="simple_text1" size="7" <?php if(get_option('simple_text1')) echo 'style="background-color: '. get_option('simple_text1') .';"'; ?> value="<?php echo get_option('simple_text1') ?>"></td></tr>
           <tr><td colspan=2><?php _e('The variable below is the filename (including extension) of your extra feed icon. You need to upload this to the <code>plugins/simplelife</code> directory.', 'English') ?></td></tr>
           <tr><td>Feed Icon:&nbsp;</td><td><input type="text" id="simple_ico1" name="simple_ico1" size="15" <?php if(get_option('simple_ico1')) echo 'style="background-color: '. get_option('simple_ico1') .';"'; ?> value="<?php echo get_option('simple_ico1') ?>"></td></tr>

	   <tr><td><h3><?php _e('Extra Feed 2', 'English'); ?></h3></td>
           <td>&nbsp;</td></tr>	
	   <tr><td><label for="simple_feed2"><?php _e('Add the full address of any feed here -', 'English') ?></label></td><td><input type="text" name="simple_feed2" id="simple_feed2" size="60" <?php echo 'style="background-color: '. get_option('simple_back2') .'; color: '. get_option('simple_text2') .';"'; ?> value="<?php echo get_option('simple_feed2'); ?>" /></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simple_back2','simple_back2');">Select Background:</a>&nbsp;</td><td><input type="text" id="simple_back2" name="simple_back2" size="7" <?php if(get_option('simple_back2')) echo 'style="background-color: '. get_option('simple_back2') .';"'; ?> value="<?php echo get_option('simple_back2') ?>"></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simple_text2','simple_text2');">Select Text:</a>&nbsp;</td><td><input type="text" id="simple_text2" name="simple_text2" size="7" <?php if(get_option('simple_text2')) echo 'style="background-color: '. get_option('simple_text2') .';"'; ?> value="<?php echo get_option('simple_text2') ?>"></td></tr>
           <tr><td colspan=2><?php _e('The variable below is the filename (including extension) of your extra feed icon. You need to upload this to the <code>plugins/simplelife</code> directory.', 'English') ?></td></tr>
           <tr><td>Feed Icon:&nbsp;</td><td><input type="text" id="simple_ico1" name="simple_ico2" size="15" <?php if(get_option('simple_ico2')) echo 'style="background-color: '. get_option('simple_ico2') .';"'; ?> value="<?php echo get_option('simple_ico2') ?>"></td></tr>

	   <tr><td><h3><?php _e('Extra Feed 3', 'English'); ?></h3></td>
	   <td>&nbsp;</td></tr>	
           <tr><td><label for="simple_feed3"><?php _e('Add the full address of any feed here -', 'English') ?></label></td><td><input type="text" name="simple_feed3" id="simple_feed3" size="60" <?php echo 'style="background-color: '. get_option('simple_back3') .'; color: '. get_option('simple_text3') .';"'; ?> value="<?php echo get_option('simple_feed3'); ?>" /></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simple_back3','simple_back3');">Select Background:</a>&nbsp;</td><td><input type="text" id="simple_back3" name="simple_back3" size="7" <?php if(get_option('simple_back3')) echo 'style="background-color: '. get_option('simple_back3') .';"'; ?> value="<?php echo get_option('simple_back3') ?>"></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simple_text3','simple_text3');">Select Text:</a>&nbsp;</td><td><input type="text" id="simple_text3" name="simple_text3" size="7" <?php if(get_option('simple_text3')) echo 'style="background-color: '. get_option('simple_text3') .';"'; ?> value="<?php echo get_option('simple_text3') ?>"></td></tr>
           <tr><td colspan=2><?php _e('The variable below is the filename (including extension) of your extra feed icon. You need to upload this to the <code>plugins/simplelife</code> directory.', 'English') ?></td></tr>
           <tr><td>Feed Icon:&nbsp;</td><td><input type="text" id="simple_ico1" name="simple_ico3" size="15" <?php if(get_option('simple_ico3')) echo 'style="background-color: '. get_option('simple_ico3') .';"'; ?> value="<?php echo get_option('simple_ico3') ?>"></td></tr>

	   <tr><td><h3><?php _e('Extra Feed 4', 'English'); ?></h3></td>
           <td>&nbsp;</td></tr>	
	   <tr><td><label for="simple_feed4"><?php _e('Add the full address of any feed here -', 'English') ?></label></td><td><input type="text" name="simple_feed4" id="simple_feed4" size="60" <?php echo 'style="background-color: '. get_option('simple_back4') .'; color: '. get_option('simple_text4') .';"'; ?> value="<?php echo get_option('simple_feed4'); ?>" /></td></tr>
           <tr><td><a href="javascript:onclick=showColorGrid2('simple_back4','simple_back4');">Select Background:</a>&nbsp;</td><td><input type="text" id="simple_back4" name="simple_back4" size="7" <?php if(get_option('simple_back4')) echo 'style="background-color: '. get_option('simple_back4') .';"'; ?> value="<?php echo get_option('simple_back4') ?>"></td></tr>
	   <tr><td><a href="javascript:onclick=showColorGrid2('simple_text4','simple_text4');">Select Text:</a>&nbsp;</td><td><input type="text" id="simple_text4" name="simple_text4" size="7" <?php if(get_option('simple_text4')) echo 'style="background-color: '. get_option('simple_text4') .';"'; ?> value="<?php echo get_option('simple_text4') ?>"></td></tr>
           <tr><td colspan=2><?php _e('The variable below is the filename (including extension) of your extra feed icon. You need to upload this to the <code>plugins/simplelife</code> directory.', 'English') ?></td></tr>
           <tr><td>Feed Icon:&nbsp;</td><td><input type="text" id="simple_ico4" name="simple_ico4" size="15" <?php if(get_option('simple_ico4')) echo 'style="background-color: '. get_option('simple_ico4') .';"'; ?> value="<?php echo get_option('simple_ico4') ?>"></td></tr>
</table>

     <div class="submit"><input type="submit" name="info_update" value="<?php _e('Update Options', 'English'); ?> &raquo;" /></div>
</form>
</div>

<?php   
}

function simplelife(){

?>
<div id="simplelife">
<!-- Lifestream-->
<ul>

<style type="text/css">
/* Lifestream Style Info Below */
#simplelife ul a:link, #simplelife ul a:visited {
	text-decoration: none;
	color: #000;
}

#simplelife ul, #simplelife li, #simplelife ol {
	margin: 0;
	padding: 0;
        width: 95%
}

#simplelife ul {	
	list-style-type: none;
	list-style-position: outside;
}

/* Date Format */
ul .date {
  display: block;
  width: 100%;
  color: #444;
  font-size: 1.5em;
  text-align: left;
  padding: 0 0 1px 0 ! important;
  margin: 10px 0 0 0 !important;
  border-top: 1px solid #fff;	
  border-bottom: 1px solid #AAA3A1;
  font-weight: bold;
}

/* Time Format */
ul .time {
padding: 0 0 0 5px !important;
color: #555;
font-weight: bold;
}

#simplelife li a:link, #simplelife li a:visited {
  display: block;
  margin: 0;
  width: 100%;
  padding: 1px 35px;
}

/* Classes for all links - define your extra classes below */
a.delicious {
  border-top: 1px solid <?php echo get_option('delback'); ?> !important;	
  border-bottom: 1px solid <?php echo get_option('delback'); ?> !important;
  background: <?php echo get_option('delback'); ?> url(http://del.icio.us/favicon.ico) no-repeat 10px 50% !important;
  color: <?php echo get_option('deltext'); ?> !important;
}

a.flickr {
  background: <?php echo get_option('flickrback') ?> url(<?php echo get_bloginfo('home'); ?>/wp-content/plugins/simplelife/flickr.gif) no-repeat 10px 50% !important;
  border-top: 1px solid <?php echo get_option('flickrback') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('flickrback') ?> !important;
  color: <?php echo get_option('flickrtext') ?> !important;
}

a.lastfm {
  background: <?php echo get_option('lastback') ?> url(<?php echo get_bloginfo('home'); ?>/wp-content/plugins/simplelife/lastfm.png) no-repeat 10px 50% !important;
  border-top: 1px solid <?php echo get_option('lastback') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('lastback') ?> !important;
  color: <?php echo get_option('lasttext') ?> !important;
}

a.facebook {
  background: <?php echo get_option('faceback') ?> url(http://www.facebook.com/favicon.ico) no-repeat 10px 50% !important;
  border-top: 1px solid <?php echo get_option('faceback') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('faceback') ?> !important;
  color: <?php echo get_option('facetext') ?> !important;
}

a.blog {
  background: <?php echo get_option('blogback') ?> url(<?php echo get_bloginfo('home'); ?>/wp-content/plugins/simplelife/<?php echo get_option('blogico'); ?>) no-repeat 10px 50% !important;
  border-top: 1px solid <?php echo get_option('blogback') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('blogback') ?> !important;
  color: <?php echo get_option('blogtext') ?> !important;
}

a.twitter {
  background: <?php echo get_option('twitback') ?> url(http://www.twitter.com/favicon.ico) no-repeat 10px 50% !important;
  border-top: 1px solid <?php echo get_option('twitback') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('twitback') ?> !important
  color: <?php echo get_option('twittext') ?> !important;
}

a.simple_feed1 {
  background: <?php echo get_option('simple_back1') ?> url(<?php echo get_bloginfo('home'); ?>/wp-content/plugins/simplelife/<?php echo get_option('simple_ico1'); ?>) no-repeat 10px 50% !important;
  border-top: 1px solid <?php echo get_option('simple_back1') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('simple_back1') ?> !important
  color: <?php echo get_option('simple_text1') ?> !important;
}

a.simple_feed2 {
  background: <?php echo get_option('simple_back2') ?> url(<?php echo get_bloginfo('home'); ?>/wp-content/plugins/simplelife/<?php echo get_option('simple_ico2'); ?>) no-repeat 10px 50% !important;
  border-top: 1px solid <?php echo get_option('simple_back2') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('simple_back2') ?> !important
  color: <?php echo get_option('simple_text2') ?> !important;
}

a.simple_feed3 {
  background: <?php echo get_option('simple_back3') ?> url(<?php echo get_bloginfo('home'); ?>/wp-content/plugins/simplelife/<?php echo get_option('simple_ico3'); ?>) no-repeat 10px 50% !important;
  border-top: 1px solid <?php echo get_option('simple_back3') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('simple_back3') ?> !important
  color: <?php echo get_option('simple_text3') ?> !important;
}

a.simple_feed4 {
  background: <?php echo get_option('simple_back4') ?> url(<?php echo get_bloginfo('home'); ?>/wp-content/plugins/simplelife/<?php echo get_option('simple_ico4'); ?>) no-repeat 10px 50% !important;
  border-top: 1px solid <?php echo get_option('simple_back4') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('simple_back4') ?> !important
  color: <?php echo get_option('simple_text4') ?> !important;
}

/* Hover for all links */
#simplelife li a:hover {
  background: <?php echo get_option('simplehoverback') ?> !important;
  border-top: 1px solid <?php echo get_option('simple_hoverborder') ?> !important;	
  border-bottom: 1px solid <?php echo get_option('simple_hoverborder') ?> !important;
  color: <?php echo get_option('simplehovertext') ?> !important;
}
</style>


<?php

$df = '';
$ff = '';
$bf = '';
$lf = ''; 
$fbf = '';
$tf = '';
$f1 = '';
$f2 = '';
$f3 = '';
$f4 = '';

if(get_option('s_delicious')) $df = 'http://del.icio.us/rss/' . get_option('s_delicious');
if (get_option('s_flickr')) $ff = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . get_option('s_flickr') .'&lang=en-us&format=rss_200';
if(get_option('s_blog')) $bf = get_option('s_blog');
if (get_option('s_lastfm')) $lf = 'http://ws.audioscrobbler.com/1.0/user/'. get_option('s_lastfm') .'/recenttracks.rss';
if(get_option('s_facebook')) $fbf = get_option('s_facebook');
if(get_option('s_twitter')) $tf = get_option('s_twitter');
if(get_option('simple_feed1')) $f1 = get_option('simple_feed1');
if(get_option('simple_feed2')) $f2 = get_option('simple_feed2');
if(get_option('simple_feed3')) $f3 = get_option('simple_feed3');
if(get_option('simple_feed4')) $f4 = get_option('simple_feed4');

$feeds = array($df, $ff, $bf, $lf, $fbf, $tf, $f1, $f2, $f3, $f4);
$feeds = array_diff($feeds, array(""));

$feed = new SimplePie($feeds, CACHEDIR, 60*get_option('simple_cache'));

// Set up date variable.
$stored_date = '';
 
// Go through all of the items in the feed
foreach ($feed->get_items(0,get_option('simple_flimit')) as $item)
{
	// What is the date of the current feed item?
	$item_date = $item->get_date(get_option('simple_date'));
        $class = 'delicious';
 
	// Is the item's date the same as what is already stored?
	// - Yes? Don't display it again because we've already displayed it for this date.
	// - No? So we have something different.  We should display that.
	if ($stored_date != $item_date)
	{
		// Since they're different, let's replace the old stored date with the new one
		$stored_date = $item_date;
 		// Display it on the page
		echo '<li class="date">' . $stored_date . '</li>' . "\r\n";
	}

        //Decide where the link came from and set class accordingly.
        //Just add an extra if section, with a segment of the permalink to set a new class.
        //EG, flickr feed links to flickr.com delicious links everywhere, so we treat any unknown as delicious link, but anything containing flickr.com as flickr.

$url = $item->get_permalink();

if (stripos($url, 'flickr') !== false) {
    $class = 'flickr';
} 
if (stripos($url, 'facebook') !== false) {
    $class = 'facebook';
}
if (stripos($url, 'last') !== false) {
  $class = 'lastfm';
}
if (stripos($url, substr(get_option('s_blog'), 5,9)) !== false) {
    $class = 'blog';
}
if (stripos($url, substr(get_option('simple_feed1'), 5,9)) !== false) {
    $class = 'simple_feed1';
}
if (stripos($url, substr(get_option('simple_feed2'), 5,9)) !== false) {
    $class = 'simple_feed2';
}
if (stripos($url, substr(get_option('simple_feed3'), 5,9)) !== false) {
    $class = 'simple_feed3';
}
if (stripos($url, substr(get_option('simple_feed4'), 5,9)) !== false) {
    $class = 'simple_feed4';
}


// Display the feed item	
echo '<li class="item"><a class="' . $class . '" href="' . $item->get_permalink() . '"><span class="time">' . $item->get_date(get_option('simple_time')) . '</span> ' . $item->get_title() . '</a></li>' . "\r\n"; 

}
?>
</ul>
<br />
<br />
<em>Lifestream powered by <a href="http://kierandelaney.net/blog/projects/simplelife/">wp_SimpleLife</a> by <a href="http://kierandelaney.net/blog/">K</a>. </em>
</div>
<?php }

//set initial defaults for feeds
add_option('s_flickr', '');
add_option('flickrback', '');
add_option('flickrtext', '');

add_option('s_delicious', '');
add_option('delback', '');
add_option('deltext', '');

add_option('s_blog', '');
add_option('blogback', '');
add_option('blogtext', '');
add_option('blogico', 'blog.gif');

add_option('s_twitter', '');
add_option('twitback', '');
add_option('twittext', '');

add_option('s_lastfm', '');
add_option('lastback', '');
add_option('lasttext', '');

add_option('s_facebook', '');
add_option('faceback', '');
add_option('facetext', '');

add_option('simple_feed1', '');
add_option('simple_back1', '');
add_option('simple_text1', '');
add_option('simple_ico1', '');

add_option('simple_feed2', '');
add_option('simple_back2', '');
add_option('simple_text2', '');
add_option('simple_ico2', '');

add_option('simple_feed3', '');
add_option('simple_back3', '');
add_option('simple_text3', '');
add_option('simple_ico3', '');

add_option('simple_feed4', '');
add_option('simple_back4', '');
add_option('simple_text4', '');
add_option('simple_ico4', '');

add_option('simplehoverback', '');
add_option('simplehovertext', '');
add_option('simple_hoverborder', '');

add_option('simple_flimit', '0');
add_option('simple_cache', '15');

add_option('simple_time', 'H:i');
add_option('simple_date', 'M jS');

add_option('simple_tz', 'Europe/London');

//cache me up
define('WP_CONTENT', dirname(dirname(str_replace(array('http://' . $_SERVER['HTTP_HOST'], 'https://' . $_SERVER['HTTP_HOST']), $_SERVER['DOCUMENT_ROOT'], get_bloginfo('template_url')))));
define('CACHEDIR', WP_CONTENT . '/cache');

//simplepie load
if(!class_exists("SimplePie")){
    include_once('simplepie.inc');
}

function doSimpleWidget()
{
	if (function_exists('register_sidebar_widget')){
	register_sidebar_widget('SimpleLife', 'simpleWidget');
	}
}

function simpleWidget($args)
{
	extract($args);

	echo $before_widget;
	echo $before_title;
	echo '<a href="http://kierandelaney.net/blog/projects/simplelife/">Lifestream</a>';
	echo $after_title;

        simplelife();

	echo $after_widget;
}

//add menu
add_action('admin_menu', 'simplelifeOptions');
add_action('plugins_loaded', 'doSimpleWidget');

?>