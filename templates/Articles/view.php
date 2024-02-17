<?php ?>


<h1>
    <?= h($article->title) ?>
</h1>

<p>
    <?= h($article->body) ?>
</p>
<p>
    <small>Created: <?= $article->created->format(DATE_RFC850) ?></small>
</p>
<p>
    <?= $this->Html->link('Back', ['action' => 'index']); ?> <span style="margin: 0 0.5rem;"></span> <?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?>
</p>
