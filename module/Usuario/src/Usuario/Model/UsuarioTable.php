<?php

// namespace de localizacao do nosso model
namespace Usuario\Model;

// import Zend\Db
use //Zend\Db\Adapter\Adapter,
    //Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

//use Usuario\Model\Usuario;

class UsuarioTable {
    protected $tableGateway;
    
    /**
    * Contrutor com dependencia da classe TableGateway
    * 
    * @param \Zend\Db\TableGateway\TableGateway $tableGateway
    */
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    /**
     * Recuperar todos os elementos da tabela usuários
     * 
     * @return ResultSet
    */ 
    public function fetchAll() {
        return $this->tableGateway->select();
    }

    /**
     * Localizar linha especifico pelo id da tabela usuários
     * 
     * @param type $id
     * @return \Model\Usuario
     * @throws \Exception
    */ 
    public function find($id) {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado usuário de id = {$id}");
        }
        return $row;
    }
}