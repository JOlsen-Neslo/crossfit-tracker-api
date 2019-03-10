<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190310154749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE crossfit_class_athlete (crossfit_class_id INT NOT NULL, athlete_id INT NOT NULL, INDEX IDX_730A393174D758E (crossfit_class_id), INDEX IDX_730A3931FE6BCB8B (athlete_id), PRIMARY KEY(crossfit_class_id, athlete_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crossfit_class_athlete ADD CONSTRAINT FK_730A393174D758E FOREIGN KEY (crossfit_class_id) REFERENCES crossfit_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crossfit_class_athlete ADD CONSTRAINT FK_730A3931FE6BCB8B FOREIGN KEY (athlete_id) REFERENCES athlete (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crossfit_class DROP FOREIGN KEY FK_F59C00CC9DE58C46');
        $this->addSql('DROP INDEX IDX_F59C00CC9DE58C46 ON crossfit_class');
        $this->addSql('ALTER TABLE crossfit_class DROP athletes_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE crossfit_class_athlete');
        $this->addSql('ALTER TABLE crossfit_class ADD athletes_id INT NOT NULL');
        $this->addSql('ALTER TABLE crossfit_class ADD CONSTRAINT FK_F59C00CC9DE58C46 FOREIGN KEY (athletes_id) REFERENCES athlete (id)');
        $this->addSql('CREATE INDEX IDX_F59C00CC9DE58C46 ON crossfit_class (athletes_id)');
    }
}
