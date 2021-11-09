<?php

return [
    'userManagement' => [
        'title'          => 'Управление пользователями',
        'title_singular' => 'Управление пользователями',
    ],
    'permission' => [
        'title'          => 'Разрешения',
        'title_singular' => 'Разрешение',
        'search_permission' => 'Поиск разрешений',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Названия',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Роли',
        'title_singular' => 'Роль',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Роль',
            'title_helper'       => ' ',
            'permissions'        => 'Список разрешение',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Пользователи',
        'title_singular' => 'Пользователь',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Имя',
            'name_helper'              => ' ',
            'email'                    => 'Почта',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Почта подтверждена',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роль',
            'roles_helper'             => ' ',
            'remember_token'           => 'Сохранить token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'roless' => [
        'title'          => 'Роли',
        'title_singular' => 'Роли',
    ],
    'assetsHistory' => [
        'title'          => 'Assets History',
        'title_singular' => 'Assets History',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'asset'                => 'Asset',
            'asset_helper'         => ' ',
            'status'               => 'Статус',
            'status_helper'        => ' ',
            'location'             => 'Location',
            'location_helper'      => ' ',
            'assigned_user'        => 'Assigned User',
            'assigned_user_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => ' ',
        ],
    ],
    'menuAdmin' => [
        'index' => [
            'menu' => 'Меню',
            'expand' => 'Развернуть',
            'collapse' => 'Свернуть',
            'are_you_sure_to_edit' => 'Вы уверены, что хотите редактировать эту запись?',
            'confirm' => 'Подтвердить',
            'are_you_sure_to_delete' => 'Вы уверены, что хотите удалить эту запись?',
            'isEmptyMenu' => 'Меню не найдено. Добавьте новое меню!',
        ],
        'menu_items' => [
            'active' => 'Активен',
            'deleted' => 'Удален',
        ],
        'form' => [
            'parent' => 'Родитель',
            'independent_category' => 'Самостоятельная категория',
            'name' => 'Название',
            'placeholder_name' => 'Ввод Название',
            'icon' => 'Иконка',
            'placeholder_icon' => 'Ввод Иконку',
            'for_more_icons' => 'Дополнительные значки см.',
            'route' => 'Роут',
            'placeholder_route' => 'Ввод роут',
            'title' => 'Заголовок',
            'placeholder_title_page' => 'Ввод заголовок страницы',
            'permission' => 'Разрешение',
            'select_permission' => 'Выберите разрешение',
            'visible' => 'Видимый',
            'reset' => 'Сбросить',
            'loading' => 'загрузка...',
            'id' => 'ID',
        ],
        'sub_cat' => 'Категория не может быть удалена.Сначала удалите подкатегорий.',
        'not_access_create_cateogy' => 'У вас нет разрешения на редактирование категории.',
        'error_created' => 'Упс... Категория не создана.',
        'edit_category' => 'Редактировать категорию',
        'not_found_category' => 'Упс... Такой категории не найдено.',
        'error_edit' => 'Упс... Категория не обновлено.',
        'success_edit' => 'Категория успешно отредактирована!',
        'success_save' => 'Успешно сохранено',
        'success_refrech' => 'Успешно обновлено!',
        'validate_js' => [
            'name_required' => 'Название обязательно',
            'name_min' => 'Название должно состоять минимум из 4 символов.',
            'name_max' => 'Название не должно содержать более 50 символов.',
            'icon_max' => 'Значок не должен содержать более 50 символов.',
            'uri_max' => 'Маршрут не должен содержать более 255 символов.',
            'title_max' => 'Заголовок не должно превышать 255 символов',
            'permission_max' => 'Разрешение не должно превышать 255 символов.',
        ],
    ],
];
