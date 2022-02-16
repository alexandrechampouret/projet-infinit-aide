<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216185807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calendrier_demarches ADD related_user_id INT NOT NULL, CHANGE date_deces date_dece DATETIME NOT NULL, CHANGE nom_prenom_deces nom_prenom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE calendrier_demarches ADD CONSTRAINT FK_CFA7A6E898771930 FOREIGN KEY (related_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFA7A6E898771930 ON calendrier_demarches (related_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier_demarches DROP FOREIGN KEY FK_CFA7A6E898771930');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE article CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_path image_path VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE association CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_CFA7A6E898771930 ON calendrier_demarches');
        $this->addSql('ALTER TABLE calendrier_demarches ADD nom_prenom_deces VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP related_user_id, DROP nom_prenom, CHANGE date_dece date_deces DATETIME NOT NULL');
    }
}
