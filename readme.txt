=== Simplelife ===
Contributors: kierandelaney,db0
Tags: sidebar, widget, flickr, twitter, lastfm, lifestream, feed, presence, delicious
Requires at least: 2.0.2
Tested up to: 2.7
Stable tag: 1.2

A powerful lifestreaming plugin which provides a historical views of your activities online by aggregating it from any service you use.

== Description ==

Simplelife takes your feeds from around the internet and aggregates them into one online trail. See your flickr uploads, your delicious favourites and your most recent last.fm tracks all in one chronological lifestream!

Just use `<?php simplelife(); ?>` in any page template to insert the lifestream.

SimpleLife is also widget ready! If your theme supports widgets, just go to the widget admin panel and drag the picturgrid widget where you want it. The SimpleLife widget makes use of the default options!

**Features**

* Works With All Feeds - even del.icio.us feeds. MagpieRSS, provided by Wordpress and used by other plugins doesn't work correctly with del.icio.us feeds.
* Feed Icons - provided by the feeds themselves (using appropriate site favicon) or custom icons (provided by you).
* Install And Go - no settings to play with, uses existing wordpress cache, just insert your usernames and choose your color schemes (or don't).
* Compact/Lightweight - you won't get lifestream specific CSS on every page where its not needed and you get one function - its all handled on the lifestream page itself.
* Widget Ready - Add your lifestream to your sidebar widget style!
* Themeable - WYSIWYG Styling Options, see examples in the options page "right here, right now".
* Support for as many and as obscure services as possible. We have already included stuff that no one else does like PMOG, Atheist Nexus, Cocomments, Getboo etc.
* Longer history via utilizing google reader.
* Comment tracking from everywhere. That is, each time you leave a comment in the blogosphere or in a forum, it will show in your lifestream (AFAIK, no other lifestreaming service does this)
* Pie Charts. :)

See the [Plugin Project Page](http://kierandelaney.net/blog/projects/wp-simplelife/ "Project Page") for more information and an update list. You can see [a sample here](http://dbzer0.com/about/lifestream).   

=Important Notes=

* This plugin requires the [Simplepie Core plugin](http://wordpress.org/extend/plugins/simplepie-core) in order to work.
* PHP 5 is required.

== Installation ==

1. Extract the directory
1. Upload `/simplelife/` to the `/wp-content/plugins/` directory
1. (**Optional but important**) Disable [ComplexLife](http://dbzer0.com/the-penguin-migration/complexlife) you have it.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure it from the `Settings > Complexlife' WP Admin page.
1. Place `<?php if (function_exists('simplelife')) simplelife(); ?>` in a page template, a widget or in your sidebar.

== Frequently Asked Questions ==

= How fast is it? =

I would not suggest you put it in your sidebar for now. Depending on how many feeds you've used and the items in them, the first run (before the simplepie cache takes over) might take 10 or more seconds.

= I don't seem to have caching. =

In order to utilize the cache, make sure you have a `wp-content/cache` folder that is writable (755). [See here](http://kierandelaney.net/blog/projects/simplelife/#comment-7408)

= I don't get it. What is a lifestream and why do I need it? =

Just check the [Lifestream blog explanation](http://lifestreamblog.com/about/) explanation.

= I want/need so-and-so feature =

Patches are welcome ;)


== Future features ==

We have a few ideas I'd like to implement in the future. I'm not certain I can but I'm listing them here in case anyone would like to tackle them.

* An Ajax-y settings page where the user selects from the top which services he needs to use and then only they appear
* Unlimited custom feeds. User should be able to put a number on a field and get that many custom rss fields to use.
* Integration with the plugin cache if it exists for faster speeds.
* Allow variables to be set on the plugin php call which would allow it to be included, say, in the sidebar but showing only the last 5 actions.
* A way for it to export an rss file which can be used by people elsewhere. This file could be created/updated every time it’s  called, every time the plugin runs or with a cronjob.
