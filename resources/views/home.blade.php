@extends('layouts.app')
@section('title','Sistema de Tickets')
@section('content')
    @section('nav-title','SAC')
    @section('icon','perm_phone_msg')
    @include('layouts.nav')
<div class="container white z-depth-2" style="margin-top:25px;padding:10px;">
    <div class="row">
        <!--<div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>-->
        <div class="col s12 m6 stats">
            <div class="col s4 teal lighten-3 z-depth-2">
                <i class="material-icons">people</i>
            </div>
            <div class="col s8 teal lighten-2 z-depth-2">
                <span>Total usuarios:</span>
                <p class="stats-number">{{$users}}</p>
                <a href="#modal1" class="modal-trigger load-users">Ver mas <i class="material-icons">visibility</i></a>
            </div>
        </div>
        <div class="col s12 m6 stats">
            <div class="col s4 red lighten-1 z-depth-2">
                <i class="material-icons">build</i>
            </div>
            <div class="col s8 red z-depth-2">
                <span>Total Tecnicos:</span>
                <p class="stats-number">{{$technicians}}</p>
                <a href="#modal1" class="modal-trigger load-technicians">Ver mas <i class="material-icons">visibility</i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m6 stats">
            <div class="col s4 indigo lighten-1 z-depth-2">
                <i class="material-icons">library_books</i>
            </div>
            <div class="col s8 indigo z-depth-2">
                <span>Total tickets:</span>
                <p class="stats-number">{{$tickets}}</p>
                <a href="#modal3" class="ticket-stats open_tickets modal-trigger">
                    <i class="material-icons">lock_open</i> Abiertos: {{$open_tickets}}
                </a>
                <span class="pipe">|</span>
                <a href="#modal3" class="ticket-stats closed_tickets modal-trigger">
                    <i class="material-icons">lock</i> Cerrados: {{$closed_tickets}}
                </a>
            </div>
        </div>
        <div class="col s12 m6 stats">
            <div class="col s4 light-green lighten-3 z-depth-2">
                <i class="material-icons">business</i>
            </div>
            <div class="col s8 light-green z-depth-2">
                <span>Total Compa&#241;&#205;as:</span>
                <p class="stats-number">{{$companies}}</p>
                <a class="load-companies modal-trigger" href="#modal4">Ver mas <i class="material-icons">visibility</i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="col s12 grey darken-3 z-depth-2">
                
                <div class="row">
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="/images/support.jpg" class="">
                                <a href="/support/tickets"><span class="card-title">Ticket Soporte</span></a>
                            </div>
                            <div class="card-content">
                                <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
                            </div>
                            <div class="card-action">
                                <a href="#">This is a link</a>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="/images/report.jpg" class="">
                                <a href="/reporte"><span class="card-title">Reporte Ticket</span></a>
                            </div>
                            <div class="card-content">
                                <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
                            </div>
                            <div class="card-action">
                                <a href="#">This is a link</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div id="modal1" class="modal bottom-sheet">
        <div class="modal-content">
            <h4 class="title-modal1">Modal Header</h4>
            <ul class="collection data-list">

            </ul>
        </div>
    </div>

    <div id="modal2" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <div class="row fill-in">

            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat light-green accent-2 save_edit">Guardar</a>
            </div>
        </div>
    </div>

    <div id="modal3" class="modal" style="width:85%">
        <div class="modal-content">
            <table class="striped centered">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Compa&#241;&#237;a</th>
                        <th>Fec. Modif.</th>
                        <th>T&#237;tulo</th>
                        <th>Prioridad</th>
                        <th>Reportado Por</th>
                        <th>D&#237;as Pendientes</th>
                    </tr>
                </thead>
                <tbody id="pending-container">
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
    </div>

    <div id="modal4" class="modal" >
        <div class="modal-content">
            <table class="striped centered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>No Empleados</th>
                        <th>Acci&#243;n</th>
                    </tr>
                </thead>
                <tbody id="companies-list">
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
    </div>

