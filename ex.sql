--
-- PostgreSQL database cluster dump
--

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Roles
--

CREATE ROLE main;
ALTER ROLE main WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION BYPASSRLS PASSWORD 'md5573d77b6c3d08052695c807a7021c91f';






\connect template1

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.11
-- Dumped by pg_dump version 11.11

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.11
-- Dumped by pg_dump version 11.11

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: main; Type: DATABASE; Schema: -; Owner: main
--

CREATE DATABASE main WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';


ALTER DATABASE main OWNER TO main;

\connect main

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: activity; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.activity (
    id integer NOT NULL,
    project_id integer NOT NULL,
    developer_id integer NOT NULL,
    skill character varying(255) NOT NULL,
    time_used integer NOT NULL
);


ALTER TABLE public.activity OWNER TO main;

--
-- Name: activity_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.activity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activity_id_seq OWNER TO main;

--
-- Name: developer; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.developer (
    id integer NOT NULL,
    developer_name character varying(255) NOT NULL,
    description text,
    social_network character varying(255) DEFAULT NULL::character varying,
    email character varying(255) DEFAULT NULL::character varying,
    photo_file_name character varying(255) DEFAULT NULL::character varying,
    slug character varying(255)
);


ALTER TABLE public.developer OWNER TO main;

--
-- Name: developer_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.developer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.developer_id_seq OWNER TO main;

--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO main;

--
-- Name: project; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.project (
    id integer NOT NULL,
    project_name character varying(255) NOT NULL,
    description text NOT NULL,
    cover_image_file_name character varying(255) DEFAULT NULL::character varying,
    isPrivate boolean NOT NULL,
    tags character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.project OWNER TO main;

--
-- Name: project_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.project_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.project_id_seq OWNER TO main;

--
-- Name: skill_set; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.skill_set (
    id integer NOT NULL,
    developer_id integer NOT NULL,
    skill character varying(255) NOT NULL,
    percentage integer NOT NULL
);


ALTER TABLE public.skill_set OWNER TO main;

--
-- Name: skill_set_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.skill_set_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.skill_set_id_seq OWNER TO main;

--
-- Data for Name: activity; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.activity (id, project_id, developer_id, skill, time_used) FROM stdin;
3	1	1	design	332
4	2	1	design	100
5	2	2	html	90
6	2	2	css	100
7	2	4	js	200
\.


--
-- Data for Name: developer; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.developer (id, developer_name, description, social_network, email, photo_file_name, slug) FROM stdin;
1	Lin GUO	Sergio Leone (prononcé en italien [ˈsɛrd͡ʒo leˈoːne]a), né le 3 janvier 1929 à Rome et mort le 30 avril 1989 dans la même ville, est un réalisateur et scénariste italien. Figure majeure du western spaghetti (qu'il popularise largement, sans toutefois l'inventer, ni adhérer à l'épithète), il réalise les films Pour une poignée de dollars, Et pour quelques dollars de plus et Le Bon, la Brute et le Truand	twitter, github	lin@mail.com	\N	lin-guo
2	Charly Hassine	df	\N	\N	\N	charly-hassine
4	Blondin Le BON	clint eastwood	\N	\N	\N	blondin-le-bon
5	Le truant	\N	\N	\N	\N	le-truant
6	la brute	\N	\N	\N	\N	la-brute
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20210323195304	2021-03-23 19:54:26	60
DoctrineMigrations\\Version20210324141307	2021-03-24 14:30:13	33
DoctrineMigrations\\Version20210324143416	2021-03-24 14:34:28	29
DoctrineMigrations\\Version20210324145115	2021-03-24 14:54:19	22
DoctrineMigrations\\Version20210324150334	2021-03-24 15:05:26	26
DoctrineMigrations\\Version20210324150635	2021-03-24 15:07:29	20
\.


--
-- Data for Name: project; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.project (id, project_name, description, cover_image_file_name, is_private, tags) FROM stdin;
1	Tea+	un site vitrine d'un salon de thé et qui propose la service click & collect	\N	f	eshop
2	Arène	portfolio de LIn	\N	f	portfolio, symfony
\.


--
-- Data for Name: skill_set; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.skill_set (id, developer_id, skill, percentage) FROM stdin;
4	1	design	10
5	1	php	80
7	1	html	10
\.


--
-- Name: activity_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.activity_id_seq', 7, true);


--
-- Name: developer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.developer_id_seq', 6, true);


--
-- Name: project_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.project_id_seq', 2, true);


--
-- Name: skill_set_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.skill_set_id_seq', 8, true);


--
-- Name: activity activity_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.activity
    ADD CONSTRAINT activity_pkey PRIMARY KEY (id);


--
-- Name: developer developer_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.developer
    ADD CONSTRAINT developer_pkey PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: project project_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.project
    ADD CONSTRAINT project_pkey PRIMARY KEY (id);


--
-- Name: skill_set skill_set_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.skill_set
    ADD CONSTRAINT skill_set_pkey PRIMARY KEY (id);


--
-- Name: idx_1547e83264dd9267; Type: INDEX; Schema: public; Owner: main
--

CREATE INDEX idx_1547e83264dd9267 ON public.skill_set USING btree (developer_id);


--
-- Name: idx_ac74095a166d1f9c; Type: INDEX; Schema: public; Owner: main
--

CREATE INDEX idx_ac74095a166d1f9c ON public.activity USING btree (project_id);


--
-- Name: idx_ac74095a64dd9267; Type: INDEX; Schema: public; Owner: main
--

CREATE INDEX idx_ac74095a64dd9267 ON public.activity USING btree (developer_id);


--
-- Name: uniq_65fb8b9a989d9b62; Type: INDEX; Schema: public; Owner: main
--

CREATE UNIQUE INDEX uniq_65fb8b9a989d9b62 ON public.developer USING btree (slug);


--
-- Name: skill_set fk_1547e83264dd9267; Type: FK CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.skill_set
    ADD CONSTRAINT fk_1547e83264dd9267 FOREIGN KEY (developer_id) REFERENCES public.developer(id);


--
-- Name: activity fk_ac74095a166d1f9c; Type: FK CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.activity
    ADD CONSTRAINT fk_ac74095a166d1f9c FOREIGN KEY (project_id) REFERENCES public.project(id);


--
-- Name: activity fk_ac74095a64dd9267; Type: FK CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.activity
    ADD CONSTRAINT fk_ac74095a64dd9267 FOREIGN KEY (developer_id) REFERENCES public.developer(id);


--
-- PostgreSQL database dump complete
--

\connect postgres

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.11
-- Dumped by pg_dump version 11.11

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database cluster dump complete
--

