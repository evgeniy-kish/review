<?php

/**
 * @var User     $user
 * @var Review[] $reviews
 */

use App\Models\User;
use App\Models\Review;

?>
@extends('layouts.panel')

@section('title', 'Профиль')
@section('description', 'Профиль')

@section('content')
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-aside-wrap">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content"><h4 class="nk-block-title">Личная информация</h4>
                                <div class="nk-block-des">
                                    <p>Основная информация, такая как ваше имя и адрес, которую вы используете на платформе {{ config('app.name', 'Отзовик') }}.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content align-self-start d-lg-none">
                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">

                        <div class="nk-data data-list">
                            <div class="data-head"><h6 class="overline-title">Basics</h6></div>
                            <div class="data-item" data-toggle="modal" data-target="#edit-profile">
                                <div class="data-col">
                                    <span class="data-label">Имя</span>
                                    <span class="data-value">{{ $user->name }}</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more"><em class="icon ni ni-forward-ios"></em></span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Email</span>
                                    <span class="data-value">{{ $user->email }}</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Роль</span>
                                    <span class="data-value">{{ $user->roleName() }}</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#edit-balance">
                                <div class="data-col">
                                    <span class="data-label">Монетки</span>
                                    <div class="data-value">
                                        <span>{{ $user->balance }}</span>
                                        @if($hold = $user->hold)
                                            <span class="text-warning">Hold: {{ $hold }}</span>
                                        @endif
                                        @currencyIcon
                                    </div>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more"><em class="icon ni ni-forward-ios"></em></span>
                                </div>
                            </div>
                        </div>

                        <div class="nk-data data-list">
                            <div class="data-head"><h6 class="overline-title">Preferences</h6></div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Язык</span><span class="data-value">Русский</span>
                                </div>
                                <div class="data-col data-col-end">
                                    <span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                    <div class="card-inner-group" data-simplebar>
                        <div class="card-inner">
                            <div class="user-card">
                                <div class="user-avatar bg-primary"><img src="{{ $user->avatar }}" width="40px" height="40px" alt=""><span></span></div>
                                <div class="user-info">
                                    <span class="lead-text">{{ $user->name }}</span>
                                    <span class="sub-text">{{ $user->email }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="card-inner p-0">
                            <ul class="link-list-menu">
                                <li><a class="active" href="#"><em class="icon ni ni-user-fill-c"></em><span>Личная информация</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('panel.reviews.table', ['reviews' => $reviews])

    <div class="card-inner">
        <div class="nk-block-between-md g-3">
            <div class="g">
                {{ $reviews->onEachSide(2)->links('panel.partials.paginate') }}
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-profile">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Редактировать профиль</h5>
                    <form action="{{ route('panel.users.update', $user) }}" class="mt-4 crutch-validate is-alter">
                        <div class="row g-gs">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Имя</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li><button type="submit" class="btn btn-primary">Сохранить</button></li>
                                    <li><a href="#" class="link link-light" data-dismiss="modal">Отмена</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-balance">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Скорректировать баланс</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body modal-body-md">
                    <form action="{{ route('panel.users.balance', $user) }}" class="crutch-validate is-alter">
                        <div class="row g-gs">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="charge">Сумма</label>
                                    <div class="form-control-wrap">
                                        <input type="number" class="form-control" id="charge" name="charge" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="reason">Основание</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="reason" name="reason"
                                                placeholder="Пополнение баланса" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li><button type="submit" class="btn btn-primary">Сохранить</button></li>
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
