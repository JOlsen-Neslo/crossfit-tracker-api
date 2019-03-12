<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311215557 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE api_token (id INT AUTO_INCREMENT NOT NULL, coach_id INT NOT NULL, token VARCHAR(255) NOT NULL, expires_at DATETIME NOT NULL, INDEX IDX_7BA2F5EB3C105691 (coach_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE athlete (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, member TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(191) NOT NULL, password VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_3F596DCC5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crossfit_class (id INT AUTO_INCREMENT NOT NULL, coach_id INT NOT NULL, date_time DATETIME NOT NULL, duration INT NOT NULL, UNIQUE INDEX UNIQ_F59C00CC3C105691 (coach_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crossfit_class_athlete (crossfit_class_id INT NOT NULL, athlete_id INT NOT NULL, INDEX IDX_730A393174D758E (crossfit_class_id), INDEX IDX_730A3931FE6BCB8B (athlete_id), PRIMARY KEY(crossfit_class_id, athlete_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT FK_7BA2F5EB3C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('ALTER TABLE crossfit_class ADD CONSTRAINT FK_F59C00CC3C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('ALTER TABLE crossfit_class_athlete ADD CONSTRAINT FK_730A393174D758E FOREIGN KEY (crossfit_class_id) REFERENCES crossfit_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crossfit_class_athlete ADD CONSTRAINT FK_730A3931FE6BCB8B FOREIGN KEY (athlete_id) REFERENCES athlete (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE crossfit_class_athlete DROP FOREIGN KEY FK_730A3931FE6BCB8B');
        $this->addSql('ALTER TABLE api_token DROP FOREIGN KEY FK_7BA2F5EB3C105691');
        $this->addSql('ALTER TABLE crossfit_class DROP FOREIGN KEY FK_F59C00CC3C105691');
        $this->addSql('ALTER TABLE crossfit_class_athlete DROP FOREIGN KEY FK_730A393174D758E');
        $this->addSql('DROP TABLE api_token');
        $this->addSql('DROP TABLE athlete');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE crossfit_class');
        $this->addSql('DROP TABLE crossfit_class_athlete');
    }
}
