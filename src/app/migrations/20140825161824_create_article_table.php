<?php

use Phinx\Migration\AbstractMigration;

class CreateArticleTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     */
    public function change()
    {
        $table = $this->table('article');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('title', 'string', ['limit' => 250])
            ->addColumn('slug', 'string', ['limit' => 250])
            ->addColumn('content', 'binary')
            ->addColumn('published', 'datetime')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['default' => null])
            ->addColumn('last_modified', 'timestamp')
            ->addIndex('title', ['unique' => true])
            ->addIndex('slug', ['unique' => true])
            ->addForeignKey('user_id', 'user', 'id', ['update' => 'CASCADE', 'delete' => 'CASCADE'])
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