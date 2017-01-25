<?php
/**
 * SEOTab English language file
 *
 * @author Sterc <modx@sterc.nl> - Sterc Internet & Marketing
 *
 * @package stercseo
 * @subpackage lexicon
 */

$_lang['stercseo.seo'] = 'StercSEO';
$_lang['stercseo.seotab'] = 'SEO Tab';
$_lang['stercseo.menu_desc'] = 'Manage all your SEO Tab 301 redirects.';

//Tab Findability
$_lang['stercseo.findability'] = 'Findability';

$_lang['stercseo.index'] = 'Include in search engines (index/noindex)';
$_lang['stercseo.index_yes'] = 'Yes, include in search engines (index)';
$_lang['stercseo.index_no'] = 'No, do not include in search engines (noindex)';
$_lang['stercseo.index_desc'] = 'Irrelevant pages shouldn\'t be indexed in search engines. Irrelevant page examples: disclaimer, terms and conditions, privacy policy.';

$_lang['stercseo.follow'] = 'Follow links (follow/nofollow)';
$_lang['stercseo.follow_yes'] = 'Yes, follow links on this page (follow)';
$_lang['stercseo.follow_no'] = 'No, do not follow links on this page (nofollow)';
$_lang['stercseo.follow_desc'] = 'Should search engines follow links on this page.';

$_lang['stercseo.searchable'] = 'Include in internal search results';
$_lang['stercseo.searchable_yes'] = 'Yes, include in internal search results';
$_lang['stercseo.searchable_no'] = 'No, exclude from internal search results';
$_lang['stercseo.searchable_desc'] = 'Should this page be included in the internal search results of your website. "Thank you"-pages are good examples of pages which should be excluded.';

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
$_lang['stercseo.priority_desc'] = 'Set the priority level to indicate to search engines how important a page is. Higher is more important. Please note: search engines will not blindly accept your priority level.';

$_lang['stercseo.changefreq'] = 'Update frequency';
$_lang['stercseo.changefreq_daily'] = 'Daily';
$_lang['stercseo.changefreq_weekly'] = 'Weekly';
$_lang['stercseo.changefreq_monthly'] = 'Monthly';
$_lang['stercseo.changefreq_desc'] = 'Specify how often you expect the content of this page to change.';

//Tab Redirects
$_lang['stercseo.redirects'] = '301 Redirects';
$_lang['stercseo.uri_add'] = 'Create 301 redirect';
$_lang['stercseo.uri_header'] = 'Old URLs redirecting to this page.';
$_lang['stercseo.grid_noresults'] = '<h4>No redirects</h4><p>There are no redirects set for this page.</p>';
$_lang['stercseo.redirects_desc'] = 'Any change on your page affects search engines, but changing the URL of a page without adding a 301 redirect, will result in losing ALL acquired value. With SEO Tab\'s 301 redirects your search engine value will be retained! To help prevent this, SEO Tab automatically adds 301 redirects when you change the URL of a page.';
$_lang['stercseo.alreadyexists'] = '<b>[[+url]]</b> has already been added to resource: <b>[[+pagetitle]] (id: [[+id]]) - <a href="[[+link]]" target="_blank">Edit in new window</a></b>';
$_lang['stercseo.uri_label'] = 'Enter the full url (ex. http://www.google.com) you want to redirect';
$_lang['stercseo.url_missing_protocol'] = 'Incorrect url. Please add http:// or https://';

//Tab Freeze URL
$_lang['stercseo.freeze_uri'] = 'Freeze URL';
$_lang['stercseo.uri_override'] = 'Set a Freeze URL for this page';
$_lang['stercseo.uri_after'] = 'URL after ';
$_lang['stercseo.uri_after_desc'] = 'Freeze URLs can be used to create short URLs. 
For example, to set this page URL to [[+site_url]]short-url", enter "short-url" in the field below.';

//Settings
$_lang['setting_stercseo.context-aware-alias'] = '301 Redirects are unique per context';
$_lang['setting_stercseo.context-aware-alias_desc'] = 'Make old urls unique to context';
$_lang['setting_stercseo.index'] = 'Default resource setting: Include in search engines';
$_lang['setting_stercseo.index_desc'] = 'Include new pages in search engines per default';
$_lang['setting_stercseo.follow'] = 'Default resource setting: Following links';
$_lang['setting_stercseo.follow_desc'] = 'Follow links on new pages per default';
$_lang['setting_stercseo.sitemap'] = 'Default resource setting: Include pages in the Google Sitemap';
$_lang['setting_stercseo.sitemap_desc'] = 'Include new pages in sitemap.xml per default';
$_lang['setting_stercseo.priority'] = 'Default resource setting: Priority';
$_lang['setting_stercseo.priority_desc'] = 'Priority of page in sitemap.xml (0.25 or 0.5 or 1)';
$_lang['setting_stercseo.changefreq'] = 'Default resource setting: Update frequency';
$_lang['setting_stercseo.changefreq_desc'] = 'Default frequency (daily, weekly, monthly)';
$_lang['setting_stercseo.hide_from_usergroups'] = 'Hide SEO Tab from these usergroups';
$_lang['setting_stercseo.hide_from_usergroups_desc'] = 'Comma separated list of usergroups who are not allowed to access SEO Tab';

// CMP
$_lang['stercseo.redirects.description'] = 'Here you can view and manage your 301 redirects. Redirects can also be added from the resource create and update pages.';
$_lang['stercseo.uri'] = 'Old url (url to redirect)';
$_lang['stercseo.target'] = 'Target resource / url';
$_lang['stercseo.uri_update'] = 'Update redirect';
$_lang['stercseo.uri_remove'] = 'Remove redirect';
$_lang['stercseo.uri_remove_confirm'] = 'Are you sure you want to remove this redirect?';
$_lang['stercseo.migrate'] = 'Migrate redirects';
$_lang['stercseo.migrate_desc'] = 'Here you can migrate your redirects (SEO Tab version 1.2.2 and below) from resource properties to seoUrl objects. This page will automatically migrate all the redirects for you, so no action is required, but please keep this page open for SEO Tab to correctly handle the migration process.';
$_lang['stercseo.migrate_alert'] = 'Your SEO Tab redirects need to be migrated. Click here to visit the migration page.';
$_lang['stercseo.migrate_status'] = 'Status';
$_lang['stercseo.migrate_running'] = 'Currently running migration process. Please keep this page open in your browser.';
$_lang['stercseo.migrate_success'] = 'Migration completed';
$_lang['stercseo.migrate_success_msg'] = 'All your redirects have been successfully migrated.';
