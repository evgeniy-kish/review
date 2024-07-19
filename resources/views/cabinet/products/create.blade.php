@extends('layouts.cabinet')

@section('title', 'Создать объект')
@section('description', 'Создать объект')

@push('style')
    <link rel="stylesheet" href="/dashboard/css/summernote.css">
    <link rel="stylesheet" href="/dashboard/css/product.css">
@endpush

@section('content')
    <nav class="mb-3">
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('cabinet.index') }}">{{ __('Cabinet') }}</a></li>
            <li class="breadcrumb-item active">Создать объект</li>
        </ul>
    </nav>

    <div class="nk-block">
        <form class="row g-gs crutch-validate is-alter" action="{{ route('cabinet.products.store') }}" method="post">
            <div class="col-md-8 col-lg-9">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="row g-gs">
                            <div class="col-6">

                                <div class="form-group">
                                    <label class="form-label" for="title">Название продукта (организации)</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="title" name="title" value="" required>
                                    </div>
                                </div>

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
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Картинка</label>
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
          },
        };
        $('.crutch-dropzone').crutchZone(options);

        $('.form-select').on('select2:select', function (e) {
          $(this).removeClass('invalid').nextAll('#category_id-error').hide();

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

      });
    </script>
@endpush