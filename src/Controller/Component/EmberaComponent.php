<?php
namespace VideoManager\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Embera\Embera;
use Cake\Utility\Hash;

/**
 * Embera component
 */
class EmberaComponent extends Component
{
    private $_urlInfo = null;
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Retorna todas as informações da $url.
     * Para saber que tipo de informações são retornadas veja o link.
     * @link http://oembed.com
     * @param string $url A Url cujo queres informações.
     * @return null/array Retorna null se houver erro ao buscar informações sobre a $url. Ou um array com informações sobre a url.
     */
    public function fetchUrlInfo($url, $config = array()){
        if(!empty($config))
            $embera = new Embera($config);
        else
            $embera = new Embera();

        // $embera = new \Embera\Formatter($embera);
        $urlInfo = $embera->getUrlInfo($url);
        $errors = $embera->getErrors();
        if(!empty($urlInfo) and empty($errors)) {
            $this->_urlInfo = $urlInfo;
            return $urlInfo;
        }

        return $errors;
    }

    public function getEmbeddedHtml($url, $config = [])
    {
        if(empty($this->_getUrlInfo()))
            $this->fetchUrlInfo($url, $config);

        $html = Hash::extract($this->_getUrlInfo(), '{s}.html');
        if(empty($html))
            return false;

        return $html[0];
    }

    public function getThumbnail($url, $config = [])
    {
        if(empty($this->_getUrlInfo()))
            $this->fetchUrlInfo($url, $config);

        $thumbnail = Hash::extract($this->_getUrlInfo(), '{s}.thumbnail_url');
        if(empty($thumbnail))
            return false;

        return $thumbnail[0];
    }

    private function _getUrlInfo()
    {
        if(empty($this->_urlInfo))
            return [];
        return $this->_urlInfo;
    }
}
