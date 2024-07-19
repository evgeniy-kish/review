<?php

/**
 * @var Article $article
 */

use App\Models\Article;

?>
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
                <h3 class="nk-block-title page-title">
                    {{ $article->id ? 'Редактировать: ' . $article->title : 'Добавить статью в блог' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter" action="{{ $article->id ? route('panel.blog.articles.update', $article) : route('panel.blog.articles.create')  }}" method="post">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="title">Заголовок</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $article->slug }}" required>
                                        <div class="input-group-append">
                                            <button id="slug-generate" class="btn btn-outline-primary" type="button">Сгенерировать</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Описание</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="description" name="description" value="{{ $article->description }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="status">Статус</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select select2-hidden-accessible" id="status" name="status" data-placeholder="Выбрать">
                                        @foreach(array_reverse(\App\Models\Article::$status, true) as $key => $status)
                                            <option value="{{ $key }}"{{ $key === $article->status ? ' selected': '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="rubric_id">Рубрика</label>
                                <div class="form-control-wrap" id="rubric_id">
                                    <select class="form-control form-select select2-hidden-accessible" name="rubric_id" data-placeholder="Выбрать" required data-msg="Выберите Рубрику">
                                        <option label="empty" value=""></option>
                                        @foreach(\App\Models\Rubric::withCount('articles')->get() as $rubric)
                                            <option value="{{ $rubric->id }}"{{ $rubric->id === $article->rubric_id ? ' selected': '' }}>
                                                {{ $rubric->title }} ({{ $rubric->articles_count }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Картинка статьи</label>
                                <input style="visibility:hidden" id="img" type="text" name="img" value="{{ $article->img }}" required data-msg="Загрузите картинку">
                                <div class="form-control crutch-dropzone dz-clickable">
                                    <div class="dz-message" data-dz-message>
                                        @if($article->id)
                                            <div id="article-img">
                                                <img src="{{ $article->img }}" width="150" height="150" alt="{{ $article->title }}">
                                            </div>
                                        @endif
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
                                    <textarea style="height: 400px" class="form-control form-control-sm summernote-basic" id="body" name="body" placeholder="Текст статьи" required>{!! $article->body !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">{{ $article->id ? 'Сохранить': 'Добавить'  }}</button>
                            </div>
                        </div>
                    </div>
                </form>
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
          $('#article-img').remove();
        });
        this.on('removedfile', function () {
          img.val('');
        });
      },
    };
    $('.crutch-dropzone').crutchZone(options);

    $('.form-select').on('select2:select', function () {
      $(this).removeClass('invalid').nextAll('#rubric_id-error').hide();
    });

    $('#slug-generate').slugGenerate();

  });
</script>
@endpush
