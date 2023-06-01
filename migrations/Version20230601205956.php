<?php

declare(strict_types=1);

namespace doctrine_migration_versions;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601205956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD operator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638584598A3 FOREIGN KEY (operator_id) REFERENCES operator (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638584598A3 ON contact (operator_id)');
        $this->addSql('ALTER TABLE plant ADD site_id INT NOT NULL, ADD supervisor_id INT NOT NULL');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D72F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D7219E9AC5F FOREIGN KEY (supervisor_id) REFERENCES operator (id)');
        $this->addSql('CREATE INDEX IDX_AB030D72F6BD1646 ON plant (site_id)');
        $this->addSql('CREATE INDEX IDX_AB030D7219E9AC5F ON plant (supervisor_id)');
        $this->addSql('ALTER TABLE site ADD address_id INT NOT NULL');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_694309E4F5B7AF75 ON site (address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D72F6BD1646');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D7219E9AC5F');
        $this->addSql('DROP INDEX IDX_AB030D72F6BD1646 ON plant');
        $this->addSql('DROP INDEX IDX_AB030D7219E9AC5F ON plant');
        $this->addSql('ALTER TABLE plant DROP site_id, DROP supervisor_id');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_694309E4F5B7AF75 ON site');
        $this->addSql('ALTER TABLE site DROP address_id');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638584598A3');
        $this->addSql('DROP INDEX IDX_4C62E638584598A3 ON contact');
        $this->addSql('ALTER TABLE contact DROP operator_id');
    }
}
