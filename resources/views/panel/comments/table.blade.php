<?php

/**
 * @var \App\Models\Comment[] $comments
*/

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist" id="comments-list">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Пользователь</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Комментарий</span></div>
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text">Дата</span></div>

                        <div class="nk-tb-col nk-tb-col-tools text-right">
                            <em class="icon ni ni-setting-alt"></em>
                        </div>
                    </div>

                    @foreach($comments as $comment)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <a href="{{ route('panel.users.show', $comment->user) }}">{{ $comment->user->name }}</a>
                            </div>
                            <div class="nk-tb-col">
                                {{ $comment->message }}
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                {{ $comment->created_at->format('d.m.Y') }}
                            </div>

                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                                <em class="icon ni ni-more-h"></em>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="#" data-delete="{{ route('panel.comments.destroy', $comment) }}">
                                                            <em class="icon ni ni-trash-fill"></em><span>Удалить</span>
                                                        </a>
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