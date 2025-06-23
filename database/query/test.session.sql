create table utenti(
    id int primary key AUTO_INCREMENT,
    name varchar(200) not null,
    surname varchar(200) not null,
    username varchar(200) not null UNIQUE,
    email varchar(200) not null UNIQUE,
    password varchar(255) not null,
    ruolo varchar(20) DEFAULT 'utente',
    ultimo_login DATETIME,
    data_creazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    avatar varchar(200) DEFAULT null
);

--@block
create table ruoli(
    id int AUTO_INCREMENT primary key,
    nome varchar(40) not null,
    descrizione TEXT
);

--@block
insert into ruoli(nome, descrizione)
values("utente", "Il ruolo di default per i nuovi utenti, non permette di accedere alle aree riservate");

--@block
insert into ruoli(nome, descrizione)
values("admin", "Il ruolo che permette l'accesso completo al sito");

--@block
alter table utenti drop column ruolo

--@block
alter table utenti add column ruolo int default '1';

--@block
ALTER TABLE utenti ADD CONSTRAINT FK_ruolo FOREIGN KEY (ruolo) REFERENCES ruoli(id);

--@block
CREATE TABLE progetti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(255) NOT NULL,
    descrizione_breve VARCHAR(255) NOT NULL,
    descrizione_completa TEXT NOT NULL,
    data_creazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    stato BOOLEAN DEFAULT TRUE
);

--@block
CREATE TABLE immagini_progetti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    progetto_id INT NOT NULL,
    nome_file VARCHAR(255) NOT NULL,
    percorso_file VARCHAR(255) NOT NULL,
    FOREIGN KEY (progetto_id) REFERENCES progetti(id) ON DELETE CASCADE
);

--@block
ALTER TABLE progetti
ADD CONSTRAINT UQ_titolo UNIQUE (titolo);

--@block
CREATE TABLE progetti_ruoli (
    progetto_id INT NOT NULL,
    ruolo_id INT NOT NULL,
    PRIMARY KEY (progetto_id, ruolo_id),
    FOREIGN KEY (progetto_id) REFERENCES progetti(id) ON DELETE CASCADE,
    FOREIGN KEY (ruolo_id) REFERENCES ruoli(id) ON DELETE CASCADE
);

--@block
ALTER TABLE progetti ADD column(titolo_footer varchar(21) not null);

