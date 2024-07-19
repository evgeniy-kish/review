<?php

/**
 * @var Review $review
 */

use App\Models\Review;
?>
@extends('layouts.panel')

@section('title')Отзыв: {{ $review->product->title }}@endsection
@section('description')Отзыв: {{ $review->product->title }}@endsection

@push('style')
    <style>
        .ratings-submit-form .stars {
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAABaCAYAAACv+ebYAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNXG14zYAAAAWdEVYdENyZWF0aW9uIFRpbWUAMDcvMDMvMTNJ3Rb7AAACnklEQVRoge2XwW3bMBSGPxa9NxtIGzTAW8DdRL7o3A0qb+BrdNIm9QAm0G7gbJBMwB5MoVJNUSRFIXGqHwhkmXr68hOPNH9ljOEt9OlNqBs4RlrrSmtdpdZ/Ti0EGnvtUoqTHFunBVCkuk6d6mbi83rggdteSa5THDeB3+UDO9z2inatXFum1roESuAReAB29vp15n2/gRfgZK+/gIuIXLxgrfUO+Bnzn0fom4ic+pvRVNuB/QrQ/RB6A7bwLjN8b985krO5MsKd0ElwJvgk1AteCPdCYWI5/SutddQxRUTU3DOzG4hd01EKqQnZuaLBITUh4F0CeLYm5CDw6PjuFTjaz9+BLwE1I8VO9StwAEoRaUSkseMHO+aqcWq2qwcdfQCOIvIy8dwDV/c/YL6zvWDbnQ3QuH5hltQEreM1dH/n6g28gT8eWLVUqqVKrb+vtGidFkCR6vp+0uLAba8k1/eRFh1ue0W7dv4sqpaSjGnR1Fy8YNWyY8W0aGpO/c1oqu3AKmlxCL0BW3iXGb637xzJ2VwZ4U7oJDgTfBLqBS+Ee6EQeMpULVFHUVOzPC3aNR2lkJotLbr0vtKiqWlMTcNaaXHQ0QfgaGqcaVG1jNLibGcbYyb/eDIlT6bjyZS+51JqtrS4gTfw/wzWqkKrKrU8fQPR6gKAmDKlPM3x1WkBFKmu0xxf3fZR5jnFdbzjv257JbmOdzx22yvadZzjW7e9ol27HWtVkjEtIubiB2u1Y8W0iJhTfzOe6uvAKmlxCL0FX+FdZvjevnMkd3Plgzuh0+A88EmoH7wM7oVC6AaiVdwuI2Z5WrRrOk4BNVtadOl9pUXENIhpWCstDjr6ABwR40yLaDVKi7Od7U1/Z0pzpjNngtNiaM2WFj8++A+motm0NTqjmwAAAABJRU5ErkJggg==") repeat-x 0 0;
            width: 150px;
        }

        .ratings-submit-form .stars:before, .ratings-submit-form .stars:after {
            display: table;
            content: "";
        }

        .ratings-submit-form .stars:after {
            clear: both;
        }

        .ratings-submit-form .stars input[type=radio] {
            position: absolute;
            opacity: 0;
        }

        .ratings-submit-form .stars input[type=radio].star-5:checked ~ span {
            width: 100%;
        }

        .ratings-submit-form .stars input[type=radio].star-4:checked ~ span {
            width: 80%;
        }

        .ratings-submit-form .stars input[type=radio].star-3:checked ~ span {
            width: 60%;
        }

        .ratings-submit-form .stars input[type=radio].star-2:checked ~ span {
            width: 40%;
        }

        .ratings-submit-form .stars input[type=radio].star-1:checked ~ span {
            width: 20%;
        }

        .ratings-submit-form .stars label {
            display: block;
            width: 30px;
            height: 30px;
            margin: 0 !important;
            padding: 0 !important;
            text-indent: -99999rem;
            float: left;
            position: relative;
            z-index: 10;
            background: transparent !important;
            cursor: pointer;
        }

        .ratings-submit-form .stars label:hover ~ span {
            background-position: 0 -30px;
        }

        .ratings-submit-form .stars label.star-5:hover ~ span {
            width: 100% !important;
        }

        .ratings-submit-form .stars label.star-4:hover ~ span {
            width: 80% !important;
        }

        .ratings-submit-form .stars label.star-3:hover ~ span {
            width: 60% !important;
        }

        .ratings-submit-form .stars label.star-2:hover ~ span {
            width: 40% !important;
        }

        .ratings-submit-form .stars label.star-1:hover ~ span {
            width: 20% !important;
        }

        .ratings-submit-form .stars span {
            display: block;
            width: 0;
            position: relative;
            top: 0;
            left: 0;
            height: 30px;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAABaCAYAAACv+ebYAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNXG14zYAAAAWdEVYdENyZWF0aW9uIFRpbWUAMDcvMDMvMTNJ3Rb7AAACnklEQVRoge2XwW3bMBSGPxa9NxtIGzTAW8DdRL7o3A0qb+BrdNIm9QAm0G7gbJBMwB5MoVJNUSRFIXGqHwhkmXr68hOPNH9ljOEt9OlNqBs4RlrrSmtdpdZ/Ti0EGnvtUoqTHFunBVCkuk6d6mbi83rggdteSa5THDeB3+UDO9z2inatXFum1roESuAReAB29vp15n2/gRfgZK+/gIuIXLxgrfUO+Bnzn0fom4ic+pvRVNuB/QrQ/RB6A7bwLjN8b985krO5MsKd0ElwJvgk1AteCPdCYWI5/SutddQxRUTU3DOzG4hd01EKqQnZuaLBITUh4F0CeLYm5CDw6PjuFTjaz9+BLwE1I8VO9StwAEoRaUSkseMHO+aqcWq2qwcdfQCOIvIy8dwDV/c/YL6zvWDbnQ3QuH5hltQEreM1dH/n6g28gT8eWLVUqqVKrb+vtGidFkCR6vp+0uLAba8k1/eRFh1ue0W7dv4sqpaSjGnR1Fy8YNWyY8W0aGpO/c1oqu3AKmlxCL0BW3iXGb637xzJ2VwZ4U7oJDgTfBLqBS+Ee6EQeMpULVFHUVOzPC3aNR2lkJotLbr0vtKiqWlMTcNaaXHQ0QfgaGqcaVG1jNLibGcbYyb/eDIlT6bjyZS+51JqtrS4gTfw/wzWqkKrKrU8fQPR6gKAmDKlPM3x1WkBFKmu0xxf3fZR5jnFdbzjv257JbmOdzx22yvadZzjW7e9ol27HWtVkjEtIubiB2u1Y8W0iJhTfzOe6uvAKmlxCL0FX+FdZvjevnMkd3Plgzuh0+A88EmoH7wM7oVC6AaiVdwuI2Z5WrRrOk4BNVtadOl9pUXENIhpWCstDjr6ABwR40yLaDVKi7Od7U1/Z0pzpjNngtNiaM2WFj8++A+motm0NTqjmwAAAABJRU5ErkJggg==") repeat-x 0 -60px;
            -webkit-transition: width 0.5s;
            transition: width 0.5s;
        }


        input[type="date"]{
            color: #526484;
            line-height: 1.25rem;
            padding: 6px 1rem;
            border: 1px solid #dbdfea;
            border-radius: 3px;
        }
    </style>


