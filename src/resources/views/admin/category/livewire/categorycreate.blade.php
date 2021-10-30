<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">
                @if($method == 1)
                {{ trans('admin::category.edit.edit_category') }} - {{ $name }}
                @else
                {{ trans('admin::category.create.new') }}
                @endif
            </h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <form wire:submit.prevent="submit" class="form-horizontal">
                <div class="box-body fields-group">
                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-2  control-label d-flex justify-content-center">{{ trans('admin::category.create.form.parent') }}</label>
                        <div class="col-sm-10">
                            <select wire:model.lazy="parent_id" class="form-control asterisk parent_id select2-hidden-accessible" style="width: 100%;" name="parent_id" data-value="" tabindex="-1" aria-hidden="true">
                                <option value="0" selected="">{{ trans('admin::category.create.form.independent_category') }}</option>
                                @if (isset($menu))
                                @include('admin::admin.category.customMenuItemsSelect', ['items'=>$menu])
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label asterisk d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.name') }}</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-pencil fa-fw"></i></div>
                            </div>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('admin::category.create.form.placeholder_name') }}" wire:model.lazy="name">
                            @error('name')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.icon') }}</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-bars fa-fw"></i></div>
                            </div>
                            <input type="text" class="form-control col-sm-12 @error('icon') is-invalid @enderror" placeholder="{{ trans('admin::category.create.form.placeholder_icon') }}" wire:model.lazy="icon">
                            @error('icon')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2"></div>
                        <small id="emailHelp" class=" col-sm-10 form-text text-muted"><i class="fa fa-info-circle"></i>&nbsp;{{ trans('admin::category.create.form.for_more_icons') }} <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a></small>
                    </div>
                    <div wire:click="seoblock"><a href="javascript:void(0);">{{ trans('admin::category.create.form.additional_seo_fields') }}</a></div>
                    @if ($seoblock == 1)
                    <div class="mt-3">
                        <div class="form-group row">
                            <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.title') }}</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-text-width fa-fw"></i></div>
                                </div>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder=" {{ trans('admin::category.create.form.placeholder_title_page') }}" wire:model.lazy="title">
                                @error('title')
                                <div id="title" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.keywords') }}</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-key fa-fw"></i></div>
                                </div>
                                <input type="text" class="form-control @error('keyworks') is-invalid @enderror" placeholder="{{ trans('admin::category.create.form.placeholder_keywords_page') }}" wire:model.lazy="keywords">
                                @error('keyworks')
                                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.description') }}</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-wpforms fa-fw"></i></div>
                                </div>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" placeholder="{{ trans('admin::category.create.form.placeholder_description_page') }}" wire:model.lazy="description">
                                @error('description')
                                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="visible" id="visible" wire:model.lazy="visible">
                                <label class="form-check-label font-weight-bold user-select-none" for="visible">{{ trans('admin::category.create.form.visible') }}</label>
                                @error('visible')
                                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-12">
                        <div>
                            <div class="btn-group pull-left">
                                <button type="reset" wire:click="resetform" class="btn btn-warning d-flex justify-content-left">{{ trans('admin::category.create.form.reset') }}</button>
                            </div>
                        </div>
                        <div>
                            <div class=" btn-group pull-right">
                                <div wire:loading.remove wire:target="submit">

                                    @if($method == 1)
                                    <button type="button" wire:click="update" class="btn btn-info d-flex justify-content-right">{{ trans('admin::category.edit.send') }}</button>
                                    @else
                                    <button type="button" wire:click="submit" class="btn btn-info d-flex justify-content-right">{{ trans('admin::category.create.form.send') }}</button>
                                    @endif

                                </div>
                                <button type="button" wire:loading.delay wire:target="submit" class="btn btn-info pull-right disabled" disabled="disabled">{{ trans('admin::category.create.form.loading') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.box-body -->
    </div>
</div>