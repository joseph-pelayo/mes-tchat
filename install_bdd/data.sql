<<<<<<< HEAD
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `message`, `date`, `user_id`, `salon_id`) VALUES
(1, 'C\'est le premier message du chat!!!', '2023-03-08 11:34:43.000000', 2, 1),
(2, 'C\'est le deuxième message du chat!!!', '2023-03-08 11:52:24.000000', 3, 1);
COMMIT;

-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`id`, `message_id`, `type_ip`, `data`) VALUES
(1, 1, 2, 'phpto.jpg'),
(4, 2, 4, 'video.mp4');
COMMIT;

INSERT INTO `salon` (`id`, `name`) VALUES
(1, 'Dev Web');
COMMIT;

-- Déchargement des données de la table `type_piece`
--

INSERT INTO `type_piece` (`id`, `libelle`) VALUES
(1, 'document'),
(2, 'photo'),
(3, 'lien youtube'),
(4, 'video');
=======
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `message`, `date`, `user_id`, `salon_id`) VALUES
(1, 'C\'est le premier message du chat!!!', '2023-03-08 11:34:43.000000', 2, 1),
(2, 'C\'est le deuxième message du chat!!!', '2023-03-08 11:52:24.000000', 3, 1);
COMMIT;

-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`id`, `message_id`, `type_ip`, `data`) VALUES
(1, 1, 2, 'phpto.jpg'),
(4, 2, 4, 'video.mp4');
COMMIT;

INSERT INTO `salon` (`id`, `name`) VALUES
(1, 'Dev Web');
COMMIT;

-- Déchargement des données de la table `type_piece`
--

INSERT INTO `type_piece` (`id`, `libelle`) VALUES
(1, 'document'),
(2, 'photo'),
(3, 'lien youtube'),
(4, 'video');
>>>>>>> a37a435a3176cbffa78f8d340d78317860d1de8c
COMMIT;