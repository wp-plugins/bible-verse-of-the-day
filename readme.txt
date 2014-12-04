=== Plugin Name ===
Contributors: dailyverses
Donate link: http://www.dailyverses.net/
Tags: bible, verse, day, daily, verses, everyday, widget, bijbel, tekst, bijbeltekst, dagelijks, dag, random, willekeurige, bibelverse, bibel, zufalls, bibelvers, tages, versiculo, verso, biblia, azar, dia
Requires at least: 2.7.0
Tested up to: 4.0
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugins shows the daily inspiring bible verse or a random bible verse from DailyVerses.net.

== Description ==

This plugins shows a daily bible verse or a random bible verse from [DailyVerses.net](http://dailyverses.net). The verses are from the NIV translation.

It can be used as a widget, so it's easy to install. After installing the plugin you will have two widgets: 'Bible verse of the day' and 'Random bible verse'. You can also use the following tags: [bibleverseoftheday] and [randombibleverse].

If the connection to [DailyVerses.net](http://dailyverses.net) for some reason fails, it will show the previous verse. If there is no previous verse, the plugin will show John 3:16.

The plugin also supports ([Dutch](http://dailyverses.net/nl)), ([Spanish](http://dailyverses.net/es)) and ([German](http://dailyverses.net/de)) bible verses:

Nederlands (Dutch):
Bible translation: NBV.
Widget: 'Bijbeltekst van de Dag' (Bible verse of the day) and 'Willekeurige Bijbeltekst' (Random bible verse).
Tags: [bibleverseoftheday_nl] and [randombibleverse_nl]

Spanish (Español):
Bible translation: NVI.
Widget: 'Versículo del día' (Bible verse of the day) and 'Versículo de la Biblia al azar' (Random bible verse).
Tags: [bibleverseoftheday_es] and [randombibleverse_es]

German (Deutsch):
Bible translation: Luther 1984.
Widget: 'Bibelvers des Tages' (Bible verse of the day) and 'Zufalls Bibelvers' (Random bible verse).
Tags: [bibleverseoftheday_de] and [randombibleverse_de]

== Installation ==

This section describes how to install the plugin and get it working.

1. You can install the plugin by uploading the zip in the plugins section of wordpress, or by adding the files to the folder '/wp-content/plugins/bible-verse-of-the-day'.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. English:
   - Widget: There are widgets added 'Bible Verse of the Day' and 'Random Bible Verse', you can drag this onto the sidebar of your site.
   - Replace tags: You can use the following shortcodes: [bibleverseoftheday] and [randombibleverse].
   - Template: Place `<?php echo bible_verse_of_the_day(0); ?>` or `<?php echo random_bible_verse(0); ?>` in your template.
   
   Dutch (Nederlands):
   - Widget: Er zijn twee widgets toegevoegd 'Bible Verse of the Day' en 'Random Bible Verse', deze kun je op de sidebar van je website plaatsen. Selecteer 'Dutch (nederlands)' bij de configuratie van de widget.
   - Replace tags: Je kunt de volgende shortcodes gebruiken: [bibleverseoftheday_nl] and [randombibleverse_nl].
   - Template: Plaats `<?php echo bible_verse_of_the_day(0, 'nl'); ?>` of `<?php echo random_bible_verse(0, 'nl'); ?>` in je template.

   Spanish (Español):
   - Widget: 'Bible Verse of the Day' and 'Random Bible Verse'. Select 'Spanish (español)' at the configuration of the widget.
   - Replace tags: [bibleverseoftheday_es] and [randombibleverse_es].
   - Template: Place `<?php echo bible_verse_of_the_day(0, 'es'); ?>` or `<?php echo random_bible_verse(0, 'es'); ?>` in your template.

   German (Deutsch):
   - Widget: 'Bible Verse of the Day' and 'Random Bible Verse'. Select 'German (deutsch)' at the configuration of the widget.
   - Replace tags: [bibleverseoftheday_de] and [randombibleverse_de].
   - Template: Place `<?php echo bible_verse_of_the_day(0, 'de'); ?>` or `<?php echo random_bible_verse(0, 'de'); ?>` in your template.
   
== Frequently Asked Questions ==


== Screenshots ==

1. This is what the daily bible verse will look like by default. By changing the css you can change the appearance of the plugin.
2. Another screenshot of the plugin.
3. A wordpress site with the plugin in the sidebar.

== Changelog ==

= 1.8 =
* Fixed error on some wordpress installations: Cannot modify header information - headers already sent by

= 1.7 =
* Fixed deprecated function warning
* Tested with Wordpress version 4.0.1

= 1.6 =
* Added German and Spanish
* Tested with Wordpress version 3.8.1

= 1.5 =
* Fixed missing argument warning
* Tested with Wordpress version 3.7.1

= 1.4 =
* Added support for the dutch language
* Added more verses to the random bible verse functionality.

= 1.3 =
* Added the random bible verse functionality.
* Added shortcodes: [bibleverseoftheday] and [randombibleverse].
* The widgets now have a default title.
* The widgets now have a option to choose whether you want to show the link to [DailyVerses.net](http://dailyverses.net) or not.

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
