<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230713123726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610B281BE2E');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610B281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91E12469DE2');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EA76ED395');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E12469DE2 FOREIGN KEY (category_id) REFERENCES trick_category (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610B281BE2E');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610B281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91E12469DE2');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EA76ED395');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E12469DE2 FOREIGN KEY (category_id) REFERENCES trick_category (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
