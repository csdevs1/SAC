@if(Auth::user()->role->role_name=='ADMIN')
@extends('layouts.app')
@section('title','Asignar Permisos')
@section('content')
    @section('nav-title','Permisos')
    @section('icon','https')
    @include('layouts.nav')
    <input type="hidden" id="role_id" value="{{$role[0]['id']}}" >
    <main class="container z-depth-3 white lighten-5">
        <div class="row">
            <div>
                <h5 class="center-align">Perfil: {{$role[0]['role_name']}}</h5>
            </div>
        </div>
        <div class="row" style="padding: 10px;">
            <table>
                <thead>
                    <tr>
                        <th>Nombre Opcion</th>
                        <th>Ver</th>
                        <th>Crear</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Mas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($menu_options as $key=>$val){
                            $disabled='';
                            $menu_id='';
                            $menu_name='';
                            $css='';
                            $perm_btn_disabled='';
                            $submenu=$val['submenu'];
                            if(!isset($submenu[0]) && empty($submenu[0]))
                                $disabled='disabled';
                            else{
                                $css='submenu-btn';
                                $menu_id='data-menu-id='.$val['id'];
                                $menu_name='data-menu-name='.$val['name'];
                                $perm_btn_disabled='disabled';
                            }
                    ?>
                        <tr>
                            <td>{{$val['name']}}</td>
                            <?php
                                $permissions=$val['permission'];
                                $view='lighten-5';
                                $create='accent-1';
                                $update='lighten-4';
                                $delete='lighten-5';
                                foreach($permissions as $k=>$v){
                                    if($v['id_permission']==1)
                                        $view='lighten-2';
                                    elseif($v['id_permission']==2)
                                        $create='accent-3';
                                    elseif($v['id_permission']==3)
                                        $update='lighten-1';
                                    elseif($v['id_permission']==4)
                                        $delete='lighten-1';
                                }
                            ?>
                            <td><a class="btn-floating waves-effect waves-light blue-grey {{$view}} {{$perm_btn_disabled}} view" permission-id="1" menu-id="{{$val['id']}}" nav-type="menu"><i class="material-icons">visibility</i></a></td>
                            <td><a class="btn-floating waves-effect waves-light light-green {{$create}} {{$perm_btn_disabled}} insert" permission-id="2" menu-id="{{$val['id']}}" nav-type="menu"><i class="material-icons">add</i></a></td>
                            <td><a class="btn-floating waves-effect waves-light blue {{$update}} {{$perm_btn_disabled}} update" permission-id="3" menu-id="{{$val['id']}}" nav-type="menu"><i class="material-icons">mode_edit</i></a></td>
                            <td><a class="btn-floating waves-effect waves-light red {{$delete}} {{$perm_btn_disabled}} delete" permission-id="4" menu-id="{{$val['id']}}" nav-type="menu"><i class="material-icons">delete_sweep</i></a></td>

                            <td><a class="waves-effect waves-light btn modal-trigger {{$disabled}} {{$css}}" href="#modal_submenu" {{$menu_id}} {{$menu_name}}>Submenu</a></td>
                        </tr>                    
                    <?php } ?>
                    <!--<tr>
                        <td>Ticket</td>
                        <td><a class="btn-floating waves-effect waves-light blue-grey lighten-5 view"><i class="material-icons">visibility</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light light-green accent-1 insert"><i class="material-icons">add</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light blue lighten-4 update"><i class="material-icons">mode_edit</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light red lighten-5 delete"><i class="material-icons">delete_sweep</i></a></td>
                        <td><a class="waves-effect waves-light btn modal-trigger" href="#modal_submenu">Submenu</a></td>
                    </tr>
                    <tr>
                        <td>Administracion</td>
                        <td><a class="btn-floating waves-effect waves-light blue-grey lighten-5 view"><i class="material-icons">visibility</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light light-green accent-1 insert"><i class="material-icons">add</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light blue lighten-4 update"><i class="material-icons">mode_edit</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light red lighten-5 delete"><i class="material-icons">delete_sweep</i></a></td>
                        <td><a class="waves-effect waves-light btn disabled modal-trigger" href="">Submenu</a></td>
                    </tr>-->
                </tbody>
            </table>
        </div>
        
        <div id="modal_submenu" class="modal">
            <div class="modal-content">
                <h4>Menu: <span>Tickets</span></h4>
                <div class="row">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Ver</th>
                                <th>Crear</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-submenu">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
            </div>
        </div>
    </main>
