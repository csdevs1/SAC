<!--Main Navigation-->
<?php
    $menu=new MainMenu();
    $menu=new MainMenu();
    $options=$menu->menu_options();
    $profile='/images/profiles/'.Auth::user()->profile_pic;
?>
<header>
    <ul id="slide-out" class="side-nav">
        <li><div class="user-view">
            <div class="background">
                <img src="/images/profile_bg.jpg">
            </div>
            <a href="#!user"><img class="circle" src="<?php echo $profile; ?>"></a>
            <a href="#!name"><span class="name">{{ Auth::user()->name }}</span></a>
            <a href="#!email"><span class="email">{{ Auth::user()->username }} ({{ Auth::user()->role->role_name }})</span></a>
            </div>
        </li>
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <?php
        foreach($options as $key=>$val){
            $submenu=$val['submenu'];
            if(!isset($submenu[0]) && empty($submenu[0])){
        ?>
            <li><a href="<?php echo $val['url']; ?>"><i class="material-icons">{{$val['icon']}}</i> {{$val['name']}}</a></li>
        <?php
            }else{
        ?>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">{{$val['name']}} <i class="material-icons">{{$val['icon']}}</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <?php foreach($submenu as $k=>$v){ ?>
                                    <li><a href="<?php echo $v->url; ?>"><i class="material-icons">{{$v->icon}}</i> {{$v->name}}</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
        <?php
            }
        }
        ?>
        @if(Auth::user()->role->role_name=='ADMIN')
        <li><a href="/roles"><i class="material-icons">error_outline</i> Administraci&#243;n de perfiles</a></li>
        @endif
        <!--
        <li><a href="#!"><i class="material-icons">content_paste</i> Administraci&#243;n</a></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header">Tickets <i class="material-icons">keyboard_arrow_down</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="#!"><i class="material-icons">headset_mic</i> Ticket Soporte</a></li>
                            <li><a href="#!"><i class="material-icons">folder</i> Reporte Ticket</a></li>
                            <li><a href="#!"><i class="material-icons">pie_chart</i> Resumen Gr&#225;fica Ticket</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li><a href="#!"><i class="material-icons">devices</i> Gesti&#243;n</a></li>
        -->
        
        
        <li><div class="divider"></div></li>
        <li><a class="waves-effect" href="#!"><i class="material-icons">account_circle</i> Perfil</a></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="waves-effect" href="#!">Cerrar Sesi&#243;n</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </ul>
    <nav class="white darken-1">
        <div class="nav-wrapper">
            <a href="#" data-activates="slide-out" class="button-collapse" style="display: inline;"><i class="material-icons">menu</i></a>
            <a href="#!" class="brand-logo"><i class="material-icons">@yield('icon')</i> @yield('nav-title')</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="sass.html"><i class="material-icons">search</i></a></li>
                <li><a href="badges.html"><i class="material-icons">view_module</i></a></li>
                <li><a href="collapsible.html"><i class="material-icons">refresh</i></a></li>
                <li><a href="mobile.html"><i class="material-icons">more_vert</i></a></li>
            </ul>
        </div>
    </nav>
</header>
<!--Main Navigation-->
