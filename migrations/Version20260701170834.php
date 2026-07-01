<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260701170834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Delete homemade email_queue table, use the messenger_messages table instead';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE email_queue DROP FOREIGN KEY `FK_E2B03EECA76ED395`');
        $this->addSql('DROP TABLE email_queue');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TABLE email_queue (id INT AUTO_INCREMENT NOT NULL, recipient VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, subject VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, template VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, created_at DATETIME NOT NULL, sent_at DATETIME DEFAULT NULL, event VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, user_id INT DEFAULT NULL, INDEX IDX_E2B03EECA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE email_queue ADD CONSTRAINT `FK_E2B03EECA76ED395` FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
