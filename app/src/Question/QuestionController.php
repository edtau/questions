<?php
namespace Anax\Question;

/**
 * A controller for users and admin related events.
 *
 */
class QuestionController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;


    /**
     * Initialize the controller.
     * @return void
     */
    public function initialize()
    {
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);

        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);
    }

    public function indexAction(){
        $questions = $this->question->all();
        $tags = $this->question->findTagsByQuestion(1);

        $this->theme->setTitle("Questions");

        $this->views->add('question/questions', [
            'title' => "Setup up Application",
            'questions' => $questions,
            'tags' => $tags
        ]);
    }
    public function questionAction($id, $showComments = false){

        //echo $showComments;
        $questions = $this->question->all();
         $comments = $this->comment->findAll();
        $answers = $this->question->findAnswersToQuestion($id);
        $this->theme->setTitle("Questions");

        $this->views->add('question/question', [
            'title' => "Setup up Application",
            'posts' => $questions,
            'comments' => $comments,

        ]);
        $this->views->add('question/question', [
            'title' => "Setup up Application",
            'posts' => $answers,
            'comments' => $comments,

        ]);

        if($showComments != false){
            $this->di->dispatcher->forward([
                'controller' => 'comment',
                'action'     => 'view',
                'params'     => [$showComments,$id]
            ]);
        }

    }
}
