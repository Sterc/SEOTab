<?php
/**
 * SEO Tab Dutch language file
 *
 * @author Sterc <modx@sterc.nl> - Sterc Internet & Marketing
 *
 * @package stercseo
 * @subpackage lexicon
 */

$_lang['stercseo.seo'] = 'StercSEO';
$_lang['stercseo.seotab'] = 'SEO Tab';
$_lang['stercseo.menu_desc'] = 'Beheer al je SEO Tab 301 redirects.';

//Tab Findability

$_lang['stercseo.findability'] = 'Vindbaarheid';

$_lang['stercseo.index'] = 'Opnemen in zoekmachines';
$_lang['stercseo.index_yes'] = 'Ja, deze pagina mag geïndexeerd worden';
$_lang['stercseo.index_no'] = 'Nee, deze pagina mag niet geïndexeerd worden (noindex)';
$_lang['stercseo.index_desc'] = 'Let op: irrelevante pagina\'s van je site moeten worden weggelaten uit de zoekmachines én sitemap. Voorbeelden van irrelevante pagina\'s zijn: disclaimer, algemene voorwaarden, privacy policy.';

$_lang['stercseo.follow'] = 'Links volgen';
$_lang['stercseo.follow_yes'] = 'Ja, volg links op deze pagina';
$_lang['stercseo.follow_no'] = 'Nee, geen links volgen op deze pagina (nofollow)';
$_lang['stercseo.follow_desc'] = 'Stel in of zoekmachines de links op deze pagina wel of niet mogen volgen';

$_lang['stercseo.searchable'] = 'Opnemen in interne zoekmachine';
$_lang['stercseo.searchable_yes'] = 'Ja, deze pagina opnemen in de interne zoekmachine';
$_lang['stercseo.searchable_no'] = 'Nee, verberg deze pagina voor de interne zoekmachine';
$_lang['stercseo.searchable_desc'] = 'Stel in of deze pagina mag worden opgenomen in de interne zoekresultaten van je website. Een voorbeeld van een pagina die overbodig is in je zoekresultaten is de bedankpagina van een contactformulier';

//Tab Sitemap
$_lang['stercseo.sitemap'] = 'Google Sitemap';

$_lang['stercseo.sitemap_include'] = 'Opnemen in Google Sitemap';
$_lang['stercseo.sitemap_include_yes'] = 'Ja, neem deze pagina op in Google Sitemap';
$_lang['stercseo.sitemap_include_no'] = 'Nee, verberg deze pagina voor Google Sitemap';
$_lang['stercseo.sitemap_include_desc'] = 'Stel in of deze pagina wel of niet opgenomen mag worden in de sitemap voor Google';

$_lang['stercseo.priority'] = 'Prioriteit';
$_lang['stercseo.priority_important'] = '1.0 - Hoog';
$_lang['stercseo.priority_normal'] = '0.5 - Normaal';
$_lang['stercseo.priority_nopriority'] = '0.25 - Laag';
$_lang['stercseo.priority_desc'] = 'Geef zoekmachines een indicatie van het belang van deze pagina door de prioriteit in te stellen. Let op: je prioriteit wordt niet blindelings overgenomen door zoekmachines.';

$_lang['stercseo.changefreq'] = 'Update frequentie';
$_lang['stercseo.changefreq_daily'] = 'Dagelijks';
$_lang['stercseo.changefreq_weekly'] = 'Wekelijks';
$_lang['stercseo.changefreq_monthly'] = 'Maandelijks';
$_lang['stercseo.changefreq_desc'] = 'Geef aan hoe vaak je verwacht dat deze pagina verandert van inhoud.';


//Tab Redirects
$_lang['stercseo.redirects'] = '301 Redirects';
$_lang['stercseo.uri_add'] = 'Oude URL toevoegen';
$_lang['stercseo.uri_header'] = 'Hieronder staat een overzicht van oude URL\'s voor deze pagina';
$_lang['stercseo.grid_noresults'] = '<h4>Geen redirects</h4><p>Er zijn geen redirects voor deze pagina ingesteld.</p>';
$_lang['stercseo.redirects_desc'] = 'Elke wijziging op je pagina heeft invloed op zoekmachines. Bij het wijzigen van de URL van een pagina betekent dit dat je álle opgebouwde zoekmachine-waarde (juice) kwijtraakt. Met 301 redirects raak je deze waarde niet kwijt. StercSEO voegt automatisch 301 redirects toe na het wijzigen van de URI van je pagina.';
$_lang['stercseo.alreadyexists'] = '[[++site_URI]]<strong>[[+URI]]</strong> is al toegevoegd aan de pagina: <strong>[[+pagetitle]] ([[+id]])</strong>';
$_lang['stercseo.uri_label'] = 'Vul de volledige url (bv. http://www.google.com) die je als redirect wilt toevoegen';

//Tab Freeze URL
$_lang['stercseo.freeze_uri'] = 'Freeze URL';
$_lang['stercseo.uri_override'] = 'Stel een Freeze URL in voor deze pagina';
$_lang['stercseo.uri_after'] = 'URL ná ';

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
