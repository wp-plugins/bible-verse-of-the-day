<?php
/*
Plugin Name: Bible Verse of the Day
Plugin URI: http://wordpress.org/plugins/bible-verse-of-the-day/
Description: The daily bible verse or a random bible verse on your website, from DailyVerses.net
Version: 2.1
Author: DailyVerses.net
Author URI: http://www.dailyverses.net
License: GPL2

  Copyright 2014  DailyVerses.net  (email : mail@dailyverses.net)

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

function bible_verse_of_the_day($showlink, $language='en') {

	$languageAdd = '';
	$languageUrl = '';
	if($language == 'kjv')
	{
		$languageAdd = '_kjv';
	}
	else if($language == 'nl')
	{
		$languageAdd = '_nl';
		$languageUrl = '/nl';
	}
	else if($language == 'es')
	{
		$languageAdd = '_es';
		$languageUrl = '/es';
	}
	else if($language == 'de')
	{
		$languageAdd = '_de';
		$languageUrl = '/de';
	}
	else
	{
		$language = 'en';
	}
	
	$bibleVerseOfTheDay_Date = get_option('bibleVerseOfTheDay_Date' . $languageAdd);
	$bibleVerseOfTheDay_bibleVerse = get_option('bibleVerseOfTheDay_Verse' . $languageAdd);
	$bibleVerseOfTheDay_lastAttempt = get_option('bibleVerseOfTheDay_LastAttempt' . $languageAdd);
				
	$bibleVerseOfTheDay_currentDate = date('Y-m-d');

	if($bibleVerseOfTheDay_Date != $bibleVerseOfTheDay_currentDate && $bibleVerseOfTheDay_lastAttempt < (date('U') - 3600))
	{
		$url = 'http://dailyverses.net/getdailyverse.ashx?language=' . $language . '&date=' . $bibleVerseOfTheDay_currentDate . '&url=' . $_SERVER['HTTP_HOST'] . '&type=daily2_1';
		$result = wp_remote_get($url);

		update_option('bibleVerseOfTheDay_LastAttempt' . $languageAdd, date('U'));
		
		if(!is_wp_error($result)) 
		{
			$bibleVerseOfTheDay_bibleVerse = str_replace(',', '&#44;', $result['body']);

			update_option('bibleVerseOfTheDay_Date' . $languageAdd, $bibleVerseOfTheDay_currentDate);
			update_option('bibleVerseOfTheDay_Verse' . $languageAdd, $bibleVerseOfTheDay_bibleVerse);
		}
	}

	if($bibleVerseOfTheDay_bibleVerse == "")
	{
		if($language == "kjv")
		{
			$bibleVerseOfTheDay_bibleVerse = '<div class="dailyVerses bibleText">For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/john/3/16" target="_blank">John 3:16</a></div>';
		}
		else if($language == "nl")
		{
			$bibleVerseOfTheDay_bibleVerse = '<div class="dailyVerses bibleText">Want God had de wereld zo lief dat hij zijn enige Zoon heeft gegeven, opdat iedereen die in hem gelooft niet verloren gaat, maar eeuwig leven heeft.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/nl/johannes/3/16" target="_blank">Johannes 3:16</a></div>';
		}
		else if($language == "es")
		{
			$bibleVerseOfTheDay_bibleVerse = '<div class="dailyVerses bibleText">Porque tanto amó Dios al mundo, que dio a su Hijo unigénito, para que todo el que cree en él no se pierda, sino que tenga vida eterna.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/es/juan/3/16" target="_blank">Juan 3:16</a></div>';
		}
		else if($language == "de")
		{
			$bibleVerseOfTheDay_bibleVerse = '<div class="dailyVerses bibleText">Denn also hat Gott die Welt geliebt, dass er seinen eingeborenen Sohn gab, damit alle, die an ihn glauben, nicht verloren werden, sondern das ewige Leben haben.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/de/johannes/3/16" target="_blank">Johannes 3:16</a></div>';
		}
		else
		{
			$bibleVerseOfTheDay_bibleVerse = '<div class="dailyVerses bibleText">For God so loved the world that he gave his one and only Son, that whoever believes in him shall not perish but have eternal life.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/john/3/16" target="_blank">John 3:16</a></div>';
		}
	}

    if($showlink == 'true' || $showlink == '1')
	{
		$html =  $bibleVerseOfTheDay_bibleVerse . '<div class="dailyVerses linkToWebsite"><a href="http://dailyverses.net' . $languageUrl . '" target="_blank">DailyVerses.net</a></div>';
	}
	else
	{
		$html = $bibleVerseOfTheDay_bibleVerse;
	}
	
	return $html;
}

function random_bible_verse($showlink, $language='en') {
	$languageAdd = '';
	$languageUrl = '';
	if($language == 'kjv')
	{
		$languageAdd = '_kjv';
	}
	else if($language == 'nl')
	{
		$languageAdd = '_nl';
		$languageUrl = '/nl';
	}
	else if($language == 'es')
	{
		$languageAdd = '_es';
		$languageUrl = '/es';
	}
	else if($language == 'de')
	{
		$languageAdd = '_de';
		$languageUrl = '/de';
	}
	else
	{
		$language = 'en';
	}
	$position = rand(0, 200);
	$randomBibleVerse = get_option('randomBibleVerse_' . $position . $languageAdd);
	$randomBibleVerse_lastAttempt = get_option('randomBibleVerse_LastAttempt' . $languageAdd);
	
	if($randomBibleVerse == "" && $randomBibleVerse_lastAttempt < (date('U') - 3600))
	{
		$url = 'http://dailyverses.net/getrandomverse.ashx?language=' . $language . '&position=' . $position . '&url=' . $_SERVER['HTTP_HOST'] . '&type=random2_1';
		$result = wp_remote_get($url);

		if(!is_wp_error($result)) 
		{
			$randomBibleVerse = str_replace(',', '&#44;', $result['body']);

			update_option('randomBibleVerse_' . $position . $languageAdd, $randomBibleVerse);
		}
		else
		{
			update_option('randomBibleVerse_LastAttempt' . $languageAdd, date('U'));
		}
	}

	if($randomBibleVerse == "")
	{
		if($language == "kjv")
		{
			$bibleVerseOfTheDay_bibleVerse = '<div class="dailyVerses bibleText">For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/john/3/16" target="_blank">John 3:16</a></div>';
		}
		else if($language == "nl")
		{
			$randomBibleVerse = '<div class="dailyVerses bibleText">Want God had de wereld zo lief dat hij zijn enige Zoon heeft gegeven, opdat iedereen die in hem gelooft niet verloren gaat, maar eeuwig leven heeft.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/nl/johannes/3/16" target="_blank">Johannes 3:16</a></div>';
		}
		else if($language == "es")
		{
			$randomBibleVerse = '<div class="dailyVerses bibleText">Porque tanto amó Dios al mundo, que dio a su Hijo unigénito, para que todo el que cree en él no se pierda, sino que tenga vida eterna.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/es/juan/3/16" target="_blank">Juan 3:16</a></div>';
		}
		else if($language == "de")
		{
			$randomBibleVerse = '<div class="dailyVerses bibleText">Denn also hat Gott die Welt geliebt, dass er seinen eingeborenen Sohn gab, damit alle, die an ihn glauben, nicht verloren werden, sondern das ewige Leben haben.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/de/johannes/3/16" target="_blank">Johannes 3:16</a></div>';
		}
		else
		{
			$randomBibleVerse = '<div class="dailyVerses bibleText">For God so loved the world that he gave his one and only Son, that whoever believes in him shall not perish but have eternal life.</div><div class="dailyVerses bibleVerse"><a href="http://dailyverses.net/john/3/16" target="_blank">John 3:16</a></div>';
		}
	}
		
	if($showlink == 'true' || $showlink == '1')
	{
		$html = $randomBibleVerse . '<div class="dailyVerses linkToWebsite"><a href="http://dailyverses.net' . $languageUrl . '" target="_blank">DailyVerses.net</a></div>';
	}
	else
	{
		$html = $randomBibleVerse;
	}
	
	return $html;
}

add_shortcode('bibleverseoftheday', 'bible_verse_of_the_day'); 
add_shortcode('randombibleverse', 'random_bible_verse'); 
add_shortcode('bibleverseoftheday_kjv', 'bible_verse_of_the_day_kjv'); 
add_shortcode('randombibleverse_kjv', 'random_bible_verse_kjv'); 

add_shortcode('bibleverseoftheday_nl', 'bible_verse_of_the_day_nl'); 
add_shortcode('randombibleverse_nl', 'random_bible_verse_nl'); 
add_shortcode('bibleverseoftheday_nbv', 'bible_verse_of_the_day_nl'); 
add_shortcode('randombibleverse_nbv', 'random_bible_verse_nl'); 

add_shortcode('bibleverseoftheday_es', 'bible_verse_of_the_day_es'); 
add_shortcode('randombibleverse_es', 'random_bible_verse_es'); 
add_shortcode('bibleverseoftheday_nvi', 'bible_verse_of_the_day_es'); 
add_shortcode('randombibleverse_nvi', 'random_bible_verse_es'); 

add_shortcode('bibleverseoftheday_de', 'bible_verse_of_the_day_de'); 
add_shortcode('randombibleverse_de', 'random_bible_verse_de'); 
add_shortcode('bibleverseoftheday_lut', 'bible_verse_of_the_day_de'); 
add_shortcode('randombibleverse_lut', 'random_bible_verse_de'); 

function bible_verse_of_the_day_kjv() {
	return bible_verse_of_the_day('0', 'kjv');
}

function random_bible_verse_kjv() {
	return random_bible_verse('0', 'kjv');
}

function bible_verse_of_the_day_nl() {
	return bible_verse_of_the_day('0', 'nl');
}

function random_bible_verse_nl() {
	return random_bible_verse('0', 'nl');
}

function bible_verse_of_the_day_es() {
	return bible_verse_of_the_day('0', 'es');
}

function random_bible_verse_es() {
	return random_bible_verse('0', 'es');
}

function bible_verse_of_the_day_de() {
	return bible_verse_of_the_day('0', 'de');
}

function random_bible_verse_de() {
	return random_bible_verse('0', 'de');
}

class DailyVersesWidget extends WP_Widget
{
  function __construct() 
  {
	parent::__construct('DailyVersesWidget', __('Bible verse of the day', 'DailyVerses' ), array ('description' => __( 'Show the daily Bible verse from DailyVerses.net on your website!', 'DailyVerses')));
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => 'Bible verse of the day', 'showlink' => '1', 'language' => 'en' ) );
    $title = $instance['title'];
	$showlink = $instance['showlink'];
	$language = $instance['language'];
	
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <br /><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  <p><select id="<?php echo $this->get_field_id('language'); ?>" name="<?php echo $this->get_field_name('language'); ?>">
	<option value="en" <?php _e($language == '' || $language == 'en' ? 'selected' : ''); ?>>English - NIV</option>
	<option value="kjv" <?php _e($language == 'kjv' ? 'selected' : ''); ?>>English - KJV</option>
	<option value="nl" <?php _e($language == 'nl' ? 'selected' : ''); ?>>Dutch (nederlands) - NBV</option>
	<option value="es" <?php _e($language == 'es' ? 'selected' : ''); ?>>Spanish (español) - NVI</option>
	<option value="de" <?php _e($language == 'de' ? 'selected' : ''); ?>>German (deutsch) - LUT</option>
  </select></p>
  <p><input id="<?php echo $this->get_field_id('showlink'); ?>" name="<?php echo $this->get_field_name('showlink'); ?>" type="checkbox" value="1" <?php checked( '1', $showlink ); ?>/><label for="<?php echo $this->get_field_id('showlink'); ?>"><?php _e('&nbsp;Show link to DailyVerses.net (thank you!)'); ?></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	if($new_instance['showlink'] == '1')
	{
		$instance['showlink'] = '1';
	}
	else
	{
		$instance['showlink'] = '0';
	}	
	if($new_instance['language'] == '')
	{
		$instance['language'] = 'en';
	}
	else
	{
		$instance['language'] = $new_instance['language'];
	}
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
 	$showlink = $instance['showlink'];
	if($showlink == '')
	{
		$showlink = '1';
	}
	
	$language = $instance['language'];
	if($language == '')
	{
		$language = 'en';
	}
	
    echo bible_verse_of_the_day($showlink, $language);
 
    echo $after_widget;
  } 
}

class RandomBibleVerseWidget extends WP_Widget
{
  function __construct() 
  {
	parent::__construct('RandomBibleVerseWidget', __('Random Bible verse', 'RandomBibleVerse' ), array ('description' => __( 'Shows a random Bible verse from DailyVerses.net on your website!', 'RandomBibleVerse')));
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => 'Random bible verse', 'showlink' => '1', 'language' => 'en' ) );
    $title = $instance['title'];
	$showlink = $instance['showlink'];
	$language = $instance['language'];
	
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  <p><select id="<?php echo $this->get_field_id('language'); ?>" name="<?php echo $this->get_field_name('language'); ?>">
	<option value="en" <?php _e($language == '' || $language == 'en' ? 'selected' : ''); ?>>English - NIV</option>
	<option value="kjv" <?php _e($language == 'kjv' ? 'selected' : ''); ?>>English - KJV</option>
	<option value="nl" <?php _e($language == 'nl' ? 'selected' : ''); ?>>Dutch (nederlands) - NBV</option>
	<option value="es" <?php _e($language == 'es' ? 'selected' : ''); ?>>Spanish (español) - NVI</option>
	<option value="de" <?php _e($language == 'de' ? 'selected' : ''); ?>>German (deutsch) - LUT</option>
  </select></p>
  <p><input id="<?php echo $this->get_field_id('showlink'); ?>" name="<?php echo $this->get_field_name('showlink'); ?>" type="checkbox" value="1" <?php checked( '1', $showlink ); ?>/><label for="<?php echo $this->get_field_id('showlink'); ?>"><?php _e('&nbsp;Show link to DailyVerses.net (thank you!)'); ?></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	if($new_instance['showlink'] == '1')
	{
		$instance['showlink'] = '1';
	}
	else
	{
		$instance['showlink'] = '0';
	}
	if($new_instance['language'] == '')
	{
		$instance['language'] = 'en';
	}
	else
	{
		$instance['language'] = $new_instance['language'];
	}
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
 	$showlink = $instance['showlink'];
	if($showlink == '')
	{
		$showlink = '1';
	}
	
	$language = $instance['language'];
	if($language == '')
	{
		$language = 'en';
	}
	
    echo random_bible_verse($showlink, $language);
 
    echo $after_widget;
  }
}

add_action( 'widgets_init', create_function('', 'return register_widget("DailyVersesWidget");') );
add_action( 'widgets_init', create_function('', 'return register_widget("RandomBibleVerseWidget");') );
?>