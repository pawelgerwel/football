DROP PACKAGE BODY crud;
DROP PACKAGE BODY description;

DROP PACKAGE crud;
DROP PACKAGE description;

CREATE OR REPLACE PACKAGE crud AS
	PROCEDURE insert_country(p_name country.name%TYPE);
	PROCEDURE insert_matchday(p_name matchday.name%TYPE);
	PROCEDURE insert_team(p_name team.name%TYPE, p_city team.city%TYPE, p_stadium team.stadium%TYPE);
	PROCEDURE insert_match(p_matchday_id match.matchday_id%TYPE, p_home_team_id match.home_team_id%TYPE, p_guest_team_id match.guest_team_id%TYPE, p_start_time VARCHAR2);
	PROCEDURE insert_goal(p_match_player_id goal.match_player_id%TYPE, p_minute goal.minute%TYPE, p_is_penalty goal.is_penalty%TYPE, p_is_own goal.is_own%TYPE);
	PROCEDURE insert_coach(p_first_name coach.first_name%TYPE, p_last_name coach.last_name%TYPE, p_country_id coach.country_id%TYPE, p_team_id coach.team_id%TYPE, p_type coach.type%TYPE);
	PROCEDURE insert_player(p_first_name player.first_name%TYPE, p_last_name player.last_name%TYPE, p_country_id player.country_id%TYPE, p_team_id player.team_id%TYPE, p_position player.position%TYPE, p_shirt_number player.shirt_number%TYPE);
	PROCEDURE insert_match_player(p_match_id match_player.match_id%TYPE, p_player_id match_player.player_id%TYPE, p_is_base match_player.is_base%TYPE);
	PROCEDURE insert_substitute(p_in_match_player_id substitute.in_match_player_id%TYPE, p_out_match_player_id substitute.out_match_player_id%TYPE, p_minute substitute.minute%TYPE);
	PROCEDURE insert_card(p_match_player_id card.match_player_id%TYPE, p_minute card.minute%TYPE, p_color card.color%TYPE);
END;
/

CREATE OR REPLACE PACKAGE BODY crud AS
	PROCEDURE insert_country(p_name country.name%TYPE) IS
	BEGIN
		INSERT INTO country (name)
		VALUES (p_name);
	END;

	PROCEDURE insert_matchday(p_name matchday.name%TYPE) IS
	BEGIN
		INSERT INTO matchday (name)
		VALUES (p_name);
	END;

	PROCEDURE insert_team(p_name team.name%TYPE, p_city team.city%TYPE, p_stadium team.stadium%TYPE) IS
	BEGIN
		INSERT INTO team (name, city, stadium)
		VALUES (p_name, p_city, p_stadium);
	END;

	PROCEDURE insert_match(p_matchday_id match.matchday_id%TYPE, p_home_team_id match.home_team_id%TYPE, p_guest_team_id match.guest_team_id%TYPE, p_start_time VARCHAR2) IS
	BEGIN
		INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
		VALUES (p_matchday_id, p_home_team_id, p_guest_team_id, TO_DATE(p_start_time, 'yyyy-mm-dd hh24:mi'));
	END;

	PROCEDURE insert_goal(p_match_player_id goal.match_player_id%TYPE, p_minute goal.minute%TYPE, p_is_penalty goal.is_penalty%TYPE, p_is_own goal.is_own%TYPE) IS
	BEGIN
		INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
		VALUES (p_match_player_id, p_minute, p_is_penalty, p_is_own);
	END;

	PROCEDURE insert_coach(p_first_name coach.first_name%TYPE, p_last_name coach.last_name%TYPE, p_country_id coach.country_id%TYPE, p_team_id coach.team_id%TYPE, p_type coach.type%TYPE) IS
	BEGIN
		INSERT INTO coach (first_name, last_name, country_id, team_id, type)
		VALUES (p_first_name, p_last_name, p_country_id, p_team_id, p_type);
	END;

	PROCEDURE insert_player(p_first_name player.first_name%TYPE, p_last_name player.last_name%TYPE, p_country_id player.country_id%TYPE, p_team_id player.team_id%TYPE, p_position player.position%TYPE, p_shirt_number player.shirt_number%TYPE) IS
	BEGIN
		INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
		VALUES (p_first_name, p_last_name, p_country_id, p_team_id, p_position, p_shirt_number);
	END;

	PROCEDURE insert_match_player(p_match_id match_player.match_id%TYPE, p_player_id match_player.player_id%TYPE, p_is_base match_player.is_base%TYPE) IS
	BEGIN
		INSERT INTO match_player (match_id, player_id, is_base)
		VALUES (p_match_id, p_player_id, p_is_base);
	END;

	PROCEDURE insert_substitute(p_in_match_player_id substitute.in_match_player_id%TYPE, p_out_match_player_id substitute.out_match_player_id%TYPE, p_minute substitute.minute%TYPE) IS
	BEGIN
		INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
		VALUES (p_in_match_player_id, p_out_match_player_id, p_minute);
	END;

	PROCEDURE insert_card(p_match_player_id card.match_player_id%TYPE, p_minute card.minute%TYPE, p_color card.color%TYPE) IS
	BEGIN
		INSERT INTO card (match_player_id, minute, color)
		VALUES (p_match_player_id, p_minute, p_color);
	END;
