<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181213091330 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, stylist_id INT DEFAULT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, INDEX IDX_10C31F8658E0A285 (userid_id), INDEX IDX_10C31F864066877A (stylist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salon (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, name VARCHAR(255) NOT NULL, phone INT NOT NULL, gps_address VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_F268F4178BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_id (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, salon_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(50) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, birthday DATETIME DEFAULT NULL, sex VARCHAR(25) NOT NULL, INDEX IDX_A76ED3958BAC62AF (city_id), UNIQUE INDEX UNIQ_A76ED3954C91BDE4 (salon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stylist (id INT AUTO_INCREMENT NOT NULL, salon_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, INDEX IDX_4111FFA54C91BDE4 (salon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, cp VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, salon_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_51C88FAD4C91BDE4 (salon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F8658E0A285 FOREIGN KEY (userid_id) REFERENCES user_id (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F864066877A FOREIGN KEY (stylist_id) REFERENCES stylist (id)');
        $this->addSql('ALTER TABLE salon ADD CONSTRAINT FK_F268F4178BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE user_id ADD CONSTRAINT FK_A76ED3958BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE user_id ADD CONSTRAINT FK_A76ED3954C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE stylist ADD CONSTRAINT FK_4111FFA54C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_id DROP FOREIGN KEY FK_A76ED3954C91BDE4');
        $this->addSql('ALTER TABLE stylist DROP FOREIGN KEY FK_4111FFA54C91BDE4');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD4C91BDE4');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F8658E0A285');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F864066877A');
        $this->addSql('ALTER TABLE salon DROP FOREIGN KEY FK_F268F4178BAC62AF');
        $this->addSql('ALTER TABLE user_id DROP FOREIGN KEY FK_A76ED3958BAC62AF');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE salon');
        $this->addSql('DROP TABLE user_id');
        $this->addSql('DROP TABLE stylist');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE prestation');
    }
}
