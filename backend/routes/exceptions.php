<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

dd('exceptions.php loaded');
return [

    ModelNotFoundException::class => function (NotFoundHttpException $e) {
        $model = class_basename($e->getModel());

        return response()->json([
            'message' => "{$model} не найден",
            'error' => 'ResourceNotFound',
        ], Response::HTTP_NOT_FOUND);
    },

];

