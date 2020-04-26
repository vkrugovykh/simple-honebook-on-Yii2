<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm; ?>

<div class="site-index">
    <h1>Телефонный справочник</h1>
    <div class="row">
        <?php $form = ActiveForm::begin([
            'action' => ['notebook/create'],
        ]); ?>
        <div class="row">
            <div class="col-sm-3">
            <?php echo $form->field($notebook, 'name', ['options' => ['class' => 'form-group']]); ?>
            </div>
            <div class="col-sm-3">
            <?php echo $form->field($notebook, 'phone', ['options' => ['class' => 'form-group']]); ?>
            </div>
            <div class="col-sm-3">
            <?php echo $form->field($notebook, 'email', ['options' => ['class' => 'form-group']]); ?>
            </div>
            <div class="col-sm-3">
            <?php echo Html::submitButton('Сохранить', [
                'class' => 'btn btn-primary form-control mt-25-desktop',
            ]); ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table id="notebook-main-table" class="table table-hover table-bordered table-striped">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($notes as $note) : ?>
                <tr>
                    <td><?= $note->name; ?></td>
                    <td><?= $note->phone; ?></td>
                    <td><?= $note->email; ?></td>
                    <td>
                        <a href="<?= Url::to(['notebook/update/' . $note->id]) ?>">Изменить</a>
                        <a href="<?= Url::to(['notebook/delete/' . $note->id]) ?>">Удалить</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php $this->registerJs("
    $(document).ready(function () {
        $('#notebook-main-table').DataTable({
            'order': [[0, 'asc']],
            columnDefs: [{
                orderable: false,
                targets: 3
            }],
            'language': {
                'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Russian.json'
            }
        });
    });
", yii\web\View::POS_END); ?>