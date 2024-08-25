<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Registrar';

?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor preencha os seguintes campos para se registrar:</p>

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Nome') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Senha') ?>

        <?= $form->field($model, 'confirm_password')->passwordInput()->label('Confirmar Senha') ?>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
