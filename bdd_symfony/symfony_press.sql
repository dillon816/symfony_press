

--
-- Database: `symfony_press`

-
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(1, 'Symfony', 'symfony'),
(2, 'PHP', 'php'),
(3, 'DevOps', 'devops'),
(4, 'Frontend', 'frontend'),
(5, 'Architecture', 'architecture');

-- Table structure for table `user`


INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`) VALUES
(1, 'dillon@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$.KrxRd.2kgomxnjkQ64ks.oK6xyoHNNvxoBP966IA/qoEs3hy7DVq', 'dillory'),
(4, 'visiteur@gmail.com', '[]', '$2y$13$ODhj7m7OMm/TpoxvR4ewSuqQFcvlTgfyPAmNwmbVgK0/Swg/XfrGG', 'visiteur'),
(5, 'toto@gmail.com', '[]', '$2y$13$ZsZZTxB35e8fStJvt9SmrOnIERBs3aPvFvLDQbDFWAe.ujMMSUg.6', 'toto'),
(6, 'test42@hotmail.com', '[]', '$2y$13$fdWKkNjyLtPMPUqpeizfBOGUZDBoUtC5PByaPz1pQhy8Ktxr2Yi3O', 'test42'),
(7, 'testnom@gmail.com', '[]', '$2y$13$W2Q7g1h7R.q0qLaa0a0TX.rvG6hgoc/ZT.7NVfdgmuzKVABN1W3iq', 'dillon'),
(8, 'user1@gmail.com', '[]', '$2y$13$UdBs4KQIiqQlm.IYcpvDXu05ga0LaXhBfUpAAa1H4LXFGF6ETGLFW', 'user1'),
(9, 'user2@gmail.com', '[]', '$2y$13$UPZONzLybJz8NyHif/iLSevO2kcXTeZj9ul46DM6AAwwwXDXh.D.2', 'user2'),
(10, 'didi@gmail.com', '[]', '$2y$13$ZZrYm47i6cx/hnTXe49nheVl9Cl5DQkep7ouq/4noiHRaq97G5P4e', 'azag');


INSERT INTO `article` (`id`, `title`, `slug`, `content`, `image`, `created_at`, `category_id`, `author_id`) VALUES
(4, 'dddddddddddddddddddddddddddddd', 'dddddddddddddddddddddddddddddd', 'ddddddddddddddddddddddddddddddddddddddh', 'article_6984dca5f2b900.56602121.png', '2026-02-05 16:36:16', 2, 5),
(7, 'dddddddddddddddddddddddddddddd', 'dddddddddddddddddddddddddddddd-2', 'jhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'article_6985bf560ef300.50378326.png', '2026-02-05 18:07:01', 3, 4),
(8, 'ddddddffffffffff', 'ddddddffffffffff', 'fffffffffffffffffff', 'article_6985c375731378.21557841.png', '2026-02-06 10:33:25', 5, 1),
(9, 'the gottttttttttttt', 'the-gottttttttttttt', 'tttttttttttttttttttttttttttttttttttt', 'article_6985dd96049d20.48261235.png', '2026-02-06 12:24:53', 5, 7),
(10, 'ddddddddddddd', 'ddddddddddddd', 'ddddddddddddddd', NULL, '2026-02-06 13:15:54', 4, 8),
(11, 'modif', 'modif', 'ddddddddddddddddddd', NULL, '2026-02-06 13:17:29', 5, 9),
(12, 'Doctrine et les relationsfezgthrrytjt', 'doctrine-et-les-relationsfezgthrrytjt', 'dddeqgththnnntynytynnt,tyntytntntntyddd', 'article_698600c9956718.08403393.png', '2026-02-06 14:55:05', 3, 10);

-- --------------------------------------------------------