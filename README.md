# MODX SEO Tab - The best way to perform in search engines
![SEO Tab version](https://img.shields.io/badge/version-2.0.0-blue.svg) ![MODX Extra by Sterc](https://img.shields.io/badge/checked%20by-sterc-ff69b4.svg) ![MODX version requirements](https://img.shields.io/badge/modx%20version%20requirement-2.4%2B-brightgreen.svg)

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

## Upgrade risks
First of all: ALWAYS MAKE A BACKUP BEFORE UPDATING! Especially the modx_site_content database table in this case.

Upgrading to 2.0.0 from 1.* is highly recommended, but it does introduce some risks. SEO Tab 1.* stored the 301 redirects into the properties-column of a resource. SEO Tab 2 stores it in a seperate database table. This means a migration is needed. The migration-process is memory-intensive and might take a very long time, so just let it roll until it mentions a finished migration.

Possible problems (and solutions):
- Long migration-process because of many resources and redirects (think of 1000+ resource websites). Not really a problem, but if you have a big site, just plan your update at a low-traffic time, because redirects won't work 100% during the migration.
- A blank page with a 500 error. This usually is because of memory issues. Try to re-run the migration with a lower limit and queryLimit. It is currently set to limit:1000 and queryLimit=100. Try setting it to 500 and 50 in core/components/stercseo/processors/mgr/redirect/migrate.class.php
- If you somehow end up with an unfinished migration and the migration-notice is gone, you can fix it by setting the SystemSetting stercseo.migration_status to 0.

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
type||Specify a sitemap type to generate a sitemap index page or an images sitemap. Possible values are: index/images.
indexOuterTpl|sitemap/index/outertpl|Refer to a chunk here to change the outer template, which contains rows of rowTpl's for the sitemap index.
indexRowTpl|sitemap/index/rowtpl|Refer to a chunk here to change the rowTpl which is repeated for every sitemap which is included in the index sitemap.
imagesOuterTpl|sitemap/images/outertpl|Refer to a chunk here to change the outer template, which contains rows of rowTpl's for the images sitemap.
imagesRowTpl|sitemap/images/rowtpl|Refer to a chunk here to change the rowTpl which is repeated for every resource which is included in the images sitemap which can contain multiple images.
imageTpl|sitemap/images/imagetpl|Refer to a chunk here to change the imageTpl which is repeated for every image which is included for a resource
templates||Specify a comma delimited list of template ID's to generate a template specific sitemap for. In order to exclude templates from a sitemap prepend the template ID with an "-". For example: &templates=`-1,2,3`

An example of a sitemap-call with all properties set to a default-value would be:
```HTML
[[!StercSeoSiteMap? &contexts=`web` &allowSymlinks=`0` &outerTpl=`sitemap/outertpl` &rowTpl=`sitemap/rowtpl`]]
```

### Creating an index sitemap and template specific sitemaps
In order to create an index sitemap please follow the steps below:
1. Create a Google Sitemap page as you would normally do and add the parameter &type=`index`, for example:
```HTML
[[!StercSeoSiteMap? &type=`index`]]
```
2. Add child resources to the page you just created and add template specific sitemaps usting the parameter &templates=``, for example:
```HTML
[[!StercSeoSiteMap? &templates=`-1,2,3`]]
```

Now these template specific templates will show up on your Sitemap index page.

### Image sitemap
The image sitemap will generate a sitemap of your MODX resources and the images it contains based on the images that are set in:
* Image TV's
* MIGX TV's with a inputTVtype of image (Also works with using MIGX configs)

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
<meta name="robots" content="noodp,noydir,noindex">
```

We add noopd,noydir by default, because we don't want the [Open Directory Project](http://www.dmoz.org/) and the Yahoo Directory (deprecated) to change how are pages are displayed within Google.

## Bugs and feature requests
We greatly value your feedback, feature requests and bug reports. Please issue them on [Github](https://github.com/Sterc/SEOTab/issues/new).
