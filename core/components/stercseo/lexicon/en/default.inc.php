<?php
/**
 * SEOTab English language file
 *
 * @author Sterc <modx@sterc.nl> - Sterc Internet & Marketing
 *
 * @package stercseo
 * @subpackage lexicon
 */

$_lang['stercseo.seo'] = 'SEO Tab';
$_lang['stercseo.seotab'] = 'SEO Tab';
$_lang['stercseo.menu_desc'] = 'Manage all your SEO Tab 301 redirects.';

//Tab Findability
$_lang['stercseo.findability'] = 'Findability';
$_lang['stercseo.index'] = 'Include this page in search engines? (index/noindex)';
$_lang['stercseo.index_yes'] = 'Yes (index)';
$_lang['stercseo.index_no'] = 'No (noindex)';
$_lang['stercseo.index_desc'] = 'You may wish to exclude pages such as disclaimer, terms and conditions and your privacy policy from being indexed by search engines.';

$_lang['stercseo.follow'] = 'Follow links on this page? (follow/nofollow)';
$_lang['stercseo.follow_yes'] = 'Yes (follow)';
$_lang['stercseo.follow_no'] = 'No (nofollow)';
$_lang['stercseo.follow_desc'] = 'Should search engines follow links on this page?';

$_lang['stercseo.searchable'] = 'Include this page in internal search results?';
$_lang['stercseo.searchable_yes'] = 'Yes';
$_lang['stercseo.searchable_no'] = 'No';
$_lang['stercseo.searchable_desc'] = '"Thank you"-pages and "404 not found"-pages are good examples of pages which should NOT be included.';

//Tab Sitemap
$_lang['stercseo.sitemap'] = 'Google Sitemap';

$_lang['stercseo.sitemap_include'] = 'Include this page in the Google Sitemap?';
$_lang['stercseo.sitemap_include_yes'] = 'Yes';
$_lang['stercseo.sitemap_include_no'] = 'No';
$_lang['stercseo.sitemap_include_desc'] = 'Set whether this page may or may not be included in the sitemap for Google.';

$_lang['stercseo.priority'] = 'Priority';
$_lang['stercseo.priority_important'] = '1.0 - High';
$_lang['stercseo.priority_normal'] = '0.5 - Normal';
$_lang['stercseo.priority_nopriority'] = '0.25 - Low';
$_lang['stercseo.priority_desc'] = 'Set the priority level to indicate to search engines how important this page is. Higher is more important. Please note: search engines will not blindly accept your priority level!';

$_lang['stercseo.changefreq'] = 'Update frequency';
$_lang['stercseo.changefreq_daily'] = 'Daily';
$_lang['stercseo.changefreq_weekly'] = 'Weekly';
$_lang['stercseo.changefreq_monthly'] = 'Monthly';
$_lang['stercseo.changefreq_desc'] = 'Specify how often you expect the content of this page to change.';

//Tab Redirects
$_lang['stercseo.redirects'] = '301 Redirects';
$_lang['stercseo.uri_add'] = 'Create a 301 redirect';
$_lang['stercseo.uri_header'] = 'Old URLs redirecting to this page:';
$_lang['stercseo.grid_noresults'] = '<h4>No redirects</h4><p>There are no redirects set for this page.</p>';
$_lang['stercseo.redirects_desc'] = 'Changing the URL of a page without adding a 301 redirect, will result in losing ALL acquired search engine value of that page. With SEO Tab\'s 301 redirects that value will be retained! To help you, SEO Tab automatically adds 301 redirects when you change the URL of a page. To delete a 301 redirect, right-click on it.';
$_lang['stercseo.alreadyexists'] = '<b>[[+url]]</b> has already been added to resource: <b>[[+pagetitle]] (id: [[+id]]) - <a href="[[+link]]" target="_blank">Edit in new window</a></b>';
$_lang['stercseo.uri_label'] = 'Old URL';
$_lang['stercseo.uri_label_desc'] = 'Enter the full URL, including your domain. Example: "https://www.site.tld/old-pages/about-us".';
$_lang['stercseo.url_missing_protocol'] = 'Incorrect URL. Please add: http:// or https://';

