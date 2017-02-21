--------------------
SEO Tab
--------------------
Version: 2.0.0-pl
Author: Sterc <modx@sterc.nl>
License: GNU GPLv2
--------------------
=== MODX SEO TAB - THE BEST WAY TO PERFORM IN SEARCH ENIGINES ===
SEO Tab is a MODX Extra that helps you optimize your pages for the best possible performance in search engines, like Google.

== KEY FEATURES OF SEO TAB ==
> Manage search engine visibility (noindex, nofollow)
> Manage internal search engine behavior
> Manage your Google XML Sitemap(s)
> Manage 301 redirects
> Automatically generate 301 redirects when changing a resource URL
> Freeze URL functionality is moved into the SEO-tab

== INSTALLATION ==
Simply install it through the top menu Extras > Installer and search for SEO Tab. Install it from there. After installing it, it is recommended to clear your MODX cache, through the top menu Manage > Clear Cache.

== USAGE ==
SEO Tab is automatically enabled after install. Don't forget to clear your cache.

== USING THE GOOGLE XML SITEMAP ==
You have to manually create a resource within MODX: 'Template: (empty)'. Go to the tab 'Settings' and set 'Content Type: XML', 'Cachable' and 'Rich Text' should be ticked off. In the content field, use the following code: [[!StercSeoSiteMap]]

The sitemap-snippet has multiple (all optional) properties:
PROPERTY    	DEFAULT VALUE	    DESCRIPTION
contexts	    web	                Specify one or more contextKey's, separated by a comma.
allowSymlinks	0	                Set this to 1 if you want to include symlinks in your sitemap.
outerTpl	    sitemap/outertpl	Refer to a chunk here to change the outer template, which contains rows of rowTpl's (see below).
rowTpl	        sitemap/rowtpl	    Refer to a chunk here to change the rowTpl which is repeated for every resource which is included in the sitemap.

An example of a sitemap-call with all properties set to a default-value would be:
[[!StercSeoSiteMap? &contexts=`web` &allowSymlinks=`0` &outerTpl=`sitemap/outertpl` &rowTpl=`sitemap/rowtpl`]]

== USING THE ROBOTS-TAG ==
Within the tab 'SEO > Findability', you can manage three options which determine the robots-tag. If you leave out a robots-tag and do not have a robots.txt in your website-root, the search engine will use the following robots-tag:
<meta name="robots" content="index, follow">

The settings 'Include in search engines' and 'Following links' result in two placeholders which you can add to your template/chunks:
<meta name="robots" content="[[+seoTab.robotsTag]]">

If you set 'Include in search engines' to 'no', it will generate the following HTML:
<meta name="robots" content="noopd,noydir,noindex">

We add 'noopd,noydir' by default, because we don't want the Open Directory Project and the Yahoo Directory (deprecated) to change how are pages are displayed within Google.

== DESCRIPTION ==
MODX SEO Tab is a MODX package that helps you manage your pages in Google. It allows you to:
> Manage noindex, nofollow
> Manage internal search engine behavior
> Manage your Google Sitemap
> Manage 301 redirects
> Automatically generate 301 redirects when changing a resource URL from the resource itself

== BUGS AND FEATURE REQUESTS ==
We greatly value your feedback, feature requests and bug reports. Please issue them on GitHub (https://github.com/Sterc/SEOTab/issues/new).