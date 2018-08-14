$(document).ready(function(){
	/*$('#pasos').trumbowyg({
	    btns: ['strong', 'em', '|', 'insertImage'],
	    autogrow: true
	});*/
	// summernote
// summernote	

	if ( $("#grafico").length ) {
	  setGrafico();
	}
	if ( $("#grafico-torta").length ) {
		i=0;
		datos = [];
	  	$("#tb-casos tbody tr").each(function(){
	  		if (i>0) {
	  			nombre = $(this).find("th").text();
	  			valor = $(this).find("td").text();
	  			datos.push({"name":nombre,"y": Number(valor)});
	  		}

	  		i++;
			
		});
		graficoTorta(datos);
	}
	$(document).on("click","#change-password",function(){

        $("input[name=idusuario]").val($(this).val());

    });
    $(document).on("submit","#form-change-password",function(e){
        e.preventDefault();
        info = $(this).serialize();
        newpassword = $("input[name=newpassword]").val();
        repeatpassword = $("input[name=repeatpassword]").val();
        if (newpassword != repeatpassword) {
            error = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> La contraseñas ingresadas no coindicen</div>';
            $(".error").html(error);
        }else{
            $.ajax({
                url: base_url + "configuraciones/usuarios/changepassword",
                type: "POST",
                data: info,
                success: function(resp){
                    window.location.href = base_url + resp;
                }
            });
        }
    })
	$("#form-add-permiso").submit(function(e){
		e.preventDefault();
		url = $(this).attr("action");
		data = $(this).serialize();
		$.ajax({
			url: url,
			type:"POST",
			data: data,
			success: function(resp){
				if (resp=="1") {
					window.location.href = base_url+"configuraciones/permisos";
				}else if (resp=="0") {
					swal("Error!", "No se ha guardado la informacion", "error");
				}else{
					swal("Advertencia!", "El menu para el rol seleccionado ya existe, edite sus permisos desde el listado", "warning");
				}
			}
		});
	});
	$("#menu").on("change", function(){
		data = $(this).val();
		info = data.split("*");
		$("#idmenu").val(info[0]);
		for (var i = 1; i <= 4; i++) {
			if (info[i] == 1) {
				$(".permiso"+i).css("display","block");
			}else{
				$(".permiso"+i).css("display","none");
			}
		}
	})
	$(document).on( "click",".expand", function() {
	    // $(this).next().slideToggle(200);
	    $expand = $(this).find(">:first-child");
	    
	    if($expand.text() == "+") {
	      $expand.text("-");
	    } else {
	      $expand.text("+");
	    }
	});
	$(".btn-close-reportar").on("click",function(){
		location.reload(true);
	});	
	$(document).on("submit", "#form-updatePasos",function(e){
		$('button[type=submit]').attr('disabled','disabled');
		e.preventDefault();

		var formData = new FormData($("#form-updatePasos")[0]);

		$.ajax({
			url: base_url + "ejecucion/casos/cambios",
			type:"POST",
			data: formData,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(resp){
				$("#modal-default").modal("hide");
				if (resp != 0) {
					if (resp.estado=="1") {
						$("#caso").val(resp.caso);
						detalleCaso(resp.caso);
						$("#modal-reportar").modal({backdrop: 'static', keyboard: false});
						
					}else{

						swal({
					     title: "Bien Hecho!",
					     text: "El cambio de estado fue guardado",
					     type: "success",
					     timer: 3000
					     },
					     function () {
					            location.reload(true);
					            tr.hide();
					    });
					}
				}else{
					swal("Error!", "No se guardo el cambio de estado", "error");
				}
			}
		});
	});
	$("#btn-add-paso").on("click", function(){
		html = "<tr>";
		html += "<td>";
		html += "<input type='text' class='form-control' name='titulos[]' required='required' placeholder='Nombre del Paso...'>";
		html += "</td>";
		html += "<td>";
		html += "<button type='button' class='btn btn-danger btn-remove-paso'><span class='fa fa-times'></span></button>";
		html += "</td>";
		html += "</tr>";
		$("#tb-pasos tbody").append(html);

	});
	$(document).on("click", ".btn-remove-paso", function(){
		$(this).closest("tr").remove();
	});
	$(document).on("change","#asignado",function(){
		id = $(this).val();
		$.ajax({
			url: base_url + "ejecucion/casos/getUsuario",
			type:"POST",
			data: {id: id},
			dataType: "json",
			success: function(resp){
				$("#email").val(resp.email);
			}

		});

	});



	$(".btn-reportar").on("click", function(){
		id = $(this).val();
		detalleCaso(id);
		
	});
	$(".btn-historial").on("click", function(){
		incidencia = $(this).val();
		$("#idIncidencia").val(incidencia);
		$.ajax({
			url: base_url + "backend/seguimientos/historial",
			type:"POST",
			data: {id:incidencia},
			//dataType:"json",
			success: function(resp){
				//alert(resp.incidencia.apellidos);
				
                $("#historial").html(resp);
			}
		});
	});

	$(".btn-add-estado").on("click", function(){
		$("#descripcion").val(null);
		$("#idEstado").val(null);
	});
	$(".btn-edit-estado").on("click", function(){
		info = $(this).val();
		detalle = info.split("*"); 
		$("#descripcion").val(detalle[1]);
		$("#idEstado").val(detalle[0]);
	});

	$("#form-estado").submit(function(e){
		e.preventDefault();
		ruta = $(this).attr("action");
		data = $(this).serialize();
		
     	$.ajax({
			url: ruta,
			type: "POST",
			data: data,
			success: function(resp){
				if (resp=="1") {
					$("#modal-default").modal("hide");
					swal({
					     title: "Bien Hecho!",
					     text: "La información ha sido guardada",
					     type: "success",
					     timer: 3000
					     },
					     function () {
					            location.reload(true);
					            tr.hide();
					});				
				}else{
					$("#error").show();
					$(".msgerror").html(resp);
				}
				
			}
		});
		    
	});

	$("#form-dias").submit(function(e){
		e.preventDefault();
		data = $(this).serialize();
		swal({
		    title: "¿Estas seguro de guardar la información?",
		    text: "Si esta seguro de hacerlo haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: false,
	        showLoaderOnConfirm: true,
		},
		function(isConfirm){

		   	if (isConfirm){
		     	$.ajax({
					url: base_url + "administrador/configuraciones/setDias",
					type: "POST",
					data: data,
					success: function(resp){
						window.location.href = base_url + resp;
					}
				});
		    } 
		});
	});


	

	$(document).on("click", ".btn-view",function(){
		id = $(this).val();
		modulo = $("#modulo").val();
		$.ajax({
			url: base_url + modulo +"/view",
			type: "POST",
			data: {id:id},
			success: function(resp){
				$("#modal-default .modal-body").html(resp);
			}
		});
	});

	$(document).on("click", ".btn-view-caso",function(){
		data = $(this).val();
		info = data.split("*");
		$("#idCaso").val(info[0]);
		$("#estado").val(info[1]);
		modulo = $("#modulo").val();
		$.ajax({
			url: base_url + modulo +"/view",
			type: "POST",
			data: {id:info[0]},
			success: function(resp){
				$("#home").html(resp);
				mostrarHistorial(info[0]);
				mostrarIncidencias(info[0]);
			}
		});
	});

	$(document).on("click", ".btn-delete", function(e){
		e.preventDefault();
		ruta = $(this).attr("href");
		swal({
		    title: "¿Estas seguro de eliminar el registro?",
		    text: "Si esta seguro de hacerlo haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: false,
	        showLoaderOnConfirm: true,
		},
		function(isConfirm){

		   	if (isConfirm){
		     	$.ajax({
					url: ruta,
					type: "POST",
					success: function(resp){
						window.location.href = base_url + resp;
					}
				});
		    } 
		 });
		
	});
	
	$('.btn-group button , .btn-group a').tooltip(); 




	$("#tb-without-buttons,.tb-without-buttons").DataTable({
		language: {
	            "lengthMenu": "Mostrar _MENU_ registros por pagina",
	            "zeroRecords": "No se encontraron resultados en su busqueda",
	            "searchPlaceholder": "Buscar registros",
	            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
	            "infoEmpty": "No existen registros",
	            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
	            "search": "Buscar:",
	            "paginate": {
	                "first": "Primero",
	                "last": "Último",
	                "next": "Siguiente",
	                "previous": "Anterior"
	            },
	        },
	}); 

	$("#tb-with-buttons").DataTable({
		dom: 'lBfrtip',
		language: {
	            "lengthMenu": "Mostrar _MENU_ registros por pagina",
	            "zeroRecords": "No se encontraron resultados en su busqueda",
	            "searchPlaceholder": "Buscar registros",
	            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
	            "infoEmpty": "No existen registros",
	            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
	            "search": "Buscar:",
	            "paginate": {
	                "first": "Primero",
	                "last": "Último",
	                "next": "Siguiente",
	                "previous": "Anterior"
	            },
	        },

            buttons: [
                {
	                extend: 'excelHtml5',
	                title: "Listado de "+ $("#modulo").val(),
	                exportOptions: {
	                    columns: [':visible :not(:last-child)']
	                },
	            },
	            {
	                extend: 'pdfHtml5',
	                title: "Listado de "+$("#modulo").val(),
	                exportOptions: {
	                    columns: [':visible :not(:last-child)']
	                }
	                
	            }
            ],
            pageSize: 'A4',
            content: [{ style: 'fullWidth' }],
            styles: { // style for printing PDF body
                    fullWidth: { fontSize: 18, bold: true, alignment: 'right', margin: [0,0,0,0] }
            },
	}); 

	

	$(document).on("click", ".btn-subir", function(){
		valorbtn = $(this).val(); 
		info = valorbtn.split("*");
		$("#idUsuario").val(info[0]);
		if (info[1] !="") {
			html = "<img src='"+base_url+"assets/images/firmas/"+info[1]+"' class='imagen-firma img-responsive'>";
			$(".imagen").html(html);
			$(".label-imagen").text("Actualizar Firma:");
		} else{
			$(".imagen").html("");
			$(".label-imagen").text("Subir Firma:");
		}

	});

	$(document).on("submit","#form-change-firma",function(e){
		e.preventDefault();

		var formData = new FormData($("#form-change-firma")[0]);

		$.ajax({
			url: base_url + "administrador/usuarios/changeFirma",
			type:"POST",
			data: formData,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(resp){
				if (resp.status == 1) {
					swal({
					     title: "Bien Hecho!",
					     text: "Su imagen de Firma fue actualizada",
					     type: "success",
					     timer: 3000
					     },
					     function () {
					            location.reload(true);
					            tr.hide();
					    });
					/*swal("Registro Exitoso!", "Su imagen de Perfil fue actualizada", "success");
					window.location.href = base_url + "usuario/perfil";*/
				}else{
					//alert(resp.error);
					swal("Error!", resp.error.replace(/(<([^>]+)>)/ig,""), "error");
				}
			}
		});
	});
	$("#form-change-hoja").submit(function(e){
		e.preventDefault();
		var formData = new FormData($("#form-change-hoja")[0]);

		$.ajax({
			url: base_url + "administrador/usuarios/changeHoja",
			type:"POST",
			data: formData,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(resp){
				if (resp.status == 1) {
					swal({
					     title: "Bien Hecho!",
					     text: "Su hoja de vida fue actualizada",
					     type: "success",
					     timer: 3000
					     },
					     function () {
					            location.reload(true);
					            tr.hide();
					    });
				}else{
					swal("Error!", resp.error.replace(/(<([^>]+)>)/ig,""), "error");
				}
			}
		});
	});
	$("#form-change-image").submit(function(e){
		e.preventDefault();

		var formData = new FormData($("#form-change-image")[0]);

		$.ajax({
			url: base_url + "administrador/usuarios/changeImagen",
			type:"POST",
			data: formData,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(resp){
				if (resp.status == 1) {
					swal({
					     title: "Bien Hecho!",
					     text: "Su imagen de Perfil fue actualizada",
					     type: "success",
					     timer: 3000
					     },
					     function () {
					            location.reload(true);
					            tr.hide();
					    });
					/*swal("Registro Exitoso!", "Su imagen de Perfil fue actualizada", "success");
					window.location.href = base_url + "usuario/perfil";*/
				}else{
					//alert(resp.error);
					swal("Error!", resp.error.replace(/(<([^>]+)>)/ig,""), "error");
				}
			}
		});
	});



	$(document).on("click",".btn-print",function(){

        $(".modal-body").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });
    });



	$(".btn-habilitar").on("click", function(){
		id = $(this).val();
		swal({
		    title: "¿Estas de habilitar al usuario seleccionado?",
		    text: "Si esta seguro de hacerlo haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: false,
	        showLoaderOnConfirm: true,
		},
		function(isConfirm){

		   	if (isConfirm){
		     	ActualizarUsuario(id, 1);
		    } 
		 });
		

		//ActualizarUsuario(id, 1);
	});
	$(".btn-deshabilitar").on("click", function(){
		id = $(this).val();

		swal({
		    title: "¿Estas de deshabilitar al usuario seleccionado?",
		    text: "Si esta seguro de hacerlo haga click en el boton Aceptar, caso contrario haga click en cancelar",
		    type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Aceptar",
	        closeOnConfirm: false,
	        showLoaderOnConfirm: true,
		},
		function(isConfirm){

		   	if (isConfirm){
		     	ActualizarUsuario(id, 0);
		    } 
		 });
		
	});

	function mostrarIncidencias(caso){
		$.ajax({
			url:base_url + "ejecucion/casos/getIncidencias",
			type: "POST",
			data: {id:caso},
			//dataType: "json",
			success:function(resp){
				//alert(resp);
				
				$("#menu3").html(resp);
			}
		});
	}

	function mostrarHistorial(caso){
		$.ajax({
			url:base_url + "ejecucion/casos/getHistorialCaso",
			type: "POST",
			data: {id:caso},
			dataType: "json",
			success:function(resp){
				//alert(resp);
				html ="";
				$.each(resp, function(key,value){
					html += "<tr>";
					html += "<td>"+value.nombres+" "+value.apellidos+"</td>";
					html += "<td>"+value.fecha+"</td>";
					html += "<td>Cambio de estado a "+value.descripcion+"</td>";
					html += "</tr>";
				});
				$("#tb-historial tbody").html(html);
			}
		});
	}
	
});

