<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="display: block;text-align: center;height: 100px">

        <a href="index.html" class="app-brand-link" style="margin-bottom: 10px">
        <span class="app-brand-logo demo" style="margin: auto">
          {{-- <img src="{{asset('assets/img/')}}" width="100%" height="100%"> --}}
        </span>
        </a>
        <!-- app-brand-text demo menu-text fw-bold -->
        <p class="">
            <b>توصيات البورصه</b>
        </p>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>

    </div>


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class=" menu-item {{ url()->current() == url("/") ? "active" : "" }} ">
            <a href="{{route('home') }}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div >لوحة التحكم</div>
                {{-- <div class="badge bg-primary rounded-pill ms-auto">3</div> --}}
            </a>
        </li>
        <li class="menu-item {{ url()->current() == url("/admins") ? "active" : "" }}">
            <a href="{{ url('/admins') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users-group"></i>
                <div data-i18n="قائمة المديرين">قائمة المديرين</div>
            </a>
        </li>
        <li class="menu-item {{ url()->current() == url("/stoks") ? "active" : "" }}">
            <a href="{{route('stoks') }}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-chart-pie"></i>
                <div data-i18n="حركة البورصة اليومية">حركة البورصة اليومية</div>
            </a>
        </li>
        <!-- Academy menu end -->
        <li class="menu-item {{ url()->current() == url("/news") ? "active" : "" }}">
            <a href="{{ route('news') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-map"></i>
                <div data-i18n="الأخبار">الأخبار</div>
            </a>
        </li>
        <li class="menu-item {{ url()->current() == url("/sectors") ? "active" : "" }}">
            <a href="{{ route('sectors') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-layers-intersect"></i>
                <div data-i18n="القطاعات">القطاعات</div>
            </a>
        </li>
        <li class="menu-item {{ url()->current() == url("/agendas") ? "active" : "" }}">
            <a href="{{ route('agendas') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-chart-bar"></i>
                <div data-i18n="الاجندة الاقتصادية">الاجندة الاقتصادية</div>
            </a>
        </li>
        <li class="menu-item {{ url()->current() == url("/sfree") ? "active" : "" }}">
            <a href="{{ route('sfree.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-chart-arrows"></i>
                <div data-i18n="الاسهم المجانية">الاسهم المجانية</div>
            </a>
        </li>
        <li class="menu-item {{ url()->current() == url("/privacy") ? "active" : "" }}">
            <a href="{{ route('privacy') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-shield-lock"></i>
                <div data-i18n="سياسة الخصوصية">سياسة الخصوصية</div>
            </a>
        </li>
    </ul>
</aside>
