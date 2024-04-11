<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240411201834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE card (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, card_value_id INTEGER NOT NULL, card_family_id INTEGER NOT NULL, CONSTRAINT FK_161498D340117521 FOREIGN KEY (card_value_id) REFERENCES card_value (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_161498D3B756B53E FOREIGN KEY (card_family_id) REFERENCES card_family (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_161498D340117521 ON card (card_value_id)');
        $this->addSql('CREATE INDEX IDX_161498D3B756B53E ON card (card_family_id)');
        $this->addSql('CREATE TABLE card_family (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(30) NOT NULL)');
        $this->addSql('CREATE TABLE card_value (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, value VARCHAR(30) NOT NULL)');
        $this->addSql('CREATE TABLE game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE game_card (game_id INTEGER NOT NULL, card_id INTEGER NOT NULL, PRIMARY KEY(game_id, card_id), CONSTRAINT FK_FD01F4FFE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FD01F4FF4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_FD01F4FFE48FD905 ON game_card (game_id)');
        $this->addSql('CREATE INDEX IDX_FD01F4FF4ACC9A20 ON game_card (card_id)');
        $this->addSql('CREATE TABLE hand (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, game_id INTEGER NOT NULL, CONSTRAINT FK_2762428FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2762428FE48FD905 ON hand (game_id)');
        $this->addSql('CREATE TABLE hand_card (hand_id INTEGER NOT NULL, card_id INTEGER NOT NULL, PRIMARY KEY(hand_id, card_id), CONSTRAINT FK_D80CF216EDDBB459 FOREIGN KEY (hand_id) REFERENCES hand (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D80CF2164ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D80CF216EDDBB459 ON hand_card (hand_id)');
        $this->addSql('CREATE INDEX IDX_D80CF2164ACC9A20 ON hand_card (card_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE card_family');
        $this->addSql('DROP TABLE card_value');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_card');
        $this->addSql('DROP TABLE hand');
        $this->addSql('DROP TABLE hand_card');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
