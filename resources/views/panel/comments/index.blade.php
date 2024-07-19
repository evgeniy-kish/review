<?php

/**
 * @var \App\Models\Comment[] $comments
 */

?>
@extends('layouts.panel')

@section('title', 'Комментарии')
@section('description', 'Комментарии')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">

            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Все комментарии</h3>
                <div class="nk-block-des text-soft">
                    <p>Всего {{ $comments->total() }} {{ trans_choice('dic.comments', $comments->total()) }}</p>
                </div>
            </div>

            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu">
                        <em class="icon ni ni-menu-alt-r"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em></div>
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <input
                                            class="form-control panel-search"
                                            data-search-target="#search-products"
                                            data-search-url="{{ route('panel.search.comments') }}"
                                            type="text"
                                            placeholder="Поиск"
                                    >
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="search-products">
        @include('panel.comments.table', compact('comments'))
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $comments->onEachSide(2)->links('panel.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="/js/panel/search.js"></script>
    <script>
      (function () {
        $('#comments-list').on('click', '[data-delete]', function (e) {
          e.preventDefault();
          const rout = $(this).data('delete');

          Swal.fire({
            title: 'Удалить комментарий?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f54ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да. Удалить!',
            cancelButtonText: 'Отмена',
            showLoaderOnConfirm: true,
            preConfirm: function () {
              return $.post(rout, {}, null, 'json')
                .then(function (json) {
                  location.assign(json.redirect || '/');
                }).catch(function (err) {
                  Swal.showValidationMessage(err['responseJSON']['error'] || 'Forbidden!');
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
          });
        });

      })();
    </script>
@endpush
