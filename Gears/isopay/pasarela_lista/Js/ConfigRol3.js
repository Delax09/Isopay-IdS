var config_list_pasarelalista_id = "#grid-table-pasarelalista";
var config_list_pasarelalista = {
		rowList			 : [30,50,100],
		rowNum			 : 30,
		masive_delete	 : false,
		grid_selector 	 : "#grid-table-pasarelalista",	
		pager_selector 	 : "#grid-pager-pasarelalista",
		accion_grid		 : "#FORM_ACCIONES_PASARELALISTA",
		filter_grid		 : "#FORM_FILTRO_PASARELALISTA",
		url_seacrh		 : "./?view=PasarelaLista&_system_json_=1",
		container_result : "#result-cu-pasarelalista",
		container_filter : "#search-cu-pasarelalista",
		unsearch		 : "#unserach-pasarelalista",
		edit_url		 : "./?view=PasarelaLista&_system_json_=1&eject=1",
		form			 : "./?view=PasarelaFicha",
		postData		 : $("#FORM_FILTRO_PASARELALISTA").formToJson(),
		page			 : 1,
		orden			 : [[ 0, "desc" ]],
		caption			 : "",
		search_button	 : "#system-search-pasarelalista",
		clear_button	 : "#system-clear-pasarelalista",
		model			 : function(model){
			
							
					
					if(model == 2)
					{
						
					return [{data : "pasarela_id" ,"className":"text-left"},{data : "nombre" ,"className":"text-left"},{data : "estado" ,"className":"text-left"},{data : "cdate" ,"className":"text-left"}]
					
						
					}
			
			 
					return [
					{
							name:'pasarela_id',
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
													name:'iso_pasarela[pasarela_id]',
													index:'pasarela_id', 
													width:60, 
													editable: false,editoptions: {}},
{
													name:'iso_pasarela[nombre]',
													index:'nombre', 
													width:60, 
													editable: false,editoptions: {}},
{
													name:'iso_pasarela[estado]',
													index:'estado', 
													width:60, 
													editable: true,editoptions: { value : $.sys.getListaGrid('iso_pasarela'),}},
{
													name:'iso_pasarela[cdate]',
													index:'cdate', 
													width:60, 
													editable: true,editoptions: {}} ] 
									
	},
	columns			 : function(model){
											
							 return [ ' ','Id','Nombre','Estado','Fecha de creación' ] ;	
						
						},
	
	acciones : [
				{
				
					   caption:"", 
					   title : "Agregar Nuevo",
					   buttonicon:"fa fa-plus arrow_click fa-2", 
					   onClickButton: function(){ 
							$.sys.loadInContent("./?view=PasarelaFicha");
					   }, 
					   position:"first"
				
				}
				,
				{
					   caption:"", 
					   title : "Buscar",
					   buttonicon:"fa fa-search arrow_click fa-2", 
					   onClickButton: function(){ 
							$("#result-cu-pasarelalista").slideUp("fast",function(){
								$("#search-cu-pasarelalista").slideDown("fast",function(){
									//ESCONDER LISTADO
									$("#unserach-pasarelalista").unbind().click(function(){
										
										$("#search-cu-pasarelalista").slideUp("fast",function(){

											$("#result-cu-pasarelalista").slideDown("fast");
										
										});

									});
									//BUSCAR Y ESCONDER LISTADO
									$("#system-search-pasarelalista").unbind().click(function(){
										
										$("#search-cu-pasarelalista").slideUp("fast",function(){
											$("#result-cu-pasarelalista").slideDown("fast",function(){

												jQuery("#grid-table-pasarelalista").setGridParam({
													postData:$("#FORM_FILTRO_PASARELALISTA").formToJson(),
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