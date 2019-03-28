<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190328074707 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bet DROP FOREIGN KEY FK_FBF0EC9BE48FD905');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CEA3FA723');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CF88A08CD');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(7, 2) NOT NULL, created_at DATETIME NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_product (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, user_order_id INT DEFAULT NULL, quantity INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_8B471AA7A76ED395 (user_id), INDEX IDX_8B471AA74584665A (product_id), INDEX IDX_8B471AA76D128938 (user_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_order (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, price NUMERIC(10, 2) NOT NULL, discount INT NOT NULL, reference VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_product ADD CONSTRAINT FK_8B471AA7A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE user_product ADD CONSTRAINT FK_8B471AA74584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE user_product ADD CONSTRAINT FK_8B471AA76D128938 FOREIGN KEY (user_order_id) REFERENCES user_order (id)');
        $this->addSql('DROP TABLE action_user');
        $this->addSql('DROP TABLE bet');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE team');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_product DROP FOREIGN KEY FK_8B471AA74584665A');
        $this->addSql('ALTER TABLE user_product DROP FOREIGN KEY FK_8B471AA76D128938');
        $this->addSql('CREATE TABLE action_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL, direction VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, position_x INT NOT NULL, position_y INT NOT NULL, INDEX IDX_FB726D47A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bet (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, game_id INT DEFAULT NULL, score_team_a INT NOT NULL, score_team_b INT NOT NULL, date DATETIME NOT NULL, amout INT NOT NULL, INDEX IDX_FBF0EC9BE48FD905 (game_id), INDEX IDX_FBF0EC9BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, team_a_id INT DEFAULT NULL, team_b_id INT DEFAULT NULL, score_team_a INT DEFAULT NULL, score_team_b INT DEFAULT NULL, date DATETIME NOT NULL, rating NUMERIC(5, 3) DEFAULT NULL, INDEX IDX_232B318CF88A08CD (team_b_id), INDEX IDX_232B318CEA3FA723 (team_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, flag VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_C4E0A61F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE action_user ADD CONSTRAINT FK_FB726D47A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9BA76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9BE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CEA3FA723 FOREIGN KEY (team_a_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CF88A08CD FOREIGN KEY (team_b_id) REFERENCES team (id)');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user_product');
        $this->addSql('DROP TABLE user_order');
    }
}
