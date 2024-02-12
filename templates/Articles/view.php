<?php
    /**
     * @var \App\View\AppView         $this
     * @var \App\Model\Entity\Article $article
     */
?>


<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Back', ['action' => 'index']) ?></p>
