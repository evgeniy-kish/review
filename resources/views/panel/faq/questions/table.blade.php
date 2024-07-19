<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </div>
                        <div class="nk-tb-col"><span class="sub-text">Заголовок</span></div>
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text">Ответ</span></div>
                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Тема</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Дата</span></div>
                        <div class="nk-tb-col nk-tb-col-tools text-right">
                            <div class="dropdown">
                                <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                    <ul class="link-tidy sm no-bdr">
                                        <li>
                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked="" id="bl"><label class="custom-control-label" for="bl">Athor</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked="" id="ph"><label class="custom-control-label" for="ph">Date</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="vri"><label class="custom-control-label" for="vri">Status</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($questions as $question)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid-{{ $question->id }}"><label class="custom-control-label" for="uid-{{ $question->id }}"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col">
                                <a href="{{ route('panel.faq.questions.edit', $question)  }}"><span class="fw-medium">{{ $question->title }}</span></a>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <a href="{{ route('panel.faq.questions.edit', $question)  }}"><span class="fw-medium">{{ $question->answer }}</span></a>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <a href="{{ route('panel.faq.subjects.index') }}">{{ $question->subject->title }}</a>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <div>
                                    <span>{{ $question->created_at->format('d.m.Y \в H:i') }}</span>
                                    <br>
                                    <span>{{ $question->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li class="nk-tb-action-hidden">
                                        <a href="{{ route('panel.faq.questions.edit', $question)  }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Редактировать"><em class="icon ni ni-edit-fill"></em></a>
                                    </li>
                                    <li class="nk-tb-action-hidden">
                                        <a href="{{ route('faq.index') }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Посмотреть на сайте" target="_blank"><em class="icon ni ni-eye-fill"></em></a>
                                    </li>
                                    <li class="nk-tb-action-hidden">
                                        <form action="{{ route('panel.faq.questions.destroy', $question) }}" method="post" onsubmit="return confirm('Удалить вопрос?')">
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