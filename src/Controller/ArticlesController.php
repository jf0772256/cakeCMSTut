<?php

	namespace App\Controller;

	use App\Controller\AppController;

	class ArticlesController extends AppController
	{
        public function index()
        {
            $articles = $this->paginate($this->Articles);
            $this->set(compact('articles'));
        }

        public function view($slug = null)
        {
            $article = $this->Articles->findBySlug($slug)->firstOrFail();
            $this->set(compact('article'));
        }

        public function add()
        {
            $article = $this->Articles->newEmptyEntity();
            if ($this->request->is('post'))
            {
                $article = $this->Articles->patchEntity($article, $this->request->getData());
                // setting this manually to 1 because we dont have the authentication methods in-place yet
                $article->user_id = 1;
                // we will change that later

                if ($this->Articles->save($article))
                {
                    $this->Flash->success(__('Article created successfully.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Unable to save the article.'));
            }
            $this->set('article', $article);
        }

        public function edit($slug = null)
        {
            $article = $this->Articles->findBySlug($slug)->firstOrFail();
            if ($this->request->is(['post','put']))
            {
                $this->Articles->patchEntity($article, $this->request->getData());
                if ($this->Articles->save($article))
                {
                    $this->Flash->success('Updates Saved Successfully.');
                    return $this->redirect(['action' => 'view', $article->slug]);
                }
                $this->Flash->error(__('Unable to save edits.'));
            }
            $this->set('article', $article);
        }
	}
