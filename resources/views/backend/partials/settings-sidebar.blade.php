<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="#sidebarPages"
        data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->is('admin/settings*') ? 'true' : 'false' }}"
        aria-controls="sidebarPages">
        <i class="ri-settings-3-line"></i>
        <span data-key="t-pages">Settings</span>
    </a>

    <div class="collapse menu-dropdown {{ request()->is('admin/settings*') ? 'show' : '' }}" id="sidebarPages">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('profile.setting') }}"
                    class="nav-link {{ request()->routeIs('profile.setting') ? 'active' : '' }}"
                    data-key="t-profile-setting">
                    Profile Settings
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('system.index') }}"
                    class="nav-link {{ request()->routeIs('system.index') ? 'active' : '' }}"
                    data-key="t-system-settings">
                    System Settings
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('mail.setting') }}"
                    class="nav-link {{ request()->routeIs('mail.setting') ? 'active' : '' }}"
                    data-key="t-system-settings">
                    SMTP Server
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('integration.setting') }}"
                    class="nav-link {{ request()->routeIs('integration.setting') ? 'active' : '' }}"
                    data-key="t-integration-settings">
                    Integration Settings
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('social.index') }}"
                    class="nav-link {{ request()->routeIs('social.index') ? 'active' : '' }}"
                    data-key="t-social-media-settings">
                    Social Media Settings
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('settings.dynamic_page.index') }}"
                    class="nav-link {{ request()->routeIs('settings.dynamic_page.*') ? 'active' : '' }}"
                    data-key="t-dynamic-page-settings">
                    Dynamic Page Settings
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('terms-and-conditions.index') }}"
                    class="nav-link {{ request()->routeIs('terms-and-conditions.index') ? 'active' : '' }}"
                    data-key="t-terms-and-conditions">
                    Terms & Conditions
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('privacy-policy.index') }}"
                    class="nav-link {{ request()->routeIs('privacy-policy.index') ? 'active' : '' }}"
                    data-key="t-terms-and-conditions">
                    Privacy Policy
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('inclusions-cancellation.index') }}"
                    class="nav-link {{ request()->routeIs('inclusions-cancellation.index') ? 'active' : '' }}"
                    data-key="t-inclusions-cancellation">
                    Inclusions & Cancellation Policy
                </a>
            </li>
        </ul>
    </div>
</li>
