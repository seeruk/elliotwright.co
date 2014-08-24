<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140712134255 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql(<<<SQL
CREATE TABLE article (
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    title varchar(250) NOT NULL,
    slug varchar(250) NOT NULL,
    content mediumtext NOT NULL,
    created datetime NOT NULL,
    published datetime NOT NULL,
    last_modified timestamp NOT NULL,

    PRIMARY KEY (id)
)
Engine=InnoDB;

CREATE TABLE category (
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    description varchar(250) NOT NULL,
    last_modified timestamp NOT NULL,

    PRIMARY KEY (id)
)
Engine=InnoDB;

CREATE TABLE articles_categories (
    article_id int UNSIGNED NOT NULL,
    category_id int UNSIGNED NOT NULL,
    last_modified timestamp NOT NULL,

    PRIMARY KEY (article_id, category_id),
    FOREIGN KEY (article_id) REFERENCES article(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES category(id) ON UPDATE CASCADE ON DELETE CASCADE
)
Engine=InnoDB;
SQL
);
    }

    public function down(Schema $schema)
    {
        $this->addSql(<<<SQL
DROP TABLE articles_categories;
DROP TABLE article;
DROP TABLE category;
SQL
);
    }
}
