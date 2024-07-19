<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid"><label class="custom-control-label" for="uid"></label>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-xxl"><span class="sub-text">id</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Пользователь</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Email</span></div>
                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Роль</span></div>
                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Количество отзывов</span></div>
                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Баланс</span></div>
                        <div class="nk-tb-col nk-tb-col-tools text-right">
                            <a href="#" class="btn btn-xs btn-outline-light btn-icon"><em class="icon ni ni-plus"></em></a>
                        </div>
                    </div>
                    @foreach($users as $user)

                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid{{ $user->id }}">
                                    <label class="custom-control-label" for="uid{{ $user->id }}"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-xxl">
                                <span>{{ $user->id }}</span></div>
                            <div class="nk-tb-col">
                                <a href="{{ route('panel.users.show', $user) }}">
                                    <div class="user-card">
                                        <div class="user-avatar  sm bg-primary-dim">
                                            <em class="icon ni ni-user-fill"></em>
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $user->name }}</span>
                                        </div>
                                    </div>
                                </a></div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{ $user->email }}</span></div>
                            <div class="nk-tb-col tb-col-mb">
                                <span>{{ $user->roleName() }}</span></div>
                            <div class="nk-tb-col tb-col-lg"><span>{{ $user->reviews_count }}</span></div>
                            <div class="nk-tb-col tb-col-lg"><span>{{ $user->balance }}</span></div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li class="nk-tb-action-hidden">
                                        <a href="{{ route('panel.users.show', $user) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Редактировать"><em class="icon ni ni-edit-fill"></em></a>
                                    </li>
                                    <li class="nk-tb-action-hidden">
                                        <a href="{{ route('users.show', $user) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Посмотреть на сайте" target="_blank"><em class="icon ni ni-eye-fill"></em></a>
                                    </li>
                                    <li class="nk-tb-action-hidden">
                                        <form action="{{ route('panel.users.destroy', $user) }}" method="post" onsubmit="return confirm('Удалить пользователя?')">
                                            <button type="submit" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Удалить"><em class="icon ni ni-trash-fill"></em></button>
                                            @csrf
                                        </form>
                                    </li>
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="#"><em class="icon ni ni-opt-dot-fill"></em><span>Настройки</span></a>
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