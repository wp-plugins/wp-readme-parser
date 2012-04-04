=== Artiss URL Shortener ===
Contributors: dartiss
Donate link: http://artiss.co.uk/donate
Tags: artiss, bit.ly, is.gd, j.mp, linkbee, service, shorten, shortener, shortening, shrink, simple, small, tiny, tinyurl, tr.im, url
Requires at least: 2.0
Tested up to: 3.3.1
Stable tag: 1.7.1

Artiss URL Shortener will shorten a supplied URL using one of 130 different shortening services

== Description ==

Artiss URL Shortener is one of the most powerful URL shortening plugins available with 130 shortening services instantly available.

The code to access Artiss URL Shortener can be put anywhere within your WordPress theme wherever you need to convert a long URL to a short one.

Here is an example...

`<?php echo url_shortener( 'http://www.artiss.co.uk', 'service=is.gd' ); ?>`

This will display the is.gd shortened URL for http://www.artiss.co.uk.

There are 2 parameters..

The first parameter is the URL that you wish to have shortened. If left blank it will use the URL of the current post/page.

The second parameter is a list of options. These are separated by an ampersand and can be any of the following...

* *service=* - Which shortening service do you wish to use? See the separate full list for those that can be used.
* *cache=* - Do you want to cache the results? Specify `No` to switch caching off OR the number of hours that you wish to cache for. If you omit this, 24 hours is assumed.
* *apikey=* - If the shortening service requires an API key to be specified, do it with this option (see below for details of those that require this)
* *login=* - If the shortening service requires a user name to be specified, do it with this option (see below for details of those that require this)
* *password=* - If the shortening service requires a password to be specified, do it with this option (see below for details of those that require this)

For example...

`<?php if ( function_exists( 'url_shortener' ) ) : ?>
<?php echo url_shortener( 'http://www.artiss.co.uk', 'service=is.gd&cache=no' ); ?>
<?php endif; ?>`

This, with a check to ensure the plugin is active, will shorten the site `artiss.co.uk` using `is.gd` and cache is switched off.

Shortening services that require additional information are...

* bit.ly+key, 9mp, j.mp+key and to.vg requires before `apikey` and `login` to be specified.
* coge.la+key, lnk.co+key, lnk.co+banner (the same as lnk.co+key but displays a banner image) and linkbee+key requires `login` and `password` to be specified.
* 307.to+key, adjix, ad.vu, cort.as+key, ez.com, l.pr, Puke.it, qux.in, tra.kz, url.co.uk and urlBorg require the `apikey` to be supplied.

For example, here is the above example, but now using bit.ly+key as the shortening service...

`<?php if ( function_exists( 'url_shortener' ) ) : ?>
<?php echo url_shortener( 'http://www.artiss.co.uk', 'service=bit.ly+key&apikey=3003948393993&login=test&cache=no' ); ?>
<?php endif; ?>`

I've **not** used a valid API key in the above example - you will need to get one for yourself.

