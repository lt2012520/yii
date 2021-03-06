<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m170721_015609_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'tree'=> $this->integer(),
            'lft'=> $this->integer(),
            'fgt'=> $this->integer(),
            'depth'=> $this->integer(),
            'name'=> $this->string(50)->comment('名称'),
            'parent_id'=> $this->integer()->comment('上级分类id'),
            'intro'=> $this->text()->comment('简介'),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}
