<?php

/**
 * @var \App\Models\Comment[] $comments
 */

?>
@if($comments->isNotEmpty())
    <div id="comments-area" class="comment_area mb-50 clearfix">
        <h4 class="mb-5">{{ __('Comments') }}</h4>
        <ol class="pl-0">
            @foreach($comments as $comment)
                <li class="single_comment_area">
                    <div class="comment-content d-flex">
                        <div class="comment-author"><img src="{{ $comment->user->avatar }}" alt="author"></div>
                        <div class="comment-meta py-2 flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6>{{ $comment->user->name }}</h6>
                                <a class="post-date ms-1" href="#">{{ $comment->created_at->diffForHumans() }}</a>
                            </div>
                            <p>{{ $comment->message }}</p>
                            @if(auth()->check() && auth()->user()->hasVerifiedEmail())
                                <div class="d-flex justify-content-end">
                                    <a class="reply m-0 btn" href="#" data-comment-id="{{ $comment->id }}">Ответить</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="contact-area reply-area"></div>
                    @foreach($comment->children as $children)
                        <ol class="children">
                            <!-- Single Comment Area-->
                            <li class="single_comment_area">
                                <div class="comment-content d-flex">
                                    <div class="comment-author"><img src="{{ $children->user->avatar }}" alt="author"></div>
                                    <div class="comment-meta py-2 flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6>{{ $children->user->name }}</h6><a class="post-date" href="#">{{ $children->created_at->diffForHumans() }}</a>
                                        </div>
                                        <p>{{ $children->message }}</p>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    @endforeach
                </li>
            @endforeach
        </ol>
    </div>

    @push('script')
        <script>
          (function ($) {
            const main_form = $('#comment-form');
            const template = (parent_id, token, action) => {
              return `<h4 class="mb-5">Ответить на сообщение</h4>
                <form class="contact-from mb-5" action="${action}" method="post">
                    <input type="hidden" name="_token" value="${token}" autocomplete="off">
                    <input type="hidden" name="parent_id" value="${parent_id}">
                    <div class="row">
                        <div class="col-12">
                            <textarea class="form-control mb-30" name="message" placeholder="Текст комментария..." required></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn saasbox-btn btn-sm" type="submit">Отправить</button>
                        </div>
                    </div>
                </form>`;
            };

            $('#comments-area').on('click', '[data-comment-id]', function (e) {
              e.preventDefault();
              const _this = $(this).addClass('disabled');
              const parent_id = +_this.data('comment-id');
              const action = main_form.attr('action');
              const token = main_form.find('[name="_token"]').val();

              _this.closest('.single_comment_area').find('.reply-area').html(template(parent_id, token, action));
            });

          })(jQuery);
        </script>
    @endpush

@endif