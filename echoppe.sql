-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 03 mai 2023 à 14:34
-- Version du serveur : 8.0.32
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `echoppe`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `nom` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '""'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Ambrée'), (2, 'Blanche'), (3, 'Blonde'), (4, 'Brune'), (5, 'Noire'), (6, 'Rouge'), (7, 'IPA (India Pale Ale)'), (8, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `etat_panier`
--

CREATE TABLE `etat_panier` (
  `id` int NOT NULL,
  `nom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etat_panier`
--

INSERT INTO `etat_panier` (`id`, `nom`) VALUES
(1, 'En cours'),
(2, 'Validé'),
(3, 'Annulé');

-- --------------------------------------------------------

--
-- Structure de la table `livre_or_commentaires`
--

CREATE TABLE `livre_or_commentaires` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commentaire` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NULL',
  `validation` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre_or_commentaires`
--

INSERT INTO `livre_or_commentaires` (`id`, `nom`, `prenom`, `email`, `date`, `commentaire`, `validation`) VALUES
(1, 'Dupont', 'Pierre', 'pierre.dupont@example.com', '2023-04-01 00:00:00', 'Superbe échoppe de bière à Jœuf, je recommande !', b'1'),
(2, 'Martin', 'Claire', 'claire.martin@example.com', '2023-04-05 00:00:00', 'Excellente sélection de bières, personnel accueillant et chaleureux.', b'1'),
(3, 'Leblanc', 'Paul', 'paul.leblanc@example.com', '2023-04-26 16:27:36', 'Ambiance agréable et bières de qualité, vivement la prochaine visite !', b'1'),
(4, 'Bernard', 'Sophie', 'sophie.bernard@example.com', '2023-04-15 00:00:00', 'Meilleur endroit pour déguster des bières artisanales à Jœuf !', b'1'),
(5, 'Simon', 'Julien', 'julien.simon@example.com', '2023-04-20 00:00:00', 'J’ai adoré les bières locales et l’atmosphère conviviale.', b'1');

-- --------------------------------------------------------

--
-- Structure de la table `origines`
--

CREATE TABLE `origines` (
  `id` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `origines`
--

INSERT INTO 
	`origines`(`id`, `nom`) 
VALUES 
	(1,'France'), (2,'Allemagne'), (3,'États-Unis'), (4,'Brésil'), (5,'Russie'), (6,'Mexique'), (7,'Japon'), (8,'Royaume-Uni'), (9,'Pologne'), (10,'Espagne'),
  (11,'Pays-Bas'), (12,'Belgique'), (13,'Ukraine'), (14,'Turquie'), (15,'Canada'), (16,'Australie'), (17,'Chine'), (18,'Italie'), (19,'Vietnam'), (20,'Thaïlande');

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
  `id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_etat_panier` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier_produits`
--

CREATE TABLE `panier_produits` (
  `quantite` int NOT NULL DEFAULT '1',
  `id_paniers` int DEFAULT NULL,
  `id_produit` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int NOT NULL,
  `nom` varchar(48) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '""',
  `degres` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_categories` int DEFAULT NULL,
  `id_origines` int DEFAULT NULL,
  `contenance` int DEFAULT NULL,
  `img` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `degres`, `stock`, `description`, `id_categories`, `id_origines`, `contenance`, `img`, `prix`) VALUES
(1, 'Kwak Rouge', 8.00, 21, 'En 1982, Ivo Bosteels, le sixième de la génération Bosteels mettait au point la recette de la Kwak Ambrée. La popularité de la bière Kwak n&#039;est plus à prouver, tout le monde l&#039;a déjà dégusté ou au moins remarqué dans son célèbre &quot;verre à cocher&quot; tenu par son support en bois. La gamme s&#039;étend aujourd&#039;hui avec de nouvelles créations mais toujours autant de gourmandise.\r\n\r\nCette Kwak Rouge se veut fidèle à la qualité et à l&#039;authenticité de la brasserie. Elle se révèle à travers une belle robe rouge surmontée d&#039;une fine couche de mousse. Au nez, on y découvre des arômes de fruits rouges, de cerise. En bouche, elle se révèle par une belle rondeur, de la puissance et des arômes de cerises et d&#039;amande.\r\n\r\nCette bière rouge saura vous combler !', 6, 3, 33, 'KwakRouge-644fc298855a8.webp', 2.30),
(2, 'ERDINGER DUNKEL', 5.00, 1, 'Depuis plus de 130 ans, la brasserie Erdinger basée en Bavière promeut une bière de blé de qualité. L&#039;ensemble de la gamme est brassé exclusivement à Erding depuis 1886. La bière Erdinger Dunkel respecte comme les autres bières de la gamme la loi de pureté. Cela signifie que cette Weissbier n&#039;est façonnée qu&#039;à partir d&#039;eau de source de malt, de houblon et de levure.\r\n\r\nCette bière brune est coiffée d&#039;une mousse épaisse et brillante de couleur crème. Au nez, on peut relever des arômes torréfiés, de chocolat noir ainsi que d&#039;arômes légèrement fruités. Enfin en bouche, on retrouve des notes de pain de campagne frais, un subtil goût de noisette et une fine amertume.\r\n\r\nCette bière a un réel équilibre entre légèreté, douceur et agréable fraîcheur.', 4, 2, 50, 'ERDINGERDUNKEL-644fc1ddb280f.webp', 2.50),
(3, 'VAL DIEU GRAND CRU', 11.00, 7, 'Les bières brassées au sein même de l’Abbaye du Val-Dieu sont inspirées des recettes originales des moines de la communauté chrétienne installée ici depuis 1216. Les siècles d’expérience donnent aujourd’hui naissance à des bières sophistiquées et toujours plus élaborées. Tradition oblige, l’élaboration se fait sans ajout d’épices ou d’aromates.\r\n\r\nLa Val-Dieu Grand Cru c’est la bière brune de dégustation par excellence ! Une Quadrupel à l’étonnante robe marron et aux reflets rougeoyants. De séduisants arômes grillés, de chocolat, de malt et de Porto. Des saveurs étonnantes de caramel, café et de noix.\r\n\r\nN’auriez-vous pas trouvé la recette miracle pour sublimer vos dîners entourés de vos proches ?', 4, 3, 75, 'VALDIEUGRANDCRU-6452a348c4c09.webp', 2.20),
(4, 'PIÑA COLADA WHEAT', 5.00, 0, 'Mont Hardi, la brasserie du groupe V and B, continue ses expérimentations éphémères sur sa base de bière blanche. Après la &quot;Pili Pili Bang Bang&quot; au piment et la &quot;There Will Be Blood Orange&quot; à l&#039;orange sanguine, voici la Piña Colada Wheat.\r\n\r\nComme le nom le laisse présager, cette bière blanche sur base de witbier est brassée avec de la purée d&#039;ananas, de l&#039;ananas frais et de la noix de coco râpée.\r\n\r\nSa robe blonde très pâle et trouble se couvre d&#039;une fine mousse blanche très fugace. Une fois le nez plongé dans le verre,nous découvrons des arômes caractéristiques d&#039;une bière blanche belge. Les levures travaillent et laissent derrière elles leurs esters aux notes de banane et d&#039;épices. Les odeurs d&#039;agrumes traditionnelles d&#039;une witbier sont ici remplacées par un ananas gourmand et une noix de coco qui se développe en toile de fond.\r\n\r\nCe nez tout en équilibre est représentatif des saveurs qui se retrouvent une fois la bière en bouche. L&#039;attaque se porte sur les notes fraîches et levurées d&#039;une blanche. La fine acidité du blé s&#039;accompagne de notes finement épicées, de saveurs légères de banane. Le fruit arrive rapidement avec la noix de coco qui s&#039;exprime en douceur et en texture, apportant quelque chose de soyeux à cette bière blanche.\r\n\r\nL&#039;ananas arrive sur la finale, en note de fond et accompagne la dégustation sur la longueur.\r\n\r\nCette Piña Colada Wheat est une bière blanche gourmande, équilibrée et fraîche.', 2, 1, 33, 'PIACOLADAWHEAT-644fc22b53e85.webp', 3.50),
(5, 'Noiraude', 5.00, 18, 'La Noiraude est une bière blanche pur malt ; elle est brassée avec du malt de blé et du malt d&amp;amp;amp;#039;orge blond. Son brassage est effectué avec une méthode d&amp;amp;amp;#039;infusion, qui confère une bière trouble naturellement et grandement aromatique. \r\n\r\nAvec des arômes maltés, de caramel, de froment et d&amp;amp;amp;#039;épices, vous découvrirez dans la robe dorée et sous la très fine mousse de cette bière artisanale des saveurs douces et maltées, avec des notes céréalières pour finir sur des notes d&amp;amp;amp;#039;agrumes. Très désaltérante, cette bière vive, légèrement acidulée fera le bonheur de vos proches durant vos apéritifs, servez-la bien fraîche, pour profiter de toutes ses subtilités. \r\n\r\nIngrédients (allergènes en gras) : eau, malt de blé, malt d&amp;amp;amp;#039;orge, houblon, levure', 2, 1, 33, 'Noiraude-6452a1ec2c2e1.webp', 3.00),
(6, 'Chimay Rouge', 7.00, 50, 'Une bière trappiste ambrée', 1, 3, 33, 'ChimayRouge-64529a3647b17.webp', 3.50),
(7, 'Hoegaarden', 4.90, 60, 'La Hoegaarden est une bière belge blanche qui compte parmi les plus connues hors du royaume de Belgique. C&#039;est la seule bière blanche à être proposée en fûts de 6L PerfectDraft ce qui la rend incontournable !\r\n\r\nElle est brassée avec de la coriandre et des zestes de citron pour plus de recherche de goût et de fraîcheur. La Hoegaardenprésente une intrigante robe d&#039;un blond troublé qui s&#039;explique par le fait que cette bière n&#039;est pas filtrée avant l&#039;embouteillage et contient donc encore des levures en suspend.\r\n\r\nElle se pare d&#039;une belle mousse blanche crémeuse et durable qui est traversée par une fine effervescence. Elle dégage un jolie nez fruité et épicé évoquant les agrumes, la coriandre et le houblon. En bouche, on retrouve des saveurs très similaires aux arômes perçus avec un goût fruité et une douce présence de la coriandre. Une belle amertume se développe sur la fin de bouche et affirme le caractère consensuel de cette bière blanche qui est un bel exemple du style des bières blanches belges.\r\n\r\nDégustez pleinement la Hoegaarden dans son verre Hoegaarden.', 2, 3, 33, 'Hoegaarden-64529affe3bb9.webp', 3.00),
(8, 'Leffe Royale Blonde', 7.50, 40, 'La Leffe Royale Blonde est une bière belge raffinée à la belle robe dorée, surmontée d&#039;une épaisse mousse blanche aérienne.\r\n\r\nAu nez, elle libère des arômes d&#039;agrumes, de citron, de résine de pin et de fleurs.\r\n\r\nEn bouche, on y retrouve une amertume subtile marquée par des houblons puissants, avec des saveurs de malt, de pin et de fleurs.\r\n\r\nElle est à déguster dans son verre calice Leffe à une température d&#039;environ 8°C.', 3, 3, 33, 'LeffeRoyaleBlonde-64529be07a029.webp', 4.00),
(9, 'Newcastle Brown Ale', 4.70, 55, 'Découvrez une des ales les plus populaires d&#039;Angleterre et l&#039;une des bières anglaises les plus connues au monde. Toujours brassée selon la recette originale de 1927, elle offre un délicat arôme floral et une saveur sèche et boisée.\r\n\r\nElle est brassée à Gateshead dans la brasserie Scottish &amp; Newcastle. Elle remporta plusieurs médailles d&#039;or à l&#039;International Brewers Exhibition de Londres en 1928. Ces trophées figurent depuis sur l&#039;étiquette des bouteilles, de part et d&#039;autres de la fameuse étoile bleue adoptée en guise de logo en 1913.', 4, 6, 33, 'NewcastleBrownAle-64529d26ae543.webp', 3.70),
(10, 'Guinness Draught', 4.20, 30, 'S&#039;il est certain que la plus célèbre des bières Irlandaises n&#039;est plus à présenter, découvrez vite sa frangine, la Guinness Draught ! Version cannette de la fameuse Guinness, cette bière à la technologie bien particulière va vous permettre de retrouver chez vous, la Guinness que vous affectionner tant à la pompe. En effet, Guinness a développé une technologie qui va renforcer la pression de la bière lors de l&#039;ouverture de la cannette et lui garantir une mousse digne des meilleurs robinet à pression et une effervescence à la hauteur de cette bière d&#039;exception. Une fois la Canette ouverte et la bière versée dans votre verre, vous retrouvez la robe d&#039;un noir opaque de votre traditionnelle Guinness, accompagnée comme à l&#039;habitude de son inimitable chapeau de mousse beige et compact. De cet ensemble se dégagent des arômes doux et torréfiés de malt évoquant le cacao, le café, les fruits secs et les grains grillés. On retrouve en bouche des saveurs similaires à celles perçues dans le nez, avec une douceur sucrée qui s&#039;équilibre avec les saveurs prononcées de torréfaction. Goûter cette Guinness, c&#039;est faire le choix d&#039;une des meilleures Stouts d&#039;Irlande !', 5, 10, 33, 'GuinnessDraught-64529dd3d6182.webp', 4.50),
(11, 'Liefmans Kriek', 6.00, 45, 'Lifemans Kriek Brut est une bière belge à la cerise rafraîchissante, à fermentation mixte, brassée par Liefmans en utilisant de véritables cerises fraîches en grosse quantité. Pour être plus précis sur cette Kriek Brut, elle se compose de plusieurs cuvées de bières Goudenband et Oud Bruin. Elle fait ensuite sa maturation pendant 18 mois où la saveur de cerise prend tout son sens.\r\n\r\nDans le verre, vous verserez un breuvage à la robe ambrée rouge profond qui s&#039;orne d&#039;une mousse élégante rose voluptueuse.\r\n\r\nCette Liefmans laisse s&#039;échapper de doux arômes de cerises sucrées, des notes de bois et d&#039;amande.\r\n\r\nEn bouche, on identifie facilement la cerise douce amère qui est fortement présente pour notre plus grand plaisir, mais toujours très équilibrée avec de légères nuances de bois, d&#039;amande et de caramel.\r\n\r\nUne bière tout en élégance qui montre le savoir-faire de la brasserie Liefmans.', 6, 3, 33, 'LiefmansKriek-64529e45121ad.webp', 3.50),
(12, 'Delirium Tremens', 8.50, 65, 'Brassée depuis 1989, avec l&#039;utilisation de trois levures belges différentes, la Delirium Tremens est devenue la bière phare de la brasserie Familiale Huygue, en activité depuis plus de 350 ans !\r\nC&#039;est une bière qui s&#039;est rapidement imposée comme une grande référence Belge et a conquis le monde à dos d&#039;éléphant en moins de 10 ans ! Si ceux de l&#039;étiquette sont rose, c&#039;est en référence aux hallucinations que le manque d&#039;alcool entraine parfois chez certains sujets lors de délires fiévreux appelés : Delirium Tremens !\r\n\r\nCette bière belge forte a une bouteille en céramique facilement identifiable. Dans le verre, on retrouve une robe blonde dorée légèrement troublée qui se coiffe d&#039;une mousse blanche. Le corps dégage des arômes fruités et épicés qui sont rehaussés par une pointe d&#039;alcool. Des senteurs de clous de girofle, de poivres et de coriandres précèdent une odeur d&#039;alcool qui réchauffe le nez avant que des arômes fruités de pomme et d&#039;agrumes n&#039;envahissent celui-ci.\r\n\r\nL&#039;entrée en bouche est épicée avec des saveurs évoquant presque les bières de blé, avant que les goûts herbacés du houblon et fruités du malt n&#039;affirment leurs présences. L&#039;alcool est perceptible tout au long de la dégustation mais réaffirme sa présence en fin de bouche avec une légère acidité vineuse. Une belle amertume accompagne cette fin de bouche sèche. Cette bière est à déguster avec son verre Delirium associé.', 3, 3, 33, 'DeliriumTremens-64529c687a608.webp', 4.20),
(13, 'La Chouffe', 8.00, 35, 'La brasserie d’Achouffe vit le jour au coeur d’un petit village de la vallées des fées situé dans les Ardennes belges.\r\n\r\nCe sont deux beaux-frères passionnés par le brassage qui lui donnèrent vie en 1982. Le nom ne fut pas difficile à trouver : il provient bien évidemment du nom du village Achouffe !\r\n\r\nMais saviez-vous pourquoi ils ont choisi de représenter un petit lutin rouge ? Tout simplement car dans le patois local, un chouffe est un petit lutin ! Aujourd’hui, la brasserie est connue bien au delà des frontières belges et ses bières sont récompensées par de nombreux prix année après année.\r\n\r\nLa chouffe est une belgian Pale Ale blonde non filtrée et refermentée. Derrière une robe couleur or, on découvre avec enchantement un bouquet aromatique à la fois fruitée et épicé. Sur le palais, on retrouve les notes épicées déjà présente au nez avec des touches de coriandre. Les houblons apportent une agréable amertume en fin de bouche. Cette bière agréablement fruitée et épicée se fera la compagne idéale d’un poisson blanc ou d’une volaille. N’hésitez pas non plus à l’associer à un fromage à pâte molle.', 3, 3, 33, 'LaChouffe-64529cbc69495.webp', 4.20),
(14, 'Affligem Dubbel', 6.80, 50, 'La Affligem Dubbel est une bière d&#039;abbaye brassée par la brasserie Heineken.\r\n\r\nDotée d&#039;une jolie couleur brune rougeâtre sous une tête bronzée pétillante, elle livre au nez des parfums fruités tel que la banane, la pomme et la fraise et détient au fond de sa bouteille un peu de levure.\r\n\r\nEn dégustation, vous retrouverez des notes de raisin sec, de pomme, de caramel brulé, d&#039;épice et de levure belge avec une finition légèrement amer.\r\n\r\nLa Affligem Dubbel, une bière belge d&#039;abbaye délicieuse et non filtrée qui séduit depuis 1074 !', 1, 3, 33, 'AffligemDubbel-64529a921f4f9.webp', 3.70),
(15, 'Weihenstephaner Hefeweissbier', 5.40, 70, 'Réputée dans le monde entier pour la finesse et la qualité de ses bières, la brasserie allemande Weihenstephaner revient avec cette Weihenstephaner Hefeweissbier Dunkel. Brassée principalement à partir de blé mais aussi de malt d’orge caramélisés, cette bière saura vous faire succomber.\r\n\r\nVisuellement, cette bière allemande nous propose une robe ambrée foncée avec de beaux reflets orangés. Le tout est surmonté d’une mousse blanche dense et généreuse. Au nez, les arômes sur la banane se mélangent au clou de girofle et aux notes maltées. En bouche, l’attaque là encore sur la banane laisse peu à peu place au blé avant un final sur les esters de levure. Un must dans son genre.\r\n\r\nRaffiné, fine, délicate, les superlatifs ne manquent pas quand il s’agit de décrire cette bière dunkel. Pas plus, d’ailleurs, que pour sa grande sœur, la Weihenstephaner Hefeweissbier.', 2, 2, 33, 'WeihenstephanerHefeweissbier-64529b5f56510.webp', 2.90),
(16, 'Westmalle Dubbel', 7.00, 55, 'La Westmalle Double Brune est une bière belge brassée à l&#039;Abbaye trappiste de N.D de la Trappe du Sacré Cœur. C&#039;est une bière de couleur acajou qui développe dans le verre une mousse abondante et persistante de couleur beige. Cette coloration est due à la double dose de malt utilisée pour brasser cette Westmalle.\r\n\r\nDu verre s&#039;échappe un arôme puissant et malté aux senteurs très fleuries, aux tons d&#039;alcool caramélisé et de levure. En bouche, la finesse est évidente. On note tout de suite la réglisse, le caramel subtilement brûlé, des tons de grillé, une amertume sèche et longue. Des saveurs maltées dont l&#039;étalement sur le palais est long.\r\n\r\nC&#039;est une bière d&#039;abbaye toute en finesse et délicate. Un bon cru trappiste, un peu moins puissant que ses consœurs brunes de Westvleteren ou Rochefort, mais d&#039;une qualité indéniable ! \r\n\r\nPour la dégustation, il est conseillé de laisser la bière reposer un peu au préalable, avant de verser prudemment le liquide dans un verre Westmalle calice en laissant le dépôt de levure dans la bouteille.', 4, 3, 33, 'WestmalleDubbel-64529d7b6e7b5.webp', 3.70);

-- --------------------------------------------------------

--
-- Structure de la table `type_users`
--

CREATE TABLE `type_users` (
  `id` int NOT NULL,
  `nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_users`
--

INSERT INTO `type_users` (`id`, `nom`) VALUES
(1, 'administrateur'),
(2, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NULL',
  `tel` int NOT NULL,
  `numero_adresse` int NOT NULL,
  `voie_adresse` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code_postal` int NOT NULL,
  `ville_adresse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `niveau_droits` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `login`, `tel`, `numero_adresse`, `voie_adresse`, `code_postal`, `ville_adresse`, `mdp`, `niveau_droits`) VALUES
(1, 'milant', 'milant', 'mil@ant.fr', 123456789, 32, 'rue jeanned\'arc', 54111, 'Mont-Bonvillers', '$2y$10$8OdQcxnK84HuramoDlm6ReeiduBke0BKjf4g4cDYYatUN.YXbh0B.', 1),
(2, 'tarte', 'aux pommes', 'milant@milant.fr', 612345789, 32, 'rue jeanned\'arc', 54111, 'Mont-Bonvillers', '$2y$10$8OdQcxnK84HuramoDlm6ReeiduBke0BKjf4g4cDYYatUN.YXbh0B.', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat_panier`
--
ALTER TABLE `etat_panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livre_or_commentaires`
--
ALTER TABLE `livre_or_commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `origines`
--
ALTER TABLE `origines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_etat_panier` (`id_etat_panier`);

--
-- Index pour la table `panier_produits`
--
ALTER TABLE `panier_produits`
  ADD PRIMARY KEY (`quantite`),
  ADD KEY `id_paniers` (`id_paniers`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categories`),
  ADD KEY `id_origines` (`id_origines`);

--
-- Index pour la table `type_users`
--
ALTER TABLE `type_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `niveau_droits` (`niveau_droits`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `etat_panier`
--
ALTER TABLE `etat_panier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `livre_or_commentaires`
--
ALTER TABLE `livre_or_commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `origines`
--
ALTER TABLE `origines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `type_users`
--
ALTER TABLE `type_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
