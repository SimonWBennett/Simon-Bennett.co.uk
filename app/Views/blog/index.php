<pre>
    <?php foreach ($posts as $post) : ?>
    <p><?= $post->title ?></p>
    <?php endforeach ?>
    <?= $pager->links() ?>
</pre>