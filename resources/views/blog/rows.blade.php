<div class="row g-5">
    @foreach($articles as $article)
        <div class="col-12">
            <div class="card blog-card border-0 no-boxshadow rounded-0">
                <a class="d-block mb-4" href="{{ route('blog.show', ['rubric_slug' => $article->rubric->slug, 'article' => $article->slug]) }}">
                    <img src="{{ $article->img }}" alt="{{ $article->title }}">
                </a>
                <div class="post-content">
                    <a class="d-block mb-1" href="{{ route('blog.rubric', $article->rubric) }}">{{ $article->rubric->title }}</a>
                    <a class="post-title d-block mb-3" href="{{ route('blog.show', ['rubric_slug' => $article->rubric->slug, 'article' => $article->slug]) }}">
                        <h4>{{ $article->title }}</h4>
                    </a>
                    <p>{{ $article->description }}</p>
                    <div class="post-meta"><span class="text-muted">{{ __('Time to read') }} {{ time_to_read($article->body) }} {{ __('min.') }}</span></div>
                </div>
            </div>
        </div>
    @endforeach
</div>