<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210524192257 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql(
            "CREATE TABLE product (
                id INT AUTO_INCREMENT NOT NULL,
                brand_name VARCHAR(511) DEFAULT NULL,
                name VARCHAR(511) DEFAULT NULL,
                description LONGTEXT DEFAULT NULL,
                price NUMERIC(10, 2) DEFAULT NULL,
                url LONGTEXT DEFAULT NULL,
                external_id LONGTEXT DEFAULT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB"
        );

        $this->addSql(
            "CREATE TABLE product_custom_field (
                id INT AUTO_INCREMENT NOT NULL,
                product_id INT NOT NULL,
                name VARCHAR(511) DEFAULT NULL,
                value LONGTEXT DEFAULT NULL,
                UNIQUE INDEX UNIQ_155C9F5A5E237E06 (name),
                INDEX IDX_155C9F5A4584665A (product_id),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB"
        );

        $this->addSql("ALTER TABLE product_custom_field ADD CONSTRAINT FK_155C9F5A4584665A FOREIGN KEY (product_id) REFERENCES product (id)");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        // TODO: implement
    }
}
