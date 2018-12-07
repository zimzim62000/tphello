<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181129160128 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE data_model_partner DROP FOREIGN KEY FK_A0FA43CD9393F8FE');
        $this->addSql('ALTER TABLE siteweb_partner_index DROP FOREIGN KEY FK_57DAC171EFB69766');
        $this->addSql('ALTER TABLE siteweb_photo_carousel DROP FOREIGN KEY FK_E3F2296BC1CE5B98');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE siteweb_category DROP FOREIGN KEY FK_A4808562727ACA70');
        $this->addSql('ALTER TABLE siteweb_category DROP FOREIGN KEY FK_A480856279066886');
        $this->addSql('ALTER TABLE siteweb_photo_carousel DROP FOREIGN KEY FK_E3F2296B12469DE2');
        $this->addSql('ALTER TABLE siteweb_product DROP FOREIGN KEY FK_78A7D58E12469DE2');
        $this->addSql('ALTER TABLE data_model_partner DROP FOREIGN KEY FK_A0FA43CDB3AB7E3B');
        $this->addSql('ALTER TABLE data_model_photo DROP FOREIGN KEY FK_D534FBA5B3AB7E3B');
        $this->addSql('ALTER TABLE siteweb_category DROP FOREIGN KEY FK_A48085623CA03E91');
        $this->addSql('ALTER TABLE siteweb_product DROP FOREIGN KEY FK_78A7D58E3CA03E91');
        $this->addSql('ALTER TABLE siteweb_data_model DROP FOREIGN KEY FK_E5B92CCFD79572D9');
        $this->addSql('ALTER TABLE data_model_photo DROP FOREIGN KEY FK_D534FBA57E9E4C8C');
        $this->addSql('ALTER TABLE site_webpartner DROP FOREIGN KEY FK_FF6BFB177E9E4C8C');
        $this->addSql('ALTER TABLE siteweb_article DROP FOREIGN KEY FK_A9D7DF457E9E4C8C');
        $this->addSql('ALTER TABLE siteweb_data_model DROP FOREIGN KEY FK_E5B92CCF20A9D33A');
        $this->addSql('ALTER TABLE siteweb_data_model DROP FOREIGN KEY FK_E5B92CCF321C7CD4');
        $this->addSql('ALTER TABLE siteweb_data_model DROP FOREIGN KEY FK_E5B92CCF5C28CE6');
        $this->addSql('ALTER TABLE siteweb_data_model DROP FOREIGN KEY FK_E5B92CCF9815B45F');
        $this->addSql('ALTER TABLE siteweb_faq DROP FOREIGN KEY FK_22571E97E9E4C8C');
        $this->addSql('ALTER TABLE siteweb_photo_carousel DROP FOREIGN KEY FK_E3F2296B7E9E4C8C');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE siteweb_photo_carousel DROP FOREIGN KEY FK_E3F2296B4584665A');
        $this->addSql('ALTER TABLE siteweb_review DROP FOREIGN KEY FK_45AFFBE9DD7ADDD');
        $this->addSql('CREATE TABLE app_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_88BDF3E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE data_model_partner');
        $this->addSql('DROP TABLE data_model_photo');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE site_webpartner');
        $this->addSql('DROP TABLE siteweb_article');
        $this->addSql('DROP TABLE siteweb_carousel');
        $this->addSql('DROP TABLE siteweb_category');
        $this->addSql('DROP TABLE siteweb_contact');
        $this->addSql('DROP TABLE siteweb_data_model');
        $this->addSql('DROP TABLE siteweb_faq');
        $this->addSql('DROP TABLE siteweb_model');
        $this->addSql('DROP TABLE siteweb_page');
        $this->addSql('DROP TABLE siteweb_partner_index');
        $this->addSql('DROP TABLE siteweb_photo');
        $this->addSql('DROP TABLE siteweb_photo_carousel');
        $this->addSql('DROP TABLE siteweb_product');
        $this->addSql('DROP TABLE siteweb_review');
        $this->addSql('DROP TABLE siteweb_search');
        $this->addSql('DROP TABLE siteweb_user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, phone INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, message TINYTEXT DEFAULT NULL COLLATE utf8_unicode_ci, ip VARCHAR(15) DEFAULT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, object VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE data_model_partner (data_model_id INT NOT NULL, partner_id INT NOT NULL, INDEX IDX_A0FA43CDB3AB7E3B (data_model_id), INDEX IDX_A0FA43CD9393F8FE (partner_id), PRIMARY KEY(data_model_id, partner_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE data_model_photo (data_model_id INT NOT NULL, photo_id INT NOT NULL, INDEX IDX_D534FBA5B3AB7E3B (data_model_id), INDEX IDX_D534FBA57E9E4C8C (photo_id), PRIMARY KEY(data_model_id, photo_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL COLLATE utf8_unicode_ci, object_class VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, field VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci, foreign_key VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci, content LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), INDEX translations_lookup_idx (locale, object_class, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_webpartner (id INT AUTO_INCREMENT NOT NULL, photo_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, INDEX IDX_FF6BFB177E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_article (id INT AUTO_INCREMENT NOT NULL, photo_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, text LONGTEXT NOT NULL COLLATE utf8_unicode_ci, slug VARCHAR(128) NOT NULL COLLATE utf8_unicode_ci, meta_title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, meta_description TEXT NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_A9D7DF45989D9B62 (slug), INDEX IDX_A9D7DF457E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_carousel (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, time INT NOT NULL, activate VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_category (id INT AUTO_INCREMENT NOT NULL, id_data_model INT DEFAULT NULL, root_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, slugTitle VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, breadcrumbs_title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, menu_title VARCHAR(75) NOT NULL COLLATE utf8_unicode_ci, description TEXT NOT NULL COLLATE utf8_unicode_ci, slug VARCHAR(128) NOT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, meta_title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, meta_description TEXT NOT NULL COLLATE utf8_unicode_ci, position INT NOT NULL, UNIQUE INDEX UNIQ_A4808562989D9B62 (slug), UNIQUE INDEX UNIQ_A48085623CA03E91 (id_data_model), INDEX IDX_A480856279066886 (root_id), INDEX IDX_A4808562727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, mail VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, phone VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, city VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, message LONGTEXT NOT NULL COLLATE utf8_unicode_ci, ip VARCHAR(20) DEFAULT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, is_condition TINYINT(1) NOT NULL, condition_text LONGTEXT NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, object VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_data_model (id INT AUTO_INCREMENT NOT NULL, photo1_id INT DEFAULT NULL, photo2_id INT DEFAULT NULL, photo3_id INT DEFAULT NULL, photo4_id INT DEFAULT NULL, model INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, text1 LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, text2 LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, text3 LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, text4 LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, text5 LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, INDEX IDX_E5B92CCF321C7CD4 (photo1_id), INDEX IDX_E5B92CCF20A9D33A (photo2_id), INDEX IDX_E5B92CCF9815B45F (photo3_id), INDEX IDX_E5B92CCF5C28CE6 (photo4_id), INDEX IDX_E5B92CCFD79572D9 (model), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_faq (id INT AUTO_INCREMENT NOT NULL, photo_id INT DEFAULT NULL, question VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, text LONGTEXT NOT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, INDEX IDX_22571E97E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_model (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, type INT NOT NULL, nbPhotos INT NOT NULL, nbText INT NOT NULL, carousel VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_380B8CFD5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, slug VARCHAR(128) NOT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, text LONGTEXT NOT NULL COLLATE utf8_unicode_ci, meta_title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, meta_description TEXT NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_5FE4B863989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_partner_index (id INT AUTO_INCREMENT NOT NULL, id_partner INT DEFAULT NULL, position INT NOT NULL, INDEX IDX_57DAC171EFB69766 (id_partner), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_photo (id INT AUTO_INCREMENT NOT NULL, alt VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description TEXT NOT NULL COLLATE utf8_unicode_ci, slug VARCHAR(128) NOT NULL COLLATE utf8_unicode_ci, extension VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, UNIQUE INDEX UNIQ_FB297A3C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_photo_carousel (id INT AUTO_INCREMENT NOT NULL, photo_id INT DEFAULT NULL, carousel_id INT DEFAULT NULL, category_id INT DEFAULT NULL, product_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description TEXT NOT NULL COLLATE utf8_unicode_ci, alt VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, position INT NOT NULL, INDEX IDX_E3F2296B7E9E4C8C (photo_id), INDEX IDX_E3F2296BC1CE5B98 (carousel_id), INDEX IDX_E3F2296B12469DE2 (category_id), INDEX IDX_E3F2296B4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, id_data_model INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, slug_title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, breadcrumbs_title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, menu_title VARCHAR(75) NOT NULL COLLATE utf8_unicode_ci, description TEXT NOT NULL COLLATE utf8_unicode_ci, slug VARCHAR(128) NOT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, meta_title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, meta_description TEXT NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_78A7D58E989D9B62 (slug), UNIQUE INDEX UNIQ_78A7D58E3CA03E91 (id_data_model), INDEX IDX_78A7D58E12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_review (id INT AUTO_INCREMENT NOT NULL, id_product INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, phone VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, comment VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, mark INT NOT NULL, created_at DATETIME NOT NULL, visible TINYINT(1) NOT NULL, ip_address VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, cookie VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, city VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, is_condition TINYINT(1) NOT NULL, condition_text LONGTEXT NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_45AFFBE9DD7ADDD (id_product), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_search (id INT AUTO_INCREMENT NOT NULL, search VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, ip VARCHAR(15) DEFAULT NULL COLLATE utf8_unicode_ci, createdAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siteweb_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci, username_canonical VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci, email VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci, email_canonical VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL COLLATE utf8_unicode_ci, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_C67DD80A92FC23A8 (username_canonical), UNIQUE INDEX UNIQ_C67DD80AA0D96FBF (email_canonical), UNIQUE INDEX UNIQ_C67DD80AC05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE data_model_partner ADD CONSTRAINT FK_A0FA43CD9393F8FE FOREIGN KEY (partner_id) REFERENCES site_webpartner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE data_model_partner ADD CONSTRAINT FK_A0FA43CDB3AB7E3B FOREIGN KEY (data_model_id) REFERENCES siteweb_data_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE data_model_photo ADD CONSTRAINT FK_D534FBA57E9E4C8C FOREIGN KEY (photo_id) REFERENCES siteweb_photo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE data_model_photo ADD CONSTRAINT FK_D534FBA5B3AB7E3B FOREIGN KEY (data_model_id) REFERENCES siteweb_data_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES siteweb_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES siteweb_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE site_webpartner ADD CONSTRAINT FK_FF6BFB177E9E4C8C FOREIGN KEY (photo_id) REFERENCES siteweb_photo (id)');
        $this->addSql('ALTER TABLE siteweb_article ADD CONSTRAINT FK_A9D7DF457E9E4C8C FOREIGN KEY (photo_id) REFERENCES siteweb_photo (id)');
        $this->addSql('ALTER TABLE siteweb_category ADD CONSTRAINT FK_A48085623CA03E91 FOREIGN KEY (id_data_model) REFERENCES siteweb_data_model (id)');
        $this->addSql('ALTER TABLE siteweb_category ADD CONSTRAINT FK_A4808562727ACA70 FOREIGN KEY (parent_id) REFERENCES siteweb_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE siteweb_category ADD CONSTRAINT FK_A480856279066886 FOREIGN KEY (root_id) REFERENCES siteweb_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE siteweb_data_model ADD CONSTRAINT FK_E5B92CCF20A9D33A FOREIGN KEY (photo2_id) REFERENCES siteweb_photo (id)');
        $this->addSql('ALTER TABLE siteweb_data_model ADD CONSTRAINT FK_E5B92CCF321C7CD4 FOREIGN KEY (photo1_id) REFERENCES siteweb_photo (id)');
        $this->addSql('ALTER TABLE siteweb_data_model ADD CONSTRAINT FK_E5B92CCF5C28CE6 FOREIGN KEY (photo4_id) REFERENCES siteweb_photo (id)');
        $this->addSql('ALTER TABLE siteweb_data_model ADD CONSTRAINT FK_E5B92CCF9815B45F FOREIGN KEY (photo3_id) REFERENCES siteweb_photo (id)');
        $this->addSql('ALTER TABLE siteweb_data_model ADD CONSTRAINT FK_E5B92CCFD79572D9 FOREIGN KEY (model) REFERENCES siteweb_model (id)');
        $this->addSql('ALTER TABLE siteweb_faq ADD CONSTRAINT FK_22571E97E9E4C8C FOREIGN KEY (photo_id) REFERENCES siteweb_photo (id)');
        $this->addSql('ALTER TABLE siteweb_partner_index ADD CONSTRAINT FK_57DAC171EFB69766 FOREIGN KEY (id_partner) REFERENCES site_webpartner (id)');
        $this->addSql('ALTER TABLE siteweb_photo_carousel ADD CONSTRAINT FK_E3F2296B12469DE2 FOREIGN KEY (category_id) REFERENCES siteweb_category (id)');
        $this->addSql('ALTER TABLE siteweb_photo_carousel ADD CONSTRAINT FK_E3F2296B4584665A FOREIGN KEY (product_id) REFERENCES siteweb_product (id)');
        $this->addSql('ALTER TABLE siteweb_photo_carousel ADD CONSTRAINT FK_E3F2296B7E9E4C8C FOREIGN KEY (photo_id) REFERENCES siteweb_photo (id)');
        $this->addSql('ALTER TABLE siteweb_photo_carousel ADD CONSTRAINT FK_E3F2296BC1CE5B98 FOREIGN KEY (carousel_id) REFERENCES siteweb_carousel (id)');
        $this->addSql('ALTER TABLE siteweb_product ADD CONSTRAINT FK_78A7D58E12469DE2 FOREIGN KEY (category_id) REFERENCES siteweb_category (id)');
        $this->addSql('ALTER TABLE siteweb_product ADD CONSTRAINT FK_78A7D58E3CA03E91 FOREIGN KEY (id_data_model) REFERENCES siteweb_data_model (id)');
        $this->addSql('ALTER TABLE siteweb_review ADD CONSTRAINT FK_45AFFBE9DD7ADDD FOREIGN KEY (id_product) REFERENCES siteweb_product (id)');
        $this->addSql('DROP TABLE app_user');
    }
}
