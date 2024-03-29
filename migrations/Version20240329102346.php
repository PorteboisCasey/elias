<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329102346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, matiere_id INT NOT NULL, les_assistants JSON DEFAULT NULL, sous_matiere VARCHAR(100) NOT NULL, INDEX IDX_94D4687FF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, matiere_id INT DEFAULT NULL, assistant_id INT DEFAULT NULL, date_updated DATE NOT NULL, date_fin_demande DATE NOT NULL, status INT NOT NULL, sous_matiere VARCHAR(50) NOT NULL, INDEX IDX_2694D7A579F37AE5 (id_user_id), INDEX IDX_2694D7A5F46CD258 (matiere_id), INDEX IDX_2694D7A5E05387EF (assistant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(200) NOT NULL, sous_matiere JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_matiere (matiere_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_EB8D372BF46CD258 (matiere_id), INDEX IDX_EB8D372B8F5EA509 (classe_id), PRIMARY KEY(matiere_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, code_salle VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soutien (id INT AUTO_INCREMENT NOT NULL, matiere_id INT NOT NULL, salle_id INT DEFAULT NULL, date_du_soutien DATE NOT NULL, date_updated DATE NOT NULL, description LONGTEXT DEFAULT NULL, sous_matiere VARCHAR(255) NOT NULL, INDEX IDX_99A7D321F46CD258 (matiere_id), INDEX IDX_99A7D321DC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(200) NOT NULL, password VARCHAR(255) NOT NULL, niveau VARCHAR(50) NOT NULL, sexe INT NOT NULL, telephone VARCHAR(100) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', token VARCHAR(255) DEFAULT NULL, username VARCHAR(50) NOT NULL, INDEX IDX_8D93D6498F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687FF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A579F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5E05387EF FOREIGN KEY (assistant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE classe_matiere ADD CONSTRAINT FK_EB8D372BF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_matiere ADD CONSTRAINT FK_EB8D372B8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D321F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D321DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687FF46CD258');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A579F37AE5');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5F46CD258');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5E05387EF');
        $this->addSql('ALTER TABLE classe_matiere DROP FOREIGN KEY FK_EB8D372BF46CD258');
        $this->addSql('ALTER TABLE classe_matiere DROP FOREIGN KEY FK_EB8D372B8F5EA509');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D321F46CD258');
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D321DC304035');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498F5EA509');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE classe_matiere');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE soutien');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
