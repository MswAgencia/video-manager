<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Vídeos Cadastrados <?= $this->Html->link('Cadastrar', '/interno/videos/novo', ['class' => 'btn btn-primary btn-lg']) ?></h1>
        <?php
        echo $this->Flash->render();

        echo $this->Html->tag('table', null, ['class' => 'table stripped table-bordered realties-table']);

        echo $this->Html->tag('thead', $this->Html->tableHeaders(['Nome', 'Url', 'Status', 'Opções']));
        $cells = [];
        foreach($videos as $video){
            $options = [];
            $options[] = $this->Html->link('Excluir', '/interno/videos/excluir/' . $video->id, ['class' => 'btn btn-danger btn-sm', 'confirm' => 'Tem certeza que deseja excluir o vídeo?']);

            $cells[] = [$video->name, $video->original_url, $video->getStatusAsString(), implode(' ', $options)];
        }

        if(!empty($cells))
            echo $this->Html->tableCells($cells);
        else
            echo $this->Flash->render('notice');

        echo $this->Html->tag('/table');
        ?>
    </div>
</div>