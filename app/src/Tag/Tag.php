<?php
namespace Anax\Tag;

/**
 * Model for Users.
 *
 */
class Tag extends \Anax\Database\Database
{
    public function all(){
        $tags = $this->findAll();

        return $tags;
    }
    public function tags(){
        //$questions = $this->test("tag");
        //var_dump($questions);
    }




}
