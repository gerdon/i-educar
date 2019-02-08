<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreatePortalComprasEditaisEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            '
                SET default_with_oids = true;

                CREATE SEQUENCE portal.compras_editais_empresa_cod_compras_editais_empresa_seq
                    START WITH 1
                    INCREMENT BY 1
                    MINVALUE 0
                    NO MAXVALUE
                    CACHE 1;

                CREATE TABLE portal.compras_editais_empresa (
                    cod_compras_editais_empresa integer DEFAULT nextval(\'portal.compras_editais_empresa_cod_compras_editais_empresa_seq\'::regclass) NOT NULL,
                    cnpj character varying(20) DEFAULT \'\'::character varying NOT NULL,
                    nm_empresa character varying(255) DEFAULT \'\'::character varying NOT NULL,
                    email character varying(255) DEFAULT \'\'::character varying NOT NULL,
                    data_hora timestamp without time zone NOT NULL,
                    endereco text,
                    ref_sigla_uf character(2),
                    cidade character varying(255),
                    bairro character varying(255),
                    telefone bigint,
                    fax bigint,
                    cep bigint,
                    nome_contato character varying(255),
                    senha character varying(32) DEFAULT \'\'::character varying NOT NULL
                );
                
                ALTER TABLE ONLY portal.compras_editais_empresa
                    ADD CONSTRAINT compras_editais_empresa_pk PRIMARY KEY (cod_compras_editais_empresa);

                SELECT pg_catalog.setval(\'portal.compras_editais_empresa_cod_compras_editais_empresa_seq\', 1, false);
            '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portal.compras_editais_empresa');

        DB::unprepared('DROP SEQUENCE portal.compras_editais_empresa_cod_compras_editais_empresa_seq;');
    }
}