**For help with this plugin, or simply to comment or get in touch, please read the appropriate section in "Other Notes" for details. This plugin, and all support, is supplied for free, but [donations](http://artiss.co.uk/donate "Donate") are always welcome.**

== Developers ==

It is envisaged that this plugin is probably more of use to developers who want to include it as part of a plugin or theme. In particular, this plugin can be called from another. For example, a social bookmarking plugin could use this to provide a number of possible URL shortening services.

To this end another routine is provided, `validate_url_shortener`, which can be used to validate whether a shortening service is valid.

This routine has two parameters. The first parameter is a line of text that you wish to have checked to see if it included a validate shortening service.

The second, optional, parameter is a mask. Use the text `{service}` to indicate where in the mask the name of the service should appear.

If the shortening service was valid, the name of it will be returned.

Let's try some examples...

`validate_url_shortener( 'is.gd', '' );`

This will return `is.gd` if `is.gd` is, indeed, one of the shortening services that this plugin accepts. Otherwise a null will be returned.

`validate_url_shortener( 'Is there a shortening service in this sentence is.gd', '' );`

Again, this will return `is.gd`, as it was found within the first parameter.

`validate_url_shortener( 'Start %is.gd% End', '%{service}%' );`

This time a mask has been specified showing that the service should appear within percent signs. As a valid service is found within the first parameter in this format, it will be valid and `is.gd` will once again be return.

In this example, a null will be specified as the mask condition was not met...

`validate_url_shortener( 'Start is.gd End', '%{service}%' );`

Use this routine in conjunction with the actual shortener to validate passed services before then using them. However, if Artiss URL Shortener is passed a service that is not valid, it will simply return the original URL.

== Services ==

The following shortening services are available with this plugin...

1URL.com, 2Zeus, 3.ly, 307.to, 307.to+key, 9mp, a.gd, a.nf, abbrr, adf.ly, ad.vu, adjix, arm.in,  BudURL, bit.ly+key, buk.me, chilp.it, clck.ru, cli.gs, coge.la, coge.la+key, cort.as, cort.as+key, durl.me, ez.com, fa.by, fon.gs, fwd4.me, g1n.co, gl.am, goo.by, gurl.es, hex.io, hop.im, href.in, HURL, idek.net, ir.pe, is.gd, ito.mx, ity.im, j.mp, j.mp+key, kissa.be, kl.am, kore.us, korta.nu, Kots.Nu, krz.ch, l.pr, Lincr, Linkbee, Linkbee+key, Linkee, LinxFix, liurl.cn, Lnk.by, lnk.co, lnk.co+banner, lnk.co+key, ln-s.net, ln-s.ru, lt.tl, lurl.no, merky.de, micURL, migre.me, min2me, minify.us, minilink, MinURL, nbx.ch, ndurl, p.ly, Pendek.in, Piko.me, PiURL, Puke.It, qlnk.net, qr.cx, qux.in, r.im, rde.me, redir.ec, retwt.me, ri.ms, s4c, safe.mn, sai.ly, short.ie, short.to, shortn.me, Shw.me, sl.ly, smsh.me, snkr.me, srnk.net, srs.li, su.pr, su.pr+key, TimesURL, tinyarro.ws, tinyurl, to.ly, toGOto.us, tra.kz, twirl, twiturl.de, u.nu, UiopMe, unfake.it, url.co.uk, ur.ly, url.ag, urlBorg, urlG, urlKiss, urlShort, vb.ly, vl.am, vtc.es, xr.com, xrl.us, xxsURL, yvy.me, z.pe, Zi.pe, ZipMyURL, zz.gd

== Licence ==

This WordPress plugin is licensed under the [GPLv2 (or later)](http://wordpress.org/about/gpl/ "GNU General Public License").

== Support ==

All of my plugins are supported via [my website](http://www.artiss.co.uk "Artiss.co.uk").

Please feel free to visit the site for plugin updates and development news - either visit the site regularly or [follow me on Twitter](http://www.twitter.com/artiss_tech "Artiss.co.uk on Twitter") (@artiss_tech).

For problems, suggestions or enhancements for this plugin, there is [a dedicated page]([[http://www.artiss.co.uk/url-shortener "Artiss URL Shortener"]]) and [a forum](http://www.artiss.co.uk/forum "WordPress Plugins Forum"). The dedicated page will also list any known issues and planned enhancements.

**This plugin, and all support, is supplied for free, but [donations](http://artiss.co.uk/donate "Donate") are always welcome.**

== Reviews & Mentions ==

[Custom Short URLs in WordPress](http://ianhin.es/wrote-about/short-urls/ "Custom Short URLs in WordPress")

[Behind the Scenes - The Brooks Review](http://brooksreview.net/2011/01/behind-scenese/ "Behind the Scenes")

[How to make a Twitter button with your choice of service URL](http://neosting.net/wordpress/faire-un-bouton-pour-twitter-avec-le-choix-du-service.html "Faire un bouton pour twitter avec le choix du service d’URL")

== Installation ==

1. Upload the entire `[[plugin folder]]`folder to your wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. [[That's it, you're done - you just need to add the function call or short code!]]

== Frequently Asked Questions ==

= You haven't included my favourite URL shortening service =

Just let me know and I'll possibly include it in a future release. I'm trying to just include the most popular services, as there are hundreds available.

= Which version of PHP does this plugin work with? =

It has been tested and been found valid from PHP 4 upwards.

Please note, however, that the minimum for WordPress is now PHP 5.2.4. Even though this plugin supports a lower version, I am not coding specifically to achieve this - therefore this minimum may change in the future.

== Changelog ==

= 1.7.1 =
* Bug: Not formatting the key used for the cache so cache may fail
* Maintenance: Removed tr.im

= 1.7 =
* Maintenance: Renamed to Artiss URL Shortener
* Maintenance: Brought code up to date
* Maintenance: Removed debug option
* Maintenance: Fixed bit.ly
* Maintenance: Re-written the instructions!
* Enhancement: Now using built-in WP caching - **if you have WP Plugin Cache installed you can now remove it!**
* Enhancement: Added adf.ly, goo.by, ity.im, lnk.co, lnk.co+key, lnk.co+banner and yvy.me

= 1.6.2 =
* Bug: Fixed file fetching bug

= 1.6.1 =
* Maintenance: Removed bit.ly (you can still use bit.ly+key though)
* Enhancenment: Added v.gd

= 1.6 =
* Maintenance: url.co.uk now requires an API key
* Maintenance: Confirmed WP 3.0 compatibility
* Bug: Fixed critical bug in file fetching routine
* Enhancement: Rewrite of main code, especially debugging data
* Enhancement: Using WP Plugin Cache for caching, instead of old internal routines
* Enhancement: Added extra Linkbee service for members
* Enhancement: Added ez.com and minify.us to list of services

= 1.5 =
* Enhancement: Added debugging facility

= 1.4 =
* Enhancement: Replaced str_ireplace with str_replace to ensure PHP 4 compatibility

= 1.3 =
* Enhancement: Added new services - 2Zeus, 9mp, BudURL, HURL, kl.am, Lnk.by, to.vg, url.co.uk

= 1.2 =
* Enhancement: Added 87 new shortening services. pic.gd removed.
* Enhancement: Ability to specify API key and/or login and password details for certain services
* Enhancement: Can now read XML and JSON return formats, not just plain text
* Enhancement: Failed shortening of URLs are no longer cached

= 1.1 =
* Maintenance: New versions of shared functions added in
* Enhancement: Now uses caching system to save shortened URLs
* Enhancement: Sub-parameter system added to allow for switching off of cache

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.7.1 =
* Upgrade to fix a minor issue with the caching

= 1.7 =
* Upgrade to improve caching, fix bit.ky and to add new services

= 1.6.2 =
* Upgrade to fix critical file fetching bug

= 1.6.1 =
* Upgrade if you use bit.ly or want to use v.gd

= 1.6 =
* Update to include new, more efficient, caching
* Update if you wish to use ez.com or minify.us or Linkbee member shortening
* Critical fix to file routine

= 1.5 =
* Update if you are having problems with URLs not being shortened - this will add debugging facilities

= 1.4 =
* Update if you are using PHP 4

= 1.3 =
* New services - 2Zeus, 9mp, BudURL, HURL, kl.am, Lnk.by, to.vg, url.co.uk. You only need to upgrade is you want to use any of these