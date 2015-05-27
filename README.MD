=== Genesis Accessible ===
Contributors: rianrietveld, GaryJ
Plugin website: http://genesis-accessible.org
Donate link: http://genesis-accessible.org/donate/
Tags: Genesis, Accessible, Accessibility, a11y, WCAG, WCAG 2.0 AA, Web Standards
Requires at least: 3.8
Tested up to: 4.2
Stable tag: 1.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

Do you need an accessible WordPress website right out of the box?
Take a look at Leiden, an accessible child theme for the Genesis Framework and this plugin Genesis Accessible.

Leiden and Genesis Accessible together provide you with a WCAG 2.0 AA accessible-ready WordPress website.

= So what do you need =

- WordPress: Well, First of all: have a recent version [WordPress](http://www.wordpress.org) installed, preferably version 4.0 or higher. Also take a look at the [requirements for WordPress](http://wordpress.org/about/requirements/)
- Genesis Framework: The Leiden child theme and the plugin Genesis Accessible are written for the Genesis framework version 2.0 or higher. This excellent framework is not free, but doesn’t cost much and is totally worth the money. You can buy and download it at studiopress.com, you only need the [basic Genesis framework](http://www.shareasale.com/r.cfm?b=346198&u=629895&m=28169&urllink=&afftrack=).
- This plugin Genesis Accessible
- The [Genesis child theme Leiden](https://github.com/RRWD/leiden/archive/master.zip)

Look for [documentation on genesis-accessible.org](http://genesis-accessible.org)

== Installation ==

- Install WordPress (http://codex.wordpress.org/Installing_WordPress).
- Install the [Genesis Framework](http://www.shareasale.com/r.cfm?b=346198&u=629895&m=28169&urllink=&afftrack=) version 2.0.1 or higher
- If your site is in another language than English: install and activate the plugin [Genesis Translations](http://wordpress.org/plugins/genesis-translations/)
- Install and activate the [Genesis child theme Leiden](https://github.com/RRWD/leiden/archive/master.zip)
- Install and activate this plugin Genesis Accessible
- Go in the Dashboard to Genesis → Accessibility Settings and select the options you want to add
- Go to the Dashboard to Genesis → Theme Settings and select Content Archives: Display post content and Limit content to the amount of characters you want (e.g. 500)
- Go to the Dashboard to Genesis → SEO Settings and uncheck "Use semantic HTML and section thoughout site?"

= Settings for Genesis version 2.1 =

- To add an H1 on archives for categories: Go to the Dashboard to Posts → Category. Edit the category and fill out the Archive Headline.
- To add an H1 on archives for tags: Go to the Dashboard to Posts → Tags. Edit the tag and fill out the Archive Headline.
- Go to the Dashboard to Genesis → SEO Settings →  Homepage Settings →  Which text would you like to be wrapped in h1 tags? Select Site Title.

Look for [documentation on genesis-accessible.org](http://genesis-accessible.org)

== Frequently Asked Questions ==

- Look for [documentation on genesis-accessible.org](http://genesis-accessible.org)
- Have a question? Please read the [FAQ](http://genesis-accessible.org/documentation/faq/) on genesis-accessible.org
- Still have a question? Ask it on the [Support Forum](https://wordpress.org/support/plugin/genesis-accessible)
- If you found a bug or have an improvement, please report it on [GitHub](https://github.com/RRWD/genesis-accessible)
- If you want this plugin in your language, you can help us to [translate](http://genesis-accessible.org/glotpress/projects/genesis-accessible) in the plugins GlotPress.


== Changelog ==

= 1.2.2 =

Release date: May 23, 2015

* Bug fix for search action pointing to the wrong url (thanks Jackie D'Elia)
* Added French and updated German language files by Alain Schlesser
* Added CSS position:relative to .more-link for compatibility with themes using backstretch scripts (thanks Paul Oaten and Carrie Dils)

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
* Britisch translation by Richard Senior

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
