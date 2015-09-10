<?php
namespace VideoManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Video Entity.
 */
class Video extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'original_url' => true,
        'sort_order' => true,
        'embedded_url' => true,
        'description' => true,
        'thumbnail_img' => true,
        'status' => true,
        'gallery_id' => true,
        'gallery' => true,
    ];

    public function getStatusAsString()
    {
        switch($this->status) {
            case 1:
                return 'Ativo';
            case 0:
                return 'Inativo';
            default:
                return 'Não definido / Inválido';
        }
    }

    public function getThumbnail()
    {
        if(empty($this->thumbnail_img))
            return false;
        return $this->thumbnail_img;
    }
}