@endsection
@section('script')
    @include('layouts.scripts')
    <script>
        // Material Select Initialization
        $(document).ready(function () {
            $('.modal').modal();
        });
        
        //Get submenu options
        var submenu = function(menu_id,id_role){
            return $.ajax({
                type: 'POST',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {menu_id:menu_id,id_role:id_role},
                url: '/api/submenu'
            });
        }
        $(document).on('click','.submenu-btn',function(){
            var menu_id=$(this).attr('data-menu-id'),
                menu_name=$(this).attr('data-menu-name'),
                id_role=$('#role_id').val(),
                rs=submenu(parseInt(menu_id),parseInt(id_role));
            rs.done(function(data){
                $('#tbody-submenu').html('');
                var html='';
                for(var i in data){
                    var submenu_id=data[i]['id'],
                        permissions=data[i]['permission'],
                        view='lighten-5',
                        create='accent-1',
                        update='lighten-4',
                        delete_perm='lighten-5';
                    for(i in permissions){
                        console.log(permissions[i]['id_permission']);
                        if(permissions[i]['id_permission']==1)
                            view='lighten-2';
                        else if(permissions[i]['id_permission']==2)
                            create='accent-3';
                        else if(permissions[i]['id_permission']==3)
                            update='lighten-1';
                        else if(permissions[i]['id_permission']==4)
                            delete_perm='lighten-1';
                    }
                    html+='<tr>';
                    html+='<td>'+data[i]['name']+'</td>';
                    html+='<td><a class="btn-floating waves-effect waves-light blue-grey '+view+' view" permission-id="1" nav-type="submenu" menu-id="'+menu_id+'" submenu-id="'+submenu_id+'"><i class="material-icons">visibility</i></a></td>';
                    html+='<td><a class="btn-floating waves-effect waves-light light-green '+create+' insert" permission-id="2" nav-type="submenu" menu-id="'+menu_id+'" submenu-id="'+submenu_id+'"><i class="material-icons">add</i></a></td>';
                    html+='<td><a class="btn-floating waves-effect waves-light blue '+update+' update" permission-id="3" nav-type="submenu" menu-id="'+menu_id+'" submenu-id="'+submenu_id+'"><i class="material-icons">mode_edit</i></a></td>';
                    html+='<td><a class="btn-floating waves-effect waves-light red '+delete_perm+' delete" permission-id="4" nav-type="submenu" menu-id="'+menu_id+'" submenu-id="'+submenu_id+'"><i class="material-icons">delete_sweep</i></a></td>';
                    html+='</tr>';
                }
                $('#tbody-modal_submenu h4 span').text(menu_name);
                $('#tbody-submenu').append(html);
            });            
        });
        //Get submenu options

        var role_permission = function(id_role,id_permission,id_menu,id_submenu,action){
            var json={};
            json['id_role']=id_role;
            json['id_permission']=id_permission;
            json['id_menu']=id_menu;
            if(id_submenu!='')
                json['id_submenu']=id_submenu;
            return $.ajax({
                type: 'POST',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: json,
                url: '/'+action+'/menu/permission'
            });
        }
        
        $(document).on('click','.view',function(){
            var id_menu=$(this).attr('menu-id'),
                id_permission=$(this).attr('permission-id'),
                nav=$(this).attr('nav-type'),
                id_submenu='',
                id_role=$('#role_id').val();
            if(nav=='submenu')
                id_submenu=$(this).attr('submenu-id');
            if($(this).hasClass('lighten-5')){
                $(this).removeClass('lighten-5');
                $(this).addClass('lighten-2');
                var insert_perm=role_permission(id_role,id_permission,id_menu,id_submenu,'create');
            }else{
                $(this).removeClass('lighten-2');
                $(this).addClass('lighten-5');
                var insert_perm=role_permission(id_role,id_permission,id_menu,id_submenu,'delete');
            }
        });

        $(document).on('click','.insert',function(){
            var id_menu=$(this).attr('menu-id'),
                id_permission=$(this).attr('permission-id'),
                nav=$(this).attr('nav-type'),
                id_submenu='',
                id_role=$('#role_id').val();
            if(nav=='submenu')
                id_submenu=$(this).attr('submenu-id');
            if($(this).hasClass('accent-1')){
                $(this).removeClass('accent-1');
                $(this).addClass('accent-3');
                var insert_perm=role_permission(id_role,id_permission,id_menu,id_submenu,'create');
            }else{
                $(this).removeClass('accent-3');
                $(this).addClass('accent-1');
                var insert_perm=role_permission(id_role,id_permission,id_menu,id_submenu,'delete');
            }
        });
        $(document).on('click','.update',function(){
            var id_menu=$(this).attr('menu-id'),
                id_permission=$(this).attr('permission-id'),
                nav=$(this).attr('nav-type'),
                id_submenu='',
                id_role=$('#role_id').val();
            if(nav=='submenu')
                id_submenu=$(this).attr('submenu-id');
            if($(this).hasClass('lighten-4')){
                $(this).removeClass('lighten-4');
                $(this).addClass('lighten-1');
                var insert_perm=role_permission(id_role,id_permission,id_menu,id_submenu,'create');
            }else{
                $(this).addClass('lighten-4');
                $(this).removeClass('lighten-1');
                var insert_perm=role_permission(id_role,id_permission,id_menu,id_submenu,'delete');
            }
        });
        $(document).on('click','.delete',function(){
            var id_menu=$(this).attr('menu-id'),
                id_permission=$(this).attr('permission-id'),
                nav=$(this).attr('nav-type'),
                id_submenu='',
                id_role=$('#role_id').val();
            if(nav=='submenu')
                id_submenu=$(this).attr('submenu-id');
            if($(this).hasClass('lighten-5')){
                $(this).removeClass('lighten-5');
                $(this).addClass('lighten-1');
                var insert_perm=role_permission(id_role,id_permission,id_menu,id_submenu,'create');
            }else{
                $(this).addClass('lighten-5');
                $(this).removeClass('lighten-1');
                var insert_perm=role_permission(id_role,id_permission,id_menu,id_submenu,'delete');
            }
        });
    </script>
@endsection
@else
    <h3>No tiene los permisos necesarios</h3>
@endif