function detalleCaso(caso){
		$.ajax({
			url:base_url + "ejecucion/casos/getCaso",
			type: "POST",
			data: {id:caso},
			dataType: "json",
			success:function(resp){
					
					$("#resumen").val(resp.caso.nombre);
					$("#ciclo").val(resp.caso.ciclo);
					html="";
					k = 1;
					$.each(resp.pasos, function(key, value){
						html += "<p>"+k+"."+value.titulo+"</p>";
						html += "<img src='"+base_url+"assets/images/pasos/"+value.imagen+"' class='img-responsive'>"
						k++;
					});
					//$("#descripcion").val(JSON.stringify(resp.pasos));
					$(".summernote").summernote("code", html);
				
			}
		});
	}
function setGrafico(){
	ciclo = $("#ciclo").val();
	$.ajax({
		url: base_url + "grafico/probar",
		type: "POST",
		dataType: "json", 
		data:{ciclo:ciclo},
		success: function(resp){
			var dias = [];
			var ejecutados = [];
			var exitosos = [];
			var fallidos = [];
			$.each(resp.dias, function(key,value){
				dias.push(value.fecha);
			})
			$.each(resp.ejecutados, function(key,value){
				ejecutados.push(value);
			})
			$.each(resp.fallidos, function(key,value){
				fallidos.push(value);
			})
			$.each(resp.exitosos, function(key,value){
				exitosos.push(value);
			})

			graficar(dias,ejecutados,exitosos,fallidos);

		}

	});
}
function graficar(dias,ejecutados,exitosos,fallidos){

	Highcharts.chart('grafico', {

    title: {
        text: 'Grafica de la ejecucion de casos'
    },

    subtitle: {
        text: 'Ejecucion de casos'
    },

    yAxis: {
        title: {
            text: 'Numero de casos'
        }
    },
    xAxis:{
    	categories: dias,
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },

        }
    },

    series: [{
        name: 'No ejecutado',
        data: ejecutados
    }, {
        name: 'Exitoso',
        data: exitosos
    }, {
        name: 'Fallido',
        data: fallidos
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
}

function graficoTorta(datos){
	console.log(datos);
	Highcharts.chart('grafico-torta', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Estados'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: datos,
    }]
});
}

