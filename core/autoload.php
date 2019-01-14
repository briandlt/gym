<?php
    spl_autoload_register(function($model){
        $model = strtolower($model);
        if(is_file('models/'.$model.'.model.php'))
            include_once 'models/'.$model.'.model.php';
    });