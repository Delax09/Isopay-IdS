<?php

class ErroresTransaccion
{
    public static function Lista()
    {

        $errores = [
            // Flow
            [ "codigo" => -1, "descripcion" => "Tarjeta inválida" ],
            [ "codigo" => -11, "descripcion" => "Excede límite de reintentos de rechazos" ],
            [ "codigo" => -2, "descripcion" => "Error de conexión" ],
            [ "codigo" => -3, "descripcion" => "Excede monto máximo" ],
            [ "codigo" => -4, "descripcion" => "Fecha de expiración inválida" ],
            [ "codigo" => -5, "descripcion" => "Problema en autenticación" ],
            [ "codigo" => -6, "descripcion" => "Rechazo general" ],
            [ "codigo" => -7, "descripcion" => "Tarjeta bloqueada" ],
            [ "codigo" => -8, "descripcion" => "Tarjeta vencida" ],
            [ "codigo" => -9, "descripcion" => "Transacción no soportada" ],
            [ "codigo" => -10, "descripcion" => "Problema en la transacción" ],
            [ "codigo" => 999, "descripcion" => "Error desconocido" ],

            // Transbank (solo errores / rechazos / problemas)
            [ "codigo" => "TSN", "descripcion" => "Autenticación Rechazada" ],
            [ "codigo" => "NP", "descripcion" => "No Participa, sin autenticación" ],
            [ "codigo" => "U3", "descripcion" => "Falla conexión, Autenticación Rechazada" ],
            [ "codigo" => "INV", "descripcion" => "Datos Inválidos" ],
            [ "codigo" => "A", "descripcion" => "Intentó" ],
            [ "codigo" => "CNP1", "descripcion" => "Comercio no participa" ],
            [ "codigo" => "EOP", "descripcion" => "Error operacional" ],
            [ "codigo" => "BNA", "descripcion" => "BIN no adherido" ],
            [ "codigo" => "ENA", "descripcion" => "Emisor no adherido" ],
            [ "codigo" => "TSNS", "descripcion" => "Fallido, no autenticado, denegado / no permite intentos" ],
            [ "codigo" => "TSRS", "descripcion" => "Autenticación rechazada - sin fricción" ],
            [ "codigo" => "TSUS", "descripcion" => "Autenticación no se pudo realizar por problema técnico u otro motivo" ],
            [ "codigo" => "TSCF", "descripcion" => "Autenticación con fricción (No aceptada por el comercio)" ],
            [ "codigo" => "TSNF", "descripcion" => "No autenticado. Transacción denegada con fricción" ],
            [ "codigo" => "TSUF", "descripcion" => "Autenticación con fricción no se pudo realizar por problema técnico u otro" ],
            [ "codigo" => "NPC", "descripcion" => "Comercio no Participa" ],
            [ "codigo" => "NPB", "descripcion" => "BIN no participa" ],
            [ "codigo" => "NPCB", "descripcion" => "Comercio y BIN no participan" ],
            [ "codigo" => "SPCB", "descripcion" => "Comercio y BIN sí participan. Autorización incompleta" ],

            // MercadoPago
            [ "codigo" => "CALL", "descripcion" => "Rechazado con validación para autorizar" ],
            [ "codigo" => "FUND", "descripcion" => "Rechazado por importe insuficiente" ],
            [ "codigo" => "SECU", "descripcion" => "Rechazado por código de seguridad inválido" ],
            [ "codigo" => "EXPI", "descripcion" => "Rechazado por problema de fecha de vencimiento" ],
            [ "codigo" => "FORM", "descripcion" => "Rechazado debido a un error de formulario" ],
            [ "codigo" => "CARD", "descripcion" => "Rechazado por falta de card_number" ],
            [ "codigo" => "INST", "descripcion" => "Rechazado por cuotas inválidas" ],
            [ "codigo" => "DUPL", "descripcion" => "Rechazado por pago duplicado" ],
            [ "codigo" => "LOCK", "descripcion" => "Rechazado por tarjeta deshabilitada" ],
            [ "codigo" => "CTNA", "descripcion" => "Rechazado por tipo de tarjeta no permitida" ],
            [ "codigo" => "ATTE", "descripcion" => "Rechazado por intentos excedidos del pin de la tarjeta" ],
            [ "codigo" => "BLAC", "descripcion" => "Rechazado por estar en lista negra" ],
            [ "codigo" => "UNSU", "descripcion" => "No soportado" ],
            [ "codigo" => "TEST", "descripcion" => "Usado para aplicar regla de montos" ],

            // Khipu
            [ "codigo" => "ERROR", "descripcion" => "No se pudo completar la transferencia" ],
            [ "codigo" => "WARNING", "descripcion" => "Transferencia no confirmada, resultado dudoso" ],
        ];

        return $errores;

    }



}