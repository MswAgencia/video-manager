<h1>Galeria: <?= $gallery->name ?></h1>
<?= $this->Flash->render() ?>
<legend>Adicionar Vídeos</legend>
<?php
echo $this->Form->create($videoEntity, ['url' => "/interno/galeria-de-fotos/{$gallery->id}/videos/novo"]);

echo $this->Form->input('sort_order', ['label' => 'Ordem', 'min' => 1, 'value' => 1]);

echo $this->Form->input('original_url', ['label' => 'Video URL']);

echo $this->Form->input('name', ['label' => 'Nome', 'class' => 'wysihtml5']);
echo $this->Form->textarea('description', ['label' => 'Descrição', 'class' => 'wysihtml5']);

echo $this->Form->checkbox('status', ['label' => 'Ativo']);
echo $this->Form->submit('Cadastrar', ['class' => 'btn btn-primary']);
echo $this->Form->end();
?>
<br>
<legend>Vídeos Adicionados</legend>
<div class="row">
    <?php
        foreach($videos as $video) {
            echo '<div class="col-md-3">';
            echo $this->element('VideoManager.video_row_item', ['video' => $video, 'galleryId' => $gallery->id]);
            echo '</div>';
        }
    ?>
</div>

<script type="text/javascript">
    $(document).on('ready', function (){
        $(this).on('change', '.sort-order-input', function (){
            console.log('called');
            var id = $(this).data('id');
            var order = $(this).val();

            if(order < 1) {
                alert('O número da ordem deve ser maior ou igual a 1.');
                $(this).val(1);
                return false;
            }

            var request = $.post("<?= $this->Url->build('/interno/videos/api/setorder/') ?>", {
                video: id,
                order: order
            });
        });

        $(".sort-order-input").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
</script>