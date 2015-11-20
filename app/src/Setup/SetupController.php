<?php
namespace Anax\Setup;

/**
 * A controller for users and admin related events.
 *
 */
class SetupController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;


    /**
     * Initialize the controller.
     * @return void
     */
    public function initialize()
    {
        $this->setup = new \Anax\Setup\Setup();
        $this->setup->setDI($this->di);
    }


    /**
     * Initialize the controller.
     * @return void
     */
    //    setup för att skapa tabell och ett par användare.
    public function setupAction()
    {
        $this->setup->setup(true);
        $this->theme->setTitle("Setup up");
        $content = $this->di->fileContent->get('setup/setup.md');
        $content = $this->di->textFilter->doFilter($content, 'shortcode, markdown');
        $this->views->add('default/page', [
            'content' => $content,
            'title' => "Setup up Application",
        ]);
    }


}
