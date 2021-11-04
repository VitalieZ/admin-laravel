<?php
return [
    'index' => [
        'menu' => 'Категорий',
        'list' => 'список',
        'edit' => 'Редактировать',
        'expand' => 'Развернуть',
        'collapse' => 'Свернуть',
        'save' => 'Сохранить',
        'refresh' => 'Обновить',
        'are_you_sure_to_edit' => 'Вы уверены, что хотите редактировать эту запись?',
        'confirm' => 'Подтвердить',
        'cancel' => 'Отмена',
        'are_you_sure_to_delete' => 'Вы уверены, что хотите удалить эту запись?',
        'success_delete' => 'Успешно удалено!',
        'success_save' => 'Успешно сохранено',
        'success_refrech' => 'Успешно обновлено!',
        'isEmptyCategory' => 'Категории не найдено. Добавьте новые категорию!',
    ],
    'menu_items' => [
        'active' => 'Активен',
        'deleted' => 'Удален',
    ],
    'create' => [
        'new' => 'Добавить',
        'form' => [
            'parent' => 'Родитель',
            'independent_category' => 'Самостоятельная категория',
            'name' => 'Название',
            'placeholder_name' => 'Ввод Название',
            'icon' => 'Иконка',
            'placeholder_icon' => 'Ввод Иконку',
            'for_more_icons' => 'Дополнительные значки см.',
            'additional_seo_fields' => 'Дополнительные поля для SEO',
            'title' => 'Заголовок',
            'placeholder_title_page' => 'Ввод заголовок страницы',
            'keywords' => 'Клю. слова',
            'placeholder_keywords_page' => 'Ввод ключевые слова страницы',
            'description' => 'Описание',
            'placeholder_description_page' => 'Ввод описание Страницы',
            'visible' => 'Видимый',
            'reset' => 'Сбросить',
            'loading' => 'загрузка...',
            'send' => 'Отправить',
        ],
        'permissions' => [
            'not_access_create_cateogy' => 'У вас нет разрешения на редактирование категории.',
        ],
        'success_created' => 'Категория успешно создана!',
        'error_created' => 'Упс... Категория не создана.',
    ],
    'edit' => [
        'permissions' => [
            'not_access_edit_cateogy' => 'У вас нет разрешения на редактирование категории.'
        ],
        'edit_category' => 'Редактировать категорию',
        'not_found_category' => 'Упс... Такой категории не найдено.',
        'error_edit' => 'Упс... Категория не обновлено.',
        'success_edit' => 'Категория успешно отредактирована!',
        'send' => 'Отправить',
    ],
    'show' => [
        'id' => 'ID',
        'parent' => 'Родитель',
        'name' => 'Название',
        'icon' => 'Иконка',
        'title' => 'Заголовок',
        'keywords' => 'Клю. слова',
        'description' => 'Описание',
        'visible' => 'Видимый',
        'created_at' => 'Создано в',
        'updated_at' => 'Обновлено в',
        'back_to_list' => 'Вернуться к списку',
        'show' => 'Показать',
        'category' => 'Категорию',
    ],
    'fields' => [
        'name_required' => 'Название обязательно.',
        'name_min' => 'Название должно состоять минимум из 4 символов.',
        'name_max' => 'Название не должно содержать более 20 символов.',
        'icon_max' => 'Иконка не должно содержать более 30 символов.',
        'title_max' => 'Заголовок не должн содержать более 255 символов.',
        'keywords_max' => 'Клю. слова не должны содержать более 255 символов.',
        'description_max' => 'Описание не должно содержать более 255 символов.',
    ],

];
