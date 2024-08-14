<?php

namespace Feuerpanda\Maillon;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer {

	/**
	 * Mailer constructor.
	 * Setup the hooks.
	 * @return void
	 */
	public function __construct() {
		add_action( 'phpmailer_init', [$this, 'setup_smtp'] );
		add_filter( 'wp_mail_from', [$this, 'set_sender_address'] );
		add_filter( 'wp_mail_from_name', [$this, 'set_sender_name'] );
	}

	/**
	 * Setup the SMTP settings if the mailer is set to smtp.
	 * @param PHPMailer $phpmailer
	 * @return void
	 */
	public function setup_smtp( PHPMailer $phpmailer ) : void {
		if ( MAIL_MAILER != 'smtp' ) {
			return;
		}

		$phpmailer->isSMTP();
		$phpmailer->SMTPDebug  = defined( 'MAIL_DEBUG' ) ? MAIL_DEBUG : 0;
		$phpmailer->Host       = MAIL_HOST;
		$phpmailer->SMTPAuth   = true;
		$phpmailer->Username   = MAIL_USERNAME;
		$phpmailer->Password   = MAIL_PASSWORD;
		$phpmailer->SMTPSecure = MAIL_ENCRYPTION;
		$phpmailer->Port       = MAIL_PORT;
	}

	/**
	 * Set sender address.
	 * Changes the sender address to the one defined in the MAIL_FROM_ADDRESS if available.
	 * @param string $from_email The current sender address.
	 * @return string The new sender address.
	 */
	public function set_sender_address( string $from_email ): string {
		return MAIL_FROM_ADDRESS ?? $from_email;
	}

	/**
	 * Set sender name.
	 * Changes the sender name to the one defined in the MAIL_FROM_NAME or the blog name.
	 * @param string $from_name The current sender name.
	 * @return string The new sender name.
	 */
	public function set_sender_name( string $from_name ) : string {
		return MAIL_FROM_NAME ?? get_bloginfo( 'name' );
	}
}
