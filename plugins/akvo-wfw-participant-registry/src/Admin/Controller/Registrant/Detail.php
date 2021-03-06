<?php
namespace Akvo\WfW\ParticipantRegistry\Admin\Controller\Registrant;

use Akvo\WfW\ParticipantRegistry\Admin\Controller\Base as AWPRAdminControllerBase;
/**
 * Description of Registrant
 *
 * @author Jayawi Perera
 */
class Detail extends AWPRAdminControllerBase {

	const MENU_SLUG = 'AWPR_registrant_detail';

	public function initialise () {

		$sHookName = add_submenu_page(
				null,
				'Wandelen voor Water - Participant Registry: Settings',
				'Settings',
				\Akvo\WfW\ParticipantRegistry\Config::CAPABILITY_GENERAL_NAME,
				self::MENU_SLUG,
				array($this, 'page')
			);

		//		add_action('admin_print_styles', array($this, 'enqueueAdminIconCss'));

		add_action('admin_print_scripts-' . $sHookName, array($this, 'enqueueBootstrapJs'));
		add_action('admin_print_styles-' . $sHookName, array($this, 'enqueueBootstrapCss'));
		add_action('admin_print_styles-' . $sHookName, array($this, 'enqueueFontAwesomeCss'));
		add_action('admin_print_styles-' . $sHookName, array($this, 'enqueueAdminCss'));

	}

	public function page () {

		$oRegistry = new \Akvo\WfW\ParticipantRegistry\Admin\Model\Registry();
		$aContent = $oRegistry->getRegistrant();

		include_once AkvoWfwParticipantRegistry_Plugin_Dir . '/src/Admin/View/scripts/registrant/detail.phtml';

	}

}