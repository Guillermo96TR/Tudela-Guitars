<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711155511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bass_guitar ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bass_guitar ADD CONSTRAINT FK_908E63C867B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_908E63C867B3B43D ON bass_guitar (users_id)');
        $this->addSql('ALTER TABLE guitars ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE guitars ADD CONSTRAINT FK_65FD897567B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_65FD897567B3B43D ON guitars (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bass_guitar DROP FOREIGN KEY FK_908E63C867B3B43D');
        $this->addSql('DROP INDEX IDX_908E63C867B3B43D ON bass_guitar');
        $this->addSql('ALTER TABLE bass_guitar DROP users_id');
        $this->addSql('ALTER TABLE guitars DROP FOREIGN KEY FK_65FD897567B3B43D');
        $this->addSql('DROP INDEX IDX_65FD897567B3B43D ON guitars');
        $this->addSql('ALTER TABLE guitars DROP users_id');
    }
}
