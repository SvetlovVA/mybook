--
-- PostgreSQL database dump
--

-- Dumped from database version 11.8
-- Dumped by pg_dump version 12.3 (Ubuntu 12.3-1.pgdg19.10+1)

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
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.admin (id, username, roles, password) FROM stdin;
48	admin	["ROLE_ADMIN"]	$argon2id$v=19$m=65536,t=4,p=1$vZeAoot/V93NBLonphiekQ$lxQUmaFLYgTTDjpnuoX/GgB0t/cs/4wOuwNndJ6vEeE
\.


--
-- Data for Name: conference; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.conference (id, city, year, is_international, slug) FROM stdin;
62	Amsterdam	2019	t	amsterdam-2019
63	Paris	2020	f	paris-2020
\.


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.comment (id, conference_id, author, text, email, create_at, photo_filename, state) FROM stdin;
80	62	Fabien	This was a great conference.	fabien@example.com	2020-05-30 11:15:41	\N	published
81	62	Lucas	I think this one is going to be moderated.	lucas@example.com	2020-05-30 11:15:41	\N	submitted
83	63	RreeeQ	qqqq	reeee@mail.ru	2020-05-30 11:36:15	\N	published
\.


--
-- Data for Name: migration_versions; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.migration_versions (version, executed_at) FROM stdin;
20200526194658	2020-05-26 19:50:32
20200528171856	2020-05-28 17:22:28
20200528172351	2020-05-28 17:23:57
20200529164148	2020-05-29 16:43:05
20200530075509	2020-05-30 07:55:59
\.


--
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.admin_id_seq', 48, true);


--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.comment_id_seq', 83, true);


--
-- Name: conference_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.conference_id_seq', 63, true);


--
-- PostgreSQL database dump complete
--

