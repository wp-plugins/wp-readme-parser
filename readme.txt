=== WP README Parser ===
Contributors: dartiss
Donate link: http://artiss.co.uk/donate
Tags: README, Markdown, Parser, View, Plugin
Requires at least: 2.0.0
Tested up to: 3.0.1
Stable tag: 1.0

WP README Parser will display a WordPress plugin's README file in XHTML format, for embedding on a post or page.

== Description ==

WordPress README files are formatted using a version of the Markdown language. This plugin can be used to convert these to XHTML and, hence, displayed, formatted for post or page.

WP README Parser is operated via a WordPress shortcode, the basic syntax of which is...

`[readme]Plugin name[/readme]`

Where "Plugin Name" is the name of the plugin in question - in this case the README will be read from the WordPress repository. Alternatively, you can specify a URL for where the README file is held.

The README will then be shown. The only part of the file that is excluded automatically is the first heading, which is the name of the plugin - it is assumed that you have already added this to your post/page or are using it as the title.

A number of optional parameters can be used...

**exclude**

Each README is divided into a number of section. If you wish to exclude any from the output then use this parameter to list them.

Before the first section (usually "Description") is a number of pieces of "meta data" about the plugin, including tags, etc. Links are automatically added to these. If, however, you wish to just exclude this data then you should use the section name of "meta". Underneath this data is a short description which will remain in this case. If you want to remove this description and the meta data then use the section name of "head". If you wish to just remove a particular bit of meta data then specify `contributors`, `donate`, `tags`, `requires`, `tested` or `stable`.

For example...

`[readme exclude=Meta,Changelog]Plugin name[/readme]`

This will display the entire README with the exception of the Changelog and the Plugin meta.

**ext**

If screenshots are present then these will be displayed. By default .PNG images will be shown - if the screenshots are in another format, then specify this here (.gif, .jpg or .jpeg). Mixed types are not supported.

For example...

`[readme ext=gif]Plugin name[/readme]`

**target**

Any links will have a target of `_blank`. If you wish this to be anything else then change it with this parameter. For example...

`[readme target=_self]Plugin name[/readme]`

**nofollow**

If you wish a link to have a nofollow option (i.e. the tag of `rel="nofollow"`) then specify this as "Yes". By default it won't. For example...

`[readme nofollow=Yes]Plugin name[/readme]`

== Using Simple Content Reveal ==

If you also have the plugin [Simple Content Reveal](http://www.artiss.co.uk/simple-content-reveal "Simple Content Reveal") installed, then each section of the README will be collapsable - that is, you can click on the section heading to hide the section content.

By default, all sections of the output will be revealed.

You may now use 3 further parameters when using the `[readme]` shortcode...

**hide**

Use this parameter to hide sections automatically - simply click on them to reveal them again.

For example...

`[readme hide=Changelog]Plugin name[/readme]`

**scr_url**

If you wish to supply your own hide/reveal images then you can specify your own folder here.

The two images (one for when the content is hidden, another for when it's shown) must be named image1 and image2. They can either by GIF or PNG images (see the next parameter).

For example...

`[readme scr_url="http://www.artiss.co.uk"]Plugin name[/readme]`

**scr_ext**

Use this specify whether you wish to use PNG or GIF images for your own hide/reveal images. If you do not specify it, GIF will be used.

For example...

`[readme scr_url="http://www.artiss.co.uk" scr_ext=png]Plugin name[/readme]`

== Installation ==

1. Upload the entire `wp-readme-parser` folder to your `wp-content/plugins/` directory.
2. Activate the plugin through the WordPress 'Plugins' menu.
3. Insert the shortcode into any posts or pages - no settings screen exists.

== Screenshots ==

1. Example of [Simple Timed Content](http://www.artiss.co.uk/simple-timed-content "Simple Timed Content") README being displayed on artiss.co.uk website.

== Frequently Asked Questions ==

= Can I change the look of the output? =

You can. The whole output is encased in a `<div>` with an `id` of `np-` followed by the plugin name (lower case and spaces converted to dashes).

Each section that has a `<div>` around it with an `id` of `np-` followed by the section name (lower case and spaces converted to dashes)

The download link has an additional `<div>` around it with an `id` of `np-download-link`.

Screenshots have a `<div>` with an `id` of `np-screenshotx`, where `x` is the screenshot number.

Each of these `div`'s can therefore be styled using your theme stylesheet.

= How can I get help or request possible changes =

Feel free to report any problems, or suggestions for enhancements, to me either via [my contact form](http://www.artiss.co.uk/contact "Contact Me") or by [the plugins' homepage](http://www.artiss.co.uk/wp-readme-parser "WP README Parser").

== Acknowledgements ==

WP README Parser uses [PHP Markdown Extra](http://michelf.com/projects/php-markdown/extra/ "PHP Markdown Extra") by Michel Fortin.

== Changelog ==  
  
= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.0 =
* Initial release