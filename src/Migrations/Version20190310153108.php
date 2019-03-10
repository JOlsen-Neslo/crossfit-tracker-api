<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190310153108 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE athlete (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, member TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crossfit_class (id INT AUTO_INCREMENT NOT NULL, coach_id INT NOT NULL, athletes_id INT NOT NULL, date_time DATETIME NOT NULL, duration INT NOT NULL, UNIQUE INDEX UNIQ_F59C00CC3C105691 (coach_id), INDEX IDX_F59C00CC9DE58C46 (athletes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crossfit_class ADD CONSTRAINT FK_F59C00CC3C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('ALTER TABLE crossfit_class ADD CONSTRAINT FK_F59C00CC9DE58C46 FOREIGN KEY (athletes_id) REFERENCES athlete (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE crossfit_class DROP FOREIGN KEY FK_F59C00CC9DE58C46');
        $this->addSql('DROP TABLE athlete');
        $this->addSql('DROP TABLE crossfit_class');
    }
}
