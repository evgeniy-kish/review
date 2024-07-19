@hasSection('news')
    @yield('news')
@else
    <div class="nk-header-news d-none d-xl-block">
        <div class="nk-news-list">
            <a class="nk-news-item" href="#" onclick="return false;">
                <div class="nk-news-icon"><em class="icon ni ni-card-view"></em></div>
                <div class="nk-news-text">
                    <p>Текущая дата: <span>{{ date('d.m.Y') }}</span></p>
                </div>
            </a>
        </div>
    </div>
@endif