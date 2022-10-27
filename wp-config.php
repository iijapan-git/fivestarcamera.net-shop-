<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

define('WP_HOME','https://fivestarcamera-shop.iijapan.jp/');
define('WP_SITEURL','https://fivestarcamera-shop.iijapan.jp/');

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'iijapan2_fivestarcamera');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'iijapan2');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'f610gd67');

/** MySQL のホスト名 */
define('DB_HOST', 'mysql627.db.sakura.ne.jp');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '1<[-7)5158M9!EkUSk{h)sr^|P05Oj:CKR8`RF@c6H-j9ibw)?2YRPstC$IoB6^0');
define('SECURE_AUTH_KEY',  'LivMQIa#tT.4sL3!E2!`5DX.okuJWuTYlSWXQ94Ct^xW-IzdoLD{w;tI~_`,Wm{Z');
define('LOGGED_IN_KEY',    'rNQe_92^Ybp0N(%2ZmTC&ZKHh7omgocB?#WWl=@EY.yA$x;s!Mep=y6+me1NH-km');
define('NONCE_KEY',        'T!9-^a}|9DF.$3T41ZOOTgGO+aPc[.U9JcW*E{aXTMKkIB.8(UBvB=w*`$[AEq]W');
define('AUTH_SALT',        'IYM2-slVie 6kRB;A0p]cqc<n#CKGix$VCiGe`#C_)dsvqhzR)N%CZ_NKn`|qb_f');
define('SECURE_AUTH_SALT', ';?u7ybZK}d)h`!)v>kB:0g P7]`BSMh%6pJZpTR!/F=R&52kP)KEZ;7`:r<G^#]#');
define('LOGGED_IN_SALT',   'g}Eez3zpYS.O~DH0t8{lwy!C;:+~NSs!:9YGxn-8,ii#^H1j/r3<btaYMjY2tHc&');
define('NONCE_SALT',       '<25S)=W/>7:Yhwfjfh:DIeaGQGNO u1@SG{}2S~|11r+UG>YU?S7$r1BhP:dH0Mj');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
