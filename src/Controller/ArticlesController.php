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

        /**
         * Tags method is to handle teh new route that was created in the config/routes for searching using specific tags
         * @return void
         */
        public function tags()
        {
            // this should fetch the path parameters that we will use to connect to the tags
            $tags = $this->request->getParam('pass');
            $articles = $this->Articles->finc('tagged', tags: $tags)->all();
            $this->set(compact('articles', 'tags'));
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
            // fetch tags associated with the article and attach them to the view
            $tags = $this->Articles->Tags->find('list')->all();
            $this->set(compact('article', 'tags'));
        }

        public function edit($slug = null)
        {
            $article = $this->Articles->findBySlug($slug)->contain('Tags')->firstOrFail();
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
            // fetch tags associated with the article and attach them to the view
            $tags = $this->Articles->Tags->find('list')->all();
            $this->set(compact('article', 'tags'));
        }

        public function delete($slug)
        {
            $this->request->allowMethod(['post', 'delete']);
            $article = $this->Articles->findBySlug($slug)->firstOrFail();
            if ($this->Articles->delete($article))
            {
                $this->Flash->success(__('The {0} article has been deleted.', $article->title));
                return $this->redirect(['action' => 'index']);
            }
        }
	}
