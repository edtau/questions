<?php

namespace Anax\Comment;
use Anax\Validate\CValidate;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentController  implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function initialize()
    {

        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);
    }

    public function viewAction($comment, $id){
        $str = explode("-",$comment);
        $commentType = $str[1];

         if($commentType == "question"){
             $comments = $this->comment->findCommentsQuestion($id);
        } else{
             $comments = $this->comment->findCommentsAnswer($id);
         }

        $this->views->add('comment/comments', [
            'comments' => $comments,

        ]);

    }
    public function vAction($idPost){
        echo $idPost;
    }


}
