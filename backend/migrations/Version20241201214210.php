<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241201214210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add book table with uuid';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, isbn VARCHAR(255) DEFAULT NULL, condition_type VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE book');
    }
}