</div>

    <!-- ======================================================= -->
    <!--                        TICKET INFO                      -->
    <!-- ======================================================= -->
        <section id="ticket-info">
            <div class="container">
                <div class="row" style="margin-top: 10px;">
                    <div class="col s2"><a class="btn btn-floating z-depth-3 red lighten-1" id="close"><i class="material-icons">clear</i></a></div>
                    <div class="col s8"><h5 class="center-align">Ticket No: <span class="tck-id"></span></h5></div>
                </div>
                <div class="row">
                    <div class="col s12" style="padding:0;">
                        <ul class="tabs tabs-fixed-width">
                            <li class="tab col s2"><a class="active" href="#ticket_d">Datos Ticket</a></li>
                            <li class="tab col s2"><a href="#t_contact">Contacto</a></li>
                            <li class="tab col s2"><a href="#checklist">Checklist</a></li>
                            <li class="tab col s2"><a href="#uploads">Adjuntos</a></li>
                            <li class="tab col s2"><a href="#services">Servicios</a></li>
                        </ul>
                    </div>
                    <div id="ticket_d" class="col s12 ticket-content">
                        <input type="hidden" id="t_id" value="">
                        <div class="row ticket-info center-align">
                            <div class="col s4">
                                <label>Titulo: </label><span class="tck-title"></span>
                            </div>
                            <div class="col s4">
                                <label>Prioridad: </label><span class="tck-priority"></span>
                            </div>
                            <div class="col s4">
                                <label>Estado: </label><span class="tck-status"></span>
                            </div>
                        </div>
                        <div class="row ticket-info center-align">
                            <div class="col s4">
                                <label>Reportado por: </label><span class="tck-reported"></span>
                            </div>
                            <div class="col s4">
                                <label>Atendido por: </label><span class="tck-attended"></span>
                            </div>
                            <div class="col s4">
                                <label>Origen: </label><span class="tck-device"></span>
                            </div>
                        </div>
                        <div class="row ticket-info center-align">
                            <div class="col s4">
                                <label>Patente: </label><span class="tck-plate"></span>
                            </div>
                            <div class="col s4">
                                <label>Compa&#241;&#237;a: </label><span class="tck-company"></span>
                            </div>
                            <div class="col s4">
                                <label>Grupo: </label><span class="tck-group"></span>
                            </div>
                        </div>
                        <div class="row ticket-info center-align">
                            <div class="col s6">
                                <label>Detalle: </label>
                                <p class="tck-detail"></p>
                            </div>
                            <div class="col s6">
                                <label>Solucion: </label>
                                <p class="tck-solution"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <p id="edit_containter"><a class="btn btn-floating pulse"><i class="material-icons">border_color</i></a> Editar</p>
                            </div>
                        </div>
                    </div>

                    <div id="t_contact" class="col s12 ticket-content">Test 2</div>
                    <div id="checklist" class="col s12 ticket-content">
                        <div class="page">
                            <div class="content">
                                <div class="header">
                                    <div class="title"><span class="name">Checklist </span></div>
                                    <div class="functions">
                                        <div class="add save_checklist">
                                            <div class="icon"> <i class="fa fa-plus"></i></div><span>Guardar</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dataTable checklistTable">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="selectAll"> <i class="fa fa-square-o"></i></th>
                                                <th>Descripcion</th>
                                                <th>Observacion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="uploads" class="col s12 ticket-content">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>File</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                    <div id="services" class="col s12 ticket-content">
                        <div class="col s6" id="supplies">
                            <div class="page">
                                <div class="content">
                                    <div class="header">
                                        <div class="title"><span class="name">Insumos </span></div>
                                        <div class="functions">
                                            <div class="add save_maintenance" service-type="mantencion">
                                                <div class="icon"> <i class="fa fa-plus"></i></div><span>Guardar</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dataTable maintenanceTable">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Descripcion</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s6" id="services" service-type="servicio">
                            <div class="page">
                                <div class="content">
                                    <div class="header">
                                        <div class="title"><span class="name">Servicios </span></div>
                                        <div class="functions">
                                            <div class="add save_service">
                                                <div class="icon"> <i class="fa fa-plus"></i></div><span>Guardar</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dataTable servicesTable">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Descripcion</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


