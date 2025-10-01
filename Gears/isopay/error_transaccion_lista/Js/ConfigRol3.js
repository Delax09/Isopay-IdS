var config_list_errortransaccionlista_id = "#grid-table-errortransaccionlista";
var config_list_errortransaccionlista = {
		rowList			 : [30,50,100],
		rowNum			 : 30,
		masive_delete	 : false,
		grid_selector 	 : "#grid-table-errortransaccionlista",	
		pager_selector 	 : "#grid-pager-errortransaccionlista",
		accion_grid		 : "#FORM_ACCIONES_ERRORTRANSACCIONLISTA",
		filter_grid		 : "#FORM_FILTRO_ERRORTRANSACCIONLISTA",
		url_seacrh		 : "./?view=ErrorTransaccionLista&_system_json_=1",
		container_result : "#result-cu-errortransaccionlista",
		container_filter : "#search-cu-errortransaccionlista",
		unsearch		 : "#unserach-errortransaccionlista",
		edit_url		 : "./?view=ErrorTransaccionLista&_system_json_=1&eject=1",
		form			 : "./?view=",
		postData		 : $("#FORM_FILTRO_ERRORTRANSACCIONLISTA").formToJson(),
		page			 : 1,
		orden			 : [[ 0, "desc" ]],
		caption			 : "",
		search_button	 : "#system-search-errortransaccionlista",
		clear_button	 : "#system-clear-errortransaccionlista",
		model			 : function(model){
			
							
					
					if(model == 2)
					{
						
					return [{data : "error_transaccion_id" ,"className":"text-left"},{data : "codigo_error" ,"className":"text-left"},{data : "descripcion" ,"className":"text-left"},{data : "cdate" ,"className":"text-left"},{data : "numero_orden_local" ,"className":"text-left"},{data : "transaccion_id" ,"className":"text-left"}]
					
						
					}
			
			 
					return [
					{
							name:'error_transaccion_id',
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
													name:'iso_errortransaccion[error_transaccion_id]',
													index:'error_transaccion_id', 
													width:60, 
													editable: false,editoptions: {}},
{
													name:'iso_errortransaccion[codigo_error]',
													index:'codigo_error', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_errortransaccion[descripcion]',
													index:'descripcion', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_errortransaccion[cdate]',
													index:'cdate', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_errortransaccion[numero_orden_local]',
													index:'numero_orden_local', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_errortransaccion[transaccion_id]',
													index:'transaccion_id', 
													width:60, 
													editable: true,editoptions: {}} ] 
									
	},
	columns			 : function(model){
											
							 return [ ' ','Id','Codigo error','Descripcion','Fecha de creacion','Numero Orden Isocrates','Transaccion Id' ] ;	
						
						},
	
	acciones : [
				
				{
					   caption:"", 
					   title : "Buscar",
					   buttonicon:"fa fa-search arrow_click fa-2", 
					   onClickButton: function(){ 
							$("#result-cu-errortransaccionlista").slideUp("fast",function(){
								$("#search-cu-errortransaccionlista").slideDown("fast",function(){
									//ESCONDER LISTADO
									$("#unserach-errortransaccionlista").unbind().click(function(){
										
										$("#search-cu-errortransaccionlista").slideUp("fast",function(){

											$("#result-cu-errortransaccionlista").slideDown("fast");
										
										});

									});
									//BUSCAR Y ESCONDER LISTADO
									$("#system-search-errortransaccionlista").unbind().click(function(){
										
										$("#search-cu-errortransaccionlista").slideUp("fast",function(){
											$("#result-cu-errortransaccionlista").slideDown("fast",function(){

												jQuery("#grid-table-errortransaccionlista").setGridParam({
													postData:$("#FORM_FILTRO_ERRORTRANSACCIONLISTA").formToJson(),
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