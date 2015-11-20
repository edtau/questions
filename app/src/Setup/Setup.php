<?php
namespace Anax\Setup;

class Setup extends \Anax\Database\Database
{

    public function setup($addSampleData)
    {


        $this->setupUser();

        $this->setupUserReputation();
        $this->setupTag();
        $this->setupComment();
        $this->setupVotes();
        $this->setupTags();
        $this->setupPost();

    }

    private function setupUser()
    {
        $this->db->dropTableIfExists('user')->execute();

        return $this->db->createTable(
            'user',
            [
                'id_user' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'acronym' => ['varchar(20)', 'unique', 'not null'],
                'name' => ['varchar(80)'],
                'email' => ['varchar(80)'],
                'password' => ['varchar(255)'],
                'created' => ['datetime'],
                'gravatar' => ['varchar(255)'],
                'score' =>['integer']

            ]
        )->execute();
    }

    private function setupUserReputation()
    {
        $this->db->dropTableIfExists('reputation')->execute();

        return $this->db->createTable(
            'reputation',
            [
                'id_reputation' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'description' => ['varchar(80)'],
                'points' => ['integer']
            ]
        )->execute();

    }

    private function setupTag()
    {
        $this->db->dropTableIfExists('tag')->execute();

        return $this->db->createTable(
            'tag',
            [
                'id_tag' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'name' => ['varchar(80)'],
                'description' => ['varchar(80)'],
                'created' => ['datetime'],
                'id_user' => ['integer']
            ]
        )->execute();

    }

    private function setupTags()
    {
        $this->db->dropTableIfExists('tags')->execute();

        return $this->db->createTable(
            'tags',
            [
                'id_tags' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'id_tag' => ['integer'],
                'id_post' => ['integer'],
            ]
        )->execute();

    }



    private function setupVotes()
    {
        $this->db->dropTableIfExists('votes')->execute();

        return $this->db->createTable(
            'votes',
            [
                'id_votes' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'up_vote' => ['integer'],
                'down_vote' => ['integer'],
                'id_user' => ['integer'],
                'id_vote_parent' => ['integer']
            ]
        )->execute();
    }

    private function setupComment()
    {
        $this->db->dropTableIfExists('comment')->execute();

        return $this->db->createTable(
            'comment',
            [
                'id_comment' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'id_post' => ['integer'],
                'id_user' => ['integer'],
                'created' => ['datetime'],
                'content' => ['text']
            ]
        )->execute();
    }

    private function setupPost()
    {
        $this->db->dropTableIfExists('post')->execute();

        return $this->db->createTable(
            'post',
            [
                'id_post' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'question' => ['integer'],
                'content' => ['integer'],
                'created' => ['integer'],
                'id_user' => ['integer'],
                'accepted' => ['integer']
            ]
        )->execute();
    }


}
