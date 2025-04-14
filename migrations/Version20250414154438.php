<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414154438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E3FEC116F17FD7A5 ON deal
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E3FEC116F784939E ON deal
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E3FEC116BDCE1676 ON deal
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE deal ADD customer_id INT DEFAULT NULL, ADD stage_id INT DEFAULT NULL, DROP customerId, DROP stageId, DROP employeeId
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1169395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (customer_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1162298D193 FOREIGN KEY (stage_id) REFERENCES stage (stage_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1168C03F15C FOREIGN KEY (employee_id) REFERENCES employee (employee_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E3FEC1169395C3F3 ON deal (customer_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E3FEC1162298D193 ON deal (stage_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E3FEC1168C03F15C ON deal (employee_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_5D9F75A1B8C2FD88 ON employee
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE employee CHANGE roleId role_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1D60322AC FOREIGN KEY (role_id) REFERENCES roles (role_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5D9F75A1D60322AC ON employee (role_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1D60322AC
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_5D9F75A1D60322AC ON employee
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE employee CHANGE role_id roleId INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5D9F75A1B8C2FD88 ON employee (roleId)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC1169395C3F3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC1162298D193
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC1168C03F15C
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E3FEC1169395C3F3 ON deal
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E3FEC1162298D193 ON deal
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E3FEC1168C03F15C ON deal
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE deal ADD customerId INT DEFAULT NULL, ADD stageId INT DEFAULT NULL, ADD employeeId INT NOT NULL, DROP customer_id, DROP stage_id
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E3FEC116F17FD7A5 ON deal (customerId)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E3FEC116F784939E ON deal (stageId)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E3FEC116BDCE1676 ON deal (employeeId)
        SQL);
    }
}
