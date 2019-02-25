<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property int $id
 * @property string $titulo
 * @property string $enlace
 * @property string $cuerpo
 * @property int $categoria_id
 * @property int $usuario_id
 * @property int $movimientos
 * @property string $created_at
 *
 * @property Categorias $categoria
 * @property Usuarios $usuario
 */
class Noticias extends \yii\db\ActiveRecord
{
    public $imagen;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'enlace', 'cuerpo', 'categoria_id', 'usuario_id'], 'required'],
            [['cuerpo'], 'string'],
            [['categoria_id', 'usuario_id'], 'default', 'value' => null],
            [['categoria_id', 'usuario_id', '!movimientos'], 'integer'],
            [['titulo', 'enlace'], 'string', 'max' => 255],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['categoria_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['imagen'], 'file', 'extensions' => 'jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'enlace' => 'Enlace',
            'cuerpo' => 'Cuerpo',
            'categoria_id' => 'Categoria ID',
            'usuario_id' => 'Usuario ID',
            'movimientos' => 'Movimientos',
            'created_at' => 'Created At',
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['imagen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria_id'])->inverseOf('noticias');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('noticias');
    }

    /**
     * Devuelve la URL de la imagen de la noticia.
     * @return ?string La URL de la noticia, o null si no tiene
     */
    public function getUrlImagen()
    {
        return $this->tieneImagen() ? Yii::getAlias('@uploadsUrl/' . $this->id . '.jpg') : null;
    }

    public function tieneImagen()
    {
        return file_exists(Yii::getAlias('@uploads/' . $this->id . '.jpg'));
    }
}
