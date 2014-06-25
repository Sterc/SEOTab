<?php
/**
 * StercSEO Dutch language file
 *
 * @author Wieger Sloot <wieger+stercseo@sterc.nl> - Sterc Internet & Marketing
 *
 * @package stercseo
 * @subpackage lexicon
 */

$_lang['stercseo.seo'] = 'StercSEO';

//Tab Findability

$_lang['stercseo.findability'] = 'Findability';

$_lang['stercseo.index'] = 'Include in search engines';
$_lang['stercseo.index_yes'] = 'Yes, this page may be indexed';
$_lang['stercseo.index_no'] = 'No, this page should not be indexed (noindex)';
$_lang['stercseo.index_desc'] = 'Note: irrelevant pages of your site should be excluded from the search engines and sitemap. Examples of irrelevant pages are: disclaimer, terms and conditions , privacy policy.';

$_lang['stercseo.follow'] = 'Following links';
$_lang['stercseo.follow_yes'] = 'Yes, follow links on this page';
$_lang['stercseo.follow_no'] = 'No, don’t follow links on this page (nofollow)';
$_lang['stercseo.follow_desc'] = 'Set whether the search engines may or may not follow links on this page';

$_lang['stercseo.searchable'] = 'Include pages in internal search engine';
$_lang['stercseo.searchable_yes'] = 'Yes, include this page in the internal search engine';
$_lang['stercseo.searchable_no'] = 'No, hide this page for the internal search engine';
$_lang['stercseo.searchable_desc'] = 'Set whether this page may be included in the internal search results of your website. An example of a page which is redundant in your search results, is the ‘thank you’ page of a contact form.';

//Tab Sitemap
$_lang['stercseo.sitemap'] = 'Google Sitemap';

$_lang['stercseo.sitemap_include'] = 'Include pages in the Google Sitemap';
$_lang['stercseo.sitemap_include_yes'] = 'Yes, include this page in the Google Sitemap';
$_lang['stercseo.sitemap_include_no'] = 'No, hide this page for the Google Sitemap';
$_lang['stercseo.sitemap_include_desc'] = 'Set whether this page may or may not be included in the sitemap for Google';

$_lang['stercseo.priority'] = 'Priority';
$_lang['stercseo.priority_important'] = '1.0 - High';
$_lang['stercseo.priority_normal'] = '0.5 - Normal';
$_lang['stercseo.priority_nopriority'] = '0.25 - Low';
$_lang['stercseo.priority_desc'] = 'By giving the priority level, you give search engines an indication of the importance of the page. Please note: search engines will not blindly accept your priority level.';

$_lang['stercseo.changefreq'] = 'Update frequency';
$_lang['stercseo.changefreq_daily'] = 'Daily';
$_lang['stercseo.changefreq_weekly'] = 'Weekly';
$_lang['stercseo.changefreq_monthly'] = 'Monthly';
$_lang['stercseo.changefreq_desc'] = 'Specify how often (you expect) the content of this page will be changed.';


//Tab Redirects
$_lang['stercseo.redirects'] = '301 Redirects';
$_lang['stercseo.uri_add'] = 'Add Old URL';
$_lang['stercseo.uri_header'] = 'Below is a list of old URLs for this page';
$_lang['stercseo.grid_noresults'] = '<h4>No redirects</h4><p>There are no redirects set for this page.</p>';
$_lang['stercseo.redirects_desc'] = 'Any change on your page affect search engines. Changing the URL of a page will lead to losing ALL acquired search engine value. With 301 redirects you don’t lose this value. StercSEO automatically adds 301 redirects after changing the URL of a page ..';
$_lang['stercseo.alreadyexists'] = '[[++site_URI]]<strong>[[+URI]]</strong> has already been added to the page: <strong>[[+pagetitle]] ([[+id]])</strong>';

//Tab Freeze URL
$_lang['stercseo.freeze_uri'] = 'Freeze URL';
$_lang['stercseo.uri_override'] = 'Set a Freeze URL for this page';
$_lang['stercseo.uri_after'] = 'URL after ';

//Settings
$_lang['setting_stercseo.context-aware-alias'] = '301 Redirects are unique per context';
$_lang['setting_stercseo.context-aware-alias_desc'] = 'make old urls unique to context';
$_lang['setting_stercseo.index'] = 'Default-Setting: Include in search engines';
$_lang['setting_stercseo.index_desc'] = 'Include new pages in search engines per default';
$_lang['setting_stercseo.follow'] = 'Default-Setting: Following links';
$_lang['setting_stercseo.follow_desc'] = 'Follow links on new pages per default';
$_lang['setting_stercseo.sitemap'] = 'Default-Setting: Include pages in the Google Sitemap';
$_lang['setting_stercseo.sitemap_desc'] = 'Include new pages in sitemap.xml per default';
$_lang['setting_stercseo.priority'] = 'Default-Setting: Priority';
$_lang['setting_stercseo.priority_desc'] = 'Priority of page in sitemap.xml (0.25 or 0.5 or 1)';
$_lang['setting_stercseo.changefreq'] = 'Default-Setting: Update frequency';
$_lang['setting_stercseo.changefreq_desc'] = 'Default frequency (daily, weekly, monthly)';





