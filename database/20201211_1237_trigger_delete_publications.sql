CREATE OR REPLACE FUNCTION fn_delete_publication_delete_user_publications_likes() RETURNS TRIGGER
    LANGUAGE plpgsql
AS
$$
BEGIN
    -- SE ELIMINAN LOS REGISTROS DE LA TABLA DE LIKES PERTENECIENTES A LA PUBLICACION A ELIMINAR
    DELETE FROM user_publications_likes WHERE user_publications_likes.publication_id = old.id;
    DELETE FROM responses WHERE publication_id = old.id;
    RETURN old;
END;
$$;

CREATE TRIGGER tg_delete_publication_delete_user_publications_likes
    BEFORE DELETE
    ON publications
    FOR EACH ROW
EXECUTE PROCEDURE fn_delete_publication_delete_user_publications_likes();
