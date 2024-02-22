<?php ?>

<h1>Create Article</h1>

<?= $this->Html->link('Back', ['action' => 'index']); ?>
<?php
    echo $this->Form->create($article);
    // is hardcoded until we build auth methods
    echo $this->Form->control('user_id', ['type'=>'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => 5]);
    echo $this->Form->control('tags._ids', ['options' => $tags]);
    echo $this->Form->button(__('Submit'));
    echo $this->Form->end();
?>
