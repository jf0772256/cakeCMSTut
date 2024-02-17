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
	}
