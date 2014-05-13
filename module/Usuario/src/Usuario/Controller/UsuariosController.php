<?php

/**
 * namespace de localizacao do nosso controller
 */
namespace Usuario\Controller;
 
// import Zend\Mvc
use Zend\Mvc\Controller\AbstractActionController;
 
// import Zend\View
use Zend\View\Model\ViewModel;
 
// imort Model\ContatoTable com alias
use Usuario\Model\UsuarioTable as ModelUsuario;

class UsuariosController extends AbstractActionController
{
    // GET /contatos
    public function indexAction() {
        // enviar para view o array com key usuarios e value com todos os usuarios  
        return new ViewModel(array('usuarios' => $this->getUsuarioTable()->fetchAll()));
    }

    // GET /usuarios/novo
    public function novoAction() {
        }

    // POST /contatos/adicionar
    public function adicionarAction() {
        // obtém a requisição
        $request = $this->getRequest();
        // verifica se a requisição é do tipo post
        if ($request->isPost()) {
            // obter e armazenar valores do post
            $postData = $request->getPost()->toArray();
            $formularioValido = true;
            // verifica se o formulário segue a validação proposta
            if ($formularioValido) {
                // aqui vai a lógica para adicionar os dados à tabela no banco
                // 1 - solicitar serviço para pegar o model responsável pela adição
                // 2 - inserir dados no banco pelo model
                // adicionar mensagem de sucesso
                $this->flashMessenger()->addSuccessMessage("Usuário criado com sucesso");
                // redirecionar para action index no controller uauarios
                return $this->redirect()->toRoute('usuarios');
            } else {
                // adicionar mensagem de erro
                $this->flashMessenger()->addErrorMessage("Erro ao criar usuário");
                // redirecionar para action novo no controllers usuários
                return $this->redirect()->toRoute('usuarios', array('action' => 'novo'));
            }
        }
    }

    // GET /usuarios/detalhes/id
    public function detalhesAction() {
       // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);
        // se id = 0 ou não informado redirecione para usuarios
        if (!$id) {
            // adicionar mensagem
            $this->flashMessenger()->addMessage("Usuario não encotrado");
            // redirecionar para action index
            return $this->redirect()->toRoute('usuarios');
        }
        // aqui vai a lógica para pegar os dados referente ao usuario
        // 1 - solicitar serviço para pegar o model responsável pelo find
        // 2 - solicitar form com dados desse usuario encontrado
        // formulário com dados preenchidos
        try {
            $form = (array) $this->getUsuarioTable()->find($id);
        } catch (\Exception $exc) {
            // adicionar mensagem
            $this->flashMessenger()->addErrorMessage($exc->getMessage());
        // redirecionar para action index
        return $this->redirect()->toRoute('usuarios');
        }
        // dados eviados para detalhes.phtml
        return array('id' => $id, 'form' => $form);
    }

    // GET /usuarios/editar/id
    public function editarAction() {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);
        // se id = 0 ou não informado redirecione para usuarios
        if (!$id) {
            // adicionar mensagem de erro
            $this->flashMessenger()->addMessage("Usuário não encotrado");
            // redirecionar para action index
            return $this->redirect()->toRoute('usuarios');
        }
        // aqui vai a lógica para pegar os dados referente ao usuario
        // 1 - solicitar serviço para pegar o model responsável pelo find
        // 2 - solicitar form com dados desse usuario encontrado
        // formulário com dados preenchidos
        try {
             $form = (array) $this->getUsuarioTable()->find($id);
        } catch (\Exception $exc) {
            // adicionar mensagem
            $this->flashMessenger()->addErrorMessage($exc->getMessage());
            // redirecionar para action index
            return $this->redirect()->toRoute('usuarios');
        }
        // dados eviados para editar.phtml
        return array('id' => $id, 'form' => $form);
    }

    // PUT /usuarios/editar/id
    public function atualizarAction() {
        // obtém a requisição
        $request = $this->getRequest();
        // verifica se a requisição é do tipo post
        if ($request->isPost()) {
            // obter e armazenar valores do post
            $postData = $request->getPost()->toArray();
            $formularioValido = true;
            // verifica se o formulário segue a validação proposta
            if ($formularioValido) {
                // aqui vai a lógica para editar os dados à tabela no banco
                // 1 - solicitar serviço para pegar o model responsável pela atualização
                // 2 - editar dados no banco pelo model
                // adicionar mensagem de sucesso
                $this->flashMessenger()->addSuccessMessage("Usuário editado com sucesso");
                // redirecionar para action detalhes
                return $this->redirect()->toRoute('usuarios', array("action" => "detalhes", "id" => $postData['id'],));
            } else {
                // adicionar mensagem de erro
                $this->flashMessenger()->addErrorMessage("Erro ao editar usuário");
                // redirecionar para action editar
                return $this->redirect()->toRoute('usuarios', array('action' => 'editar', "id" => $postData['id'],));
            }
        }
    }

    // DELETE /usuarios/deletar/id
    public function deletarAction() {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);
        // se id = 0 ou não informado redirecione para contatos
        if (!$id) {
            // adicionar mensagem de erro
            $this->flashMessenger()->addMessage("Usuário não encotrado");
        } else {
            // aqui vai a lógica para deletar o contato no banco
            // 1 - solicitar serviço para pegar o model responsável pelo delete
            // 2 - deleta contato
            // adicionar mensagem de sucesso
            $this->flashMessenger()->addSuccessMessage("Usuário de ID $id deletado com sucesso");
        }
        // redirecionar para action index
        return $this->redirect()->toRoute('usuarios');
    }
    
    /**
     * Metodo privado para obter instacia do Model UsuarioTable
     *
     * @return \Usuario\Model\UsuarioTable
     */
    private function getUsuarioTable() { 
        // adicionar service ModelUsuario a variavel de classe
        if (!$this->usuarioTable) {
            $this->usuarioTable = $this->getServiceLocator()->get('ModelUsuario');
            // return vairavel de classe com service ModelUsuariio
            return $this->usuarioTable;
        }
    }
    
}