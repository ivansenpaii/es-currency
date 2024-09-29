<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240929090538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO \"user\" (id, username, password, roles) VALUES ('617d7efa-fa62-4c58-98d9-fed7da5a1faa', 'admin', '$2y$13$.xR9wH4IpCIcOmXX6hbb1ONnuimw2WemakUwbVcQofH43euovz4iy', '[\"ROLE_USER\", \"ROLE_ADMIN\"]')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
    }
}
