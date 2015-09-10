<div class="row">
    <div class="col-lg-8">
        <h1>Vídeo: <?= $video->name ?></h1>
        <p>Galeria: <?= $gallery->name ?></p>
        <br>
        <?php
            echo $this->Form->create($video);

            echo $this->Form->input('sort_order', ['label' => 'Ordem', 'min' => 1, 'value' => $video->sort_order]);

            echo $this->Form->input('original_url', ['label' => 'Video URL']);

            echo $this->Form->input('name', ['label' => 'Nome', 'class' => 'wysihtml5']);
            echo $this->Form->textarea('description', ['label' => 'Descrição', 'class' => 'wysihtml5', 'value' => $video->description]);

            echo $this->Form->checkbox('status', ['label' => 'Ativo']);
            echo $this->Form->submit('Editar', ['class' => 'btn btn-primary']);
            echo $this->Form->end();
        ?>
    </div>
</div>
