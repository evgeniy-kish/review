<div class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{ route('panel.index') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="/dashboard/images/logo.png" srcset="/dashboard/images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="/dashboard/images/logo-dark.png" srcset="/dashboard/images/logo-dark2x.png 2x" alt="logo-dark">
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading"><h6 class="overline-title text-primary-alt">Панель управления</h6></li>
                    <li class="nk-menu-item">
                        <a href="{{ route('panel.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span><span class="nk-menu-text">Панель управления</span></a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('panel.reviews.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-speed"></em></span><span class="nk-menu-text">Отзывы</span></a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-files"></em></span><span class="nk-menu-text">Компании</span></a>

                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.products.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Продукты</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.products.create') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Добавить продукт</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.categories.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Категории</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-template"></em></span><span class="nk-menu-text">Блог</span></a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.blog.articles.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Все статьи</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.blog.articles.create') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Добавить статью</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.blog.rubrics.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Рубрики</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-img"></em></span><span class="nk-menu-text">Медиа</span></a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('panel.comments.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-comments"></em></span><span class="nk-menu-text">Комментарии</span></a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-question"></em></span><span class="nk-menu-text">FAQ</span></a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.faq.questions.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Все вопросы-ответы</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.faq.questions.create') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Добавить вопрос-ответ</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.faq.subjects.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Темы</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-color-palette"></em></span><span class="nk-menu-text">Темы</span></a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-opt-alt"></em></span><span class="nk-menu-text">Плагины</span></a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Все плагины</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Установленные плагины</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-user-alt"></em></span><span class="nk-menu-text">Пользователи</span></a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('panel.users.index') }}" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Список пользователей</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-text">Профили пользователей</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('panel.orders.index') }}" class="nk-menu-link" data-original-title="" title="">
                            <span class="nk-menu-icon"><em class="icon ni ni-wallet-alt"></em></span><span class="nk-menu-text">Orders</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link" data-original-title="" title=""><span class="nk-menu-icon"><em class="icon ni ni-setting-alt"></em></span><span class="nk-menu-text">Настройки</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>