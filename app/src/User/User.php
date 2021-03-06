<?php
namespace Anax\User;

/**
* Model for Users.
*
*/
class User  extends  \Anax\CDatabaseModel\CDatabaseModel
{
  public function setupUsers(){
    $this->db->dropTableIfExists('user')->execute();

   $this->db->createTable(
       'user',
       [
           'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
           'acronym' => ['varchar(20)', 'unique', 'not null'],
           'email' => ['varchar(80)'],
           'name' => ['varchar(80)'],
           'password' => ['varchar(255)'],
           'created' => ['datetime'],
           'updated' => ['datetime'],
           'deleted' => ['datetime'],
           'active' => ['datetime'],
       ]
   )->execute();

   $this->db->insert(
       'user',
       ['acronym', 'email', 'name', 'password', 'created', 'active']
   );

   $now = gmdate('Y-m-d H:i:s');

   $this->db->execute([
       'admin',
       'admin@dbwebb.se',
       'Administrator',
       password_hash('admin', PASSWORD_DEFAULT),
       $now,
       $now
   ]);

   $this->db->execute([
       'doe',
       'doe@dbwebb.se',
       'John Doe',
       password_hash('doe', PASSWORD_DEFAULT),
       $now,
       $now
   ]);
  }
}
