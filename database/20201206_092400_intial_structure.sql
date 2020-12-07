-- Estructura inicial del proyecto The driver blog

CREATE TABLE publications
(
    id         serial            NOT NULL,
    title      varchar(50)       NOT NULL,
    image      text              NOT NULL,
    likes      integer DEFAULT 0 NOT NULL,
    created_at timestamp(0),
    updated_at timestamp(0),
    CONSTRAINT publications_id_pk PRIMARY KEY (id)
);

CREATE TABLE responses
(
    id             serial                NOT NULL,
    description    text                  NOT NULL,
    user_id        integer               NOT NULL,
    publication_id integer               NOT NULL,
    likes          integer DEFAULT 0     NOT NULL,
    is_approved    boolean DEFAULT FALSE NOT NULL,
    created_at     timestamp(0),
    updated_at     timestamp(0),
    CONSTRAINT responses_id_pk PRIMARY KEY (id),
    CONSTRAINT responses_user_id_fk FOREIGN KEY (user_id) REFERENCES users (id)
        ON UPDATE RESTRICT ON DELETE RESTRICT,
    CONSTRAINT responses_publication_id_fk FOREIGN KEY (publication_id) REFERENCES publications (id)
        ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE users
(
    id                serial       NOT NULL,
    name              varchar(255) NOT NULL,
    email             varchar(255) NOT NULL,
    email_verified_at timestamp(0),
    password          varchar(255) NOT NULL,
    remember_token    varchar(100),
    created_at        timestamp(0),
    updated_at        timestamp(0),
    CONSTRAINT responses_id_pk PRIMARY KEY (id),
    CONSTRAINT users_email_unique UNIQUE (email)
);

CREATE TABLE user_responses_likes
(
    id          serial    NOT NULL,
    user_id     INTEGER   NOT NULL,
    response_id INTEGER   NOT NULL,
    created_at  timestamp NOT NULL DEFAULT NOW(),
    updated_at  timestamp,
    CONSTRAINT user_responses_likes_id_pk PRIMARY KEY (id),
    CONSTRAINT user_responses_likes_user_id_fk FOREIGN KEY (user_id) REFERENCES users (id)
        ON UPDATE RESTRICT ON DELETE RESTRICT,
    CONSTRAINT user_responses_likes_response_id_fk FOREIGN KEY (response_id) REFERENCES responses (id)
        ON UPDATE RESTRICT ON DELETE RESTRICT,
    CONSTRAINT user_responses_likes_unique_row UNIQUE (user_id, response_id)
);
