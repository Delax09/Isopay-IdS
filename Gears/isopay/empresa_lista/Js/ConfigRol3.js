var config_list_empresalista_id = "#grid-table-empresalista";
var config_list_empresalista = {
		rowList			 : [30,50,100],
		rowNum			 : 30,
		masive_delete	 : false,
		grid_selector 	 : "#grid-table-empresalista",	
		pager_selector 	 : "#grid-pager-empresalista",
		accion_grid		 : "#FORM_ACCIONES_EMPRESALISTA",
		filter_grid		 : "#FORM_FILTRO_EMPRESALISTA",
		url_seacrh		 : "./?view=EmpresaLista&_system_json_=1",
		container_result : "#result-cu-empresalista",
		container_filter : "#search-cu-empresalista",
		unsearch		 : "#unserach-empresalista",
		edit_url		 : "./?view=EmpresaLista&_system_json_=1&eject=1",
		form			 : "./?view=EmpresaFicha",
		postData		 : $("#FORM_FILTRO_EMPRESALISTA").formToJson(),
		page			 : 1,
		orden			 : [[ 0, "desc" ]],
		caption			 : "",
		search_button	 : "#system-search-empresalista",
		clear_button	 : "#system-clear-empresalista",
		model			 : function(model){
			
							
					
					if(model == 2)
					{
						
					return [{data : "empresa_id" ,"className":"text-left"},{data : "nombre" ,"className":"text-left"},{data : "rut" ,"className":"text-left"},{data : "tipo" ,"className":"text-left"},{data : "cdate" ,"className":"text-left"}]
					
						
					}
			
			 
					return [
					{
							name:'empresa_id',
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
													name:'iso_empresa[empresa_id]',
													index:'empresa_id', 
													width:60, 
													editable: false,editoptions: {}},
{
													name:'iso_empresa[nombre]',
													index:'nombre', 
													width:60, 
													editable: false,editoptions: {}},
{
													name:'iso_empresa[rut]',
													index:'rut', 
													width:60, 
													editable: true,editoptions: {}},
{
													name:'iso_empresa[tipo]',
													index:'tipo', 
													width:60, 
													editable: true,editoptions: { value : $.sys.getListaGrid('iso_empresa'),}},
{
													name:'iso_empresa[cdate]',
													index:'cdate', 
													width:60, 
													editable: true,editoptions: {}} ] 
									
	},
	columns			 : function(model){
											
							 return [ ' ','Id','Nombre','Rut','Tipo','Fecha de creación' ] ;	
						
						},
	
	acciones : [
				{
				
					   caption:"", 
					   title : "Agregar Nuevo",
					   buttonicon:"fa fa-plus arrow_click fa-2", 
					   onClickButton: function(){ 
							$.sys.loadInContent("./?view=EmpresaFicha");
					   }, 
					   position:"first"
				
				}
				,
				{
					   caption:"", 
					   title : "Buscar",
					   buttonicon:"fa fa-search arrow_click fa-2", 
					   onClickButton: function(){ 
							$("#result-cu-empresalista").slideUp("fast",function(){
								$("#search-cu-empresalista").slideDown("fast",function(){
									//ESCONDER LISTADO
									$("#unserach-empresalista").unbind().click(function(){
										
										$("#search-cu-empresalista").slideUp("fast",function(){

											$("#result-cu-empresalista").slideDown("fast");
										
										});

									});
									//BUSCAR Y ESCONDER LISTADO
									$("#system-search-empresalista").unbind().click(function(){
										
										$("#search-cu-empresalista").slideUp("fast",function(){
											$("#result-cu-empresalista").slideDown("fast",function(){

												jQuery("#grid-table-empresalista").setGridParam({
													postData:$("#FORM_FILTRO_EMPRESALISTA").formToJson(),
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