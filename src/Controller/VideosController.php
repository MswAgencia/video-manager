<?php
namespace VideoManager\Controller;

use Cake\ORM\Table;
use VideoManager\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Videos Controller
 *
 * @property \VideoManager\Model\Table\VideosTable $Videos
 */
class VideosController extends AppController
{
    public $helpers = ['AppCore.Form', 'DefaultAdminTheme.PanelMenu'];

    public function initialize()
    {
        parent::initialize();
        $this->Videos = TableRegistry::get('VideoManager.Videos');
        $this->Galleries = TableRegistry::get('PhotoGallery.Galleries');
        $this->loadComponent('VideoManager.Embera');
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $data = $this->Videos->getVideos();
        $this->set('videos', $data);
    }

    public function manage($id)
    {
        $gallery = $this->Galleries->getGallery($id);
        $videos = $this->Videos->getVideosFromGallery($gallery->id);
        $this->set('gallery', $gallery);
        $this->set('videos', $videos);
        $this->set('videoEntity', $this->Videos->newEntity());
    }
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($galleryId)
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['gallery_id'] = $galleryId;
            $embeddedUrl = $this->Embera->getEmbeddedHtml($data['original_url']);
            if($embeddedUrl)
                $data['embedded_url'] = $embeddedUrl;
            $thumbnailUrl = $this->Embera->getThumbnail($data['original_url']);
            if($thumbnailUrl)
                $data['thumbnail_img'] = $thumbnailUrl;

            $video = $this->Videos->newEntity($data);

            if ($this->Videos->save($video)) {
                $this->Flash->set('Vídeo salvo.', ['element' => 'alert_success']);
            } else {
                $this->Flash->set('Não foi possível salvar o vídeo. Verifique se a URL é valida.', ['element' => 'alert_danger']);
            }
        }
        return $this->redirect("/interno/galeria-de-fotos/{$galleryId}/videos");
    }

    /**
     * Edit method
     *
     * @param string|null $id Video id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($galleryId, $videoId)
    {
        if ($this->request->is(['post'])) {
            $video = $this->Videos->get($videoId);
            $data = $this->request->data;

            $embeddedUrl = $this->Embera->getEmbeddedHtml($data['original_url']);
            if($embeddedUrl)
                $data['embedded_url'] = $embeddedUrl;

            $thumbnailUrl = $this->Embera->getThumbnail($data['original_url']);
            if($thumbnailUrl)
                $data['thumbnail_img'] = $thumbnailUrl;

            $video = $this->Videos->patchEntity($video,$data);

            if ($this->Videos->save($video)) {
                $this->Flash->set('Vídeo editado.', ['element' => 'alert_success']);
                return $this->redirect("/interno/galeria-de-fotos/{$galleryId}/videos");
            } else {
                $this->Flash->set('Não foi possível editar o vídeo. Verifique se a URL é valida.', ['element' => 'alert_danger']);
            }
        }
        $this->set('video', $this->Videos->get($videoId));
        $this->set('gallery', $this->Galleries->get($galleryId));
    }

    /**
     * Delete method
     *
     * @param string|null $id Video id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($galleryId, $videoId)
    {
        $video = $this->Videos->get($videoId);
        if ($this->Videos->delete($video)) {
            $this->Flash->set('O vídeo foi removido.', ['element' => 'alert_success']);
        } else {
            $this->Flash->set('Não foi possível remover o vídeo.', ['element' => 'alert_danger']);
        }
        return $this->redirect("/interno/galeria-de-fotos/{$galleryId}/videos");
    }
}
