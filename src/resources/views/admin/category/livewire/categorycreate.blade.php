<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Добавить</h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <form wire:submit.prevent="submit" class="form-horizontal">
                <div class="box-body fields-group">
                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-2  control-label d-flex justify-content-center">Родитель</label>
                        <div class="col-sm-10">
                            <select wire:model.lazy="parent_id" class="form-control asterisk parent_id select2-hidden-accessible" style="width: 100%;" name="parent_id" data-value="" tabindex="-1" aria-hidden="true">
                                <option value="0" selected="">Сомастаятельная категория</option>
                                @foreach ($category as $item)
                                <option value="{{ $item['id'] }}">┝&nbsp;&nbsp;{{ $item['name'] }}</option>
                                @if (isset($item['childs']))
                                @foreach ($item['childs'] as $itt)
                                <option value="{{ $itt['id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┝&nbsp;&nbsp;{{ $itt['name'] }}</option>
                                @endforeach
                                @endif
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label asterisk d-flex justify-content-center" for="inlineFormInputGroup">Название</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-pencil fa-fw"></i></div>
                            </div>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Ввод Название" wire:model.lazy="name">
                            @error('name')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">Иконка</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-bars fa-fw"></i></div>

                            </div>
                            <input type="text" class="form-control col-sm-12" placeholder="Ввод Название" wire:model.lazy="icon">
                            @error('icon')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2"></div>
                        <small id="emailHelp" class=" col-sm-10 form-text text-muted"><i class="fa fa-info-circle"></i>&nbsp;For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a></small>
                    </div>
                    <div wire:click="seoblock"><a href="javascript:void(0);">Допалнительные поля для SEO</a></div>
                    @if ($seoblock == 1)
                    <div class="mt-3">
                        <div class="form-group row">
                            <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">Title</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-text-width fa-fw"></i></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Ввод Title Страницы" wire:model.lazy="title">
                                @error('title')
                                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">Keywords</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-key fa-fw"></i></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Ввод Keywords Страницы" wire:model.lazy="keywords">
                                @error('keyworks')
                                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">Description</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-wpforms fa-fw"></i></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Ввод Description Страницы" wire:model.lazy="description">
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
                                <label class="form-check-label font-weight-bold user-select-none" for="visible">Видимый</label>
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
                                <button type="reset" class="btn btn-warning d-flex justify-content-left">Сбросить</button>
                            </div>
                        </div>
                        <div>
                            <div class=" btn-group pull-right">
                                <div wire:loading.remove wire:target="submit">
                                    <button type="submit" class="btn btn-info d-flex justify-content-right">Отправить</button>
                                </div>
                                <button type="button" wire:loading.delay wire:target="submit" class="btn btn-info pull-right disabled" disabled="disabled">loading...</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.box-body -->
    </div>
</div>