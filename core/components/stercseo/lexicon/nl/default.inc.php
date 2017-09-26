<?php
/**
 * SEO Tab Dutch language file
 *
 * @author Sterc <modx@sterc.nl> - Sterc Internet & Marketing
 *
 * @package stercseo
 * @subpackage lexicon
 */

$_lang['stercseo.seo'] = 'SEO Tab';
$_lang['stercseo.seotab'] = 'SEO Tab';
$_lang['stercseo.menu_desc'] = 'Beheer al je SEO Tab 301 redirects.';

//Tab Findability
$_lang['stercseo.findability'] = 'Vindbaarheid';

$_lang['stercseo.index'] = 'Pagina opnemen in zoekmachines? (index/noindex)';
$_lang['stercseo.index_yes'] = 'Ja (index)';
$_lang['stercseo.index_no'] = 'Nee (noindex)';
$_lang['stercseo.index_desc'] = 'Let op: het is beter om irrelevante pagina\'s van je website niet op te nemen in zoekmachines. Voorbeelden van irrelevante pagina\'s zijn: disclaimer, algemene voorwaarden, privacy policy.';

$_lang['stercseo.follow'] = 'Links op deze pagina volgen? (follow/nofollow)';
$_lang['stercseo.follow_yes'] = 'Ja (follow)';
$_lang['stercseo.follow_no'] = 'Nee (nofollow)';
$_lang['stercseo.follow_desc'] = 'Stel in of zoekmachines de links op deze pagina wel of niet mogen volgen.';

$_lang['stercseo.searchable'] = 'Pagina opnemen in interne zoekresultaten?';
$_lang['stercseo.searchable_yes'] = 'Ja';
$_lang['stercseo.searchable_no'] = 'Nee';
$_lang['stercseo.searchable_desc'] = '"Bedankt"-pagina\'s en "404: niet gevonden"-pagina\'s zijn goede voorbeelden van pagina\'s die je beter niet kunt opnemen in je interne zoekresultaten.';

//Tab Sitemap
$_lang['stercseo.sitemap'] = 'Google Sitemap';

$_lang['stercseo.sitemap_include'] = 'Pagina opnemen in Google Sitemap?';
$_lang['stercseo.sitemap_include_yes'] = 'Ja';
$_lang['stercseo.sitemap_include_no'] = 'Nee';
$_lang['stercseo.sitemap_include_desc'] = 'Stel in of deze pagina wel of niet mag worden opgenomen in de sitemap voor Google.';

$_lang['stercseo.priority'] = 'Prioriteit';
$_lang['stercseo.priority_important'] = '1.0 - Hoog';
$_lang['stercseo.priority_normal'] = '0.5 - Normaal';
$_lang['stercseo.priority_nopriority'] = '0.25 - Laag';
$_lang['stercseo.priority_desc'] = 'Geef zoekmachines een indicatie van het belang van deze pagina door de prioriteit in te stellen. Let op: je prioriteit wordt niet blindelings overgenomen door zoekmachines!';

$_lang['stercseo.changefreq'] = 'Update frequentie';
$_lang['stercseo.changefreq_daily'] = 'Dagelijks';
$_lang['stercseo.changefreq_weekly'] = 'Wekelijks';
$_lang['stercseo.changefreq_monthly'] = 'Maandelijks';
$_lang['stercseo.changefreq_desc'] = 'Geef aan hoe vaak je verwacht dat deze pagina van inhoud verandert.';

//Tab Redirects
$_lang['stercseo.redirects'] = '301 Redirects';
$_lang['stercseo.uri_add'] = 'Een 301 redirect toevoegen';
$_lang['stercseo.uri_header'] = 'Oude URL\'s van deze pagina:';
$_lang['stercseo.grid_noresults'] = '<h4>Geen redirects</h4><p>Er zijn geen redirects voor deze pagina ingesteld.</p>';
$_lang['stercseo.redirects_desc'] = 'Wanneer je de URL van een pagina wijzigt, heeft dit ten gevolge dat je álle opgebouwde zoekmachine-waarde (juice) kwijtraakt. Met SEO Tab\'s 301 redirects houd je deze waarde vast! Om je te assisteren, voegt SEO Tab automatisch 301 redirects toe wanneer je de URL van een pagina wijzigt. Klik met je rechtermuisknop op een 301 redirect om deze te verwijderen.';
$_lang['stercseo.alreadyexists'] = '<strong>[[+url]]</strong> is reeds toegevoegd aan de pagina: <strong>[[+pagetitle]] ([[+id]])</strong>.';
$_lang['stercseo.uri_label'] = 'Oude URL';
$_lang['stercseo.uri_label_desc'] = 'Voer een volledige URL in. Bijvoorbeeld: "https://www.site.tld/old-pages/about-us".';
$_lang['stercseo.url_missing_protocol'] = 'Onjuiste URL. Voeg toe: http:// of https://';

