<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreatePmicontrolesisTopoPortalTable extends Migration
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
                
                CREATE SEQUENCE pmicontrolesis.topo_portal_cod_topo_portal_seq
                    START WITH 1
                    INCREMENT BY 1
                    MINVALUE 0
                    NO MAXVALUE
                    CACHE 1;

                CREATE TABLE pmicontrolesis.topo_portal (
                    cod_topo_portal integer DEFAULT nextval(\'pmicontrolesis.topo_portal_cod_topo_portal_seq\'::regclass) NOT NULL,
                    ref_funcionario_cad integer NOT NULL,
                    ref_funcionario_exc integer,
                    ref_cod_menu_portal integer DEFAULT 0,
                    caminho1 character varying(255),
                    caminho2 character varying(255),
                    caminho3 character varying(255),
                    data_cadastro timestamp without time zone NOT NULL,
                    data_exclusao timestamp without time zone,
                    ativo smallint DEFAULT (1)::smallint NOT NULL
                );
                
                ALTER TABLE ONLY pmicontrolesis.topo_portal
                    ADD CONSTRAINT topo_portal_pkey PRIMARY KEY (cod_topo_portal);

                SELECT pg_catalog.setval(\'pmicontrolesis.topo_portal_cod_topo_portal_seq\', 1, false);
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
        Schema::dropIfExists('pmicontrolesis.topo_portal');

        DB::unprepared('DROP SEQUENCE pmicontrolesis.topo_portal_cod_topo_portal_seq;');
    }
}