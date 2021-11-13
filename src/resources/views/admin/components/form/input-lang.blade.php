@if(isset(config('admin.category.lang')[0]) and config('admin.category.localization') == true)
@if (in_array('ru', config('admin.category.lang'), true))
<x-form::input name="name_ru" id="сname_ru" icon-group-prepend="fa fa-pencil fa-fw" label-text="{{ trans('admin::category.create.form.name_ru') }}" placeholder="{{ trans('admin::category.create.form.placeholder_name_ru') }}" />
@endif
@if (in_array('ro', config('admin.category.lang'), true))
<x-form::input name="name_ro" id="сname_ro" icon-group-prepend="fa fa-pencil fa-fw" label-text="{{ trans('admin::category.create.form.name_ro') }}" placeholder="{{ trans('admin::category.create.form.placeholder_name_ro') }}" />
@endif
@endif