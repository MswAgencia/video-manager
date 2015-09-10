<?php
namespace VideoManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use VideoManager\Model\Entity\Video;

/**
 * Videos Model
 */
class VideosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('vm_videos');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('Galleries', [
            'foreignKey' => 'gallery_id',
            'joinType' => 'INNER',
            'className' => 'PhotoGallery.Galleries'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('sort_order', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('sort_order');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('thumbnail_img');
            
        $validator
            ->requirePresence('original_url', 'create')
            ->notEmpty('original_url');
            
        $validator
            ->requirePresence('embedded_url', 'create')
            ->notEmpty('embedded_url');
            
        $validator
            ->allowEmpty('description');
            
        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['gallery_id'], 'Galleries'));
        return $rules;
    }

    public function getVideos()
    {
        return $this->find()
            ->all();
    }

    public function getVideosFromGallery($galleryId)
    {
        return $this->find()
            ->where(['Videos.gallery_id' => $galleryId])
            ->order(['Videos.sort_order' => 'ASC'])
            ->all();
    }
}
