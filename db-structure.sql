--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: arena; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE arena (
    id integer NOT NULL,
    name character varying(50),
    city character varying(30),
    adress character varying(50),
    adress_nr character varying(4),
    owner integer,
    zip_code integer
);


ALTER TABLE public.arena OWNER TO brolaugh;

--
-- Name: arena_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE arena_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.arena_id_seq OWNER TO brolaugh;

--
-- Name: arena_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE arena_id_seq OWNED BY arena.id;


--
-- Name: audience; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE audience (
    id integer NOT NULL,
    total integer,
    game_id integer
);


ALTER TABLE public.audience OWNER TO brolaugh;

--
-- Name: audience_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE audience_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.audience_id_seq OWNER TO brolaugh;

--
-- Name: audience_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE audience_id_seq OWNED BY audience.id;


--
-- Name: event_types; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE event_types (
    id integer NOT NULL,
    name character varying(20)
);


ALTER TABLE public.event_types OWNER TO brolaugh;

--
-- Name: event_types_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE event_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.event_types_id_seq OWNER TO brolaugh;

--
-- Name: event_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE event_types_id_seq OWNED BY event_types.id;


--
-- Name: events; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE events (
    id integer NOT NULL,
    type_id integer,
    game_person_link_id integer
);


ALTER TABLE public.events OWNER TO brolaugh;

--
-- Name: events_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE events_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.events_id_seq OWNER TO brolaugh;

--
-- Name: events_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE events_id_seq OWNED BY events.id;


--
-- Name: game; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE game (
    id integer NOT NULL,
    start_time timestamp with time zone,
    home_team_id integer,
    gone_team_id integer,
    status_id integer,
    arena_id integer,
    season_id integer
);


ALTER TABLE public.game OWNER TO brolaugh;

--
-- Name: game_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE game_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.game_id_seq OWNER TO brolaugh;

--
-- Name: game_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE game_id_seq OWNED BY game.id;


--
-- Name: game_person_link; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE game_person_link (
    id integer NOT NULL,
    person_id integer NOT NULL,
    game_id integer NOT NULL
);


ALTER TABLE public.game_person_link OWNER TO brolaugh;

--
-- Name: game_person_link_game_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE game_person_link_game_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.game_person_link_game_id_seq OWNER TO brolaugh;

--
-- Name: game_person_link_game_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE game_person_link_game_id_seq OWNED BY game_person_link.game_id;


--
-- Name: game_person_link_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE game_person_link_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.game_person_link_id_seq OWNER TO brolaugh;

--
-- Name: game_person_link_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE game_person_link_id_seq OWNED BY game_person_link.id;


--
-- Name: game_person_link_person_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE game_person_link_person_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.game_person_link_person_id_seq OWNER TO brolaugh;

--
-- Name: game_person_link_person_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE game_person_link_person_id_seq OWNED BY game_person_link.person_id;


--
-- Name: game_status; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE game_status (
    id integer NOT NULL,
    name integer
);


ALTER TABLE public.game_status OWNER TO brolaugh;

--
-- Name: game_status_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE game_status_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.game_status_id_seq OWNER TO brolaugh;

--
-- Name: game_status_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE game_status_id_seq OWNED BY game_status.id;


--
-- Name: goals; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE goals (
    id integer NOT NULL,
    game_person_link_id integer,
    type integer
);


ALTER TABLE public.goals OWNER TO brolaugh;

--
-- Name: goals_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE goals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.goals_id_seq OWNER TO brolaugh;

--
-- Name: goals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE goals_id_seq OWNED BY goals.id;


--
-- Name: org; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE org (
    id integer NOT NULL,
    name character varying NOT NULL
);


ALTER TABLE public.org OWNER TO brolaugh;

--
-- Name: org_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE org_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.org_id_seq OWNER TO brolaugh;

--
-- Name: org_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE org_id_seq OWNED BY org.id;


--
-- Name: person; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE person (
    id integer NOT NULL,
    fname character varying(30) NOT NULL,
    sname character varying(40) NOT NULL,
    social_sec integer NOT NULL
);


ALTER TABLE public.person OWNER TO brolaugh;

--
-- Name: person_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE person_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.person_id_seq OWNER TO brolaugh;

