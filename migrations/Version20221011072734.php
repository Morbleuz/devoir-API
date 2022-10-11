<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221011072734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etablissement_professeur (etablissement_id INT NOT NULL, professeur_id INT NOT NULL, INDEX IDX_23A654E8FF631228 (etablissement_id), INDEX IDX_23A654E8BAB22EE9 (professeur_id), PRIMARY KEY(etablissement_id, professeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etablissement_professeur ADD CONSTRAINT FK_23A654E8FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_professeur ADD CONSTRAINT FK_23A654E8BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement_professeur DROP FOREIGN KEY FK_23A654E8FF631228');
        $this->addSql('ALTER TABLE etablissement_professeur DROP FOREIGN KEY FK_23A654E8BAB22EE9');
        $this->addSql('DROP TABLE etablissement_professeur');
    }
}
