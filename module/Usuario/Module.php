<?php
namespace Usuario;

// import Model\Usuario
use Usuario\Model\Usuario,
    Usuario\Model\UsuarioTable;

// import Zend\Db
use Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class Module {
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    /**
     * Register View Helper
     */
    public function getViewHelperConfig() {
        return array(
            # registrar View Helper com injecao de dependecia
            'factories' => array(
                'menuAtivo'  => function($sm) {
                    return new View\Helper\MenuAtivo($sm->getServiceLocator()->get('Request'));
                },
                'message' => function($sm) {
                return new View\Helper\Message($sm->getServiceLocator()->get('ControllerPluginManager')->get('flashmessenger'));
                },
            )
        );
    }
    
    /**
    * Register Services
    */
    public function getServiceConfig() {
        return array(
            'factories' => array(
            'UsuarioTableGateway' => function ($sm) {
                // obter adapter db atraves do service manager
                //$adapter = $sm->get('AdapterDb');
                $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                $adapter->query("SET search_path TO semeccons;", 'execute');
                // configurar ResultSet com nosso model Usuario
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Usuario());
                // return TableGateway configurado para nosso model Usuario
                return new TableGateway('usuarios', $adapter, null, $resultSetPrototype);
            },
            'ModelUsuario' => function ($sm) {
                // return instacia Model UsuarioTable
                return new UsuarioTable($sm->get('UsuarioTableGateway'));
            }
        )
    );
  }
}
