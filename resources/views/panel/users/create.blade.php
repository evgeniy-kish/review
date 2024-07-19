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
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Добавить пользователя</h3>
            </div>
        </div>
    </div>

    <form class="crutch-validate is-alter row g-gs" action="{{ route('panel.users.create') }}" method="POST">
        <div class="col-12">
            <div class="card card-bordered">
                <div class="card-inner">
                    <div class="row g-gs">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Имя</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail2" required aria-describedby="emailHelp">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group block-generate">
                                <label for="exampleInputEmail3" class="form-label">Пароль</label>
                                <input type="text" name="password" class="form-control" id="exampleInputEmail3" required aria-describedby="emailHelp">
                                <span class="icon-generate">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M234.7 42.7L197 56.8c-3 1.1-5 4-5 7.2s2 6.1 5 7.2l37.7 14.1L248.8 123c1.1 3 4 5 7.2 5s6.1-2 7.2-5l14.1-37.7L315 71.2c3-1.1 5-4 5-7.2s-2-6.1-5-7.2L277.3 42.7 263.2 5c-1.1-3-4-5-7.2-5s-6.1 2-7.2 5L234.7 42.7zM46.1 395.4c-18.7 18.7-18.7 49.1 0 67.9l34.6 34.6c18.7 18.7 49.1 18.7 67.9 0L529.9 116.5c18.7-18.7 18.7-49.1 0-67.9L495.3 14.1c-18.7-18.7-49.1-18.7-67.9 0L46.1 395.4zM484.6 82.6l-105 105-23.3-23.3 105-105 23.3 23.3zM7.5 117.2C3 118.9 0 123.2 0 128s3 9.1 7.5 10.8L64 160l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L128 160l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L128 96 106.8 39.5C105.1 35 100.8 32 96 32s-9.1 3-10.8 7.5L64 96 7.5 117.2zm352 256c-4.5 1.7-7.5 6-7.5 10.8s3 9.1 7.5 10.8L416 416l21.2 56.5c1.7 4.5 6 7.5 10.8 7.5s9.1-3 10.8-7.5L480 416l56.5-21.2c4.5-1.7 7.5-6 7.5-10.8s-3-9.1-7.5-10.8L480 352l-21.2-56.5c-1.7-4.5-6-7.5-10.8-7.5s-9.1 3-10.8 7.5L416 352l-56.5 21.2z"/></svg>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Роль</label>
                                <div class="form-control-wrap" id="activity">
                                    <select class="form-control form-select select2-hidden-accessible" name="role" data-placeholder="Выбрать" required data-msg="Выберите Роль">
                                        <option label="empty" value=""></option>
                                        @foreach(\App\Models\User::$roles as $key => $name)
                                            <option value="{{ $key }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Создать</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection



<style>
    .block-generate{
        position: relative;
        display: block;
    }
    .icon-generate{
        position: absolute;
        right: 10px;
        bottom: 10px;
        cursor: pointer;
    }
    .icon-generate svg{
        width: 15px;
        height: 15px;
    }
</style>


@push('script')
    <script>
        function gen_password(len){
            var password = "";
            var symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!№%:?*()_+=";
            for (var i = 0; i < len; i++){
                password += symbols.charAt(Math.floor(Math.random() * symbols.length));
            }
            return password;
        }


        $('.icon-generate').click(function(){
            $('input[name="password"]').val(gen_password(8));
        });
    </script>
@endpush
