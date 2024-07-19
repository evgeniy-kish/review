<?php

/**
 * @var Product $product
 */

use App\Models\Product;

?>
@extends('layouts.cabinet')

@section('title'){{ __('Gallery:') }} {{ $product->title }}@endsection
@section('description'){{ __('Gallery:') }} {{ $product->title }}@endsection

@push('style')
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

      .c-drop {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
      }

      .c-drop-item {
        display: flex;
        flex-direction: column;
        align-items: center;

        padding: 5px;
        margin: 5px;
        border: 1px dashed #dbdfea;
      }

      .c-drop-img {
        flex: 0 0 150px;
        object-fit: cover;
        margin-bottom: 10px;
      }

      .c-drop-btn
    </style>
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('cabinet.index') }}">{{ __('Cabinet') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cabinet.products.index') }}">{{ __('Products') }}</a></li>
            <li class="breadcrumb-item active">
                <a href="{{ route('cabinet.products.edit', $product) }}">{{ $product->title }}</a></li>
            <li class="breadcrumb-item active">{{ __('Gallery') }}</li>
        </ul>
    </nav>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title d-flex align-items-end">{{ __('Gallery:') }} {{ $product->title }}</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <div id="s-gallery" class="c-drop" data-gallery="{{ $product->photos->pluck('path') }}">
                    @foreach($product->photos as $photo)
                        <div class="c-drop-item">
                            <img src="{{ $photo->path }}" width="150" height="150" class="c-drop-img" alt="">
                            <button class="btn btn-sm btn-outline-danger c-drop-btn" data-delete="{{ $photo->path }}">{{ __('Delete') }}</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner text-center">
                <div id="m-g" class="btn-group" aria-label="Manage gallery" style="display:none">
                    <button type="button" class="btn btn-primary" data-action="save">{{ __('Save Changes') }}</button>
                    <button type="button" class="btn btn-dim btn-light" data-action="cancel">{{ __('Cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <div class="form-group">
                    <label class="form-label">{{ __('Upload pictures to gallery') }}</label>
                    <div class="form-control crutch-dropzone dz-clickable">
                        <div class="dz-message" data-dz-message>
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
    </div>
@endsection

@push('script')
<script>
  $(function () {
    const g = $('#s-gallery');
    const mg = $('#m-g');
    let img = g.data('gallery');
    const old_img = JSON.parse(JSON.stringify(img));

    const motor = {
      request: true,
      save: function (b) {
        b.attr('disabled', 'disabled');

        $.post('{{ route('cabinet.products.gallery.update', $product) }}', { gallery: img }, null, 'json')
          .done(function (json) {
            if ('redirect' in json) {
              return location.assign(json['redirect'] || '/');
            }
          })
          .fail(function () {
            b.removeAttr('disabled');
          })
          .always();
      },
      cancel: function () {
        img = [];
        g.html('');

        setTimeout(_ => {
          old_img.forEach(el => {
            addImage(el);
          });
        }, 0);

        return mg.hide();
      }
    };

    function addImage (path) {
      img.push(path);
      const t = `<div class="c-drop-item">
        <img src="${path}" width="150" height="150" class="c-drop-img" alt="">
        <button class="btn btn-sm btn-outline-danger c-drop-btn" data-delete="${path}">Удалить</button>
      </div>`;

      g.append(t);
    }

    mg.on('click', 'button', function () {
      const _this = $(this);

      motor[_this.data('action')](_this);
    });

    g.on('click', '.c-drop-btn', function () {
      const _this = $(this);
      const i = _this.data('delete');
      _this.parent('div.c-drop-item').remove();
      img = img.filter(e => e !== i);
      mg.show();
    });

    const options = {
      url: '{{ route('services.upload.base') }}',
      thumbnailWidth: 150,
      thumbnailHeight: 150,
      init: function () {
        this.on('success', function (file, res) {
          setTimeout(() => {
            this.removeFile(file);
            addImage(res.path);
            mg.show();
          }, 1000);
        });
      },
    };

    $('.crutch-dropzone').crutchZone(options);
  });
</script>
@endpush