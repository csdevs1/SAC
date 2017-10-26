@if(Auth::user()->role->role_name=='ADMIN')
@extends('layouts.app')
@section('title','Tickets')
@section('content')
    @section('nav-title','Ticket Soporte')
    @section('icon','headset_mic')
    @include('layouts.nav')
    <!--Main layout-->
        <main class="z-depth-3 white lighten-5">
            <div class="row">
                <form class="col s12">
                    <h3 class="title-ticket">Datos Reporte</h3>
                    <div class="row" style="margin-bottom:0;">
                        <div class="input-field col s12">
                            <select class="icons" id="company" name="company">
                                <option value="" disabled selected>-- Seleccionar --</option>
                                <?php
                                    foreach($companies as $key=>$company){
                                        $company_logo='/images/'.$company->logo;
                                ?>
                                <option value="{{$company->id}}" data-icon="{{$company_logo}}" class="circle">{{$company->name}}</option>
                                <?php } ?>
                            </select>
                            <label>Compañ&#205;a</label>
                        </div>
                    </div> 
                    
                    <div class="row" style="margin-bottom:0;">
                        <div class="input-field col s4">
                            <input id="title" type="text" class="validate" disabled>
                            <label for="title">Titulo</label>
                        </div>
                        <div class="input-field col s4">
                            <select disabled id="priority">
                                <option value="" disabled selected>-- Seleccionar Prioridad --</option>
                                <option value="1">Baja</option>
                                <option value="2">Media</option>
                                <option value="3">Alta</option>
                            </select>
                            <label>Prioridad</label>
                        </div>
                        <div class="input-field col s4">
                            <select class="icons" id="status" disabled>
                                <option value="" disabled selected>-- Seleccionar Estado --</option>
                                <option value="1" class="circle">Abierto</option>
                                <option value="0" class="circle">Cerrado</option>
                            </select>
                            <label>Estado</label>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom:0;">
                        <div class="input-field col s4">
                            <select class="icons" id="tck_type" disabled>
                                <option value="" disabled selected>-- Seleccionar Tipo --</option>
                                <?php foreach($ticket_types as $key=>$type){ ?>
                                <option value="{{$type->id}}" class="circle">{{$type->name}}</option>
                                <?php } ?>
                            </select>
                            <label>Tipo</label>
                        </div>
                        <div class="input-field col s4">
                            <select class="icons" disabled id="groups" name="groups">
                                <option value="" disabled selected>-- Seleccionar --</option>
                            </select>
                            <label>Grupo</label>
                        </div>
                        <div class="input-field col s4">
                            <select class="icons" disabled id="carriers" name="carriers">
                                <option value="" disabled selected>-- Seleccionar --</option>
                            </select>
                            <label>Transportista</label>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:0;">
                        <div class="input-field col s4">
                            <select class="icons" disabled id="reported_by" name="reported_by">
                                <option value="" disabled selected>-- Seleccionar --</option>
                            </select>
                            <label>Reportado por</label>
                        </div>
                        <div class="input-field col s4">
                            <select class="icons" disabled id="attended_by" name="attended_by">
                                <option value="" disabled selected>-- Seleccionar --</option>
                                <?php foreach($tsac as $key=>$tec){ ?>
                                <option value="{{$tec->id}}" class="circle">{{$tec->name}}</option>
                                <?php } ?>
                            </select>
                            <label>Atendido Por</label>
                        </div>
                        <div class="input-field col s4">
                            <select class="icons" id="devices" name="devices" disabled>
                                <option value="" disabled selected>-- Seleccionar --</option>
                                <?php
                                    foreach($devices as $key=>$device){
                                ?>
                                <option value="{{$device->id}}" class="circle">{{$device->name}}</option>
                                <?php } ?>
                            </select>
                            <label>Origen</label>
                        </div>
                    </div>
                  <!--  <div class="row" style="margin-bottom:0;">
                        <div class="input-field col s6">
                            <input id="reported_position" type="text" class="validate" disabled>
                            <label for="reported_position">Cargo</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="reported_phone" type="tel" class="validate" disabled>
                            <label for="reported_phone">Telefono</label>
                        </div>
                    </div>-->

                    <div class="row" style="margin-bottom:0;">
                        <!--<div class="input-field col s6">
                            <input id="reported_email" type="email" class="validate" disabled>
                            <label for="reported_email">E-mail</label>
                        </div>-->


                    </div>
                    <div class="row" style="margin-bottom:0;">
                        <div class="input-field col s12">
                            <select disabled id="plates" name="plates">
                                <option value="" disabled selected>-- Seleccionar Patente --</option>
                            </select>
                            <label>Patente</label>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom:0;">
                        <div class="input-field col s12 m6">
                            <textarea id="report" class="materialize-textarea" data-length="255" disabled></textarea>
                            <label for="textarea1">Detalle</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <textarea id="solution" class="materialize-textarea" data-length="255" disabled></textarea>
                            <label for="textarea1">Solucion</label>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom:0;">
                        <div class="col s6">
                            <a class="waves-effect waves-light btn light-green accent-2 disabled" id="save">Guardar</a>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <!-- Modal Trigger -->
            <div class="row">
                <div class="col s6">
                    <a class="waves-effect waves-light btn modal-trigger" id="pending" href="#modal1">Pendientes</a>
                </div>
            </div>
            <!-- Modal Structure -->
            <div id="modal1" class="modal" style="width:85%">
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
        </main>
        <!--Main layout-->
        
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

        <div id="edit_modal" class="modal modal-fixed-footer" style="width:95%;height:100%;max-height:100%;">
            <div class="modal-content">
                <h4>Actualizar</h4>
                <div class="row">
                    <form class="col s12">
                        <input type="hidden" id="company_id_edit" value="">
                        <div class="row" style="margin-bottom:10px;">
                            <div class="input-field col s4">
                                <input id="title_edit" type="text">
                                <label for="title_edit">Titulo</label>
                            </div>
                            <div class="input-field col s4">
                                <select id="priority_edit">
                                    <option value="" disabled selected>-- Seleccionar Prioridad --</option>
                                    <option value="1">Baja</option>
                                    <option value="2">Media</option>
                                    <option value="3">Alta</option>
                                </select>
                                <label>Prioridad</label>
                            </div>
                            <div class="input-field col s4">
                                <select class="icons" id="status_edit">
                                    <option value="" disabled selected>-- Seleccionar Estado --</option>
                                    <option value="1" class="circle">Abierto</option>
                                    <option value="0" class="circle">Cerrado</option>
                                </select>
                                <label>Estado</label>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:10px;">
                            <div class="input-field col s4">
                                <select class="icons" id="tck_type_edit">
                                    <option value="" disbled selected>-- Seleccionar Tipo --</option>
                                    <?php foreach($ticket_types as $key=>$type){ ?>
                                    <option value="{{$type->id}}" class="circle">{{$type->name}}</option>
                                    <?php } ?>
                                </select>
                                <label>Tipo</label>
                            </div>
                            <div class="input-field col s4">
                                <select class="icons" id="groups_edit" name="groups_edit">
                                    <option value="" disbled selected>-- Seleccionar Grupo --</option>
                                </select>
                                <label>Grupo</label>
                            </div>
                            <div class="input-field col s4">
                                <select class="icons" id="carriers_edit" name="carriers_edit">
                                    <option value="">-- Seleccionar Transportista --</option>
                                </select>
                                <label>Transportista</label>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:10px;">
                            <div class="input-field col s4">
                                <select class="icons" id="reported_by_edit" name="reported_by_edit">
                                    <option value="" selected>-- Reportado Por --</option>
                                </select>
                                <label>Reportado por</label>
                            </div>
                            <div class="input-field col s4">
                                <select class="icons" id="attended_by_edit" name="attended_by_edit">
                                    <option value="" selected>-- Atendido Por --</option>
                                    <?php foreach($tsac as $key=>$tec){ ?>
                                    <option value="{{$tec->id}}" class="circle">{{$tec->name}}</option>
                                    <?php } ?>
                                </select>
                                <label>Atendido por</label>
                            </div>
                            <div class="input-field col s4">
                                <select class="icons" id="devices_edit" name="devices_edit">
                                    <option value="" selected>-- Seleccionar Origen --</option>
                                    <?php
                                        foreach($devices as $key=>$device){
                                    ?>
                                    <option value="{{$device->id}}" class="circle">{{$device->name}}</option>
                                    <?php } ?>
                                </select>
                                <label>Origen</label>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:0;">
                            <div class="input-field col s12">
                                <select id="plates_edit" name="plates_edit">
                                    <option value="" selected>-- Seleccionar Patente --</option>
                                </select>
                                <label>Patente</label>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:0;">
                            <div class="input-field col s12 m6">
                                <textarea id="report_edit" class="materialize-textarea" data-length="255"></textarea>
                                <label for="report_edit">Detalle</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <textarea id="solution_edit" class="materialize-textarea" data-length="255"></textarea>
                                <label for="solution_edit">Solucion</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat " id="update">Guardar</a>
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
            </div>
        </div>