@endpush

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Отзыв о {{ $review->product->title }}</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-3 col-lg-4">
                <div class="card card-bordered">
                    <div id="attributes-form" class="card-inner">
                        <h5>Компания или предприятия</h5>
                        <div class="row g-gs">
                            <div class="col-md-12">
                                <div class="card card-bordered product-card">
                                    <div class="product-thumb">
                                        <a href="{{ route('panel.products.edit', $review->product) }}">
                                            <img class="card-img-top" src="{{ $review->product->img }}" alt="">
                                        </a>
                                    </div>
                                    <div class="card-inner text-center">
                                        <ul class="product-tags">
                                            <li>{{ $review->product->category->title }}</li>
                                        </ul>
                                        <h5 class="product-title"><a href="{{ route('panel.products.edit', $review->product) }}">{{ $review->product->title }}</a></h5>
                                        <div class="product-rating justify-content-center">
                                            <ul class="rating">
                                                @foreach($stars = range(1,5) as $star)
                                                    @if($review->product->getRate() >= $star)
                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                    @elseif($review->product->getRate() >= ($star - 0.5))
                                                        <li><em class="icon ni ni-star-half-fill"></em></li>
                                                    @elseif($review->product->getRate() >= ($star - 0.9))
                                                        <li><em class="icon ni ni-star-half"></em></li>
                                                    @else
                                                        <li><em class="icon ni ni-star text-soft"></em></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <div class="amount">
                                                {{ $review->product->getRate() }}
                                                ({{ $review->product->reviews_count }}
                                                {{ trans_choice('dic.review', $review->product->reviews_count) }})
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-lg-8">
                <div class="card card-bordered">
                    <form action="{{ route('panel.reviews.update', $review) }}" method="POST">
                        @csrf

                        <div class="card-inner">
                            <div class="row g-gs">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="body">Отзыв</label>
                                        <div class="form-control-wrap">
                                            <textarea style="height: 200px"  class="form-control form-control-sm summernote-basic" id="body" name="body" placeholder="Текст отзывы" required>{{$review->body}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Оценка</label>
                                        <div class="ratings-submit-form">
                                            <div class="stars mb-3">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <input class="star-{{$i}}" <?= $review->rating == $i ? 'checked' : '' ?> type="radio" name="rating" value="{{$i}}" id="star{{$i}}">
                                                    <label class="star-{{$i}}" for="star{{$i}}"></label>
                                                @endfor
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="rubric_id">Статус</label>
                                        <div class="form-control-wrap" id="activity">
                                            <select class="form-control form-select select2-hidden-accessible" name="activity" data-placeholder="Выбрать" required data-msg="Выберите Статус">
                                                <option label="empty" value=""></option>
                                                @foreach(\App\Models\Review::statusList() as $key => $status)
                                                    <option value="{{ $key }}" <?= $key === $review->activity ? 'selected': '' ?>>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="user_id">Автор</label>
                                        <div class="form-control-wrap">
                                            <select id="user_id" class="form-control form-select select2-hidden-accessible" name="user_id" data-placeholder="Выбрать" data-search="on" data-msg="Выберите автора" required>
                                                <option label="empty" value=""></option>
                                                <optgroup label="">
                                                    @foreach(\App\Models\User::all() as $user)
                                                        <option label="empty" value="{{$user->id}}"  <?= $review->user_id == $user->id ? "selected" : ''  ?>>{{$user->name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="rubric_id">Дата</label>
                                        <div class="form-control-wrap" id="activity">
                                            <input type="date" name="created_at" value="{{date('Y-m-d', strtotime($review->created_at))}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


{{--                <div class="card card-bordered">--}}
{{--                    <div class="card-inner">--}}
{{--                        <div class="fw-bold text-secondary">Оценка</div>--}}
{{--                        <div class="product-rating">--}}
{{--                            <ul class="rating">--}}
{{--                                @foreach($stars as $star)--}}
{{--                                    @if($review->rating >= $star)--}}
{{--                                        <li><em class="icon ni ni-star-fill"></em></li>--}}
{{--                                    @else--}}
{{--                                        <li><em class="icon ni ni-star"></em></li>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                            <div class="amount">({{ $review->rating }})</div>--}}
{{--                        </div>--}}
{{--                        <div class="fw-bold text-secondary">Описание</div>--}}
{{--                        <div>{!! $review->body !!}</div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <form class="card card-bordered crutch-validate is-alter" action="{{ route('panel.reviews.update', $review) }}">--}}
{{--                    <div class="card-inner">--}}
{{--                        <div class="row g-gs">--}}
{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label" for="rubric_id">Статус</label>--}}
{{--                                    <div class="form-control-wrap" id="activity">--}}
{{--                                        <select class="form-control form-select select2-hidden-accessible" name="activity" data-placeholder="Выбрать" required data-msg="Выберите Статус">--}}
{{--                                            <option label="empty" value=""></option>--}}
{{--                                            @foreach(\App\Models\Review::statusList() as $key => $status)--}}
{{--                                                <option value="{{ $key }}"{{ $key === $review->activity ? ' selected': '' }}>--}}
{{--                                                    {{ $status }}--}}
{{--                                                </option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-9 align-self-end">--}}
{{--                                <div class="form-group">--}}
{{--                                    <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}

                <form id="review-destroy" class="card card-bordered" action="{{ route('panel.reviews.destroy', $review) }}" method="post">
                    <div class="card-inner">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-danger">Удалить отзыв</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('script')
<script>
  (function () {
    $('#review-destroy').on('submit', function (e) {
      e.preventDefault();

      Swal.fire({
        title: 'Удалить отзыв?',
        text: '',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f54ff',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да. Удалить!',
        cancelButtonText: 'Отмена',
        showLoaderOnConfirm: true,
        preConfirm: function () {
          return $.post('{{ route('panel.reviews.destroy', $review) }}', {}, null, 'json')
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
