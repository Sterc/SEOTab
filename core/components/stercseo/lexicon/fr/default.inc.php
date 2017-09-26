<?php
/**
 * SEO Tab French language file
 *
 * @author Sterc <modx@sterc.nl> - Sterc Internet & Marketing
 *
 * @package stercseo
 * @subpackage lexicon
 */

$_lang['stercseo.seo'] = 'StercSEO';
$_lang['stercseo.seotab'] = 'SEO Tab';
$_lang['stercseo.menu_desc'] = 'Gérer tous vos SEO Tab 301 redirects.';

//Tab Findability
$_lang['stercseo.findability'] = 'Trouvabilité';

$_lang['stercseo.index'] = 'Inclure dans les moteurs de recherche';
$_lang['stercseo.index_yes'] = 'Oui, cette page peut être indéxée';
$_lang['stercseo.index_no'] = 'Non, cette page ne doit pas être indéxée (noindex)';
$_lang['stercseo.index_desc'] = 'Note : certaines pages de votre site ne doivent pas être visibles dans les moteurs de recherche et plan de site (sitemap). Par exemple : disclaimer, termes & conditions d\'utilisation, politique de confidentialité.';

$_lang['stercseo.follow'] = 'Suivre les liens';
$_lang['stercseo.follow_yes'] = 'Oui, suivre les liens de cette page';
$_lang['stercseo.follow_no'] = 'Non, ne pas suivre les liens de cette page (nofollow)';
$_lang['stercseo.follow_desc'] = 'Définissez ci les moteurs de recherche doivent (ou ne doivent pas) suivre les liens de cette page';

$_lang['stercseo.searchable'] = 'Inclure les pages dans la recherche interne du site';
$_lang['stercseo.searchable_yes'] = 'Oui, inclure cette page dans la recherche interne';
$_lang['stercseo.searchable_no'] = 'Non, ne pas inclure cette page dans la recherche interne';
$_lang['stercseo.searchable_desc'] = 'Indiquez peut être inclue dans la recherche interne de votre site. Un exemple de page qui peut être superflue : la page de remerciement d\'un formulaire de contact.';

//Tab Sitemap
$_lang['stercseo.sitemap'] = 'Google Sitemap';

$_lang['stercseo.sitemap_include'] = 'Inclure les pages dans Google Sitemap';
$_lang['stercseo.sitemap_include_yes'] = 'Oui, inclure cette page dans Google Sitemap';
$_lang['stercseo.sitemap_include_no'] = 'Non, masquer cette page dans Google Sitemap';
$_lang['stercseo.sitemap_include_desc'] = 'Indiquez si vous souhaitez que cette page apparaîsse dans le plan du site (sitemap) pour Google';

$_lang['stercseo.priority'] = 'Priorité';
$_lang['stercseo.priority_important'] = '1.0 - Élevée';
$_lang['stercseo.priority_normal'] = '0.5 - Normale';
$_lang['stercseo.priority_nopriority'] = '0.25 - Faible';
$_lang['stercseo.priority_desc'] = 'En indiquant un niveau de priorité, vous indiquz aux moteurs de recherche l\'importance de la page. Veuillez noter les moteurs de recherche n\'accepteront pas "aveuglément" vos priorités.';

$_lang['stercseo.changefreq'] = 'Fréquence de mise à jour';
$_lang['stercseo.changefreq_daily'] = 'Journalière';
$_lang['stercseo.changefreq_weekly'] = 'Hebdomadaire';
$_lang['stercseo.changefreq_monthly'] = 'Mensuelle';
$_lang['stercseo.changefreq_desc'] = 'Indiquez la fréquence à laquelle vous estimez que le contenu de cette page sera modifié.';

//Tab Redirects
$_lang['stercseo.redirects'] = 'Redirections 301';
$_lang['stercseo.uri_add'] = 'Ajouter l\'ancienne URL';
$_lang['stercseo.uri_header'] = 'Indiquez ci-dessous la liste des anciennes URLs de cette page';
$_lang['stercseo.grid_noresults'] = '<h4>Aucune redirection</h4><p>Il n\'y a aucune redirection pour cette page.</p>';
$_lang['stercseo.redirects_desc'] = 'Un changement sur votre page affecte les moteurs de recherche. Changer l\'URL d\'une page entraînera la perte de la valeur acquise auprès des moteurs de recherche. Avec des redirections 301, vous ne perdez pas cette valeur. StercSEO ajoute automatiquement des redirections 301 lorsque l\'URL d\'une page change.';
$_lang['stercseo.alreadyexists'] = '[[++site_URI]]<strong>[[+URI]]</strong> a déjà été ajouté à la page : <strong>[[+pagetitle]] ([[+id]])</strong>';
$_lang['stercseo.uri_label'] = 'Old URL';
$_lang['stercseo.uri_label_desc'] = 'Enter the full URL, including your domain. Example: "https://www.google.com/old-pages/about-us".';
$_lang['stercseo.url_missing_protocol'] = 'Incorrect url. Please add http:// or https://';

//Tab Freeze URL
$_lang['stercseo.freeze_uri'] = 'URL fixe';
$_lang['stercseo.uri_override'] = 'Indiquez une URL fixe pour cette page';
$_lang['stercseo.uri_after'] = 'URL après [[+site_url]]';
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
$_lang['stercseo.redirects.description'] = 'Gérez ici vos redirections 301. Les redirections peuvent également être ajoutées depuis les pages de création et d\'édition de ressources.';
$_lang['stercseo.redirects.window_title'] = 'Add redirect url';
$_lang['stercseo.uri'] = 'Ancienne URL (URL à rediriger)';
$_lang['stercseo.target'] = 'Ressource/URL de destination';
$_lang['stercseo.uri_update'] = 'Mettre à jour';
$_lang['stercseo.uri_remove'] = 'Supprimer';
$_lang['stercseo.uri_remove_confirm'] = 'Êtes-vous sûr de vouloir supprimer cette redirection ?';
$_lang['stercseo.migrate'] = 'Migrer les redirections';
$_lang['stercseo.migrate_desc'] = 'Vous pouvez migrez vos redirections (des versions 1.2.2 et antérieures) des propriétés de ressources vers les objets seoUrl. Cette page migrera automatiquement les redirections, aucune action de votre part n\'est requise, mais veuillez garder cette page ouverte afin que SEO Tab puisse gérer correctement le processus de migration.';
$_lang['stercseo.migrate_alert'] = 'Vos redirections ont besoin d\'être migrées. Cliquez ici pour vous rendre à la page de migration.';
$_lang['stercseo.migrate_status'] = 'Statut';
$_lang['stercseo.migrate_running'] = 'Processus de migration en cours. Veuillez garder cette page ouverte dans votre navigateur.';
$_lang['stercseo.migrate_success'] = 'Migration complète';
$_lang['stercseo.migrate_success_msg'] = 'Toutes vos redirections ont été migrées avec succès.';
