<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181214103054 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE stylist_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prestation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rdv_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE salon_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE stylist (id INT NOT NULL, salon_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4111FFA54C91BDE4 ON stylist (salon_id)');
        $this->addSql('CREATE TABLE user_id (id INT NOT NULL, city_id INT DEFAULT NULL, salon_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(50) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, birthday TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, sex VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A76ED3958BAC62AF ON user_id (city_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A76ED3954C91BDE4 ON user_id (salon_id)');
        $this->addSql('CREATE TABLE prestation (id INT NOT NULL, salon_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_51C88FAD4C91BDE4 ON prestation (salon_id)');
        $this->addSql('CREATE TABLE rdv (id INT NOT NULL, userid_id INT DEFAULT NULL, stylist_id INT DEFAULT NULL, date_start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_end TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_10C31F8658E0A285 ON rdv (userid_id)');
        $this->addSql('CREATE INDEX IDX_10C31F864066877A ON rdv (stylist_id)');
        $this->addSql('CREATE TABLE city (id INT NOT NULL, name VARCHAR(255) NOT NULL, cp VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE salon (id INT NOT NULL, city_id INT NOT NULL, name VARCHAR(255) NOT NULL, phone INT NOT NULL, gps_address VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F268F4178BAC62AF ON salon (city_id)');
        $this->addSql('ALTER TABLE stylist ADD CONSTRAINT FK_4111FFA54C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_id ADD CONSTRAINT FK_A76ED3958BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_id ADD CONSTRAINT FK_A76ED3954C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F8658E0A285 FOREIGN KEY (userid_id) REFERENCES user_id (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F864066877A FOREIGN KEY (stylist_id) REFERENCES stylist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE salon ADD CONSTRAINT FK_F268F4178BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rdv DROP CONSTRAINT FK_10C31F864066877A');
        $this->addSql('ALTER TABLE rdv DROP CONSTRAINT FK_10C31F8658E0A285');
        $this->addSql('ALTER TABLE user_id DROP CONSTRAINT FK_A76ED3958BAC62AF');
        $this->addSql('ALTER TABLE salon DROP CONSTRAINT FK_F268F4178BAC62AF');
        $this->addSql('ALTER TABLE stylist DROP CONSTRAINT FK_4111FFA54C91BDE4');
        $this->addSql('ALTER TABLE user_id DROP CONSTRAINT FK_A76ED3954C91BDE4');
        $this->addSql('ALTER TABLE prestation DROP CONSTRAINT FK_51C88FAD4C91BDE4');
        $this->addSql('DROP SEQUENCE stylist_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prestation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rdv_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE salon_id_seq CASCADE');
        $this->addSql('DROP TABLE stylist');
        $this->addSql('DROP TABLE user_id');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE salon');
    }
}
