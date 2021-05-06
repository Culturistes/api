<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505170619 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fun_city_name (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, last_updater_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_C5282DE61220EA6 (creator_id), INDEX IDX_C5282DEA0AA55A (last_updater_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fun_city_name ADD CONSTRAINT FK_C5282DE61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fun_city_name ADD CONSTRAINT FK_C5282DEA0AA55A FOREIGN KEY (last_updater_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');

        $this->addSql('CREATE TABLE fun_city_name_region (fun_city_name_id INT NOT NULL, region_id INT NOT NULL, INDEX IDX_56D0F82D6D861717 (fun_city_name_id), INDEX IDX_56D0F82D98260155 (region_id), PRIMARY KEY(fun_city_name_id, region_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fun_city_name_region ADD CONSTRAINT FK_56D0F82D6D861717 FOREIGN KEY (fun_city_name_id) REFERENCES fun_city_name (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fun_city_name_region ADD CONSTRAINT FK_56D0F82D98260155 FOREIGN KEY (region_id) REFERENCES region (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fun_city_name');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
