// UPDATE SECTION
// ====================
$(document).on('click','#edit_containter',function(){
    $('#edit_modal').modal('open');
    var t_id=$(this).attr('tck_id'),
        t=get_ticket(t_id);
    $('#priority_edit option').removeAttr('selected');
    t.done(function(tck){
        console.log(tck);
        $('#title_edit').val(tck['title']).addClass('active valid').next().addClass('active');
        $('#report_edit').val(tck['detail']).addClass('active valid').next().addClass('active');
        $('#solution_edit').val(tck['solution']).addClass('active valid').next().addClass('active');
        $('#priority_edit option[value='+tck['priority_id']+']').attr('selected','selected').addClass('active valid').next().addClass('active');
        
        $('#status_edit option[value=1]').attr('selected','selected').addClass('active valid').next().addClass('active');
        $('#tck_type_edit option[value='+tck['type']['id']+']').attr('selected','selected').addClass('active valid').next().addClass('active');
        $('#attended_by_edit option[value='+tck['support_sac']['id']+']').attr('selected','selected').addClass('active valid').next().addClass('active');
        $('#devices_edit option[value='+tck['device']['id']+']').attr('selected','selected').addClass('active valid').next().addClass('active');
        $('select').material_select();
        var company_id=tck['companyGroup']['company']['id'];
        var v = get_data(company_id,'vehicles');
        v.done((function(r){
            $('#plates_edit').html('');
            if(Object.keys(r).length > 0){
                $('#plates_edit').append($('<option>', {
                    value: '',
                    text: '-- Seleccionar Patente --'
                }));
                for(var i in r){
                    $('#plates_edit').append($('<option>', {
                        value: r[i]['id'],
                        text: r[i]['plate']
                    }));
                }
            }else{
                $('#plates_edit').append($('<option>', {
                    value: '',
                    text: '-- No hay patentes asociadas --'
                }));
            }
            $('#plates_edit option[value='+tck['vehicle']['id']+']').attr('selected','selected').addClass('active valid').next().addClass('active');
            $('#plates_edit').material_select();
        }));
        var e = get_data(company_id,'employees');
        e.done((function(r){
            $('#reported_by_edit').html('');
            if(Object.keys(r).length > 0){
                $('#reported_by_edit').append($('<option>', {
                    value: '',
                    text: '-- Seleccionar Empleado --'
                }));
                for(var i in r){
                    var name=r[i]['name'];
                    if(r[i]['position']!='')
                        name+=' ('+r[i]['position']+')';
                    $('#reported_by_edit').append($('<option>', {
                        value: r[i]['id'],
                        text: name
                    }));
                    $('#reported_by_edit option[value="'+r[i]['id']+'"]').attr('data-icon','https://image.flaticon.com/icons/svg/32/32438.svg'); //Add Profile from DB
                }
            }else{
                $('#reported_by_edit').append($('<option>', {
                    value: '',
                    text: '-- No hay empleados asociados --'
                }));
            }
            $('#reported_by_edit option[value='+tck['reported_by']['id']+']').attr('selected','selected').addClass('active valid').next().addClass('active');
            $('#reported_by_edit').material_select();
        }));

        var g = get_group(company_id);
        g.done(function(res){
            $('#groups_edit').html('');
            if(Object.keys(res).length > 0){
                $('#groups_edit').append($('<option>', {
                    value: '',
                    text: '-- Seleccionar Grupo --'
                }));
                for(var i in res){
                    $('#groups_edit').append($('<option>', {
                        value: res[i]['cp_id'],
                        data_id: res[i]['group']['id'],
                        text: res[i]['group']['name']
                    }));
                }
            }else{
                $('#groups_edit').append($('<option>', {
                    value: '',
                    text: '-- No hay grupos asociados --'
                }));
            }
            $('#groups_edit option[value='+tck['companyGroup']['id']+']').attr('selected','selected').addClass('active valid').next().addClass('active');
            $('#groups_edit').material_select();
        });
        var group_id=tck['companyGroup']['group']['id'],
            c=get_carriers(group_id);
        c.done(function(d){
            $('#carriers_edit').html('');
            if(Object.keys(d).length > 0){
                $('#carriers_edit').append($('<option>', {
                    value: '',
                    text: '-- Seleccionar Transportista --'
                }));
                for(var i in d){
                    $('#carriers_edit').append($('<option>', {
                        value: d[i]['cg_id'],
                        text: d[i]['carrier']['name']
                    }));
                }
            }else{
                $('#carriers_edit').append($('<option>', {
                    value: '',
                    text: '-- No hay transportistas asociados --'
                }));
            }
            $('#carriers_edit option[value='+tck['carrierGroup']['id']+']').attr('selected','selected').addClass('active valid').next().addClass('active');
            $('#carriers_edit').material_select();
        });
    });
});

$(document).on('change','#groups_edit',function(){
    var group_id=$('#groups_edit option:selected').attr('data_id'),
        c=get_carriers(group_id);
    c.done(function(d){
        console.log(d);
        $('#carriers_edit').html('');
        if(Object.keys(d).length > 0){
            $('#carriers_edit').append($('<option>', {
                value: '',
                text: '-- Seleccionar Transportista --'
            }));
            for(var i in d){
                $('#carriers_edit').append($('<option>', {
                    value: d[i]['cg_id'],
                    text: d[i]['carrier']['name']
                }));
            }
        }else{
            $('#carriers_edit').append($('<option>', {
                value: '',
                text: '-- No hay transportistas asociados --'
            }));
        }
        $('#carriers_edit').material_select();
    });
});

$(document).on('click','#update',function(){
    var title=$('#title_edit').val(),
        priority=$('#priority_edit').val(),
        status=$('#status_edit').val(),
        report=$('#report_edit').val(),
        solution=$('#solution_edit').val(),
        id_reported_by=$('#reported_by_edit').val(),
        id_sac=$('#attended_by_edit').val(),
        id_origin=$('#devices_edit').val(),
        type=$('#tck_type_edit').val(),
        id_plate=$('#plates_edit').val(),
        id_group=$('#groups_edit').val(),
        id_carrier=$('#carriers_edit').val(),
        tck_id=$('#t_id').val(),
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
        var t=create_ticket(arr,'update',tck_id);
        t.done(function(response){
            if(response!=''){
                swal({
                    title: "Ticket no. "+response,
                    text: "El ticket ha sido actualizado exitosamente!",
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then(function () {
                    var t=get_ticket(tck_id);
                    t.done(function(r){
                        build_ticket_info(r,tck_id);
                    });
                })
            }
        })
    }else{
        console.log(errors);
    }
});
