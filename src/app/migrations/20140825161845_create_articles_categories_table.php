<?php

use Phinx\Migration\AbstractMigration;

class CreateArticlesCategoriesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     */
    public function change()
    {
        $table = $this->table('articles_categories', [
            'id' => false,
            'primary_key' => [
                'article_id',
                'category_id'
            ]
        ]);

        $table
            ->addColumn('article_id', 'integer')
            ->addColumn('category_id', 'integer')
            ->addColumn('last_modified', 'timestamp')
            ->addForeignKey('article_id', 'article', 'id', ['update' => 'CASCADE', 'delete' => 'CASCADE'])
            ->addForeignKey('category_id', 'category', 'id', ['update' => 'CASCADE', 'delete' => 'CASCADE'])
            ->create();
    }

    /**
     * Migrate Up.
     */
    public function up()
    {
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
    }
}