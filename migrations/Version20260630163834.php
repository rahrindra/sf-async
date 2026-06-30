<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260630163834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add email_queue to save the email queue to send later';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE email_queue (id INT AUTO_INCREMENT NOT NULL, recipient VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, template VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, sent_at DATETIME DEFAULT NULL, event VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE email_queue');
    }
}