--
-- Name: person_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE person_id_seq OWNED BY person.id;


--
-- Name: role; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE role (
    id integer NOT NULL,
    name character varying(30) NOT NULL
);


ALTER TABLE public.role OWNER TO brolaugh;

--
-- Name: role_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.role_id_seq OWNER TO brolaugh;

--
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE role_id_seq OWNED BY role.id;


--
-- Name: season; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE season (
    id integer NOT NULL,
    name character varying,
    start_date timestamp with time zone,
    end_date timestamp with time zone
);


ALTER TABLE public.season OWNER TO brolaugh;

--
-- Name: season_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE season_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.season_id_seq OWNER TO brolaugh;

--
-- Name: season_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE season_id_seq OWNED BY season.id;


--
-- Name: team; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE team (
    id integer NOT NULL,
    name character varying,
    org_id integer
);


ALTER TABLE public.team OWNER TO brolaugh;

--
-- Name: team_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE team_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.team_id_seq OWNER TO brolaugh;

--
-- Name: team_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE team_id_seq OWNED BY team.id;


--
-- Name: team_person_link; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE team_person_link (
    id integer NOT NULL,
    joindate timestamp with time zone,
    role_id integer,
    team_id integer,
    person_id integer,
    shirt_nr integer DEFAULT 0
);


ALTER TABLE public.team_person_link OWNER TO brolaugh;

--
-- Name: team_person_link_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE team_person_link_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.team_person_link_id_seq OWNER TO brolaugh;

--
-- Name: team_person_link_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE team_person_link_id_seq OWNED BY team_person_link.id;


--
-- Name: team_season_link; Type: TABLE; Schema: public; Owner: brolaugh; Tablespace: 
--

CREATE TABLE team_season_link (
    id integer NOT NULL,
    season_id integer,
    team_id integer
);


ALTER TABLE public.team_season_link OWNER TO brolaugh;

--
-- Name: team_season_link_id_seq; Type: SEQUENCE; Schema: public; Owner: brolaugh
--

CREATE SEQUENCE team_season_link_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.team_season_link_id_seq OWNER TO brolaugh;

--
-- Name: team_season_link_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brolaugh
--

