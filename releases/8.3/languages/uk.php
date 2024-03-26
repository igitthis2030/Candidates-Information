<?php

return [
    'common_header' => 'PHP 8.3 — це значне оновлення мови PHP. Воно містить багато нових можливостей, таких як явна типізація констант класів, глибоке клонування readonly-властивостей і доповнення до функціоналу генерування випадкових чисел. Як завжди, воно також включає покращення продуктивності, виправлення помилок і загальний рефакторинг.',
    'documentation' => 'Документація',
    'main_title' => 'Випущено!',
    'main_subtitle' => 'PHP 8.3 — це значне оновлення мови PHP.<br class="display-none-md">Воно містить багато нових можливостей, таких як явна типізація констант класів, глибоке клонування readonly-властивостей і доповнення до функціоналу генерування випадкових чисел. Як завжди, воно також включає покращення продуктивності, виправлення помилок і загальний рефакторинг.',
    'upgrade_now' => 'Оновіться до PHP 8.3 прямо зараз!',

    'readonly_title' => 'Глибоке клонування readonly-властивостей',
    'readonly_description' => 'Щоб забезпечити можливість глибокого клонування властивостей, доступних лише для читання, <code>readonly</code> властивості тепер можуть бути модифіковані один раз, за допомогою магічного методу <code>__clone</code>.',
    'json_validate_title' => 'Нова функція <code>json_validate()</code>',
    'json_validate_description' => 'Функція <code>json_validate()</code> дозволяє перевірити, чи є рядок синтаксично правильним JSON, при цьому є ефективнішою за функцію<code>json_decode()</code>.',
    'typed_class_constants_title' => 'Типізовані константи класу',
    'override_title' => 'Новий атрибут <code>#[\Override]</code>',
    'override_description' => 'Додавши до методу атрибут <code>#[\Override]</code>, PHP буде впевнюватися, що метод із такою ж назвою існує у батьківському класі або реалізованому інтерфейсі. Додавання цього атрибута дає можливість зрозуміти, що перевизначення батьківського методу є навмисним і спрощує рефакторинг, оскільки видалення перевизначеного батьківського методу не залишиться непоміченим.',
    'randomizer_getbytesfromstring_title' => 'Новий метод <code>Randomizer<span style="word-break: break-all;">::</span>getBytesFromString()</code>',
    'randomizer_getbytesfromstring_description' => '<a href="/releases/8.2/en.php#random_extension">Модуль Random</a>, що додано у PHP 8.2, було розширено новим методом генерування випадкових рядків, які складаються лише з певних байтів. Цей метод дозволяє розробнику легко генерувати випадкові ідентифікатори, такі як імена доменів і числові рядки довільної довжини.',
    'randomizer_getfloat_nextfloat_title' => 'Нові методи <code>Randomizer::getFloat()</code> і <code>Randomizer::nextFloat()</code>',
    'randomizer_getfloat_nextfloat_description' => '<p>Через обмежену точність і неявне округлення чисел з рухомою комою, генерування незміщеного числа з рухомою комою, що лежить у межах певного інтервалу, є нетривіальним завданням, а загальноприйняті користувацькі рішення можуть генерувати зміщені результати або числа, що виходять за межі заданого діапазону.</p><p>Клас Randomizer було розширено двома методами для неупередженого генерування випадкових чисел з рухомою комою. Метод <code>Randomizer::getFloat()</code> використовує алгоритм y-section, який було опубліковано у статті <a href="https://doi.org/10.1145/3503512" target="_blank" rel="noopener noreferrer">Drawing Random Floating-Point Numbers from an Interval. Frédéric Goualard, ACM Trans. Model. Comput. Simul., 32:3, 2022.</a></p>',
    'dynamic_class_constant_fetch_title' => 'Динамічна вибірка констант класу',
    'command_line_linter_title' => 'Лінтер командного рядка підтримує можливість перевірки декількох файлів',
    'command_line_linter_description' => '<p>Лінтер командного рядка тепер може приймати декілька імен файлів для перевірки</p>',

    'new_classes_title' => 'Нові класи, інтерфейси та функції',
    'new_dom' => 'Нові методи <a href="/manual/en/domelement.getattributenames.php"><code>DOMElement::getAttributeNames()</code></a>, <a href="/manual/en/domelement.insertadjacentelement.php"><code>DOMElement::insertAdjacentElement()</code></a>, <a href="/manual/en/domelement.insertadjacenttext.php"><code>DOMElement::insertAdjacentText()</code></a>, <a href="/manual/en/domelement.toggleattribute.php"><code>DOMElement::toggleAttribute()</code></a>, <a href="/manual/en/domnode.contains.php"><code>DOMNode::contains()</code></a>, <a href="/manual/en/domnode.getrootnode.php"><code>DOMNode::getRootNode()</code></a>, <a href="/manual/en/domnode.isequalnode.php"><code>DOMNode::isEqualNode()</code></a>, <code>DOMNameSpaceNode::contains()</code> і <a href="/manual/en/domparentnode.replacechildren.php"><code>DOMParentNode::replaceChildren()</code></a>.',
    'new_intl' => 'Нові методи <a href="/manual/en/intlcalendar.setdate.php"><code>IntlCalendar::setDate()</code></a>, <a href="/manual/en/intlcalendar.setdatetime.php"><code>IntlCalendar::setDateTime()</code></a>, <a href="/manual/en/intlgregoriancalendar.createfromdate.php"><code>IntlGregorianCalendar::createFromDate()</code></a> і <a href="/manual/en/intlgregoriancalendar.createfromdatetime.php"><code>IntlGregorianCalendar::createFromDateTime()</code></a>.',
    'new_ldap' => 'Нові функції <code>ldap_connect_wallet()</code> і <code>ldap_exop_sync()</code>.',
    'new_mb_str_pad' => 'Нова функція <a href="/manual/en/function.mb-str-pad.php"><code>mb_str_pad()</code></a>.',
    'new_posix' => 'Нові функції <a href="/manual/en/function.posix-sysconf.php"><code>posix_sysconf()</code></a>, <a href="/manual/en/function.posix-pathconf.php"><code>posix_pathconf()</code></a>, <a href="/manual/en/function.posix-fpathconf.php"><code>posix_fpathconf()</code></a> і <a href="/manual/en/function.posix-eaccess.php"><code>posix_eaccess()</code></a>.',
    'new_reflection' => 'Новий метод <a href="/manual/en/reflectionmethod.createfrommethodname.php"><code>ReflectionMethod::createFromMethodName()</code></a>.',
    'new_socket' => 'Нова функція <a href="/manual/en/function.socket-atmark.php"><code>socket_atmark()</code></a>.',
    'new_str' => 'Нові функції <a href="/manual/en/function.str-increment.php"><code>str_increment()</code></a>, <a href="/manual/en/function.str-decrement.php"><code>str_decrement()</code></a> і <a href="/manual/en/function.stream-context-set-options.php"><code>stream_context_set_options()</code></a>.',
    'new_ziparchive' => 'Новий метод <a href="/manual/en/ziparchive.getarchiveflag.php"><code>ZipArchive::getArchiveFlag()</code></a>.',
    'new_openssl_ec' => 'Підтримка генерування EC-ключів із власними EC-параметрами у модулі OpenSSL.',
    'new_ini' => 'Новий параметр INI <a href="/manual/en/migration83.other-changes.php#migration83.other-changes.ini"><code>zend.max_allowed_stack_size</code></a> для встановлення максимально дозволеного розміру стека.',
    'ini_fallback' => 'php.ini тепер підтримує синтаксис запасних значень/значень за замовчуванням.',
    'anonymous_readonly' => 'Анонімні класи тепер доступні лише для читання.',

    'bc_title' => 'Застаріла функціональність і зміни у зворотній сумісності',
    'bc_datetime' => '<a href="https://wiki.php.net/rfc/datetime-exceptions">Доречніші винятки у модулі Date/Time</a>.',
    'bc_arrays' => 'Присвоєння від\'ємного індексу <code>n</code> до порожнього масиву тепер гарантує, що наступним індексом буде <code>n + 1</code> замість <code>0</code>.',
    'bc_range' => 'Внесено зміни до функції<code>range()</code>.',
    'bc_traits' => 'Зміни у повторному оголошенні статичних властивостей у трейтах.',
    'bc_umultipledecimalseparators' => 'Константу <code>U_MULTIPLE_DECIMAL_SEPERATORS</code> оголошено застарілою, натомість рекомендується використовувати <code>U_MULTIPLE_DECIMAL_SEPARATORS</code>.',
    'bc_mtrand' => 'Механізм Mt19937 <a href="/manual/en/random.constants.php#constant.mt-rand-php"><code>MT_RAND_PHP</code></a> оголошено застарілим.',
    'bc_reflection' => '<a href="/manual/en/reflectionclass.getstaticproperties.php"><code>ReflectionClass::getStaticProperties()</code></a> тепер не повертає значення <code>null</code>.',
    'bc_ini' => 'Параметри INI <a href="/manual/en/info.configuration.php#ini.assert.active"><code>assert.active</code></a>, <a href="/manual/en/info.configuration.php#ini.assert.bail"><code>assert.bail</code></a>, <a href="/manual/en/info.configuration.php#ini.assert.callback"><code>assert.callback</code></a>, <a href="/manual/en/info.configuration.php#ini.assert.exception"><code>assert.exception</code></a> і <a href="/manual/en/info.configuration.php#ini.assert.warning"><code>assert.warning</code></a> оголошено застарілими.',
    'bc_standard' => 'Можливість виклику функції <a href="/manual/en/function.get-class.php"><code>get_class()</code></a> і <a href="/manual/en/function.get-parent-class.php"><code>get_parent_class()</code></a> без аргументів оголошено застарілою.',
    'bc_sqlite3' => 'SQLite3: Режим помилок за замовчуванням встановлено на винятки.',

    'footer_title' => 'Краща продуктивність, кращий синтаксис, покращена безпека типів.',
    'footer_description' => '<p>Для завантаження початкового коду PHP 8.3 відвідайте сторінку <a href="/downloads">downloads</a>. Двійкові файли Windows можна знайти на сайті <a href="https://windows.php.net/download">PHP for Windows</a>. Перелік змін описано на сторінці <a href="/ChangeLog-8.php#PHP_8_3">ChangeLog</a>.</p>
        <p><a href="/manual/en/migration83.php">Посібник з міграції</a> знаходиться у посібнику з PHP. Будь ласка, ознайомтеся з ним, щоб отримати детальніший список нових функцій і несумісних змін.</p>',
];
