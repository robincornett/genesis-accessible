=== Genesis Accessible ===
Contributors: rianrietveld, GaryJ, littlerchicken
Donate link: https://genesis-accessible.org/donate/
Tags: Genesis, Accessible, Accessibility, a11y, WCAG, WCAG 2.0 AA, Web Standards
Requires at least: 4.9
Tested up to: 5.2
Stable tag: 1.3.1
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Genesis Accessible is a plugin for site owners who want accessibility-ready websites using the Genesis Framework, but who use child themes which don't yet support the framework's accessibility features.

= So what do you need? =

- WordPress: Well, First of all: have a recent version [WordPress](https://wordpress.org) installed: version 4.9 or higher. Also take a look at the [requirements for WordPress](https://wordpress.org/about/requirements/)
- Genesis Framework: The Genesis Accessible plugin is written for the Genesis framework version 2.8.1 or higher. This excellent framework is not free, but doesn't cost much and is totally worth the money. You can buy and download it at [studiopress.com](https://my.studiopress.com/themes/genesis/).
- This plugin Genesis Accessible

Look for [documentation on genesis-accessible.org](https://genesis-accessible.org)

== Installation ==

- Install [WordPress](https://codex.wordpress.org/Installing_WordPress).
- Install the [Genesis Framework](https://my.studiopress.com/themes/genesis/) version 2.3.1 or higher
- Install your preferred Genesis child theme
- If your site is in another language than English: install and activate the plugin [Genesis Translations](https://wordpress.org/plugins/genesis-translations/)
- Install and activate this plugin Genesis Accessible
- Go in the Dashboard to Genesis → Accessibility Settings and select the options you want to add
- Go to the Dashboard to Genesis → Theme Settings and select Content Archives: Display post content. If you do not want to display the full content on archives, then limit content to the number of characters you want (e.g. 500)
- Go to the Dashboard to Genesis → SEO Settings and uncheck "Use semantic HTML and section throughout site?" (this setting may not be available)

Look for [documentation on genesis-accessible.org](https://genesis-accessible.org)

Photo credit: Leiden, Netherlands by [Nick van der Zwan](https://unsplash.com/photos/Qco9YF2io4Q)

== Frequently Asked Questions ==

- Look for [documentation on genesis-accessible.org](https://genesis-accessible.org)
- Have a question? Please read the [FAQ](https://genesis-accessible.org/documentation/faq/) on genesis-accessible.org
- Still have a question? Ask it on the [Support Forum](https://wordpress.org/support/plugin/genesis-accessible)
- If you found a bug or have an improvement, please report it on [GitHub](https://github.com/RRWD/genesis-accessible)
- If you want this plugin in your language, you can help by [submitting a translation](https://translate.wordpress.org/projects/wp-plugins/genesis-accessible).

== Screenshots ==
1. Screenshot of the Genesis Accessible settings page

== Upgrade Notice ==

1.3.0: new plugin contributor, more information available about current theme support

== Changelog ==

= 1.3.1 =
* Remove unneeded uninstall.php

= 1.3.0 =
* Add a check for current theme accessibility support, and merge the plugin settings with those (instead of replacing)
* On the settings page, identify which Genesis accessibility features are already included in the active child theme
* Add support for 404 pages
* Settings page updated to be consistent with Genesis Framework
* Update minimum Genesis/WordPress versions
* New contributor/author: @littlerchicken

= 1.2.3 =

Release date: August 10, 2015

* Minor bugfixes, props @corvannoorloos
* Removed address from TinyMCE options

= 1.2.2 =

Release date: May 23, 2015

* Bug fix for search action pointing to the wrong url (thanks Jackie D'Elia)
* Added French and updated German language files by Alain Schlesser
* Added CSS position:relative to .more-link for compatibility with themes using backstretch scripts (thanks Paul Oasten and Carrie Dils)

= 1.2.1 =

Release date: May 6, 2015

* Bug fixes in the skip links, props Nir Rosenbaum

= 1.2.0 =

Release date: May 4, 2015

* Compatible with Genesis 2.2
* Several bugfixes
* Added the possibility to add your own 404 and page_archive templates
* Added a check for the existence of a Category Archive title and intro to prevent a double heading in archive pages.
* With help and contributions from: @GaryJ (Gary Jones), @littlerchicken (Robin Cornett), @cdils (Carrie Dils), @bramd (Bram Duvigneau), @purplebabyhippo (Angie Vale), @neilgee (Neil Gee) and the #genesiswp Slack community
* British translation by Richard Senior

= 1.1.1 =

Release date: August 25, 2014

* Hebrew translation by Nir Rosenbaum
* Spanish translation by Andrew Kurtis, WebHostingHub
* Added genesis-accessible.pot
* Minor bugfixes

= 1.1.0 =

Release date: August 8, 2014

* Support for Genesis 2.1
* Removed jump to search from skiplinks
* Renamed classes prefix skip-links to genwpacc for consistency
* Moved skip-links inside the header to improve the HTML5 outline
* Moved the H2 Main navigation inside the nav class="nav-primary ...
* Rewrite dropdown JS to use module pattern, props to Gary Jones
* Removed .search-form and :focus from genwpacc-skiplinks.css → theme related, available in child theme Leiden
* Removed adding an H1 on archive pages → option is now included in Genesis 2.1 (Posts → Category → Category Archive Settings)
* Added an H1 on the Blog template and the author archive
* Bugfixes

= 1.0.0 =

Release date: May 17, 2014

* First release
