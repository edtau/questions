<?php

namespace Phpmvc\Comment;
use Anax\Validate\CValidate;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentController1  implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Initialize the controller.
     * @return void
     */
    public function initialize(){
        $this->comments = new \Phpmvc\Comment\Comments();
        $this->comments->setDI($this->di);
    }

    /**
     *
     */
    public function viewAction()
    {
        echo "hllo";
       /* $comments = $this->findCommentByPage($page);

        $numberOfComments = sizeof($comments);

        $this->views->add('comment/comments', [
            'comments' => $comments,
            'numberOfComments' => $numberOfComments,
            'title' => $page,

        ]);
        $this->addAction($page);
        if($page == "comment"){
            $this->views->add('comment/menu', [], 'sidebar');

        }*/


    }
    //metod för att visa en kommentar
    public function idAction($id){
        echo $id;
      $comments = $this->comments->find($id);
      $numberOfComments = sizeof($comments);

      $this->views->add('comment/comments', [
          'comments' => $comments,
          'numberOfComments' => $numberOfComments,
          'title' => "Kommentarer"
      ]);
      $this->addAction();
    }
    //tar bort en kommentar
    public function deleteAction($id)
    {
    if (!isset($id)) {
            die("Missing id");
        }
        $res = $this->comments->delete($id);

        $url = $this->url->create('comment');
        $this->response->redirect($url);

    }
    //metod för att lägga till kommentar
    public function addAction($page = null)
    {
        $form = new \Anax\HTMLForm\AddComment($page);
        $form->setDI($this->di);
        $form->check();
        $this->di->theme->setTitle("Kommentarer");

        $this->di->views->add('default/page', [
            'title' => "Lägg till kommentar",
            'content' => $form->getHTML()

        ]);

    }
    //metod för att editera kommentar
    public function editAction($id)
    {
         $comment = $this->comments->find($id);

        $form = new \Anax\HTMLForm\EditComment($comment);
        $form->setDI($this->di);

        if($form->check()){
            echo $form->check();
        }

        $this->di->theme->setTitle("Kommentarer");

        $this->di->views->add('default/page', [
            'title' => "Redigera kommentar",
            'content' => $form->getHTML()
        ]);

    }
    //metod för att ta bort alla kommentarer
    public function deleteAllAction()
    {
       $result =  $comment = $this->comments->deleteAll();

       $result = $result == true ? "Alla användare borta" : "Operation misslyckad";
       $this->di->views->add('default/page', [
           'title' => "Resultat ta bort alla kommentarer",
           'content' => $result
       ]);
     }
     //Metod för att återställa databas
    public function setupAction()
    {
        $this->comments->setupComments();
        $this->theme->setTitle("Kommentarer");

        $url = $this->url->create('comment');
        $this->response->redirect($url);
    }
    /**
     * @param $page
     * @return mixed
     */
    private function findCommentByPage($page)
    {
        if ($page == null) {
            $comments = $this->comments->findAll();
            return $comments;
        } else {
            $comments = $this->comments->query()
                ->where('page = ?')
                ->execute([$page]);
            return $comments;
        }
    }

}