ALTER SEQUENCE team_season_link_id_seq OWNED BY team_season_link.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY arena ALTER COLUMN id SET DEFAULT nextval('arena_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY audience ALTER COLUMN id SET DEFAULT nextval('audience_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY event_types ALTER COLUMN id SET DEFAULT nextval('event_types_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY events ALTER COLUMN id SET DEFAULT nextval('events_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game ALTER COLUMN id SET DEFAULT nextval('game_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game_person_link ALTER COLUMN id SET DEFAULT nextval('game_person_link_id_seq'::regclass);


--
-- Name: person_id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game_person_link ALTER COLUMN person_id SET DEFAULT nextval('game_person_link_person_id_seq'::regclass);


--
-- Name: game_id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game_person_link ALTER COLUMN game_id SET DEFAULT nextval('game_person_link_game_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game_status ALTER COLUMN id SET DEFAULT nextval('game_status_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY goals ALTER COLUMN id SET DEFAULT nextval('goals_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY org ALTER COLUMN id SET DEFAULT nextval('org_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY person ALTER COLUMN id SET DEFAULT nextval('person_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY role ALTER COLUMN id SET DEFAULT nextval('role_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY season ALTER COLUMN id SET DEFAULT nextval('season_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY team ALTER COLUMN id SET DEFAULT nextval('team_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY team_person_link ALTER COLUMN id SET DEFAULT nextval('team_person_link_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY team_season_link ALTER COLUMN id SET DEFAULT nextval('team_season_link_id_seq'::regclass);


--
-- Name: arena_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY arena
    ADD CONSTRAINT arena_pkey PRIMARY KEY (id);


--
-- Name: audience_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY audience
    ADD CONSTRAINT audience_pkey PRIMARY KEY (id);


--
-- Name: event_types_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY event_types
    ADD CONSTRAINT event_types_pkey PRIMARY KEY (id);


--
-- Name: game_person_link_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY game_person_link
    ADD CONSTRAINT game_person_link_pkey PRIMARY KEY (id);


--
-- Name: game_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY game
    ADD CONSTRAINT game_pkey PRIMARY KEY (id);


--
-- Name: game_status_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY game_status
    ADD CONSTRAINT game_status_pkey PRIMARY KEY (id);


--
-- Name: goals_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY goals
    ADD CONSTRAINT goals_pkey PRIMARY KEY (id);


--
-- Name: org_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY org
    ADD CONSTRAINT org_pkey PRIMARY KEY (id);


--
-- Name: person_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_pkey PRIMARY KEY (id);


--
-- Name: person_social_sec_key; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_social_sec_key UNIQUE (social_sec);


--
-- Name: role_name_key; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY role
    ADD CONSTRAINT role_name_key UNIQUE (name);


--
-- Name: role_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- Name: season_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY season
    ADD CONSTRAINT season_pkey PRIMARY KEY (id);


--
-- Name: team_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY team
    ADD CONSTRAINT team_pkey PRIMARY KEY (id);


--
-- Name: team_season_link_pkey; Type: CONSTRAINT; Schema: public; Owner: brolaugh; Tablespace: 
--

ALTER TABLE ONLY team_season_link
    ADD CONSTRAINT team_season_link_pkey PRIMARY KEY (id);


--
-- Name: arena_owner_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY arena
    ADD CONSTRAINT arena_owner_fkey FOREIGN KEY (owner) REFERENCES org(id);


--
-- Name: audience_game_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY audience
    ADD CONSTRAINT audience_game_id_fkey FOREIGN KEY (game_id) REFERENCES game(id);


--
-- Name: events_game_person_link_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY events
    ADD CONSTRAINT events_game_person_link_id_fkey FOREIGN KEY (game_person_link_id) REFERENCES game_person_link(id);


--
-- Name: events_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY events
    ADD CONSTRAINT events_type_id_fkey FOREIGN KEY (type_id) REFERENCES event_types(id);


--
-- Name: game_arena_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game
    ADD CONSTRAINT game_arena_id_fkey FOREIGN KEY (arena_id) REFERENCES arena(id);


--
-- Name: game_gone_team_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game
    ADD CONSTRAINT game_gone_team_id_fkey FOREIGN KEY (gone_team_id) REFERENCES team(id);


--
-- Name: game_home_team_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game
    ADD CONSTRAINT game_home_team_id_fkey FOREIGN KEY (home_team_id) REFERENCES team(id);


--
-- Name: game_person_link_person_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game_person_link
    ADD CONSTRAINT game_person_link_person_id_fkey FOREIGN KEY (person_id) REFERENCES person(id);


--
-- Name: game_season_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game
    ADD CONSTRAINT game_season_id_fkey FOREIGN KEY (season_id) REFERENCES season(id);


--
-- Name: game_status_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY game
    ADD CONSTRAINT game_status_id_fkey FOREIGN KEY (status_id) REFERENCES game_status(id);


--
-- Name: goals_game_person_link_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY goals
    ADD CONSTRAINT goals_game_person_link_id_fkey FOREIGN KEY (game_person_link_id) REFERENCES game_person_link(id);


--
-- Name: team_org_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY team
    ADD CONSTRAINT team_org_id_fkey FOREIGN KEY (org_id) REFERENCES org(id);


--
-- Name: team_person_link_person_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY team_person_link
    ADD CONSTRAINT team_person_link_person_id_fkey FOREIGN KEY (person_id) REFERENCES person(id);


--
-- Name: team_person_link_role_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY team_person_link
    ADD CONSTRAINT team_person_link_role_id_fkey FOREIGN KEY (role_id) REFERENCES role(id);


--
-- Name: team_person_link_team_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY team_person_link
    ADD CONSTRAINT team_person_link_team_id_fkey FOREIGN KEY (team_id) REFERENCES team(id);


--
-- Name: team_season_link_season_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY team_season_link
    ADD CONSTRAINT team_season_link_season_id_fkey FOREIGN KEY (season_id) REFERENCES season(id);


--
-- Name: team_season_link_team_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: brolaugh
--

ALTER TABLE ONLY team_season_link
    ADD CONSTRAINT team_season_link_team_id_fkey FOREIGN KEY (team_id) REFERENCES team(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

