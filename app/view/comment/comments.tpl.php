

<?php foreach ($comments as $comment) : ?>

    <?= $this->di->textFilter->doFilter($comment->comment, 'shortcode, markdown')?>
    <hr/>
<?php endforeach; ?>


