<?php ?>

<h1>Edit Article</h1>
<?= $this->Html->link('Cancel', ['action' => 'view', $article->slug]); ?>
<?php
    echo $this->Form->create($article);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']);
    echo $this->Form->button(__('Save Article'));
    echo $this->Form->end();
?>
