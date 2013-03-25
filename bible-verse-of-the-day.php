<?php
/*
Plugin Name: Bible Verse of the Day
Plugin URI: http://www.dailyverses.net/website
Description: The daily bible verse on your website, from DailyVerses.net
Version: 1.1
Author: DailyVerses.net
Author URI: http://www.dailyverses.net
License: GPL2

  Copyright 2013  DailyVerses.net  (email : mail@dailyverses.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function prefix_add_my_stylesheet() {
	wp_register_style( 'prefix-style', plugins_url('bible-verse-of-the-day.css', __FILE__) );
	wp_enqueue_style( 'prefix-style' );
}

add_action( 'wp_enqueue_scripts', 'prefix_add_my_stylesheet' );

function bible_verse_of_the_day() {

	$bibleVerseOfTheDay_Date = get_option('bibleVerseOfTheDay_Date');
	$bibleVerseOfTheDay_bibleVerse = get_option('bibleVerseOfTheDay_Verse');
	$bibleVerseOfTheDay_lastAttempt = get_option('bibleVerseOfTheDay_LastAttempt');
				
	$bibleVerseOfTheDay_currentDate = date('Y-m-d');

	if($bibleVerseOfTheDay_Date != $bibleVerseOfTheDay_currentDate && $bibleVerseOfTheDay_lastAttempt < (date('U') - 3600))
	{
		$url = 'http://dailyverses.net/getdailyverse.ashx?language=en&date=' . $bibleVerseOfTheDay_currentDate . '&url=' . $_SERVER['HTTP_HOST'];
		$result = wp_remote_get($url);

		update_option('bibleVerseOfTheDay_LastAttempt', date('U'));
		
		if(!is_wp_error($result)) 
		{
			$bibleVerseOfTheDay_bibleVerse = $result['body'];

			update_option('bibleVerseOfTheDay_Date', $bibleVerseOfTheDay_currentDate);
			update_option('bibleVerseOfTheDay_Verse', $bibleVerseOfTheDay_bibleVerse);
		}
	}

	if($bibleVerseOfTheDay_bibleVerse == "")
	{
		$bibleVerseOfTheDay_bibleVerse = '<div class="dailyVerses bibleText">For God so loved the world that he gave his one and only Son, that whoever believes in him shall not perish but have eternal life.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/john/3/16">John 3:16</a></div>';
	}
		
	echo $bibleVerseOfTheDay_bibleVerse;
	echo '<div class="dailyVerses linkToWebsite"><a href="http://dailyverses.net" target="_blank">DailyVerses.net</a></div>';
}

class DailyVersesWidget extends WP_Widget
{
  function DailyVersesWidget()
  {
    $widget_ops = array('classname' => 'DailyVerses', 'description' => 'Show the daily bible verse from DailyVerses.net on your website!' );
    $this->WP_Widget('DailyVersesWidget', 'Bible Verse of the Day', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    echo bible_verse_of_the_day();
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("DailyVersesWidget");') );?>