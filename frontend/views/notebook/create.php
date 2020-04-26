<?php
/* @var $this yii\web\View */
/* @var $notebook frontend\models\Notebook */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Новая запись</h1>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($notebook, 'name'); ?>

    <?php echo $form->field($notebook, 'phone'); ?>

    <?php echo $form->field($notebook, 'email'); ?>

    <?php echo Html::submitButton('Добавить', [
        'class' => 'btn btn-primary',
    ]); ?>

<?php ActiveForm::end(); ?>
