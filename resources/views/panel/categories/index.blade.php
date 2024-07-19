<?php

/**
 * @var Category   $category
 * @var Category[] $categories
 * @var Category[] $select
 */

use App\Models\Category;

?>
@extends('layouts.panel')

@section('title', 'Категории')
@section('description', 'Категории')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title d-flex align-items-end">
                    @if(isset($category))
                        <a href="{{ route('panel.categories.index') }}">Категории</a>
                        <span class="icon ni ni-chevrons-right"></span>
                        <span>{{ $category->title }}</span>
                    @else
                        <span>Категории</span>
                    @endif
                </h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-6">
                <div class="card card-bordered card-stretch">
                    <div class="card-inner-group">
                        <div class="card-inner p-0">
                            <div id="editable" class="nk-tb-list nk-tb-ulist">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span class="sub-text">Название</span></div>
                                    <div class="nk-tb-col tb-col-sm"><span class="sub-text">Slug</span></div>
                                    @if(!isset($category))
                                        <div class="nk-tb-col"><span class="sub-text">Подкатегории</span></div>
                                    @endif
                                    <div class="nk-tb-col nk-tb-col-tools text-right"></div>
                                </div>
                                @foreach($categories as $child)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                        @if(!isset($category))
                                            <a href="{{ route('panel.categories.edit', $child) }}">{{ $child->title }}</a>
                                        @else
                                            <strong>{{ $child->title }}</strong>
                                        @endif
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>{{ $child->slug }}</span></div>
                                        @if(!isset($category))
                                        <div class="nk-tb-col">
                                            <div><span>{{ $child->children_count }}</span></div>
                                        </div>
                                        @endif
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1" data-info="{{ $child }}">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="#" class="btn btn-trigger btn-icon edit-category" data-toggle="tooltip" data-placement="top" title="Редактировать">
                                                        <em class="icon ni ni-edit-fill"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('panel.categories.attribute.show', $child) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Атрибуты">
                                                        <em class="icon ni ni-list-index"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <a href="#" class="btn btn-trigger btn-icon delete-category" data-toggle="tooltip" data-placement="top" title="Удалить">
                                                        <em class="icon ni ni-trash-fill"></em>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <a href="#" class="edit-category"><em class="icon ni ni-edit-fill"></em><span>Редактировать</span></a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('panel.categories.attribute.show', $child) }}"><em class="icon ni ni-list-index"></em><span>Атрибуты</span></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="delete-category"><em class="icon ni ni-trash-fill"></em><span>Удалить</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <form class="crutch-validate is-alter" action="{{ route('panel.categories.store') }}" method="post">

                            <div class="form-group">
                                <label class="form-label" for="parent_id">Родительская категория</label>
                                <div class="form-control-wrap" id="parent_id">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <select class="form-control form-select select2-hidden-accessible" name="parent_id"
                                            data-placeholder="Выбрать" data-msg="Выберите Рубрику" required>
                                        <option value="0">Родительская</option>
                                        @foreach($select as $item)
                                            <option value="{{ $item->id }}" @selected(isset($category) && $category->id === $item->id)>
                                                {{ $item->title }} ({{ $item->children_count }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="title">Название категории</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="slug" name="slug" required>
                                        <div class="input-group-append">
                                            <button id="slug-generate" class="btn btn-outline-primary" type="button">Сгенерировать</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="icon">Иконка категории</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="icon" name="icon">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Описание категории</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="description" name="description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="seo_title">SEO Title для продуктов @include('products.help')</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="seo_title" name="seo_title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="seo_description">SEO Description для продуктов @include('products.help')</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="seo_description" name="seo_description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="sort">Сортировка</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="sort" name="sort" required value="30">
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-primary">Добавить категорию</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-rubric">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Редактировать категорию</h5>
                    <form action="" class="mt-4 crutch-validate is-alter">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-title">Название</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="edit-title" name="title" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-parent_id">Родительская категория</label>
                                    <div class="form-control-wrap" id="edit-parent_id">
                                        <!--suppress HtmlFormInputWithoutLabel -->
                                        <select class="form-control form-select select2-hidden-accessible" name="parent_id" data-placeholder="Выбрать" required data-msg="Выберите Рубрику">
                                            <option value="0">Родительская</option>
                                            @foreach($select as $item)
                                                <option value="{{ $item->id }}" @selected(isset($category) && $category->id === $item->id)>
                                                    {{ $item->title }} ({{ $item->children_count }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-slug">Slug</label>
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="edit-slug" name="slug" required>
                                            <div class="input-group-append">
                                                <button id="slug-generate-edit" class="btn btn-outline-primary" type="button">
                                                    <em class="icon ni ni-cpu"></em>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-icon">Иконка</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="edit-icon" name="icon">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-description">Описание категории</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control form-control-sm" id="edit-description" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-seo_title">SEO Title для продуктов @include('products.help')</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="edit-seo_title" name="seo_title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-seo_description">SEO Description для продуктов @include('products.help')</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control form-control-sm" id="edit-seo_description" name="seo_description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-sort">Сортировка</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="edit-sort" name="sort" required value="30">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </li>
                                    <li><a href="#" class="link link-light" data-dismiss="modal">Отмена</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script src="/dashboard/js/slug.js"></script>
<script>
  $(function () {
    const editable = $('#editable');
    const modal = $('#edit-rubric');

    editable.on('click', '.edit-category', function (e) {
      e.preventDefault();
      const data = $(this).closest('ul.nk-tb-actions').data('info');

      modal.find('form').attr('action', '/panel/categories/' + data.id + '/edit')

      for (let key in data) {
        modal.find('#edit-' + key).val(data[key]).removeClass('invalid').addClass('valid').nextAll('span').hide();
      }

      setTimeout(function () {
        modal.modal('show');
      });
    });

    modal.on('hide.bs.modal', function () {
      modal.find('form').trigger('reset');
    });

    $('#slug-generate').slugGenerate();
    $('#slug-generate-edit').slugGenerate({ title: 'edit-title', slug: 'edit-slug' });
  });
</script>
@endpush
