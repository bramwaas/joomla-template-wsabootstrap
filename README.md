# joomla-template-wsabootstrap

=== Basic Template with Bootstrap and Joomla 6, 5 or 4 ===
Template name: wsa_bootstrap
Contributors: bramwaas
Tags: bootstrap
Requires at least Joomla: 4.1
Tested up to: 6.0
Requires PHP: 7.4
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
 
== Upgrade Notice ==
 
- up to version 1.3.5 compatible with Joomla 3
- from version 1.4 compatible with Joomla 3.8 +
- from version 2.1.0 Bootstrap 3,4,5 and more specific Joomla 4 code. like use of webassets in Joomla 4.
- from version 2.2 Bootstrap 4 and 5 Joomla 4+ (although J 3.8+ may still work)
- from version 2.3 BS 4 and 5 Joomla 4.1+

## Documentation    

Classes for featured articles, category blog, and tagged items and news feeds.<br>
(columns only in desktop view, so wider than desktop view breakpoint can be set in template-style)<br>
Bootstrap make-row for header of the list and make-col-ready and row-cols for items in the list.<br>
.columns-n:<br>
CSS class Page view page class. Works on display of the component.<br>
Blog view(Leading) article class in n columns or n in # Columns for intro articles. Works on the part of the blog.<br>
.photo-album .blog-items img, .blog-items.photo-album img, .com-tags__items .list-group img,<br>
[class*="rssfoto"] .com-newsfeeds-newsfeed__items img<br>
CSS class for all photos in the component with shadow as if pasted into an album<br>
<br>
.photo-in-album<br>
CSS class for a random individual photo with shadow as if pasted into an album<br>
<br>
.rssphoto<br>
CSS class Page view page class. Works on display of the newsfeed component.<br>
Adjustments to newsfeed with photos from Fickr.<br>
<br>
## Copyright and License

This project is licensed under the [GNU GPL], version 3 or later.
2018&thinsp;&ndash;&thinsp;2025 &copy; [Bram Waasdorp](http://www.waasdorpsoekhan.nl).

## Changelog
* 2.4.1 add css for img in figure because joomla admin adds classes for image to figure. Remove unused leafo scss compiler and unused parts of scssphp after
	security alert on both. Replace old scssphp src and bin files with fresh ones from scssphp projec.  
* 2.4.0 (conditional) add scrollspy data-attributes to body
* 2.3.1 solve deprecated messages  "Deprecated: htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated ..."    
* 2.3.0 new structure in connection with inherit/child templates, inheritable is implemented in joomla 4.1. and higher
* 2.2.0 improvements rssfoto newsfeeds for J4,J5, remove suport BS3, use latest versions BS4 and BS5, remove some redundant code.
    original scss files of BS4 and BS5 in folders scss bs4 and bs5.
    New scss compiler scssphp/scssphp 1.13.0 and server scssphp/server 1.1.0 as continuation of leafo/scssphp   
    Remove options for extra/override breakpoints.   
    Implement class .columns-n in component at page level and desktoplay-out for tagged-items, category-blog, newsfeed, and featured-articles.
    For category-blog and featured-articles also in blog-layout ((leading) article class and #columns). 
* 2.1.2 removed hard returns from documentation field because j4.4 + doesn't accept that.