@endsection
@section('script')
    @include('layouts.scripts')
    <script>
        $(document).ready(function(){
            $('.modal').modal();
            $('select').material_select();
            $('#ticket-info .container').hide();
            $('ul.tabs').tabs();
        });
        var get_info = function(path){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/get/'+path+'/'
            });
        }
        /*==============================================================
                                    USERS
          ==============================================================*/

        $(document).on('click','.load-users',function(){
            var u=get_info('users');
            u.done(function(users){
                console.log(users);
                $('.data-list').html('');
                var html='';
                $('.title-modal1').text('Usuarios');
                for(i in users){
                    var user=users[i],
                        role=user['role'],
                        profile='/images/profiles/'+user['profile_pic'];
                    console.log(role);
                    html+='<li class="collection-item avatar">';
                    html+='<img src="'+profile+'" alt="" class="circle">';
                    html+='<span class="title">'+user['name']+'</span>';
                    html+='<p class="uname">'+user['username']+'</p>';
                    html+='<small class="role">('+role['role_name']+')</small>';
                    html+='<a href="#modal2" class="secondary-content modal-trigger edit-user" user-id="'+user['id']+'"><i class="material-icons">&#xE254;</i> Editar</a>';
                    html+='</li>';
                }
                $('.data-list').html(html);
            });
        });

        var get_all = function(id,path){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/get/'+path,
                data:{id:id}
            });
        }

        $(document).on('click','.edit-user',function(){
            var user_id=$(this).attr('user-id'),
                u=get_all(user_id,'user');
            var form='<form class="col s12"><input type="hidden" id="user_id" value="'+user_id+'"><div class="row"><div class="input-field col s4"><input id="first_name" type="text" class="validate"><label for="first_name">Nombre</label></div><div class="input-field col s4"><input id="password" type="password" class="validate"><label for="password">Contrase&#241;a</label></div><div class="input-field col s4"><input id="username" type="text" class="validate"><label for="username">Nombre de Usuario</label></div></div><div class="row"><div class="input-field col s6"><input id="email" type="email" class="validate"><label for="email">Email</label></div><div class="input-field col s6"><select id="user_role"></select><label>Rol</label></div></div></form>';

            if($('.save_edit').hasClass('edit_technician'))
                $('.save_edit').removeClass('edit_technician');

            u.done(function(user){
                $('.save_edit').addClass('edit_user');
                if(Object.keys(user).length>0){
                    $('.fill-in').html(form);

                    $('#modal2 h4').text('Editar: '+user['name']);
                    $('#first_name').val(user['name']).addClass('active valid').next().addClass('active');
                    $('#username').val(user['username']).addClass('active valid').next().addClass('active');
                    $('#email').val(user['email']).addClass('active valid').next().addClass('active');

                    var r=get_info('roles'),
                        role_id=user['role']['id'];
                    r.done(function(roles){
                        if(Object.keys(roles).length > 0){
                            $('#user_role').html('');
                            $('#user_role').append($('<option>', {
                                value: '',
                                text: '-- Seleccionar Perfil --'
                            }));
                            for(var i in roles){
                                $('#user_role').append($('<option>', {
                                    value: roles[i]['id'],
                                    text: roles[i]['role_name']
                                }));
                            }
                            if(role_id!='')
                                $('#user_role option[value='+role_id+']').attr('selected','selected').addClass('active valid').next().addClass('active');
                            $('#user_role').material_select();
                        }
                    });
                }
            });
        });

        var create_data = function(arr,path,action='create',id=''){
            var formData = new FormData();
            formData.append("arr", JSON.stringify(arr));
            if(id!="")
                formData.append("id", id);
            return $.ajax({
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                url: '/'+action+'/'+path
            });
        }

        $(document).on('click','.edit_user',function(){
            var user_id=$('#user_id').val(),
                user_name=$('#first_name').val(),
                password=$('#password').val(),
                username=$('#username').val(),
                email=$('#email').val(),
                role=$('#user_role').val(),
                arr={};
            if(user_name!='') arr['name']=user_name;
            if(password!='') arr['password']=password;
            if(username!='') arr['username']=username;
            if(email!='') arr['email']=email;
            if(role!='') arr['role_id']=role;

            if(Object.keys(arr).length>0){
                var u=create_data(arr,'user','edit',user_id);
                u.done(function(d){
                    if(d)
                        swal("Bacan!" ,  "Cambios guardados exitosamente!" ,  "success" );
                });
            }
        });

        /*==============================================================
                                TECHNICIANS
          ==============================================================*/
        $(document).on('click','.load-technicians',function(){
            var t=get_info('technicians');
            t.done(function(technicians){
                console.log(technicians);
                $('.data-list').html('');
                var html='';
                $('.title-modal1').text('Tecnicos Sac');
                for(i in technicians){
                    var sac=technicians[i];
                    html+='<li class="collection-item avatar">';
                    html+='<span class="title">'+sac['name']+'</span>';
                    html+='<br><small class="role">ID: '+sac['id']+'</small>';
                    html+='<a href="#modal2" class="secondary-content modal-trigger edit-sac" sac-id="'+sac['id']+'"><i class="material-icons">&#xE254;</i> Editar</a>';
                    html+='</li>';
                }
                $('.data-list').html(html);
            });
        });

        $(document).on('click','.edit-sac',function(){
            var sac_id=$(this).attr('sac-id'),
                u=get_all(sac_id,'sac');
            var form='<form class="col s12"><input type="hidden" id="sac_id" value="'+sac_id+'"><div class="row"><div class="input-field col s12"><input id="sac_name" type="text" class="validate"><label for="sac_name">Nombre</label></div></div></form>';

            if($('.save_edit').hasClass('edit_user'))
                $('.save_edit').removeClass('edit_user');
            u.done(function(sac){
                    $('.save_edit').addClass('edit_technician');
                if(Object.keys(sac).length>0){
                    $('.fill-in').html(form);

                    $('#modal2 h4').text('Editar: '+sac['name']);
                    $('#sac_name').val(sac['name']).addClass('active valid').next().addClass('active');
                }
            });
        });

        $(document).on('click','.edit_technician',function(){
            var tech_id=$('#sac_id').val(),
                tech_name=$('#sac_name').val(),
                arr={};
            if(tech_name!='') arr['name']=tech_name;

            if(Object.keys(arr).length>0){
                var s=create_data(arr,'sac','edit',tech_id);
                s.done(function(d){
                    if(d)
                        swal("Bacan!" ,  "Cambios guardados exitosamente!" ,  "success" );
                });
            }
        });

        /*==============================================================
                                    TICKETS
          ==============================================================*/

        var get_data = function(company_id,type){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {company_id:company_id},
                url: '/get/company/'+type
            });
        }
        var get_employee = function(employee_id){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {employee_id:employee_id},
                url: '/get/employee'
            });
        }
        var get_group = function(company_id){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {company_id:company_id},
                url: '/get/company/groups'
            });
        }
        var get_carriers = function(company_group_id){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {company_group_id:company_group_id},
                url: '/get/group/carriers'
            });
        }

        var get_ticket = function(ticket_id){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {ticket_id:ticket_id},
                url: '/get/ticket/'
            });
        }
        var get_checklist = function(device_id,ticket_id){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {device_id:device_id,ticket_id:ticket_id},
                url: '/get/checklist/'
            });
        }
        var get_services = function(device_id,ticket_id,type){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                //processData: false,
                //contentType:  false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {device_id:device_id,ticket_id:ticket_id,type},
                url: '/get/ticket/service'
            });
        }
        var build_ticket_info=function(r,tck_id){
            $('#ticket-info .container').fadeIn('slow');
            $('.tck-id').text(tck_id);
            $('#t_id').val(tck_id);
            $('#edit_containter').attr('tck_id',tck_id);
            var company=r['companyGroup']['company']['name'],
                group=r['companyGroup']['group']['name'],
                tck_title=r['title'],
                tck_priority=r['ticket_priority']['priority'],
                priority_icon=r['ticket_priority']['icon'],
                tck_status=r['status']['status'],
                tck_icon=r['status']['icon'],
                reported_by=r['reported_by']['name'],
                attended_by=r['support_sac']['name'],
                plate=r['vehicle']['plate'],
                device=r['device']['name'],
                detail=r['detail'],
                solution=r['solution'];
            $('.tck-title').text(tck_title);
            $('.tck-priority').html('<i class="material-icons priority-icon">'+priority_icon+'</i>'+tck_priority);
            $('.tck-status').html('<i class="material-icons">'+tck_icon+'</i>'+tck_status);
            $('.tck-reported').html(reported_by);
            $('.tck-attended').html(attended_by);
            $('.tck-company').html(company);
            $('.tck-plate').html(plate);
            $('.tck-device').html(device);
            $('.tck-group').html(group);
            $('.tck-detail').html(detail);
            $('.tck-solution').html(solution);
        }

        var build_service_table=function(type,css,tck_id,device_id){
            var service=get_services(device_id,tck_id,type);
            service.done(function(data){
                console.log(data);
                $(css+' table tbody').html('');
                if(Object.keys(data).length>0){
                    var html='';
                    for(var i in data){
                        var cant=data[i]['cant']?data[i]['cant']:'';
                        html+='<tr data-id="'+data[i]['id']+'">';
                        html+='<td class="service_item">'+data[i]['name']+'</td>';
                        html+='<td><input type="number" value="'+cant+'" quantity="'+cant+'" class="service-cant cant-'+data[i]['id']+'" data-id="'+data[i]['id']+'"></td>';
                        html+='</tr>';
                    }
                    $(css+' table tbody').append(html);
                }else
                $(css+' table tbody').append('<tr><td>No hay Servicios asociado al tipo de Dispositivo de Origen.</td></tr>');
            });
        }
        $(document).on('click','.tck',function(){
            $('ul.tabs').tabs('select_tab', 'ticket_d');
            $('#ticket-info').fadeIn('slow');
            $('#modal3').modal('close');
            var tck_id=$(this).attr('tck-id'),
                t=get_ticket(tck_id);
            t.done(function(r){
                build_ticket_info(r,tck_id);
                var chck=get_checklist(r['device']['id'],tck_id);

                build_service_table('servicio','.servicesTable',tck_id,r['device']['id']);
                build_service_table('mantencion','.maintenanceTable',tck_id,r['device']['id']);

                chck.done(function(data){
                    console.log(data);
                    $('.checklistTable table tbody').html('');
                    if(Object.keys(data).length>0){
                        var html='';
                        for(var i in data){
                            var css=data[i]['checked']?'selected':'',
                                observation=data[i]['observation']?data[i]['observation']:'';
                            html+='<tr data-id="'+data[i]['id']+'" class="'+css+'">';
                            html+='<td class="checklist_item"><i class="checkbox fa fa-square-o"></i></td>';
                            html+='<td class="checklist_item">'+data[i]['name']+'</td>';
                            html+='<td><input type="text" value="'+observation+'" class="checklist-obs observation-'+data[i]['id']+'"></td>';
                            html+='</tr>';
                        }
                        $('.checklistTable table tbody').append(html);
                    }else
                        $('.checklistTable table tbody').append('<tr><td>No hay checklist asociado al tipo de Dispositivo de Origen.</td></tr>');
                });
            });
        });

        // ==================================================== //

        var get_tickets = function(status){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/get/status/ticket',
                data:{status:status}
            });
        }

        $(document).on('click','.open_tickets',function(){
            var p=get_tickets(true);
            p.done(function(r){
                $('#pending-container').html('');
                $('#modal3 table').fadeIn('slow');
                for(var i in r){
                    var html='<tr class="tck" tck-id="'+r[i]['id']+'">',
                        maxLength=20,
                        dots='';
                    if(r[i]['title'].length > maxLength)
                        dots='...';
                    title=r[i]['title'].substring(0, maxLength) + dots;
                    html+='<td>'+r[i]['id']+'</td>';
                    html+='<td>'+r[i]['company']+'</td>';
                    html+='<td>'+r[i]['created_at']+'</td>';
                    html+='<td class="truncate">'+r[i]['title']+'</td>';
                    html+='<td>'+r[i]['priority']+'</td>';
                    html+='<td>'+r[i]['reported_by']+'</td>';
                    html+='<td>'+r[i]['days_diff']+'</td>';
                    html+='</tr>';
                    $('#pending-container').append(html);
                }
            });
        });
        $(document).on('click','.closed_tickets',function(){
            var p=get_tickets(false);
            p.done(function(r){
                $('#pending-container').html('');
                $('#modal3 table').fadeIn('slow');
                for(var i in r){
                    var html='<tr class="tck" tck-id="'+r[i]['id']+'">',
                        maxLength=20,
                        dots='';
                    if(r[i]['title'].length > maxLength)
                        dots='...';
                    title=r[i]['title'].substring(0, maxLength) + dots;
                    html+='<td>'+r[i]['id']+'</td>';
                    html+='<td>'+r[i]['company']+'</td>';
                    html+='<td>'+r[i]['created_at']+'</td>';
                    html+='<td class="truncate">'+r[i]['title']+'</td>';
                    html+='<td>'+r[i]['priority']+'</td>';
                    html+='<td>'+r[i]['reported_by']+'</td>';
                    html+='<td>'+r[i]['days_diff']+'</td>';
                    html+='</tr>';
                    $('#pending-container').append(html);
                }
            });
        });

        $('#close').on('click',function(){
            $('#ticket-info').fadeOut('slow');
            $('#modal3').modal('open');
        });
            //===========================================================//
            //                         CHECKLIST                         //
            //===========================================================//
            var set_checklist = function(checked,tck_id){
                var formData = new FormData();
                formData.append("checklist_data", JSON.stringify(checked));
                formData.append("tck_id", tck_id);
                return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType:  false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    url: '/create/checklist'
                });
            }

            $(document).on('click','.checklist_item',function(){
                if($(this).parent().hasClass('selected'))
                    $(this).parent().removeClass('selected');
                else
                    $(this).parent().addClass('selected');
            });
            $(document).on('click','.save_checklist',function(){
                var tck_id=$('#t_id').val(),
                    checked=[];
                $('.checklistTable .selected').each(function(i, obj) {
                    var item_id=$(this).attr('data-id'),
                        observation=$('.observation-'+item_id).val(),
                        obj={checklist_id:item_id,observation:observation,ticket_id:tck_id};
                    checked.push(obj);
                });
                var ck=set_checklist(checked,tck_id);
                ck.done(function(d){
                    if(d)
                        swal("Bacan!" ,  "Cambios guardados exitosamente!" ,  "success" );
                });
            });

            //===========================================================//
            //                         SERVICES                          //
            //===========================================================//
            var set_service = function(serivces,tck_id,service_id){
                var formData = new FormData();
                formData.append("services", JSON.stringify(serivces));
                formData.append("tck_id", tck_id);
                formData.append("service_id", service_id);
                return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType:  false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    url: '/create/service'
                });
            }
            $(document).on('click','.save_service',function(){
                var tck_id=$('#t_id').val();
                $('.servicesTable .service-cant').each(function(i, obj) {
                    if($(this).val()!=''){
                        var item_id=$(this).attr('data-id'),
                            cant=$('.cant-'+item_id).val(),
                            obj={service_id:item_id,cant:cant,ticket_id:tck_id};
                        var sv=set_service(obj,tck_id,item_id);
                        sv.done(function(d){
                            if(d)
                                swal("Bacan!" ,  "Cambios guardados exitosamente!" ,  "success" );
                        });
                    }
                });
            });

            $(document).on('click','.save_maintenance',function(){
                var tck_id=$('#t_id').val();
                $('.maintenanceTable .service-cant').each(function(i, obj) {
                    if($(this).val()!=''){
                        var item_id=$(this).attr('data-id'),
                            cant=$('.cant-'+item_id).val(),
                            obj={service_id:item_id,cant:cant,ticket_id:tck_id};
                        var sv=set_service(obj,tck_id,item_id);
                        sv.done(function(d){
                            if(d)
                                swal("Bacan!" ,  "Cambios guardados exitosamente!" ,  "success" );
                        });
                    }
                });
            });


        /*==============================================================
                                    Companies
          ==============================================================*/
        $(document).on('click','.load-companies',function(){
            var c = get_info('companies');
            c.done(function(companies){
                $('#companies-list').html('');
                $('#modal4 table').fadeIn('slow');
                for(var i in companies){
                    var html='<tr company-id="'+companies[i]['id']+'">';
                    html+='<td><img class="responsive-img" style="max-width:35px;" src="/images/'+companies[i]['logo']+'" ></td>';
                    html+='<td>'+companies[i]['name']+'</td>';
                    html+='<td>'+companies[i]['phone']+'</td>';
                    html+='<td>'+companies[i]['n_employees']+'</td>';
                    html+='<td></td>';
                    html+='</tr>';
                    $('#companies-list').append(html);
                }
            });
        });
    </script>
    <script src="/js/Tickets/update_ticket.js"></script>
@endsection
