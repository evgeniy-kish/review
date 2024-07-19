<?php
/**
 * @var Product $product
 */

use App\Models\Product;
?>
@extends('layouts.app', ['h' => 'header2'])

@section('title', $product->seo_title)
@section('description', $product->seo_description)

@push('css')
    <link rel="stylesheet" href="/assets/trum/trumbowyg.min.css">
@endpush

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/single.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ $product->title }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('reviews.index') }}">{{ __('Reviews') }}</a></li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('reviews.product', ['category1' => $product->category->parent->slug]) }}">
                                        {{ $product->category->parent->title }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="{{ route('reviews.product', ['category1' => $product->category->parent->slug, 'category2' => $product->category->slug]) }}">
                                        {{ $product->category->title }}
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Area-->
    <div class="product-details-area product-details-page section-padding-120">
        <div class="container">
            <div class="card product-description-card mb-5">
                <h6 class="product-meta-title mb-0 pl-5 py-4">{{ $product->title }}</h6>
                <div class="row g-0">
                    <div class="col-md-4 text-center p-4">
                        <img src="{{ $product->img }}" alt="{{ $product->title }}" style="width: 300px; height: 300px">
                        <ul class="ratings-list d-flex align-items-center justify-content-center mb-3">
                            @foreach(range(1,5) as $star)
                                @if($product->getRate() >= $star)
                                    <li><i class="lni-star-filled"></i></li>
                                @else
                                    <li><i class="lni-star-empty"></i></li>
                                @endif
                            @endforeach
                        </ul>
                        <span>
                            @if($product->reviews_count > 0)
                                {{ __('rating') }}: {{ $product->getRate() }} {{ __('of') }} 5 ({{ $product->reviews_count }} {{ trans_choice('dic.review', $product->reviews_count) }})
                            @else
                                Пока нет отзывов
                            @endif
                        </span>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Большая кормушка</h5> --}}
                            {!! $product->body !!}
                            {{-- <p class="card-text"><small class="text-muted">Последнее обновление 3 минуты назад</small></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                <!-- Product Review-->
                <!--          <div class="col-12 col-md-9 col-lg-12 mb-5">-->
                <!--            <div class="card product-review-card">-->
                <!--              <h6 class="product-meta-title mb-0 pl-5 py-4">ЗАО "Большая кормушка"</h6>-->
                <!--              <div class="card-body p-5 text-center">-->

                <!--              </div>-->
                <!--            </div>-->
                <!--          </div>-->
                @if($has_photo = $product->photos->isNotEmpty())
                    <div class="col-12 col-md-9 col-lg-6">
                        <!-- Product Image Wrapper-->
                        <div class="product-image-wrapper mb-5">

                            <img class="w-100" src="{{ $product->photos[0]->path }}" alt="">
                            <!-- Related Image Carousel-->
                            <div class="related-image-carousel owl-carousel">
                                @foreach($product->photos as $photo)
                                    <!-- Single Slide-->
                                    <a class="image-popup" href="{{ $photo->path }}" data-effect="mfp-zoom-in">
                                        <img src="{{ $photo->path }}" alt="">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Product Description-->
                <div class="col-12 col-md-9 {{ $has_photo ? 'col-lg-6' : 'col-lg-12'}}">
                    <div class="card product-description-card mb-5">
                        <h6 class="product-meta-title mb-0 pl-5 py-4">{{ __('Information') }}</h6>
                        <div class="card-body p-3 p-sm-4">
                            <!--                <h4 class="mb-3">Bonsai Tree with Superb Pot</h4>-->
                            <!--                <h3 class="product-price mb-4">$19.99<span>$32.89</span></h3>-->
                            <!--                <h6 class="mb-4">36 Product Left                            </h6>-->
                            <!--                <p>It's crafted with the latest trend of design & coded with all modern approaches. It's a robust & multi-dimensional usable template. It's crafted with the latest trend of design & coded with all modern approaches. It's a robust & multi-dimensional usable template. It's crafted with the latest trend of design & coded with all modern approaches.</p>-->
                            <!--                <form class="d-flex align-items-end mt-4" action="#">-->
                            <!--                  <div class="form-group mb-0">-->
                            <!--                    <label class="mr-2 mb-2" for="totalQuantity">Quantity</label>-->
                            <!--                    <input class="form-control" id="totalQuantity" min="1" max="12" name="quantity" value="1">-->
                            <!--                  </div>-->
                            <!--                  <button class="btn saasbox-btn ml-3" type="submit">Buy Now</button>-->
                            <!--                </form>-->
                            <div class="table-responsive">
                                <table class="table mb-4">
                                    <tbody>
                                    @foreach($product->category->allAttributes() as $attribute)
                                        <tr>
                                            <td class="px-3">{{ $attribute->name }}:</td>
                                            <td class="px-3">
                                                @if($attribute->isLink())
                                                    <a href="{{ $link = ($product->getValue($attribute->id) ?: '/') }}"><?= punycode_decode($link) ?: $link; ?></a>
                                                @else
                                                    {{ $product->getValue($attribute->id) ?: '—' }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Reviews Area-->
                @if($product->reviews_count > 0)
                    <!-- Rating & Review Wrapper-->
                    <div class="rating-and-review-wrapper bg-white py-3 mb-3">
                            <div class="container">
                                <h6>{{ __('Reviews') }}</h6>
                                <div class="rating-review-content">
                                    <ul class="ps-0">
                                        @foreach($product->reviews as $review)
                                            <li class="single-user-review d-flex">
                                                <div class="user-thumbnail"><img src="{{ $review->user->avatar }}" alt=""></div>
                                                <a href="{{ route('review.show', $review) }}" class="rating-comment">
                                                    <div class="rating">
                                                        @foreach(range(1,5) as $star)
                                                            @if($review->rating >= $star)
                                                                <i class="lni lni-star-filled"></i>
                                                            @else
                                                                <i class="lni lni-star-empty"></i>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <p class="mb-0">{{ $review->user->name }}</p>
                                                    <p class="comment mb-0">{{ $review->short_text }}</p>
                                                    <span class="name-date">{{ $review->created_at->format('d.m.Y') }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                @endif

                <!-- Ratings Submit Form-->
                <div class="ratings-submit-form bg-white py-3">
                    <div class="container">
                        @if(auth()->check() && auth()->user()->hasVerifiedEmail())
                            <h6>{{ __('Leave review') }}</h6>
                            <form id="reviews" action="{{ route('reviews.review.store', $product) }}" method="post">
                                @csrf
                                <div  class="stars mb-3">
                                    @foreach(range(1,5) as $item)
                                        <input class="star-{{ $item }}" type="radio" name="rating" value="{{ $item }}" id="star{{ $item }}">
                                        <label class="star-{{ $item }}" for="star{{ $item }}"></label>
                                    @endforeach
                                    <span></span>
                                </div>
                                <!--suppress HtmlFormInputWithoutLabel -->
                                <textarea class="form-control" id="body" name="body" cols="30" rows="10" data-max-length="200" placeholder=" {{ __('Your message') }}" required></textarea>
                                <div class="mt-3">
                                    <button class="btn btn-primary" type="submit">{{ __('Send') }}</button>
                                </div>
                            </form>
                        @else
                            <p class="alert alert-warning">
                                {{ __('To leave a review you need') }}
                                @if(!auth()->check())
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                    {{ __('or') }}
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                @else
                                    {{ __('confirm your email') }}
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cool Facts Area-->
    <section class="cta-area cta3 py-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 col-sm-8">
                    <div class="cta-text mb-4 mb-sm-0">
                        <h3 class="text-white mb-0">{{ __('Interesting product') }}</h3>
                    </div>
                </div>
                <div class="col-12 col-sm-4 text-sm-right"><a class="btn saasbox-btn white-btn" href="#">{{ __('Go') }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@auth
    @include('partials.flash')
    @push('script')
        <script src="/assets/trum/trumbowyg.min.js"></script>
        <script>
      (function ($) {
        $('#reviews').on('submit', function (e) {
          e.preventDefault();
          const f = $(this);
          const b = f.find('button');

          b.attr('disabled', 'disabled');

          $.post(f.attr('action'), f.serialize(), null, 'json')
            .done(function (j) {

              if('response' in j && 'activity' in j) {

                if(1 === j['activity']) {
                    return window.location.reload();
                }

                f.html('Отзыв успешно отправлен на модерацию');

              }
            })
            .fail(function (e) {
              if (e.status !== 422 || !('errors' in e['responseJSON'])) {
                return alert('Forbidden!');
              }

              const er = [];

              for (let o in e['responseJSON']['errors']) {
                er.push(e['responseJSON']['errors'][o][0]);
              }

              return alert(er.join('\n'));
            })
            .always(function () {
              b.removeAttr('disabled');
            });

        });
      })(jQuery);
    </script>
        <script>
  $(function () {
    $('#body').trumbowyg({
      lang: 'ru',
      svgPath: '/assets/trum/icons.svg',
      autogrow: true,
      btnsDef: {
        image: { dropdown: ['insertImage', 'upload'], ico: 'insertImage' },
        align: { dropdown: ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'], ico: 'justifyLeft' }
      },
      btns: [
        ['undo', 'redo'],
        ['formatting'],
        ['align'],
        ['strong', 'em', 'underline', 'del'],
        ['foreColor', 'backColor'],
        ['link'],
        ['image'],
        ['unorderedList', 'orderedList'],
        ['removeformat'],
        ['viewHTML'],
        ['fullscreen'],
      ],
      plugins: {
        upload: {
          serverPath: '/api/services/upload/trum',
          fileFieldName: 'file',
          urlPropertyName: 'link',
          data: [{ name: 'file', value: 1 }]
        }
      }
    });
  });
</script>
    @endpush
@endauth
