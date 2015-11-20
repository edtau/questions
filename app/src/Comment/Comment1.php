<?php
namespace Anax\Comment;

/**
 * Model for Comments.
 *
 */
class Comment1 extends \Anax\Database\Database
{
    private function populateComments($content, $name, $web, $email, $page)
    {
        $now = gmdate('Y-m-d H:i:s');

        $this->db->execute([
            $content,
            $name,
            $web,
            $email,
            $now,
            $page,
            'gravatar' => get_gravatar($email),
        ]);
    }

    private function createTable()
    {
        $this->db->dropTableIfExists('comments')->execute();
        $this->db->createTable(
            'comments',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'content' => ['text'],
                'name' => ['varchar(80)'],
                'web' => ['varchar(80)'],
                'email' => ['varchar(80)'],
                'created' => ['datetime'],
                'page' => ['varchar(20)'],
                'gravatar' => ['varchar(160)'],
            ]
        )->execute();

        $this->db->insert(
            'comments',
            ['content', 'name', 'web', 'email', 'created', 'page', 'gravatar']
        );

    }

    public function setupComments()
    {
        $this->createTable();
        $this->populateComments("Hello me", "Eddie", "aftonbladet.se", "eddie.taube@gmail.com", "me");
        $this->populateComments("Good bye world ", "Eddie", "sweclockers.se", "eddie.taube@gmail.com", "me");
        $this->populateComments("Hello world me igen", "Eddie", "aftonbladet.se",
            "eddie.taube@gmail.com", "me");
        $this->populateComments("Hello comment återigen", "Eddie", "swedroid.se",
            "eddie.taube@gmail.com", "comment");

        $this->populateComments("Hello comments igen", "Eddie", "aftonbladet.se",
            "eddie.taube@gmail.com", "comment");
    }

}
