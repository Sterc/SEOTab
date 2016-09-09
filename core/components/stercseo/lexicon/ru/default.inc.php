<?php
/**
 * SEOTab Russian language file
 *
 * @author Sterc <modx@sterc.nl> - Sterc Internet & Marketing
 *
 * @package stercseo
 * @subpackage lexicon
 */

$_lang['stercseo.seo'] = 'StercSEO';
$_lang['stercseo.seotab'] = 'SEOTab';

//Tab Findability

$_lang['stercseo.findability'] = 'Видимость';

$_lang['stercseo.index']        = 'Индексируемость поисковиками';
$_lang['stercseo.index_yes']    = 'Да, эта страница может быть индексирована';
$_lang['stercseo.index_no']     = 'Нет, запретить индексирование (noindex)';
$_lang['stercseo.index_desc']   = 'Замечание: нерелевантные страницы Вашего сайта должны быть исключены из поисковых систем и sitemap.xml (карты сайта). Примеры нерелевантных страниц: Отказ от ответственности, сроки и условия, политика конфиденциальности.';

$_lang['stercseo.follow']       = 'Следование по ссылкам';
$_lang['stercseo.follow_yes']   = 'Да, следовать ссылкам на этой странице';
$_lang['stercseo.follow_no']    = 'Нет, не следовать ссылкам на этой странице (nofollow)';
$_lang['stercseo.follow_desc']  = 'Указывает, смогут ли поисковые системы или нет следовать по ссылкам на этой странице';

$_lang['stercseo.searchable']   = 'Участие страницы во внутреннем поиске по сайту';
$_lang['stercseo.searchable_yes'] = 'Да, эта страница должна участвовать во внутреннем поиске по сайту';
$_lang['stercseo.searchable_no'] = 'Нет, исключить эту страницу из внутреннего поиске по сайту';
$_lang['stercseo.searchable_desc'] = 'Указывает, будет ли эта страница учавствовать во внутреннем поиске по вашему сайту. Пример лишней страницы в результатах внутреннего поиска, является страница "Подтверждение отправки заказа/заявки/сообщения".';

//Tab Sitemap
$_lang['stercseo.sitemap'] = 'Карта сайта';

$_lang['stercseo.sitemap_include'] = 'Включение страницы в Sitemap.xml';
$_lang['stercseo.sitemap_include_yes'] = 'Да, показывать эту страницу в Sitemap.xml';
$_lang['stercseo.sitemap_include_no'] = 'Нет, скрыть эту страницу в Sitemap.xml';
$_lang['stercseo.sitemap_include_desc'] = 'Указывает, будет ли или нет эта страница включена в Sitemap.xml';

$_lang['stercseo.priority'] = 'Приоритет';
$_lang['stercseo.priority_important'] = '1.0 - Высокий';
$_lang['stercseo.priority_normal'] = '0.5 - Средний';
$_lang['stercseo.priority_nopriority'] = '0.25 - Низкий';
$_lang['stercseo.priority_desc'] = 'Присваивая высокий приоритет, Вы показываете поисковым системам важность этой страницы. Однако, обратите внимание: поисковые системы не будут точно следовать вашим установкам, а воспримут это как рекомендацию.';

$_lang['stercseo.changefreq'] = 'Частота обновления содержимого';
$_lang['stercseo.changefreq_daily'] = 'Ежедневно';
$_lang['stercseo.changefreq_weekly'] = 'Еженедельно';
$_lang['stercseo.changefreq_monthly'] = 'Ежемесячно';
$_lang['stercseo.changefreq_desc'] = 'Указывает, как часто (вы ожидаете) может меняться конетент (содержимое) этой страницы';


//Tab Redirects
$_lang['stercseo.redirects'] = '301 редиректы';
$_lang['stercseo.uri_add'] = 'Добавить старый URL';
$_lang['stercseo.uri_header'] = 'Ниже список старых URL этой страницы';
$_lang['stercseo.grid_noresults'] = '<h4>Нет редиректов</h4><p>Для этой страницы редиректы не указаны.</p>';
$_lang['stercseo.redirects_desc'] = 'Любые изменения вашей страницы влияют на выдачу в поисковых системах. Изменение URL адреса страницы приведёт к утрате всех наработанных факторов ранжирования. С помощью 301 редиректа Вы не потеряете то, что уже успели заработать. StercSEO автоматически добавляет 301 редиректы (переадресацию), после того, как адрес страницы (URL) изменился.';
$_lang['stercseo.alreadyexists'] = '[[++site_URI]]<strong>[[+URI]]</strong> был добавлен для страницы: <strong>[[+pagetitle]] ([[+id]])</strong>';
$_lang['stercseo.uri_label'] = 'Enter the full url (ex. http://www.google.com) you want to redirect';

//Tab Freeze URL
$_lang['stercseo.freeze_uri'] = 'Заморозить URL';
$_lang['stercseo.uri_override'] = 'Заморозить URL псевдоним для этой страницы';
$_lang['stercseo.uri_after'] = 'Часть адреса URL следующая после ';

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
$_lang['setting_stercseo.hide_from_usergroups'] = 'Hide SEOTab from these usergroups';
$_lang['setting_stercseo.hide_from_usergroups_desc'] = 'Comma separated list of usergroups who are not allowed to access SEOTab';

// CMP
$_lang['stercseo.redirects.description'] = 'Here you can view and manage your 301 redirects. Redirects can also be added from the resource create and update pages.';
$_lang['stercseo.uri'] = 'Old url (url to redirect)';
$_lang['stercseo.target'] = 'Target resource / url';
$_lang['stercseo.uri_update'] = 'Update redirect';
$_lang['stercseo.uri_remove'] = 'Remove redirect';
$_lang['stercseo.uri_remove_confirm'] = 'Are you sure you want to remove this redirect?';
$_lang['stercseo.migrate'] = 'Migrate redirects';
$_lang['stercseo.migrate_desc'] = 'Here you can migrate your redirects (SEOTab version 1.2.2 and below) from resource properties to seoUrl objects. This page will automatically migrate all the redirects for you, so no action is required, but please keep this page open for SEOTab to correctly handle the migration process.';
$_lang['stercseo.migrate_alert'] = 'Your SEOTab redirects need to be migrated. Click here to visit the migration page.';
$_lang['stercseo.migrate_status'] = 'Status';
$_lang['stercseo.migrate_running'] = 'Currently running migration process. Please keep this page open in your browser.';
$_lang['stercseo.migrate_success'] = 'Migration completed';
$_lang['stercseo.migrate_success_msg'] = 'All your redirects have been successfully migrated.';
