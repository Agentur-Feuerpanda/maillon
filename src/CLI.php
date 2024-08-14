<?php
namespace Feuerpanda\Maillon;
use WP_CLI;
/**
 * The CLI-specific functionality of the plugin.
 *
 * @link       https://feuerpanda.de
 * @since      1.0.0
 *
 * @package    Maillon
 * @subpackage Maillon/CLI
 * @author     Feuerpanda
 *
 */
class CLI {

	/**
	 * Registers maillon command when cli get's initialized.
	 *
	 * @since  1.0.0
	 * @author Scott Anderson
	 */
	public static function register_commands() {
		WP_CLI::add_command( 'maillon', self::class );
	}

	/**
     * Sends a test mail.
     *
     * ## OPTIONS
     *
     *
     * [--to=<to>]
     * : the recipient of the mail.
	 *
	 * [--subject=<subject>]
     * : The subject of the mail
	 *
	 * [--debuglvl=<debuglvl>]
	 * : the Debug level
	 * ---
	 * default: 0
	 * options:
     *   - 0
     *   - 1
	 *   - 2
	 *   - 3
	 * ---
	 *
     *
     * ## EXAMPLES
     *
     *     wp maillon mail_test --to=test@examlpe.com
     *
     * @when after_wp_load
     */
	public function mail_test( $args, $args_assoc ) : void {
		$to = $args_assoc['to'] ?? get_bloginfo( 'admin_email' );
		$debug = $args_assoc['debuglvl'] ?? null;
		$subject = $args_assoc['subject'] ?? 'WP Mail Test';

		if ( $debug ) {
			define( 'MAIL_DEBUG', $debug);
		}

		$mail = wp_mail(
			$to,
			$subject,
			'This is a test email sent from WP CLI.'
		);

		if ( $mail === true ) {
			WP_CLI::success( sprintf( 'Mail successfully sent to %s', $to ) );
		}
		else {
			WP_CLI::error( 'Error occured when try to send mail' );
		}

		return;

	}

}
