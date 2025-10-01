var config_list_transaccionlista_id = "#grid-table-transaccionlista";
var config_list_transaccionlista = {
		rowList			 : [30,50,100],
		rowNum			 : 30,
		masive_delete	 : false,
		grid_selector 	 : "#grid-table-transaccionlista",	
		pager_selector 	 : "#grid-pager-transaccionlista",
		accion_grid		 : "#FORM_ACCIONES_TRANSACCIONLISTA",
		filter_grid		 : "#FORM_FILTRO_TRANSACCIONLISTA",
		url_seacrh		 : "./?view=TransaccionLista&_system_json_=1",
		container_result : "#result-cu-transaccionlista",
		container_filter : "#search-cu-transaccionlista",
		unsearch		 : "#unserach-transaccionlista",
		edit_url		 : "./?view=TransaccionLista&_system_json_=1&eject=1",
		form			 : "./?view=",
		postData		 : $("#FORM_FILTRO_TRANSACCIONLISTA").formToJson(),
		page			 : 1,
		orden			 : [[ 0, "desc" ]],
		caption			 : "",
		search_button	 : "#system-search-transaccionlista",
		clear_button	 : "#system-clear-transaccionlista",
		model			 : function(model){
			
							
					
					if(model == 2)
					{
						
					return [{data : "transaccion_id" ,"className":"text-left"},{data : "monto" ,"className":"text-left"},{data : "concepto" ,"className":"text-left"},{data : "estado" ,"className":"text-left"},{data : "numero_orden_local" ,"className":"text-left"},{data : "token" ,"className":"text-left"},{data : "url" ,"className":"text-left"},{data : "empresa_id" ,"className":"text-left"},{data : "pasarela_id" ,"className":"text-left"},{data : "cdate" ,"className":"text-left"}]
					
						
					}
			
			 
					return [
					{
							name:'transaccion_id',
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
													name:'iso_transaccion[transaccion_id]',
													index:'transaccion_id', 
													width:60,
													editable: false,editoptions: {}},
{
													name:'iso_transaccion[monto]',
													index:'monto', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_transaccion[concepto]',
													index:'concepto', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_transaccion[estado]',
													index:'estado', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_transaccion[numero_orden_local]',
													index:'numero_orden_local', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_transaccion[token]',
													index:'token', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_transaccion[url]',
													index:'url', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_transaccion[empresa_id]',
													index:'empresa_id', 
													width:60, 
													editable: true,editoptions: { value : $.sys.getListaGrid('iso_vinculo_empresa'),}},
{
													name:'iso_transaccion[pasarela_id]',
													index:'pasarela_id', 
													width:60, 
													editable: true,editoptions: { value : $.sys.getListaGrid('iso_vinculo_pasarela'),}},
{
													name:'iso_transaccion[cdate]',
													index:'cdate', 
													width:60, 
													editable: true,editoptions: {}} ] 
									
	},
	columns			 : function(model){
											
							 return [ ' ','Id','Monto','Concepto','Estado','N. Orden local','Token','Url','Empresa','Pasarela','Fecha de creacion' ] ;	
						
						},
	
	acciones : [
				
				{
					   caption:"", 
					   title : "Buscar",
					   buttonicon:"fa fa-search arrow_click fa-2", 
					   onClickButton: function(){ 
							$("#result-cu-transaccionlista").slideUp("fast",function(){
								$("#search-cu-transaccionlista").slideDown("fast",function(){
									//ESCONDER LISTADO
									$("#unserach-transaccionlista").unbind().click(function(){
										
										$("#search-cu-transaccionlista").slideUp("fast",function(){

											$("#result-cu-transaccionlista").slideDown("fast");
										
										});

									});
									//BUSCAR Y ESCONDER LISTADO
									$("#system-search-transaccionlista").unbind().click(function(){
										
										$("#search-cu-transaccionlista").slideUp("fast",function(){
											$("#result-cu-transaccionlista").slideDown("fast",function(){

												jQuery("#grid-table-transaccionlista").setGridParam({
													postData:$("#FORM_FILTRO_TRANSACCIONLISTA").formToJson(),
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