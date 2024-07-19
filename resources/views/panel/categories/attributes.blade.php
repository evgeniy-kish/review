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
@extends('layouts.panel')

@section('title')Атрибуты@endsection
@section('description')Атрибуты@endsection

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('panel.categories.index') }}">Все категории</a></li>
            @if(!empty($category->parent))
                <li class="breadcrumb-item">
                    <a href="{{ route('panel.categories.edit', $category->parent) }}">{{ $category->parent->title }}</a>
                </li>
            @endif
            <li class="breadcrumb-item active">{{ $category->title }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title d-flex align-items-end">Атрибуты: {{ $category->title }}</h3>
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
                                    <div class="nk-tb-col tb-col-sm"><span class="sub-text">Тип</span></div>
                                    <div class="nk-tb-col tb-col-sm"><span class="sub-text">Обязательный</span></div>
                                    <div class="nk-tb-col tb-col-sm"><span class="sub-text">Sort</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools text-right"></div>
                                </div>

                                @foreach($category->attributes()->orderBy('sort')->get() as $item)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">{{ $item->name }}</div>
                                        <div class="nk-tb-col tb-col-sm"><span>{{ $item->type }}</span></div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span>{{ $item->required ? 'Да' : 'Нет' }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>{{ $item->sort }}</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1" data-info="{{ $item }}">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="#" class="btn btn-trigger btn-icon edit-attribute" data-toggle="tooltip" data-placement="top" title="Редактировать">
                                                        <em class="icon ni ni-edit-fill"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <form action="{{ route('panel.categories.attribute.delete', ['category' => $category, 'attribute' => $item]) }}" method="post" onsubmit="return confirm('Удалить атрибут?')">
                                                        <button type="submit" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Удалить"><em class="icon ni ni-trash-fill"></em></button>
                                                        @csrf
                                                    </form>
                                                </li>
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <a href="#"><em class="icon ni ni-opt-dot-fill"></em><span>Настройки</span></a>
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
                        @include('panel.categories.attributes_form', compact('category', 'types', 'attribute', 'prefix'))
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-attribute">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Редактировать атрибут</h5>
                    <div id="attribute-form-edit"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
      $(function () {
        const editable = $('#editable');
        const modal = $('#edit-attribute');
        let request = true;

        editable.on('click', '.edit-attribute', function (e) {
          e.preventDefault();
          if (true === request) {
            request = false;
            const data = $(this).closest('ul.nk-tb-actions').data('info');

            $.getJSON('/panel/categories/' + data['category_id'] + '/edit/attributes/' + data['id'] + '/edit')
              .done(function (j) {

                modal.find('#attribute-form-edit').html(j['form']);

                setTimeout(function () {
                  NioApp.crutchValidate();
                  NioApp.Select2.init();
                  modal.modal('show');
                });
              })
              .always(function () {request = true;});
          }
        });

        modal.on('hide.bs.modal', function () {

        });

      });
    </script>
@endpush