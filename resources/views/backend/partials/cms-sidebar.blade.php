<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('admin/cms*') ? 'active' : '' }}" href="#sidebarCMSPages"
        data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->is('admin/cms*') ? 'true' : 'false' }}"
        aria-controls="sidebarCMSPages">
        <i class="ri-pages-line"></i>
        <span data-key="t-pages">CMS</span>
    </a>

    <div class="collapse menu-dropdown {{ request()->is('admin/cms*') ? 'show' : '' }}" id="sidebarCMSPages">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('cms.user-dashboard.index') }}"
                    class="nav-link {{ request()->routeIs('cms.user-dashboard.index') ? 'active' : '' }}"
                    data-key="t-user-dashboard">
                    User Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cms.question-mark-text.index') }}"
                    class="nav-link {{ request()->routeIs('cms.question-mark-text.index') ? 'active' : '' }}"
                    data-key="t-question-mark-text">
                    Question Mark Text
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cms.profile-review-message.index') }}"
                    class="nav-link {{ request()->routeIs('cms.profile-review-message.index') ? 'active' : '' }}"
                    data-key="t-profile-review-message">
                    Profile Review Message
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cms.home-page.index') }}"
                    class="nav-link {{ request()->routeIs('cms.home-page.index') ? 'active' : '' }}"
                    data-key="t-home-page">
                    Home Page (Image)
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cms.home-page-banner.index') }}"
                    class="nav-link {{ request()->routeIs('cms.home-page-banner.index') ? 'active' : '' }}"
                    data-key="t-home-page-banner">
                    Home Page (Banner)
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cms.auth-page.index') }}"
                    class="nav-link {{ request()->routeIs('cms.auth-page.index') ? 'active' : '' }}"
                    data-key="t-auth-page">
                    Auth Page
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cms.testimonial.index') }}"
                    class="nav-link {{ request()->routeIs('cms.testimonial.index') ? 'active' : '' }}"
                    data-key="t-auth-page">
                    Testimonial Page
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cms.questionnaires.index') }}"
                    class="nav-link {{ request()->routeIs('cms.questionnaires.index') ? 'active' : '' }}"
                    data-key="t-questionnaires">
                    Questionnaires
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cms.join-us.index') }}"
                    class="nav-link {{ request()->routeIs('cms.join-us.index') ? 'active' : '' }}"
                    data-key="t-join-us">
                    Join Us
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('cms.service-type.index') }}"
                    class="nav-link {{ request()->routeIs('cms.service-type.index') ? 'active' : '' }}"
                    data-key="t-service-type">
                    Service Types
                </a>
            </li>
        </ul>
    </div>
</li>
