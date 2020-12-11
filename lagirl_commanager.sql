-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2020 a las 21:00:29
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lagirl_commanager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen_categoria` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `imagen_categoria`) VALUES
(1, 'OJOS', 'uploads/cat1.jpg'),
(2, 'LABIOS', 'uploads/cat2.jpg'),
(3, 'FACIAL', 'uploads/cat3.jpg'),
(4, 'UÑAS', 'uploads/cat4.jpg'),
(5, 'ACCESORIOS', 'uploads/brochas-la-girl-originales-varios-modelos-D_NQ_NP_889812-MLV29562565803_032019-F.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `delivery`
--

CREATE TABLE `delivery` (
  `id_delivery` int(11) NOT NULL,
  `delivery_descri` varchar(200) NOT NULL,
  `delivery_precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `delivery`
--

INSERT INTO `delivery` (`id_delivery`, `delivery_descri`, `delivery_precio`) VALUES
(2, 'Zona Norte', 10),
(4, 'Zona Sur', 10),
(5, 'Zona Oeste', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_inicio`
--

CREATE TABLE `imagen_inicio` (
  `id_imagen` int(11) NOT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `link_imagen` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `imagen_inicio`
--

INSERT INTO `imagen_inicio` (`id_imagen`, `imagen`, `link_imagen`) VALUES
(1, 'uploads/imagen1.jpg', 'http://lagirlvzla.com/Details/?idp=14'),
(6, 'uploads/imagen2.jpg', 'http://lagirlvzla.com/Details/?idp=33'),
(7, 'uploads/imagen3.jpg', 'http://lagirlvzla.com/Details/?idp=30'),
(8, 'uploads/fondoSombras.jpg', 'http://lagirlvzla.com/Details/?idp=12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id_moneda` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `currency` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id_moneda`, `nombre`, `currency`) VALUES
(1, 'Bs', 1200000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `nombre_cli` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email_cli` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono_cli` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion_cli` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre_pay` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `referencia` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `metodo_pago` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `productos` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `total` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `currency` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `nombre_cli`, `email_cli`, `telefono_cli`, `direccion_cli`, `nombre_pay`, `referencia`, `metodo_pago`, `productos`, `total`, `fecha`, `estado`, `currency`) VALUES
(47, 'Rudy Salazar', 'rudy_salazar7777@hotmail.com', '04246854221', 'Camino del doral, villa savannah. Casa 5-24', 'Aleska calimán', 'Fbd9edf31', 'Zelle', '(2) DELINEADOR DE CEJAS (GB360 Black) <b>$6</b><br>(1) HD PRO CONCEAL (GC970 Light Ivory) <b>$5</b><br>', '17', '01/12/2020 [01:00]', 1, 1100000),
(50, 'Victoria Sierra', 'victoriaalejandrasierra24@gmail.com', '04246004442', 'Calle 73 con avenida 3E. Edificio Montesano. Sector la Lago. Maracaibo', 'Victoria Sierra', 'cfb8cd59c', 'Zelle', '(1) COMPACTOS (GPP605 Nude Beige) <b>$7</b><br>(1) PRO MATTE FOUNDATION (GLM677 Soft Honey) <b>$11</b>', '18', '01/12/2020 [08:58]', 1, 1100000),
(53, 'Rosana  Gonzalez Atencio ', 'Dra.rosanagonzalez@gmail.com', '04140643826', 'Av 3Y entre 81 y 82, residencias Leonor 1, piso 9', 'Valeria Valles ', '0c90ef8d3', 'Zelle', '(1) PRO Coverage (GLM642 Fair) <b>$11.00</b><br>', '11', '08/12/2020 [01:53]', 0, 1100000),
(54, 'Karina  Diaz', 'dailenydk1@gmail.com', '04147061029', 'Garcia de hevia la fria calle 1 # 14-21 estado tachira ', 'Ibrain villalba', '3031197700', 'Banesco', '(1) COMPACTOS (GPP604 Creamy Natural) <b>$7.00</b><br>(1) DELINEADOR DE CEJAS (GB358 Espresso) <b>$6</b><br>(1) PRO MATTE FOUNDATION (GLM674 Natural) <b>$11</b><br>(1) HD PRO CONCEAL (GC973 Creamy Bei', '29', '08/12/2020 [01:49]', 0, 1100000),
(55, 'Faviana Molina', 'favianamolina@gmail.com', '04246306459', 'C.C. Costa Verde, en planta baja justo frente a dorsay. Gepard', 'Keyla Molina', '451555782', 'BOD', '(1) PRO Coverage (GLM643 Porcelain) <b>$11.00</b><br>(1) HD PRO CONCEAL (GC972 Natural) <b>$5</b><br>', '16', '10/12/2020 [08:54]', 0, 1200000),
(56, 'Andrea  Fuenmayor', 'andreafm_97@hotmail.com', '04246419651', 'Sector 18 de octubre Calle N Av. 2', 'Sonia Medina ', '0025546333966', 'Mercantil', '(1) HD PRO CONCEAL (GC969 Porcelain) <b>$5</b><br>(1) BROCHAS (GPB403) <b>$10</b><br>', '15', '10/12/2020 [10:35]', 0, 1200000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(800) COLLATE utf8mb4_spanish_ci NOT NULL,
  `precio` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pos_pagina` tinyint(1) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `mostrar` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `imagen`, `descripcion`, `precio`, `pos_pagina`, `id_categoria`, `mostrar`) VALUES
