<?php

/**
 * @var Review[] $mod_reviews
 * @var Review[] $reviews
 */

use App\Models\Review;
?>
@extends('layouts.panel')

@section('title')Отзывы@endsection
@section('description')Отзывы@endsection

@section('content')
    @if($mod_reviews->isNotEmpty())
        <div id="search-review" style="margin-bottom: 30px" class="search-reviews">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Отзывы на модерации</h3>
                        <div class="nk-block-des text-soft">
                            <p>Всего {{ $mod_reviews->count() }} {{ trans_choice('dic.review', $mod_reviews->count()) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="controller-admin-table">
                <select class="event_table" id="event_table">
                    <option value="">Действия</option>
                    <option value="delete" data-name="Удалить">Удалить выбранное</option>
                    <option value="active" data-name="Активировать">Активировать выбранное</option>
                </select>
                <button id="reviews-event-all" href="<?= route('panel.reviews.create') ?>" class="reviews-event-all btn btn-primary">
                    <span>Выполнить</span>
                </button>
            </div>

            {{--        @include('panel.reviews.table', ['reviews' => $mod_reviews, 'moderation' => 'moderation'])--}}
            @include('panel.reviews.table', ['reviews' => $mod_reviews, 'id' => 1])
        </div>
    @endif

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Все отзывы</h3>
                <div class="nk-block-des text-soft">
                    <p>Всего {{ $reviews->total() }} {{ trans_choice('dic.review', $reviews->total()) }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em></div>
                                    <input
                                            class="form-control panel-search"
                                            data-search-target="#search-reviews"
                                            data-search-url="{{ route('panel.search.review') }}"
                                            type="text"
                                            placeholder="Поиск"
                                    >
                                </div>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a id="reviews-destroy-all" href="<?= route('panel.reviews.create') ?>" class="btn btn-primary">
                                    <span>Добавить новый отзыв</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="search-reviews" class="search-reviews">
        <div class="controller-admin-table">
            <select class="event_table" id="event_table">
                <option value="">Действия</option>
                <option value="delete" data-name="Удалить">Удалить выбранное</option>
                <option value="active" data-name="Активировать">Активировать выбранное</option>
                <option value="deactive" data-name="Деактивировать">Деактивировать выбранное</option>
            </select>
            <button id="reviews-event-all" href="<?= route('panel.reviews.create') ?>" class="reviews-event-all btn btn-primary">
                <span>Выполнить</span>
            </button>
        </div>
        @include('panel.reviews.table', ['review' => $reviews, 'id' => 2])
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $reviews->onEachSide(2)->links('panel.partials.paginate') }}
                </div>
            </div>
        </div>

    </div>

@endsection

@push('script')
    <script src="/js/panel/search.js"></script>
    <script>

        // document.querySelectorAll('.table-control-all').forEach(function (e){
        //     e.closest('.card-stretch').querySelectorAll('input:checkbox[name=rid]').forEach()
        // })

      $('.table-control-all').click(function(){
          console.log(this)
          $(this).closest('.card-stretch').find('input:checkbox[name=rid]').prop('checked', this.checked);
      });

      $('.reviews-event-all').click(function(e){

        e.preventDefault();

        let all_rid = [];


          $(this).closest('.search-reviews').find('input:checkbox[name=rid]:checked').each(function(){
              all_rid.push($(this).val())
          });

          var event = $(this).closest('.search-reviews').find('.event_table').val();
          var eventName = $(this).closest('.search-reviews').find('.event_table option:selected').attr('data-name')

        if(event && all_rid.length > 0){
          Swal.fire({
            title: all_rid.length === 1 ? eventName+' отзыв?' : eventName+' отзывы?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f54ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да. Выполнить!',
            cancelButtonText: 'Отмена',
            showLoaderOnConfirm: true,
            preConfirm: function () {
              return $.post('/panel/reviews/event/'+event, {ids: all_rid}, null, 'json')
                .then(function (json) {
                  location.assign(json.redirect || '/');
                }).catch(function (err) {
                  Swal.showValidationMessage(err['responseJSON']['error'] || 'Forbidden!');
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
          });
        } else {
          Swal.fire({
            title: 'Не выбран ни один отзыв или действие.',
            text: '',
            icon: 'warning',
            confirmButtonColor: '#3f54ff',
            confirmButtonText: 'Выйти',
            allowOutsideClick: () => !Swal.isLoading()
          });
        }
      });
    </script>
@endpush
