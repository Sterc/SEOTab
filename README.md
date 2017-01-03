# MODX SEO Tab - The best way to perform in search engines
![SEO Tab version](https://img.shields.io/badge/version-2.0-blue.svg) ![MODX Extra by Sterc](https://img.shields.io/badge/checked%20by-sterc-ff69b4.svg) ![MODX version requirements](https://img.shields.io/badge/modx%20version%20requirement-2.5%2B-brightgreen.svg)

SEO Tab is a MODX Extra that helps you optimize your pages for the best possible performance in search engines, like Google.

### Key features of SEO Tab:
- Manage search engine visibility (noindex, nofollow)
- Manage internal search engine behavior
- Manage your Google XML Sitemap(s)
- Manage 301 redirects
- Automatically generate 301 redirects when changing a resource URL
- Freeze URL functionality is moved into the SEO-tab

## Installation
Simply install it through the top menu ```Extras > Installer``` and search for ```SEO Tab```. Install it from there. After installing it, it is recommended to clear your MODX cache, through the top menu ```Manage > Clear Cache```.

## Usage
SEO Tab is automatically enabled after install. Don't forget to clear your cache.

## Using the Google XML Sitemap
You have to manually create a resource within MODX, ```Template: (empty)```. go to the tab ```Settings``` and set ```Content Type: XML```, ```Cachable``` and ```Rich Text``` should be ticked off. In the content field, use the following code:


```HTML
[[!StercSeoSiteMap]]
```

The sitemap-snippet has multiple (all optional) properties.

Property | Default value | Description
---|---|---
contexts|web|Specify one or more contextKey's, separated by a comma.
allowSymlinks|0|Set this to ```1``` if you want to include symlinks in your sitemap.
outerTpl|sitemap/outertpl|Refer to a chunk here to change the outer template, which contains rows of rowTpl's (see below).
rowTpl|sitemap/rowtpl|Refer to a chunk here to change the rowTpl which is repeated for every resource which is included in the sitemap.

An example of a sitemap-call with all properties set to a default-value would be:
```HTML
[[!StercSeoSiteMap? &contexts=`web` &allowSymlinks=`0` &outerTpl=`sitemap/outertpl` &rowTpl=`sitemap/rowtpl`]]
```

## Using the robots-tag
Within the tab ```SEO > Findability```, you can manage three options which determine the robots-tag. If you leave out a robots-tag and do not have a robots.txt in your website-root, the Search engine will use the following robots-tag:
```HTML
<meta name="robots" content="index, follow">
```

The settings ```Include in search engines``` and ```Following links``` result in two placeholders which you can add to your template/chunks:

```HTML
<meta name="robots" content="[[+seoTab.robotsTag]]">
```

If you set ```Include in search engines``` to ```no```, it will generate the following HTML:

```HTML
<meta name="robots" content="noopd,noydir,noindex">
```

We add noopd,noydir by default, because we don't want the [Open Directory Project](http://www.dmoz.org/) and the Yahoo Directory (deprecated) to change how are pages are displayed within Google.


## Description
MODX SEO Tab is a MODX package that helps you manage your pages in Google. It allows you to:
- Manage noindex, nofollow
- Manage internal search engine behavior
- Manage your Google Sitemap
- Manage 301 redirects
- Automatically generate 301 redirects when changing a resource URL from the resource itself

## Bugs and feature requests
We greatly value your feedback, feature requests and bug reports. Please issue them on [Github](https://github.com/Sterc/SEOTab/issues/new).
