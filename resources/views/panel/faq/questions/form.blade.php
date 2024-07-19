<?php

/**
 * @var Question $question
 */

use App\Models\Question;

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
                    {{ $question->id ? 'Редактировать: ' . $question->title : 'Добавить вопрос в FAQ' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form class="crutch-validate is-alter" action="{{ $question->id ? route('panel.faq.questions.update', $question) : route('panel.faq.questions.create')  }}" method="post">
                    <div class="row g-gs">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="title">Заголовок</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $question->title }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $question->slug }}" required>
                                        <div class="input-group-append">
                                            <button id="slug-generate" class="btn btn-outline-primary" type="button">Сгенерировать</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="answer">Ответ</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="answer" name="answer" value="{{ $question->answer }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="subject_id">Тема</label>
                                <div class="form-control-wrap" id="subject_id">
                                    <select class="form-control form-select select2-hidden-accessible" name="subject_id" data-placeholder="Выбрать" required data-msg="Выберите тему">
                                        <option label="empty" value=""></option>
                                        @foreach(\App\Models\Subject::withCount('questions')->get() as $subject)
                                            <option value="{{ $subject->id }}"{{ $subject->id === $question->subject_id ? ' selected': '' }}>
                                                {{ $subject->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">{{ $question->id ? 'Сохранить': 'Добавить'  }}</button>
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

    $('.form-select').on('select2:select', function () {
      $(this).removeClass('invalid').nextAll('#subject_id-error').hide();
    });

    $('#slug-generate').slugGenerate();

  });
</script>
@endpush
