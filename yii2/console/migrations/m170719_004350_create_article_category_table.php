<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m170719_004350_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->comment('商品名称'),
            'intro'=>$this->text()->comment('简介'),
            'sort'=>$this->smallInteger(11)->comment('排序'),
            'status'=>$this->integer()->comment('状态'),
            
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
