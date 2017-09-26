<?php
/**
 * SEOTab German language file
 *
 * @author Christian Seel <cs@chsmedien.de>
 * @author Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package stercseo
 * @subpackage lexicon
 */

$_lang['stercseo.seo'] = 'StercSEO';
$_lang['stercseo.seotab'] = 'SEO Tab';
$_lang['stercseo.menu_desc'] = 'Verwalten Sie alle Ihre SEO Tab 301 redirects.';

//Tab Findability
$_lang['stercseo.findability'] = 'Sichtbarkeit';

$_lang['stercseo.index'] = 'In Suchmaschinen anzeigen';
$_lang['stercseo.index_yes'] = 'Ja, Seite soll indexiert werden';
$_lang['stercseo.index_no'] = 'Nein, Seite soll nicht indexiert werden (noindex)';
$_lang['stercseo.index_desc'] = 'Hinweis: Unwichtige Seiten sollten von der Indexierung für Suchmaschinen und von der Sitemap ausgeschlossen werden. Beispiele für unwichtige Seiten sind: Impressum, Haftungsausschluss, AGB, Datenschutzerklärungen.';

$_lang['stercseo.follow'] = 'Links folgen';
$_lang['stercseo.follow_yes'] = 'Ja, Links von dieser Seite folgen';
$_lang['stercseo.follow_no'] = 'Nein, Links von dieser Seite nicht folgen (nofollow)';
$_lang['stercseo.follow_desc'] = 'Legen Sie fest ob Suchmaschinen den Links auf dieser Seite folgen sollen.';

$_lang['stercseo.searchable'] = 'Seite in interner Suche auflisten';
$_lang['stercseo.searchable_yes'] = 'Ja, Seite soll über die interne Suche gefunden werden';
$_lang['stercseo.searchable_no'] = 'Nein, Seite soll nicht über die interne Suche gefunden werden';
$_lang['stercseo.searchable_desc'] = 'Legen Sie fest ob diese Seite über die Suchfunktion auf dieser Website gefunden werden soll oder nicht. Ein Beispiel für eine Seite die ausgeschlossen werden sollte ist z.B. die Bestätigungsseite nach einem Kontaktformular.';

//Tab Sitemap
$_lang['stercseo.sitemap'] = 'Google Sitemap';

$_lang['stercseo.sitemap_include'] = 'Seite zur Google Sitemap XML hinzufügen';
$_lang['stercseo.sitemap_include_yes'] = 'Ja, Seite zur Google Sitemap hinzufügen';
$_lang['stercseo.sitemap_include_no'] = 'Nein, Seite nicht zur Sitemap hinzufügen';
$_lang['stercseo.sitemap_include_desc'] = 'Legen Sie fest ob diese Seite zur XML Sitemap für Google hinzugefügt werden soll oder nicht.';

$_lang['stercseo.priority'] = 'Priorität';
$_lang['stercseo.priority_important'] = '1.0 - Hoch';
$_lang['stercseo.priority_normal'] = '0.5 - Normal';
$_lang['stercseo.priority_nopriority'] = '0.25 - Niedrig';
$_lang['stercseo.priority_desc'] = 'Mit der Priorität geben Sie Suchmaschinen einen Hinweis auf die Bedeutung dieser Seite. Bitte beachten Sie: Suchmaschinen akzeptieren diese Priorität nicht blind und automatisch.';

$_lang['stercseo.changefreq'] = 'Update Frequenz';
$_lang['stercseo.changefreq_daily'] = 'Täglich';
$_lang['stercseo.changefreq_weekly'] = 'Wöchentlich';
$_lang['stercseo.changefreq_monthly'] = 'Monatlich';
$_lang['stercseo.changefreq_desc'] = 'Geben Sie an wie oft der Inhalt dieser Seite sich voraussichtlich ändern wird.';

//Tab Redirects
$_lang['stercseo.redirects'] = '301 Weiterleitungen';
$_lang['stercseo.uri_add'] = 'Alte URL hinzufügen';
$_lang['stercseo.uri_header'] = 'Dies ist eine Liste von alten URLs für diese Seite';
$_lang['stercseo.grid_noresults'] = '<h4>Keine Weiterleitungen</h4><p>Es gibt keine Weiterleitungen für diese Seite</p>';
$_lang['stercseo.redirects_desc'] = 'Jede Änderung an einer Seite beeinflusst Suchmaschinen. Wenn die URL einer Seite geändert wird verliert Sie Ihren gesamten Wert für Suchmaschinen. Mit 301 Weiterleitungen verliert Sie Ihren Wert nicht. 301 Weiterleitungen werden automatisch hinzufügt wenn Sie die URL ändern.';
$_lang['stercseo.alreadyexists'] = '[[++site_URI]]<strong>[[+URI]]</strong> existiert bereits für folgende Seite: <strong>[[+pagetitle]] ([[+id]])</strong>';
$_lang['stercseo.uri_label'] = 'Alte URL';
$_lang['stercseo.uri_label_desc'] = 'Geben Sie die komplette URL. z.B. "https://www.google.com/old-pages/about-us".';
$_lang['stercseo.url_missing_protocol'] = 'Incorrect url. Please add http:// or https://';

