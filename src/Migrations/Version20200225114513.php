<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225114513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE employee_skills (employee_id INT NOT NULL, skills_id INT NOT NULL, INDEX IDX_FC00D2E58C03F15C (employee_id), INDEX IDX_FC00D2E57FF61858 (skills_id), PRIMARY KEY(employee_id, skills_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee_skills ADD CONSTRAINT FK_FC00D2E58C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_skills ADD CONSTRAINT FK_FC00D2E57FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee ADD specialite_id INT DEFAULT NULL, ADD cin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A12195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1E9795579 FOREIGN KEY (cin_id) REFERENCES cin (id)');
        $this->addSql('CREATE INDEX IDX_5D9F75A12195E0F0 ON employee (specialite_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1E9795579 ON employee (cin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE employee_skills');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A12195E0F0');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1E9795579');
        $this->addSql('DROP INDEX IDX_5D9F75A12195E0F0 ON employee');
        $this->addSql('DROP INDEX UNIQ_5D9F75A1E9795579 ON employee');
        $this->addSql('ALTER TABLE employee DROP specialite_id, DROP cin_id');
    }
}
