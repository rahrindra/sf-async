<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20260630181039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add relation ManytoOne between EmailQueue and User';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE email_queue ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE email_queue ADD CONSTRAINT FK_E2B03EECA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E2B03EECA76ED395 ON email_queue (user_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE email_queue DROP FOREIGN KEY FK_E2B03EECA76ED395');
        $this->addSql('DROP INDEX IDX_E2B03EECA76ED395 ON email_queue');
        $this->addSql('ALTER TABLE email_queue DROP user_id');
    }
}
