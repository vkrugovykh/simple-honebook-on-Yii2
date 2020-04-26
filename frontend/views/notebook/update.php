<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1>Изменить запись #: <?= $note->id ?> </h1>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($note, 'name'); ?>

    <?php echo $form->field($note, 'phone'); ?>

    <?php echo $form->field($note, 'email'); ?>

    <?php echo Html::submitButton('Сохранить', [
        'class' => 'btn btn-primary',
    ]); ?>

<?php ActiveForm::end(); ?>