--@block
INSERT INTO utenti (name, surname, username, email, password, latest_login, data_creazione, avatar, ruolo) VALUES
('Elena', 'Bianchi', 'EllyB_Wanderlust', 'ellyb.wanderlust@example.com', 'elena123', '2025-06-12 10:00:00', '2025-05-20 11:30:00', NULL, 4),
('Marco', 'Rossi', 'MarkoRocks', 'markorocks@example.com', 'marcoPswd', '2025-06-11 14:15:00', '2025-05-22 09:00:00', NULL, 4),
('Sofia', 'Verdi', 'Sofy_Star', 'sofystar@example.com', 'sofiaPass', '2025-06-10 09:30:00', '2025-05-24 16:00:00', NULL, 4),
('Luca', 'Gialli', 'LucaTheGreat', 'lucagreat@example.com', 'luca_Pwd!', '2025-06-09 17:45:00', '2025-05-26 10:00:00', NULL, 4),
('Giulia', 'Neri', 'Giu_Dreamer', 'giu.dreamer@example.com', 'giulia@1', '2025-06-08 11:00:00', '2025-05-28 14:00:00', NULL, 4),
('Andrea', 'Bruno', 'AndyExplorer', 'andyexplorer@example.com', 'Andrea123', '2025-06-07 08:30:00', '2025-05-30 08:30:00', NULL, 4),
('Chiara', 'Rizzo', 'ChiaraSky', 'chiarasky@example.com', 'Chiara_P', '2025-06-06 16:00:00', '2025-06-01 12:00:00', NULL, 4),
('Francesco', 'Conti', 'Frankie_Code', 'frankiecode@example.com', 'frankie1', '2025-06-05 10:45:00', '2025-06-03 09:30:00', NULL, 4),
('Sara', 'Ferrari', 'SassySaraF', 'sassy.sara@example.com', 'saraP@ss', '2025-06-04 13:20:00', '2025-06-05 15:00:00', NULL, 4),
('Alessandro', 'Marini', 'Alex_The_Ace', 'alex.ace@example.com', 'AlexPwd!', '2025-06-03 09:00:00', '2025-06-07 09:00:00', NULL, 4),
('Martina', 'Ricci', 'Marti_Travels', 'marti.travels@example.com', 'martina99', NULL, '2025-05-18 10:00:00', NULL, 4),
('Giovanni', 'Lombardi', 'Gio_Innovate', 'gio.innovate@example.com', 'gioLomb', '2025-06-12 11:30:00', '2025-05-20 09:00:00', NULL, 4),
('Laura', 'Moretti', 'Lau_Writes', 'lau.writes@example.com', 'Laura#22', '2025-06-11 14:00:00', '2025-05-22 13:00:00', NULL, 4),
('Filippo', 'Rinaldi', 'Pippo_Games', 'pippo.games@example.com', 'FilippoP', NULL, '2025-05-24 10:30:00', NULL, 4),
('Alice', 'Bruno', 'WonderAlice', 'wonder.alice@example.com', 'Alice@12', '2025-06-09 16:00:00', '2025-05-27 11:00:00', NULL, 4),
('Matteo', 'Greco', 'Teo_Tech', 'teo.tech@example.com', 'Matteo_23', '2025-06-08 09:45:00', '2025-05-29 14:00:00', NULL, 4),
('Valentina', 'Caruso', 'ValeSunshine', 'vale.sunshine@example.com', 'Valentina!', '2025-06-07 12:00:00', '2025-05-28 12:00:00', NULL, 4),
('Gabriele', 'De Luca', 'Gabe_Art', 'gabe.art@example.com', 'Gabriel#', '2025-06-06 10:10:00', '2025-05-17 08:30:00', NULL, 4),
('Rebecca', 'Russo', 'Reb_Adventures', 'reb.adventures@example.com', 'RebPass', '2025-06-05 15:00:00', '2025-05-21 17:00:00', NULL, 4),
('Simone', 'Ferrari', 'Sim_Musica', 'sim.musica@example.com', 'SimonePwd', '2025-06-04 11:00:00', '2025-05-23 13:30:00', NULL, 4),
('Beatrice', 'Costa', 'Bea_Reads', 'bea.reads@example.com', 'Beatrice@', '2025-06-03 18:00:00', '2025-05-25 09:00:00', NULL, 4),
('Lorenzo', 'Galli', 'Lory_Sport', 'lory.sport@example.com', 'Lory#Pwd', NULL, '2025-05-27 10:00:00', NULL, 4),
('Federica', 'Romano', 'Fede_Glam', 'fede.glam@example.com', 'Fede_P@ss', '2025-06-02 09:00:00', '2025-05-29 11:00:00', NULL, 4),
('Riccardo', 'Colombo', 'Rick_Bytes', 'rick.bytes@example.com', 'Riccardo1', '2025-06-01 14:00:00', '2025-05-30 14:00:00', NULL, 4),
('Anna', 'Marino', 'Anna_Creative', 'anna.creative@example.com', 'Anna@Pwd', '2025-06-12 09:30:00', '2025-05-19 12:00:00', NULL, 4),
('Pietro', 'Giordano', 'Pete_Lens', 'pete.lens@example.com', 'PietroPwd', '2025-06-10 13:00:00', '2025-05-21 10:30:00', NULL, 4),
('Camilla', 'Russo', 'Cami_Cooks', 'cami.cooks@example.com', 'Camilla!', '2025-06-09 16:30:00', '2025-05-23 15:00:00', NULL, 4),
('Davide', 'Mancini', 'Dave_Adven', 'dave.adven@example.com', 'DavideP', '2025-06-08 11:00:00', '2025-05-26 12:00:00', NULL, 4),
('Greta', 'Serra', 'Greta_Artistry', 'greta.artistry@example.com', 'GretaPwd', '2025-06-07 10:00:00', '2025-05-29 10:00:00', NULL, 4),
('Nicola', 'De Santis', 'Nico_Connect', 'nico.connect@example.com', 'Nicola123', '2025-06-06 14:00:00', '2025-05-18 17:00:00', NULL, 4),
('Eleonora', 'Monti', 'Ely_Harmony', 'ely.harmony@example.com', 'Eleonora@', '2025-06-05 09:00:00', '2025-05-20 11:00:00', NULL, 4),
('Angelo', 'Gallo', 'Ange_Thinker', 'ange.thinker@example.com', 'AngeloPwd', '2025-06-04 12:30:00', '2025-05-22 14:00:00', NULL, 4),
('Alessia', 'Vitale', 'Lexi_Vibes', 'lexi.vibes@example.com', 'Alessia#', '2025-06-03 15:00:00', '2025-05-24 16:00:00', NULL, 4),
('Michele', 'Sorrentino', 'Mike_Explore', 'mike.explore@example.com', 'Michele!', '2025-06-02 10:00:00', '2025-05-27 09:00:00', NULL, 4),
('Francesca', 'Riva', 'Fran_Joy', 'fran.joy@example.com', 'FranPwd', '2025-06-01 11:00:00', '2025-05-29 13:00:00', NULL, 4),
('Tommaso', 'Ferri', 'Tommy_Techie', 'tommy.techie@example.com', 'TommyPass', '2025-05-31 14:30:00', '2025-05-31 10:00:00', NULL, 4),
('Silvia', 'Duzioni', 'Silvia_Bloom', 'silvia.bloom@example.com', 'Silvia#2', '2025-05-30 17:00:00', '2025-06-01 17:00:00', NULL, 4),
('Edoardo', 'Gentile', 'Edo_Genius', 'edo.genius@example.com', 'EdoardoP', '2025-05-29 08:30:00', '2025-05-29 08:30:00', NULL, 4),
('Ilaria', 'Barbieri', 'Ila_Wonders', 'ila.wonders@example.com', 'IlariaPwd', '2025-06-12 13:00:00', '2025-05-20 15:00:00', NULL, 4),
('Vincenzo', 'Santi', 'Vince_Codes', 'vince.codes@example.com', 'Vincenzo!', '2025-06-11 10:00:00', '2025-05-22 12:00:00', NULL, 4),
('Giada', 'Leone', 'Giada_Art', 'giada.art@example.com', 'GiadaP@ss', '2025-06-10 11:00:00', '2025-05-24 14:00:00', NULL, 4),
('Christian', 'Mariani', 'Chris_Beats', 'chris.beats@example.com', 'ChrisPwd', '2025-06-09 14:00:00', '2025-05-26 16:00:00', NULL, 4),
('Vanessa', 'Basile', 'Nessa_Glows', 'nessa.glows@example.com', 'Vanessa12', '2025-06-08 16:00:00', '2025-05-29 16:00:00', NULL, 4),
('Mattia', 'Bellini', 'Mattia_Plays', 'mattia.plays@example.com', 'Mattia@', '2025-06-07 09:00:00', '2025-05-17 11:00:00', NULL, 4),
('Giorgia', 'Ferrara', 'Gio_Dreams', 'gio.dreams@example.com', 'GiorgiaPwd', '2025-06-06 10:30:00', '2025-05-19 13:00:00', NULL, 4),
('Fabio', 'Rizzo', 'Fabio_Tech', 'fabio.tech@example.com', 'Fabio_P', '2025-06-05 13:00:00', '2025-05-21 15:00:00', NULL, 4),
('Sofia', 'Palmieri', 'Sofy_Crafts', 'sofy.crafts@example.com', 'SofiaPwd', '2025-06-04 16:00:00', '2025-05-23 09:00:00', NULL, 4),
('Manuel', 'Grassi', 'Manny_Sports', 'manny.sports@example.com', 'Manuel#1', NULL, '2025-05-25 10:00:00', NULL, 4),
('Angela', 'De Angelis', 'Ange_Shine', 'ange.shine@example.com', 'AngelaPwd', '2025-06-03 14:00:00', '2025-05-27 12:00:00', NULL, 4),
('Leonardo', 'Gallo', 'Leo_Sketch', 'leo.sketch@example.com', 'Leonardo!', '2025-06-02 10:00:00', '2025-05-29 09:00:00', NULL, 4);

--@block
ALTER TABLE utenti ADD COLUMN google_id VARCHAR(255) NULL AFTER id;

--@block
ALTER TABLE utenti ADD INDEX idx_google_id (google_id);

--@block
ALTER TABLE utenti MODIFY COLUMN password VARCHAR(255) NULL;

--@block
ALTER TABLE utenti ADD COLUMN auth_provider ENUM('local', 'google', 'apple') DEFAULT 'local' AFTER google_id;

--@block
DESCRIBE utenti;

--@block
SELECT id, username, email, google_id, auth_provider, latest_login 
FROM utenti 
WHERE auth_provider = 'google' 
ORDER BY latest_login DESC;