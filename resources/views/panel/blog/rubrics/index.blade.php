<?php
/**
 * @var Rubric[] $rubrics
 */

use App\Models\Rubric;

?>
@extends('layouts.panel')

@section('title')Рубрики блога@endsection
@section('description')Рубрики блога@endsection

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Рубрики</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-6">
                <div class="card card-bordered card-stretch">
                    <div class="card-inner-group">
                        <div class="card-inner p-0">
                            <div id="editable" class="nk-tb-list nk-tb-ulist">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span class="sub-text">Название</span></div>
                                    <div class="nk-tb-col tb-col-sm"><span class="sub-text">Slug</span></div>
                                    <div class="nk-tb-col"><span class="sub-text">Count</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools text-right"></div>
                                </div>
                                @foreach($rubrics as $rubric)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col"><span>{{ $rubric->title }}</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>{{ $rubric->slug }}</span></div>
                                        <div class="nk-tb-col">
                                            <div><span>{{ $rubric->articles_count }}</span></div>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1" data-info="{{ $rubric }}">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="#" class="btn btn-trigger btn-icon edit-rubric" data-toggle="tooltip" data-placement="top" title="Редактировать">
                                                        <em class="icon ni ni-edit-fill"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <a href="#" class="btn btn-trigger btn-icon delete-rubric" data-toggle="tooltip" data-placement="top" title="Удалить">
                                                        <em class="icon ni ni-trash-fill"></em>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <a href="#" class="edit-rubric"><em class="icon ni ni-edit-fill"></em><span>Редактировать</span></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="delete-rubric"><em class="icon ni ni-trash-fill"></em><span>Удалить</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <form class="crutch-validate is-alter" action="{{ route('panel.blog.rubrics.store') }}" method="post">

                            <div class="form-group">
                                <label class="form-label" for="title">Название рубрики</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="slug">Slug</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="slug" name="slug" required>
                                        <div class="input-group-append">
                                            <button id="slug-generate" class="btn btn-outline-primary" type="button">Сгенерировать</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-primary">Добавить рубрику</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-rubric">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Редактировать категорию</h5>
                    <form action="" class="mt-4 crutch-validate is-alter">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="editTitle">Название</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="editTitle" name="title" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="editSlug">Slug</label>
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="editSlug" name="slug" required>
                                            <div class="input-group-append">
                                                <button id="slug-generate-edit" class="btn btn-outline-primary" type="button">
                                                    <em class="icon ni ni-cpu"></em></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </li>
                                    <li><a href="#" class="link link-light" data-dismiss="modal">Отмена</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="/dashboard/js/slug.js"></script>
    <script>
      $(function () {
        const editable = $('#editable');
        const modal = $('#edit-rubric');

        editable.on('click', '.edit-rubric', function (e) {
          e.preventDefault();
          const data = $(this).closest('ul.nk-tb-actions').data('info');

          modal
            .find('form').attr('action', '/panel/blog/rubrics/' + data.id + '/edit').end()
            .find('#editTitle').val(data.title).removeClass('invalid').addClass('valid').nextAll('span').hide().end().end()
            .find('#editSlug').val(data.slug).removeClass('invalid').addClass('valid').nextAll('span').hide();

          setTimeout(function () {
            modal.modal('show');
          });
        });

        editable.on('click', '.delete-rubric', function (e) {
          e.preventDefault();
          const data = $(this).closest('ul.nk-tb-actions').data('info');

          Swal.fire({
            title: 'Удалить рубрику?',
            text: data.title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f54ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да. Удалить!',
            cancelButtonText: 'Отмена',
            showLoaderOnConfirm: true,
            preConfirm: function () {
              return $.post('/panel/blog/rubrics/' + data.id + '/delete', {}, null, 'json')
                .then(function (json) {
                  location.assign(json.redirect || '/');
                }).catch(function (err) {
                  Swal.showValidationMessage(err['responseJSON']['error'] || 'Forbidden!');
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
          });
        });

        $('#slug-generate').slugGenerate();
        $('#slug-generate-edit').slugGenerate({ title: 'editTitle', slug: 'editSlug' });
      });
    </script>
@endpush
