
<ul class="media-list">
    <?php foreach($questions as $question) :?>
    <li class="media">
        <div class="media-left">
            <a href="<?= $this->url->create("question/question/$question->idQuestion")?>">
                <img class="media-object" src="<?=$question->gravatar?>" alt="...">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><?=$question->title?></h4>
            <?=$question->question?>
            <ul class="nav nav-pills">

            <?php foreach($tags as $tag) :?>
                <?php if($tag->idQuestion == $question->idQuestion):?>
                    <li role="presentation"><a class="btn btn-default" href="#" role="button">
                            <?=$tag->tag?></a></li>
                <?php endif;?>
            <?php endforeach; ?>

            </ul>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
<p>Questions</p>
<?php
    var_dump($questions);
?>
<p>tags</p>
<?php
var_dump($tags);
?>
