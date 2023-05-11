<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                @can('dashboard index')
                    <li>
                        <a href="{{ route('backend.dashboard') }}" class="waves-effect">
                            <i class="ri-home-4-fill"></i>
                            <span>@lang('backend.dashboard')</span>
                        </a>
                    </li>
                @endcan
                @can('slider index')
                    <li>
                        <a href="{{ route('backend.slider.index') }}" class="waves-effect">
                            <i class="ri-equalizer-line"></i>
                            <span>@lang('menus.slider')</span>
                        </a>
                    </li>
                @endcan
                @can('service index')
                <li>
                    <a href="{{ route('backend.service.index') }}" class="waves-effect">
                        <i class="ri-customer-service-line"></i>
                        <span>@lang('menus.services')</span>
                    </a>
                </li>
                @endcan
                @can('why-choose-us index')
                    <li>
                        <a href="{{ route('backend.why-choose-us.index') }}" class="waves-effect">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                            <span>@lang('menus.why-choose-us')</span>
                        </a>
                    </li>
                @endcan
                @can('packages index')
                    <li>
                        <a href="{{ route('backend.packages.index') }}" class="waves-effect">
                            <i class="ri-wallet-2-line"></i>
                            <span>@lang('menus.packages')</span>
                        </a>
                    </li>
                @endcan
                @can('package-components index')
                    <li>
                        <a href="{{ route('backend.package-components.index') }}" class="waves-effect">
                            <i class="ri-wallet-2-line"></i>
                            <span>@lang('menus.package-components')</span>
                        </a>
                    </li>
                @endcan
                <li class="menu-title">@lang('backend.site-setting')</li>
                @can('languages index')
                    <li>
                        <a href="{{ route('backend.site-languages.index') }}" class="waves-effect">
                            <i class="fas fa-language"></i>
                            <span>@lang('backend.languages')</span>
                        </a>
                    </li>
                @endcan
                @can('users index')
                    <li class="menu-title">@lang('backend.ap-setting')</li>

                    <li>
                        <a href="{{ route('backend.users.index') }}" class=" waves-effect">
                            <i class="ri-account-circle-fill"></i>
                            <span>@lang('backend.users')</span>
                        </a>
                    </li>
                @endcan
                @can('permissions index')
                    <li>
                        <a href="{{ route('backend.permissions.index') }}" class=" waves-effect">
                            <i class="ri-lock-2-fill"></i>
                            <span>@lang('backend.permissions')</span>
                        </a>
                    </li>
                @endcan
                @can('new-permission index')
                    <li>
                        <a href="{{ route('backend.givePermission') }}" class=" waves-effect">
                            <i class="ri-lock-unlock-fill"></i>
                            <span>@lang('backend.give-permission')</span>
                        </a>
                    </li>
                @endcan
                @can('report index')
                    <li>
                        <a href="{{ route('backend.report') }}" class="waves-effect">
                            <i class="fas fa-file"></i>
                            <span>@lang('backend.report')</span>
                        </a>
                    </li>
                @endcan
                @can('information index')
                    <li class="menu-title">@lang('backend.user-setting')</li>
                    <li>
                        <a href="{{ route('backend.my-informations.index') }}" class=" waves-effect">
                            <i class="ri-information-fill"></i>
                            <span>@lang('backend.informations')</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
