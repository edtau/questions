<?php foreach ($posts as $post) : ?>

    <?php if (isset($post->title)): ?>
        <p>title<?= $post->title ?></p>
        <p>question<?= $post->question ?></p>
        <p>answered<?= $post->answered ?></p>

    <?php else: ?>
        <p>upVote<?= $post->answer ?></p>
    <?php endif; ?>

    <p>upVote<?= $post->upVote ?></p>
    <p>downVote<?= $post->downVote ?></p>
    <p>created<?= $post->created ?></p>
    <p>score<?= $post->score ?></p>
    <p>name<?= $post->name ?></p>
    <p>name<?= $post->gravatar ?></p>

    <?php if (isset($post->idAnswer2Question)): ?>
        <a href="<?= $this->url->create("question/question/$post->idAnswer2Question/comments-answer")?>"
           role="button">Comments1</a>
        <a href="<?= $this->url->create("question/question/$post->idAnswer2Question/comment-answer")?>"
           role="button">Write commen</a>
     <?php else: ?>
        <a href="<?= $this->url->create("question/question/$post->idQuestion/comments-question")?>"
           role="button">Comments</a>
        <a href="<?= $this->url->create("question/question/$post->idQuestion/comment-question")?>"
           role="button">Write comment</a>
    <?php endif; ?>



    <hr/>
<?php endforeach; ?>

