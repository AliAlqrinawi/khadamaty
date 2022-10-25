<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href=""><img src="https://swordchampion.com/logo/logo-light.png" class="main-logo" alt="logo" style="width: 150px;"></a>
        <a class="desktop-logo logo-dark active" href=""><img src="https://swordchampion.com/logo/logo-light.png" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href=""><img src="https://swordchampion.com/logo/logo-mine.png" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href=""><img src="https://swordchampion.com/assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{  asset('assets/img/1.jpg') ?? ""}}"><span
                            class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0"> {{ Auth::user()->first_name ?? ""}}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->email ?? ""}}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">Main</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url(\Illuminate\Support\Facades\App::getLocale().'/') }}">
                    <img class="side-menu__icon"
                         src="{{url('https://img.icons8.com/fluency/48/000000/dashboard-layout.png')}}"
                         style=" width: 30px; height: 30px;"/>
                    <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.dashboard')}}</span>
                </a>
            </li>
            <li class="side-item side-item-category">General</li>
             
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                        <img class="side-menu__icon" style=" width: 30px; height: 30px;"
                             src="{{url('https://img.icons8.com/external-icongeek26-outline-colour-icongeek26/64/000000/external-monitor-online-education-icongeek26-outline-colour-icongeek26-1.png')}}"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.users')}}</span>
                        <i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" style=" font-weight: bold;"
                               href="#">{{trans('menu.admins')}}</a></li>
                    </ul>
                </li>
 
                <li class="slide">
                    <a class="side-menu__item" href="#">
                        <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/344/service.png')}}"
                             style=" width: 30px; height: 30px;"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.roles')}}</span>
                    </a>
                </li>
 
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('category') }}">
                        <img class="side-menu__icon"
                             src="{{url('https://img.icons8.com/nolan/344/categorize.png')}}"
                             style=" width: 30px; height: 30px;"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.cats')}}</span>
                    </a>
                </li>
  
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('package') }}">
                        <img class="side-menu__icon"
                             src="{{url('https://img.icons8.com/nolan/344/grocery-shelf.png')}}"
                             style=" width: 30px; height: 30px;"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.products')}}</span>
                    </a>
                </li>
 
                <!-- <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                        <img class="side-menu__icon" style=" width: 30px; height: 30px;"
                             src="{{url('https://img.icons8.com/external-icongeek26-outline-colour-icongeek26/64/000000/external-monitor-online-education-icongeek26-outline-colour-icongeek26-1.png')}}"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.notifyuser')}}</span>
                        <i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" style=" font-weight: bold;"
                               href="#">{{trans('menu.better')}}</a></li>
                        <li><a class="slide-item" style=" font-weight: bold;"
                               href="#">{{trans('menu.modern')}}</a></li>
                        <li><a class="slide-item" style=" font-weight: bold;"
                               href="{{ url('admin/fav/clothes') }}">{{trans('menu.fav')}}</a></li>
                    </ul>
                </li> -->

                <li class="slide">
                    <a class="side-menu__item" href="{{ route('ads') }}">
                        <img class="side-menu__icon"
                             src="{{url('https://img.icons8.com/external-icongeek26-outline-colour-icongeek26/344/external-ads-ads-icongeek26-outline-colour-icongeek26-7.png')}}"
                             style=" width: 30px; height: 30px;"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.ads')}}</span>
                    </a>
                </li>
 
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('orders') }}">
                        <img class="side-menu__icon"
                             src="{{url('https://img.icons8.com/ultraviolet/344/deliver-food.png')}}"
                             style=" width: 30px; height: 30px;"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.order')}}</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{ route('countries') }}">
                        <img class="side-menu__icon"
                             src="{{url('https://img.icons8.com/nolan/344/region-code.png')}}"
                             style=" width: 30px; height: 30px;"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.regions')}}</span>
                    </a>
                </li>
  
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('cities') }}">
                        <img class="side-menu__icon"
                             src="{{url('https://img.icons8.com/nolan/344/region-code.png')}}"
                             style=" width: 30px; height: 30px;"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.cities')}}</span>
                    </a>
                </li>
 
            <!-- <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <img class="side-menu__icon" style=" width: 30px; height: 30px;"
                         src="{{url('https://img.icons8.com/nolan/344/message-group.png')}}"/>
                    <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.Alert')}}</span>
                    <i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" style=" font-weight: bold;"
                           href="{{ url('admin/appUser/notify2') }}">{{trans('menu.Members_alert')}}</a></li>
                    <li><a class="slide-item" style=" font-weight: bold;"
                           href="{{ url('admin/appUser/notify') }}">{{trans('menu.Alert')}}</a></li>
                </ul>
            </li> -->
 
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                        <img class="side-menu__icon" style=" width: 30px; height: 30px;"
                             src="{{url('https://img.icons8.com/nolan/64/settings--v1.png')}}"/>
                        <span class="side-menu__label" style=" font-weight: bold;">{{trans('menu.setting')}}</span>
                        <i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" style=" font-weight: bold;"
                               href="{{ route('setting.global') }}">{{trans('menu.global')}}</a></li>
                        <li><a class="slide-item" style=" font-weight: bold;"
                               href="{{ route('setting.social') }}">{{trans('menu.social')}}</a></li>
                    </ul>
                </li>
 
        </ul>
    </div>
</aside>
<!-- main-sidebar -->
