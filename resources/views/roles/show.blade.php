@if(Auth::user()->role->role_name=='ADMIN')
@extends('layouts.app')
@section('title','Perfiles')
@section('content')
    @section('nav-title','Perfiles')
    @section('icon','recent_actors')
    @include('layouts.nav')

    <main class="container z-depth-3 white lighten-5">
        <div class="row">
            <?php
                foreach($roles as $key=>$val){
            ?>
            <div class="col s12 m4">
                <div class="card grey lighten-4">
                    <div class="card-content black-text">
                        <span class="card-title">{{$val['role_name']}}</span>
                        <?php if(isset($val['permission'][0]) && !empty($val['permission'])){ ?>
                            <ul class="perms-list">
                                <?php
                                    $permissions=$val['permission'];
                                    foreach($permissions as $k=>$permission){
                                        switch($permission['id_permission']){
                                            case 1:
                                ?>
                                                <li><a class="btn-floating waves-effect waves-light blue-grey lighten-2" title="view"><i class="material-icons">visibility</i></a></li>
                                <?php
                                                break;
                                            case 2:
                                 ?>
                                                <li><a class="btn-floating waves-effect waves-light light-green accent-3" title="create"><i class="material-icons">add</i></a></li>
                                <?php
                                                break;
                                            case 3:
                                ?>
                                                <li><a class="btn-floating waves-effect waves-light blue lighten-1" title="update"><i class="material-icons">mode_edit</i></a></li>
                                <?php
                                                break;
                                            case 4:
                                ?>
                                                <li><a class="btn-floating waves-effect waves-light red lighten-1" title="delete"><i class="material-icons">delete_sweep</i></a></li>
                                <?php
                                                break;
                                        }
                                    }
                                ?>
                            </ul>
                        <?php }else echo '<p style="color: #777;text-shadow: 1px 1px 1px #ccc;">Este perfil no tiene permisos asignados.</p>'; ?>
                    </div>
                    <div class="card-action">
                        <a href="/add/permissions/{{$val['id']}}">Permisos</a>
                        <a href="#">Eliminar</a>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </main>
@endsection
@section('script')
    @include('layouts.scripts')
    <script>
    </script>
@endsection
@else
    <h3>No tiene los permisos necesarios</h3>
@endif