//Tab Freeze URL
$_lang['stercseo.freeze_uri'] = 'Feste URL';
$_lang['stercseo.uri_override'] = 'Legen Sie eine feste URL für diese Seite fest';
$_lang['stercseo.uri_after'] = 'URL nach [[+site_url]]';
$_lang['stercseo.uri_after_desc'] = 'Freeze URLs can be used to create short URLs. 
For example, to set this page URL to [[+site_url]]short-url", enter "short-url" in the field below.';

//Settings
$_lang['setting_stercseo.context-aware-alias'] = '301 Weiterleitungen sind eindeutig pro Kontext';
$_lang['setting_stercseo.context-aware-alias_desc'] = 'Alte URLs sind eindeutig pro Kontext, Weiterleitungen funtkionieren also nur innerhalb eines Kontextes';
$_lang['setting_stercseo.index'] = 'Voreinstellung: In Suchmaschinen anzeigen';
$_lang['setting_stercseo.index_desc'] = 'Neue Seiten in Suchmaschine anzeigen? (0, 1)';
$_lang['setting_stercseo.follow'] = 'Voreinstellung: Links folgen';
$_lang['setting_stercseo.follow_desc'] = 'Links auf neuen seiten folgen? (0 = nofollow, 1 = follow)';
$_lang['setting_stercseo.sitemap'] = 'Voreinstellung: Seite zur Google Sitemap XML hinzufügen';
$_lang['setting_stercseo.sitemap_desc'] = 'Neue Seite in sitemap.xml einschließen (0 = nein, 1 = ja)';
$_lang['setting_stercseo.priority'] = 'Voreinstellung: Priorität';
$_lang['setting_stercseo.priority_desc'] = 'Wichtigkeit von neuen Seiten (0.25, 0.5 oder 1)';
$_lang['setting_stercseo.changefreq'] = 'Voreinstellung: Update Frequenz';
$_lang['setting_stercseo.changefreq_desc'] = 'Update Frequenz für neue Seiten (daily, weekly, monthly)';
$_lang['setting_stercseo.hide_from_usergroups'] = 'SEO Tab für diese Benutzergruppen verbergen';
$_lang['setting_stercseo.hide_from_usergroups_desc'] = 'Kommaseparierte Liste von Benutzergruppen, denen nicht erlaubt ist, auf SEO Tab zuzugreifen';

// CMP
$_lang['stercseo.redirects.description'] = 'Hier können Sie Ihre 301 Weiterleitungen anschauen und bearbeiten. Weiterleitungen können ebenso auf den Ressourcen Seiten beim Anlegen und Bearbeiten hinzugefügt werden.';
$_lang['stercseo.redirects.window_title'] = 'Add redirect url';
$_lang['stercseo.uri'] = 'Alte URL (weitergeleitete URL)';
$_lang['stercseo.target'] = 'Ziel Ressource / URL';
$_lang['stercseo.uri_update'] = 'Weiterleitung bearbeiten';
$_lang['stercseo.uri_remove'] = 'Weiterleitung löschen';
$_lang['stercseo.uri_remove_confirm'] = 'Sind Sie sicher, dass Sie diese Weiterleitung löschen wollen?';
$_lang['stercseo.migrate'] = 'Weiterleitung migrieren';
$_lang['stercseo.migrate_desc'] = 'Sie können Ihre Weiterleitung (SEO Tab version 1.2.2 und niedriger) von Ressourcen Eigenschaften zu eigenständigen seoURL Objekten migireren. Dies wird automatisch die Daten aller Weiterleitungen für Sie migrieren. Es ist keine weitere Aktion notwendig. Bitte lassen Sie diese Seite geöffnet, damit SEO Tab die Migrierung korrekt beenden kann.';
$_lang['stercseo.migrate_alert'] = 'Ihre SEO Tab Weiterleitungen müssen migriert werden, bitte klicken Sie hier um die Migrierungs Seite anzuzeigen.';
$_lang['stercseo.migrate_status'] = 'Status';
$_lang['stercseo.migrate_running'] = 'Der Migrierungs-Prozess läuft momentan. Bitte lassen Sie diese Seite geöffnet, damit der Migrierungs-Prozess abgeschlossen werden kann.';
$_lang['stercseo.migrate_success'] = 'Migrierung erfolgreich abgeschlossen';
$_lang['stercseo.migrate_success_msg'] = 'Alle Ihre Weiterleitungen wurden erfolgreich migriert.';
