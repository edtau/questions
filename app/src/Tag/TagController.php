<?php
namespace Anax\Tag;

/**
 * A controller for users and admin related events.
 *
 */
class TagController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;


    /**
     * Initialize the controller.
     * @return void
     */
    public function initialize()
    {
        $this->tag = new \Anax\Tag\Tag();
        $this->tag->setDI($this->di);
    }

    public function indexAction(){
        $tags = $this->tag->all();

        $this->theme->setTitle("Questions");

        $this->views->add('tag/tags', [
            'title' => "Setup up Application",
            'tags' => $tags
        ]);
    }
    public function testAction(){
        echo "kalle";
    }
}
