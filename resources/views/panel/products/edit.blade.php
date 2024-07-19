<?php

/**
 * @var Product $product
 */

use App\Models\Product;
?>
@extends('layouts.panel')

@section('title', "Редактировать: {$product->title}")
@section('description', "Редактировать: {$product->title}")

@push('style')
    <link rel="stylesheet" href="/dashboard/css/summernote.css">
    <!--suppress CssUnusedSymbol -->
    <style>
      .crutch-dropzone {
        min-height: 206px
      }

      .crutch-dropzone + .invalid {
        bottom: 160px !important;
        right: 50% !important;
        transform: translateX(50%);
      }

      .dz-message {
        display: flex;
        align-items: center;
      }

      .dz-message > div:first-child {
        margin-right: 10px;
      }

      .dz-message > div:first-child > img {
        object-fit: cover;
        border-radius: 20px;
      }
    </style>
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('panel.products.index') }}">Продукты</a></li>
            <li class="breadcrumb-item active">{{ $product->title }}</li>
        </ul>
    </nav>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title d-flex align-items-end">Редактировать: {{ $product->title }}</h3>
            </div>
        </div>
        @if($product->trashed())
            <div class="alert alert-warning d-inline-block mt-2" role="alert">Внимание: Продукт в корзине</div>
        @endif
    </div>

    <p class="lead">
        <span>Галерея: {{ $product->photos->count() }} фото</span>
        <span class="icon ni ni-chevrons-right"></span>
        <a href="{{ route('panel.products.gallery.edit', $product) }}">Редактировать</a>
    </p>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-8 col-lg-9">
                <div class="card card-bordered mb-4">
                    <div class="card-inner">
                        <form class="crutch-validate is-alter" action="{{ route('panel.products.update', $product) }}" method="post">
                            <div class="row g-gs">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Название продукта (организации)</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="category_id">Категория</label>
                                        <div class="form-control-wrap">
                                            <select id="category_id" class="form-control form-select select2-hidden-accessible" name="category_id" data-placeholder="Выбрать" data-search="on" data-msg="Выберите Категорию" required>
                                                <option label="empty" value=""></option>

                                                @foreach(\App\Models\Category::getTreeCategories() as $category)
                                                    <optgroup label="{{ $category['title'] }}">
                                                        @foreach($category['children'] ?? [] as $child)
                                                            <option value="{{ $child['id'] }}" {{ (int)$child['id'] === $product->category_id ? 'selected' : '' }}>
                                                                {{ $child['title'] }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="reviews_mod">Премодерация отзывов</label>
                                        <div class="form-control-wrap">
                                            <select id="reviews_mod" class="form-control form-select select2-hidden-accessible" name="reviews_mod" data-placeholder="Выбрать" data-msg="Выберите Статус" required>
                                                <option label="empty" value=""></option>
                                                @foreach(\App\Models\Product::reviewsModList() as $key => $status)
                                                    <option value="{{ $key }}" @selected($product->reviews_mod === $key)>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-gs">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="slug">Slug</label>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="slug" name="slug" value="{{ $product->slug }}" required>
                                                <div class="input-group-append">
                                                    <button id="slug-generate" class="btn btn-outline-primary" type="button">Сгенерировать</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="description">SEO Описание</label>
                                        <div class="form-control-wrap">
                                            <textarea style="min-height: 120px" class="form-control form-control-sm" id="description" name="description" placeholder="Краткое описание">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Лого</label>
                                        <!--suppress HtmlFormInputWithoutLabel -->
                                        <input style="visibility:hidden" id="img" type="text" name="img" value="{{ $product->img }}" required data-msg="Загрузите картинку">
                                        <div class="form-control crutch-dropzone dz-clickable">
                                            <div class="dz-message" data-dz-message>
                                                <div id="product-img">
                                                    <img src="{{ $product->img ?: '/img/special/no-image-300x300.png' }}" width="150" height="150" alt="{{ $product->title }}">
                                                </div>
                                                <div>
                                                    <span class="dz-message-text">Перетащите картинку сюда</span>
                                                    <span class="dz-message-or">или</span>
                                                    <button type="button" class="btn btn-primary">ВЫБРАТЬ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-gs">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="body">Контент</label>
                                        <div class="form-control-wrap">
                                            <textarea style="height: 400px" class="form-control form-control-sm summernote-basic" id="body" name="body" placeholder="Текст продукта" required>{!! $product->body !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Сохранить продукт</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row g-gs">
                    <div class="col-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <form class="crutch-validate is-alter" action="{{ route('panel.products.user', $product) }}" method="post">
                                    <div class="form-group">
                                        <label class="form-label" for="user_id">ID user</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $product->user_id }}">
                                            @if($product->user_id)
                                                <span>{{ $product->user->name }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <form class="crutch-validate is-alter" action="{{ route('panel.products.premium', $product) }}" method="post">
                                    <div class="form-group">
                                        <label class="form-label" for="days">
                                            @if($product->premium_at)
                                                @if($product->isPremium())
                                                    <span class="text-warning">
                                                        Действует ещё {{ $days = $product->premium_at->diffInDays() }}
                                                        {{ trans_choice('dic.days', $days) }}
                                                        до {{ $product->premium_at->format('d.m.Y H:i') }}
                                                    </span>
                                                @else
                                                   <span class="text-danger">Премиум закончился {{ $product->premium_at->diffForHumans() }}</span>
                                                @endif
                                            @else
                                                <span>Premium days</span>
                                            @endif
                                        </label>
                                        <div class="form-control-wrap">
                                            <input type="number" class="form-control" id="days" name="days" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <form class="crutch-validate is-alter" action="{{ route('panel.products.actual', $product) }}" method="post">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <span>Актуальное?</span>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="actual" name="actual" {{ $product->actual ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="actual"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <form class="crutch-validate is-alter" action="{{ route('panel.products.update_attributes', $product) }}" method="post">
                            @foreach($product->category->allAttributes() as $attribute)
                                <div class="form-group">
                                    <label class="form-label" for="attribute-{{ $attribute->id }}">{{ $attribute->name }}</label>
                                    <div class="form-control-wrap">
                                        @if($attribute->isSelect())
                                            <select id="attribute-{{ $attribute->id }}" class="form-control form-select select2-hidden-accessible" name="attributes[{{ $attribute->id }}]" data-placeholder="Выбрать вариант" data-msg="Выберите {{ $attribute->name }}" {{ $attribute->required ? 'required' : '' }}>
                                                <option label="empty" value=""></option>
                                                @foreach($attribute->variants as $variant)
                                                    <option value="{{ $variant }}" {{ $variant === $product->getValue($attribute->id) ? 'selected': '' }}>{{ $variant }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="{{ $attribute->isNumber() ? 'number': 'text' }}" class="form-control" id="attribute-{{ $attribute->id }}" name="attributes[{{ $attribute->id }}]" value="{{ $product->getValue($attribute->id) }}" {{ $attribute->required ? 'required' : '' }}>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Сохранить атрибуты</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="/dashboard/js/summernote.js"></script>
    <script src="/dashboard/js/editors.js"></script>
    <script src="/dashboard/js/slug.js"></script>

    <script>
      $(function () {
        const img = $('#img');

        const options = {
          url: '{{ route('services.upload.base') }}',
          maxFiles: 1,
          thumbnailWidth: 150,
          thumbnailHeight: 150,
          init: function () {
            this.on('maxfilesexceeded', function (file) {
              this.removeAllFiles();
              this.addFile(file);
            });
            this.on('success', function (file, res) {
              img.val(res.path || '').removeClass('invalid').nextAll('.invalid').hide();
              $('#product-img').remove();
            });
            this.on('removedfile', function () {
              img.val('');
            });
          },
        };
        $('.crutch-dropzone').crutchZone(options);

        $('.form-select').on('select2:select', function () {
          $(this).removeClass('invalid').nextAll('#category_id-error').hide();
        });

        $('#slug-generate').slugGenerate();
      });
    </script>
@endpush
