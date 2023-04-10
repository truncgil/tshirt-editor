<link rel="stylesheet" href="{{url("assets/admin/css/mobile-footer.css")}}">
<footer class="main-footer mobile-footer">
    <div class="container">
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item"><a href="{{url("admin")}}" class="nav-link waves active waves-effect"><span><i
                            class="nav-icon fas fa-product"></i> <span
                            class="nav-text">{{e2("Ürün Seç")}}</span></span></a></li>
            <li class="nav-item"><a href="{{url("admin?t=analizlerim")}}"
                    class="nav-link waves waves-effect"><span><i class="nav-icon fa fa-search"></i> <span
                            class="nav-text">{{e2("Analiz")}}</span></span></a></li>
            <li class="nav-item centerbutton">
                <div onclick="$(this).toggleClass('active');" class="nav-link"><span
                        class="theme-radial-gradient"><i class="close fas fa-plus"></i> <img
                            src="{{e2("logos/logo-white.svg")}}" alt="" class="nav-icon"></span>
                    <div class="nav-menu-popover justify-content-between">
                            <button onclick="location.href='#qrcode'" type="button"
                                class="btn btn-lg btn-icon-text"><i
                                    class="fa fa-qrcode size-32 loader"></i><span>{{e2("Karekod")}}</span></button>
                            <button  onclick="location.href='{{url("admin?t=sinavlarim")}}'" type="button" class="btn btn-lg btn-icon-text loader"><i
                                    class="fas fa-pen size-32"></i><span>{{e2("Sınavlarım")}}</span></button>
                            <button   onclick="location.href='{{url("admin?t=sonuclarim")}}'"  type="button" class="btn btn-lg btn-icon-text loader"><i
                                    class="fa fa-chart-pie size-32"></i><span>{{e2("Sonuçlarım")}}</span></button>
                            <button   onclick="location.href='{{url("admin?t=analizlerim")}}'" type="button" class="btn btn-lg btn-icon-text"><i
                                    class="fas fa-chart-line size-32 loader"></i><span>{{e2("Analizlerim")}}</span></button>
                </div>
            </li>
            
            <li class="nav-item"><a href="{{url("admin?t=todo")}}"
                    class="nav-link waves waves-effect"><span><i class="nav-icon fa fa-clipboard-check"></i> <span
                            class="nav-text">{{e2("Görevler")}}</span></span></a></li>
            <li class="nav-item"><a
                    
                    class="nav-link waves" data-toggle="layout" data-action="side_overlay_toggle"><span><i class="nav-icon fa fa-user"></i> <span
                            class="nav-text">{{e2("Profil")}}</span></span></a></li>
        </ul>
    </div>
</footer>
