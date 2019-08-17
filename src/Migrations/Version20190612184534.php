<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612184534 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livre ADD biblio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9956407ABA FOREIGN KEY (biblio_id) REFERENCES biblio (id)');
        $this->addSql('CREATE INDEX IDX_AC634F9956407ABA ON livre (biblio_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9956407ABA');
        $this->addSql('DROP INDEX IDX_AC634F9956407ABA ON livre');
        $this->addSql('ALTER TABLE livre DROP biblio_id');
    }
}
