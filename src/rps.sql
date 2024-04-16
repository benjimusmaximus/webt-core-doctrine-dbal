CREATE DATABASE IF NOT EXISTS RPS
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE RPS;

CREATE TABLE player (
     player_id INTEGER PRIMARY KEY,
     name VARCHAR(50) NOT NULL
);

CREATE TABLE rps_value (
     value_id INTEGER PRIMARY KEY,
     name VARCHAR(50) NOT NULL
);

CREATE TABLE game (
    game_id INTEGER PRIMARY KEY,
    player1 INTEGER,
    player2 INTEGER,
    player1Value INTEGER,
    player2Value INTEGER,
    winner INTEGER,
    date DATETIME
);

ALTER TABLE game ADD FOREIGN KEY (player1) REFERENCES player(player_id) ON DELETE CASCADE;
ALTER TABLE game ADD FOREIGN KEY (player2) REFERENCES player(player_id) ON DELETE CASCADE;
ALTER TABLE game ADD FOREIGN KEY (player1Value) REFERENCES rps_value(value_id) ON DELETE CASCADE;
ALTER TABLE game ADD FOREIGN KEY (player2Value) REFERENCES rps_value(value_id) ON DELETE CASCADE;
ALTER TABLE game ADD FOREIGN KEY (winner) REFERENCES player(player_id) ON DELETE CASCADE;


INSERT INTO player(player_id, name) VALUES
    (1, 'Benjamin Bician'),
    (2, 'Matthias Wagner'),
    (3, 'Anil Kapan'),
    (4, 'Max Mustermann');

INSERT INTO rps_value(value_id, name) VALUES
    (1, 'Rock'),
    (2, 'Paper'),
    (3, 'Scissors');

INSERT INTO game(game_id, player1, player2, player1Value, player2Value, winner, "date") VALUES
    (1, 1, 2, 1, 3, 1, '2024-04-16 08:27:00'),
    (2, 4, 2, 2, 2, null, '2024-04-20 14:45:35'),
    (3, 3, 1, 3, 2, 3, '2024-04-13 00:00:00'),
    (4, 1, 2, 2, 3, 2, '2024-05-01 08:27:00'),
    (5, 4, 3, 1, 1, null, '2020-04-16 18:53:20')


