<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Usuarios;
use yii\console\Controller;
use yii\console\ExitCode;

class UsuariosController extends Controller
{
    /**
     * Desbanea a todos los usuarios desbaneables.
     * @return int Exit code
     */
    public function actionDesbanear()
    {
        $usuarios = Usuarios::find()->where('banned_at IS NOT NULL');
        $contador = 0;

        foreach ($usuarios->each() as $usuario) {
            if ($usuario->desbaneable()) {
                if ($usuario->desbanear()) {
                    $contador++;
                }
            }
        }

        echo "Se han desbaneado $contador usuarios\n";

        return ExitCode::OK;
    }
}
