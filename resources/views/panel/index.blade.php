@extends('layouts.panel')

@section('title'){{ config('app.name') }}: Панель управления @endsection
@section('description'){{ config('app.name') }}: Панель управления @endsection

@section('content')
    <div class="nk-block-head nk-block-head-lg wide-md">
        <div class="nk-block-head-content">
            <h2 class="nk-block-title fw-normal">Проект "Отзовик"</h2>
            <div class="nk-block-des">
                <p class="lead">Отзывы! Лучшие из лучших!.</p>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title mb-4"><h3 class="title">Добро пожаловать в панель управления контентом!</h3></div>
                        <div class="row g-gs">
                            <div class="col-xxl-3">
                                <div class="fake-class"><h5 class="title">Начать</h5>
                                    <div class="nk-block-des text-soft"><p>Вы можете настроить свой сайт здесь.</p>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-lg mt-4">Настроить сайт</a></div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-xxl-3">
                                <div class="fake-class"><h5 class="title">Следующие шаги</h5>
                                    <ul class="link-list is-compact pb-0">
                                        <li>
                                            <a href="{{ route('panel.blog.articles.create') }}"><em class="icon ni ni-file-text"></em><span>Добавить статью в блог</span></a>
                                        </li>
                                        <li><a href="{{ route('panel.products.create') }}"><em class="icon ni ni-property-add"></em><span>Добавить продукт</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('home') }}" target="_blank"><em class="icon ni ni-laptop"></em><span>Посмотреть свой сайт</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-xxl-3">
                                <div class="fake-class"><h5 class="title">Сводка</h5>
                                    <ul class="link-list is-compact pb-0">
                                        <li>
                                            <a href="{{ route('panel.blog.articles.index') }}"><em class="icon ni ni-edit-fill"></em><span>{{ $articles_count }} Статей</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('panel.reviews.index') }}"><em class="icon ni ni-files"></em><span>{{ $reviews_count }} Отзывов</span></a>
                                        </li>
                                        <li>
                                            <a href="{{-- route('panel.comments.index') --}}"><em class="icon ni ni-comments"></em><span>{{ $comments_count }} Комментариев</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-xxl-3">
                                <div class="fake-class"><h5 class="title">Больше действий</h5>
                                    <ul class="link-list is-compact pb-0">
                                        <li>
                                            <a href="#"><em class="icon ni ni-grid-fill"></em><span>Управление виджетами или меню</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><em class="icon ni ni-comments"></em><span>Включить/отключить комментарии</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><em class="icon ni ni-more-h"></em><span>Подробнее о начале работы</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xxl-6">
                <div class="card card-bordered h-100">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group g-2">
                            <div class="card-title card-title-sm"><h6 class="title">Быстрый черновик</h6></div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <form action="#">
                            <div class="row g-gs align-center">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <label class="form-label" for="title">Заголовок</label><input type="text" class="form-control" id="title" placeholder="Заголовок">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="content">Содержимое</label><textarea class="form-control form-control-sm no-resize" id="content" placeholder="О чём ты думаешь?!"></textarea>
                                    </div>
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xxl-3">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm"><h6 class="title">Просматриваемые страницы</h6></div>
                            <div class="card-tools">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-toggle="dropdown">30 Дней</a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>7 Дней</span></a></li>
                                            <li><a href="#"><span>15 Дней</span></a></li>
                                            <li><a href="#"><span>30 Дней</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list is-compact">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Страница</span></div>
                            <div class="nk-tb-col text-right"><span>Просмотры</span></div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span class="tb-sub"><span>/</span></span></div>
                            <div class="nk-tb-col text-right"><span class="tb-sub tb-amount"><span>2,879</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span class="tb-sub"><span>/reviews</span></span>
                            </div>
                            <div class="nk-tb-col text-right"><span class="tb-sub tb-amount"><span>2,094</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span class="tb-sub"><span>/reviews/avto-i-moto/avtozapchasti</span></span></div>
                            <div class="nk-tb-col text-right"><span class="tb-sub tb-amount"><span>1,634</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span class="tb-sub"><span>/reviews/filmy-video-i-tv/televidenie-i-videokanaly</span></span></div>
                            <div class="nk-tb-col text-right"><span class="tb-sub tb-amount"><span>1,497</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span class="tb-sub"><span></span>/blog</span></div>
                            <div class="nk-tb-col text-right"><span class="tb-sub tb-amount"><span>1,349</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span class="tb-sub"><span>/faq</span></span>
                            </div>
                            <div class="nk-tb-col text-right"><span class="tb-sub tb-amount"><span>984</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span class="tb-sub"><span>/contacts</span></span>
                            </div>
                            <div class="nk-tb-col text-right"><span class="tb-sub tb-amount"><span>879</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xxl-3">
                <div class="card card-bordered h-100">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group g-2">
                            <div class="card-title card-title-sm"><h6 class="title">Последняя активность</h6></div>
                        </div>
                    </div>
                    <ul class="nk-activity">
                        <li class="nk-activity-item">
                            <div class="nk-activity-media user-avatar bg-success">
                                {{--<img src="/demo3/images/avatar/c-sm.jpg" alt="">--}}
                            </div>
                            <div class="nk-activity-data">
                                <div class="label">Keith Jensen опубликовала комментарий.</div>
                                <span class="time">2 часа назад</span></div>
                        </li>
                        <li class="nk-activity-item">
                            <div class="nk-activity-media user-avatar bg-warning">HS</div>
                            <div class="nk-activity-data">
                                <div class="label">Harry Simpson опубликовал комментарий.</div>
                                <span class="time">2 часа назад</span></div>
                        </li>
                        <li class="nk-activity-item">
                            <div class="nk-activity-media user-avatar bg-azure">SM</div>
                            <div class="nk-activity-data">
                                <div class="label">Stephanie отредактировала сообщение.</div>
                                <span class="time">2 часа назад</span></div>
                        </li>
                        <li class="nk-activity-item">
                            <div class="nk-activity-media user-avatar bg-pink">TM</div>
                            <div class="nk-activity-data">
                                <div class="label">Timothy Moreno добавил сообщение.</div>
                                <span class="time">2 часа назад</span></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection