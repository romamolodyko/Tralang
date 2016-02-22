<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160222000203 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE binding (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_word INT NOT NULL, state INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE words (id INT AUTO_INCREMENT NOT NULL, ru_words VARCHAR(255) NOT NULL, en_words VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users CHANGE name name LONGTEXT NOT NULL, CHANGE email email LONGTEXT NOT NULL, CHANGE password password LONGTEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE binding');
        $this->addSql('DROP TABLE words');
        $this->addSql('ALTER TABLE users CHANGE name name VARCHAR(55) NOT NULL COLLATE latin1_swedish_ci, CHANGE email email VARCHAR(55) NOT NULL COLLATE latin1_swedish_ci, CHANGE password password VARCHAR(55) NOT NULL COLLATE latin1_swedish_ci');
    }
}
