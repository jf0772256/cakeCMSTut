<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    public function index()
    {
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));
    }
    public function view($slug)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post'))
        {
            // populate the article
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->user_id = 1; // is temporary (will be made changes to later)
            if ($this->Articles->save($article))
            {
                $this->Flash->success(__("Your article has been created."));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to save your article.'));
        }
        $this->set('article', $article);
    }
    public function edit($slug)
    {
        $article = $this->Articles->findBySlug()->firstOrFail();
        if ($this->request->is(['post','put']))
        {
            $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article))
            {
                $this->Flash->success(__('The article has been updated successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to complete the update.'));
        }
        $this->set('article', $article);
    }

//    /**
//     * Index method
//     *
//     * @return \Cake\Http\Response|null|void Renders view
//     */
//    public function index()
//    {
//        $query = $this->Articles->find()
//            ->contain(['Users']);
//        $articles = $this->paginate($query);
//
//        $this->set(compact('articles'));
//    }
//
//    /**
//     * View method
//     *
//     * @param string|null $id Article id.
//     * @return \Cake\Http\Response|null|void Renders view
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $article = $this->Articles->get($id, contain: ['Users', 'Tags']);
//        $this->set(compact('article'));
//    }
//
//    /**
//     * Add method
//     *
//     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
//     */
//    public function add()
//    {
//        $article = $this->Articles->newEmptyEntity();
//        if ($this->request->is('post')) {
//            $article = $this->Articles->patchEntity($article, $this->request->getData());
//            if ($this->Articles->save($article)) {
//                $this->Flash->success(__('The article has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The article could not be saved. Please, try again.'));
//        }
//        $users = $this->Articles->Users->find('list', limit: 200)->all();
//        $tags = $this->Articles->Tags->find('list', limit: 200)->all();
//        $this->set(compact('article', 'users', 'tags'));
//    }
//
//    /**
//     * Edit method
//     *
//     * @param string|null $id Article id.
//     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function edit($id = null)
//    {
//        $article = $this->Articles->get($id, contain: ['Tags']);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $article = $this->Articles->patchEntity($article, $this->request->getData());
//            if ($this->Articles->save($article)) {
//                $this->Flash->success(__('The article has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The article could not be saved. Please, try again.'));
//        }
//        $users = $this->Articles->Users->find('list', limit: 200)->all();
//        $tags = $this->Articles->Tags->find('list', limit: 200)->all();
//        $this->set(compact('article', 'users', 'tags'));
//    }
//
//    /**
//     * Delete method
//     *
//     * @param string|null $id Article id.
//     * @return \Cake\Http\Response|null Redirects to index.
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $article = $this->Articles->get($id);
//        if ($this->Articles->delete($article)) {
//            $this->Flash->success(__('The article has been deleted.'));
//        } else {
//            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
//        }
//
//        return $this->redirect(['action' => 'index']);
//    }
}