END;
/

CREATE OR REPLACE PACKAGE description AS
	FUNCTION get_country(p_id country.id%TYPE) RETURN country.name%TYPE;
	FUNCTION get_matchday(p_id matchday.id%TYPE) RETURN matchday.name%TYPE;
	FUNCTION get_team(p_id team.id%TYPE) RETURN team.name%TYPE;
	FUNCTION get_match(p_id match.id%TYPE) RETURN varchar2;
	FUNCTION get_coach(p_id coach.id%TYPE) RETURN varchar2;
	FUNCTION get_player(p_id player.id%TYPE) RETURN varchar2;
	FUNCTION get_match_player(p_id match_player.id%TYPE) RETURN varchar2;
END;
/

CREATE OR REPLACE PACKAGE BODY description AS
	FUNCTION get_country(p_id country.id%TYPE) RETURN country.name%TYPE IS
	r_name country.name%TYPE;
	BEGIN
		SELECT name INTO r_name FROM country WHERE id = p_id;
		RETURN r_name;
	END;

	FUNCTION get_matchday(p_id matchday.id%TYPE) RETURN matchday.name%TYPE IS
	r_name matchday.name%TYPE;
	BEGIN
		SELECT name INTO r_name FROM matchday WHERE id = p_id;
		RETURN r_name;
	END;

	FUNCTION get_team(p_id team.id%TYPE) RETURN team.name%TYPE IS
	r_name team.name%TYPE;
	BEGIN
		SELECT name INTO r_name FROM team WHERE id = p_id;
		RETURN r_name;
	END;

	FUNCTION get_match(p_id match.id%TYPE) RETURN varchar2 IS
	r_desc varchar2(100);
	BEGIN
		SELECT concat(concat(description.get_matchday(matchday_id), ': '), concat(concat(description.get_team(home_team_id), ' - '), description.get_team(guest_team_id))) INTO r_desc FROM match WHERE id = p_id;
		RETURN r_desc;
	END;

	FUNCTION get_coach(p_id coach.id%TYPE) RETURN varchar2 IS
	r_full varchar2(100);
	BEGIN
		SELECT concat(concat(first_name, ' '), last_name) INTO r_full FROM coach WHERE id = p_id;
		RETURN r_full;
	END;

	FUNCTION get_player(p_id player.id%TYPE) RETURN varchar2 IS
	r_full varchar2(100);
	BEGIN
		SELECT concat(concat(first_name, ' '), last_name) INTO r_full FROM player WHERE id = p_id;
		RETURN r_full;
	END;

	FUNCTION get_match_player(p_id match_player.id%TYPE) RETURN varchar2 IS
	r_desc varchar2(100);
	BEGIN
		SELECT concat(concat(description.get_match(match_id), ', '), description.get_player(player_id)) INTO r_desc FROM match_player WHERE id = p_id;
		RETURN r_desc;
	END;
END;
/

CREATE OR REPLACE PACKAGE p_match_player AS
	FUNCTION get_match_id(p_id match_player.id%TYPE) RETURN match_player.match_id%type;
	FUNCTION get_player_id(p_id match_player.id%TYPE) RETURN match_player.player_id%type;
	FUNCTION get_team_id(p_id match_player.id%TYPE) RETURN player.team_id%type;
END;
/

CREATE OR REPLACE PACKAGE BODY p_match_player AS
	FUNCTION get_match_id(p_id match_player.id%TYPE) RETURN match_player.match_id%type IS
	r_id player.team_id%type;
	BEGIN
		SELECT match_id into r_id from match_player where id = p_id;
		RETURN r_id;
	END;

	FUNCTION get_player_id(p_id match_player.id%TYPE) RETURN match_player.player_id%type IS
	r_id player.team_id%type;
	BEGIN
		SELECT player_id into r_id from match_player where id = p_id;
		RETURN r_id;
	END;

	FUNCTION get_team_id(p_id match_player.id%TYPE) RETURN player.team_id%type IS
	r_id player.team_id%type;
	BEGIN
		SELECT team_id into r_id from player where id = p_match_player.get_player_id(p_id);
		RETURN r_id;
	END;
END;
/
