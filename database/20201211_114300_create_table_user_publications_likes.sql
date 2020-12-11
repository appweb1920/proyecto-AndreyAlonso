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

ALTER TABLE publications
    ADD user_id INTEGER,
    ADD CONSTRAINT publications_user_id_fk FOREIGN KEY (user_id) REFERENCES users (id)
        ON UPDATE RESTRICT ON DELETE RESTRICT;