//Tab Freeze URL
$_lang['stercseo.freeze_uri'] = 'Freeze URL';
$_lang['stercseo.uri_override'] = 'Set a Freeze URL for this page.';
$_lang['stercseo.uri_after'] = 'URL after [[+site_url]]';
$_lang['stercseo.uri_after_desc'] = 'Freeze URLs can be used to create user-friendly URLs. 
For example, to set this page URL to [[+site_url]]user-friendly-url", enter "user-friendly-url" in the field above.';

//Settings
$_lang['setting_stercseo.context-aware-alias'] = '301 Redirects are unique per context';
$_lang['setting_stercseo.context-aware-alias_desc'] = 'Make old URLs unique to context';
$_lang['setting_stercseo.index'] = 'Default resource setting: include in search engines';
$_lang['setting_stercseo.index_desc'] = 'Include new pages in search engines per default';
$_lang['setting_stercseo.follow'] = 'Default resource setting: following links';
$_lang['setting_stercseo.follow_desc'] = 'Follow links on new pages per default';
$_lang['setting_stercseo.sitemap'] = 'Default resource setting: include pages in Google Sitemap';
$_lang['setting_stercseo.sitemap_desc'] = 'Include new pages in Google Sitemap per default';
$_lang['setting_stercseo.priority'] = 'Default resource setting: priority';
$_lang['setting_stercseo.priority_desc'] = 'Priority of page in sitemap.xml (0.25 or 0.5 or 1)';
$_lang['setting_stercseo.changefreq'] = 'Default resource setting: update frequency';
$_lang['setting_stercseo.changefreq_desc'] = 'Default frequency (daily, weekly, monthly)';
$_lang['setting_stercseo.hide_from_usergroups'] = 'Hide SEO Tab from these usergroups';
$_lang['setting_stercseo.hide_from_usergroups_desc'] = 'Comma separated list of usergroups who are not allowed to access SEO Tab';

// CMP
$_lang['stercseo.redirects.description'] = 'Manage your SEO Tab 301 redirects. 
Redirects can also be added when editing a resource by clicking the tab called "SEO".';
$_lang['stercseo.redirects.window_title'] = 'Add redirect URL';
$_lang['stercseo.uri'] = 'Old URL (URL to redirect)';
$_lang['stercseo.target'] = 'New URL / Resource';
$_lang['stercseo.uri_update'] = 'Update redirect';
$_lang['stercseo.uri_remove'] = 'Remove redirect';
$_lang['stercseo.uri_remove_confirm'] = 'Are you sure you want to remove this redirect?';
$_lang['stercseo.migrate'] = 'Migrate redirects';
$_lang['stercseo.migrate_desc'] = 'Upgrading to 2.0.0 from 1.* is highly recommended, but it does introduce some risks. SEO Tab 1.* stored the 301 redirects into the properties-column of a resource. SEO Tab 2 stores it in a seperate database table. This means a migration is needed. The migration-process is memory-intensive and might take a very long time, so just let it roll until it mentions a finished migration.<br /><br />The migration is running while you read this. This page will automatically migrate all the redirects for you, so no action is required, but please keep this page open for SEO Tab to correctly handle the migration process.';
$_lang['stercseo.migrate_alert'] = 'SEO Tab was updated, but your 301 redirects need to be migrated. Click here to start the migration.';
$_lang['stercseo.migrate_status'] = 'Status';
$_lang['stercseo.migrate_running'] = 'Currently running migration process in the background. Please keep this page open in your browser. DO NOT CLOSE THIS PAGE!';
$_lang['stercseo.migrate_success'] = 'Migration completed';
$_lang['stercseo.migrate_success_msg'] = 'All your redirects have been successfully migrated.';
