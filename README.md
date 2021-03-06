# Baimac Project

Сайт продажи мужской одежды и аксессуаров по объявлениям

## Полезные функции при разработке

Ниже приведен список функций и методов, которые могут (и, желательно - должны) пригодится при работе.

### Работа с хуками
* * *

На движке сайта насторена система хуков, которая позволяет управлять функционалом без изменения ядра (размещенного в */inc*), что также позволяет бекенду быть более гибким и красивым. ***привет от Wordpress'а***. 
Чтобы пользоваться хуками, существуют две функции: отправка хука и "прослушка" хука.

Прослушка хука:
```
MdlHook()->listen('Hook_name', function()
{
	
});
```

Отправка хука:
```
MdlHook()->express( $hook_name, $args )
```

Где $args - массив передаваемых аргументов для функций, слушающих этот хук.

Таким образом, хуками можно и просто отмечать этап исполнения кода (например, начало/конец рендера меню в шапке), а можно создавать **отменяемые действия** - фрагменты кода, которые не будут исполняться, если слушающая хук функция вернула **false**.
Ниже приведен пример создания отменяемого действия и прослушка, которая отменит это действие:
```
if( !defined('MDL_HOOKS') || MdlHook()->express('cancellable_hook') ) {
   // do something...
}

###########

MdlHook()->listen('cancellable_hook', function()
{
	if( $condition ) {
		return false; # Действие отменено
	}
});
```

Ниже приведены существующие хуки:

+ **pagebuilder.regres** - Регистрация ресурса

+ **pagebuilder.header** - Вывод шапки

+ **pagebuilder.head.sources** - Вывод ресурсов в head

+ **pagebuilder.footer** - Вывод подвала

+ **pagebuilder.footer.sources** - Вывод ресурсов в подвал

+ **pagebuilder.init** - Вывод страницы

+ **pagebuilder.init.pre** - Действия до рендера страницы

+ **pagebuilder.init.post** - Действия после рендера страницы



### Работа с базой данных (БД MySQL)
* * *

Работа с базой данных осуществляется через глобальную переменную **$mydb**, которая содержит методы:

+ **query**( $sql )
	Выполнить запрос **$sql**

+ **get**( $sql, $start = -1, $length = false )
	Получить данные из запроса **$sql** в виде ассоциативного массива.
	Указав **$start** - получить n-й элемент результата.
	Указав **$length** - получить **$length**-элементов результата, начиная с **$start**.

+ **insert**( $tname, $data )
	Вставить данные **$data** в таблицу **$tname**, где **$data** - ассоциативный массив.

+ **update**( $tname, $data, $where )
	Обновить данные **$data** в таблице **$tname**, где **$data** - ассоциативный массив, данных, которые нужно обновить, а **$where** - ассоциативный массив данных для поиска (WHERE) заменяемых строк *array( 'id' => $id )*

+ **insert_id**
	Переменная, хранящая ID последней вставленной строки.


* * *
С другими полезными функциями можно ознакомиться в файле */inc/utils.php*