//Tab Freeze URL
$_lang['stercseo.freeze_uri'] = 'Freeze URL';
$_lang['stercseo.uri_override'] = 'Stel een Freeze URL in voor deze pagina.';
$_lang['stercseo.uri_after'] = 'URL ná [[+site_url]]';
$_lang['stercseo.uri_after_desc'] = 'Freeze URL\'s kunnen worden gebruikt om URL\'s gebruiksvriendelijk te maken. 
Om bijvoorbeeld de URL "[[+site_url]]gebruiksvriendelijke-url" voor deze pagina in te stellen, voer je "gebruiksvriendelijke-url" in.';

//Settings
$_lang['setting_stercseo.context-aware-alias'] = '301 redirects zijn uniek per context';
$_lang['setting_stercseo.context-aware-alias_desc'] = 'Maak oude URL\'s uniek naar context';
$_lang['setting_stercseo.index'] = 'Standaard bronnen setting: opnemen in zoekmachines';
$_lang['setting_stercseo.index_desc'] = 'Neem nieuwe pagina\'s standaard op in zoekmachines';
$_lang['setting_stercseo.follow'] = 'Standaard bronnen setting: links volgen';
$_lang['setting_stercseo.follow_desc'] = 'Links op nieuwe pagina\'s standaard volgen';
$_lang['setting_stercseo.sitemap'] = 'Standaard bronnen setting: pagina\'s opnemen in Google Sitemap';
$_lang['setting_stercseo.sitemap_desc'] = 'Neem nieuwe pagina\'s standaard op in Google Sitemap';
$_lang['setting_stercseo.priority'] = 'Standaard bronnen setting: prioriteit';
$_lang['setting_stercseo.priority_desc'] = 'Prioriteit van de pagina in sitemap.xml (0.25 or 0.5 or 1)';
$_lang['setting_stercseo.changefreq'] = 'Standaard bronnen setting: update frequentie';
$_lang['setting_stercseo.changefreq_desc'] = 'Standaard frequentie (dagelijks, wekelijks, maandelijks)';
$_lang['setting_stercseo.hide_from_usergroups'] = 'Verberg SEO Tab voor deze gebruikersgroepen';
$_lang['setting_stercseo.hide_from_usergroups_desc'] = 'Komma gescheiden lijst met gebruikersgroepen die geen toegang hebben tot SEO Tab';

// CMP
$_lang['stercseo.redirects.description'] = 'Hier kun je je 301 redirects bekijken en beheren. Redirects kunnen ook worden toegevoegd vanuit de bron maak- en updatepagina\'s.';
$_lang['stercseo.redirects.window_title'] = 'Redirect URL toevoegen';
$_lang['stercseo.uri'] = 'Oude URL (URL naar redirect)';
$_lang['stercseo.target'] = 'Nieuwe URL / Bron';
$_lang['stercseo.uri_update'] = 'Update redirect';
$_lang['stercseo.uri_remove'] = 'Verwijder redirect';
$_lang['stercseo.uri_remove_confirm'] = 'Weet je zeker dat je deze redirect wil verwijderen?';
$_lang['stercseo.migrate'] = 'Migreer redirects';
$_lang['stercseo.migrate_desc'] = 'Hier kun je je redirects (SEO Tab versie 1.2.2 en ouder) migreren van resource properties naar seoUrl objects. Deze pagina migreert al je redirects automatisch, een handeling is dus niet vereist. Houd a.u.b. wel deze pagina open zodat SEO Tab het migratieproces correct kan afhandelen.';
$_lang['stercseo.migrate_alert'] = 'Je SEO Tab redirects moeten worden gemigreerd. Klik hier om de migratie te starten.';
$_lang['stercseo.migrate_status'] = 'Status';
$_lang['stercseo.migrate_running'] = 'Het migratieproces is momenteel bezig op de achtergrond. Houd deze pagina a.u.b. open in je browser. SLUIT DIT VENSTER NIET!';
$_lang['stercseo.migrate_success'] = 'Migratieproces voltooid.';
$_lang['stercseo.migrate_success_msg'] = 'Al je redirects zijn succesvol gemigreerd.';
