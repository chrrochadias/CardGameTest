<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413144751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE hand_family_order (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, hand_id INTEGER NOT NULL, card_family_id INTEGER NOT NULL, position INTEGER NOT NULL, CONSTRAINT FK_6D7E8C5FEDDBB459 FOREIGN KEY (hand_id) REFERENCES hand (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6D7E8C5FB756B53E FOREIGN KEY (card_family_id) REFERENCES card_family (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6D7E8C5FEDDBB459 ON hand_family_order (hand_id)');
        $this->addSql('CREATE INDEX IDX_6D7E8C5FB756B53E ON hand_family_order (card_family_id)');
        $this->addSql('CREATE TABLE hand_value_order (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, hand_id INTEGER NOT NULL, card_value_id INTEGER NOT NULL, position INTEGER NOT NULL, CONSTRAINT FK_FBC7CFD5EDDBB459 FOREIGN KEY (hand_id) REFERENCES hand (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FBC7CFD540117521 FOREIGN KEY (card_value_id) REFERENCES card_value (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_FBC7CFD5EDDBB459 ON hand_value_order (hand_id)');
        $this->addSql('CREATE INDEX IDX_FBC7CFD540117521 ON hand_value_order (card_value_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE hand_family_order');
        $this->addSql('DROP TABLE hand_value_order');
    }
}
