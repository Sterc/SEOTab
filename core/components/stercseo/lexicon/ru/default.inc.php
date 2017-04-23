<?php
/**
 * SEO Tab Russian language file
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
$_lang['stercseo.uri_label'] = 'Старый URL';
$_lang['stercseo.uri_label_desc'] = 'Введите полный URL-адрес, включая свой домен. Пример: "https://www.google.com/old-pages/about-us".';
$_lang['stercseo.url_missing_protocol'] = 'Неверный URL. Добавьте http:// или https://';

//Tab Freeze URL
$_lang['stercseo.freeze_uri'] = 'Заморозить URL';
$_lang['stercseo.uri_override'] = 'Заморозить URL псевдоним для этой страницы';
$_lang['stercseo.uri_after'] = 'Часть адреса URL следующая после [[+site_url]]';
$_lang['stercseo.uri_after_desc'] = 'Замороженные URL могут использоваться для создания коротких URL. 
Например, чтобы задать URL для этой страницы [[+site_url]]mini-url", введите "mini-url" в поле выше.';

//Settings
$_lang['setting_stercseo.context-aware-alias'] = '301 редиректы будут уникальными для каждого контекста';
$_lang['setting_stercseo.context-aware-alias_desc'] = 'Использовать старые urls для контекста';
$_lang['setting_stercseo.index'] = 'Настройка по умолчанию: Индексируемость поисковиками';
$_lang['setting_stercseo.index_desc'] = 'Разрешить индексировать новые страницы в поисковых системах по умолчанию.';
$_lang['setting_stercseo.follow'] = 'Настройка по умолчанию: Следование по ссылкам';
$_lang['setting_stercseo.follow_desc'] = 'Разрешить следовать по ссылкам у новых страниц по умолчанию.';
$_lang['setting_stercseo.sitemap'] = 'Настройка по умолчанию: Включение страницы в sitemap.xml';
$_lang['setting_stercseo.sitemap_desc'] = 'Добавлять новые страницы в sitemap.xml по умолчанию.';
$_lang['setting_stercseo.priority'] = 'Настройка по умолчанию: Приоритет';
$_lang['setting_stercseo.priority_desc'] = 'Приоритет страницы в sitemap.xml (0.25, 0.5 или 1)';
$_lang['setting_stercseo.changefreq'] = 'Настройка по умолчанию: Частота обновления содержимого';
$_lang['setting_stercseo.changefreq_desc'] = 'Частота по умолчанию (daily, weekly, monthly)';
$_lang['setting_stercseo.hide_from_usergroups'] = 'Скрывать вкладку SEO Tab для этих групп пользователей.';
$_lang['setting_stercseo.hide_from_usergroups_desc'] = 'Список разделенный запятыми групп пользователей, которым не разрешен доступ к вкладке «SEO». Пример: "Administrator,Manager"';

// CMP
$_lang['stercseo.redirects.description'] = 'Здесь вы можете просматривать и управлять своими 301 редиректами. Перенаправления также могут быть добавлены со страниц ресурсов.';
$_lang['stercseo.redirects.window_title'] = 'Добавить редирект';
$_lang['stercseo.uri'] = 'Старый url (url для редиректа)';
$_lang['stercseo.target'] = 'Целевой ресурс / url';
$_lang['stercseo.uri_update'] = 'Обновить редирект';
$_lang['stercseo.uri_remove'] = 'Удалить редирект';
$_lang['stercseo.uri_remove_confirm'] = 'Вы действительно хотите удалить этот редирект?';
$_lang['stercseo.migrate'] = 'Миграция редиректа';
$_lang['stercseo.migrate_desc'] = 'Здесь вы можете перенести свои редиректы (SEO Tab версии 1.2.2 и ниже) из свойств ресурса в объекты seoUrl. Эта страница будет автоматически переносить все перенаправления для вас, поэтому никаких действий не требуется, но пожалуйста, держите эту страницу открытой для SEO Tab, чтобы правильно обрабатывать процесс миграции.';
$_lang['stercseo.migrate_alert'] = 'Редиректы вашей SEO-страницы необходимо перенести. Нажмите здесь, чтобы перейти на страницу перехода.';
$_lang['stercseo.migrate_status'] = 'Статус';
$_lang['stercseo.migrate_running'] = 'Текущий процесс миграции. Пожалуйста, держите эту страницу открытой в вашем браузере.';
$_lang['stercseo.migrate_success'] = 'Миграция завершена!';
$_lang['stercseo.migrate_success_msg'] = 'Все редиректы были успешно перенесены.';
