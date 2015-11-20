<ul>
    <?php foreach($tags as $tag) :?>
        <a class="btn btn-default" href="#" role="button"><?=$tag->tag?></a>
        <p><?=$tag->description?></p>
        <p><?=$tag->created?></p>
        <hr/>
    <?php endforeach; ?>

</ul>
<?php
    var_dump($tags);
?>