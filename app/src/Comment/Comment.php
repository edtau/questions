<?php
namespace Anax\Comment;

/**
 * Model for Comments.
 *
 */
class Comment extends \Anax\Database\Database
{
     public function findCommentsAnswer($id){
         $this->db->select("c.*,m.*,u.*")
             ->from('comment as c')
             ->join('meta as m', 'm.idMeta = c.idMeta')
             ->join('user as u', 'u.idUser = m.idUser')
            ->where("c.idAnswer = ?")
        ;
         $res = $this->db->executeFetchAll([$id]);
         return $res;
     }
    public function findCommentsQuestion($id){
        $this->db->select("c.*,m.*,u.*")
            ->from('comment as c')
            ->join('meta as m', 'm.idMeta = c.idMeta')
            ->join('user as u', 'u.idUser = m.idUser')
            ->where("c.idQuestion = ?")
        ;
        $res = $this->db->executeFetchAll([$id]);
        return $res;
    }

}
