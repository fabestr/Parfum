<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190904081111 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE oder_line');
        $this->addSql('ALTER TABLE orders ADD status VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE oder_line (id INT AUTO_INCREMENT NOT NULL, orders_id INT NOT NULL, parfum_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_E40508E2CECF0658 (parfum_id), INDEX IDX_E40508E2CFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE oder_line ADD CONSTRAINT FK_E40508E2CECF0658 FOREIGN KEY (parfum_id) REFERENCES parfum (id)');
        $this->addSql('ALTER TABLE oder_line ADD CONSTRAINT FK_E40508E2CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders DROP status');
    }
}
