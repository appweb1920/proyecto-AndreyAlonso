CREATE OR REPLACE FUNCTION fn_delete_response_delete_user_likes() RETURNS TRIGGER
    LANGUAGE plpgsql
AS
$$
BEGIN
    -- SE ELIMINAN LOS REGISTROS DE LA TABLA DE LIKES PERTENECIENTES A LA RESPUESTA A ELIMINAR
    DELETE FROM user_responses_likes WHERE response_id = old.id;
    RETURN old;
END;
$$;

CREATE TRIGGER tg_delete_response_delete_user_likes
    BEFORE DELETE
    ON responses
    FOR EACH ROW
EXECUTE PROCEDURE fn_delete_response_delete_user_likes();
