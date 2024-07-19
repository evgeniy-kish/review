<?php

/**
 * @var Product $product
 */

use App\Models\Product;
?>
@extends('layouts.cabinet')

@section('title'){{ __('Edit') }} {{ $product->title }}@endsection
@section('description'){{ __('Edit') }}: {{ $product->title }}@endsection

@push('style')
    <link rel="stylesheet" href="/dashboard/css/summernote.css">
    <link rel="stylesheet" href="/dashboard/css/product.css">
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('cabinet.index') }}">{{ __('Cabinet') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cabinet.products.index') }}">{{ __('Products') }}</a></li>
            <li class="breadcrumb-item active">{{ $product->title }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title d-flex align-items-end">{{ __('Edit') }} {{ $product->title }}</h3>
            </div>
        </div>
    </div>

    <p class="lead">
        <span>{{ __('Gallery') }}: {{ $product->photos->count() }} {{ __('photo') }}</span>
        <span class="icon ni ni-chevrons-right"></span>
        <a href="{{ route('cabinet.products.gallery.edit', $product) }}">{{ __('redact') }}</a>
    </p>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-8 col-lg-9">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <form class="crutch-validate is-alter" action="{{ route('cabinet.products.update', $product) }}" method="post">
                            <div class="row g-gs">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="title">{{ __('Product name (organization)') }}</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="description">{{ __('SEO Description)') }}</label>
                                        <div class="form-control-wrap">
                                            <textarea style="min-height: 120px" class="form-control form-control-sm" id="description" name="description" placeholder="{{ __('Short description)') }}">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Article picture') }}</label>
                                        <!--suppress HtmlFormInputWithoutLabel -->
                                        <input style="visibility:hidden" id="img" type="text" name="img" value="{{ $product->img }}" required data-msg="{{ __('Upload a picture') }}">
                                        <div class="form-control crutch-dropzone dz-clickable">
                                            <div class="dz-message" data-dz-message>
                                                <div id="product-img">
                                                    <img src="{{ $product->img ?: '/img/special/no-image-300x300.png' }}" width="150" height="150" alt="{{ $product->title }}">
                                                </div>
                                                <div>
                                                    <span class="dz-message-text">{{ __('Drag picture here') }}</span>
                                                    <span class="dz-message-or">{{ __('or') }}</span>
                                                    <button type="button" class="btn btn-primary">{{ __('CHOOSE') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-gs">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="body">{{ __('Content') }}</label>
                                        <div class="form-control-wrap">
                                            <textarea style="height: 400px" class="form-control form-control-sm summernote-basic" id="body" name="body" placeholder="{{ __('Product text') }}" required>{!! $product->body !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">{{ __('Save product') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <form class="crutch-validate is-alter" action="{{ route('cabinet.products.update_attributes', $product) }}" method="post">
                            @foreach($product->category->allAttributes() as $attribute)
                                <div class="form-group">
                                    <label class="form-label" for="attribute-{{ $attribute->id }}">{{ $attribute->name }}</label>
                                    <div class="form-control-wrap">
                                        @if($attribute->isSelect())
                                            <select id="attribute-{{ $attribute->id }}" class="form-control form-select select2-hidden-accessible" name="attributes[{{ $attribute->id }}]" data-placeholder="{{ __('Choose an option') }}" data-msg="{{ __('Select') }} {{ $attribute->name }}" {{ $attribute->required ? 'required' : '' }}>
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
                                <button type="submit" class="btn btn-lg btn-primary">{{ __('Save Attributes') }}</button>
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
      });
    </script>
@endpush
