var config_list_historialtransaccionlista_id = "#grid-table-historialtransaccionlista";
var config_list_historialtransaccionlista = {
		rowList			 : [30,50,100],
		rowNum			 : 30,
		masive_delete	 : false,
		grid_selector 	 : "#grid-table-historialtransaccionlista",	
		pager_selector 	 : "#grid-pager-historialtransaccionlista",
		accion_grid		 : "#FORM_ACCIONES_HISTORIALTRANSACCIONLISTA",
		filter_grid		 : "#FORM_FILTRO_HISTORIALTRANSACCIONLISTA",
		url_seacrh		 : "./?view=HistorialTransaccionLista&_system_json_=1",
		container_result : "#result-cu-historialtransaccionlista",
		container_filter : "#search-cu-historialtransaccionlista",
		unsearch		 : "#unserach-historialtransaccionlista",
		edit_url		 : "./?view=HistorialTransaccionLista&_system_json_=1&eject=1",
		form			 : "./?view=",
		postData		 : $("#FORM_FILTRO_HISTORIALTRANSACCIONLISTA").formToJson(),
		page			 : 1,
		orden			 : [[ 0, "desc" ]],
		caption			 : "",
		search_button	 : "#system-search-historialtransaccionlista",
		clear_button	 : "#system-clear-historialtransaccionlista",
		model			 : function(model){
			
							
					
					if(model == 2)
					{
						
					return [{data : "historial_transaccion_id" ,"className":"text-left"},{data : "estado_anterior" ,"className":"text-left"},{data : "estado_actual" ,"className":"text-left"},{data : "cdate" ,"className":"text-left"},{data : "transaccion_id" ,"className":"text-left"}]
					
						
					}
			
			 
					return [
					{
							name:'historial_transaccion_id',
							index:'', 
							width:-1, 
							fixed:true, 
							sortable:false, 
							resize:false,
							key:true,
							formatter:'actions', 
							actions:{editbutton:false},
							formatoptions:{ 
										editbutton:false,
										delbutton:false,
										delOptions:{recreateForm: true},
										}
							},{
													name:'iso_historialtransaccion[historial_transaccion_id]',
													index:'historial_transaccion_id', 
													width:60, 
													editable: false,editoptions: {}},
{
													name:'iso_historialtransaccion[estado_anterior]',
													index:'estado_anterior', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_historialtransaccion[estado_actual]',
													index:'estado_actual', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_historialtransaccion[cdate]',
													index:'cdate', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_historialtransaccion[transaccion_id]',
													index:'transaccion_id', 
													width:60, 
													editable: true,editoptions: {}} ] 
									
	},
	columns			 : function(model){
											
							 return [ ' ','Id','Estado anterior','Estado actual','Fecha de creacion','Transaccion' ] ;	
						
						},
	
	acciones : [
				
				{
					   caption:"", 
					   title : "Buscar",
					   buttonicon:"fa fa-search arrow_click fa-2", 
					   onClickButton: function(){ 
							$("#result-cu-historialtransaccionlista").slideUp("fast",function(){
								$("#search-cu-historialtransaccionlista").slideDown("fast",function(){
									//ESCONDER LISTADO
									$("#unserach-historialtransaccionlista").unbind().click(function(){
										
										$("#search-cu-historialtransaccionlista").slideUp("fast",function(){

											$("#result-cu-historialtransaccionlista").slideDown("fast");
										
										});

									});
									//BUSCAR Y ESCONDER LISTADO
									$("#system-search-historialtransaccionlista").unbind().click(function(){
										
										$("#search-cu-historialtransaccionlista").slideUp("fast",function(){
											$("#result-cu-historialtransaccionlista").slideDown("fast",function(){

												jQuery("#grid-table-historialtransaccionlista").setGridParam({
													postData:$("#FORM_FILTRO_HISTORIALTRANSACCIONLISTA").formToJson(),
													page:1
												}).trigger("reloadGrid");	
											});
										
										});

									});
									
							
								});
								
								
							
							});
					   }, 
					   position:"first"
				}
	
	]		
						
 };			  