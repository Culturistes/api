<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210506103453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fun_city_name ADD minigame_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fun_city_name ADD CONSTRAINT FK_C5282DEFFD3A2B4 FOREIGN KEY (minigame_id) REFERENCES minigame (id)');
        $this->addSql('CREATE INDEX IDX_C5282DEFFD3A2B4 ON fun_city_name (minigame_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fun_city_name DROP FOREIGN KEY FK_C5282DEFFD3A2B4');
        $this->addSql('DROP INDEX IDX_C5282DEFFD3A2B4 ON fun_city_name');
        $this->addSql('ALTER TABLE fun_city_name DROP minigame_id');
    }
}
