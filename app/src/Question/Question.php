<?php
namespace Anax\Question;

/**
 * Model for Users.
 *
 */
class Question extends \Anax\Database\Database
{
    public function all(){
        $questions = $this->findAll();
        $questions = $this->test("question");

        $tags = $this->tags();
        //$this->delete(1,"idQuestion");
       return $questions;
    }
    public function tags(){
        $this->db->select("t.*,q2t.*,u.*,q.*")
            ->from('tag as t')
            ->join('question2tag as q2t', 'q2t.idQuestion2tag = t.idTag')
            ->join('user as u', 'u.idUser = t.idUser')
            ->join('question as q', 'q.idQuestion = q2t.idQuestion');
        $res = $this->db->executeFetchAll();
        return $res;
    }
    public function findTagsByQuestion($idQuestion){
        $this->db->select("t.*,q2t.*,u.*,q.*")
            ->from('tag as t')
            ->join('question2tag as q2t', 'q2t.idQuestion2tag = t.idTag')
            ->join('user as u', 'u.idUser = t.idUser')
            ->join('question as q', 'q.idQuestion = q2t.idQuestion')

            ->where('q2t.idQuestion = ?')
        ;
        $res = $this->db->executeFetchAll([$idQuestion]);
        return ($res);
    }
    public function findAnswersToQuestion($idQuestion){
        $this->db->select("a2q.*,m.*,u.*")
            ->from('answer2question as a2q')
            ->join('meta as m', 'm.idMeta = a2q.idMeta')
            ->join('user as u', 'u.idUser = m.idUser')

            ->where('a2q.idQuestion = ?')
         ;
        $res = $this->db->executeFetchAll([$idQuestion]);
        return ($res);
    }





}