(2, 'COMPACTOS', 'uploads/la-girl-polvo-compacto-pro-face-matte-mayoreo-12900-D_NQ_NP_212121-MLM20718934022_052016-O.jpg', '<p>Obtén un acabado impecable con PRO.face Matte Pressed Powder. Esta fórmula de larga duración que controla el aceite se puede aplicar sola para una apariencia suave y radiante o sobre una base líquida para una cobertura más completa. Disponible en 13 tonos matificantes.</p>', '7.00', 1, 3, 1),
(3, 'JUST BLUSHING', 'uploads/la-girl-just-blushing-cheap-cosmetics-ikatehouse-pick6deals-ckh1834-z_f72f9a1547af004c940c6b6ad3a98083.jpg', '<p>¡Rubor en polvo extremadamente pigmentado que es simplemente hermoso! Disponible en una impresionante variedad de colores, esta colección de 16 rubores varía desde el gris suave hasta los nudes que se pueden usar y los tonos atrevidos y brillantes. Color que se puede mezclar y construir en acabados mate y brillante. La fórmula suave y sedosa es de larga duración y seguro que te dejará sonrojándose ”toda la noche.</p>', '7.00', 1, 3, 1),
(5, 'PRO Coverage', 'uploads/Pro_Coverage_Illuminating_Foundation_grande.jpg', '<p>La base líquida iluminadora PRO.coverage de alta definición de larga duración es ideal para un acabado impecable y de cobertura total. La fórmula liviana es cómoda para usar durante todo el día. La fórmula sin parabenos con antioxidantes agregados ayuda a hidratar y mejorar la apariencia de la piel. Ahora disponible para ampliar aún más la gama de colores, un innovador mezclador de base blanca para ajustar y personalizar el color.</p>', '11.00', 1, 3, 1),
(8, 'HD PRO BB CREAM', 'uploads/LAG_BBcream_GBB941_1024x1024.jpg', '<p>HD PRO BB Cream está formulada sin parabenos y sin fragancia para mimar la piel sensible y nutrirla generosamente con vitamina B3, C y E agregadas. La fórmula sedosa cubre una amplia gama de tonos de piel con ocho tonos diferentes. Este es su embellecedor de piel todo en uno que prepara, hidrata y realza el tono de la piel.</p>', '7', 0, 3, 1),
(10, 'FANATIC BLUSH PALETTE', 'uploads/GBL421-422_main_img_1024x1024.jpg', '<p>¿Eres un fanático del rubor y los reflejos? ¡Sí, nosotros también! Estamos emocionados de mostrar nuestra nueva colección Fanatic Blush and Highlighting. 4 paletas únicas enfocadas en hermosos rubores o llenas de resaltadores brillantes. Coge un cepillo y muéstrale algo de amor a esas mejillas.</p>', '12', 0, 3, 1),
(11, 'FANATIC HIGHLIGHTING PALETTE', 'uploads/GBL426-427_main_img_9c36029a-f286-44f6-9ca2-c5fa5929de22_1024x1024.jpg', '<p>¿Eres un fanático del rubor y los reflejos? ¡Sí, nosotros también! Estamos emocionados de mostrar nuestra nueva colección Fanatic Blush and Highlighting. 4 paletas únicas enfocadas en hermosos rubores o llenas de resaltadores brillantes. Agarra un cepillo y muestra algo de amor a esas mejillas.</p>', '12', 0, 3, 1),
(12, 'KEEP IT PLAYFUL EYESHADOW PALETTE', 'uploads/GES433-435_prod_img_main_2_3d415d43-8a25-49d8-9732-1a4d5512209f_1024x1024.jpg', '', '12', 0, 1, 1),
(13, 'BROCHAS', 'uploads/brochas-la-girl-originales-varios-modelos-D_NQ_NP_889812-MLV29562565803_032019-F.jpg', '', '10', 0, 5, 1),
(14, 'REMOVEDOR DE MAQUILLAJE', 'uploads/G20100_prod_img_1024x1024.jpg', '<p>Un desmaquillador de viaje y de vanidad imprescindible, estas toallitas limpiadoras hidratantes eliminan el maquillaje y la suciedad de la piel con facilidad. Infundido con aloe vera y extracto de soja; cada toallita hidrata y enriquece la piel. Ligeramente perfumado y sin parabenos. Úselo en cualquier momento para un rejuvenecimiento instantáneo.</p>', '7', 0, 5, 1),
(15, 'PRO MATTE FOUNDATION', 'uploads/71.JPG', '<p>Con un acabado suave y similar al ante, la base de maquillaje PRO.matte te mantendrá cubierto y sin brillos todo el día. Fórmula líquida y cremosa que brinda una cobertura suave y edificable tanto para el día como para la noche. Minimice la apariencia de poros y líneas finas para un efecto de enfoque suave y uniforme. Fórmula sin parabenos con vitamina E, B5 y aceite de girasol añadidos.</p>', '11', 0, 3, 1),
(16, 'PRIMER SPRAY', 'uploads/16.jpg', '<p>Fije y brille con facilidad, ¡solo rocíe! El primer spray contiene glicerina y extracto botánico de verdolaga para hidratar y calmar la piel. Rocíe la base antes de la aplicación del maquillaje para preparar la piel.</p>', '10', 0, 3, 1),
(17, 'SELLADOR SPRAY', 'uploads/17.jpg', '<p>El spray fijador contiene glicerina y extracto botánico de verdolaga para hidratar y calmar la piel. Arregle y fije el maquillaje para un uso prolongado del maquillaje.</p>', '10', 0, 3, 1),
(18, 'ILUMINADOR SPRAY', 'uploads/RTR.jpg', '<p>Fija tu look con el nuevo iluminador en spray, especialmente formulado para que tu maquillaje luzca fresco durante todo el día. Obtén una piel hermosa y radiante con dos nuevos Shimmer Sprays. Cada spray está impregnado de brillo nacarado para lograr el máximo brillo iluminador. ¡Perfecto para rostro y cuerpo!</p>', '10', 0, 3, 1),
(19, 'POLVO TRASLUCIDO', 'uploads/39.jpg', '<p><strong>Polvo fijador translúcido</strong>: Un polvo de acabado de lujo que fija la base y matifica la piel. Hecho de sílice 100% mineral, este polvo es una herramienta lujosa y versátil que fija perfectamente su maquillaje mientras empareja la tez, suavizando las líneas e imperfecciones para una apariencia radiante.&nbsp;</p><p>El polvo translúcido es un tono universalmente usable. La fórmula liviana se puede aplicar sobre la piel desnuda o sobre la base para un acabado impecable.</p><p>&nbsp;-Proporciona un acabado natural, mate e impecable&nbsp;</p><p>-Fija el maquillaje durante mucho tiempo.</p>', '7', 0, 3, 1),
(20, 'POLVO BANANA', 'uploads/20.jpg', '<p><strong>Polvo fijador de banana:</strong> Un polvo de acabado de tono amarillo que fija la base y matifica la piel mientras corrige el enrojecimiento y neutraliza los tonos oscuros. Polvo banana es un tono universalmente usable. La fórmula liviana se puede aplicar sobre la piel desnuda o sobre la base para un acabado impecable.</p><p>-Proporciona un acabado natural, mate e impecable.</p><p>-Fija el maquillaje durante mucho tiempo.</p>', '7', 0, 3, 0),
(21, 'PRIMER', 'uploads/LAG_proprep_GFP949_2_1024x1024.jpg', '<p>Haz que tu maquillaje dure todo el día con la prebase facial suavizante PRO Prep. Primer crea una apariencia suave al rellenar las líneas finas y los poros mientras proporciona la superficie perfecta para la base. Formulada con partículas difusoras de luz y vitamina E que nutre la piel, esta prebase le da un acabado impecable dentro o fuera de la cámara.</p><p>&nbsp;-Ligero y fácil de aplicar.</p><p>&nbsp;-Sin parabeno ni fragancias.</p><p>&nbsp;-Suaviza la piel y realza el maquillaje.</p><p>&nbsp;-Ayuda a que el maquillaje permanezca por más tiempo.</p>', '7', 0, 3, 1),
(22, 'SELLADOR', 'uploads/LAG_prosetting_GFS950_v2_1024x1024.jpg', '<p>Para mantener ese acabado mate del maquillaje recién aplicado, rocíe uniformemente el sellador después de aplicar el maquillaje. La fórmula es ligera y no pegajosa, fija el maquillaje para usar durante todo el día. La bruma ultrafina es refrescante y se seca rápidamente fijando el maquillaje para ayudarte a mantenerte bella por más tiempo. Sin parabenos ni fragancias.</p>', '7', 0, 3, 1),
(23, 'BROW BESTIE ', 'uploads/11.JPG', '<p>El Brow Bestie Pencil presenta una punta triangular giratoria y un conveniente carrete incorporado. Conoce a dos mejores amigos: el lápiz y el delineador en gel. ¡Son geniales solos pero un dúo perfecto cuando se usan juntos! Usa el lápiz para delinear y rellenar y el kit de gel para fijar y domar las cejas.</p>', '8', 0, 1, 1),
(24, 'POMADA DE CEJAS', 'uploads/61.JPG', '<p>Define y esculpe unas cejas de aspecto perfecto. La pomada cremosa se desliza suavemente y se fija en su lugar. Fórmula resistente al agua que dura todo el día sin decolorarse ni mancharse. Disponible en 5 tonos favorecedores para rellenar y fijar las cejas.&nbsp;</p>', '8', 0, 1, 1),
(25, 'KIT DELINEADOR DE CEJAS', 'uploads/81.jpg', '<p>Kit delineador de cejas es un gel de larga duración a prueba de manchas con una pequeña varita de carrete e incluye un cepillo / carrete de dos extremos separados. Quita el gel para cejas con un desmaquillador a base de aceite. Conoce a dos mejores amigos: el lápiz y el delineador en gel. ¡Son geniales solos pero un dúo perfecto cuando se usan juntos! Utilice el lápiz para delinear y rellenar y el kit de gel para fijar y domar las cejas.</p>', '9', 0, 1, 1),
(26, 'KIT DE CEJAS', 'uploads/41.JPG', '<p>Estos kits de cejas seguramente inspirarán, domesticarán y enmarcarán. Cada lata está empaquetada con dos tonos de polvo para cejas, un tono iluminador favorecedor y una cera transparente. El kit para cejas también incluye pinzas y un cepillo en ángulo con carrete, todo lo necesario para unas cejas hermosas.</p>', '12', 0, 1, 0),
(27, 'BREAK FREE EYESHADOW PALETTE', 'uploads/G42877_G42878_prod_img_main_1024x1024.jpg', '<p>¡Estabas destinado a destacar! La colección Break Free de edición limitada de L.A. Girl Cosmetics da vida a tu imaginación con dos nuevas paletas de sombras de ojos que muestran la belleza que hay en ti.&nbsp;</p><p>16 sombras de ojos altamente pigmentadas vienen en mates suaves sedosos, reflejos suaves y láminas intensas para transformar los ojos en una declaración que permanecerá mezclada.</p>', '18', 0, 1, 1),
(28, 'DELINEADOR EN GEL', 'uploads/thumbnail_8E630A9C-87AA-45DD-BA8C-4679D66AC294-3703-0000029284BE22E4.jpg', '<p>El delineador de ojos en gel altamente pigmentado se aplica suave y fácilmente. Una vez seco, el color se fija en su lugar para un acabado a prueba de manchas. Fórmula resistente al agua que evita la decoloración y la descamación. Use el cepillo delineador en ángulo PRO.brush para dibujar líneas precisas y limpias con facilidad.</p>', '8', 0, 1, 1),
(29, 'PRIMER DE OJOS', 'uploads/thumbnail_DEE8A8A4-C885-4627-8451-A8CDA659DEBD-3703-00000292572A5BBC.jpg', '<p>Primer de ojos es una base multitarea que tiene una fórmula ligera y no pegajosa que se fija para una aplicación de maquillaje de ojos de larga duración. La textura suave se desliza sobre los párpados para preparar los ojos para una aplicación impecable y uniforme. El primer de ojos es una prebase universal que sirve como base, funciona en todo tipo de piel y te permite usar tu sombra de ojos favorita durante todo el día mientras realzas los pigmentos en la mayoría de las sombras de ojos.</p>', '4', 0, 1, 1),
(30, 'ESMALTES DE GEL', 'uploads/imagen3.jpg', '<p>El esmalte en gel de brillo extremo y similar a un gel brinda uñas brillantes con calidad de salón sin esfuerzo. Esta fórmula sin complicaciones proporciona un color y brillo intensos sin la necesidad de luz ultravioleta y se elimina fácilmente. El nuevo cepillo de 440 cerdas está redondeado para adaptarse a la forma de la uña y ofrece una aplicación increíble con solo una capa.</p>', '5', 0, 4, 1),
(31, 'LIPGLOSS MATTE', 'uploads/31.JPG', '<p>Difuminando las líneas entre el lápiz labial y el brillo de labios, Matte Pigment Lipgloss se ha convertido en uno de los favoritos de los maquilladores, bloggers y fanáticos. Disponible en 16 tonos atrevidos que brindan un color rico e intenso en un acabado plano para usar durante todo el día. La fórmula de larga duración continúa como un líquido altamente pigmentado y se seca hasta obtener un acabado mate plano, para una hermosa perfección aterciopelada que dura y dura.</p>', '6', 0, 2, 1),
(32, 'LIPSTICK MATTE', 'uploads/01.JPG', '<p>El lápiz labial Matte Flat Velvet viene en 26 tonos atrevidos que son ricos en pigmentos y están llenos de humedad. Con manteca de karité para hidratar los labios y una aplicación suave y tersa, ¡tus labios se sentirán tan hermosos como se ven!</p>', '5', 0, 2, 1),
(33, 'LIP MOUSSE VELVET LIP COLOR', 'uploads/81.JPG', '<p>El color de labios Lip Mousse está batido en una textura cremosa que se siente tan ligera y cómoda que apenas sabrás que está ahí. La fórmula aterciopelada se vuelve suave como la mantequilla, dando un acabado sin costuras con la máxima recompensa de color que se desgasta uniformemente a lo largo del día. No es pegajoso ni reseca, sus labios se sentirán suaves y extra hidratados por la vitamina E agregada. El exclusivo aplicador en forma de lágrima cuenta con una cavidad central que contiene producto adicional para una cobertura total y una aplicación uniforme que abraza las curvas de sus labios.</p>', '7', 0, 2, 1),
(34, 'DELINEADORES DE LABIOS', 'uploads/c13.jpg', '<p>El delineador de labios Perfect Precision ayuda a mantener el color de los labios vibrante y duradero todo el día. Úselo para delinear o rellenar los labios para lograr un puchero perfecto.</p>', '4', 0, 2, 1),
(35, 'MASCARA DE PESTAÑAS', 'uploads/OIP.jpg', '<p>Lleva tus pestañas al siguiente nivel con nuestra máscara de pestañas Volumatic Full-On Volumizing y Lifting de pestañas resistente al agua. Alarga, levanta y da volumen al instante para crear pestañas suaves en poco tiempo. El cepillo especial en forma de pétalo está diseñado para brindarle una aplicación fácil y cómoda mientras construye y separa sin aglutinarse. Recubrimiento de película, fórmula \"tubular\" que repele la grasa, el sudor y las lágrimas. Se lava con agua tibia.</p>', '8', 0, 1, 1),
(36, 'DELINEADOR TIPO MARCADOR', 'uploads/thumbnail_95B4A9C8-88FE-42DF-9FBF-9C7DDC221BA3-3703-00000293E9746488.jpg', '<p>¡El delineador de ojos de punta fina Fineline crea una línea fina y precisa en solo un trazo! El bolígrafo tiene una base de agua y una punta suave y flexible para mayor precisión y control, y brinda la cantidad correcta de color. ¡Nuevos tonos ahora disponibles!</p>', '8', 0, 1, 1),
(37, 'HD PRO CONCEAL ', 'uploads/GC969_prod_img_1024x1024.jpg', '<p>Los correctores HD Pro de L.A. Girl son resistentes a las arrugas con cobertura opaca en una textura cremosa pero ligera. La fórmula del corrector de larga duración camufla la oscuridad debajo de los ojos, el enrojecimiento y las imperfecciones de la piel. Nuestros correctores brindan una cobertura completa y de aspecto natural, incluso los tonos de piel, cubren las ojeras y minimizan las líneas finas alrededor de los ojos.&nbsp;</p>', '5', 1, 3, 1),
(38, 'SACAPUNTAS ', 'uploads/GPS400_prod_img_front_1024x1024.jpg', '<p>Nuestro sacapuntas es una herramienta de belleza imprescindible. Tres tamaños en uno asegura que los lápices delgados, gruesos y jumbo se afilan a un punto preciso cada vez. Incluye limpiador de cuchillas y cubierta para capturar virutas.</p>', '4', 0, 5, 1),
(39, 'PORTACOSMETICOS ', 'uploads/thumbnail_image0.jpg', '<p>El portacosmetico L.A. Girl es la nueva incorporación más caliente a cualquier colección de belleza. Su forma y características únicas permiten un almacenamiento óptimo mientras mantiene una forma y un diseño elegantes. Incluye bolsillo interior.&nbsp;</p>', '12', 0, 5, 1),
(40, 'LIP ATTRACTION LIPSTICK', 'uploads/la-girl-lip-attraction-attraction-hyped.jpg', '', '8', 0, 2, 1),
(41, 'GEL PARA CEJAS', 'uploads/gel.jpg', '<p>EL gel de cejas es una fórmula ligera para domar y fijar las cejas en su lugar. Cepille como desee para agregar una definición natural a las cejas. Es enriquecido en vitamina E para hidratar la piel con un acabado no pegajoso sin sensación de rigidez durante todo el día.</p>', '9', 0, 1, 1),
(42, 'ILUMINADOR EN POLVO', 'uploads/IL.jpg', '<p>El iluminador en polvo resalta sus rasgos faciales creando más profundidad y dimensión donde la luz suele impactar. El polvo suave y sedoso agrega un brillo fresco para resaltar las mejillas, iluminar los ojos, esculpir la nariz y realzar el puchero. El iluminador se puede aplicar solo o sobre el maquillaje para una tez perfecta y radiante.</p>', '9', 0, 3, 1),
(43, 'KIT DE CONTORNO EN CREMA', 'uploads/33.jpg', '', '6', 0, 3, 1),
(44, 'GLITTER', 'uploads/GGP45X_prod_img_main_b689ac2f-4051-46ea-9be3-e5138dd4357b_1024x1024.jpg', '', '6', 0, 1, 1),
(45, 'DELINEADOR DE CEJAS', 'uploads/LAG_Shady_Slim_GB351_1024x1024.jpg', '<p>EL delineador de cejas es la manera perfecta de obtener cejas más llenas y bellamente esculpidas. Moldea y rellena las cejas con la punta súper delgada retráctil para crear trazos similares a los de un cabello de apariencia natural. Use el carrete del extremo opuesto para cepillar y difuminar el color de las cejas para una apariencia terminada.</p>', '6', 0, 1, 1),
(46, 'LIPIFY STYLO LIPSTICK', 'uploads/GLC876_prod_img_1024x1024.jpg', '<p>Lipify se desliza sobre un color rico e intenso en una sola pasada. Enriquecida con aceite de argán y aceite de oliva hidratantes, la fórmula ligera no pegajosa hidrata los labios con un lujoso acabado suave y brillante. Punta no retráctil fácil de usar.</p>', '6', 0, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id_subcategoria` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id_subcategoria`, `nombre`, `imagen`) VALUES
(10, 'Blush', 'uploads/cat3.jpg'),
(11, 'Polish', 'uploads/cat4.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tproducto` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen_color` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `mostrar` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tproducto`, `nombre`, `imagen_color`, `id_producto`, `mostrar`) VALUES
(5, 'GBB941 Fair', 'uploads/tonos/LAG_BBcream_GBB941_1024x1024.jpg', 8, 1),
(6, 'GBB942 Light', 'uploads/tonos/LAG_BBcream_GBB942_1024x1024.jpg', 8, 1),
(7, 'GPP601 Fair', 'uploads/tonos/LAG_proFace_GPP601_1024x1024.jpg', 2, 1),
(8, 'GPP602 Classic Ivory', 'uploads/tonos/LAG_proFace_GPP602_1024x1024.jpg', 2, 1),
(9, 'GPP603 Porcelain', 'uploads/tonos/LAG_proFace_GPP603_1024x1024.jpg', 2, 1),
(10, 'GPP604 Creamy Natural', 'uploads/tonos/LAG_proFace_GPP604_1024x1024.jpg', 2, 1),
(11, 'GPP605 Nude Beige', 'uploads/tonos/LAG_proFace_GPP605_1024x1024.jpg', 2, 1),
(12, 'GPP606 Buff', 'uploads/tonos/LAG_proFace_GPP606_1024x1024.jpg', 2, 1),
(13, 'GPP607 Warm Honey', 'uploads/tonos/LAG_proFace_GPP607_1024x1024.jpg', 2, 1),
(14, 'GPP608 Soft Honey', 'uploads/tonos/LAG_proFace_GPP608_1024x1024.jpg', 2, 0),
(15, 'GPP609 Medium Beige', 'uploads/tonos/LAG_proFace_GPP609_1024x1024.jpg', 2, 0),
(16, 'GPP610 Classic Tan', 'uploads/tonos/LAG_proFace_GPP610_1024x1024.jpg', 2, 1),
(17, 'GPP611 True Bronze', 'uploads/tonos/LAG_proFace_GPP611_1024x1024.jpg', 2, 0),
(18, 'GPP612 Warm Caramel', 'uploads/tonos/LAG_proFace_GPP612_1024x1024.jpg', 2, 0),
(19, 'GPP613 Toffe', 'uploads/tonos/LAG_proFace_GPP613_1024x1024.jpg', 2, 0),
(20, 'GBL421 Island Hottie', 'uploads/tonos/GBL421_prod_img_1024x1024.jpg', 10, 1),
(21, 'GBL422 Blushed Babe', 'uploads/tonos/GBL422_prod_img_1024x1024.jpg', 10, 1),
(22, 'GBB943 Light Medium', 'uploads/tonos/LAG_BBcream_GBB943_1024x1024.jpg', 8, 1),
(23, 'GBB944 Neutral', 'uploads/tonos/LAG_BBcream_GBB944_1024x1024.jpg', 8, 1),
(24, 'GBB945 Medium', 'uploads/tonos/LAG_BBcream_GBB945_1024x1024.jpg', 8, 1),
(25, 'GBB947 Deep', 'uploads/tonos/LAG_BBcream_GBB947_1024x1024.jpg', 8, 1),
(26, 'GBB948 Dark', 'uploads/tonos/LAG_BBcream_GBB948_1024x1024.jpg', 8, 1),
(27, 'GLM641 White', 'uploads/tonos/LAG_proCoverage_GLM641_1024x1024.jpg', 5, 1),
(28, 'GLM642 Fair', 'uploads/tonos/LAG_proCoverage_GLM642_1024x1024.jpg', 5, 0),
(29, 'GLM643 Porcelain', 'uploads/tonos/LAG_proCoverage_GLM643_1024x1024.jpg', 5, 1),
(30, 'GLM644 Natural', 'uploads/tonos/LAG_proCoverage_GLM644_1024x1024.jpg', 5, 1),
(31, 'GLM645 Nude Beige', 'uploads/tonos/LAG_proCoverage_GLM645_1024x1024.jpg', 5, 1),
(32, 'GLM646 Beige', 'uploads/tonos/46P.jpg', 5, 1),
(33, 'GLM647 Warm Beige', 'uploads/tonos/47.jpg', 5, 1),
(34, 'GLM648 Soft Honey', 'uploads/tonos/48.jpg', 5, 0),
(35, 'GLM649 Tan', 'uploads/tonos/49.jpg', 5, 0),
(36, 'GLM650 Sand', 'uploads/tonos/50.jpg', 5, 0),
(37, 'GLM651 Bronze', 'uploads/tonos/51.jpg', 5, 0),
(38, 'GLM652 Warm Caramel', 'uploads/tonos/52.jpg', 5, 1),
(39, 'GLM653 Toast', 'uploads/tonos/53.jpg', 5, 1),
(40, 'GLM654 Coffee', 'uploads/tonos/54.jpg', 5, 0),
(41, 'GLM655 Rich Cocoa', 'uploads/tonos/55.jpg', 5, 0),
(42, 'GES433', 'uploads/tonos/GES433_prod_altimg_1_5fa9623d-26d6-4f09-91a3-afc8bb74f470_1024x1024.jpg', 12, 1),
(43, 'GES434', 'uploads/tonos/GES434_prod_altimg_1_58ec1143-f68b-40f6-b5af-aa1fbed426ee_1024x1024.jpg', 12, 1),
(44, 'GES435', 'uploads/tonos/GES435_prod_altimg_1_19e69c01-9163-472c-b811-a6565eb64cc3_1024x1024.jpg', 12, 1),
(45, 'GES436', 'uploads/tonos/GES436_prod_altimg_1_3d3d7729-8e8b-4ce3-a2ec-cb90ec23a9a5_1024x1024.jpg', 12, 1),
(46, 'GPB101', 'uploads/tonos/GPB101_prod_img_1024x1024.jpg', 13, 1),
(47, 'GPB102', 'uploads/tonos/GPB102_prod_img_1024x1024.jpg', 13, 1),
(48, 'GPB103', 'uploads/tonos/103.jpg', 13, 1),
(49, 'GPB104', 'uploads/tonos/GPB104_prod_img_1024x1024.jpg', 13, 1),
(50, 'GPB105', 'uploads/tonos/GPB105_prod_img_1024x1024.jpg', 13, 1),
(51, 'GPB106', 'uploads/tonos/GPB106_prod_img_1024x1024.jpg', 13, 0),
(52, 'GPB107', 'uploads/tonos/GPB107_prod_img_grande.jpg', 13, 1),
(53, 'GPB108', 'uploads/tonos/GPB108_prod_img_1024x1024.jpg', 13, 1),
(54, 'GPB109', 'uploads/tonos/GPB109_prod_img_1024x1024.jpg', 13, 0),
(55, 'GPB110', 'uploads/tonos/110.jpg', 13, 1),
(56, 'GPB111', 'uploads/tonos/GPB111_prod_img_1024x1024.jpg', 13, 1),
(57, 'GPB112', 'uploads/tonos/GPB112_prod_img_1024x1024.jpg', 13, 1),
(58, 'GPB201', 'uploads/tonos/GPB201_prod_img_1024x1024.jpg', 13, 1),
(59, 'GPB202', 'uploads/tonos/202.jpg', 13, 0),
(60, 'GPB203', 'uploads/tonos/GPB203_prod_img_1024x1024.jpg', 13, 1),
(61, 'GPB204', 'uploads/tonos/GPB204_prod_img_1024x1024.jpg', 13, 1),
(62, 'GPB205', 'uploads/tonos/GPB205_prod_img_1024x1024.jpg', 13, 0),
(63, 'GPB206', 'uploads/tonos/GPB206_prod_img_1024x1024.jpg', 13, 1),
(64, 'GPB207', 'uploads/tonos/GPB207_prod_img_1024x1024.jpg', 13, 1),
(65, 'GPB208', 'uploads/tonos/GPB208_prod_img_grande.jpg', 13, 1),
(66, 'GPB301', 'uploads/tonos/GPB301_prod_img_1024x1024.jpg', 13, 1),
(67, 'GPB401', 'uploads/tonos/GPB401_prod_img_1024x1024.jpg', 13, 1),
(68, 'GPB403', 'uploads/tonos/GPB403_prod_img_23abf8e0-e0e3-41dd-9b38-278364d85a74_1024x1024.jpg', 13, 1),
(69, 'GBL426 Moonlight Magic', 'uploads/tonos/E.jpg', 11, 1),
(70, 'GBL427 Sunlight Sensation', 'uploads/tonos/EE.jpg', 11, 1),
(71, 'GBL481 Just Because', 'uploads/tonos/33141724-6CAB-4D22-B810-26E434012AEA-3674-00000341878043A3.JPG', 3, 1),
(72, 'GBL482 Just Bare', 'uploads/tonos/42BB97ED-4351-4DFA-A86E-2CDB19F6F7F4-3674-0000034190C6C4F2.JPG', 3, 0),
(73, 'GBL483 Just Glowing', 'uploads/tonos/452CFF26-CA17-4877-96AF-FC32EA317586-3674-000003419AB93ED4.JPG', 3, 0),
(74, 'GBL485 Just Kissed', 'uploads/tonos/25D81E73-3C05-4864-B717-2F2ABD930439-3674-00000341AB2701F3.JPG', 3, 0),
(75, 'GBL486 Just Pinched', 'uploads/tonos/95F0613F-1E2E-461B-9BF9-1D16AFE372D6-3674-00000341B3BE7C41.JPG', 3, 1),
(76, 'GBL487 Just Dance', 'uploads/tonos/3CE32917-1E04-468D-A370-AD6135427E85-3674-00000341BCB0EB7B.JPG', 3, 1),
(77, 'GBL488 Just Love', 'uploads/tonos/05195F66-0755-432E-8405-276858B771A8-3674-00000341C62F9EAC.JPG', 3, 1),
(78, 'GBL489 Just Natural', 'uploads/tonos/89A17F24-C43F-4BD8-9813-ADEC7268CD8E-3674-00000341CFB59964.JPG', 3, 1),
(79, 'GBL490 Just Radiant', 'uploads/tonos/51C0C5A4-AC6D-46BF-87B4-742DC0866FA3-3674-00000341D81DEDFA.JPG', 3, 1),
(80, 'GBL491  Just Be You', 'uploads/tonos/4F5FA3B1-F591-4A2C-A8E7-BE3766232EB5-3674-00000341E09247BD.JPG', 3, 1),
(81, 'GBL492 Just Playful', 'uploads/tonos/89BF97C3-AABF-48A0-B7FA-A1417E78BA26-3674-00000341E9B89ED0.JPG', 3, 0),
(82, 'GBL493 Just Dazzle', 'uploads/tonos/1.JPG', 3, 1),
(83, 'GBL494 Just Rosy', 'uploads/tonos/2.JPG', 3, 0),
(84, 'GBL495 Just For Fun', 'uploads/tonos/3.JPG', 3, 1),
(85, 'GBL496 Just Fearless', 'uploads/tonos/4.JPG', 3, 1),
(86, 'GBL484 Just Peachy', 'uploads/tonos/5.jpg', 3, 0),
(88, 'GLM671 Ivory', 'uploads/tonos/71.jpg', 15, 1),
(89, 'GLM672 Bisque', 'uploads/tonos/72.jpg', 15, 1),
(90, 'GLM673 Beige', 'uploads/tonos/73.JPG', 15, 0),
(91, 'GLM674 Natural', 'uploads/tonos/74.JPG', 15, 1),
(92, 'GLM675 Medium Beige', 'uploads/tonos/75.JPG', 15, 1),
(93, 'GLM676 Light Tan', 'uploads/tonos/76.JPG', 15, 1),
(94, 'GLM677 Soft Honey', 'uploads/tonos/hi.jpg', 15, 1),
(95, 'GFS918 Gold', 'uploads/tonos/18.jpg', 18, 1),
(96, 'GFS919 Rose Gold', 'uploads/tonos/19.jpg', 18, 1),
(97, 'GBP371 Dark Blonde', 'uploads/tonos/71.JPG', 4, 1),
(98, 'GBP371 Dark Blonde', 'uploads/tonos/72.JPG', 4, 1),
(99, 'GBP371 Dark Blonde', 'uploads/tonos/GBP371_prod_img_1024x1024.jpg', 23, 1),
(100, 'GBP372 Warm Auburn', 'uploads/tonos/GBP372_prod_img_1024x1024.jpg', 23, 1),
(101, 'GBP373 Soft Brown', 'uploads/tonos/GBP373_prod_img_1024x1024.jpg', 23, 1),
(102, 'GBP374 Chesnut', 'uploads/tonos/GBP374_prod_img_1024x1024.jpg', 23, 1),
(103, 'GBP375 Medium Brown', 'uploads/tonos/555.JPG', 23, 0),
(104, 'GBP376 Brunette', 'uploads/tonos/66.JPG', 23, 1),
(105, 'GBP377 Deep Brown', 'uploads/tonos/777.JPG', 23, 1),
(106, 'GBP378 Black Brown', 'uploads/tonos/888.JPG', 23, 1),
(107, 'GBP361 Blonde', 'uploads/tonos/61.JPG', 24, 0),
(108, 'GBP362 Taupe', 'uploads/tonos/62.JPG', 24, 1),
(109, 'GBP363 Soft Brown', 'uploads/tonos/63.JPG', 24, 1),
(110, 'GBP364 Warm Brown', 'uploads/tonos/64.JPG', 24, 1),
(111, 'GBP365 Dark Brown', 'uploads/tonos/65.JPG', 24, 1),
(112, 'GBG381 Dark Blonde', 'uploads/tonos/81.jpg', 25, 1),
(113, 'GBG382 Soft Brown', 'uploads/tonos/82.jpg', 25, 1),
(114, 'GBG383 Cool Brown', 'uploads/tonos/83.jpg', 25, 1),
(115, 'GBG384 Dark Brown', 'uploads/tonos/84.jpg', 25, 1),
(116, 'GBG385 Soft Black', 'uploads/tonos/85.jpg', 25, 1),
(117, 'GES341 Light And Bright', 'uploads/tonos/41.JPG', 26, 1),
(118, 'GES342 Medium And Marvelous', 'uploads/tonos/42.JPG', 26, 1),
(119, 'GES433 Dark And Defined', 'uploads/tonos/43.JPG', 26, 1),
(120, 'G42877 This Is Me', 'uploads/tonos/G42877_prod_altimg_1_1024x1024.jpg', 27, 1),
(121, 'G42878 Be You', 'uploads/tonos/G42878_prod_altimg_1_1024x1024.jpg', 27, 1),
(122, 'GEB195 White', 'uploads/tonos/thumbnail_C9FC0B0C-F025-4D61-BABD-8C797BD55105-3703-000002924D72C51C.jpg', 29, 1),
(123, 'GEB196 Nude', 'uploads/tonos/thumbnail_DEE8A8A4-C885-4627-8451-A8CDA659DEBD-3703-00000292572A5BBC.jpg', 29, 1),
(124, 'GEB197 Black', 'uploads/tonos/thumbnail_A7FFDDAE-92A1-4192-B273-E4F0C734E4DE-3703-00000292625BE32C.jpg', 29, 1),
(125, 'GNL660 Ilusion', 'uploads/tonos/thumbnail_IMG_3325.jpg', 30, 1),
(126, 'GNL663 Sensual', 'uploads/tonos/thumbnail_IMG_3326.jpg', 30, 1),
(127, 'GNL662 Temptation', 'uploads/tonos/thumbnail_IMG_3327.jpg', 30, 1),
(128, 'GNL652 Charming', 'uploads/tonos/thumbnail_IMG_3328.jpg', 30, 1),
(129, 'GLG831 Fantasy', 'uploads/tonos/31.JPG', 31, 0),
(130, 'GLG832 Dreamy', 'uploads/tonos/32.JPG', 31, 1),
(131, 'GLG833 Fleur', 'uploads/tonos/dr.JPG', 31, 1),
(132, 'GLG834 Bazar', 'uploads/tonos/34.JPG', 31, 1),
(133, 'GLG835 Timeless', 'uploads/tonos/35.JPG', 31, 1),
(134, 'GLG836 Iconic', 'uploads/tonos/36.JPG', 31, 1),
(135, 'GLG837 Playfull', 'uploads/tonos/37.JPG', 31, 1),
(136, 'GLG838 Tulle', 'uploads/tonos/38.JPG', 31, 1),
(137, 'GLG839 Obsess', 'uploads/tonos/39.JPG', 31, 1),
(138, 'GLG840 Instic', 'uploads/tonos/40.JPG', 31, 1),
(139, 'GLG841 Frisky', 'uploads/tonos/41.JPG', 31, 1),
(140, 'GLG842 Secret', 'uploads/tonos/42.JPG', 31, 1),
(141, 'GLG843 Rebel', 'uploads/tonos/43.JPG', 31, 1),
(142, 'GLG844 Backstage ', 'uploads/tonos/ee.JPG', 31, 1),
(143, 'GLG845 Stunner', 'uploads/tonos/45.JPG', 31, 1),
(144, 'GLG846 Black Currant', 'uploads/tonos/46.JPG', 31, 1),
(145, 'GLC801 Ooh La La!', 'uploads/tonos/01.JPG', 32, 0),
(146, 'GLC802 Carried Away', 'uploads/tonos/02.JPG', 32, 1),
(147, 'GLC803 Sweet Revenge', 'uploads/tonos/03.JPG', 32, 1),
(148, 'GLC804 Blessed', 'uploads/tonos/04.JPG', 32, 0),
(149, 'GLC805 Sunset Chic', 'uploads/tonos/05.JPG', 32, 1),
(150, 'GLC806 Frisky', 'uploads/tonos/06.JPG', 32, 0),
(151, 'GLC807 Hot Stuff', 'uploads/tonos/07.JPG', 32, 1),
(152, 'GLC808 Gossip', 'uploads/tonos/08.JPG', 32, 1),
(153, 'GLC809 Relentless', 'uploads/tonos/09.JPG', 32, 0),
(154, 'GLC810 Bite Me', 'uploads/tonos/10.JPG', 32, 1),
(155, 'GLC811 Spicy', 'uploads/tonos/11.JPG', 32, 0),
(156, 'GLC812 Snuggle', 'uploads/tonos/12.JPG', 32, 1),
(157, 'GLC813 Hush', 'uploads/tonos/13.JPG', 32, 1),
(158, 'GLC814 Bliss', 'uploads/tonos/14.JPG', 32, 0),
(159, 'GLC815 Arm Candy', 'uploads/tonos/15.JPG', 32, 1),
(160, 'GLC816 Electric', 'uploads/tonos/16.JPG', 32, 1),
(161, 'GLC817 Love Story', 'uploads/tonos/17.JPG', 32, 1),
(162, 'GLC818 Dare to Date', 'uploads/tonos/18.JPG', 32, 1),
(163, 'GLC819 Giggle', 'uploads/tonos/19.JPG', 32, 1),
(164, 'GLC820 Love Triangle', 'uploads/tonos/20.JPG', 32, 1),
(165, 'GLC821 Manic', 'uploads/tonos/21.JPG', 32, 1),
(166, 'GLC822 Runway', 'uploads/tonos/22.JPG', 32, 0),
(167, 'GLC823 Va Voom!', 'uploads/tonos/23.JPG', 32, 1),
(168, 'GLC824 Poetic!', 'uploads/tonos/24.JPG', 32, 1),
(169, 'GLC825 Blue Valentine', 'uploads/tonos/25.JPG', 32, 1),
(170, 'GLC826 Raven', 'uploads/tonos/26.JPG', 32, 1),
(171, 'GLC781 Squad', 'uploads/tonos/81.JPG', 33, 1),
(172, 'GLC782 Lowkey', 'uploads/tonos/82.JPG', 33, 1),
(173, 'GLC783 Bff', 'uploads/tonos/83.JPG', 33, 1),
(174, 'GLC784 Stunning', 'uploads/tonos/84.JPG', 33, 1),
(175, 'GLC785 Bae-Cation', 'uploads/tonos/85.JPG', 33, 1),
(176, 'GLC786 Unstoppable', 'uploads/tonos/86.JPG', 33, 1),
(177, 'GLC787 Moody', 'uploads/tonos/87.JPG', 33, 1),
(178, 'GLC788 Vibe', 'uploads/tonos/88.JPG', 33, 1),
(179, 'GLC789 Attitude', 'uploads/tonos/89.JPG', 33, 1),
(180, 'GLC790 Slay', 'uploads/tonos/90.JPG', 33, 1),
(181, 'GL713 Bare', 'uploads/tonos/c13.jpg', 34, 1),
(182, 'GP714 Sugar & Spice', 'uploads/tonos/c14.jpg', 34, 1),
(183, 'GP715 Blushing', 'uploads/tonos/c15.jpg', 34, 1),
(184, 'GP716 Cafe', 'uploads/tonos/c16.jpg', 34, 1),
(185, 'GP718 Flesh', 'uploads/tonos/c18.jpg', 34, 1),
(186, 'GP723 Satin Plum', 'uploads/tonos/c23.jpg', 34, 1),
(187, 'GP723 Satin Plum', 'uploads/tonos/c23.jpg', 34, 1),
(190, 'GLE717 Emerald', 'uploads/tonos/thumbnail_C03ECB60-A75E-4E32-8C38-1B760BF47DE3-3703-00000293A6782238.jpg', 36, 1),
(191, 'GLE719 Dark Brown', 'uploads/tonos/thumbnail_7047FA83-959D-40CC-9B1E-CDA831F4E469-3703-00000293B80333D9.jpg', 36, 1),
(192, 'GLE720 Dark Blue', 'uploads/tonos/thumbnail_62FB7953-700F-400B-93C5-DD88240FA7D4-3703-00000293C1218EDD.jpg', 36, 1),
(193, 'GLE721 Black', 'uploads/tonos/thumbnail_95B4A9C8-88FE-42DF-9FBF-9C7DDC221BA3-3703-00000293E9746488.jpg', 36, 1),
(194, 'GC969 Porcelain', 'uploads/tonos/GC969_prod_img_1024x1024.jpg', 37, 1),
(195, 'GC970 Light Ivory', 'uploads/tonos/GC970_prod_img_1024x1024.jpg', 37, 1),
(196, 'GC971 Classic Ivory', 'uploads/tonos/GC971_prod_img_1024x1024.jpg', 37, 1),
(197, 'GC972 Natural', 'uploads/tonos/GC972_prod_img_1024x1024.jpg', 37, 1),
(198, 'GC973 Creamy Beige', 'uploads/tonos/GC973_prod_img_1024x1024.jpg', 37, 1),
(199, 'GC974 Nude', 'uploads/tonos/GC974_prod_img_1024x1024.jpg', 37, 1),
(200, 'GC975 Medium Bisque', 'uploads/tonos/GC975_prod_img_1024x1024.jpg', 37, 1),
(201, 'GC976 Pure Beige', 'uploads/tonos/GC976_prod_img_1024x1024.jpg', 37, 1),
(202, 'GC977 Warm Sand', 'uploads/tonos/77.JPG', 37, 1),
(203, 'GC978 Medium Beige', 'uploads/tonos/78.JPG', 37, 0),
(204, 'GC979 Almond', 'uploads/tonos/79.JPG', 37, 1),
(205, 'GC980 Cool Tan', 'uploads/tonos/80.JPG', 37, 1),
(206, 'GC981 Toast', 'uploads/tonos/81.JPG', 37, 1),
(207, 'GC982 Warm Honey', 'uploads/tonos/82.JPG', 37, 1),
(208, 'GC983 Fawn ', 'uploads/tonos/83.JPG', 37, 1),
(209, 'GC984 Toffee', 'uploads/tonos/84.JPG', 37, 0),
(210, 'GC985 Espresso', 'uploads/tonos/85.JPG', 37, 0),
(211, 'GC986 Chestnut', 'uploads/tonos/86.JPG', 37, 0),
(212, 'GC987 Beautiful Bronze', 'uploads/tonos/87.JPG', 37, 0),
(213, 'GC988 Dark Cocoa', 'uploads/tonos/88.JPG', 37, 1),
(214, 'GC989 Mahogany ', 'uploads/tonos/89.JPG', 37, 1),
(215, 'GC990 Orange Corrector', 'uploads/tonos/90.JPG', 37, 1),
(216, 'GC991 Yellow Corrector', 'uploads/tonos/91.JPG', 37, 1),
(217, 'GC992 Green Corrector', 'uploads/tonos/92.JPG', 37, 1),
(218, 'GC993 Lavender Corrector', 'uploads/tonos/93.JPG', 37, 0),
(219, 'GC994 Peach Corrector', 'uploads/tonos/94.JPG', 37, 1),
(220, 'GC995 Ligth Yellow Corrector', 'uploads/tonos/95.JPG', 37, 1),
(222, 'GLC584 Hyped', 'uploads/tonos/la-girl-lip-attraction-attraction-hyped.jpg', 40, 1),
(223, 'GLC585 Enticing', 'uploads/tonos/enticing.JPG.jpg', 40, 1),
(224, 'GLC587 On Fire', 'uploads/tonos/3337637.jpg', 40, 1),
(225, 'GLC587 Intrigue ', 'uploads/tonos/intrigue.JPG.jpg', 40, 1),
(226, 'GLC589 Scandal', 'uploads/tonos/scandal.JPG.jpg', 40, 1),
(227, 'GCL590 Drama', 'uploads/tonos/15142_2_LA_Girl_Lippenstift_-_Lip_Attraction_Lipstick.jpg', 40, 1),
(228, 'GCC633 Fair', 'uploads/tonos/33.jpg', 43, 1),
(229, 'GCC635 Natural', 'uploads/tonos/35.jpg', 43, 1),
(230, 'GCC636 Medium ', 'uploads/tonos/36.jpg', 43, 1),
(231, 'GCC637 Tan', 'uploads/tonos/37.jpg', 43, 1),
(232, 'GCC638 Medium deep', 'uploads/tonos/38.jpg', 43, 1),
(233, 'GCC639 Deep', 'uploads/tonos/39.jpg', 43, 1),
(234, 'GCC640 Highlight / Bronzer', 'uploads/tonos/40.jpg', 43, 1),
(235, 'GGP451 Holo-Glam', 'uploads/tonos/GGP451_prod_img_1024x1024.jpg', 44, 1),
(236, 'GGP452 Twinkle Twinkle', 'uploads/tonos/GGP452_prod_img_1024x1024.jpg', 44, 1),
(237, 'GPP453 Ooh-la-la', 'uploads/tonos/IMG-3911[5119].jpg', 44, 1),
(238, 'GGP454 Frenzy', 'uploads/tonos/IMG-3912[5120].jpg', 44, 1),
(239, 'GPP455 Goal Digger', 'uploads/tonos/IMG-3913[5121].jpg', 44, 1),
(240, 'GPP457 Party Girl', 'uploads/tonos/IMG-3915[5123].jpg', 44, 1),
(241, 'GB351 Blonde', 'uploads/tonos/LAG_Shady_Slim_GB351_1024x1024.jpg', 45, 1),
(242, 'GB352 Taupe', 'uploads/tonos/LAG_Shady_Slim_GB352_1024x1024.jpg', 45, 1),
(243, 'GB353 Soft Brown', 'uploads/tonos/LAG_Shady_Slim_GB353_1024x1024.jpg', 45, 1),
(244, 'GB354 Auburn', 'uploads/tonos/hilp.jpg', 45, 1),
(245, 'GB356 Medium Brown', 'uploads/tonos/pp.jpg', 45, 1),
(246, 'GB358 Espresso', 'uploads/tonos/58.jpg', 45, 1),
(247, 'GB359 Blackest Brown', 'uploads/tonos/59.jpg', 45, 1),
(248, 'GB360 Black', 'uploads/tonos/60.jpg', 45, 0),
(249, 'GLC876 Teddy', 'uploads/tonos/GLC876_prod_img_1024x1024.jpg', 46, 1),
(250, 'GLC879 Edgy', 'uploads/tonos/GLC879_prod_img_1024x1024.jpg', 46, 1),
(251, 'GLC880 Panic', 'uploads/tonos/GLC880_prod_img_1024x1024.jpg', 46, 1),
(252, 'GLC881 Rio', 'uploads/tonos/GLC881 Rio.jpg', 46, 1),
(253, 'GLC886 Riot', 'uploads/tonos/GLC886_prod_img_1024x1024.jpg', 46, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_admin`
--

CREATE TABLE `user_admin` (
  `id_user` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pass` varchar(300) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `user_admin`
--

INSERT INTO `user_admin` (`id_user`, `username`, `pass`) VALUES
(1, 'andrea_admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id_delivery`);

--
-- Indices de la tabla `imagen_inicio`
--
ALTER TABLE `imagen_inicio`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id_moneda`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_subcategoria`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tproducto`);

--
-- Indices de la tabla `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id_delivery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `imagen_inicio`
--
ALTER TABLE `imagen_inicio`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;
--
-- AUTO_INCREMENT de la tabla `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
