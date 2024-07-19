<?php

/**
 * @var Category  $category
 * @var Attribute $attribute
 * @var string[]  $types
 * @var string    $prefix
 */

use App\Models\Category;
use App\Models\Attribute;

?>
<form class="crutch-validate is-alter" action="{{ 'edit' === $prefix ? route('panel.categories.attribute.update', [$category, $attribute]) : route('panel.categories.attribute.store', $category) }}" method="post">
    <div class="row g-gs">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="{{ $prefix }}name">Название</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" id="{{ $prefix }}name" name="name" value="{{ $attribute->name }}" required>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="{{ $prefix }}type">Тип</label>
                <div class="form-control-wrap" id="{{ $prefix }}type">
                    <select class="form-control form-select select2-hidden-accessible" name="type" data-placeholder="Выбрать" required data-msg="Выберите Тип">
                        @foreach($types as $type => $label)
                            <option value="{{ $type }}" {{ $type === $attribute->type ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="{{ $prefix }}sort">Сортировка</label>
                <div class="form-control-wrap">
                    <input type="number" class="form-control" id="{{ $prefix }}sort" name="sort" value="{{ $attribute->sort ?: 30 }}" required>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div><label class="form-label">Обязательность атрибута</label></div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input invalid" name="required" id="{{ $prefix }}required" {{ $attribute->required ? 'checked': '' }}>
                <label class="custom-control-label" for="{{ $prefix }}required">Обязательный</label>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label class="form-label" for="{{ $prefix }}variants">Возможные варианты</label>
                <div class="form-control-wrap">
                    <textarea class="form-control form-control-sm invalid" id="{{ $prefix }}variants" name="variants">{{ implode("\n", $attribute->variants ?: []) }}</textarea>
                </div>
            </div>
        </div>

        <div class="col-12">
            @if('edit' === $prefix)
                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                    <li>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </li>
                    <li><a href="#" class="link link-light" data-dismiss="modal">Отмена</a></li>
                </ul>
            @else
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-lg btn-primary">Добавить атрибут</button>
                </div>
            @endif
        </div>
    </div>
</form>