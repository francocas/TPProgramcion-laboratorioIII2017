<?php
class vehiculo
{
    public $_patente;
    public $_color;
    public $_marca;

    public function __construct($patente, $color, $marca)
    {
        $_color = $color;
        $_marca = $marca;
        $_patente = $patente;
    }
}
?>