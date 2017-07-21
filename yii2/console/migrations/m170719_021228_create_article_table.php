<?php
use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170719_021228_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->comment('商品名称'),
            'intro'=>$this->text()->comment('简介'),
            'article_category_id'=>$this->integer()->comment('文章分类id'),
            'sort'=>$this->smallInteger(11)->comment('排序'),
            'status'=>$this->integer()->comment('状态'),
            'create_time'=>$this->integer()->comment('创建时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
