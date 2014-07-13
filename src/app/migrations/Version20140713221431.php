<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140713221431 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql(<<<SQL
CREATE TABLE user (
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    username varchar(20) NOT NULL,
    password varchar(128) NOT NULL,
    email varchar(250) NOT NULL,
    created datetime NOT NULL,
    last_modified timestamp NOT NULL,

    PRIMARY KEY (id)
)
Engine=InnoDB;
SQL
);
    }

    public function down(Schema $schema)
    {
        $this->addSql(<<<SQL
DROP TABLE user;
SQL
);
    }
}
