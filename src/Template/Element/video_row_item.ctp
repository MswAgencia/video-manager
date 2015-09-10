<?php
echo $this->Form->input('sort_order', ['class' => 'sort-order-input', 'label' => 'Ordem', 'value' => $video->sort_order, 'data-id' => $video->id]);
echo $this->Html->image($video->getThumbnail(), ['width' => 250, 'height' => 250]);
echo $this->Html->link('<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>', "/interno/galeria-de-fotos/{$galleryId}/videos/editar/{$video->id}",['escape' => false, 'class' => 'btn btn-default btn-lg']);
echo $this->Html->link('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', "/interno/galeria-de-fotos/{$galleryId}/videos/remover/{$video->id}",['escape' => false, 'class' => 'btn btn-default btn-lg', 'confirm' => 'Deseja remover o vídeo?']);
?>
