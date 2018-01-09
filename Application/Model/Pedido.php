<?php

namespace Application\Mdoel;

use Application\Model\Mapper\Pedido as PedidoMapper;

class Pedido
{

    private $mapper = null;

    public function __construct()
    {
        $this->mapper = new PedidoMapper();
    }

    public function consultarPedidos()
    {
        return $this->mapper->select();
    }

    public function gravarPedido($numero)
    {
        $pedido = $this->mapper->newRow();
        $pedido->numero = $numero;
        $pedido->save();
    }

}
