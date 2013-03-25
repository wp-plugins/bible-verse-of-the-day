=== Plugin Name ===
Contributors: dailyverses
Donate link: http://www.dailyverses.net/
Tags: bible, verse, day, daily, verses, everyday 
Requires at least: 2.7.0
Tested up to: 3.5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugins shows the daily inspiring bible verse from DailyVerses.net.

== Description ==

This plugins shows a daily bible verse. This is the daily verse that's also shown at the website [DailyVerses.net](http://dailyverses.net). The verses are from the NIV translation.

It can be used as a widget, so it's easy to install.

If the connection to [DailyVerses.net](http://dailyverses.net) for some reason fails, it will show the previous verse. If there is no previous verse, the plugin will show John 3:16.

== Installation ==

This section describes how to install the plugin and get it working.

1. You can install the plugin by uploading the zip in the plugins section of wordpress, or by adding the files to the folder '/wp-content/plugins/bible-verse-of-the-day' 
2. Activate the plugin through the 'Plugins' menu in WordPress
3. - Widget: There is a widget added 'Bible Verse of the Day', you can drag this onto the sidebar of your site.
   - Template: Place `<?php bible_verse_of_the_day(); ?>` in your templates

== Frequently Asked Questions ==


== Screenshots ==

1. This is what the daily bible verse will look like by default. By changing the css you can change the appearance of the plugin
2. A wordpress site with the plugin in the sidebar.

== Changelog ==

= 1.2 =
* On some wordpress installations there were security issues when getting the verse from [DailyVerses.net](http://dailyverses.net), these are now solved by using the wordpress functions.

= 1.1 =
* The new verse will now show at midnight depending on your server time, not the time of the server of [DailyVerses.net](http://dailyverses.net)
* The plugin no longer uses javascript, so it will also work for users with javascript disabled.
* The plugin now only gets verse once a day from DailyVerses.net so there is no longer a need to get the verse on each page load. This makes the performance even better!

= 1.0 =
* Initial version

== Upgrade Notice ==

== A brief Markdown Example ==
