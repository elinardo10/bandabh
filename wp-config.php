<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa user o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'bandabh');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'vertrigo');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'zXJcl%O8)?~1<g4LI(O86VdQYtjcUDIweH~u1@vrayxf1Z^L&|9P]~^}@N xdui+');
define('SECURE_AUTH_KEY',  ',)y;IdW.nQ^<uBzQR5v;v7hO|H9^r[_xx1:dN.Ozw@N`2y#YFS_8h8Y-~_J!8FZF');
define('LOGGED_IN_KEY',    'qq6(_,N[p;y<*X2_(!lJ16CdJ~<@R8#vXHYglQbO1>bx[UWoLI1eW_X4M)mJiHJ/');
define('NONCE_KEY',        ' 1O5,h5Sl&9D|`j;HFBO+N3Mbe^#QKmOYES%}Naq6D5l6<~v~dp*mVZJg;O7{U%P');
define('AUTH_SALT',        'nZCDo-%o!t0NHE$)2&24u@&?=4m<Mc%g<*1.?x@`NJXU}${}v75iN!=@Wa83]+f~');
define('SECURE_AUTH_SALT', 'F9LmR?Oq$XJhWkq+V- e6~Sg/BmwyAD[S3ime<^b]rwb5rdC6=S;1MVplHS4O)[z');
define('LOGGED_IN_SALT',   'ZF!Y2N++;0WW2CTpCBW<nVMA=G=$0ucb?,[/j{3-^VI7I4+M.;aQXd8W~:jbXrO=');
define('NONCE_SALT',       'N)<m.u-@<77yyaRl@TCHd&|o]&YFk<3vAa#LS&o@n$Ni 1Jsz9l//7Q6dxS+|^V=');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * para cada um um único prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'bh_';

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
