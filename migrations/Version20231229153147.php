<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231229153147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1043Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1043Platform'."
        );

        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, place VARCHAR(60) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, date DATETIME DEFAULT NULL, is_public TINYINT(1) NOT NULL, nbr_participants SMALLINT DEFAULT NULL, creator_user_id_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1043Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1043Platform'."
        );

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, password_view VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, is_verified TINYINT(1) NOT NULL, username VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1043Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1043Platform'."
        );

        $this->addSql('CREATE TABLE user_profile (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT NOT NULL, age SMALLINT DEFAULT NULL, profile_picture_name VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, description LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, gender VARCHAR(128) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, place VARCHAR(128) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', birtdate DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', UNIQUE INDEX UNIQ_D95AB4055741EEB9 (fk_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1043Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1043Platform'."
        );

        $this->addSql('DROP TABLE activity');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1043Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1043Platform'."
        );

        $this->addSql('DROP TABLE user');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1043Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1043Platform'."
        );

        $this->addSql('DROP TABLE user_profile');
    }
}
