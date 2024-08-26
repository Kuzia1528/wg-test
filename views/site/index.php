<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row text-center">
            <div class="text-center mt-3 mb-3" id="spinner">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <img id="image" class="text-center mt-3 mb-3" src="" style="display: none;" alt="">
            <p>
                <a class="btn btn-lg btn-danger submit" data-decision="1">Отклонить</a>
                <a class="btn btn-lg btn-success submit" data-decision="2">Одобрить</a>
            </p>
        </div>

    </div>
</div>
