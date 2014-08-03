=== Genesis Accessible ===
Contributors: rianrietveld, garyj
Plugin website: http://genesis-accessible.org
Tags: Genesis, Accessible, Accessibility, a11y, WCAG, Web Standards
Requires at least: 3.8
Tested up to: 3.9.1
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

Do you need an accessible WordPress website right out of the box?
Take a look at Leiden, an accessible child theme for the Genesis Framework and this plugin Genesis Accessible.

Leiden and Genesis Accessible together provide you with a WCAG 2.0 AA accessible-ready WordPress website.

= So what do you need =

- WordPress: Well, First of all: have a recent version [WordPress](http://www.wordpress.org) installed, preferably version 3.8 or higher. Also take a look at the [requirements for WordPress](http://wordpress.org/about/requirements/)
- Genesis Framework: The Leiden child theme and the plugin Genesis Accessible are written for the Genesis framework version 2.0 or higher. This excellent framework is not free, but doesn’t cost much and is totally worth the money. You can buy and download it at studiopress.com, you only need the [basic framework](http://my.studiopress.com/themes/genesis/).
- This plugin Genesis Accessible
- The Genesis child theme [Leiden](https://github.com/RRWD/leiden/archive/master.zip)

== Installation ==

- Install WordPress (http://codex.wordpress.org/Installing_WordPress) or download it in the version of your language.
- Install the [Genesis Framework](http://my.studiopress.com/themes/genesis/) version 2.0.1 or higher
- If your site is in another language than English: install and activate the plugin [Genesis Translations](http://wordpress.org/plugins/genesis-translations/)
- Install and activate the Genesis child theme Leiden
- Install and activate the plugin Genesis Accessible
- Go in the Dashboard to Genesis → Accessibility Settings and select the options you want to add
- Go to the Dashboard to Genesis → Theme Settings and select Content Archives: Display post content and Limit content to the amount of characters you want (e.g. 500)
- Go to the Dashboard to Genesis → SEO Settings and uncheck "Use semantic HTML and section thoughout site?"

= Settings for Genesis version 2.1 =
- To add an H1 on archives for categories: Go to the Dashboard to Posts → Category. Edit the category and fill out the Archive Headline.
- To add an H1 on archives for tags: Go to the Dashboard to Posts → Tags. Edit the tag and fill out the Archive Headline.
- Go to the Dashboard to Genesis → SEO Settings →  Homepage Settings →  Which text would you like to be wrapped in h1 tags? Select Site Title.

== Support and documentation ==

Look for support and documentation on http://genesis-accessible.org
[FAQ](http://genesis-accessible.org/documentation/faq/)

== Changelog ==

= 1.1.0 =
* Support for Genesis 2.1
* Removed jump to search from skiplinks
* Renamed classes prefix skip-links to genwpacc for consistency
* Moved skip-links inside the header to improve the HTML5 outline
* Added aria-label="Skip links" to the ul containing the skip links
* Moved the H2 Main navigation inside the nav class="nav-primary ...
* Rewrite dropdown JS to use module pattern, props to Gary Jones
* Removed .search-form and :focus from genwpacc-skiplinks.css → theme related, available in child theme Leiden
* Removed adding an H1 on archive pages → option is now included in Genesis 2.1 (Posts → Category → Category Archive Settings)
* Added an H1 on the Blog template and the author archive
* Bugfixes

= 1.0.0 =
* First release