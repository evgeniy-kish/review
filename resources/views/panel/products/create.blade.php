@extends('layouts.panel')

@section('title')Добавить продукт@endsection
@section('description')Добавить продукт@endsection

@push('style')
    <link rel="stylesheet" href="/dashboard/css/summernote.css">
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
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Добавить продукт</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <form class="crutch-validate is-alter row g-gs" action="{{ route('panel.products.store') }}" method="post">
            <div class="col-md-8 col-lg-9">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="row g-gs">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="title">Название продукта (организации)</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="title" name="title" value="" required>
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
                                                        <option value="{{ $child['id'] }}">
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
                                                <option value="{{ $key }}"
                                                        @selected(\App\Models\Product::REVIEWS_MOD['OFF'] === $key)>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-gs">
                            <div class="col-6">

                                <div class="form-group">
                                    <label class="form-label" for="slug">Slug</label>
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="slug" name="slug" value="" required>
                                            <div class="input-group-append">
                                                <button id="slug-generate" class="btn btn-outline-primary" type="button">Сгенерировать</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="description">SEO Описание</label>
                                    <div class="form-control-wrap">
                                        <textarea style="min-height: 120px" class="form-control form-control-sm" id="description" name="description" placeholder="Краткое описание"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Картинка статьи</label>
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <input style="visibility:hidden" id="img" type="text" name="img" value="" required data-msg="Загрузите картинку">
                                    <div class="form-control crutch-dropzone dz-clickable">
                                        <div class="dz-message" data-dz-message>
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
                                            <textarea style="height: 400px" class="form-control form-control-sm summernote-basic" id="body" name="body" placeholder="Текст продукта" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Добавить</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="card card-bordered">
                    <div id="attributes-form" class="card-inner">

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="/dashboard/js/summernote.js"></script>
    <script src="/dashboard/js/editors.js"></script>
    <script src="/dashboard/js/slug.js"></script>

    <script>
      $(function () {
        const
          img = $('#img'),
          _af = $('#attributes-form');

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
          }
        };
        $('.crutch-dropzone').crutchZone(options);

        $('.form-select').on('select2:select', function (e) {
          $(this).removeClass('invalid').nextAll('#category_id-error,#reviews_mod-error').hide();

          $.getJSON(`/api/services/categories/${e.params.data.id}/attributes`)
            .done(function (json) {
              if ('attributes' in json) {
                _af.html(json['attributes']);
              }
            })
            .fail(function () {
              alert('Forbidden!');
            });
        });

        $('#slug-generate').slugGenerate();
      });
    </script>
@endpush
