<?php
namespace VideoManager\Controller;

use Cake\ORM\TableRegistry;
use VideoManager\Controller\AppController;

/**
 * Api Controller
 *
 * @property \VideoManager\Model\Table\ApiTable $Api
 */
class ApiController extends AppController
{
    public $helpers = ['AppCore.Form', 'DefaultAdminTheme.PanelMenu'];

    public function initialize()
    {
        $this->loadComponent('VideoManager.Embera');
        $this->Videos = TableRegistry::get('VideoManager.Videos');
        $this->layout = 'ajax';
    }
    public function checkUrl()
    {
        $inputUrl = $this->request->data['inputUrl'];

        $urlData = $this->Embera->fetchUrlInfo($inputUrl);
        $this->set('output', json_encode($urlData));
    }

    public function setOrder() {
        $this->autoRender = false;
        if(!$this->request->is('post'))
            throw new ForbiddenException();


        $data = $this->request->data;
        $video = $this->Videos->get($data['video']);

        if(is_numeric($data['order'])) {
            $video->sort_order = $data['order'];
            $this->Videos->save($video);
        }
    }
}
