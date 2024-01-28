<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240101100426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accessoires (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, prix INT NOT NULL, couleur VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accessoires_user (accessoires_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_83506F1D39181887 (accessoires_id), INDEX IDX_83506F1DA76ED395 (user_id), PRIMARY KEY(accessoires_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, commentaire VARCHAR(255) NOT NULL, note VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, number_phone VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes (id INT AUTO_INCREMENT NOT NULL, numberlike INT NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordinateur (id INT AUTO_INCREMENT NOT NULL, commentaires_id INT DEFAULT NULL, likes_id INT DEFAULT NULL, nom VARCHAR(150) NOT NULL, prix INT NOT NULL, taille_ecran VARCHAR(150) DEFAULT NULL, systeme_exploitation VARCHAR(255) DEFAULT NULL, photo_video VARCHAR(150) DEFAULT NULL, batterie VARCHAR(150) DEFAULT NULL, connectivite VARCHAR(150) DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8712E8DB17C4B2B0 (commentaires_id), INDEX IDX_8712E8DB2F23775F (likes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordinateur_categories (ordinateur_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_8A3B725E828317CA (ordinateur_id), INDEX IDX_8A3B725EA21214B7 (categories_id), PRIMARY KEY(ordinateur_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordinateur_user (ordinateur_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5638F85F828317CA (ordinateur_id), INDEX IDX_5638F85FA76ED395 (user_id), PRIMARY KEY(ordinateur_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE smart_phone (id INT AUTO_INCREMENT NOT NULL, likes_id INT DEFAULT NULL, commentaires_id INT DEFAULT NULL, nom VARCHAR(150) NOT NULL, prix INT NOT NULL, taille_ecran VARCHAR(255) NOT NULL, systeme_exploitation VARCHAR(255) DEFAULT NULL, photo_video VARCHAR(150) DEFAULT NULL, batterie VARCHAR(150) DEFAULT NULL, connectivite VARCHAR(150) DEFAULT NULL, image VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_EAA1270E2F23775F (likes_id), INDEX IDX_EAA1270E17C4B2B0 (commentaires_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE smart_phone_categories (smart_phone_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_47802AB917CBC9CB (smart_phone_id), INDEX IDX_47802AB9A21214B7 (categories_id), PRIMARY KEY(smart_phone_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE smart_phone_user (smart_phone_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2E48A38517CBC9CB (smart_phone_id), INDEX IDX_2E48A385A76ED395 (user_id), PRIMARY KEY(smart_phone_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, contact_client_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(150) NOT NULL, last_name VARCHAR(150) NOT NULL, adresse_postale VARCHAR(255) NOT NULL, number_phone VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649771A4A5A (contact_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accessoires_user ADD CONSTRAINT FK_83506F1D39181887 FOREIGN KEY (accessoires_id) REFERENCES accessoires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accessoires_user ADD CONSTRAINT FK_83506F1DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB17C4B2B0 FOREIGN KEY (commentaires_id) REFERENCES commentaires (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB2F23775F FOREIGN KEY (likes_id) REFERENCES likes (id)');
        $this->addSql('ALTER TABLE ordinateur_categories ADD CONSTRAINT FK_8A3B725E828317CA FOREIGN KEY (ordinateur_id) REFERENCES ordinateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordinateur_categories ADD CONSTRAINT FK_8A3B725EA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordinateur_user ADD CONSTRAINT FK_5638F85F828317CA FOREIGN KEY (ordinateur_id) REFERENCES ordinateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordinateur_user ADD CONSTRAINT FK_5638F85FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE smart_phone ADD CONSTRAINT FK_EAA1270E2F23775F FOREIGN KEY (likes_id) REFERENCES likes (id)');
        $this->addSql('ALTER TABLE smart_phone ADD CONSTRAINT FK_EAA1270E17C4B2B0 FOREIGN KEY (commentaires_id) REFERENCES commentaires (id)');
        $this->addSql('ALTER TABLE smart_phone_categories ADD CONSTRAINT FK_47802AB917CBC9CB FOREIGN KEY (smart_phone_id) REFERENCES smart_phone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE smart_phone_categories ADD CONSTRAINT FK_47802AB9A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE smart_phone_user ADD CONSTRAINT FK_2E48A38517CBC9CB FOREIGN KEY (smart_phone_id) REFERENCES smart_phone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE smart_phone_user ADD CONSTRAINT FK_2E48A385A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649771A4A5A FOREIGN KEY (contact_client_id) REFERENCES contact_client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accessoires_user DROP FOREIGN KEY FK_83506F1D39181887');
        $this->addSql('ALTER TABLE accessoires_user DROP FOREIGN KEY FK_83506F1DA76ED395');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB17C4B2B0');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB2F23775F');
        $this->addSql('ALTER TABLE ordinateur_categories DROP FOREIGN KEY FK_8A3B725E828317CA');
        $this->addSql('ALTER TABLE ordinateur_categories DROP FOREIGN KEY FK_8A3B725EA21214B7');
        $this->addSql('ALTER TABLE ordinateur_user DROP FOREIGN KEY FK_5638F85F828317CA');
        $this->addSql('ALTER TABLE ordinateur_user DROP FOREIGN KEY FK_5638F85FA76ED395');
        $this->addSql('ALTER TABLE smart_phone DROP FOREIGN KEY FK_EAA1270E2F23775F');
        $this->addSql('ALTER TABLE smart_phone DROP FOREIGN KEY FK_EAA1270E17C4B2B0');
        $this->addSql('ALTER TABLE smart_phone_categories DROP FOREIGN KEY FK_47802AB917CBC9CB');
        $this->addSql('ALTER TABLE smart_phone_categories DROP FOREIGN KEY FK_47802AB9A21214B7');
        $this->addSql('ALTER TABLE smart_phone_user DROP FOREIGN KEY FK_2E48A38517CBC9CB');
        $this->addSql('ALTER TABLE smart_phone_user DROP FOREIGN KEY FK_2E48A385A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649771A4A5A');
        $this->addSql('DROP TABLE accessoires');
        $this->addSql('DROP TABLE accessoires_user');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE contact_client');
        $this->addSql('DROP TABLE likes');
        $this->addSql('DROP TABLE ordinateur');
        $this->addSql('DROP TABLE ordinateur_categories');
        $this->addSql('DROP TABLE ordinateur_user');
        $this->addSql('DROP TABLE smart_phone');
        $this->addSql('DROP TABLE smart_phone_categories');
        $this->addSql('DROP TABLE smart_phone_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
