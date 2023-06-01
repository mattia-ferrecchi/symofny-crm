<?php

declare(strict_types=1);

namespace doctrine_migration_versions;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601204452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD company_id INT DEFAULT NULL, ADD is_legal TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_D4E6F81979B1AD6 ON address (company_id)');
        $this->addSql('ALTER TABLE contact ADD company_id INT DEFAULT NULL, ADD is_main TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638E7927C74 ON contact (email)');
        $this->addSql('CREATE INDEX IDX_4C62E638979B1AD6 ON contact (company_id)');
        $this->addSql('ALTER TABLE operator ADD is_main TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE site ADD supervisor_id INT NOT NULL');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E419E9AC5F FOREIGN KEY (supervisor_id) REFERENCES operator (id)');
        $this->addSql('CREATE INDEX IDX_694309E419E9AC5F ON site (supervisor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81979B1AD6');
        $this->addSql('DROP INDEX IDX_D4E6F81979B1AD6 ON address');
        $this->addSql('ALTER TABLE address DROP company_id, DROP is_legal');
        $this->addSql('ALTER TABLE operator DROP is_main');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E419E9AC5F');
        $this->addSql('DROP INDEX IDX_694309E419E9AC5F ON site');
        $this->addSql('ALTER TABLE site DROP supervisor_id');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638979B1AD6');
        $this->addSql('DROP INDEX UNIQ_4C62E638E7927C74 ON contact');
        $this->addSql('DROP INDEX IDX_4C62E638979B1AD6 ON contact');
        $this->addSql('ALTER TABLE contact DROP company_id, DROP is_main');
    }
}
