<?php

	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	#  Пожалуйста, не изменяйте этот файл,							#
	#  в нем должен храниться гайд по полезным хукам и функциям		#
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

	/**
	 * Список хуков
	 *
	 *
	 * @ pagebuilder.regres
	 * Регистрация ресурса
	 *
	 * @ pagebuilder.header
	 * Вывод шапки
	 *
	 * @ pagebuilder.head.sources
	 * Вывод ресурсов в head
	 *
	 * @ pagebuilder.footer
	 * Вывод подвала
	 *
	 * @ pagebuilder.footer.sources
	 * Вывод ресурсов в подвал
	 *
	 * @ pagebuilder.init
	 * Вывод страницы
	 *
	 * @ pagebuilder.init.pre
	 * Действия до рендера страницы
	 *
	 * @ pagebuilder.init.post
	 * Действия после рендера страницы
	 *
	 */

	# Регистрация хука
	MdlHook()->listen('Hook_name', function()
	{
		
	});



	/**
	 * Список полезных функций
	 *
	 *
	 *
	 * Регистрация ресурса
	 * @ _add_resource( $type, $file, $in_footer, $index )
	 * @param {string} type Тип ресурса ("style" | "script")
	 * @param {string} file Имя файла, относительно папки js или css ( "example.css", "folder/example.js" )
	 * @param {boolean} in_footer True, если необходимо вывести ресурс в подвал. По умолчанию False
	 * @param {number} index Порядок подгрузки ресурса. По умолчанию 10
	 *
	 *
	 *
	 * Создание хука
	 * @ MdlHook()->express( $hook_name, $args )
	 * @param {string} hook_name Имя хука
	 * @param {array} args Массив передаваемых аргументов для функций, слушающих этот хук
	 * Использование:
	 *
	 * * * * Простой вызов:
	 * * * * MdlHook()->express('hook_name', array( $arg1, $arg2, $arg3 ) )
	 *
	 * * * * Отменяемое действие:
	 * * * * if( !defined('MDL_HOOKS') || MdlHook()->express('hook_name') ) {
	 * * * * 	// do something...
	 * * * * }
	 */
?>