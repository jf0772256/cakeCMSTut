<?php
    /**
     * @var \App\View\AppView $this
     * @var iterable<\App\Model\Entity\Article> $articles
     */
?>

<h1>Articles</h1>

<table>
    <tr>
        <td>Title</td>
        <td>Created</td>
    </tr>
    <?php foreach ($articles as $article): ?>
    <tr>
        <td>
            <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
        </td>
        <td>
            <?= $article->created->format(DATE_RFC850) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
