<?php
namespace Anax\User;

/**
 * A controller for users and admin related events.
 *
 */
class UserController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    private $title = null;

    /**
     * Initialize the controller.
     * @return void
     */
    public function initialize()
    {
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);
    }


    /**
     * Initialize the controller.
     * @return void
     */
    //    setup för att skapa tabell och ett par användare.
    public function setupAction()
    {
        $this->users->setupUsers();
        $users = $this->users->findAll();

        $this->theme->setTitle("List all users");
        $this->views->add('users/list-all', [
            'users' => $users,
            'title' => "Databasen återställd",
        ]);
        $this->addMenu();

    }

    //users/add för att lägga till användare.
    public function addAction()
    {
        $form = new \Anax\HTMLForm\AddUser();
        $form->setDI($this->di);
        $form->check();
        $this->di->theme->setTitle("Användare");

        $this->di->views->add('default/page', [
            'title' => "Lägg till Användare",
            'content' => $form->getHTML()
        ]);
        $this->addMenu();

    }

    // users/list för att visa samtliga användare.
    public function listAction($userStatus = null)
    {

        switch ($userStatus) {
            case "inactive":
                $users = $this->inactiveUsers();
                break;
            case "active":
                $users = $this->activeUsers();
                break;
            case "deleted":
                $users = $this->deletedUsers();
                break;
            default:
                $this->title = "Alla användare";
                $users = $this->users->findAll();
        }

        $this->theme->setTitle("List all users");
        $this->views->add('users/list-all', [
            'users' => $users,
            'title' => $this->title,
        ]);
        $this->addMenu();
    }

    //users/id/:number för att visa detaljer om en användare.
    public function idAction($id = null)
    {
        $user = $this->users->find($id);

        $this->theme->setTitle("Användare");
        $this->views->add('users/view', [
            'user' => $user,
            'title' => $this->title,
        ], 'main');
        $this->addMenu();
    }

    // samt verklig delete.users/delete för att radera en användare.
    public function deleteAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }
        $user = $this->users->find($id);

        $deleted = $this->users->delete($id);
        if($deleted){
            $user = null;
        }
        $this->theme->setTitle("Användare");
        $this->views->add('users/view', [
            'user' => $user,
            'title' => "Användaren finns inte mer",
        ], 'main');
        $this->addMenu();
    }

    //users/update för att uppdatera informationen om en användare.

    ##Metoder för att ändra en användare
    public function updateAction($id)
    {
        $user = $this->users->find($id);

        $form = new \Anax\HTMLForm\EditUser($user);
        $form->setDI($this->di);
        $form->check();

        $this->di->theme->setTitle("Användare");

        $this->di->views->add('default/page', [
            'title' => "Redigera Användare",
            'content' => $form->getHTML()
        ]);
        $this->addMenu();

    }


    /**
     * Action method to undo delete
     * @param $id
     */
    public function undoSoftDeleteAction($id)
    {
        $user = $this->users->find($id);

        $user->deleted = null;
        $user->save();

        $url = $this->url->create('users/id/' . $id);
        $this->response->redirect($url);
        $this->addMenu();

    }

    /**
     * Action method to soft delete user
     * @param $id
     */
    public function softDeleteAction($id)
    {

        $user = $this->users->find($id);

        $user->deleted = gmdate('Y-m-d H:i:s');
        $user->save();

        $url = $this->url->create('users/id/' . $id);
        $this->response->redirect($url);
    }

    /**
     * Action method to activate user
     * @param $id
     */
    public function activeAction($id)
    {
        $user = $this->users->find($id);

        $user->active = gmdate('Y-m-d H:i:s');
        $user->save();

        $url = $this->url->create('users/id/' . $id);
        $this->response->redirect($url);
    }


    public function inactiveAction($id)
    {

        $user = $this->users->find($id);

        $user->active = null;
        $user->save();

        $url = $this->url->create('users/id/' . $id);
        $this->response->redirect($url);
    }

    ##Metoder för att hämta en viss typ av användare
    private function inactiveUsers()
    {
        $this->title = "Inaktiva användare";
        return $this->users->query()
            ->where('active IS NULL')
            ->execute();
    }

    private function activeUsers()
    {
        $this->title = "Aktiva användare";
        return $this->users->query()
            ->where('active IS NOT NULL')
            ->andWhere('deleted is NOT NULL')
            ->execute();
    }

    private function deletedUsers()
    {
        $this->title = "Trashcan";
        return $this->users->query()
            ->where('deleted IS NOT NULL')
            ->execute();
    }

    private function addMenu()
    {
        $this->views->add('users/menu', [], 'sidebar');
    }
}