@endsection
@section('script')
    @include('layouts.scripts')
    <script>
        // Material Select Initialization
        $(document).ready(function () {
            $('.modal').modal();
            $('select').material_select();
            $(".button-collapse").sideNav();
            $('#modal1 table').hide();
            $('#ticket-info .container').hide();
            $('ul.tabs').tabs();
        });

        $('#close').on('click',function(){
            $('#ticket-info').fadeOut('slow');
            $('#modal1').modal('open');
        });

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
            $('#modal1').modal('close');
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
        $('#company').on('change',function(){
            if($(this).val()!=''){
                $('select').removeAttr('disabled');
                $('input').removeAttr('disabled');
                $('textarea').removeAttr('disabled');
                $('#save').removeClass('disabled');
                $('#plates').html('');
                $('#reported_by').html('');
                $('select').not(this).find('option:eq(0)').prop('selected', true);
                $('select').material_select();
                var company_id=$('#company').val();
                var v = get_data(company_id,'vehicles');
                v.done((function(r){
                    $('#plates').html('');
                    if(Object.keys(r).length > 0){
                        $('#plates').append($('<option>', {
                            value: '',
                            text: '-- Seleccionar Patente --'
                        }));
                        for(var i in r){
                            $('#plates').append($('<option>', {
                                value: r[i]['id'],
                                text: r[i]['plate']
                            }));
                        }
                    }else{
                        $('#plates').append($('<option>', {
                            value: '',
                            text: '-- No hay patentes asociadas --'
                        }));
                    }
                    $('#plates').material_select();
                }));

                var e = get_data(company_id,'employees');
                e.done((function(r){
                    $('#reported_by').html('');
                    if(Object.keys(r).length > 0){
                        $('#reported_by').append($('<option>', {
                            value: '',
                            text: '-- Seleccionar Empleado --'
                        }));
                        for(var i in r){
                            var name=r[i]['name'];
                            if(r[i]['position']!='')
                                name+=' ('+r[i]['position']+')';
                            $('#reported_by').append($('<option>', {
                                value: r[i]['id'],
                                text: name
                            }));
                            $('#reported_by option[value="'+r[i]['id']+'"]').attr('data-icon','https://image.flaticon.com/icons/svg/32/32438.svg'); //Add Profile from DB
                        }
                    }else{
                        $('#reported_by').append($('<option>', {
                            value: '',
                            text: '-- No hay empleados asociados --'
                        }));
                    }
                    $('#reported_by').material_select();
                }));

                var g = get_group(company_id);
                g.done(function(res){
                    console.log(res);
                    $('#groups').html('');
                    if(Object.keys(res).length > 0){
                        $('#groups').append($('<option>', {
                            value: '',
                            text: '-- Seleccionar Grupo --'
                        }));
                        for(var i in res){
                            $('#groups').append($('<option>', {
                                value: res[i]['cp_id'],
                                data_id: res[i]['group']['id'],
                                text: res[i]['group']['name']
                            }));
                        }
                    }else{
                        $('#groups').append($('<option>', {
                            value: '',
                            text: '-- No hay grupos asociados --'
                        }));
                    }
                    $('#groups').material_select();
                });
            }else{
                $('select').attr('disabled');
                $('input').attr('disabled');
                $('textarea').attr('disabled');
                $('#save').addClass('disabled');
                $('select').material_select();
            }
        });
        
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

        $(document).on('change','#groups',function(){
            var company_group_id=$('#groups option:selected').val(),
                c=get_carriers(company_group_id);
            c.done(function(d){
                console.log(d);
                $('#carriers').html('');
                if(Object.keys(d).length > 0){
                    $('#carriers').append($('<option>', {
                        value: '',
                        text: '-- Seleccionar Transportista --'
                    }));
                    for(var i in d){
                        $('#carriers').append($('<option>', {
                            value: d[i]['cg_id'],
                            text: d[i]['carrier']['name']
                        }));
                    }
                }else{
                    $('#carriers').append($('<option>', {
                        value: '',
                        text: '-- No hay transportistas asociados --'
                    }));
                }
                $('#carriers').material_select();
            });
        });

        $('#reported_by').on('change',function(){
            e=get_employee(this.value);
            e.done(function(r){
              /*  var position=r['position'],
                    phone=r['phone'],
                    email=r['email'];
                $('#reported_position').val(position).addClass('active valid').next().addClass('active');
                $('#reported_phone').val(phone).addClass('active valid').next().addClass('active');
                $('#reported_email').val(email).addClass('active valid').next().addClass('active');*/
            });
        });
        var create_ticket = function(ticket_data,action='create',tck_id=''){
            var formData = new FormData();
            formData.append("ticket_data", JSON.stringify(ticket_data));
            if(tck_id!='')
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
                url: '/'+action+'/ticket'
            });
        }

        $(document).on('click','#save',function(){
            var title=$('#title').val(),
                priority=$('#priority').val(),
                status=$('#status').val(),
                report=$('#report').val(),
                solution=$('#solution').val(),
                id_reported_by=$('#reported_by').val(),
                id_sac=$('#attended_by').val(),
                id_origin=$('#devices').val(),
                type=$('#tck_type').val(),
                id_plate=$('#plates').val(),
                id_group=$('#groups').val(),
                id_carrier=$('#carriers').val(),
                arr={},
                errors=[];
            if(title!='') arr['title']=title;
            else errors.push('Campo Titulo es requerido');
            if(priority!='') arr['priority']=priority;
            else errors.push("Debe seleccionar una Prioridad");
            if(status!='') arr['status']=status;
            else errors.push("Debe seleccionar un Estado");
            if(report!='') arr['report']=report;
            else errors.push("Escriba un reporte.");
            if(id_reported_by!='') arr['reported_by']=id_reported_by;
            else errors.push("Debe seleccionar quien Reporto el evento");
            if(id_sac!='') arr['id_sac']=id_sac;
            else errors.push("Debe seleccionar quien Atendio el evento");
            if(id_origin!='') arr['id_device']=id_origin;
            else errors.push("Debe seleccionar el Origen del reporte");
            if(type!='') arr['id_tck_type']=type;
            else errors.push("Debe seleccionar un Tipo");
            if(id_group!='') arr['id_company_group']=id_group;
            else errors.push("Debe seleccionar un Grupo");
            if(id_carrier!='') arr['id_carrier_group']=id_carrier;
            else errors.push("Debe seleccionar un transportista");

            if(Object.keys(arr).length >=8){
                if(solution!='')
                    arr['solution']=solution;
                if(id_plate!='')
                    arr['id_vehicle']=id_plate;
                var t=create_ticket(arr);
                t.done(function(response){
                    if(response!=''){
                        swal({
                            title: "Creado ticket no. "+response,
                            text: "El ticket ha sido creado exitosamente!",
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then(function () {
                            location.reload();
                        })
                    }
                })
            }else{
                console.log(errors);
            }
        });

        var get_pending = function(){
            return $.ajax({
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/get/status/ticket',
                data:{status:true}
            });
        }

        $(document).on('click','#pending',function(){
            var p=get_pending();
            p.done(function(r){
                $('#pending-container').html('');
                $('#modal1 table').fadeIn('slow');
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
    </script>
    <script src="/js/Tickets/update_ticket.js"></script>
@endsection
@else
    <h3>No tiene los permisos necesarios</h3>
@endif
