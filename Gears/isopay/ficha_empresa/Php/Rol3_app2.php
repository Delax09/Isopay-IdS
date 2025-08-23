<?php
$tag_name = $this->view;
$this->Tpl()->define(array(
    $this->view => $this->GetTemplate(),
),$this->TplPath())
    ->define_dynamic("EMPRESAFICHA_INPUTS_BLOKE",$this->view)
    ->define_dynamic("INPUT_ROW_".strtoupper($tag_name)."_LIST",$this->view);
Manager::Load("isopay","Empresa");
$Empresa = Empresa::getInstance();
$form 	= $this->getForm();

$ordenar = $form->getCampos($Empresa->getDao());
$input = array();
$hidens = array();



foreach($ordenar as $nombre => $inp):

    if($inp instanceof Hidden):

        $hidens[]= $inp;

    else:

        $input[$nombre] = $inp;

    endif;

endforeach;
$input = array_chunk($input,3,true);//CONFIURACION CAMPOS FILTRO
$acciones = $form->getAcciones();

$back = "";

if(isset($acciones["back"])):


    $back = $acciones["back"]->Render();
    unset($acciones["back"]);

endif;


if($Empresa->getStatus())
{

}
else
{
    unset($acciones["delete"]);
}

foreach($input as $grupo):
    foreach($grupo as  $nombre => $objeto):
        $this->Tpl()->assign("[EMPRESAFICHA_INPUT]",$objeto->Render())
            ->parse("XXXX_CAMPO_FORM_XXXX",".EMPRESAFICHA_INPUTS_BLOKE");
    endforeach;
    $this->Tpl()->parse("XXXX_FILTROS_XXXXX",".INPUT_ROW_EMPRESAFICHA_LIST");
    $this->Tpl()->clear("XXXX_CAMPO_FORM_XXXX");
endforeach;

if(count($hidens)):

    foreach($hidens as $key => $obj):

        $hidens[$key] = $obj->Render();

    endforeach;


endif;

$acciones_html = array();
if(count($acciones)):
    foreach($acciones as $name => $accion):
        $acciones_html[]= $accion->Render();
    endforeach;
endif;

$this->parseInputValue($input)
    ->Tpl()->assign(array(
        "[EMPRESAFICHA_BACK]"	=> $back,
        "[EMPRESAFICHA_ACCIONES]"	=> implode(" ",$acciones_html),
        "[EMPRESAFICHA_HIDDEN_INPUTS]" => implode(" ",$hidens),
        "[EMPRESAFICHA_FORM_VIEW]"	=> $form->getName(),
        "[EMPRESAFICHA_VISTA]"		=> Form::Hidden(array("name"=> "view" ,"value"=> $this->view))->Render(),
        "[EMPRESAFICHA_ACCION]"	=> Form::Hidden(array("name"=> "action" , "id" => "accion"))->Render(),

    ));