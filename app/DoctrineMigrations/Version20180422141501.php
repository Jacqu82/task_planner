<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180422141501 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tasks ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tasks ADD CONSTRAINT FK_50586597A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_50586597A76ED395 ON tasks (user_id)');
        $this->addSql('ALTER TABLE categories ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_3AF34668A76ED395 ON categories (user_id)');
        $this->addSql('ALTER TABLE comments ADD task_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A8DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A8DB60186 ON comments (task_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668A76ED395');
        $this->addSql('DROP INDEX IDX_3AF34668A76ED395 ON categories');
        $this->addSql('ALTER TABLE categories DROP user_id');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A8DB60186');
        $this->addSql('DROP INDEX IDX_5F9E962A8DB60186 ON comments');
        $this->addSql('ALTER TABLE comments DROP task_id');
        $this->addSql('ALTER TABLE tasks DROP FOREIGN KEY FK_50586597A76ED395');
        $this->addSql('DROP INDEX IDX_50586597A76ED395 ON tasks');
        $this->addSql('ALTER TABLE tasks DROP user_id');
    }
}
