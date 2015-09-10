<div class="row">
    <div class="col-lg-10">
        <h1 class="page-header">Novo Vídeo</h1>
        <p>Preencha o formulário para cadastrar um novo vídeo.</p>
        <?php
        echo $this->Flash->render();

        echo $this->Form->create($video);

        // echo $this->Form->input('sort_order', ['label' => 'Ordem', 'min' => 1, 'value' => 1]);

        echo $this->Form->input('original_url', ['label' => 'Video URL']);

        echo $this->Form->input('name', ['label' => 'Nome', 'class' => 'wysihtml5']);
        echo $this->Form->textarea('description', ['label' => 'Descrição', 'class' => 'wysihtml5']);
        echo $this->Form->select('gallery_id', $galleriesList, ['label' => 'Galeria']);


        echo $this->Form->checkbox('status', ['label' => 'Ativo']);
        echo $this->Form->submit('Cadastrar', ['class' => 'btn btn-primary']);
        echo $this->Form->end();
        ?>
    </div>
</div>
